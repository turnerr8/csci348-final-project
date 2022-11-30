<?php 
include 'head.php';
?>

<body>
    <!--  nav-->

    
    <div class="wrapper1">

        <header class ="logo"> Christmas Website </header>

        <nav clas ="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="">Wishlist</a></li>
                <li><a href="santa.php">Secret Santa</a></li>
            </ul>
        </nav>

        <div class="side-nav">
            <ul>
                <li class="item1"><a href="signin.php">Sign In</a></li>
                <li class="item2"><a href="register.php">Sign Up</a></li>
            </ul>

        </div>


        <div class="main-content">
            
            <?php
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
                {
                    echo 'You are already signed in.<br>';
                    echo '<br><a href="page.php">Home</a><br>';
                    echo '<a href="signout.php">Sign out</a><br>';
                }
                else
                {
                    echo '<h3>Sign in</h3>';
                    echo '<form method="post" action="signedin.php">
                        <input type="hidden" name="activity" value="signin">
                        <label>Username: <input type="text" name="user_name"></label>
                        <br>
                        <label>Password: <input type="password" name="user_pass"></label>
                        <br>
                        <input type="submit" value="Sign in" />
                        </form>';
                }


            ?>

        </div>

        <div class = "footer">
            <?php
            include 'footer.php';
            ?>
        </div>




    </div>
    

    
</body>







