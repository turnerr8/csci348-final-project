<?php
include 'commonvars.php';
$db = new PDO($databaseConnection, $databaseUname, $databasePassword);

if($_GET['itemId']){
    $itemId = $_GET['itemId'];
}
if($_GET['boughtBy']){
    $boughtBy = $_GET['boughtBy'];
}
$sql = "UPDATE WishList SET hasBeenBought = '1', boughtByUserId ='$boughtBy'  WHERE itemId = '$itemId'";
$db->query($sql) or die(mysqli_errno($db));
header("location: wishlist.php");





//UPDATE `turnerr8_final_project`.`WishList` SET `hasBeenBought` = '1', `boughtByUserId` = '5' WHERE (`itemId` = '1');

?>

