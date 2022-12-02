<?php
session_start();
include 'commonvars.php';
$db = new PDO($databaseConnection, $databaseUname, $databasePassword);
$groupId;

if($_GET['groupId']){
    $groupId = $_GET['groupId'];
}


$sql = "SELECT * FROM SecretSantaGroup JOIN SecretSantaUser ON (SecretSantaGroup.groupId = SecretSantaUser.groupId) WHERE groupId LIKE '$groupId'";

$rows = $db->query($sql);

$numPeople = $rows->rowCount();
$people [$numPeople];
$i = 0;


foreach($rows as $row){
    $people[$i] = $row['userId'];
    $i++;
}

for($j = 0; $j <= $i; $j++){
    $me = $people[$j];
    if($j<i) {
        $myPerson = $people[$j+1];
    } else {
        $myPerson = $people[0];
    }
    $sqlModify = "UPDATE SecretSantaUser SET whoIHave = '$myPerson' WHERE userId = '$me'";
    $db->query($sqlModify);

}

//update hasBeen generated
$sqlGenerated = "UPDATE SecretSantaGroup SET `generated` = '1' WHERE groupId = '$groupId'";




?>