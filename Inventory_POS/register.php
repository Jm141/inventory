
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="MIDTERMEXAM_Valenzuela_Martinez/style.css">
</head>

<body>

<div class="container">
    <form id="registerForm" action="logic/registerScript.php" method="post" onsubmit="return verifyPassword()">
        <h1>Register</h1>
        <label id="fname">First Name</label>
        <input type="text" name="fname" id="fname" required> </br>
        <label id="lname">Last Name</label>
        <input type="text" name="lname" id="lname" required> </br>
        <label id="email">Email</label>
        <input type="email" name="email" id="email" placeholder="example123@gmail.com" required>
        <label id="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label id="password">Password</label>
        <input type="password" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="exaMple123" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters" required>

        <div id="message" style="display: none;">
            <h3>Password must contain the following:</h3>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>5 characters</b></p>
        </div>

        <input type="submit" value="Register" id="registerBtn"  >

    </form>
</div>



    <script src="script.js">
   
    </script>

</body>
</html>
