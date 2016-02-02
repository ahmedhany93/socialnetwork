function validate()
  {
 
    var em=e_mail.value;
    var passw=psw.value;
    var cpw=c_psw.value;
    var fname=firstname.value;
    var lname=lastname.value;

    var pnum=phone_num.value;
    var bday=day.value;
    var bmonth=month.value;
    var byear=birthyear.value;


   var nummonth=bmonth-1;    
  

  var dateObj = new Date(byear, nummonth, bday);
if (dateObj.getFullYear() == byear && dateObj.getMonth() == nummonth && dateObj.getDate() == bday) {
} else {
    alert('Invalid date');
    return false;
}
    


    if(bmonth=="Febr"){

     //check bs msh ha3nmlha 
    }
    
       var f =getflag();
       
       if(empty_check(em)==false )
      {
         window.alert('Error: Empty Email');
         return false;
      }


      if(passw.length==0)
      {
        window.alert('Error: Empty Password');
         return false;
      }

      else if(passw.length<6 || psw.length>14)
      {
        window.alert('Error: Check password length \nIt must be between 6 to 14 characters');
         return false;
      }

      if(passw.localeCompare(cpw)!=0)
      {
        window.alert('Error: Password does not match');
         return false;
      }
      
      if(empty_check(fname)==false )
      {
        window.alert('Error: Empty Firstname');
         return false;
      }

      if(empty_check(lname)==false )
      {
        window.alert('Error: Empty Lasttname');
         return false;
      }

      if(pnum.length>11){
         window.alert('Error: Invalid Phone Number ');
         return false;
      }
      
      if(pnum.length>0){
      if(validate_phone(pnum)==false)
        return false;
      }

      if(bday==0)
      {
         window.alert('Error: Choose Day in Birthdate ');
         return false;
      }

      if(bmonth==0)
      {
         window.alert('Error: Choose Month in Birthdate ');
         return false;
      }

      if(byear==0)
      {
         window.alert('Error: Choose Year in Birthdate ');
         return false;
      }

      if(f==0)
      {
         window.alert('Error: Email already used');
         return false;

      }
      
      else if(validate_email(em)==false)
        return false;


      

  }


  function empty_check(obj) 
 { 
    var flag=0;
    var i;
    if(obj.length==0)
    {
    	return false;
    }
 
    for( i=0; i<obj.length ; i++)
    {
    	  if(obj.charAt(i)!=' ')
    	  {
          flag=1;
          i=obj.length;
          }
    }
        
         if(flag==0)
         {
         return  false;
         }
 }
   
  
  function validate_email(email)
  {
    var filter = /^([a-zA-Z0-9]{1})+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z\-])+\.)+([a-zA-Z]{2,4})+$/;

    if (!filter.test(email)) {
    alert('Error: Invalid email address');
    return false;}
  } 


  function validate_phone(pnum)
  {
   var filter = /^([0]{1})+([1]{1})+([0-2]{1})+([0-9]{8})/;

    if (!filter.test(pnum)) {
    alert('Error: Invalid Phone Number');
    return false;}

  }




