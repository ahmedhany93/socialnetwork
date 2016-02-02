<?PHP
session_start();
 
 if(!isset($_SESSION["S_user_id"]))
 {
 echo ' <meta http-equiv="refresh" content="1;url=SignUp.html" />';
 }
 else {

 $EmailAdress=$_SESSION["S_Email"];
 $mem_id=$_SESSION["S_user_id"];
}

include('connect.php');

if(isset($_GET['ID']) )
$member = $_GET["ID"];

else
$member=$mem_id;

$disabled_t="disabled";

//check friends S
 $arefriends = false;

$friendquery="Select * From member m JOIN friend_list f on f.friend_id = m.member_id where f.member_id='$mem_id' and f.friend_id='$member'";
$addquery="SELECT `member_id` FROM `friend_req` WHERE member_id ='$mem_id'  and req_mem_id = '$member';";
$HEaddquery="SELECT `member_id` FROM `friend_req` WHERE member_id ='$member'  and req_mem_id = '$mem_id';";

$R=mysqli_query($conn,$friendquery);


if($result = mysqli_query($conn, $friendquery)){

    if(mysqli_num_rows($result) > 0){

//freinds

  //echo " FRIENDS !!!";
      $disabled_button = "disabled";
$addfriendbutton="Friend ";
  $arefriends=true;
}else{
//not friends


  //  echo "NOT FRIENDS !!!";

$disabled_button = "active";
$addfriendbutton="Add Friend";
$disabled_t="";

//check if I added him
if($result1 = mysqli_query($conn, $addquery)){

    if(mysqli_num_rows($result1) > 0){
 //  echo "here";
$disabled_button = "disabled";
$addfriendbutton="Pending";
$disabled_t="disabled";

    }
  }

//check if he added me 
if($result2 = mysqli_query($conn, $HEaddquery)){

    if(mysqli_num_rows($result2) > 0){
   
$disabled_button = "disabled";
$addfriendbutton="This person added you";
$disabled_t="disabled";


    }
  }







}}

    if ($mem_id == $member){
      $disabled_button = "disabled";
$addfriendbutton="You";

//special case
  $arefriends = true;

}
//echo for jquery
echo "<script>";
echo "var mem_id='{$mem_id}';";
echo "</script>";
echo "<br>";
echo "<script>";
echo "var member='{$member}';";

echo "</script>";
?>



<!--STYLING-->

 <!DOCTYPE html>
<html lang="en">
<head>
  <script src="jquery.js" type="text/javascript" language="javascript"></script> 
  <script src="ajax.js"> </script>
  <script src="addajax.js"> </script>
    <script src="notifyajax.js"> </script>
   <script src="//twemoji.maxcdn.com/twemoji.min.js"></script>  
    <script src="emoji.js"> </script>

  <title>Profile </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script type="text/javascript"> 



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
img.emoji {  
  // Override any img styles to ensure Emojis are displayed inline
  margin: 0px !important;
  display: inline !important;
}
 
</style>
</head>

<body>

  <!-- NAVBAR -->
<?php
include('navbar.php');
include('append_notification.php');
  ?>
  
  <!-- HELLOOOOOO -->

<div class="container">
<div class="jumbotron">
<?php 

