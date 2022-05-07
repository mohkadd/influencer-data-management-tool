function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function insertvoucher(){
        var loginform = $('#addvoucherform');
        var submit = $('.btn-addvoucher');
        var alertotp = $('.alert-voucher');
        var name = $('#vname').val();
        var pin = $('#vpin').val();
        var number = $('#vno').val();
        var user = $('#user').val();

        if (name != "") {
            if (pin != "") {
            	if (number != "") {
                    if (user != "") {
                        $("#loading_spinner").css({"display":"block"});
                        $.ajax({
                            url: 'insertvoucher.php',
                            type: 'POST',
                            // dataType : 'html',
                            data: {name:name,pin:pin,number:number,user:user,addvoucher:"addvoucher"},
                            beforeSend: function(){
                                alertotp.fadeOut();
                                submit.html('Submitting.......');
                            },
                            success:function(data){
                                if(data == "success"){
                                    alertotp.html("<h5><strong class='text-success'>Voucher Added Successfully</strong></h5>").fadeIn();
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
                                    alertotp.html("<h5><strong class='text-danger'>Voucher Number already exist, please check number and submit again</strong></h5>").fadeIn();
                                    $('#vno').focus();
                                }
                                else{
                                    submit.html('Submit');
                                    loginform.trigger('reset');
                                    $("#loading_spinner").css({"display":"none"});
                                    alertotp.html("<h5><strong class='text-danger'>There was some error while adding voucher, please fill details properly and then submit</strong></h5>").fadeIn();
                                    $('#vname').focus();  
                                }
                            }
                        });
                    }
                    else
                    {
                        alert("Please Select User");
                        $('#user').focus();
                    }
            	}
            	else{
            		alert("Please Enter Voucher Number");
            		$('#vno').focus();
            	}
            }
            else{
                alert("Please Enter Voucher Pin");
                $('#vpin').focus();
            }
        }
        else{
            alert("Please Enter Voucher Name");
            $('#vname').focus();
        }
        return false;
}