<?php
// Read the JSON file
$jsonFile = '../assets/operating_hours.json';
$jsonData = file_get_contents($jsonFile);
$hours = json_decode($jsonData, true);

// Get the data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$day = $data['day'];
$newHours = $data['hours'];

// Update the hours for the specified day
$hours[$day] = $newHours;

// Encode the updated data back to JSON format
$newJsonData = json_encode($hours, JSON_PRETTY_PRINT);

// Write the updated JSON data back to the file
file_put_contents($jsonFile, $newJsonData);

echo 'Operating hours updated successfully';
?>
