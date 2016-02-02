<?php
session_start();
include("connect.php");

$mem_id=$_SESSION["S_user_id"];

$done = 0;

$friendrequests ="SELECT member.first_name, member.last_name, notification_add.adder_id FROM `notification_add` join member on adder_id = member.member_id WHERE added_id =$mem_id ";
$result = mysqli_query($conn, $friendrequests);

    // output data of each row
$row = mysqli_fetch_assoc($result);


$fname= $row['first_name'];
$lname = $row['last_name'];
$adder = $row['adder_id'];

$delReq ="delete FROM `notification_add` WHERE added_id = $mem_id and adder_id = $adder ";
$result = mysqli_query($conn, $delReq);
    if(strlen($fname) > 0){
    echo $fname." ".$lname." "."Added you ";
    $done= 1;
}

if($done==0){


$likesQ ="SELECT member.first_name, member.last_name, notification_l.Liker_id FROM `notification_l` join member on Liker_id = member.member_id WHERE Liked_id =$mem_id; ";
$result = mysqli_query($conn, $likesQ);

    // output data of each row
$row = mysqli_fetch_assoc($result);


$fname= $row['first_name'];
$lname = $row['last_name'];
$liker = $row['Liker_id'];

$delReq ="delete FROM `notification_l` WHERE Liker_id = $liker and Liked_id = $mem_id; ";
$result = mysqli_query($conn, $delReq);
    if(strlen($fname) > 0){
    echo $fname." ".$lname." "."Liked Your Post ";
    $done= 1;
}
}
?>