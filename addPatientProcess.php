<?php
require 'connection.php'; // Include your database connection file

// Get form data
$name = $_POST['name'];
$nic = $_POST['nic'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$date = $_POST['date'];

try {
    // Prepare SQL query
    $query = "INSERT INTO patient (pName, nic, pEmail, pPhoneNumber, gender, date) VALUES (?, ?, ?, ?, ?, ?)";
    Database::iud($query, [$name, $nic, $email, $phone, $gender, $date], "ssssss");


    // Success message and redirect
    echo "<script>alert('Patient registered successfully');</script>";
    header("Location: PatientRegistration.php"); // Redirect to Patient Registration Page
    exit();
} catch (Exception $e) {
    die("Error: " . $e->getMessage()); // Handle any errors
}
?>
