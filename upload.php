<?php
include "phpserver.php";
$target_dir = "competition/";
$target_file = $target_dir . basename($_FILES["logo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$user = $_POST["user"];
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    }
    else {
      changeHeader(0);
      $uploadOK = 0;
    }
}

if(!isset($user) OR empty($user)){
  changeHeader(1);
  $uploadOk = 0;
}
if (file_exists($target_file)) {
    changeHeader(2);
    $uploadOk = 0;
}
if ($_FILES["logo"]["size"] > 2000000) {
    changeHeader(3);
    $uploadOk = 0;
}
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif") {
    changeHeader(4);
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    changeHeader(5);
}
else {
  if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
    $sqlSend = $conn->prepare("INSERT into upload values(NULL,:tf,:user);");
    $sqlSend->execute(Array(
      ":tf"=>$target_file,
      ":user"=>$user
      ));
      changeHeader(6);
      echo"kjlg";
  } else {
      changeHeader(5);
  }
}
function changeHeader($a) {
  header("Location: upload.html?output=".$a);
  die();
}
?>