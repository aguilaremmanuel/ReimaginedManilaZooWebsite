<?php 
 
 $hostName = "localhost";
 $dbUser = "root"; 
 $dbPassword = "";
 $dbName = "db_archive";

 //$connect = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName) or die("Something went wrong;");
 $connect_archive = new mysqli($hostName, $dbUser, $dbPassword);

 // Check connection
if ($connect_archive->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($connect_archive->query($sqlCreateDatabase) === TRUE) {
    if ($connect_archive->select_db($dbName)) {
        //echo "Database exists or created successfully";
    } else {
        die("Error selecting database: " . $connect_archive->error);
    }
} else {
    die("Error creating database: " . $connect_archive->error);
}


?>