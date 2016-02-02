$(function(){
     var url = document.location.href;

     if (url.toLowerCase().indexOf('signup.html?1') >= 0) {
       $('#alert').show();
     } else {
        
        $('#alert').hide();
     }
});