<?php
$host = 'localhost'; 
$dbname = 'u573194023_zoo'; 
$username = 'u573194023_kapitanstone'; 
$password = 'KapitanStone@2024'; 

// Connect to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Check if 'date' parameter is set
if(isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Prepare SQL query to fetch the slots for the selected date
    $stmt = $conn->prepare("SELECT Slots FROM slot WHERE Date = :date");
    $stmt->bindParam(':date', $selectedDate);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the number of slots or a default value if no record is found
    echo json_encode(array('slots' => $result ? $result['Slots'] : 'No slots available'));
} else {
    echo json_encode(array('error' => 'Date not specified'));
}
?>
