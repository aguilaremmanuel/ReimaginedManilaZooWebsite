<?php
include '../database.php'; // Adjust the path as needed

if(isset($_GET['ticketId'])) {
    $ticketId = $_GET['ticketId'];
    $response = array();
    $sql = "SELECT Schedule_Date, Ticket_Price, Guest_Count FROM ticket_details WHERE Ticket_ID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $ticketId);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    $stmt->close();
    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
