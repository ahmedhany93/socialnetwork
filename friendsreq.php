<?php
 
session_start();

include("connect.php");

$mem_id=$_SESSION["S_user_id"];

$member=0;
$conn = new mysqli($servername, $db_username, $db_password,$db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: <br/> " . $conn->connect_error);
}
?>

<?php 
$member =0; //must have for navbar
 if(!isset($_SESSION["S_user_id"]))
 {
 echo ' <meta http-equiv="refresh" content="1;url=SignUp.html" />';
 }
 else {

 $EmailAdress=$_SESSION["S_Email"];
 $mem_id=$_SESSION["S_user_id"];

$id = $mem_id;}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <script src="jquery.js" type="text/javascript" language="javascript"></script> 
  <script src="ajax.js"> </script>
     <script src="notifyajax.js"> </script>
  <script src="script.js"> </script>
  <title>Friend request</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style type="text/css">  
body {  
  background-image: url("back.png");
  background-size: 100%;
}
@media (min-width: 768px) {
    .container{
        width:800px;
    }
}
 
</style>
</head>

<!--BOOOODDDDYYYYYYY-->

<body>

<?php
include('navbar.php');
include('append_notification.php');
  ?>



<div class="container">

<h1>Friend Requests..</h1>
    <div class="panel">
      <div class="panel-body">
        <div class = "media">

<?php

$friend ="Select m.first_name,m.last_name,m.member_id,m.profile_pic,m.about_me,f.req_mem_id From member m JOIN friend_req f on f.member_id = m.member_id where f.req_mem_id='$mem_id'" ;
$result = mysqli_query($conn, $friend);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $firstname =$row["first_name"] ;
        $lastname =$row["last_name"] ;
        $memberid =$row["member_id"] ;
        $image=$row["profile_pic"] ;
        $about=$row["about_me"];
        $mime = "image/jpeg";
       
        echo "<a class = \"pull-left\" href = \"#\">\n";
        $b64Src = "data:".$mime.";base64," . base64_encode($row["profile_pic"]);
        echo '<img src="'.$b64Src.'" alt="" class="img-circle" width="50" height="50"/>';
        echo "   </a>\n";

        echo "   <div class = \"media-body\">\n"; 

        echo ' <h4 class = "media-heading"> ';


        echo "<a href=\"profile.php?ID=";
        echo $memberid.'"'.">";
        echo ($firstname);
        echo " ";
        echo($lastname);
        echo"</a>\n";
        echo '</h4>';
        echo ' ';
        echo ($about);	
        echo "<br>";
        echo "<br>";
		
$member_id =$memberid;

echo "<form class=\"btn-group\" action='acceptedreq.php' method='POST'>\n";
echo "<button type=\"submit\" class=\"btn btn-sm btn-info\" id=\"Confirm\" name='member_id' value=$member_id>\n";
echo "<span class=\"glyphicon glyphicon-ok\"></span> Confirm\n";
echo "</button>\n";
echo " </form>\n";
	
echo "<form  class=\"btn-group\" action='deletereq.php' method='POST'>\n";
echo "<button type=\"submit\" class=\"btn btn-sm btn-danger\" id=\"Delete request\" name='member_id' value=$member_id>\n";
echo "<span class=\"glyphicon glyphicon-remove\"></span> Delete\n";
echo "</button>\n";
echo " </form>\n";	
echo "</div>\n";
echo "<hr>";

		
    }

?>
 
      </div>
      </div>
    </div>
</div>



</body>
</html>
