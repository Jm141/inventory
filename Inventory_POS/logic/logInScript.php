<?php
include('dbCon.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['id'] = $row['id']; 
        $_SESSION['name'] = $row['name'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email']; 
        $_SESSION['isLogged'] = true;
		if($row["status"] == "staff"){
            header("Location:../StaffDashboard.php");
        }else{
            header("Location:../Masterdashboard.php");
        exit();
        }
       
    } else {
        echo "Login failed. Please check your username and password.";
    }
} else {
    
    echo "Invalid request method.";
}
?>
