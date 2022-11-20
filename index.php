<?php
require_once "head.php";
require_once "commonvars.php";
?>
<body>
    <!--NAVIGATION-->
    <nav>
        <!--logo-->
        <a href="#">Home</a>
        <a href="#">Wishlist</a>
        <a href="#">Secret Santa</a>
        <a href="#">Log In</a>
        <a href="#">Sign Up</a>
    
    </nav>

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
            //READ
            //https://code.tutsplus.com/tutorials/submit-a-form-without-page-refresh-using-jquery--net-59
            $('#Wishlist').submit(function(){
                console.log("submit");
                var postData = $('#Wishlist').serialize();
                $.post('wishlist-add.php', postData, function(data) {
                    console.log("added");
                });
            });
        </script>


    <!-- CONNECT TO DATABASE-->
    <?php
        $db = new PDO($databaseConnection, $databaseUname, $databasePassword);


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
                <td><a href=<?=$row['itemLink']?>><?=$row['itemName']?></a></td>
            </tr>
            <?php
        }
        
        ?>
        </table>
    </section>
</body>