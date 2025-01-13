<?php
    include("../database.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $operationDate = $_POST['operationDate'];
        $operationType = $_POST['operationType'];

        if($operationType == "others") {
            $operationType = $_POST['specifiedOperation'];
        }
        
        $stmt = $connect->prepare("INSERT INTO operational_status (operation_date, creation_date, operation_type) 
        VALUES (?, ?, ?);");
        $currentDate = date("Y-m-d");
        $stmt->bind_param("sss",$operationDate, $currentDate, $operationType);
        $stmt->execute();
        $stmt->close();
        
        header("Location: admin-operations.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/operations_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin — Maintenance</title>
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

        <div class="main-container dashboard-page" id="mainContainer-dashboard" >
            <div class="header"></div>

            <div class="show-operational-events-container">
                <table>
                    <tr>
                        <th>Operation No.</th>
                        <th>Operation Date</th>
                        <th>Creation Date</th>
                        <th>Operation Type</th>
                        <th>Action</th>
                    </tr>
        
                    <?php
                    
                        include '../database.php'; // Adjust the path as needed
                        
                        $sql = "SELECT * FROM operational_status";
                        $stmt = $connect->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["operation_no"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["operation_date"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["creation_date"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["operation_type"]) . "</td>";
                                echo "<td> <button class='button-icon' id='cancelOperationBtn' onclick='confirmCancelOperation(" . $row['operation_no'] . ")'>Cancel</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No results found</td></tr>";
                        }
                        $stmt->close();
                        
                    ?>
                            
                </table>
            </div>

            <form action="" method="post">
                    <div id="add-operation-modal" class="add-operation-modal">
                        <div class="add-operation-container">
                            
                            <label>Select Date:</label>
                            <input type="date" id="operationDate" name="operationDate">

                            <label>Type of Operation:</label>
                            <select id="operationType" name="operationType">
                                <option value="maintenance">maintenance</option>
                                <option value="reserved">reserved</option>
                                <option value="others">others</option>
                            </select>
                            
                            <label id="specifiedOperationLabel" style="display: none;">Specify the type of operation:</label>
                            <input type="text" id="specifiedOperation" name="specifiedOperation" value="" style="display: none;">

                            <div class="add-operation-action-container">
                                <div class="cancel-btn" id="cancel-btn">Cancel</div>
                                <input type="submit" class="generate-btn" id="generate-btn" value="Add">
                            </div>
                        </div>

                    </div>
                </form>

            <button class="add-operation-btn" onclick="showAddOperation()">
                <i class="fa-solid fa-plus"></i> Add Operation
            </button>
            
            <form action="admin-cancel-operation.php" method="post">
                <div class="confirm-cancel-operation-modal" id="confirm-cancel-operation-modal">
                    <div class="confirm-cancel-operation-container">
                        <label>Are you sure you want to cancel this operation?</label>
                        <div class="cancel-operation-action-container">
                            <div class="no-btn" id="no-btn">No</div>
                            <input type="hidden" id="operationNo" name="operationNo">
                            <input type="submit" class="yes-btn" id="yes-btn" value="Yes">
                        </div>
                    </div>
                </div>
            </form>


        </div>

    </div>
    <script src="../js/admin-operations.js"></script>
</body>
</html>
