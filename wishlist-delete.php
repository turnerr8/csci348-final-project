<?php
include 'commonvars.php';
$db = new PDO($databaseConnection, $databaseUname, $databasePassword);

if($_GET['itemId']){
    $itemId = $_GET['itemId'];
}
$sql = "DELETE FROM WishList WHERE itemId = '$itemId'";
$db->query($sql) or die(mysqli_errno($db));
header("location: wishlist.php");
?>
