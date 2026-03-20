<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "expense_tracker";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Database connection failed");
}

?>