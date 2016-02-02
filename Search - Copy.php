<?php
 
session_start();

include("connect.php");

$Searchfor= $_POST["search"];


$conn = new mysqli($servername, $db_username, $db_password,$db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: <br/> " . $conn->connect_error);
}
?>

<?php
/*
// Search by name
$sel = "SELECT * FROM member WHERE first_name like'$Searchfor%' OR last_name like'$Searchfor%' ";
$result = mysqli_query($conn, $sel);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $firstname =$row["first_name"] ;
        $lastname =$row["last_name"] ;
        $memberid =$row["member_id"] ;
        $image=$row["profile_pic"] ;

        echo ($firstname);
        echo "<br>";
        echo($lastname);
        echo "<br>";
        echo($memberid);
        echo "<br>";
    }


  // Search by Full email
$sel = "SELECT * FROM member WHERE email='$Searchfor' ";
$result = mysqli_query($conn, $sel);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $firstname =$row["first_name"] ;
        $lastname =$row["last_name"] ;
        $memberid =$row["member_id"] ;
        $image=$row["profile_pic"] ;

        echo ($firstname);
        echo "<br>";
        echo($lastname);
        echo "<br>";
        echo($memberid);
        echo "<br>";
    }


// Search by Full phone number
$sel = "SELECT * FROM member WHERE phone_number='$Searchfor' ";
$result = mysqli_query($conn, $sel);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $firstname =$row["first_name"] ;
        $lastname =$row["last_name"] ;
        $memberid =$row["member_id"] ;
        $image=$row["profile_pic"] ;

        echo ($firstname);
        echo "<br>";
        echo($lastname);
        echo "<br>";
        echo($memberid);
        echo "<br>";
    }


    // Search by Full phone number
$sel = "SELECT * FROM member WHERE hometown='$Searchfor' ";
$result = mysqli_query($conn, $sel);

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        $firstname =$row["first_name"] ;
        $lastname =$row["last_name"] ;
        $memberid =$row["member_id"] ;
        $image=$row["profile_pic"] ;

        echo ($firstname);
        echo "<br>";
        echo($lastname);
        echo "<br>";
        echo($memberid);
        echo "<br>";
    }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="jquery.js" type="text/javascript" language="javascript"></script> 
  <script src="ajax.js"> </script>
  <script src="script.js"> </script>
  <title>Search Results</title>
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

<!--NAVBAR-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">              
                 <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          <a class="navbar-brand" href="homepage.php"> <img src="logo.png" alt="Brand"></a>
            </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <form action="Session_Die.php" class="navbar-form navbar-right" method="post">
        <div class="form-group">
         <input type="submit" class="btn btn-danger"  value="Logout"  >
        </div>
      </form>
<form action="profile.php" class="navbar-form navbar-right" method="post">
        <div class="form-group">
         <input type="submit" class="btn btn-success"  value="View Your Profile"  >
        </div>
      </form>

      <form class="navbar-form navbar-left" action="search.php" method="post">
           <div class = "col-lg-6">
            <div class = "input-group">
                <div class="col-sm-1">
               <input type = "text" class = "form-control" id="search" name= "search" placeholder="What are you looking for?">
              
               <span class = "input-group-btn">
                  <button class = "btn btn-default" type = "submit">
                     Search
                  </button>
                  </div>
               </span>
            </div>
         </div>
      </form>
    </div>
  </div>
</nav>


<div class="container">

<h1>Search Results..</h1>
    <div class="panel">
      <div class="panel-body">
        <div class = "media">

<?php
// Search by name
$sel = "SELECT * FROM member WHERE first_name like'$Searchfor%' OR last_name like'$Searchfor%' ";
$result = mysqli_query($conn, $sel);

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

        echo "<a href=\"profile.php\?ID=";
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
        //echo($memberid);
        echo "<br>";
    }


  // Search by Full email
$sel = "SELECT * FROM member WHERE email='$Searchfor' ";
$result = mysqli_query($conn, $sel);

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

        echo "<a href=\"profile.php\?ID=";
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
        //echo($memberid);
        echo "<br>";
    }


// Search by Full phone number
$sel = "SELECT * FROM member WHERE phone_number='$Searchfor' ";
$result = mysqli_query($conn, $sel);

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

        echo "<a href=\"profile.php\?ID=";
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
        //echo($memberid);
        echo "<br>";
    }



    // Search by Full phone number
$sel = "SELECT * FROM member WHERE hometown='$Searchfor' ";
$result = mysqli_query($conn, $sel);

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

        echo "<a href=\"profile.php\?ID=";
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
        //echo($memberid);
        echo "<br>";
    }

$post=mysqli_query($conn,"SELECT post.caption , post.post_date, member.first_name,member.Last_name,member.profile_pic FROM post 
JOIN member ON post.member_id = member.member_id
WHERE  post.caption LIKE '%$Searchfor%' ");
WHILE ($rows = mysqli_fetch_array($post)){
  $mime = "image/jpeg";
echo "<a class = \"pull-left\" href = \"#\">\n";
      $b64Src = "data:".$mime.";base64," . base64_encode($row["profile_pic"]);
      echo '<img src="'.$b64Src.'" alt="" class="img-circle" width="50" height="50"/>';
     echo "   </a>\n";
     //end of profile pic
echo '   ';
        echo "   <div class = \"media-body\">\n"; 
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
echo $rows['caption']."<br>";
echo "<br>";
        echo "</div>\n";
}
?>
    



      </div>
      </div>
    </div>
</div>



</body>
</html>
