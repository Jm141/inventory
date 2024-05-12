<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
   

    $sql_last_code = "SELECT code FROM user ORDER BY code DESC LIMIT 1";
    $result_last_code = mysqli_query($conn, $sql_last_code);

    if (mysqli_num_rows($result_last_code) > 0) {
        $row = mysqli_fetch_assoc($result_last_code);
        $last_code = $row['code'];
        $Ucode = $last_code + 1;
    } else {
        $Ucode = 2023001;
    }
    $timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO products (category, product, price, quantity, code,timestamp) VALUES ('$category', '$product_name', '$price', '$quantity', '$Ucode','$timestamp')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product added successfully');</script>";
       
        header("Location: ../StaffDashboard.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
