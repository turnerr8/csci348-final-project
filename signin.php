<?php 
include 'head.php';
include 'commonvars.php';
include 'nav.php';
?>

<body>
    <style>
        .main-content{
            padding:0;
            
        }
    </style>


        <div class="main-content">

            <div class="banner">
                <h1>Sign in</h1>
            </div>
            
            <?php
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
                {
                    echo 'You are already signed in.<br>';
                    echo '<br><a href="page.php">Home</a><br>';
                    echo '<a href="signout.php">Sign out</a><br>';
                }
                else
                {

                    echo '<form method="post" action="signedin.php">
                        <input type="hidden" name="activity" value="signin">
                        <label>Username <br><input type="text" name="user_name" placeholder="Enter your username..."></label>
                        <br>
                        <label>Password <br> <input type="password" name="user_pass" placeholder="Enter your password..."></label>
                        <br>
                        <input class="main-button" "type="submit" value="Sign in" />
                        </form>';
                }


            ?>

        </div>




    </div> 
</body>

<?php
include "footer.php";
?>





