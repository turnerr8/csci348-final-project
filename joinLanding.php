<?php
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>
<body>

<!-- TODO:
- DISPLAY 
Group name
Price range
Countdown to day of event
Which person the user should buy for -->

    <?php 
        if(isset($_POST["submit"])) {
            $groupID = $_REQUEST["groupID"];

            try
            {
                $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
            }
            catch (PDOException $e)
            {
                exit('Error: could not establish database connection');
            }

            // $sql = "INSERT INTO turnerr8_final_project.Users (username, password, email, firstName, lastName) VALUES ('$username', '$pw', '$email', '$fname', '$lname');";
            // $db->query($sql);

            $sql = "SELECT count(groupID) FROM SecretSantaUser";
            $doesGroupIDExist = $db->query($sql);

            if($doesGroupIDExist <= 0) {
                echo "Please enter valid secret santa group code";
            }
            else{
                $sql = "SELECT groupName FROM SecretSantaGroup WHERE groupID=$groupID";
                $groupName = $db->query($sql);
    
                $sql = "SELECT priceRange FROM SecretSantaGroup WHERE groupID=$groupID";
                $price = $db->query($sql);
    
                $sql = "SELECT date FROM SecretSantaGroup WHERE groupID=$groupID";
                $date = $db->query($sql);

                echo "Welcome to the $groupname Secret Santa";
                echo "<br><br>";
                echo "This secret santa event ends on $date";
                echo "<br><br>";
                echo "The price range is $price";
                echo "<br><br>";

            }

        }

    ?>

</body>
<?php 
include "footer.php";
?>