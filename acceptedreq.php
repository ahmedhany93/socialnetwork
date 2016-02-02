<?php
session_start();
include("connect.php");
$mem_id=$_SESSION["S_user_id"];

$acc_fr=$_POST['member_id'];

$query=mysqli_query($conn,"INSERT INTO friend_list (`member_id`,`friend_id`) VALUES ('$mem_id','$acc_fr')") or die(mysql_error());
$query2=mysqli_query($conn,"INSERT INTO friend_list (`member_id`,`friend_id`) VALUES ('$acc_fr','$mem_id')") or die(mysql_error());
$query3=mysqli_query($conn,"DELETE FROM `friend_req` WHERE friend_req.member_id='$acc_fr' AND friend_req.req_mem_id='$mem_id'");
echo "<br>  <br> You will be redirirected to the main page in 1 secounds  <br> ";
echo ' <meta http-equiv="refresh" content="0;url=profile.php" />';

?>