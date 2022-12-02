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
    <?php require_once 'nav.php';
    //turn this into sessions

    $userId = 18;

            if(isset( $_SESSION['fName'])){
                $fName = $_SESSION['fName'];
            }
            if(isset($_SESSION['lName'])){
                $lName= $_SESSION['lName'];
            }
            if(isset($_SESSION['userId'])){
            $userId = $_SESSION['userId'];
            }
            ?>


    <!--
        WISHLIST ADD: THIS PAGE ALLOWS USER TO ADD ITEMS TO THEIR WISHLIST AND VIEW THE WISHLIST ITEMS OF OTHER USERS
        Ajax is used in order to recieve new items from the form, then to delete, the information is sent in a GET to wishlist-delete.php
        when an item is bought, it is sent through get to wishlist-bought.php and is edited

        I discussed with you about using the header() function working better tahn using ajax and you
        said we would not be docked for not using ajax or react because of this.

        Code used to communicate with wishlist-delete and wishlist-bought (along with the code in those files) is inspired by code
        from this source: https://www.sourcecodester.com/tutorials/php/12333/php-simple-do-list-app.html
    -->



    <!--ADD AN ITEM TO THE WISHLIST FORM-->

    <section id="Wishlist">

            <form id="wishlist-adder" action="wishlist-add.php" method="POST">
                <label for="itemName">Item:</label>
                <input type="text" name="itemName" id="itemName" required placeholder="Item Name">
                <br>

                <label for="itemLink">Item Link:</label>
                <input type="text" name="itemLink" id="itemLink" placeholder="Item Link">
                <br>

                <input type="submit" value="add" name="submit" id="submit">
            </form>

            


        <!-- CONNECT TO DATABASE-->
        <?php
           
            
            try
            {
                $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
            }
            catch (PDOException $e)
            {
                exit('Error: could not establish database connection');
            }

            ?>

            <table id="wishlist-table">
            <tr>
                <td>Name</td>
                <td>Item Name</td>
                <td>Item link</td>
                <td>Delete</td>
                <td>Buy</td>
            </tr>

            <?php
            echo "<h1>Wish List </h1>";
            $rows = $db->query("SELECT * FROM WishList JOIN Users ON (WishList.userId = Users.userId);");?>
            <!--ADD ROWS OF WISHLIST-->
            
            <?php
            //for all rows print the items
            $lastUserId=0;
            $rowCounter = 0;

            foreach($rows as $row){
                //for all items that are the same userid

                    $name = $row['firstName'] . " " . $row['lastName'];
                    //echo "<h3 class='name'>$name</h3><br>";
                    //$rowCounter=0;

                ?>
                    
                    <!--print table-->
                   
                    
                <?php
                 //end if
                    //set the user id to the next rows' id
                    
                    
                    ?>
                
                    <tr data-giftId="<?=$row['itemId']?>"
                        <?php
                            //test whether isbought is true, if so add bought class to the tr which will grey out row
                            
                            if($row['hasBeenBought']==1){
                                echo "class='bought'";
                            }
                        ?>
                    >
                        <td class="name"><?=$name?></td>
                        <td class="itemName"><?=$row['itemName']?></td>
                        <td class="itemLink"><a href= <?=$row['itemLink']?> target="_blank"><?=$row['itemName']?></a></td>
                        <td><a href="wishlist-delete.php?itemId=<?php echo $row['itemId']?>" class="delete">Delete</a></td>
                        <td><a href="wishlist-buy.php?itemId=<?php echo $row['itemId']?>&boughtBy=<?php echo $userId?>">Buy</a></td>
                    </tr>
                <?php
                   
               
                


            }
            echo "</table>";

            
            ?>
            

            <!--script>
                /*
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
                
                
                   
            </!--script-->
        </section>
        <?php
        require "footer.php";
        ?>
    </body>
</html>