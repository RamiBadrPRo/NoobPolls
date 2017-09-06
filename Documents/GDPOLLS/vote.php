<?php 
include "phpserver.php";
include "getIp.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Send vote
$voteDATA = $_POST["choiceId"];
$timeCurr = date(DATE_RFC850);
$ipADR = getUserIP();
if(isset($_COOKIE["username"]) && !alreadyVoted($voteDATA,$conn)) {
	$sqlInsertVote = $conn->prepare("INSERT INTO votescasted values(NULL,:choice,:ipADR,:user,:time);");
	$sqlInsertVote->execute(Array(
		":choice"=>$voteDATA,
		":ipADR"=>$ipADR,
		":user"=>$_COOKIE["username"],
		":time"=>$timeCurr
		));
	echo "success";
}
function alreadyVoted($a,$b) {
	//get Casted votes
	$sqlFetch = $b->query("SELECT * FROM votescasted WHERE IP = '".getUserIP()."';");
	$VotesCasted = $sqlFetch->fetchall();
	$voted = false;
	foreach($VotesCasted as $li) {
		if($li["choiceId"] == $a) {
			$voted = true;
		}
	}
	return $voted;
}
?>