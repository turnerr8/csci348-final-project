<?php
session_start ();
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
            $userName = $_SESSION["fName"];
            $userID = $_SESSION["userId"];

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
 
            $sql = "SELECT groupId FROM SecretSantaGroup WHERE groupId = $groupID;";
            $doesGroupIDExist = $db->query($sql);
            $total = $doesGroupIDExist->rowCount();

            if($total == 0) {
                echo "Please enter valid secret santa group code";
            }
            else{

                $sql = "SELECT * FROM SecretSantaUser;";
                $groupInfo = $db->query($sql);


                $groupName = 0;
                $price = 0;
                $date = 0;
                

                foreach($groupInfo as $groupID){
                    $groupName = $groupID["groupName"];
                    $price= $groupID["priceRange"];
                    $date = $groupID["eventDate"];
                }

                ?>

                <div class="main-content">
                    <div id="welcome-user">
                        <p>Hello <?php echo "$userName";?>, Welcome back to</p>
                        <br>
                        <p> <?php echo "$groupName"; ?></p>
                        <br>
                        <br>
                    </div>

                    <div id="santa-info">
                        <p>This secret santa group ends on <?php echo "$date"; ?> </p>
                        <br><br>
                        <p> The price range is <?php echo "$price"; ?> </p>
                    </div>
                </div>

                <?php

            }

        }

    ?>

</body>
<?php 
include "footer.php";
?>