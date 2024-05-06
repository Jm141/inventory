<?php
session_start();

include('Logic/dbCon.php');

if (!isset($_GET['code']) || empty($_GET['code'])) {
    header("Location: dashboard.php");
    exit();
}

$user_id = $_GET['code'];

$sql = "SELECT * FROM user WHERE code = $user_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "User not found.";
    exit();
}

$user = mysqli_fetch_assoc($result);

$sql1 = "SELECT * FROM user_access WHERE code = $user_id";
$result1 = mysqli_query($conn, $sql1);

if (!$result1) {
    echo "User access records not found or error occurred.";
    exit();
}

$user_access_array = mysqli_fetch_all($result1, MYSQLI_ASSOC);

$UsersAccess_AdminChecked = false;
$UsersAccess_UpdateUserChecked = false;
$UsersAccess_StaffChecked = false;

if ($user_access_array && is_array($user_access_array)) {
    foreach ($user_access_array as $access) {
        switch ($access['access']) {
            case 'UsersAccess_Admin':
                $UsersAccess_AdminChecked = true;
                break;
            case 'UsersAccess_UpdateUser':
                $UsersAccess_UpdateUserChecked = true;
                break;
            case 'UsersAccess_Staff':
                $UsersAccess_StaffChecked = true;
                break;
            default:
               
                break;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
   
</head>
<link rel="stylesheet" href="style.css">
<body>

    <h1>Update User</h1>

    <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <?php
    if (isset($_GET['success']) && $_GET['success'] === 'true') {
        echo "<p style='color: green;'>User information updated successfully.</p>";
    } elseif (isset($_GET['error']) && $_GET['error'] === 'true') {
        echo "<p style='color: red;'>Error updating user information. Please try again.</p>";
    }
    ?>
    <div class="container">
    <form action="Logic/updateScript.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <label for="firstname">Nirst Name:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $user['fname']; ?>" required><br><br>
		<label for="lastname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="<?php echo $user['lname']; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?php echo $user['password']; ?>" required><br><br>
       
            <div>
                <label>
                <input type="checkbox" name="link[]" <?php echo ($UsersAccess_AdminChecked) ? "checked" : ""; ?> value="UsersAccess_Admin"> User Admin
                </label><br>
                <label>
                <input type="checkbox" name="link[]" <?php echo ($UsersAccess_UpdateUserChecked) ? "checked" : ""; ?> value="UsersAccess_UpdateUser"> Update User
                </label><br>
                <label>
                <input type="checkbox" name="link[]" <?php echo ($UsersAccess_StaffChecked) ? "checked" : ""; ?> value="UsersAccess_Staff"> User Staff
                </label><br>
             </div>
             
        
             <input type="submit" value="Update" id="btn">
    </form>
    </div>
</body>
</html>
