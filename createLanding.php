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
            $organizerId = $_SESSION['userId'];

            echo $groupName . "<br>";
            echo $priceRange . "<br>";
            echo $date . "<br>";
            echo $groupId;

            try
            {
                $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
            }
            catch (PDOException $e)
            {
                exit('Error: could not establish database connection');
            }
            // TODO: WE NEED TO GRAB organizerId AND STORE IT IN VARIABLE SO WE CAN INSERT IT INTO DATABASE
            
            // $sql = "INSERT INTO turnerr8_final_project.SecretSantaGroup (eventDate, generated, groupId, groupName, organizerId, priceRange) VALUES ('$date', 1, '$groupId', '$groupName', '$organizerId', '$priceRange');";
            // $sql = "INSERT INTO turnerr8_final_project.SecretSantaGroup (groupId, groupName, eventDate, priceRange, organizerId, generated) VALUES ('$groupId','$groupName', '$date', '$priceRange', '$organizerId', '1');";
            // $statement = $db->prepare($sql);
            // $statement->execute($sql);
            
            $sql = "INSERT INTO turnerr8_final_project.SecretSantaGroup (groupId, groupName, eventDate, priceRange, organizerId, generated) VALUES (?, ?, ?, ?, ?, ?)";
            $statement = $db->prepare($sql);
            $statement->execute([$groupId, $groupName, $date, $priceRange, $organizerId, '1']);
        }
    ?>
</body>

<?php 
include "footer.php";
?>