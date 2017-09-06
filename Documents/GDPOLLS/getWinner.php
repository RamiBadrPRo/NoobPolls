<?php 
include "phpserver.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//get the winner
$res = [];
$sql = "SELECT `choiceId`
    FROM     `votescasted`
    GROUP BY `choiceId`
    ORDER BY COUNT(*) DESC
    LIMIT    3;";
$sqlFetch = $conn->query($sql);
$sqlReturn = $sqlFetch->fetchall();
//print_r($sqlReturn);
//get his data
$sql2= "SELECT location,user FROM upload WHERE choiceId='$winnerId';";
$sqlFetch2 = $conn->query($sql2);
$sqlReturn2 = $sqlFetch2->fetchall();
//get how many votes he got
$sql3 = "SELECT count(*) as cnt from votescasted where choiceId='22';";
$sqlFetch3 = $conn->query($sql3);
$sqlReturn3 = $sqlFetch3->fetchall();
/*array_push($res,$sqlReturn2[0]["location"],$sqlReturn2[0]["user"],$sqlReturn3[0]["cnt"]);
echo json_encode($res);*/
print_r($sqlReturn3);
?>
