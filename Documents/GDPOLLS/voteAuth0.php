<?php
//Seeing if ip is already registered in the ip list
include "phpserver.php";
include "getIp.php";
$ip = getUserIP();
$sqlPrep = $conn->query("select Count(*) as cnt FROM ip where ip='$ip';");
$ipAvail = $sqlPrep->fetchall();
if($ipAvail[0]["cnt"] == 1) {
  header("Location: vote.html");
  die();
}
else {
  header("Location: voteAuth.html");
  die();
}
?>