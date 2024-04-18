<?php
$host = "localhost";
$username = "root";
$password = "1234";
$database = "inventory_db";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>