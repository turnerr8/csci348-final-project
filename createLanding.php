<?php
session_start ();
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>
<body>
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
            
            $sql = "INSERT INTO turnerr8_final_project.SecretSantaGroup (groupId, groupName, eventDate, priceRange, organizerId, `generated`) VALUES ('$groupId','$groupName', '$date', '$priceRange', '$organizerId', '1');";
            $db->query($sql);
        }
    ?>
    <h3>You have successfully created a Secret Santa group!</h3>
    <h5>Your Group Name: </h5><em><?php echo $groupName ?></em>
    <h5>Your Price Range: $0-$</h5><em><?php echo $priceRange ?></em>
    <h5>Your Event will take place on: </h5><em><?php echo $date ?></em>
    <h5>To invite friends to this Secret Santa group, provide your Group Code: </h5><em><strong><?php echo $groupId ?></strong></em>
</body>

<?php 
include "footer.php";
?>