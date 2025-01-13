<?php
// Assuming you're sending data as JSON
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

if(isset($input['key']) && isset($input['price'])) {
    $file = '../assets/ticket_rates.json';
    $data = json_decode(file_get_contents($file), true);
    
    // Update the price for the given key
    $data[$input['key']] = $input['price'];
    
    // Save the updated data back to the file
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    
    echo json_encode(["success" => true, "message" => "Ticket rate updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
