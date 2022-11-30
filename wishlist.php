<?php
session_start ();
require 'head.php';
require 'commonvars.php';
?>
<!--ADD AN ITEM TO THE WISHLIST FORM-->

<section id="Wishlist">

        <form id="wishlist-adder">
            <label for="itemName">Item:</label>
            <input type="text" name="itemName" id="itemName">

            <label for="itemLink">Item Link</label>
            <input type="text" name="itemLink" id="itemLink">

            <input type="submit" value="add" name="submit" id="submit">
        </form>

        <script>
            $(document).ready(function (){

                $( "form" ).on( "submit", function(e){
                    //e.preventDefault();
                    console.log("submit");
                    var postData = $(this).serialize();

                    $.ajax({
                        
                        url: "wishlist-add.php",
                        method: "POST",
                        data: postData,

                        success: function (data) {
                            console.log("added successfully");
                            console.log(data);
                            window.location.reload();
                            
                        }
                    });
                });
            });
            //READ
            //https://code.tutsplus.com/tutorials/submit-a-form-without-page-refresh-using-jquery--net-59
            
                
        </script>


    <!-- CONNECT TO DATABASE-->
    <?php
        //$db = new PDO($databaseConnection, $databaseUname, $databasePassword);
        try
        {
            $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
        }
        catch (PDOException $e)
        {
            exit('Error: could not establish database connection');
        }


        echo "<h1>Wish List </h1>";
        $rows = $db->query("SELECT * FROM WishList JOIN Users ON (WishList.userId = Users.userId);");?>
        <!--ADD ROWS OF WISHLIST-->
        <table>
            <tr>
                <td>First</td>
                <td>Last</td>
                <td>Item Name</td>
                <td>Item link</td>
            </tr>
        <?php
        foreach($rows as $row){
            ?>
            <tr>
                <td><?=$row['firstName']?></td>
                <td><?=$row['lastName']?></td>
                <td><?=$row['itemName']?></td>
                <td><a href= <?=$row['itemLink']?>><?=$row['itemName']?></a></td>
            </tr>
            <?php
        }
        
        ?>
        </table>
    </section>