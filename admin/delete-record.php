<?php
include '../database_archive.php'; // Adjust the path as needed

if(isset($_GET['ticketId']) && !empty($_GET['ticketId'])) {
    $ticketId = $_GET['ticketId'];

    // Prepare a statement for deletion to avoid SQL injection
    $stmt = $connect_archive->prepare("DELETE FROM ticket_details_archive WHERE Ticket_ID = ?");
    $stmt->bind_param("s", $ticketId);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        echo "<script> window.location.href='archive-appointment.php'; alert('Record deleted successfully.');</script>";
    } else {
        echo "<script> window.location.href='archive-appointment.php'; alert('No record found with that Ticket ID.');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Ticket ID is required.'); window.location.href='archive-appointment.php';</script>";
}
?>
