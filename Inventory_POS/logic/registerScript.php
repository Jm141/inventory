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

$sql_e = "SELECT * FROM user WHERE email='$email' OR username='$username2'";
$res_e = mysqli_query($conn, $sql_e);

if (mysqli_num_rows($res_e) > 0) {
    echo "<script>alert('Email or Username already exists');</script>";
} else {
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

    $sql = "INSERT INTO user (code, fname, lname, password, status, username, timestamp,email) VALUES ('$Ucode', '$Fname','$Lname',  '$password',  '$status', '$username2', '$timestamp','$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../register.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}
?>
