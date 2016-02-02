

$(document).ready(function(){

    $('#e_mail').change(check_username); //use keyup,blur, or change
});
var flag=0;
function check_username(){
    var Emailaddress= $('#e_mail').val();
    jQuery.ajax({
            type: 'POST',
            data: 'Email='+ Emailaddress,
            url: 'CheckEmail.php',
            cache: false,
            success: function(response){
                if(response == 0){
                   flag =1;
                }
                else {
                     alert('Error: Email already used');
                     flag =0;
                     //do perform other actions like displaying error messages etc.,
                }
            }
        });

}

function getflag(){

 return flag;

}