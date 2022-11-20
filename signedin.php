<?php
session_start ();
include 'commonvars.php';
?>

<?php
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo 'You are already signed in.<br>';
    echo '<br><a href="page.php">Home</a><br>';
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
            echo '<h4>Please <a href="signin.php"><button type="button">go back</button></a> and provide a username <em>and</em> password.</h4>';
        }
        else
        {
            $query = "SELECT user_id, user_name, user_level, user_pass FROM users" . 
                            " WHERE user_name = '$name';";
            $rows = $db->query($query);
            if($rows->rowCount() == 0) {
                echo 'Something went wrong while signing in. Please try again.';
            }
            else {
                $rowAry = $rows->fetch(PDO::FETCH_ASSOC);
                
                //if ($pass != $rowAry['user_pass'])  <—- wrong, password in DB is hashed
                if((password_verify($pass, $rowAry['user_pass']) == false) ||
                    (count($rowAry) == 0) || 
                    ($rowAry == null))
                {
                    echo 'You have supplied a wrong user/password combination. Please try again.';
                }
                else {
                    // session_regenerate_id();
                    $_SESSION['signed_in'] = true;
                    $_SESSION['user_id']    = $rowAry['user_id'];
                    $_SESSION['user_name']  = $rowAry['user_name'];
                    $_SESSION['user_level'] = $rowAry['user_level'];
                    
                    echo 'Welcome, ' . $_SESSION['user_name'] . '.<br>';
                    echo '<br><a href="page.php">Home</a><br>';
                    echo '<a href="signout.php">Sign out</a><br>';
                }
            }
        }       
        
    }
}
include 'footer.php';
?>