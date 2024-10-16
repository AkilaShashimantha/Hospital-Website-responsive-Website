<?php
require 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nic = $_POST['nic'];

    try {
        // Prepare SQL query to delete the patient by NIC
        $query = "DELETE FROM patient WHERE nic = ?";
        
        // Execute the query using your Database class
        Database::iud($query, [$nic], "s");

        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Patient record deleted successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>