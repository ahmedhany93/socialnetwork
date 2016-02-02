 <?php 

include("connect.php");


if(isset($_POST['myID'])){
$myID = $_POST["myID"];

$hisID = $_POST["hisID"];






$sql= "INSERT INTO `friend_req`(`member_id`, `req_mem_id`, `req_date`) VALUES ('$myID','$hisID',CURRENT_TIMESTAMP)";
$sql2= "INSERT INTO `notification_add`(`adder_id`, `added_id`) VALUES ('$myID','$hisID');";


$query2=mysqli_query($conn,$sql2);

if($query=mysqli_query($conn,$sql))
 {
echo "1";
 }else{
   echo"0 error <br/>" .$sql. "<br>" .mysqli_error($conn);
 }


 echo ' <meta http-equiv="refresh" content="0;url=profile.php?ID=$hisID" />';

}else{

	 echo ' <meta http-equiv="refresh" content="0;url=profile.php" />';
}

  ?>