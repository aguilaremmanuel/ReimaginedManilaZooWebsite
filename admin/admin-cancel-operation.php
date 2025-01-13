<?php
    include("../database.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $operationNo = $_POST['operationNo'];
 
        $stmt = $connect->prepare("DELETE FROM operational_status
        WHERE operation_no = ?;");
        $stmt->bind_param("i", $operationNo);
        $stmt->execute();
        $stmt->close();
        
        header("Location: admin-operations.php");
        exit;
    }
?>