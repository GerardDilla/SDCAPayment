/*!

 =========================================================
 * Material Bootstrap Wizard - v1.0.2
 =========================================================
 
 * Product Page: https://www.creative-tim.com/product/material-bootstrap-wizard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/material-bootstrap-wizard/blob/master/LICENSE.md)
 
 =========================================================
 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */

// Material Bootstrap Wizard Functions

var searchVisible = 0;
var transparent = true;
var mobile_device = false;

$.extend({

    verifystudent: function(){
        var status = null;
        $.ajax({
            url: baseurl+"index.php/Main/verify_student",
            type:'POST',
            async: false,
            data:{
                student_reference_number:$('#studentnumber_input').val(),
                type:$('.active > input').val(),
            },
            success: function(response){

                status = JSON.parse(response);

            },
            fail: function(){
                alert('Error Connecting to Server, Try again.');
            }
        });
        return status;
       
    }


});



$(document).ready(function(){

    $.material.init();

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    $('.acad_info').hide();

    $('.student_number_inputs').hide();

    $('.student_basic_infos').hide();

    $('.acadchoice').click(function(){

        //alert($(this).data('acad'));
        InitAcadForm($(this).data('acad'));

    });

    // Gets Schoolyear Choices
    SchoolYear();

    if($('#inspect_option').data('inspect') == 'no'){

        toggleInspect(0);

    }else{

        toggleInspect(1);

    }

    /*
    $('#program_drop').change(function(){
        $('#program_drop').parent().removeClass('is-empty');
        alert('test');
    });
    */

    // Code for the Validator
    var $validator = $('.wizard-card form').validate({
		  rules: {
		    firstname: {
		      required: true,
		      minlength: 2
            },
		    lastname: {
		      required: true,
		      minlength: 2
            },
            studentnumber: {
                
                required:true,
                StudentVerify:true,
               
                
            },
		    // referencenumber: {

            //     number:true,
            //     StudentVerify:true,
                
            // },
           'educationtype[]': {
                required: true
            },
            program: {
                required: true
            },
            yearlevel: {
                required: true
            },
            semester: {
                required: true
            },
            schoolyear: {
                required: true
            },
            contactnumber: {
                required: true,
                number: true,
            },
            email: {
                required: true
            },
            amount: {
                required: true,
                number:true,
            },
        },
        
        errorPlacement: function(error, element) {
            //$(element).parent('div').addClass('has-error');
            //console.log(error);
            /*
            if($(element).parent('div').parent('div').parent('div').attr('id') == 'choiceparent'){

                parent = $('#choiceparent');
                $(parent).find('h4').html(error[0]['textContent']);
            }*/
            //console.log($(element).parent('div').parent('div').parent('div').attr('id'));

        },
        highlight: function (element, errorClass) {
            // console.log(element);
            if($(element).parent('div').parent('div').parent('div').attr('id') == 'choiceparent'){

                parent = $('#choiceparent');
                $(parent).find('h4').html('Choose the Academic Backround of the Student below');
            }

            if($(element).attr('id') == 'studentnumber_input'){

                $(element).parent('div').addClass('has-error');
                errordiv = $('#studentcred_errors');
                $(errordiv).html('Student Not Found');

            }


            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass) {
            $(element).closest('.form-group').removeClass('has-error');
            
        },
        success: function(label){
            // console.log(label);
            $(label).parent('div').removeClass('has-error');
            $('#choiceparent').find('h4').html('');
            $('#studentcred_errors').html('');
        }

        
	});

    $.validator.addMethod("StudentVerify", function(value, element) {

        student_status = $.verifystudent();
        if(student_status.length != 0){

            FillBasicInfo(student_status);
            $('.student_basic_infos').fadeIn();
            return this.optional(element) || true;

        }else{
            
            $('.student_basic_infos').fadeOut();
            return this.optional(element) || false;
        }
        // console.log('Student Verification: '+student_status.length+' Status:'+status);
        

    },"Student Not Found"); 

   

    // Wizard Initialization
  	$('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
            
        	var $valid = $('.wizard-card form').valid();

            if(!$valid) {

        		$validator.focusInvalid();
        		return false;

        	}


        	
        },

        onInit : function(tab, navigation, index){
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            var $wizard = navigation.closest('.wizard-card');

            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $('.wizard-card .wizard-navigation').append($moving_div);

            refreshAnimation($wizard, index);

            $('.moving-tab').css('transition','transform 0s');
        },

        onTabClick : function(tab, navigation, index){
            var $valid = $('.wizard-card form').valid();

            if(!$valid){
                return false;
            } else{
                return true;
            }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var $wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function(){
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if( !index == 0 ){
                $(checkbox).css({
                    'opacity':'0',
                    'visibility':'hidden',
                    'position':'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity':'1',
                    'visibility':'visible'
                });
            }

            refreshAnimation($wizard, index);
        },

  	});


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').prop('checked', false);
        } else {
            $('.choice').removeClass('active');
            $('.choice').find('[type="checkbox"]').prop('checked', false);
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').prop('checked', true);
            //alert($(this).find('[type="checkbox"]').val());
        }
    });

    $('.set-full-height').css('height', 'auto');

});

 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function FillBasicInfo(data = {}){

    // Hidden Inputs
    firstname = $('#firstname-input');
    middlename = $('#middlename-input');
    lastname = $('#lastname-input');

    // Labels
    firstname_label = $('#firstname-label');
    middlename_label = $('#middlename-label');
    lastname_label = $('#lastname-label');

    // Data Passing for Labels
    firstname_label.html(data[0]['First_Name']);
    middlename_label.html(data[0]['Middle_Name']);
    lastname_label.html(data[0]['Last_Name']);

    // Data Passing for label
    firstname.val(data[0]['First_Name']);
    middlename.val(data[0]['Middle_Name']);
    lastname.val(data[0]['Last_Name']);

    // For programs
    if($.inArray('Course',data[0])){

        program_choice = $('#program_drop');
        program_choice.val(data[0]['Course']);
        
    }


    
}

