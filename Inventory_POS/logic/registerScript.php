<?php
session_start(); 
include('dbCon.php');

$Fname = $_POST["fname"];
$Lname = $_POST["lname"];
$password = $_POST["password"];
$email = $_POST["email"];
$username2 = $_POST["username"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, '@gmail.com') === false) {
    echo "<script>alert('Email not supported. Please provide a Gmail address.');</script>";
    exit();
}

$sql_check_user = "SELECT * FROM user WHERE email='$email' OR username='$username2'";
$res_check_user = mysqli_query($conn, $sql_check_user);

if (mysqli_num_rows($res_check_user) > 0) {
    // User exists, update details
    $row = mysqli_fetch_assoc($res_check_user);
    $Ucode = $row['code']; // Use existing code for the user
    $status = $row['status']; // Use existing status for the user
    $timestamp = date('Y-m-d H:i:s'); // Update timestamp
    
    $sql_update_user = "UPDATE user SET fname='$Fname', lname='$Lname', password='$password', timestamp='$timestamp' WHERE email='$email' OR username='$username2'";
    
    if (mysqli_query($conn, $sql_update_user)) {
        header("Location: ../register.php");
    } else {
        echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
    }
} else {
    // User does not exist, insert new user
    $sql_last_code = "SELECT code FROM user ORDER BY code DESC LIMIT 1";
    $result_last_code = mysqli_query($conn, $sql_last_code);
    
    if (mysqli_num_rows($result_last_code) > 0) {
        $row = mysqli_fetch_assoc($result_last_code);
        $last_code = $row['code'];
        $Ucode = $last_code + 1;
    } else {
        $Ucode = 2023001;
    }
    
    $sql_check = "SELECT * FROM user";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) == 0) {
        $status = 'admin';
    } else {
        $status = 'staff';
    }
    
    $timestamp = date('Y-m-d H:i:s');
    
    $sql_insert_user = "INSERT INTO user (code, fname, lname, password, status, username, timestamp, email) VALUES ('$Ucode', '$Fname', '$Lname', '$password', '$status', '$username2', '$timestamp', '$email')";
    
    if (mysqli_query($conn, $sql_insert_user)) {
        header("Location: ../register.php");
    } else {
        echo "<script>alert('Error inserting user: " . mysqli_error($conn) . "');</script>";
    }
}
?>
