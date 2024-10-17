
<?php
// payment.php
session_start();
require_once 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$payment_method = "Credit/Debit Card";
$amount = "";
$errors = [];

if (isset($_SESSION['payment_success'])) {
    $success_message = $_SESSION['payment_success'];
    unset($_SESSION['payment_success']);
}

if (isset($_SESSION['payment_error'])) {
    $error_message = $_SESSION['payment_error'];
    unset($_SESSION['payment_error']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Make a Payment - Hospital Payment</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    <style>
        /* Inline CSS for simplicity */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 500px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .payment-methods label {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .payment-methods input[type="radio"] {
            margin-right: 10px;
        }

        .payment-details {
            display: none;
            margin-top: 20px;
        }

        .payment-details label {
            display: block;
            margin-top: 10px;
        }

        .payment-details input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .payment-details p {
            margin-top: 10px;
            color: #555;
        }

        .container label[for="amount"] {
            display: block;
            margin-top: 20px;
        }

        .container input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .container button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: #fff;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .container button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        .logout-link {
            text-align: center;
            margin-top: 15px;
        }

        .logout-link a {
            color: #dc3545;
            text-decoration: none;
        }

        .logout-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Make a Payment</h2>

        <?php
            if (isset($success_message)) {
                echo "<p class='message success'>$success_message</p>";
            }

            if (isset($error_message)) {
                echo "<p class='message error'>$error_message</p>";
            }
        ?>

        <form id="paymentForm" action="process_payment.php" method="POST">
            <div class="payment-methods">
                <label>
                    <input type="radio" name="payment_method" value="Credit/Debit Card" checked>
                    Credit/Debit Card
                </label>
            
                <label>
                    <input type="radio" name="payment_method" value="Bank Transfer">
                    Bank Transfer
                </label>
                <label>
                    <input type="radio" name="payment_method" value="PayPal">
                    PayPal
                </label>
            </div>

            <div id="cardDetails" class="payment-details">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" pattern="\d{16}" maxlength="16" placeholder="1234123412341234">

                <label for="card_name">Name on Card</label>
                <input type="text" id="card_name" name="card_name" placeholder="John Doe">

                <label for="expiry">Expiry Date</label>
                <input type="month" id="expiry" name="expiry">

                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" pattern="\d{3,4}" maxlength="4" placeholder="123">
            </div>

            <div id="insuranceDetails" class="payment-details">
                <label for="policy_number">Policy Number</label>
                <input type="text" id="policy_number" name="policy_number" placeholder="Policy Number">

                <label for="provider">Provider</label>
                <input type="text" id="provider" name="provider" placeholder="Insurance Provider">
            </div>

            <div id="bankDetails" class="payment-details">
                <label for="bank_account">Bank Account Number</label>
                <input type="text" id="bank_account" name="bank_account" placeholder="Bank Account Number">

                <label for="bank_name">Bank Name</label>
                <input type="text" id="bank_name" name="bank_name" placeholder="Bank Name">
            </div>

            <div id="paypalDetails" class="payment-details">
                <p>You will be redirected to PayPal to complete your payment.</p>
            </div>

            <label for="amount">Amount LKR</label>
            <input type="number" id="amount" name="amount" step="0.01" min="0.01" required>

            <button type="submit">Confirm Payment</button>
        </form>

        <div class="logout-link">
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>

    <script>
        // JavaScript to handle dynamic display of payment details
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethods = document.getElementsByName('payment_method');
            const cardDetails = document.getElementById('cardDetails');
            const insuranceDetails = document.getElementById('insuranceDetails');
            const bankDetails = document.getElementById('bankDetails');
            const paypalDetails = document.getElementById('paypalDetails');

            function hideAllDetails() {
                cardDetails.style.display = 'none';
                insuranceDetails.style.display = 'none';
                bankDetails.style.display = 'none';
                paypalDetails.style.display = 'none';
            }

            function showDetails(method) {
                hideAllDetails();
                switch(method) {
                    case 'Credit/Debit Card':
                        cardDetails.style.display = 'block';
                        break;
                    case 'Insurance':
                        insuranceDetails.style.display = 'block';
                        break;
                    case 'Bank Transfer':
                        bankDetails.style.display = 'block';
                        break;
                    case 'PayPal':
                        paypalDetails.style.display = 'block';
                        break;
                }
            }

            // Initialize with the default selected method
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
            showDetails(selectedMethod);

            // Add event listeners to radio buttons
            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    showDetails(this.value);
                });
            });
        });
    </script>
</body>
</html>
    <title>Document</title>
</head>
<body>
    
</body>
</html>

