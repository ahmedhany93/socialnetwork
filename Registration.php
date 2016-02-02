<?php


$Firstname = $_POST['fname'];
$Lastname = $_POST['lname'];
$Password = $_POST['pw'];
$C_Password = $_POST['C_pw'];
$EmailAdress = $_POST['Email'];
$PhoneNumber = $_POST['pnumber'];
$Birthdate_Day=$_POST['day'];
$Birthdate_Month=$_POST['month'];
$Birthdate_Year=$_POST['birthyear'];
$Gender=$_POST['gender'];
$Hometown=$_POST['hometown'];
$MaritalStatus=$_POST['ms'];
$AboutYou=$_POST['About'];



include("connect.php");

$sql = "SELECT * FROM member WHERE email='$EmailAdress'";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
	echo "Error: Username already exists ";
}


else{
if($Gender=="Male"){
  $target_file = "defualt/male.png";

}else{

     $target_file = "defualt/female.png";
}

  $image = addslashes(file_get_contents( $target_file));
$sql="INSERT INTO `member`( `email`, `password`, `first_name` , `last_name`, `gender` , `birthdate` , `phone_number` , `hometown` , `about_me` , `marital_status` , `profile_pic`)
VALUES ('$EmailAdress' ,  md5('$Password') ,  '$Firstname' , '$Lastname' , '$Gender' , '$Birthdate_Year-$Birthdate_Month-$Birthdate_Day', '$PhoneNumber' , '$Hometown' , '$AboutYou' , '$MaritalStatus' , '$image')";



}
}
if($query=mysqli_query($conn,$sql))
 {

$sel = "SELECT member_id FROM member WHERE email='$EmailAdress'"; 
     $result = mysqli_query($conn, $sel);
     $row= mysqli_fetch_assoc($result);
     $mem_id=$row["member_id"];

   session_start(); 
 $_SESSION["S_firstname"]=$Firstname;
 $_SESSION["S_lastname"]=$Lastname;
 $_SESSION["S_Email"]=$EmailAdress;
 $_SESSION["S_user_id"]=$mem_id;


 /// Go to profile
 echo "<br>   Sign up Successful , You will be redirected to HomePage <br> ";
   echo ' <meta http-equiv="refresh" content="1;url=homepage.php" />';
 die();
  }
   else
   echo "<br>   Sign up Successful , You will be redirected to HomePage <br> ";
   echo ' <meta http-equiv="refresh" content="1;url=SignUp.html" />';


?>