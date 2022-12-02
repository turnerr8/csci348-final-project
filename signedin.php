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
            height: 50em;
            
        }
    </style>


        <div class="main-content">

            <div class="banner">
                
            </div>


            <?php
                if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
                    echo '<p class="message>You are already signed in.</p><br>';
                    echo '<br><a href="index.php">Home</a><br>';
                    echo '<a href="signout.php">Sign out</a><br>';
                }
                else { 
                    $activity = ""; 
                    if (isset($_REQUEST['activity'])) {
                        $activity = $_REQUEST['activity'];
                    }
                    if ($activity == "signin") {
                        if (isset($_REQUEST['user_name'])) {
                            $name = $_REQUEST['user_name'];
                        }
                        if (isset($_REQUEST['user_pass'])) {
                            $pass = $_REQUEST['user_pass'];
                        }
                        if (empty($name) || empty($pass)) {
                            echo '<h1> Silly Elf! You need to login first!</h1> <br>';
                            echo '<p class="message">Please <a href="signin.php"><button class="main-button" type="button">go back</button></a> and provide a username <em>and</em> password.</p>';
                        }
                        else
                        {
                            $query = "SELECT user_id, user_name, user_level, user_pass FROM users" . 
                                            " WHERE user_name = '$name';";
                            $rows = $db->query($query);
                            if($rows->rowCount() == 0) {
                                echo '<p class="message">Something went wrong while signing in. Please try again. </p>';
                            }
                            else {
                                $rowAry = $rows->fetch(PDO::FETCH_ASSOC);
                                
                                //if ($pass != $rowAry['user_pass'])  <—- wrong, password in DB is hashed
                                if((password_verify($pass, $rowAry['user_pass']) == false) ||
                                    (count($rowAry) == 0) || 
                                    ($rowAry == null))
                                {
                                    echo '<p class="message">You have supplied a wrong user/password combination. Please try again.</p>';
                                }
                                else {
                                    // session_regenerate_id();
                                    $_SESSION['signed_in'] = true;
                                    $_SESSION['user_id']    = $rowAry['user_id'];
                                    $_SESSION['user_name']  = $rowAry['user_name'];
                                    $_SESSION['user_level'] = $rowAry['user_level'];
                                    
                                    echo '<p class="message"> Welcome, ' . $_SESSION['user_name'] . '</p>.<br>';
                                    echo '<br><a href="page.php">Home</a><br>';
                                    echo '<a href="signout.php">Sign out</a><br>';
                                }
                            }
                        }       
                        
                    }
                }

            ?>






            
            

        </div>




    </div> 
</body>

<?php
include "footer.php";
?>







