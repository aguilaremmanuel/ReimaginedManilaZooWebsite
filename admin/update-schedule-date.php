<?php
include '../database.php'; // Adjust the path as needed

if(isset($_POST['ticketId']) && isset($_POST['newDate']) && isset($_POST['oldDate']) && isset($_POST['guestCount'])) {
    $ticketId = $_POST['ticketId'];
    $newDate = $_POST['newDate'];
    $oldDate = $_POST['oldDate'];
    $guestCount = $_POST['guestCount'];

    $newDateObject = new DateTime($newDate);
    $newDay = (int)$newDateObject->format('d');
    $oldDateObject = new DateTime($oldDate);
    $oldDay = (int)$oldDateObject->format('d');

    // update the date
    $sqlChangeDate = "UPDATE ticket_details SET Schedule_Date = ? WHERE Ticket_ID = ?";
    $stmtChangeDate = $connect->prepare($sqlChangeDate);
    $stmtChangeDate->bind_param("ss", $newDate, $ticketId);
    $stmtChangeDate->execute();
    $stmtChangeDate->close();

    // update the old date slots
    $sqlUpdateOldSlot = "UPDATE slot SET Slots = Slots + ? WHERE Date = ?";
    $stmtUpdateOldSlot = $connect->prepare($sqlUpdateOldSlot);
    $stmtUpdateOldSlot->bind_param("ii", $guestCount, $oldDay);
    $stmtUpdateOldSlot->execute();
    $stmtUpdateOldSlot->close();

    // update the new date slots
    $sqlUpdateNewSlot = "UPDATE slot SET Slots = Slots - ? WHERE Date = ?";
    $stmtUpdateNewSlot = $connect->prepare($sqlUpdateNewSlot);
    $stmtUpdateNewSlot->bind_param("ii", $guestCount, $newDay);
    $stmtUpdateNewSlot->execute();
    $stmtUpdateNewSlot->close();

    $connect->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

header("Location: today-appointment.php");
exit;
?>
