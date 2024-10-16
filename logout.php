<?php
// logout.php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out - Hospital Payment</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    <style>
        /* Inline CSS for simplicity */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding-top: 100px;
        }

        .message {
            background-color: #fff;
            display: inline-block;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .message a {
            color: #007BFF;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="message">
        <h2>You have been logged out.</h2>
        <p><a href="login.php">Login again</a></p>
    </div>
</body>
</html>
