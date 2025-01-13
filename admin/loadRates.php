<?php
header('Content-Type: application/json');
echo file_get_contents('../assets/ticket_rates.json');