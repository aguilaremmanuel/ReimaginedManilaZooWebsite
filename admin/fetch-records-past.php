<?php
    include '../database_archive.php';

    $searchInput = isset($_GET['searchInput']) ? $_GET['searchInput'] : '';

    $sql = "SELECT * FROM guest_archive WHERE Ticket_ID LIKE CONCAT('%', ?, '%') OR Guest_FirstName LIKE CONCAT('%', ?, '%') OR Guest_LastName LIKE CONCAT('%', ?, '%')";

    $stmt = $connect_archive->prepare($sql);
    $stmt->bind_param('sss', $searchInput, $searchInput, $searchInput);

    $stmt->execute();
    $result = $stmt->get_result();

    $records = [];
    while($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    $stmt->close();
    $connect_archive->close();

    header('Content-Type: application/json');
    echo json_encode($records);
?>
