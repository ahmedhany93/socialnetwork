<?php

$Email = $_POST['email'];
$Password = $_POST['pw'];


include("connect.php");



$sql = "SELECT * FROM member WHERE email='$Email'";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) == 0){
echo ' <meta http-equiv="refresh" content="1;url=SignUp.html?1" />';

}


else{

 $sel = "SELECT password FROM member WHERE email='$Email'";
 $result = mysqli_query($conn, $sel);
 $row= mysqli_fetch_assoc($result);
 $enc_password=$row["password"];
 $encPw= md5($Password);



 



if($enc_password==md5($Password)){
   $sel = "SELECT member_id FROM member WHERE email='$Email'";
 $result = mysqli_query($conn, $sel);
 $row= mysqli_fetch_assoc($result);
 $Member_ID=$row["member_id"];
 
 session_start(); 
 $_SESSION["S_Email"]=$Email;
 $_SESSION["S_user_id"]=$Member_ID;


/// Go to profile 
 echo "<br>   You Logged in.. You will be redirected to HomePage <br> ";
   echo ' <meta http-equiv="refresh" content="1;url=homepage.php" />';

}
else{
	 
   echo ' <meta http-equiv="refresh" content="1;url=SignUp.html?1" />';


}

}
}

?>