<?php
// register.php
session_start();
require_once 'connection.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$name = $email = $password = "";
$name_err = $email_err = $password_err = $general_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($name)) {
        $name_err = "Please enter your full name.";
    }

    if (empty($email)) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    }

    if (empty($password)) {
        $password_err = "Please enter a password.";
    } elseif (strlen($password) < 6) {
        $password_err = "Password must be at least 6 characters.";
    }

    // If no errors, proceed to register
    if (empty($name_err) && empty($email_err) && empty($password_err)) {
        // Check if email already exists
        $existing_user = Database::search("SELECT id FROM users WHERE email = '$email'");
        if ($existing_user->num_rows > 0) {
            $email_err = "Email already registered. <a href='login.php'>Login here</a>.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user
            $insert_query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $insert_params = [$name, $email, $hashed_password];
            $insert_types = "sss";

            try {
                Database::iud($insert_query, $insert_params, $insert_types);
                $_SESSION['success_message'] = "Registration successful. Please <a href='login.php'>login</a>.";
                header("Location: register.php");
                exit();
            } catch (Exception $e) {
                $general_err = "Error registering user: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hospital Payment</title>
    <style>
        /* Inline CSS for simplicity */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container label {
            display: block;
            margin-top: 10px;
        }

        .container input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .success {
            color: green;
            font-size: 0.9em;
            text-align: center;
        }

        .container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .container button:hover {
            background-color: #218838;
        }

        .container p {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <h2>Register</h2>
        <?php
            if (isset($_SESSION['success_message'])) {
                echo "<p class='success'>" . $_SESSION['success_message'] . "</p>";
                unset($_SESSION['success_message']);
            }

            if (!empty($general_err)) {
                echo "<p class='error'>$general_err</p>";
            }
        ?>
        <form action="register.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <span class="error"><?php echo $name_err; ?></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <span class="error"><?php echo $email_err; ?></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span class="error"><?php echo $password_err; ?></span>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
    
</body>
</html>
