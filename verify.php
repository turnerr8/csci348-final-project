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
      <p class="message">Please <a href="register.php"><button type="button">go back</button></a> and include a first <em>and</em> last name.</p>
      <?php
      }

      else if(strcmp($password, $passwordagain) != 0) {
      ?>
      <p class="message">Please <a href="register.php"><button type="button">go back</button></a> and ensure both passwords are the same.</p>
      <?php
      } else {
        $pw = password_hash($password, PASSWORD_DEFAULT);
        ?>
          <h1> Your Registration was Successful!</h1>
          <p class="message" style="color: #63000c;"> Welcome to <i>Silent Elves</i> <br></p>
          <p class="message"> We are so excited you are here! <br>Have a jolly holiday!</p>
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
        $querySQL = "SELECT * FROM turnerr8_final_project.Users WHERE email='$email'";
        $rows = $db->query($querySQL);
        $userId=0;
        foreach($rows as $row){
          $userId=$row['userId'];
        }
        //SESSIONS
        $_SESSION['fName']=$fname;
        $_SESSION['lName']=$lname;
        $_SESSION['userId']=$userId;
        echo $userId;

      }
    }
    ?>

</body>

<?php 
include 'footer.php'
?>