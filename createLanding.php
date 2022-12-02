<?php
session_start ();
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>
<body>

    <style>
        .main-content{
            padding:0;
            
        }
    </style>
    <!-- https://www.geeksforgeeks.org/generating-random-string-using-php/ -->
    <?php
        function getCode() {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < 6; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            return $randomString;
        }
    ?>

    <div class="main-content">
            <div class="banner">
                
            </div>



    

        <?php 
            if(isset($_POST["submit"])) {
                $groupName = $_REQUEST["groupName"];
                $priceRange = $_REQUEST["priceRange"];
                $date = $_REQUEST["date"];
                $groupId = getCode();
                $_SESSION['groupId']=$groupId;
                if(isset($_SESSION['userId'])){
                    $organizerId = $_SESSION['userId'];
                }

                try
                {
                    $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
                }
                catch (PDOException $e)
                {
                    exit('Error: could not establish database connection');
                }
                
                $sql = "INSERT INTO turnerr8_final_project.SecretSantaGroup (groupId, groupName, eventDate, priceRange, organizerId, `generated`) VALUES ('$groupId','$groupName', '$date', '$priceRange', '$organizerId', '0');";
                $db->query($sql);
            }
        ?>
        <div class="message">
            <p>You have successfully created a Secret Santa group!</p>
        </div>
        <div id="dashboard">
            <h5 class="dashboard-element">Your Group Name: <br><em><?php echo $groupName ?></em></h5>
            <h5 class="dashboard-element">Your Price Range: $0-$ <br><em><?php echo $priceRange ?></em></h5>
            <h5 class="dashboard-element">Your Event will take place on: <br><em><?php echo $date ?></em></h5>
            <h5 class="dashboard-element">To invite friends to this Secret Santa group, provide your Group Code:<br> <br><em id="code"><strong><?php echo $groupId ?></strong></em> </h5>

        </div>
        
    </div>
</body>

<?php 
include "footer.php";
?>