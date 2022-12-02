<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include 'head.php';
?>

<!--  nav-->   
<div class="wrapper1">

<header class ="logo"> Silent Elves </header>

<nav class ="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="wishlist.php">Wishlist</a></li>
        <li><a href="santa.php">Secret Santa</a></li>
    </ul>
</nav>

<nav class="side-nav">
    <!--Add sessions of signed in signed out-->
    <?php
    if(!isset($_SESSION['userId'])){
        ?>
    <ul>
        <li class="item1"><a href="signin.php">Sign In</a></li>
        <li class="item2"><a href="register.php">Sign Up</a></li>
    </ul>
    <?php
    } else {
    ?>
    <ul>
        <li class="item3"><?=$_SESSION["fName"]?></li>
        <li class="item2"><a href="signout.php">Sign Out</a></li>
    </ul>
    <?php
    }

    ?>

</nav>