$(window).resize(function(){
    $('.wizard-card').each(function(){
        $wizard = $(this);

        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
            'transition': 'transform 0s'
        });
    });
});

function refreshAnimation($wizard, index){
    $total = $wizard.find('.nav li').length;
    $li_width = 100/$total;

    total_steps = $wizard.find('.nav li').length;
    move_distance = $wizard.width() / total_steps;
    index_temp = index;
    vertical_level = 0;

    mobile_device = $(document).width() < 600 && $total > 3;

    if(mobile_device){
        move_distance = $wizard.width() / 2;
        index_temp = index % 2;
        $li_width = 50;
    }

    $wizard.find('.nav li').css('width',$li_width + '%');

    step_width = move_distance;
    move_distance = move_distance * index_temp;

    $current = index + 1;

    if($current == 1 || (mobile_device == true && (index % 2 == 0) )){
        move_distance -= 8;
    } else if($current == total_steps || (mobile_device == true && (index % 2 == 1))){
        move_distance += 8;
    }

    if(mobile_device){
        vertical_level = parseInt(index / 2);
        vertical_level = vertical_level * 38;
    }

    $wizard.find('.moving-tab').css('width', step_width);
    $('.moving-tab').css({
        'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

    });
}

materialDesign = {

    checkScrollForTransparentNavbar: debounce(function() {
                if($(document).scrollTop() > 260 ) {
                    if(transparent) {
                        transparent = false;
                        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                    }
                } else {
                    if( !transparent ) {
                        transparent = true;
                        $('.navbar-color-on-scroll').addClass('navbar-transparent');
                    }
                }
        }, 17)

}

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};

