<?php
 
session_start();

include("connect.php");

$member=0;
 $mem_id=$_SESSION["S_user_id"];

$conn = new mysqli($servername, $db_username, $db_password,$db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: <br/> " . $conn->connect_error);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <script src="jquery.js" type="text/javascript" language="javascript"></script> 
  <script src="ajax.js"> </script>
  <script src="script.js"> </script>
  <title>Friend List</title>
  <meta charset="utf-8">
     <script src="notifyajax.js"> </script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 
var message ="Hello , its me " ;
var type= 'info'; 
 var html = '<div class="alert alert-' + type + ' alert-dismissable page-alert">';    
    html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
    html += message;
    html += '</div>';    
    $(html).hide().prependTo('#noty-holder').slideDown();
      $('.page-alert .close').click(function(e) {
        e.preventDefault();
        $(this).closest('.page-alert').slideUp();
    });

 </script>

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
  <!-- NAVBAR -->
<?php
include('navbar.php');
include('append_notification.php');
  ?>



<body>



<div class="container">

<h1>Friend List</h1>
    <div class="panel">
      <div class="panel-body">
        <div class = "media">

<?php


$friend ="Select * From member m JOIN friend_list f on f.friend_id = m.member_id where f.member_id='$mem_id'" ;

$result = mysqli_query($conn, $friend);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $firstname =$row["first_name"] ;
        $lastname =$row["last_name"] ;
        $memberid =$row["friend_id"] ;
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


        echo "</div>\n";
        echo "<br>";
        echo "<hr>";
        //echo($memberid);
    }


  


?>
    



      </div>
      </div>
    </div>
</div>



</body>
</html>
