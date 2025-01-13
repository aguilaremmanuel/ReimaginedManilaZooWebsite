<?php
    include '../database.php'; // Adjust this path to your actual connection file for db_zoo
    include '../database_archive.php'; // Adjust this path to your actual connection file for db_archive


    // Get the current date in 'Y-m-d' format
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');

    try {
        // Begin transaction for both databases
        $connect->begin_transaction();
        $connect_archive->begin_transaction();

        // Step 1: Archive ticket details
        $ticketQuery = "SELECT * FROM ticket_details WHERE Schedule_Date < ?";
        $ticketStmt = $connect->prepare($ticketQuery);
        $ticketStmt->bind_param("s", $currentDate);
        $ticketStmt->execute();
        $result = $ticketStmt->get_result();

        $archiveTicketQuery = "INSERT INTO ticket_details_archive (Ticket_ID, Schedule_Date, Ticket_Price, Guest_Count) VALUES (?, ?, ?, ?)";
        $archiveTicketStmt = $connect_archive->prepare($archiveTicketQuery);

        while ($ticket = $result->fetch_assoc()) {
            $archiveTicketStmt->bind_param("sssi", $ticket['Ticket_ID'], $ticket['Schedule_Date'], $ticket['Ticket_Price'], $ticket['Guest_Count']);
            $archiveTicketStmt->execute();
        }
        
        // Step 2: Archive guest details
        
        $guestQuery = "SELECT * FROM guest WHERE Ticket_ID IN (SELECT Ticket_ID FROM ticket_details WHERE Schedule_Date < ?)";
        $guestStmt = $connect->prepare($guestQuery);
        $guestStmt->bind_param("s", $currentDate);
        $guestStmt->execute();
        $guestsResult = $guestStmt->get_result();

        $archiveGuestQuery = "INSERT INTO guest_archive (Guest_FirstName, Guest_LastName, Gender, Age, Residency, Guest_Status, Ticket_ID, Contact_No, Email, Price) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $archiveGuestStmt = $connect_archive->prepare($archiveGuestQuery);

        while ($guest = $guestsResult->fetch_assoc()) {
            $archiveGuestStmt->bind_param("sssisssssd", $guest['Guest_FirstName'], $guest['Guest_LastName'], $guest['Gender'], $guest['Age'], $guest['Residency'], $guest['Guest_Status'], $guest['Ticket_ID'], $guest['Contact_No'], $guest['Email'], $guest['Price']);
            $archiveGuestStmt->execute();
        }

        // Step 3: Delete the original records
        // Note: You must ensure that deletion does not violate any foreign key constraints
        // For safety, this step is commented out. Uncomment and use with caution.
        
        $deleteTicketsQuery = "DELETE FROM ticket_details WHERE Schedule_Date < ?";
        $deleteTicketsStmt = $connect->prepare($deleteTicketsQuery);
        $deleteTicketsStmt->bind_param("s", $currentDate);
        $deleteTicketsStmt->execute();
        

        // Commit transactions
        $connect->commit();
        $connect_archive->commit();

        echo "Archive operation completed successfully.";
    } catch (Exception $e) {
        // An error occurred; rollback transactions
        $connect->rollback();
        $connect_archive->rollback();
        echo "An error occurred during the archive operation: " . $e->getMessage();
    } finally {
        // Close connections and statements
        if (isset($ticketStmt)) $ticketStmt->close();
        if (isset($archiveTicketStmt)) $archiveTicketStmt->close();
        if (isset($guestStmt)) $guestStmt->close();
        if (isset($archiveGuestStmt)) $archiveGuestStmt->close();
        if (isset($deleteTicketsStmt)) $deleteTicketsStmt->close();

        $connect->close();
        $connect_archive->close();
    }
    echo "pumasok sa link ";
    header("Location: today-appointment.php");
    exit;
?>
