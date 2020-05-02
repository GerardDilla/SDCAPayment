$(document).ready(function(){

    $('.paymentsubmit').click(function(e){
        var $valid = $('.wizard-card form').valid();
        if(!$valid) {
            return false;
        }else{
            e.preventDefault();
            alert('success');
            inputs = {
                firstname:$('#firstname-input').val(),
                lastname:$('#lastname-input').val(),
                amount:$('#amount-input').val(),
                referencenumber:$('#reference-input').val(),
            }
            wirecardStatus = getWirecardSession(inputs);
            wirecardStatus.done(function(data){

                data = JSON.parse(data);
                console.log(data);

                //Uncomment if embedd. Website must have ssl
                //WPP.embeddedPayUrl(data['Output']);

                //Uncomment if hosted
                WPP.hostedPayUrl(data['Output']);


            });
        }
    });

});

function getWirecardSession(inputs = {}){

    return $.ajax({
        url: baseurl+'index.php/Main/payreg',
        type: 'GET',
        data: inputs
    });

}