<?php
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>

<!-- TODO: WE NEED TO GET THE USER'S ID SO THAT WE CAN CHECK WHETHER IT EXISTS IN THE SECRET SANTA GROUP TABLE AS AN ORGANIZER -->
<body>

    <!-- 1. Button to Create -->

    <button type="button" onClick="createGroup(); this.style.display = 'none'">CREATE</button>
    <?php 
        $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
        // NEED TO STORE ORGANIZER ID IN A VARIABLE
        $sql = "SELECT COUNT(organizerId) FROM SecretSantaGroup";
        $doesOrganizerExist = $db->query($sql);
        if($doesOrganizerExist > 0) {
            echo "You cannot organize two Secret Santa events.";
        }
        else {
        ?>
            <div id="createButton" style="display:none">
                <form action="createLanding.php" method="post">
                    <label for="groupName">Group Name:</label>
                    <input type="text" id="groupName" name="groupName"><br><br>

                    <label for="priceRange">Price Range ($1-$100):</label>
                    <input type="number" id="priceRange" name="priceRange" min="1" max="100"><br><br>

                    <label for="date">Date of Secret Santa Event:</label>
                    <input type="date" id="date" name="date" min="1" max="100"><br><br>
                    
                    <button type="submit" name="submit">Register Now</button>
                </form>
            </div>  
        <?php }
    ?>

    <!-- 2. Button to Join -->
    <button type="button" onClick="joinGroup(); this.style.display = 'none'">JOIN</button>

    <div id="joinButton" style="display:none">
        <form action="joinLanding.php" method="post">
            <label for="groupID">Secret Santa Group Code:</label>
            <input type ="text" id="groupID" name="groupID"><br><br>

            <button type="submit" name="submit">Enter Group</button>
        </form>
    </div>


<!-- 
    TODO:
            - PROMPT USER TO ENTER GROUP ID
            - CHECK DATABASE IF GROUP ID EXISTS
            - IF SO, REDIRECT TO THE LANDING PAGE -->


    <script>
        function createGroup() {
            // display questions for organizer to answer
            document.getElementById('createButton').style.display='block';
        }
        function joinGroup() {
            // TODO: prompt participant for groupID
            document.getElementById('joinButton').style.display='block';
        }
    </script>

</body>

<?php 
include "footer.php";
?>

