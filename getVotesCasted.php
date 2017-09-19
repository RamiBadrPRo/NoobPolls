<?php
include "phpserver.php";
include "getIp.php";
$IPADR = getUserIP();
$sqlFetch = $conn->query("SELECT * FROM votescasted WHERE IP = '$IPADR';");
$VotesCasted = $sqlFetch->fetchall();
if(empty($VotesCasted)) {
	$res = array();
}
else { $res = $VotesCasted; }
echo json_encode($res);
?>