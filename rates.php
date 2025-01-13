<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("assets/html-head.php"); ?>
    <title>Manila Zoo — Ticket Rates</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/ticket-categories.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

        #ticketRatesTable { 
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            font-size: 18px; 
            padding: 20px;
        }

        #ticketRatesTable th,
        #ticketRatesTable td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        #ticketRatesTable th {
            background-color: #45BCC8;
            color: white;
            font-size: 24px;
            font-style: italic;
            padding: 20px 15px;
        }

        #ticketRatesTable td {
            font-size: 18px;
            padding: 20px 15px;
        }

        #ticketRatesTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2; /* Light gray for odd rows */
        }

        #ticketRatesTable tbody tr:nth-child(even) {
            background-color: #ffffff; /* White for even rows */
        }

        #rates .table-container{
            padding: 30px 24% 80px 24%;
        }
    </style>

</head>

<body>
    <?php include("assets/header.php"); ?>

    <section id="rates" class="visible">
        <div id="rates1">
            <h1 class="titles">TICKET RATES</h1>
        </div>

        <div id="rates2">
            <div class="subtitles">
                <h1>Latest Ticket Prices and Types</h1>
            </div>
            <div class="main-content">
                <p>Whether you're planning a solo adventure or a family getaway, our affordable rates
                make it easier than ever to enjoy the wonders of wildlife right at the heart of
                the city. Take advantage of these updated prices and embark on a memorable journey
                here at Manila Zoo. Book your tickets today!</p>
                <a id="ticket-button" href="ticket.php"><button>BUY TICKETS &nbsp;<i class="ri-coupon-2-fill"></i></button></a>
            <div>
            <div class="table-container">
                <table id="ticketRatesTable">
                    <thead>
                        <tr>
                            <th>Ticket Type</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="ratesTableBody">
                        <!-- Ticket rates will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php include("assets/footer.php"); ?>

    <script>
        // Function to load ticket rates from the JSON file
        function loadTicketRates() {
            fetch('assets/ticket_rates.json')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('ratesTableBody');
                    tableBody.innerHTML = ''; // Clear the table body

                    for (let key in data) {
                        if(key !== 'OTHER-CITIZEN'){
                            let row = tableBody.insertRow();
                            let cell1 = row.insertCell();
                            let cell2 = row.insertCell();
                        
                            cell1.textContent = displayTicketType(key);
                            cell2.textContent = `₱${data[key].toFixed(2)}`;
                        }
                    }
                })
                .catch(error => console.error('Error loading ticket rates:', error));
        }

        // Call loadTicketRates function when the page loads
        window.onload = function() {
            loadTicketRates();
        };

        // Function to display ticket type based on the key
        function displayTicketType(key) {
            let ticketType = null;

            switch(key) {
                case "REG-MNL":
                    ticketType =  "Regular Manila Resident";
                    break;
                case "REG-NON-MNL":
                    ticketType =  "Regular Non-Manila Resident";
                    break;
                case "STUD-MNL":
                    ticketType =  "Student Manila Resident";
                    break;
                case "STUD-NON-MNL":
                    ticketType =  "Student Non-Manila Resident";
                    break;
                case "SC-PWD-MNL":
                    ticketType =  "Senior Citizen and PWD Manila Resident";
                    break;
                case "SC-PWD-NON-MNL":
                    ticketType =  "Senior Citizen and PWD Non-Manila Resident";
                    break;
                case "CHLDRN":
                    ticketType =  "Children";
                    break;
                case "MNL-EMP":
                    ticketType =  "Manila Employee";
                    break;
            }

            return ticketType;
        }
    </script>

</body>
</html>