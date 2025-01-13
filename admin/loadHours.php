<?php
header('Content-Type: application/json');

// Read the JSON file
$jsonFile = '../assets/operating_hours.json';
$currentData = json_decode(file_get_contents($jsonFile), true);

echo json_encode($currentData);
?>
