<?php
session_start ();
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>

<!-- TODO: WE NEED TO MAKE IT SO THAT IF A USER CLICKS 'CREATE' THE JOIN OPTION HIDES -->
<body>

    <!-- 1. Button to Create -->

    <button type="button" onClick="createGroup(); this.style.display = 'none'">CREATE</button>
    <?php 
        $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
    ?>
    <div id="createButton" style="display:none">
        <?php
            // Check if the user is already in a group
            if(isset($_SESSION['groupId'])){
                echo "You cannot participate in more than 1 Secret Santa events.";
            }
            // Check if the user is already an organizer
            else {
                $organizerId = $_SESSION['userId'];
                $sql = "SELECT organizerId FROM SecretSantaGroup WHERE organizerId LIKE $organizerId;";
                $stmt = $db->query($sql);
                $doesOrganizerExist = $stmt->rowCount();
                if($doesOrganizerExist > 0) {
                    echo "You cannot organize two Secret Santa events.";
                }
                else {
                    // User is not already in a group and has not already created a group
        ?> 
                    <form action="createLanding.php" method="post">
                        <label for="groupName">Group Name:</label>
                        <input type="text" id="groupName" name="groupName"><br><br>

                        <label for="priceRange">Price Range ($1-$100):</label>
                        <input type="number" id="priceRange" name="priceRange" min="1" max="100"><br><br>

                        <label for="date">Date of Secret Santa Event:</label>
                        <input type="date" id="date" name="date" min="1" max="100"><br><br>
                        
                        <button type="submit" name="submit">Create Group</button>
                    </form>
            <?php 
                    } 
                }
            ?> 
    </div>  

    <!-- 2. Button to Join -->
    <button type="button" onClick="joinGroup(); this.style.display = 'none'">JOIN</button>

    <div id="joinButton" style="display:none">
        <form action="joinLanding.php" method="post">
            <label for="groupID">Secret Santa Group Code:</label>
            <input type ="text" id="groupID" name="groupID"><br><br>

            <button type="submit" name="submit">Enter Group</button>
        </form>
    </div>

    <script>
        function createGroup() {
            // display questions for organizer to answer
            document.getElementById('createButton').style.display='block';
        }
        function joinGroup() {
            // TODO: prompt participant for groupID
            document.getElementById('joinButton').style.display='block';
        }

        function hideButton() {

        }
    </script>

</body>

<?php 
include "footer.php";
?>

