$(document).ready(function(){
  



});


(function poll() {
    setTimeout(function () {
    // console.log("hi");

        $.ajax({
            type: 'POST',
            dataType: 'text',  //data type is type of response expected
            url: 'notification.php',
            success: function (data) {

              console.log(data,'info');
              if( data.length > 0){
              createNoty(data,'info');
              //  alert(data);
                  $('.page-alert .close').click(function(e) {
        e.preventDefault();
        $(this).closest('.page-alert').slideUp();
    });
            }
            },
            complete: poll
        });
    }, 2000);
})();

function createNoty(message, type) {
 // alert("here" );
    var html = '<div class="alert alert-' + type + ' alert-dismissable page-alert">';    
    html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
    html += message;
    html += '</div>';    
    $(html).hide().prependTo('#noty-holder').slideDown();
};

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


