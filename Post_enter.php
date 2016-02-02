<?php
session_start();
$member_id=$_SESSION["S_user_id"];
$target_file="";
$uploadOk = 0;

//test file
$caption = $_POST["caption"];

echo $_FILES["fileToUpload"]["name"];
echo $_FILES["fileToUpload"]["name"];

$ispublic = $_POST["ispublic"];

$f = $_FILES["fileToUpload"]["name"];

if(  strlen( $f )> 0  )   {

echo $f;
$uploadOk = 1;
$target_dir = "img/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
//$target_file = $target_dir . $_POST["fileToUpload"];

$myFileType = pathinfo($target_file,PATHINFO_EXTENSION);

echo "type".$myFileType;
echo $caption;




  //upload file , else no file. 


// Allow certain file formats
if($myFileType != "jpg" && $myFileType != "png" && $myFileType!= "JPG"  && $myFileType != "PNG") {
echo "data type erroeeeer:  ". $myFileType ." <br>";

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

//put data to database....

include("connect.php");



if($uploadOk==1){
$image = addslashes(file_get_contents( $target_file));
$sql = "INSERT INTO `post`(`member_id`, `caption`, `image`, `is_public`) VALUES ('$member_id','$caption','{$image}','$ispublic')";
}else {
//echo "IMAGE %%%%%%%%%%%";
$sql = "INSERT INTO `post`(`member_id`, `caption`, `image`, `is_public`) VALUES ('$member_id','$caption',null,'$ispublic')";

}



if($query=mysqli_query($conn,$sql))
 {

 }else{
   echo"error <br/>" .$sql. "<br>" .mysqli_error($conn);
 }

echo "<br>  <br> You will be redirirected to the main page in 1 secounds  <br> ";
header('Location: ' . $_SERVER['HTTP_REFERER']);
?> 
