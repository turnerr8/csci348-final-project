<?php
session_start ();
require 'head.php';
require 'commonvars.php';
require_once 'nav.php';
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

        


    <!-- CONNECT TO DATABASE-->
    <?php
        //turn this into sessions
        $fName = "Ryan";
        $lName="Turner";
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
        <table id="wishlist-table">
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
                <td><a href= <?=$row['itemLink']?> target="_blank"><?=$row['itemName']?></a></td>
            </tr>
            <?php
        }
        
        ?>
        </table>

        <script>
            $(document).ready(function (){

                $( "form" ).on( "submit", function(e){
                    e.preventDefault();
                    console.log("submit");
                    var postData = $(this).serialize();

                    $.ajax({
                        
                        url: "wishlist-add.php",
                        method: "POST",
                        data: postData,

                        success: function (data) {
                            console.log("added successfully");
                            console.log(data);

                            //insert a row first
                            let table = document.getElementById("wishlist-table");
                            let row = table.insertRow(1);
                            let cell0 = row.insertCell(0);
                            let cell1 = row.insertCell(1);
                            let cell2 = row.insertCell(2);
                            let cell3 = row.insertCell(3);

                            //add html
                            cell0.innerHTML= "<?=$fName?>";
                            cell1.innerHTML = "<?=$lName?>";

                            //get item
                            var item = document.getElementById( "itemName" ).value;
                            var link = document.getElementById( "itemLink" ).value;
                            console.log(item);
                            console.log(link);
                            cell2.innerHTML = item;
                            cell3.innerHTML =`<a href='${link}'>${item}</a>`;



                            //location.reload();
                            $

                            
                        }
                    });
                });
                
            });
            
            
                
        </script>
    </section>
    <?php
    require "footer.php";
    ?>