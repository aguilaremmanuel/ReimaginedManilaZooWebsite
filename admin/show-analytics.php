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
</head>
<body>

    <div class="wrapper">

        <div class="side-bar">
            <div class="header">
                <div class="head-container">
                    <img src="../images/logo.png" alt="Manila Zoo Logo">
                    <h2>ADMIN</h2>
                </div>
 
            </div>
            <div class="dashboard-nav"> <a href="dashboard.php">Dashboard</a></div>
            <div class="feature-header"><span>FEATURES:</span></div>
            <div class="feature-nav"><a href="today-appointment.php">Incoming Appointments</a></div>
            <div class="feature-nav"><a href="archive-appointment.php">Past Appointments</a></div>
            <div class="feature-nav"><a href="ticket-categories.php">Ticket Categories</a></div>
            <div class="feature-nav"><a href="admin-animals.php">Animals Management</a></div>
            <div class="feature-nav"><a href="admin-plants.php">Plants Management</a></div>
            <div class="feature-nav"><a href="admin-events.php">Events Management</a></div>
            <div class="feature-nav"><a href="admin-operations.php">Operations</a></div>

            
        </div>

        <div class="main-container" id="mainContainer-dashboard" style="background-color: #05042d;">
            <div class="date-container">
                <i id="calendar-icon" class="fa-solid fa-calendar-days"></i>
                <h1 id="currentDate"></h1>
            </div>
        
                <?php 
                    include("../database_archive.php");

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        if (isset($_POST['chooseAnalytics'])) {
                            
                            $chosenAnalytics = $_POST['chooseAnalytics'];

                            if($chosenAnalytics === "Daily") {
                                $date = $_POST['dateForDaily'];

                                $sql = "SELECT COUNT(ga.Guest_No) AS Total_Guests, tda.Schedule_Date FROM guest_archive AS ga INNER JOIN ticket_details_archive AS tda ON ga.Ticket_ID = tda.Ticket_ID WHERE tda.Schedule_Date = '$date' GROUP BY tda.Schedule_Date;";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                // Now you can access the Total_Guests from the fetched row
                                if($row['Total_Guests']) {
                                    $totalGuest = $row['Total_Guests'];
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

                                $sql = "SELECT SUM(Ticket_Price) AS Total_Price FROM ticket_details_archive WHERE Schedule_Date = '$date'";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                // Now you can access the Total_Guests from the fetched row
                                if($row['Total_Price']) {
                                    $totalEarningsAnalytics = $row['Total_Price'];
                                }else{
                                    $totalEarningsAnalytics = 0;
                                }
                                //echo "Total earnings: " . $totalEarningsAnalytics;
                                
                            }

                            if($chosenAnalytics === "Monthly") {
                                $month = $_POST['monthForMonthly'];
                                $year = $_POST['yearForMonthly'];
                                

                                $sql = "SELECT COUNT(*) AS TotalGuests
                                FROM guest_archive ga
                                JOIN ticket_details_archive tda ON ga.Ticket_ID = tda.Ticket_ID
                                WHERE YEAR(tda.Schedule_Date) = '$year' AND MONTH(tda.Schedule_Date) = '$month';";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                // Now you can access the Total_Guests from the fetched row
                                if($row['TotalGuests']) {
                                    $totalGuest = $row['TotalGuests'];
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

                                $sql = "SELECT COUNT(*) AS TotalGuestsMNL
                                FROM guest_archive ga
                                JOIN ticket_details_archive tda ON ga.Ticket_ID = tda.Ticket_ID
                                WHERE YEAR(tda.Schedule_Date) = '$year' AND MONTH(tda.Schedule_Date) = '$month'
                                AND ga.Residency = 'MNL';";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $manilaResidentCountAnalytics = $row['TotalGuestsMNL'];

                                $sql = "SELECT COUNT(*) AS TotalGuestsNonMNL
                                FROM guest_archive ga
                                JOIN ticket_details_archive tda ON ga.Ticket_ID = tda.Ticket_ID
                                WHERE YEAR(tda.Schedule_Date) = '$year' AND MONTH(tda.Schedule_Date) = '$month'
                                AND ga.Residency = 'NON-MNL';";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $nonManilaResidentCountAnalytics = $row['TotalGuestsNonMNL'];

                                $sql = "SELECT COUNT(*) AS TotalGuestsSTUD
                                FROM guest_archive ga
                                JOIN ticket_details_archive tda ON ga.Ticket_ID = tda.Ticket_ID
                                WHERE YEAR(tda.Schedule_Date) = '$year' AND MONTH(tda.Schedule_Date) = '$month'
                                AND ga.Guest_Status = 'STUD';";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $studentCountAnalytics = $row['TotalGuestsSTUD'];

                                $sql = "SELECT COUNT(*) AS TotalGuestsSCPWD
                                FROM guest_archive ga
                                JOIN ticket_details_archive tda ON ga.Ticket_ID = tda.Ticket_ID
                                WHERE YEAR(tda.Schedule_Date) = '$year' AND MONTH(tda.Schedule_Date) = '$month'
                                AND ga.Guest_Status = 'SC-PWD';";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $scPwdCountAnalytics = $row['TotalGuestsSCPWD'];

                                $sql = "SELECT COUNT(*) AS TotalGuestsMNLEMP
                                FROM guest_archive ga
                                JOIN ticket_details_archive tda ON ga.Ticket_ID = tda.Ticket_ID
                                WHERE YEAR(tda.Schedule_Date) = '$year' AND MONTH(tda.Schedule_Date) = '$month'
                                AND ga.Guest_Status = 'MNL-EMP';";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $manilaEmpCountAnalytics = $row['TotalGuestsMNLEMP'];


                                $firstDayOfMonth = sprintf("%04d-%02d-01", $year, $month);

                                // Calculate the last day of the month
                                $lastDayOfMonth = date("Y-m-t", strtotime($firstDayOfMonth));

                                // SQL query to sum the prices for the given month and year
                                $sql = "SELECT SUM(Ticket_Price) AS TotalPriceForMonth
                                        FROM ticket_details_archive
                                        WHERE Schedule_Date >= '$firstDayOfMonth' AND Schedule_Date <= '$lastDayOfMonth'";
                                $stmt = $connect_archive->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $totalEarningsAnalytics = $row['TotalPriceForMonth'];
                                
                            }

                            if($chosenAnalytics === "Yearly") {

                            }

                        }
                    }
                
                ?>
            
            <div class="for-centering-analytics">

                <div class="show-analytics-container">

                    <!-- Container for the bar graph -->
                    <div class="graph-container" id="barGraph"></div>

                    <!-- Legend for the bar graph -->
                    <div class="legend" id="legend"></div>

                    <script>
                    // Data from PHP
                    var data = <?php echo json_encode([
                        'Manila Resident' => $manilaResidentCountAnalytics,
                        'Non Manila Resident' => $nonManilaResidentCountAnalytics,
                        'Student' => $studentCountAnalytics,
                        'Senior Citizen & PWD' => $scPwdCountAnalytics,
                        'Manila Employee' => $manilaEmpCountAnalytics,
                    ]); ?>;

                    // Colors for each bar
                    var colors = ['#FF5733', '#33FF57', '#3357FF', '#FF33F6', '#F6FF33', '#33FFF6'];

                    // Function to generate the vertical bar graph
                    function generateBarGraph(data, colors) {
                        var container = document.getElementById('barGraph');
                        var legend = document.getElementById('legend');
                        var maxValue = Math.max(...Object.values(data)); // Find max value for relative bar heights

                        Object.keys(data).forEach(function(key, index) {
                            var value = data[key];
                            var barHeight = (value / maxValue) * 100; // Calculate height as a percentage of the container height
                            var bar = document.createElement('div');
                            bar.setAttribute('class', 'bar');
                            bar.style.height = barHeight + '%';
                            bar.style.backgroundColor = colors[index % colors.length]; // Cycle through colors
                            bar.innerHTML = value;
                            container.appendChild(bar);

                            var label = document.createElement('div');
                            label.setAttribute('class', 'label');
                            label.innerHTML = key;
                            container.appendChild(label);

                            // Add legend item
                            var legendItem = document.createElement('div');
                            legendItem.setAttribute('class', 'legend-item');
                            var legendColor = document.createElement('div');
                            legendColor.setAttribute('class', 'legend-color');
                            legendColor.style.backgroundColor = colors[index % colors.length];
                            legendItem.appendChild(legendColor);

                            var legendText = document.createElement('span');
                            legendText.innerHTML = key;
                            legendItem.appendChild(legendText);

                            legend.appendChild(legendItem);
                        });
                    }

                    // Generate the graph on page load
                    generateBarGraph(data, colors);
                    </script>

                </div>

            </div>

        </div>

        <div class="ticket-summary-container">
            <div id="ticketSummayHead">Ticket Summary (as of <?php 
            
            if($chosenAnalytics === "Daily") {
                echo $date; 
            }
            if($chosenAnalytics === "Monthly") {
                function numberToMonth($number) {
                    return date("F", mktime(0, 0, 0, $number, 1, 2000)); // Year is arbitrary, only month number is relevant
                }

                echo numberToMonth($month) . " " . $year;
            }
            
            
            ?>):</div>
            <div>Total Guest: <?php echo $totalGuest ?></div>
            <div>Manila Resident/s: <?php echo $manilaEmpCountAnalytics; ?></div>
            <div>Non-Manila Resident/s: <?php echo $nonManilaResidentCountAnalytics; ?></div>
            <div>Student/s: <?php echo $studentCountAnalytics; ?></div>
            <div>Senior Citizen & PWD: <?php echo $scPwdCountAnalytics; ?></div>
            <div>Manila Employee <?php echo $manilaEmpCountAnalytics; ?></div>
            <div id="totalEarnings">Total Earnings: Php <?php echo $totalEarningsAnalytics; ?>.00</div>
        </div>

    </div>
    <script src="../js/dashboard.js"></script>
</body>
</html>
