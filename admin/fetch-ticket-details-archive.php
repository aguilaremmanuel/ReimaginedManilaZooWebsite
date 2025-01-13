<?php
include '../database_archive.php'; // Adjust the path as needed

if(isset($_GET['ticketId'])) {
    $ticketId = $_GET['ticketId'];
    $response = array();
    $sql = "SELECT Schedule_Date, Ticket_Price, Guest_Count FROM ticket_details_archive WHERE Ticket_ID = ?";
    $stmt = $connect_archive->prepare($sql);
    $stmt->bind_param("s", $ticketId);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $response = $result->fetch_assoc();
        error_log(print_r($response, true));
    }
    $stmt->close();
    $connect_archive->close();
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
