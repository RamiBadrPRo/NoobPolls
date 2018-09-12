<?php
include "phpserver.php";
include "getIp.php";
$username = $_POST["user"];
$ip = getUserIP();
if(!empty($username)) {
  //reconfirming if ip is already registered
  $sqlPrep = $conn->query("select Count(*) as cnt FROM ip where IP='$ip';");
  $ipAvail = $sqlPrep->fetchall();
  if($ipAvail["cnt"] == 0) {
    //Registering Ip and binding it to a username
    $addIPData = $conn->prepare("INSERT INTO ip values(NULL,:i,:u);");
    $addIPData->execute(Array(
      ":i" => $ip,
      ":u" => $username
    ));
  }
}
if(!isset($_COOKIE["username"])) {
  //Setting Username cookie
  setcookie("username",$username,time() + (86400*3),'/');
}
header("Location: vote.html")
?>