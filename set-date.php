<?php
    session_start(); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION['selectedDate'] = $_POST['selectedDate'];
        header("Location: payment.php");
        exit;
    }
?>

<html lang="en">
    <?php include("assets/html-head.php"); ?>
    <head>
        <title>Manila Zoo — Tickets</title>
    </head>

    <body>
        <section id="set-date" class="visible">
            <div id="set-date1">
                <h1 class="titles">TICKETS</h1>
            </div>

            <div id="set-date-join">
                <div class="set-date2">
                    <div class="icon-back">
                        <a href="ticket.php"><i class="ri-arrow-left-double-line"></i>BACK</a>
                    </div>                    
                    <a href="#index.html" class="logo3"><img src="images/logo.png" alt="Logo"></a>
                    <h1 class="main-head">Schedule Appointment</h1>
                    <p>Please select your preferred date of visit.</p>
                    <a id="hours-button" href="hours.php"><button>VIEW OPERATING HOURS</button></a>
                </div>

                <div class="set-date3">
                    <form method="post" action="" onsubmit="return isSelectedDate()">
                        <div id="dateContainer" class="dateContainer">
                            <div class="calendar-container">
                                <h2 id="monthYear"></h2>
                                <table class="calendar-table">
                                    <tr>
                                        <th>Sun</th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th>Sat</th>
                                    </tr>

                                    <tbody id="calendar-body">
                                    </tbody>
                                    
                                </table>
                            </div>
                            <input type="hidden" name="selectedDate" id="selectedValue" >

                            <div class="appointmentDetails-container">
                                <div class="container">
                                    <h4>Appointment Details</h4>
                                    <div class="details-appointment">
                                        <span>Date:</span><span class="span-value" id="dateValue">-Select Date-</span>
                                    </div>
                                    <div class="details-appointment">
                                        <span>Operating Hours:</span><span class="span-value" id="OperatingHours">-Select Date-</span>
                                    </div>
                                    <div class="details-appointment">
                                        <span>Remaining:</span><span class="span-value" id="slotValue">-Select Date-</span>
                                    </div>
                                    <div class="details-appointment">
                                        <span>Location:</span><span class="location">Manila Zoo, Adriatico St., Malate, <br> Manila, Metro Manila, Philippines</span>
                                    </div>
                                   
                                </div>
                                
                                <input type="submit" value="PROCEED TO CHECKOUT">

                            </div>
                            
                        </div>
                        
                    </form>
                </div>
            </div>
        <script src="js/calendar.js"></script>
    </body>

    <Files "assets/operating_hours.json">
            Header set Cache-Control "no-cache"
    </Files>
</html>
