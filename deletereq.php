<?php
session_start();
include("connect.php");
$mem_id=$_SESSION["S_user_id"];

$del_req=$_POST['member_id'];

$query3=mysqli_query($conn,"DELETE FROM `friend_req` WHERE friend_req.member_id='$del_req' AND friend_req.req_mem_id='$mem_id'") or die(mysqli_error());
echo "<br>  <br> You will be redirirected to the main page in 1 secounds  <br> ";
echo ' <meta http-equiv="refresh" content="0;url=profile.php" />';

?>