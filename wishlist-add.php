<?php

    include 'commonvars.php';
    $myUserId = 1;
    if(isset($_POST['itemName'])) {
        $itemName =$_POST['itemName'];
    }
    
    if(isset($_POST['itemLink'])) {
        $itemLink = $_POST['itemLink'];
    }

    $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
    $sql = "INSERT INTO turnerr8_final_project.WishList (userId, itemName, itemLink) VALUES ($myUserId, $itemName, $itemLink);";

    $db->query($sql);


?>