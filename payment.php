<?php
    require_once('vendor/autoload.php');
    session_start();
    include("database.php"); 

    $_SESSION['eachPrice'] = [];
    $_SESSION['totalPrice'] = null;
    $_SESSION['ticketID'] = null;

    // Read the ticket rates from JSON file
    $ticket_rates_json = file_get_contents('assets/ticket_rates.json');
    $ticket_rates = json_decode($ticket_rates_json, true);

    $total_price = 0;

    $guest_count = count($_SESSION['residency']);
    $_SESSION['totalGuest'] = $guest_count;

    for($i = 0; $i < $guest_count; $i++) {
        $total_price += getEachPrice($_SESSION['residency'][$i], $_SESSION['status'][$i], $ticket_rates);
        $_SESSION['eachPrice'][$i] = getEachPrice($_SESSION['residency'][$i], $_SESSION['status'][$i], $ticket_rates);
    }

    $_SESSION['totalPrice'] = $total_price;
    
    function getEachPrice($residency, $status, $ticket_rates) {

        if($status === 'MNL-EMP' || $status === 'NON-MNL-EMP') {
            $key = 'MNL-EMP';
        } elseif ($status === 'OTHER-CITIZEN') {
            $key = 'OTHER-CITIZEN';
        } else {
            $key = $status . "-" . $residency;
        }
        
        return isset($ticket_rates[$key]) ? $ticket_rates[$key] : 0;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ticketId = generateUniqueTicketID();
        $_SESSION['ticketID'] = $ticketId;
        
        for($i = 0; $i < $guest_count; $i++) {

            $eachPrice = getEachPrice($_SESSION['residency'][$i], $_SESSION['status'][$i], $ticket_rates);
            
            if($i == 0) {
                $stmt = $connect->prepare("INSERT INTO ticket_details (Ticket_ID, Schedule_Date, Ticket_Price, Guest_Count)
                                            VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssdi", $ticketId, $_SESSION['selectedDate'], $total_price, $guest_count);
                $stmt->execute();
                $stmt->close();
            }

            $stmt = $connect->prepare("INSERT INTO guest (Guest_FirstName, Guest_LastName, Gender, Age, Residency, Guest_Status, Ticket_ID, Contact_No, Email, Price)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            
            $stmt->bind_param("sssisssssd", $_SESSION['firstName'][$i], $_SESSION['lastName'][$i], $_SESSION['gender'][$i], $_SESSION['age'][$i], $_SESSION['residency'][$i], $_SESSION['status'][$i], $ticketId, $_SESSION['mobileNo'][$i], $_SESSION['email'][$i], $eachPrice);
            $stmt->execute();
            $stmt->close();

        }

        $selectedDay = date('d', strtotime($_SESSION['selectedDate']));
        $paymentLabel = $guest_count . " " . "ticket/s";
        $stmt = $connect->prepare("UPDATE slot SET Slots = Slots - ? WHERE Date = ?");
        $stmt->bind_param('ii',$guest_count, $selectedDay);
        $stmt->execute();
        $stmt->close();

        $connect->close();
        
        function createCheckoutSession($itemName, $price, $quantity, $customerEmail, $successUrl, $cancelUrl) {
        $client = new \GuzzleHttp\Client();
        $secretApiKey = 'sk_test_H3RcTM1CER85QtMbhfCuoEim';
        $encodedApiKey = base64_encode($secretApiKey . ':');
        $authorizationHeader = 'Basic ' . $encodedApiKey;
      
        $data = [
          'data' => [
            'attributes' => [
              'success_url' => $successUrl,
              'cancel_url' => $cancelUrl,
              'payment_method_types' => ['gcash', 'paymaya'],
              'show_description' => false,
              'description' => true,// Adjust as needed
              'line_items' => [
                [
                  'amount' => $price * 100, // Convert to cents
                  'currency' => 'PHP',
                  'name' => $itemName,
                  'quantity' => 1,
                  'description' => $paymentLabel , 
                ],
              ],
            ],
          ],
        ];
      
        try {
          $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
            'json' => $data,
            'headers' => [
              'Content-Type' => 'application/json',
              'accept' => 'application/json',
              'authorization' => $authorizationHeader,
            ],
          ]);
      
          $responseBody = $response->getBody();
          $checkoutSession = json_decode($responseBody, true);
      
          return $checkoutSession['data']['attributes']['checkout_url'];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
          echo 'Request failed: ' . $e->getMessage();
          return null;
        }
      }
      
      // Example usage:
      $itemName = 'Manila Zoo Ticket';
      $price = $_SESSION['totalPrice'];
      $quantity = 1;
      $customerEmail = 'customer@example.com';
      $successUrl = 'https://thenewmanilazoo.fun/';
      $cancelUrl = 'https://thenewmanilazoo.fun/';
      
      $checkoutUrl = createCheckoutSession($itemName, $price, $quantity, $customerEmail, $successUrl, $cancelUrl);
      
      if ($checkoutUrl) {
        header('Location: ' . $checkoutUrl);
      } else {
        echo 'Failed to create checkout session.';
      }
      
        
        // session_destroy();
        // header("Location: payment-success.php");
        // exit;
    }


    
    

    function generateUniqueTicketID() {
        // Start with T
        $ticketId = 'T';
        
        // Generate and append a letter (N-Z, skipping O to avoid confusion with 0)
        $letters = range('N', 'Z');
        unset($letters[array_search('O', $letters)]); // Optional: remove 'O' to avoid confusion
        $ticketId .= $letters[array_rand($letters)];
        
        // Append a digit (2-9, to match your example)
        $ticketId .= rand(2, 9);
        
        // Add first separator
        $ticketId .= '-';
        
        // Append three digits
        $ticketId .= sprintf('%03d', rand(0, 999));
        
        // Add a letter (A-D)
        $ticketId .= chr(rand(65, 68)); // ASCII values for A-D
        
        // Add second separator
        $ticketId .= '-';
        
        // Append three more digits
        $ticketId .= sprintf('%03d', rand(0, 999));
        
        // Final letter (A-D)
        $ticketId .= chr(rand(65, 68));
        
        return $ticketId;
    }
    