function InitAcadForm(acad){

    if($('.acad_info').is(":hidden")){

        $('.acad_info').fadeIn();

    }

    if(acad == 'hed'){
        
        $('#program_drop').removeAttr("disabled");
        $('#program_drop').parent().parent().fadeIn();

        $('#semester_drop').removeAttr("disabled");
        $('#semester_drop').parent().parent().fadeIn();

        ProgramAPI();
        Yearlevel(acad);

    }else if(acad == 'bed'){

        $('#program_drop').attr("disabled", "disabled");
        $('#program_drop').parent().parent().hide();

        $('#semester_drop').attr("disabled", "disabled"); 
        $('#semester_drop').parent().parent().fadeOut();
        Yearlevel(acad);

    }else if(acad == 'shs'){

        $('#program_drop').removeAttr("disabled");
        $('#program_drop').parent().parent().fadeIn();

        $('#semester_drop').attr("disabled", "disabled"); 
        $('#semester_drop').parent().parent().fadeOut();

        StrandAPI();
        Yearlevel(acad);

    }
    $('#studentnumber_input').val('')
    $('.student_basic_infos').fadeOut();
    $('#referencenumber_input').val('')
}

function ProgramAPI(){

    $.ajax({
        url: baseurl+"index.php/Main/getPrograms",
        success: function(response){

            data = JSON.parse(response);

            row = $('#program_drop');
            row.html('');
            row.parent().removeClass('is-empty');
            row.append($("<option/>").text('Select Program').attr({disabled:"disabled",selected:"selected"}));


            $.each(data, function(index, result) 
            {
                //Set custom attribute 'sched-code'
                row = $('#program_drop');
                row.append($("<option/>").text(result['Program_Code']).attr('value',result['Program_Code']));

            });

        },
        fail: function(){

            alert('Error Connecting to Server, Try again.');

        }
    });

}

function StrandAPI(){

    $.ajax({
        url: baseurl+"index.php/Main/getStrand",
        success: function(response){

            data = JSON.parse(response);

            row = $('#program_drop');
            row.html('');
            row.parent().removeClass('is-empty');
            row.append($("<option/>").text('Select Strand').attr({disabled:"disabled",selected:"selected"}));


            $.each(data, function(index, result) 
            {
                //Set custom attribute 'sched-code'
                row.append($("<option/>").text(result['Strand_Title']).attr('value',result['Strand_Title']));

            });

        },
        fail: function(){

            alert('Error Connecting to Server, Try again.');

        }
    });

}

function Yearlevel(acad){

    if(acad == 'hed'){

        choices = [1,2,3,4];

    }else if(acad == 'shs'){

        choices = [11,12];

    }else{

        choices = [1,2,3,4,5,6,7,8,9,10];

    }

    dropdown = $('#yearlevel_drop');
    dropdown.html('');
    dropdown.parent().removeClass('is-empty');
    dropdown.append($("<option/>").text('Select Year Level').attr({disabled:"disabled",selected:"selected"}));

    $.each(choices , function(index, val){ 

        dropdown.append($("<option/>").text(val).attr('value',val));

    });

}

function SchoolYear(){

    $.ajax({
        url: baseurl+"index.php/Main/getSchoolyear",
        success: function(response){

            data = JSON.parse(response);

            row = $('#schoolyear_choices');
            row.html('');
            row.parent().removeClass('is-empty');
            row.append($("<option/>").text('Select School Year').attr({disabled:"disabled",selected:"selected"}));


            $.each(data, function(index, result) 
            {
                //Set custom attribute 'sched-code'
                row.append($("<option/>").text(result).attr('value',result));

            });

        },
        fail: function(){

            alert('Error Connecting to Server, Try again.');

        }
    });

}

function toggleInspect(config){

    if(config == 0){

        $(document).bind("contextmenu",function(e) {
            e.preventDefault();
        });
    
        $(document).keydown(function(e){
            if(e.which === 123){
                return false;
            }
        });

    }else{

        $(document).bind("contextmenu",function(e) {
            //e.preventDefault();
            e.returnValue = true;
        });
    
        $(document).keydown(function(e){
            if(e.which === 123){
                e.returnValue = true;
                return true;
            }
        });

    }


}



