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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="jquery.js" type="text/javascript" language="javascript"></script> 
  <script src="ajax.js"> </script>
  <script src="script.js"> </script>
  <title>Edit Profile</title>
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
.form-hortizontal{
  padding-left: 100px;
}
 
</style>
</head>

<body>

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
           
<p class="navbar-text navbar-left">
      Logged in as: 
<?php 
$query=mysqli_query($conn,"SELECT member.first_name,member.Last_name
  FROM member WHERE member.member_id=$id") or die(mysql_error());

WHILE ($rows = mysqli_fetch_array($query)){
echo "<b>";
echo $rows['first_name'];
echo " " ;
echo $rows['Last_name'];
echo "</b>";
}
?>
</p>


            </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <form action="Session_Die.php" class="navbar-form navbar-right" method="post">
        <div class="form-group">
         <input type="submit" class="btn btn-danger"  value="Logout"  >
        </div>
      </form>

      <form class="navbar-form navbar-left" method="post" action="search.php">
           <div class = "col-lg-6">
            <div class = "input-group">
                <div class="col-sm-1">
               <input type = "text" class = "form-control" id = "search"name = "search"placeholder="What are you looking for?">
              
               <span class = "input-group-btn">
              
                  <button class = "btn btn-info" type = "submit">
                     Search
                  </button>
                  </div>
               </span>
            </div>
         </div>
      </form>

      <form class="navbar-form navbar-right" action="profile.php">
        <button class = "btn btn-info" type = "submit">
                     View Your Profile
                  </button>
      </form>
    </div>
  </div>
</nav>
    <!-- EDN OF NAVBAR -->


<div class="container">

<div class="panel panel-info">
<div class="panel-heading">
    <h3 class="panel-title"><b>Edit Your Profile</b></h3>
  </div>
<div class="panel-body">

<form class="form-horizontal" enctype="multipart/form-data" action="done_edit.php" id="form" method="POST" >
          <!--EMAIL-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Email Address</label>
      <div class="col-sm-6">
        <input class="form-control" name="email" id="e_mail" type="email"  placeholder="example@example.com" >
      </div>
      <!--PASSWORD-->
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-sm-3 control-label">Password</label>
      <div class="col-sm-6">
        <input class="form-control" id="pw" name="psw" type="password">
      </div>
</div>
      <!--PROFILE PICTURE-->
    <div class="form-group">
      <label class="col-sm-3 control-label">Profile Picture</label>
      <div class="col-sm-6">
     <input type="file" class="btn btn-default" enctype="multipart/form-data" name="fileToUpload" id="fileToUpload">
    </div>
</div>

      <!--NAME-->
      <div class="form-group">
        <label  class="col-sm-3 control-label">First Name</label>
        <div class="col-sm-6">
        <input class="form-control" id="firstname" name="first_name" type="text">
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-3 control-label">Last Name</label>
        <div class="col-sm-6">
        <input class="form-control" id="lastname" name="last_name" type="text">
        </div>
      </div>

      <!--PHONE NUMBER-->
      <div class="form-group">
        <label  class="col-sm-3 control-label">Phone Number</label>
        <div class="col-sm-6">
        <input class="form-control" id="phone_num" name="phone_number" type="text">
        </div>
      </div>

     <!--HOMETOWN-->
      <div class="form-group">
        <label  class="col-sm-3 control-label">Hometown</label>
        <div class="col-sm-6">
        <input class="form-control" id="hometown" name="hometown" type="text">
        </div>
      </div>

 <!--MARITAL_STATUS-->
      <div class="form-group">
        <label  class="col-sm-3 control-label">Marital Status</label>
        <div class="col-sm-6">
       <select class="form-control" name="marital_status" id="status">
      <option>Single</option>
      <option>Engaged</option>
      <option>Married</option>
      </select>
      </div>
      </div>

<!--ABOUT ME-->
      <div class="form-group">
        <label  class="col-sm-3 control-label">About You</label>
        <div class="col-sm-6">
        <textarea class="form-control" id="about_me" name="about_me" type="text" >
        </textarea>
        </div>
      </div>
<!--BUTTON-->

      <label  class="col-sm-3 control-label"></label>
      <input type="submit" class="col-sm-6 btn btn-success" id="edit"  name="edit" value="Save Changes" >

<br>
<br>
</form>

<!--REMOVE PICTURE-->
    <form role="form" action="removepic.php" id="form" method="post" >
    <div class="form-group">
    <label class="col-sm-3 control-label"></label>
    <div class="col-sm-6">
     <input type="submit" class="btn btn-danger btn-block" name="remove" id="fileToUpload" value="Remove Profile Picture?">
    
    </div>
    </div>
    </form>

</div>
</div>
</div>
</body>
</html>
