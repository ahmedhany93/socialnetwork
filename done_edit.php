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

// EDIT EXCEPT PASSWORD AND PROFILE PIC ----------------------------------------------------------
if(isset($_POST['edit'])){

$sql = "UPDATE member SET";
$comma = " ";
$whitelist = array(
    'email',
    'first_name',
    'last_name',
    'phone_number',
    'hometown' ,
    'about_me' ,
    'marital_status' ,
);

foreach($_POST as $key => $val) {
    if( ! empty($val)  && in_array($key, $whitelist)) {
        $sql .= $comma . $key . " = '" . mysqli_real_escape_string($conn,trim($val)) . "'";
        $comma = ", ";
    }
}

$sql = $sql . " WHERE member_id = '".$id."' ";

if($query=mysqli_query($conn,$sql))
 {
echo "Editing..... <br>";
//echo ' <meta http-equiv="refresh" content="1;url=profile.php" />';
 } else {
   echo"error <br/>" .$sql. "<br>" .mysqli_error($conn);
 }
}
// END ---------------------------------------------------------------------------------------------------

// PASSWORD ---------------------------------------------------------------------------------------------------
$password = $_POST['psw'];

if($password != null){
$sql2 = "UPDATE member SET password = md5('$password') WHERE member_id = '$id'";

if($query=mysqli_query($conn,$sql2))
 {
echo "Editing password..... <br>";
//echo ' <meta http-equiv="refresh" content="1;url=profile.php" />';
 } else {
   echo"error <br/>" .$sql2. "<br>" .mysqli_error($conn);
 }
}
// END OF PASSWORD ---------------------------------------------------------------------------------------------

// PROFILE PICTURE ---------------------------------------------------------------------------------------------
$target_file="";
$uploadOk = 0;


echo $_FILES["fileToUpload"]["name"];
echo $_FILES["fileToUpload"]["name"];
$f = $_FILES["fileToUpload"]["name"];

if(isset($_FILES["fileToUpload"]["name"])){

echo "hereeee";

if(  strlen( $f )> 0  )   {

    echo $f;
    $uploadOk = 1;
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //$target_file = $target_dir . $_POST["fileToUpload"];

    $myFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    echo "type".$myFileType;

//upload file , else no file. 
// Allow certain file formats
if($myFileType != "jpg" && $myFileType != "png" && $myFileType!= "JPG"  && $myFileType != "PNG") {
echo "data type error:  ". $myFileType ." <br>";
    $uploadOk = 0;
}

if($uploadOk==1){

     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
       
    } else {
        echo "Sorry, there was an error uploading your file.";
        $uploadOk=0;
    }

}else{
 echo "Sorry,the file was not uploaded successfully";
}


}else {
  //no file uploaded
  echo "<br>"."  f=:".$f."<br>";
}

//upload done OR no file

if($uploadOk==1){

$image = addslashes(file_get_contents( $target_file));

$sql3 = "UPDATE member SET profile_pic = '$image' WHERE member_id = '$id'";



if($query=mysqli_query($conn,$sql3))
 {
echo "Editing profile_pic..... <br>";
//echo ' <meta http-equiv="refresh" content="0;url=profile.php" />';
 } else {
   echo"errorrrrrrrrrrrrrrrr <br/>" .$sql3. "<br>" .mysqli_error($conn);
 }

$caption="Profile Picture Updated";
$ispublic="true";
 $sqlinsert = "INSERT INTO `post`(`member_id`, `caption`, `image`, `is_public`) VALUES ('$id','$caption','{$image}','$ispublic')";

$query=mysqli_query($conn,$sqlinsert);

}else {
//do nothing
}



}
// END OF PROFILE PICTURE ----------------------------------------------------------------------------

header('Location: ' .'profile.php');

?>