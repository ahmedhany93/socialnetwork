<?php 

include('connect.php');

 session_start();
 if(!isset($_SESSION["S_user_id"]))
 {
 echo ' <meta http-equiv="refresh" content="1;url=SignUp.html" />';
 }
 else {

 $EmailAdress=$_SESSION["S_Email"];
 $mem_id=$_SESSION["S_user_id"];

$id = $mem_id;
}

$sql = "SELECT gender FROM member WHERE member_id='$id'";

$result = mysqli_query($conn, $sql);
 $row= mysqli_fetch_assoc($result);
 $gender=$row["gender"];
   
if($gender=="Male"){
  $target_file = "defualt/male.png";

}else{

     $target_file = "defualt/female.png";
}

$image = addslashes(file_get_contents( $target_file));
$sql2 = "UPDATE member SET profile_pic = '$image' WHERE member_id = '$id'";

if($query=mysqli_query($conn,$sql2))
 {
echo "Editing profile_pic..... <br>";
echo ' <meta http-equiv="refresh" content="1;url=profile.php" />';
 } else {
   echo"errorrrrrrrrrrrrrrrr <br/>" .$sql2. "<br>" .mysqli_error($conn);
}


 ?>