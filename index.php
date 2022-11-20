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
        <a href="signin.php">Log In</a>
        <a href="register.php">Sign Up</a>
    
    </nav>

    <section id="Wishlist">
    <?php
        $db = new PDO($databaseConnection, $databaseUname, $databasePassword);
        $rows = $db->query("SELECT * FROM WishList JOIN Users ON (WishList.userId = Users.userId);");?>
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