<?php
    include 'commonvars.php';

    $db = new PDO($databaseConnection, $databaseUname, $databasePassword);

    //THIS NEEDS TO TURN INTO  SESSION[USERID]
    $myUserId = 1;

    if(isset($_POST['itemName'])) {
        $itemName =$_POST['itemName'];
        echo $itemName;

    }
    
    if(isset($_POST['itemLink'])) {
        $itemLink = $_POST['itemLink'];
        echo $itemLink;

    }

    
    $sql = "INSERT INTO turnerr8_final_project.WishList (userId, itemName, itemLink, hasBeenBought, boughtByUserId) VALUES ('$myUserId', '$itemName', '$itemLink', NULL, NULL);";
    //"INSERT INTO turnerr8_final_project.WishList (userId, itemName, itemLink) VALUES ($myUserId, $itemName, $itemLink, NULL, NULL);";

    $db->query($sql);


?>