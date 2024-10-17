<?php
// process_payment.php
session_start();
require 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["pName"]) && isset($_POST["nic"]) && isset($_POST["email"]) &&
        isset($_POST["phone"]) && isset($_POST["gender"]) && isset($_POST["doctor"]) &&
        isset($_POST["date"])) {

        $pName = $_POST["pName"];
        $nic = $_POST["nic"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $doctor = $_POST["doctor"];
        $date = $_POST["date"];

        // Rest of the code here

        $appNum = "";
    
        $query = "SELECT COUNT(*) as appointment_count FROM appointment WHERE doctor LIKE '%" . $doctor . "%' AND aDate = '" . $date . "'";
        $result = Database::search($query);
        if ($row = $result->fetch_assoc()) {
            $appointment_count = $row['appointment_count'];
        } else {
            $appointment_count = 0; // Set count to 0 if no results
        }
        $appointment_count += 1;
        
        $appNum = $appointment_count;

        $query = "INSERT INTO appointment (email, pName, nic, doctor, phoneNumber, appNum, aDate) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        Database::iud($query, [$email, $pName, $nic, $doctor, $phone, $appNum, $date], "sssssss");
        
        $_SESSION['pName'] = $pName;
        $_SESSION['nic'] = $nic;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['gender'] = $gender;
        $_SESSION['doctor'] = $doctor;
        $_SESSION['date'] = $date;
        $_SESSION['appNum'] = $appNum;


    } else {
        echo "Error: Missing form inputs.";
    }

    
   
} else {
    echo "No form data received.";

}
    
    
    

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$payment_method = sanitize_input($_POST['payment_method']);
$amount = floatval($_POST['amount']);
$user_id = $_SESSION['user_id'];

$transaction_id = uniqid('txn_');
$_SESSION['transaction_id'] = $transaction_id ;
$status = 'Pending';

$errors = [];

// Validate amount
if ($amount <= 0) {
    $errors[] = "Invalid payment amount.";
}

// Handle different payment methods
switch ($payment_method) {
    case 'Credit/Debit Card':
        $card_number = sanitize_input($_POST['card_number']);
        $card_name = sanitize_input($_POST['card_name']);
        $expiry = sanitize_input($_POST['expiry']);
        $cvv = sanitize_input($_POST['cvv']);

        // Basic validation
        if (!preg_match('/^\d{16}$/', $card_number)) {
            $errors[] = "Invalid card number. It should be 16 digits.";
        }

        if (!preg_match('/^\d{3,4}$/', $cvv)) {
            $errors[] = "Invalid CVV.";
        }

        if (empty($card_name)) {
            $errors[] = "Please enter the name on the card.";
        }

        if (empty($expiry)) {
            $errors[] = "Please enter the expiry date.";
        }

        // **IMPORTANT:** Do NOT store sensitive card information on your server.
        break;

    case 'Insurance':
        $policy_number = sanitize_input($_POST['policy_number']);
        $provider = sanitize_input($_POST['provider']);

        if (empty($policy_number) || empty($provider)) {
            $errors[] = "Please provide all insurance details.";
        }

        break;

    case 'Bank Transfer':
        $bank_account = sanitize_input($_POST['bank_account']);
        $bank_name = sanitize_input($_POST['bank_name']);

        if (empty($bank_account) || empty($bank_name)) {
            $errors[] = "Please provide all bank details.";
        }

        break;

    case 'PayPal':
        // No additional details required for PayPal in this form
        break;

    default:
        $errors[] = "Invalid payment method selected.";
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['payment_error'] = implode("<br>", $errors);
    header("Location: payment.php");
    exit();
}

// Insert payment record with status 'Pending'
$insert_query = "INSERT INTO payments (user_id, payment_method, amount, transaction_id, status) VALUES (?, ?, ?, ?, ?)";
$insert_params = [$user_id, $payment_method, $amount, $transaction_id, $status];
$insert_types = "isdss";

try {
    Database::iud($insert_query, $insert_params, $insert_types);
} catch (Exception $e) {
    $_SESSION['payment_error'] = "Error recording payment: " . $e->getMessage();
    header("Location: payment.php");
    exit();
}


if ($payment_method == 'Credit/Debit Card') {
   

    // Update payment status to 'Completed'
    $update_query = "UPDATE payments SET status = ? WHERE transaction_id = ?";
    $update_params = ['Completed', $transaction_id];
    $update_types = "ss";


    try {
        Database::iud($update_query, $update_params, $update_types);
    } catch (Exception $e) {
        $_SESSION['payment_error'] = "Error updating payment status: " . $e->getMessage();
        echo "<script>alert('Appointment Successfull');</script>";
        header("Location: payment.php");
        exit();
    }


    $_SESSION['payment_success'] = "Payment Successful! Transaction ID: $transaction_id";
    header("Location: appointmentRecieptShow.php");
    exit();


}
 elseif ($payment_method == 'PayPal') {
    // Redirect to PayPal for actual payment processing
    // **IMPORTANT:** Replace the URL with your actual PayPal integration endpoint.
    // For demonstration, we'll simulate redirection.

    $_SESSION['payment_success'] = "Redirecting to PayPal for payment...";
    header("Location: appointmentRecieptShow.php");
    exit();

} else {
    // For Insurance and Bank Transfer, mark as 'Pending'
    $_SESSION['payment_success'] = "Payment recorded! Your payment is being processed. Transaction ID: $transaction_id";


    header("Location: appointmentRecieptShow.php");
    exit();
}



?>