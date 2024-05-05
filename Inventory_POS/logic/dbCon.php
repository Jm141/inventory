<?php
$server = "localhost";
$user ="root";
$password = 1234;
$db = "inventory";
// $root = "8080";

$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}else{
   
}

?>