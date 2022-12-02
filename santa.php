<?php
session_start ();
include "head.php";
include "nav.php";
require_once "commonvars.php";
?>

<!-- TODO: WE NEED TO MAKE IT SO THAT IF A USER CLICKS 'CREATE' THE JOIN OPTION HIDES -->
<body>
    <style>
        .main-content{
            padding:0;
            
        }
    </style>

    <div class="main-content">

        <div class="banner">
            
        </div>

        <h1>Welcome to our Secret Santa Feature! <br> You can create or join a Secret Santa Group.</h1>
        <h2>When you want to close your group, Click close group!</h2>

        <div style="text-align:center; margin: 2em 20em;">


        <?php 
            if(isset($_SESSION['userId'])){
        ?>
            <!-- 1. Button to Create -->

                        <button class="main-button" type="button" id="hideCreateButton" onClick="createGroup(); this.style.display = 'none'">CREATE</button>
                        <?php 
                            $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
                        ?>
                        <div id="createButton" style="display:none">
                            <?php
                                // Check if the user is already an organizer
                                $organizerId = $_SESSION['userId'];
                                $sql = "SELECT organizerId FROM SecretSantaGroup WHERE organizerId LIKE $organizerId;";
                                $stmt = $db->query($sql);
                                $doesOrganizerExist = $stmt->rowCount();
                                if($doesOrganizerExist > 0) {
                                    echo "<p class='message'>You cannot organize two Secret Santa events.<p>";
                                }
                                // Check if the user is already in a group
                                else if(isset($_SESSION['groupId'])){
                                    echo "You cannot participate in more than 1 Secret Santa events.";
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
                            ?> 
                        </div>  

                        <!-- 2. Button to Join -->
                        <button class="main-button" type="button" id="hideJoinButton" onClick="joinGroup(); this.style.display = 'none'">JOIN</button>

                        <div id="joinButton" style="display:none">
                            <form action="joinLanding.php" method="post">
                                <label for="groupID">Secret Santa Group Code:</label>
                                <input type ="text" id="groupID" name="groupID"><br><br>

                                <button class="main-button" type="submit" name="submit">Enter Group</button>
                            </form>
                        </div>

                        <!-- 3. Button for Closing Group  -->
                        <button class="main-button" type="button" id="hideCloseButton" onClick="closeGroup(); this.style.display = 'none'">CLOSE GROUP</button>

                        <div id="closeButton" style="display:none">
                            <form action="pair.php" method="post">
                                <label for="closeGroupID">Secret Santa Group Code:</label>
                                <input type ="text" id="closeGroupID" name="closeGroupID"><br><br>

                                <button class="main-button" type="submit" name="submit">Close Group</button>
                            </form>
                        </div>

                        <script>
                            function createGroup() {
                                // display questions for organizer to answer
                                document.getElementById('createButton').style.display='block';
                                document.getElementById('hideJoinButton').style.display='none';
                                document.getElementById('hideCloseButton').style.display='none';
                            }
                            function joinGroup() {
                                // TODO: prompt participant for groupID
                                document.getElementById('joinButton').style.display='block';
                                document.getElementById('hideCreateButton').style.display='none';
                                document.getElementById('hideCloseButton').style.display='none';
                            }

                            function closeGroup() {
                                document.getElementById('closeButton').style.display='block';
                                document.getElementById('hideCreateButton').style.display='none';
                                document.getElementById('hideJoinButton').style.display='none';
                            }
                        </script>
        <?php
            }
        ?>

            
        </div>
    
    
    
    
    </div>
    <?php 
include "footer.php";
?>

</body>





