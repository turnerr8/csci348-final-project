<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

session_regenerate_id();
include 'head.php';
include 'commonvars.php';
include 'nav.php';
?>

<?php
$_SESSION['signed_in'] = false;
$_SESSION['fName']    = "";
$_SESSION['lName']  = "";
$_SESSION['userId'] = 0;
session_destroy();
                
echo 'You have signed out. <br>';
include 'footer.php';
?>