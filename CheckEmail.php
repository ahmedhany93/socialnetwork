<?php  

$EmailAdd=$_POST['Email'];

include("connect.php");

$sql = "SELECT * FROM member WHERE email='$EmailAdd'";

if($result = mysqli_query($conn, $sql)){
    echo(mysqli_num_rows($result)); }

?>