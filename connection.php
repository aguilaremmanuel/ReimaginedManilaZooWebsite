<?php
$conn = mysqli_connect("localhost", "root", "", "zoo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the img and sounds folders if they don't exist
if (!file_exists('img')) {
    mkdir('img', 0777, true);
}

if (!file_exists('sounds')) {
    mkdir('sounds', 0777, true);
}
?>
