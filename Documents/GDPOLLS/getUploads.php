<?php
include "phpserver.php";
//getUploads : get all upload entries
$getUploads = $conn->query("SELECT * FROM upload;");
$jsonDATA = $getUploads->fetchall();
echo json_encode($jsonDATA);
?>