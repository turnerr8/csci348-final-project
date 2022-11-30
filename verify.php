<?php 
include 'head.php';
include 'commonvars.php';
include 'nav.php';
?>
<body>

<div id="display">
  <?php 
  if(isset($_POST["submit"])) {

    $fname = $_REQUEST["fname"];
    $lname = $_REQUEST["lname"];
    $email = $_POST["email"];

    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordagain = $_POST["passwordagain"];

    // Server side validation is required at least once
    if(!$fname || !$lname) {
    ?>
    <h4>Please <a href="register.php"><button type="button">go back</button></a> and include a first <em>and</em> last name.</h4>
    <?php
    }

    else if(strcmp($password, $passwordagain) != 0) {
    ?>
    <h4>Please <a href="register.php"><button type="button">go back</button></a> and ensure both passwords are the same.</h4>
    <?php
    } else {
      $pw = password_hash($password, PASSWORD_DEFAULT);
      ?>
        <h3>Registration Successful! Have a jolly holiday!</h3>
      </div>

      <?php
      // TODO: RYAN NEEDS ^do i NEED to Madeline??^ TO STORE THESE VALUES IN USER TABLE
      try
        {
            $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
        }
        catch (PDOException $e)
        {
            exit('Error: could not establish database connection');
        }

        
      $sql = "INSERT INTO turnerr8_final_project.Users (username, password, email, firstName, lastName) VALUES ('$username', '$pw', '$email', '$fname', '$lname');";
        $db->query($sql);
    }
  }
  ?>

</body>

<?php 
include 'footer.php'
?>