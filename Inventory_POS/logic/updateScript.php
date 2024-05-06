<?php
session_start();
include('dbCon.php');

function logActivity($conn, $userId, $activity) {
    $userId = mysqli_real_escape_string($conn, $userId);
    $activity = mysqli_real_escape_string($conn, $activity);
    
    $username = $_SESSION['name'];
	$timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO activity_log (userCode, activity,timestamp) VALUES ('$userId', '$username $activity','$timestamp')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $updated_fname = $_POST["fname"];
	$updated_lname = $_POST["lname"];
    $updated_email = $_POST["email"];
    $updated_username = $_POST["username"];
    $updated_password = $_POST["password"];
	$timestamp = date('Y-m-d H:i:s');
    $update_sql = "UPDATE user SET fname = '$updated_fname',lname = '$updated_lname', email = '$updated_email', username= '$updated_username', password = '$updated_password', timestamp='$timestamp' WHERE id = $user_id";

    if (mysqli_query($conn, $update_sql)) {
       
		$delete_sql = "DELETE FROM user_access WHERE code = $user_id";
        mysqli_query($conn, $delete_sql);

        if (isset($_POST['link']) && is_array($_POST['link'])) {
            foreach ($_POST['link'] as $access) {
                
                $insert_sql = "INSERT INTO user_access (code, access) VALUES ($user_id, '$access')";
                mysqli_query($conn, $insert_sql);
            }
        }

         $activity = "updated user info: $updated_fname";
        logActivity($conn, $user_id, $activity);

        header("Location: ../Masterdashboard.php?id=$user_id&success=true");
        
    } else {
        
        header("Location: update.php?id=$user_id&error=true");
     
    }
} else {
    
    header("Location: ../dashboard.php");
    exit();
}
?>
