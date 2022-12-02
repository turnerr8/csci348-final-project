<?php
session_start();
include 'commonvars.php';
$db = new PDO($databaseConnection, $databaseUname, $databasePassword);
$groupId;

if($_POST['groupId']){
    $groupId = $_POST['groupId'];
}


$sql = "SELECT * FROM SecretSantaGroup JOIN SecretSantaUser ON (SecretSantaGroup.groupId = SecretSantaUser.groupId) WHERE groupId LIKE '$groupId';";

$rows = $db->query($sql);

$numPeople = $rows->rowCount();
$people [$numPeople];
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
    if($j<i) {
        $myPerson = $people[$j+1];
    } else {
        $myPerson = $people[0];
    }
    $sqlModify = "UPDATE SecretSantaUser SET whoIHave = '$myPerson' WHERE userId = '$me';";
    $db->query($sqlModify);

}

//update hasBeen generated
$sqlGenerated = "UPDATE SecretSantaGroup SET `generated` = '1' WHERE groupId = '$groupId';";
echo "Your group has successfully been closed.";

function error(){
    echo "You must be the organizer to close this Secret Santa group.";
}


?>