$query=mysqli_query($conn,"SELECT member.first_name,member.Last_name,member.profile_pic,member.about_me,member.hometown,member.marital_status,member.birthdate 
  FROM member WHERE member.member_id=$member ") or die(mysql_error());

WHILE ($rows = mysqli_fetch_array($query)){

$mime = "image/jpeg";
      $b64Src = "data:".$mime.";base64," . base64_encode($rows["profile_pic"]);
      echo "<center>"; 
      echo '<img src="'.$b64Src.'" alt="" class="img-circle" width="150" height="150"/>';
     echo ' <h2 > ';
echo $rows['first_name'];
echo " " ;
echo $rows['Last_name'];
echo '</h2>';
     echo ' <h5> ';

     if($arefriends){

           echo "About: ";
     echo $rows['about_me'];
     echo "<br>";
     echo "<br>";
         echo "Birthdate: ";
     echo $rows['birthdate'];
     echo "<br>";
     echo "<br>";

     }

     echo "Hometown: ";
     echo $rows['hometown'];

     echo "<br>";
     echo "<br>";
echo "Status: ";
     echo $rows['marital_status'];
echo '</h5>';
echo "</center>"; 


}
?>

<!--ADDDDDDDDDDDDDDDDDDDDDDDDDDDDD FRIENDD-->




<form action='' method='POST'>
    <center> <button type="submit" <?php echo $disabled_t ?> class="btn btn-danger <?php echo $disabled_button ?>" id="addfriend" name="addfriend" id = "Add Freind" > 
      <span class="glyphicon glyphicon-user"></span> 
      <?php echo $addfriendbutton  ?>

</button>
</center>
 </form>


<!--ENNNDDD ADD FRIENDD-->


</div>
    <hr>

</div>
    <!-- End OF HELLOOO -->



 <!-- POSSTTTTT -->
 <!-- IF NOT ME DONT SHOW NEW POST  -->

   <?php if ($member == $mem_id) : ?>
      
<div class="container">
<form role="form" action="Post_enter.php" id="form" method="post" enctype="multipart/form-data" >
    <div class="form-group">

      <textarea class="form-control" rows="4" id="caption" name="caption" placeholder="What's on your mind?"></textarea>
    </div>

 <button type="submit" class="btn btn-info btn-block" ><b>Post</b></button>
<br><center>
<input type="file" class="btn btn-info" name="fileToUpload" id="fileToUpload">
      </center>
      <div class="checkbox">
     <input type="radio" name="ispublic" value="true" checked><b> Public</b>
  <br>
  <input type="radio" name="ispublic" value="false"> <b> Friends only </b>
    </div>
  </form>
  <hr>
</div>
    <?php endif; ?>



<!-- End OF POSSTTTTT -->


<div class="container">
<div class="panel panel-info">
<div class="panel-heading">

<h3 class="panel-title"><b>Your Posts</b></h3>

</div>

  <div class="panel-body"> 
  <div class = "media">



<?php 



if($arefriends){
  //freinds

$query=mysqli_query($conn,"SELECT post.post_id,post.post_date,post.caption,post.image,post.is_public,member.first_name,member.profile_pic ,member.Last_name 
  FROM member JOIN post ON post.member_id =member. member_id WHERE member.member_id=$member ORDER BY `post_date` DESC;") or die(mysql_error());

}else {

  // not freinds
  $query=mysqli_query($conn,"SELECT post.post_id,post.post_date,post.caption,post.image,post.is_public,member.first_name,member.profile_pic ,member.Last_name 
  FROM member JOIN post ON post.member_id =member. member_id WHERE member.member_id=$member and post.is_public='true' ORDER BY `post_date` DESC;") or die(mysql_error());
}

WHILE ($rows = mysqli_fetch_array($query)){
  $mime = "image/jpeg";
echo "<a class = \"pull-left\" href = \"#\">\n";
      $b64Src = "data:".$mime.";base64," . base64_encode($rows["profile_pic"]);
      echo '<img src="'.$b64Src.'" alt="" class="img-circle" width="50" height="50"/>';
     echo "   </a>\n";
     //end of profile pic

echo '   ';


        echo "   <div class = \"media-body\">\n"; 



	$postid =$rows['post_id'];	



echo ' <h4 class = "media-heading"> ';
echo $rows['first_name'];
echo " " ;
echo $rows['Last_name'];
echo ' ';
echo "<small>";
echo $rows['post_date']."<br>";
echo "</small>";
echo '</h4>';
echo ' ';
echo $rows['caption'];
echo "<br>";
echo "<br>";


//image
if(!is_null( $rows["image"])){
  $mime = "image/jpeg";
echo "<a class = \"pull-center\" href = \"#\">\n";
      $b64Src = "data:".$mime.";base64," . base64_encode($rows["image"]);
      echo '<img src="'.$b64Src.'" alt="" class="img-thumbnail" width="500" height="500"/>';
     echo "   </a>\n";
          echo "<br>";
     echo "<br>";


}//end of image



		//check like
		$likeQ="SELECT `member_id`, `post_id`FROM `post_like` WHERE member_id='$mem_id' and post_id='$postid' ;";
		if($result = mysqli_query($conn, $likeQ)){

    if(mysqli_num_rows($result) > 0){
		//liked
		
		//                                       LIKE BUTTON
		echo "<form >\n";
echo "<button  class=\"btn btn-sm btn-danger disabled\" id=\"like\" name='post_id' value=$postid>\n";
echo "<span class=\"glyphicon glyphicon-ok\"></span> Liked\n";
echo "</button>\n";

		}else{
			//no like

	echo "<form action='like.php' method='POST'>\n";
  echo "<button type=\"submit\" class=\"btn btn-sm btn-primary\" id=\"like\" name='post_id' value=$postid  >\n";
  echo "<input id=\"a\" name=\"member_id\" value=$member hidden=\"true\">";
  echo "<span class=\"glyphicon glyphicon-thumbs-up\"></span> Like\n";
  echo "</button>\n";
		}	
}
		
//                                       LIKE BUTTON

$countlikes = "SELECT COUNT(post_like.member_id) as likes
FROM post_like
GROUP BY post_like.post_id
HAVING post_like.post_id =$postid;";

$countq=mysqli_query($conn,$countlikes) or die(mysql_error());
WHILE ($rows2 = mysqli_fetch_array($countq)){
  
  echo "<span class=\"label label-danger\">\n"; 
  echo "\n"; 
  echo "Likes: ";
  echo $rows2['likes'];
  echo "</span>\n";
  echo "<br>";

  echo " </form>\n";

}
//                                       END OF LIKE BUTTON
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