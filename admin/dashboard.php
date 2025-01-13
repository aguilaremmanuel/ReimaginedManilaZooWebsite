<?php
     include '../database.php';

    // Function to get count
    function getCount($connect, $sql) {
        $result = $connect->query($sql);
        if ($result) {
            $row = $result->fetch_row();
            return $row[0]; // Return count
        } else {
            return "Error: " . $connect->error; // Return error message on failure
        }
    }

    // SQL Queries
    $sqlMnlResident = "SELECT COUNT(*) FROM guest g INNER JOIN ticket_details td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_Date = CURRENT_DATE AND g.Residency = 'MNL'";
    $mnlResidentCount = getCount($connect, $sqlMnlResident);

    $sqlNonMnlResident = "SELECT COUNT(*) FROM guest g INNER JOIN ticket_details td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = CURRENT_DATE AND g.Residency = 'NON-MNL'";
    $nonMnlResidentCount = getCount($connect, $sqlNonMnlResident);

    $sqlStudent = "SELECT COUNT(*) FROM guest g INNER JOIN ticket_details td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = CURRENT_DATE AND g.Guest_Status = 'STUD'";
    $studentCount = getCount($connect, $sqlStudent);

    $sqlScPwd = "SELECT COUNT(*) FROM guest g INNER JOIN ticket_details td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = CURRENT_DATE AND g.Guest_Status = 'SC-PWD'";
    $scPwdCount = getCount($connect, $sqlScPwd);

    $sqlMnlEmp = "SELECT COUNT(*) FROM guest g INNER JOIN ticket_details td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = CURRENT_DATE AND g.Guest_Status = 'MNL-EMP'";
    $mnlEmpCount = getCount($connect, $sqlMnlEmp);

    $sqlTotalGuest = "SELECT COUNT(*) FROM guest g INNER JOIN ticket_details td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = CURRENT_DATE";
    $totalGuestCount = getCount($connect, $sqlTotalGuest);

    // Close database connection
    $connect->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin — Dashboard</title>
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
            
            <div class="date-container">
                <i id="calendar-icon" class="fa-solid fa-calendar-days"></i>
                <h1 id="currentDate"></h1>
            </div>
            
            <div class="data-container">
                <div class="total-container">

                    <div class="total">
                        <div class="total-box">
                            <i class="fa-solid fa-users"></i>
                            <span id="totalGuest"><?php echo $totalGuestCount; ?></span>
                        </div>
                        <div class="label">Total No. of Guest</div>
                    </div>

                </div>

                <div class="data-body-container">
                    <div class="cont-for-all">
                        <div class="cont-box">
                            <i class="fa-solid fa-user"></i>
                            <span id="mnlResident"><?php echo $mnlResidentCount; ?></span>
                        </div>
                        <div class="label">Manila Resident</div>
                    </div>
                    <div class="cont-for-all">
                        <div class="cont-box">
                            <i class="fa-solid fa-user"></i>
                            <span id="nonMnlResident"><?php echo $nonMnlResidentCount; ?></span>
                        </div>
                        <div class="label">Non-Manila Resident</div>
                    </div>
                    <div class="cont-for-all">
                        <div class="cont-box">
                            <i class="fa-solid fa-user"></i>
                            <span id="student"><?php echo $studentCount; ?></span>
                        </div>
                        <div class="label">Student</div>
                    </div>
                    <div class="cont-for-all">
                        <div class="cont-box">
                            <i class="fa-solid fa-user"></i>
                            <span id="scPwd"><?php echo $scPwdCount; ?></span>
                        </div>
                        <div class="label">Senior Citizen & PWD</div>
                    </div>
                    <div class="cont-for-all">
                        <div class="cont-box">
                            <i class="fa-solid fa-user"></i>
                            <span id="mnlEmp"><?php echo $mnlEmpCount; ?></span>
                        </div>
                        <div class="label">Manila Employee</div>
                    </div>
                </div>

                <?php 
                        include("database_archive.php");
    
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            
                            if (isset($_POST['chooseAnalytics'])) {
                                
                                $chosenAnalytics = $_POST['chooseAnalytics'];
    
                                if($chosenAnalytics === "Daily") {
                                    $date = $_POST['dateForDaily'];
    
                                    $sql = "SELECT COUNT(ga.Guest_No) AS total_Guests, tda.Schedule_Date FROM guest_archive AS ga INNER JOIN ticket_details_archive AS tda ON ga.Ticket_ID = tda.Ticket_ID WHERE tda.Schedule_Date = '$date' GROUP BY tda.Schedule_Date;";
                                    $stmt = $connect_archive->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
    
                                    $row = $result->fetch_assoc();
                                    // Now you can access the Total_Guests from the fetched row
                                    if($row['total_Guests']) {
                                        $totalGuest = $row['total_Guests'];
                                    }else{
                                        $totalGuest = 0;
                                    }
    
                                    function getCountAnalytics($connect_archive, $sql) {
                                        $result = $connect_archive->query($sql);
                                        if ($result) {
                                            $row = $result->fetch_row();
                                            return $row[0]; // Return count
                                        } else {
                                            return "Error: " . $connect_archive->error; // Return error message on failure
                                        }
                                    }
    
                                    $sql = "SELECT COUNT(*) FROM guest_archive g INNER JOIN ticket_details_archive td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = '$date' AND g.Residency = 'MNL'";
                                    $manilaResidentCountAnalytics = getCountAnalytics($connect_archive, $sql);
                                    //echo "Number of manila resident: " . $manilaResidentCountAnalytics;
    
                                    $sql = "SELECT COUNT(*) FROM guest_archive g INNER JOIN ticket_details_archive td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = '$date' AND g.Residency = 'NON-MNL'";
                                    $nonManilaResidentCountAnalytics = getCountAnalytics($connect_archive, $sql);
                                    //echo "Number of non-manila resident: " . $nonManilaResidentCountAnalytics;
    
                                    $sql = "SELECT COUNT(*) FROM guest_archive g INNER JOIN ticket_details_archive td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = '$date' AND g.Guest_Status = 'STUD'";
                                    $studentCountAnalytics = getCountAnalytics($connect_archive, $sql);
                                    //echo "Number of student: " . $studentCountAnalytics;
    
                                    $sql = "SELECT COUNT(*) FROM guest_archive g INNER JOIN ticket_details_archive td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = '$date' AND g.Guest_Status = 'SC-PWD'";
                                    $scPwdCountAnalytics = getCountAnalytics($connect_archive, $sql);
                                    //echo "Number of senior/pwd: " . $scPwdCountAnalytics;
    
                                    $sql = "SELECT COUNT(*) FROM guest_archive g INNER JOIN ticket_details_archive td ON g.Ticket_ID = td.Ticket_ID WHERE td.Schedule_date = '$date' AND g.Guest_Status = 'MNL-EMP'";
                                    $manilaEmpCountAnalytics = getCountAnalytics($connect_archive, $sql);
                                    //echo "Number of manila emp: " . $manilaEmpCountAnalytics;
    
                                    $sql = "SELECT SUM(Ticket_Price) AS total_Price FROM ticket_details_archive WHERE Schedule_Date = '$date';";
                                    $stmt = $connect_archive->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
    
                                    $row = $result->fetch_assoc();
                                    // Now you can access the Total_Guests from the fetched row
                                    if($row['total_Price']) {
                                        $totalEarningsAnalytics = $row['total_Price'];
                                    }else{
                                        $totalEarningsAnalytics = 0;
                                    }
                                    //echo "Total earnings: " . $totalEarningsAnalytics;
                                    
                                }
    
                                if($chosenAnalytics === "Monthly") {
    
                                }
    
                                if($chosenAnalytics === "Monthly") {
    
                                }
    
                            }
                        }
                
                ?>

                <form action="show-analytics.php" method="post" style="background:transparent; border:none;">
                    <div id="choose-analytics-modal" class="choose-analytics-modal">
                        <div class="choose-analytics-container">
                            <label>Choose Target:</label>
                            <select id="chooseAnalytics" name="chooseAnalytics">
                                <option value="Daily">Daily</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>

                            <label id="dailyDateLabel">Select Date:</label>
                            <input type="date" id="dateForDaily" name="dateForDaily">

                            <label id="monthlyMonthLabel" id="monthlyMonthLabel" style="display: none;">Select Month:</label>
                            <select id="monthForMonthly" style="display: none;">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <label id="monthlyYearLabel" style="display: none;">Enter year:</label>
                            <input type="number" id="yearForMonthly"  value="1" style="display: none;">

                            <label id="yearlyYearLabel" style="display: none;">Enter year:</label>
                            <input type="number" id="yearForYearly"  value="1" style="display: none;">

                            <div class="choose-analytics-action-container">
                                <div class="cancel-btn" id="cancel-btn">Cancel</div>
                                <input type="submit" class="generate-btn" id="generate-btn" value="Generate">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            
            <button onclick="showSelectAnalytics()" class="show-analytics-btn">Show Analytics</button>

        </div>



    </div>
    <script src="../js/dashboard.js"></script>
</body>
</html>
