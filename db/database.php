<?php 
 
 $hostName = "localhost";
 $dbUser = "root"; 
 $dbPassword = "";
 $dbName = "zoo";

 //$connect = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName) or die("Something went wrong;");
 $connect = new mysqli($hostName, $dbUser, $dbPassword);

 // Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($connect->query($sqlCreateDatabase) === TRUE) {
    if ($connect->select_db($dbName)) {
        //echo "Database exists or created successfully";
    } else {
        die("Error selecting database: " . $connect->error);
    }
} else {
    die("Error creating database: " . $connect->error);
}

$tableName = "user";
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS $tableName (
    email VARCHAR(45) PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($connect->query($sqlCreateTable) === TRUE) {
    //echo "Table created successfully or already exists";
} else {
    die("Error creating table: " . $connect->error);
}

?>