<!DOCTYPE html>
<html>
<head>
  <title></title>
<style type="text/css">
  body{

    padding-top: 80px;
  }

</style>
</head>
</html>

<nav class="navbar navbar-default navbar-fixed-top">
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
  FROM member WHERE member.member_id=$mem_id") or die(mysql_error());

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
               </span>
                  </div>
            </div>
            </div>
      </form>

 <?php if ($member == $mem_id) : ?>
      <form class="navbar-form navbar-right" action="editprofile.php">
        <button class = "btn btn-warning" type = "submit">
                     Edit Profile
                  </button>
      </form>

<?php endif; ?>

 <?php if ($member != $mem_id) : ?>


<form action="profile.php" class="navbar-form navbar-right" method="post">
        <div class="form-group">
         <input type="submit" class="btn btn-info"  value="View Your Profile"  >
        </div>
      </form>

<?php endif; ?>
 <form class="navbar-form navbar-right" action="friends.php">
        <button class = "btn btn-default" type = "submit">
                     Friends
                  </button>
      </form>
	  
	   <form class="navbar-form navbar-right" action="friendsreq.php">
        <button class = "btn btn-default" type = "submit">

                     <?php 

                

$query=mysqli_query($conn,"SELECT COUNT(friend_req.req_mem_id) as requests
FROM friend_req
Where friend_req.req_mem_id ='$mem_id'
GROUP BY friend_req.member_id;") or die(mysql_error());
$no = 0;
WHILE ($rows = mysqli_fetch_array($query)){
$no = $rows['requests'];

}
echo "Requests ";
echo "<span class=\"badge\"> \n"; 
echo $no;
echo "</span></a>\n";

 ?>
                  </button>

      </form>
	  
    </div>

  </div>
</nav>
    <!-- EDN OF NAVBAR -->