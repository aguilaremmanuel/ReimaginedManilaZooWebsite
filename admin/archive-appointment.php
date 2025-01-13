<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/today-appointment.css">
    <link rel="stylesheet" href="../css/archive-appointment.css">
    <link rel="stylesheet" href="../css/animals_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin — Archives</title>
    <link rel="icon" href="../admin/admin-logo.png">
    
    <style>
        .head-container a {
            text-decoration: none; /* Removes the underline */
            color: white; /* Sets the font color to white */
        }
        
        .head-container a:hover {
            color: black; /* Sets the font color to white */
            background-color: #45BCC8;
        }
    </style>
    
</head>
<body>

<div class="wrapper">
    <div class="side-bar">
            <div class="header">
                <div class="head-container">
                    <img src="../images/logo.png" alt="Manila Zoo Logo">
                    <h2><a href="admin-login.php">ADMIN</h2></a>
                </div>
 
            </div>
            <div class="dashboard-nav"> <a href="dashboard.php">Dashboard</a></div>
            <div class="feature-header"><span>FEATURES:</span></div>
            <div class="feature-nav"><a href="today-appointment.php">Incoming Appointments</a></div>
            <div class="feature-nav"><a href="archive-appointment.php">Past Appointments</a></div>
            <div class="feature-nav"><a href="ticket-categories.php">Ticket Categories</a></div>
            <div class="feature-nav"><a href="operating-hours-categories.php">Operating Hours</a></div>
            <div class="feature-nav"><a href="admin-animals.php">Animals Management</a></div>
            <div class="feature-nav"><a href="admin-plants.php">Plants Management</a></div>
            <div class="feature-nav"><a href="admin-events.php">Events Management</a></div>
            <div class="feature-nav"><a href="admin-operations.php">Operations</a></div>

        </div>

    <div class="main-container dashboard-page" id="mainContainer-dashboard">
        <div class="header"></div>
        <div class="admin-action-container" id="admin-action-container">

            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Search by ticket, first name, or last name" oninput="fetchSuggestions()">
            </div>

            <div class="delete-btn-container">
                <div id="delete-record"><i class="fa-sharp fa-solid fa-trash"></i>Delete Record</div>
            </div>
            <!-- Popup Start -->
            <div id="deletePopup" class="popup" style="display:none;">
                <div class="popup-content">
                    <!-- <span class="close">&times;</span> -->
                    <label>Delete Record</label>
                    <input type="text" id="ticketIdInput" placeholder="Enter Ticket ID" />
                    <div class="action-container-delete">
                        <button id="deleteCancel">Cancel</button>
                        <button id="deleteConfirm">Delete</button>
                    </div>
                </div>
            </div>
            <!-- Popup End -->

        </div>
       
        <div class="table-container" id="table-container">
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Residency</th>
                    <th>Status</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th>Price</th>
                </tr>
                <?php
                include '../database_archive.php'; // Adjust the path as needed
                
                $whereConditions = [];
                $params = [];
                $types = '';
                
                if(isset($_GET['ticketId']) && !empty($_GET['ticketId'])) {
                    $whereConditions[] = "Ticket_ID = ?";
                    $params[] = $_GET['ticketId'];
                    $types .= 's';
                }
                
                if(isset($_GET['firstName']) && !empty($_GET['firstName'])) {
                    $whereConditions[] = "Guest_FirstName LIKE ?";
                    $params[] = "%" . $_GET['firstName'] . "%";
                    $types .= 's';
                }
                
                if(isset($_GET['lastName']) && !empty($_GET['lastName'])) {
                    $whereConditions[] = "Guest_LastName LIKE ?";
                    $params[] = "%" . $_GET['lastName'] . "%";
                    $types .= 's';
                }
                
                $sql = "SELECT * FROM guest_archive";
                if (!empty($whereConditions)) {
                    $sql .= " WHERE " . implode(" AND ", $whereConditions);
                }
                
                $stmt = $connect_archive->prepare($sql);
                if (!empty($params)) {
                    $stmt->bind_param($types, ...$params);
                }
                
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a style='text-decoration:none; color: black;' href='#' class='ticket-link' data-ticketid='" . htmlspecialchars($row["Ticket_ID"]) . "'>" . htmlspecialchars($row["Ticket_ID"]) . "</a></td>";
                        echo "<td>" . htmlspecialchars($row["Guest_FirstName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Guest_LastName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Gender"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Age"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Residency"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Guest_Status"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Contact_No"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Price"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No results found</td></tr>";
                }
                $stmt->close();
                ?>
            </table>
        </div>

        <div id="ticketModal" class="modal" style="display:none;">
            <div class="modal-content">
                <div class="close-container"><i class="fa-solid fa-xmark" id="close"></i></div>
                <h1>Ticket Details:</h1>
                
                <div class="td-container">
                    <label>Ticket ID:</label><span id="showTicketID"></span><br><br>
                    <label>Schedule Date:</label><span id="showScheduleDate"></span><br><br>
                    <label>Total Price:</label><span id="showTicketPrice"></span><br><br>
                    <label>No. of Guest/s:</label><span id="showGuestCount"></span>
                </div>
                
            </div>
        </div>

        <div class="confirm-container" id="confirmation">
            <label class="confirm-label">Confirm archiving past records?</label>
            <div class="buttons">
                <div class="cancel-btn" id="cancel-btn"> Cancel </div>
                <div class="submit-btn">
                    <form action="archive.php" method="post">
                        <input class="confirm-btn" type="submit" value="Confirm">
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

<script src="../js/archive-appointment.js"></script>
</body>
</html>
