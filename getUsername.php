<?php
include "phpserver.php";
include "getIP.php";
//getUsername : Basically, if a user comes back and has already had register a username under his IP, but his cookie got deleted, it will be reinstated
$ip_ADDR = getUserIP();
$getUser = $conn->query("SELECT * FROM ip WHERE IP = '$ip_ADDR';");
$res = $getUser->fetchall();
if(strlen($res[0][2]) > 0) {
  echo $res[0][2];
}
else {
  echo "USER_NOT_FOUND";
}
?>