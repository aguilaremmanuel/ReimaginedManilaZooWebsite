<?php 
 
 $hostName = "localhost";
 $dbUser = "root"; 
 $dbPassword = "";
 $dbName = "zoo";

$connect = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName) or die("Something went wrong;");
 //$connect = new mysqli($hostName, $dbUser, $dbPassword);

 // Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}


?>