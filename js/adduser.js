function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function insertuser(){
        var loginform = $('#adduserform');
        var submit = $('.btn-adduser');
        var alertotp = $('.alert-user');
        var name = $('#name').val();
        var user_number = $('#contactno').val();
        var email = $('#email').val();

        if (name != "") {
            if (user_number != "") {
            	if (email != "") {
            		$("#loading_spinner").css({"display":"block"});
	                $.ajax({
	                    url: 'insertuser.php',
	                    type: 'POST',
	                    // dataType : 'html',
	                    data: {name:name,user_number:user_number,email:email,adduser:"adduser"},
	                    beforeSend: function(){
	                        alertotp.fadeOut();
	                        submit.html('Submitting.......');
	                    },
	                    success:function(data){
	                        if(data == "success"){
	                            alertotp.html("<h5><strong class='text-success'>User Added Successfully</strong></h5>").fadeIn();
	                            loginform.trigger('reset');
	                            $("#loading_spinner").css({"display":"none"});
	                            submit.html('Submit');
	                            // submit.attr("style", "display: none !important");
	                            // setTimeout(function(){
	                            //   window.location.href = "dashboard.php";
	                            // }, 2000);
	                        }
	                        else if(data == "exist"){
	                        	submit.html('Submit');
	                            // loginform.trigger('reset');
	                            $("#loading_spinner").css({"display":"none"});
	                            alertotp.html("<h5><strong class='text-danger'>Mobile Number already exist, please check number and submit again</strong></h5>").fadeIn();
	                            $('#contactno').focus();
	                        }
	                        else{
	                            submit.html('Submit');
	                            loginform.trigger('reset');
	                            $("#loading_spinner").css({"display":"none"});
	                            alertotp.html("<h5><strong class='text-danger'>There was some error while adding user, please fill details properly and then submit</strong></h5>").fadeIn();
	                            $('#username').focus();
	                        }
	                    }
	                });
            	}
            	else{
            		alert("Please Enter Email Address");
            		$('#email').focus();
            	}
            }
            else{
                alert("Please Enter Mobile Number");
                $('#contactno').focus();
            }
        }
        else{
            alert("Please Enter Username");
            $('#name').focus();
        }
        return false;
}