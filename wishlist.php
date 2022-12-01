<?php
session_start ();
require 'commonvars.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/wishlist-styles.css">
    <title>Wishlist</title>
</head>
<body>
    <?php require_once 'nav.php';?>

        


    <!--
        WISHLIST ADD: THIS PAGE ALLOWS USER TO ADD ITEMS TO THEIR WISHLIST AND VIEW THE WISHLIST ITEMS OF OTHER USERS
        Ajax is used in order to recieve new items from the form, then to delete, the information is sent in a GET to wishlist-delete.php
        when an item is bought, it is sent through get to wishlist-bought.php and is edited

        Code used to communicate with wishlist-delete and wishlist-bought (along with the code in those files) is inspired by code
        from this source: https://www.sourcecodester.com/tutorials/php/12333/php-simple-do-list-app.html
    -->



    <!--ADD AN ITEM TO THE WISHLIST FORM-->

    <section id="Wishlist">

            <form id="wishlist-adder">
                <label for="itemName">Item:</label>
                <input type="text" name="itemName" id="itemName" required>

                <label for="itemLink">Item Link</label>
                <input type="text" name="itemLink" id="itemLink">

                <input type="submit" value="add" name="submit" id="submit">
            </form>

            


        <!-- CONNECT TO DATABASE-->
        <?php
            //turn this into sessions
            $fName = $_SESSION['fName'];
            $lName= $_SESSION['lName'];
            $userId = $_SESSION['userId'];
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
                <tr data-giftId="<?=$row['itemId']?>"
                <?php
                    //test whether isbought is true, if so add bought class to the tr which will grey out row
                    if($row['hasBeenBought']==1){
                        echo "class='bought'";
                    }
                ?>
                >
                    <td class="fName"><?=$row['firstName']?></td>
                    <td class="lName"><?=$row['lastName']?></td>
                    <td class="itemName"><?=$row['itemName']?></td>
                    <td class="itemLink"><a href= <?=$row['itemLink']?> target="_blank"><?=$row['itemName']?></a></td>
                    <td><a href="wishlist-delete.php?itemId=<?php echo $row['itemId']?>" class="delete">Delete</a></td>
                    <td><a href="wishlist-buy.php?itemId=<?php echo $row['itemId']?>&boughtBy=<?php echo $userId?>">Buy</a></td>
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
    </body>
</html>