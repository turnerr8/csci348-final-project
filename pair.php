<?php
session_start();
include "head.php";
include "nav.php";
include 'commonvars.php';
$db = new PDO($databaseConnection, $databaseUname, $databasePassword);
$groupId = 0;

if(isset($_SESSION['groupId'])){
    $groupId = $_SESSION['groupId'];
    echo $groupId;
}


$sql = "SELECT * FROM SecretSantaGroup JOIN SecretSantaUser ON (SecretSantaGroup.groupId = SecretSantaUser.groupId) WHERE SecretSantaGroup.groupId LIKE $groupId;";

$rows = $db->query($sql);

$numPeople = $rows->rowCount();
$people = [$numPeople];
$i = 0;


foreach($rows as $row){

    if($row['organizerId']!=$_SESSION['userId']) {
        error();
        break;
    }
    $people[$i] = $row['userId'];
    $i++;
}

for($j = 0; $j <= $i; $j++){
    $me = $people[$j];
    if($j<$i) {
        $myPerson = $people[$j+1];
    } else {
        $myPerson = $people[0];
    }
    $sqlModify = "UPDATE SecretSantaUser SET whoIHave = '$myPerson' WHERE userId = '$me'";
    $db->query($sqlModify);

}

//update hasBeen generated
$sqlGenerated = "UPDATE SecretSantaGroup SET `generated` = '1' WHERE groupId = '$groupId'";
echo "Your group has successfully been closed.";

function error(){
    echo "You must be the organizer to close this Secret Santa group.";
}


?>