?>

<html lang="en">
    <?php include("assets/html-head.php"); ?>
    <head>
        <title>Manila Zoo — Tickets</title>
    </head>
    <body>
        <section id="payment" class="visible">
            <div id="payment1">
                <h1 class="titles">TICKETS</h1>
            </div>

            <div id="payment-join">
                <div id="payment2">
                    <div class="icon-back">
                        <a href="set-date.php"><i class="ri-arrow-left-double-line"></i>BACK</a>
                    </div>
                    <div>
                        <a href="#index.html" class="logo3"><img src="images/logo.png" alt="Logo"></a>
                        <h1 class="main-head">Appointment Summary</h1>
                        <p>Confirm appoinment details to proceed with payment.</p>
                    </div>
                </div>
                <div id="payment3">
                    <form method="post" action="">
                        <div class="appointmentSummary-container">
                            <div class="container">
                                <h4>Appointment Summary</h4>
                                <div class="details-appointment">
                                    <span>Date:</span><span class="span-value" id="dateValue">
                                        
                                        
                                        <?php
                                            $date = new DateTime($_SESSION['selectedDate']);
                                            echo $date->format('F, j, Y'); 

                                        ?>
                                        
                                    </span>
                                </div>
                                <div class="details-appointment">
                                    <span>Location:</span><span class="location">Manila Zoo, Adriatico St., Malate, <br> Manila, Metro Manila, Philippines</span>
                                </div>
                                <div class="details-appointment">
                                    <span>Total Price:</span><span class="span-value"><?php echo number_format($total_price, 2); ?></span>
                                </div>
                            </div>
                            <div class="payButton" id="payButton">PAY NOW</div>
                            <div class="confirm-container" id="confirmation">
                                <div class="confirm-label">Confirm Payment?</div>
                                <div class="buttons">
                                    <div class="cancel-btn" id="cancel-btn">CANCEL</div>
                                    <button class="submit-btn confirm-btn">CONFIRM</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <script src="js/payment.js"></script>
    </body>
</html>
