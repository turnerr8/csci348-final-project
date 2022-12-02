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

<<<<<<< HEAD
<?php
$_SESSION['signed_in'] = false;
$_SESSION['fName']    = "";
$_SESSION['lName']  = "";
$_SESSION['userId'] = 0;
session_destroy();
=======

<body>
    <style>
        .main-content{
            padding:0;
            height: 43.2em;
        }
    </style>

    <div class="main-content">


        <div class="banner">
>>>>>>> 18db50b23627ebda5dbae749908e7f3d10ea4f00
                
        </div>

        <?php
            $_SESSION['signed_in'] = false;
            $_SESSION['user_id']    = "";
            $_SESSION['user_name']  = "";
            $_SESSION['user_level'] = 0;
            session_destroy();
                            
            echo '<p class="message">You have signed out. </p><br>';
            
        ?>

    </div>
</body>

<?php
include 'footer.php';
?>


