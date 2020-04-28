var addressUrl = $("#addressUrl").val();

function validateStudent()
	{
        console.log($("#referenceNumber").val());
        console.log($("#firstName").val());
        console.log($("#lastName").val());
        console.log($('.studentType:checked').val());
		ajax = $.ajax({
			async: false,
			url: window.addressUrl+"/validate_student_info",
			type: 'GET',
			data: {
				reference_no: $("#referenceNumber").val(),
				first_name: $("#firstName").val(),
                last_name: $("#lastName").val(),
                student_type: $('.studentType:checked').val()
			},  

			success: function(response){

				result = JSON.parse(response);
			

			},
			fail: function(){
				alert('Request failed');
			}
        });

        if(result.checker == 0)
        {
            //$("#errorHandling").modal("show");
            alert(result.message);
            $("#errorMessage").html(result.message);
            return 0;
        }
        else
        {
            console.log('true');
            return 1;
        }
        
	}

	function checkboxCheck()
	{
		console.log(window.addressUrl);
		console.log($('.studentType:checked').val());
	}