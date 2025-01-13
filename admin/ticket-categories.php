<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/ticket-categories.css">
    <link rel="stylesheet" href="../css/animals_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin — Ticket Categories</title>
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
        
        
        <div id="ticket-container" class="main-container dashboard-page">
            <div class="header"></div>
            <div class="table-container">
                <table id="ticketRatesTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ratesTableBody">
                        <!-- Ticket rates will be loaded here -->
                    </tbody>
                </table>
                <!-- Edit Modal -->
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2 id="ticketEditHead"></h2>
                        <input type="number" id="ticketPrice" name="ticketPrice">
                        <div style="display:flex;" class="editRateContainer">
                            <div class="cancel-btn">Cancel</div>
                            <button onclick="saveChanges()">Save</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/admin-ticket-rates.js"></script>
</body>
</html>
