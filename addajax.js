$(document).ready(function(){
  
    $('#addfriend').click(addfriend); //when I click add friend
});
var flag=0;
function addfriend(){

    var myID = mem_id;
    var hisID = member;
      
    if(myID==hisID){
  alert("you cannot add yourself STUPID !");
  return;
    }



    var Emailaddress= $('#addfriend').val();
    jQuery.ajax({
            type: 'POST',
            data: 'myID='+ myID +'&hisID='+ hisID  ,
            url: 'addfriend.php',
            cache: false,
            success: function(response){
                if(response == 1){
                   flag =1; //if 1 success

               cons
                }
                else {
                    
                     flag =0;
                     //do perform other actions like displaying error messages etc.,
                }
            }
        });


}

function getflag(){

 return flag;

}