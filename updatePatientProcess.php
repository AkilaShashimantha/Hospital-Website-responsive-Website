<?php
require 'connection.php'; // Include your database connection file

// Get form data
$nic = $_POST['nic'];
$name = $_POST['name'];

try {
    // Prepare SQL query to update the patient name based on NIC
    $query = "UPDATE patient SET pName = ? WHERE nic = ?";
    
    // Execute the query using the Database class
    Database::iud($query, [$name, $nic], "ss");

    // Return success message
    echo json_encode(["status" => "success", "message" => "Patient details updated successfully."]);
} catch (Exception $e) {
    // Return error message
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
?>

