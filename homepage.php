<?php 
require('connect.php');
 ?>

<?php 
session_start();
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
  <script src="script.js"> </script>
     <script src="notifyajax.js"> </script>
  <script src="//twemoji.maxcdn.com/twemoji.min.js"></script>  
  <script src="emoji.js"> </script>
  <title>Home</title>
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

img.emoji {  
  // Override any img styles to ensure Emojis are displayed inline
  margin: 0px !important;
  display: inline !important;
}

@media (min-width: 768px) {
    .container{
        width:800px;
    }
}

</style>
</head>

<body>

  <!-- NAVBAR -->
<?php
include('navbar.php');
include('append_notification.php');
  ?>



 <!-- POSSTTTTT -->
<div class="container" >

  <form role="form" action="Post_enter.php" id="form" method="post" enctype="multipart/form-data">
    <div class="form-group">

      <textarea class="form-control" rows="5" name="caption" id="caption" name="caption" placeholder="What's on your mind?"></textarea>
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

<!-- End OF POSSTTTTT -->

<!--FRIENDS WITH POSTS-->

<div class="container">
<div class="panel panel-info">
<div class="panel-heading">
    <h3 class="panel-title"><b>News Feed</b></h3>

</div>

  <div class="panel-body">  
	<div class = "media">
   <!--<a class = "pull-left" href = "#">
      <img class = "media-object" src = "/bootstrap/images/64.jpg" alt = "Media Object">
   </a>
   <div class = "media-body">-->

<?php 
$id = $mem_id;

//print each post
$sql = "SELECT member.first_name,member.last_name,member.profile_pic,post.post_date,post.caption,post.image,post.post_id,member.member_id
FROM member  
INNER JOIN post  
ON post.member_id= member.member_id
WHERE post.is_public='true'
UNION
SELECT l.first_name,l.last_name,l.profile_pic,post.post_date,post.caption,post.image,post.post_id,l.member_id
FROM member as m 
INNER Join friend_list as  f 
on m.member_id = f.member_id
JOIN post
ON post.member_id = f.friend_id
Join member as l
on post.member_id = l.member_id
WHERE m.member_id=$id AND post.is_public='false'
UNION
SELECT member.first_name,member.last_name,member.profile_pic,post.post_date,post.caption,post.image,post.post_id,member.member_id
FROM member 
JOIN post
ON post.member_id=member.member_id
WHERE member.member_id=$id AND post.is_public='false' 
ORDER BY `post_date` DESC

";
$query=mysqli_query($conn,$sql) or die(mysqli_error());

WHILE ($rows = mysqli_fetch_array($query)){
  
   $memberid = $rows["member_id"];
  $mime = "image/jpeg";
echo "<a class = \"pull-left\" href = \"#\">\n";
      $b64Src = "data:".$mime.";base64," . base64_encode($rows["profile_pic"]);
      echo '<img src="'.$b64Src.'" alt="" class="img-circle" width="50" height="50"/>';
     echo "   </a>\n";
     //end of profile pic

echo '   ';

        echo "   <div class = \"media-body\">\n"; 

echo ' <h4 class = "media-heading"> ';

        echo "<a href=\"profile.php?ID=";
        echo $memberid.'"'.">";
echo $rows['first_name'];
        echo " " ;
        echo $rows['last_name'];
        echo"</a>\n";

echo ' ';
echo "<small>";
echo $rows['post_date']."<br>";
echo "</small>";
echo '</h4>';
echo ' ';
echo $rows['caption'];
echo "<br>";
echo "<br>";
$postid =$rows['post_id'];


//image
if(!is_null( $rows["image"])){
  $mime = "image/jpeg";
echo "<a class = \"pull-center\" href = \"#\">\n";
      $b64Src = "data:".$mime.";base64," . base64_encode($rows["image"]);
      echo '<img src="'.$b64Src.'" alt="" class="img-thumbnail" width="500" height="500"/>';
     echo "   </a>\n";
     echo "<br>";
    echo "<br>";

echo '   ';

}//end of image

//                                       LIKE BUTTON


$member=$rows['member_id'];



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


// Number of likes


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
}
echo " </form>";



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
