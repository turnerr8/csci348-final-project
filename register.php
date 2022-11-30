<?php 
include 'head.php';
include 'commonvars.php';
include 'nav.php';
?>
<body>
    <!-- TODO: CHANGE FORM ACTION -->
    <form action="verify.php" method="post">
        <fieldset>
            <legend>Sign Up</legend>
            <h3>Your Information</h3>

            <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname"><br><br>

            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname"><br><br>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" pattern="^[a-z0-9][-a-z0-9._]+@([-a-z0-9]+.)+[a-z]{2,5}$" required><br><br>

            <h3>Login Information</h3>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="4-10 characters or numbers" pattern="(?=.*[0-9])[0-9a-zA-Z]{4,10}" required><br><br>

            <label for="password">Confirm your Password:</label>
            <input type="password" id="passwordagain" name="passwordagain" pattern="(?=.*[0-9])[0-9a-zA-Z]{4,10}" required><br><br>

            <br>
            <button type="submit" name="submit">Register Now</button>
        </fieldset>

    </form>
</body>
</html>