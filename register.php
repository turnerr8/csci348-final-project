<?php 
include 'head.php';
include 'commonvars.php';
include 'nav.php';
?>
<body>
    <style>
        .main-content{
            padding:0;
            
        }
    </style>

    <div class="main-content">
        
            <div class="banner">
                <h1>Sign Up</h1>
            </div>

        <!-- TODO: CHANGE FORM ACTION -->
        <form id="sign-up-form" action="verify.php" method="post">
            <fieldset>
                <br><br>
                <legend>Your Information</legend>


                <label for="fname">First name</label>
                <input type="text" id="fname" name="fname" placeholder="Enter your First Name..."><br>

                <label for="lname">Last name</label>
                <input type="text" id="lname" name="lname" placeholder="Enter your Last Name..."><br>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"placeholder="Enter your email address..." pattern="^[a-z0-9][-a-z0-9._]+@([-a-z0-9]+.)+[a-z]{2,5}$" required><br>

                <p>Login Information</p><br><br>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Create username..." required><br>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create password. 4-10 characters or numbers..." pattern="(?=.*[0-9])[0-9a-zA-Z]{4,10}" required><br>

                <label for="password">Confirm your Password</label>
                <input type="password" id="passwordagain" name="passwordagain" placeholder="Enter password again..." pattern="(?=.*[0-9])[0-9a-zA-Z]{4,10}" required>

                <button class="main-button" type="submit" name="submit">Register Now</button>
            </fieldset>

        </form>
    </div>
</body>
</html>

<?php
include "footer.php";
?>
