<?php
    include("../database.php");

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    $sql = "SELECT operation_date FROM operational_status";
    $result = $connect->query($sql);

    $dates = [];

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $dates[] = getDay($row['operation_date']);
        }
        echo json_encode($dates);
    } else {
        echo "0 results";
    }

    function getDay($date) {
        $day = date("j", strtotime($date));
        return $day;
    }


    $connect->close();
?>
