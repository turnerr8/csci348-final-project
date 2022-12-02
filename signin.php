<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

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
                
            </div>
            
            <?php
                

                    echo '<form id="sign-in-form" method="post" action="signedin.php">
                        <fieldset>
                            <br>
                            <legend>Sign In</legend>
                            <input type="hidden" name="activity" value="signin">
                            <label>Username</label> <br>
                            <input type="text" name="user_name" placeholder="Enter your username...">
                            <br>
                            <label>Password</label> <br> 
                            <input type="password" name="user_pass" placeholder="Enter your password...">
                            <br>
                            <button class="main-button" "type="submit" value="Sign in"> Sign In </button>
                        </fieldset>
                        </form>';
                //}


            ?>

        </div>




    </div> 
</body>

<?php
include "footer.php";
?>





