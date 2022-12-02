<?php
session_start ();
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>
<body>
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

            if(isset($_SESSION['groupId'])){
                //checks to see if that groupID user entered exits
                $sql = "SELECT groupId FROM SecretSantaGroup WHERE groupId LIKE '$groupID';";
                $doesGroupIDExist = $db->query($sql);
                $total = $doesGroupIDExist->rowCount();

                if($total == 0) {
                    echo "Please enter valid secret santa group code";
                }
                else{

                    $sql = "SELECT * FROM SecretSantaGroup WHERE groupId LIKE '$groupID';";
                    $groupInfo = $db->query($sql);
                    $rows = $groupInfo->rowCount();

                    $groupName = 0;
                    $price = 0;
                    $date = 0;
                    
                    foreach($groupInfo as $groupID){
                        $groupName = $groupID["groupName"];
                        $price= $groupID["priceRange"];
                        $date = $groupID["eventDate"];
                        $groupGenerated =  $groupID["generated"];
                    }

                    ?>

                    <!-- display all the information -->
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
                    <?php
                   if($groupGenerated==1){

                    $myPerson;

                    $getMyPerson = "SELECT * FROM SecretSantaUsers WHERE userId = $userID";
                    $row = $db->query($getMyPerson);
                    foreach($row as $r){
                        $myPerson = $r['whoIHave'];

                    }
                    echo "<p> my person: $myPerson";

                   }
                    ?>
                    </div>
                    <?php
                }
            }
            else{
                // Check if user is in group already
                $sql = "SELECT groupId FROM SecretSantaUser WHERE userId = $userID;";
                $stmt = $db->query($sql);
                $isUserInGroup = $stmt->rowCount();
                if($isUserInGroup > 0) {
                    echo "You cannot participate in multiple Secret Santa events.";
                }
                else {
                    //inserting into database
                    $sql = "INSERT INTO turnerr8_final_project.SecretSantaUser (groupId, isReady, userId, whoHasMe, whoIHave) VALUES ('$groupID', '1', '$userID', 'NULL', 'NULL');";
                    $db->query($sql);

                    $_SESSION['groupId']=$groupID;

                    echo "You have successfully joined a Secret Santa group! Please click 'Secret Santa' and 'Join' to view the landing page.";
                }
                

            }

        }

    ?>

</body>
<?php 
include "footer.php";
?>