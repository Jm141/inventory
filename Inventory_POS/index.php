<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <form id="registerForm" action="Logic/logInScript.php" method="post" >
        <h1>Register</h1>
        
        <label id="username">username</label>
        <input type="text" name="username" id="username"  required>
        <label id="password">Password</label>
        <input type="password" id="psw" name="password"  required>

        <input type="submit" value="LogIn" id="logInbtn">

    </form>
    <a href="register.php">Register here</br>
    <a href="MIDTERMEXAM_Valenzuela_Martinez/passwordReset.php">Forgot password
</div>


    <!-- <script src="script.js"> -->
   
    </script>

</body>
</html>
