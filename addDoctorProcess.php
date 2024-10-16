<?php
require 'connection.php';

$nic = $_POST['nic'];
$dname = $_POST['dname'];
$email = $_POST['email'];
$speciality = $_POST['speciality'];

try {
    
    $query = "INSERT INTO doctor (nic, dName, dEmail, special_id) VALUES (?, ?, ?, ?)";
    Database::iud($query, [$nic, $dname, $email, $speciality], "sssi");

    echo "<script>alert(Data added successfully');</script>";
    header("Location: addDoctor.php");
    exit();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
