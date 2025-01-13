<!DOCTYPE html>
<html lang="en">
    <?php include("assets/html-head.php"); ?>
    <head>
        <title>Manila Zoo — Operating Hours</title>
        <style>
            body {
                font-family: "Inter", sans-serif;
                margin: 0;
                background-color: #f8f8f8;
            }

            h1 {
                font-size: 36px;
                margin-bottom: 20px;
            }

            #hoursTable { 
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #ddd;
                font-size: 18px; 
                padding: 20px;
            }

            #hoursTable th,
            #hoursTable td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: center;
            }

            #hoursTable th {
                background-color: #45BCC8;
                color: white;
                font-size: 20px;
                font-style: italic;
                padding: 20px 15px;
            }

            #hoursTable td {
                font-size: 18px;
                padding: 20px 15px;
            }

            #hoursTable tbody tr:nth-child(odd) {
                background-color: #f2f2f2; /* Light gray for odd rows */
            }

            #hoursTable tbody tr:nth-child(even) {
                background-color: #ffffff; /* White for even rows */
            }

            #hours .table-container {
                padding: 0px 24% 80px 24%;
            }

            #hours p {
                padding-bottom: 30px;
            }
        </style>
    </head>

    <body>
        <?php include("assets/header.php"); ?>

        <section id="hours" class="visible">
            <div id="hours1">
                <h1 class="titles">OPERATING HOURS</h1>
            </div>
            <div id="hours2"> 
                <div class="subtitles">
                    <h1>Manila Zoo's Operating Hours</h1>
                </div>

                <div class="main-content">
                    <p>From early morning explorations to evening adventures, Manila Zoo's flexible
                    operating hours cater to every schedule, ensuring you can experience the excitement of
                    wildlife whenever it suits you best. Embrace the opportunity to witness fascinating animal habitats
                    and engage in educational experiences throughout the day.</p>
                <div>
                <div class="table-container">
                    <table id="hoursTable">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Hours</th>
                            </tr>
                        </thead>
                        <tbody id="hoursTableBody">
                            <?php
                                // Load operating hours from JSON file
                                $json = file_get_contents('assets/operating_hours.json');
                                $hours = json_decode($json, true);
                                
                                // Display operating hours in table rows
                                foreach ($hours as $day => $hour) {
                                    echo "<tr>";
                                    echo "<td>$day</td>";
                                    echo "<td>$hour</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Include your JavaScript file -->
                <script src="../js/admin-operating-hours.js"></script>
            </div>
        </section>

        <?php include("assets/footer.php"); ?>
    </body>
</html>