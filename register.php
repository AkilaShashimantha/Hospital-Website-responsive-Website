<?php
// register.php
session_start();
require_once 'connection.php';

// Function to sanitize input data
function sanitize_input($data)
{
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
        $name_err = "Please enter your full Name.";
    }

    if (empty($email)) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid Email format.";
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
    <link rel="icon" href="images/hospital logo.png" type="image/png">
  
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>
            <hr class=" mt-0 my-2">

            <div class="col-12 d-flex justify-content-center">
                <div class="col-8 col-lg-4 border-3 my-5" style="background-image: linear-gradient(to right top, #e7edf4, #d6e6f5, #c3e0f6, #aedaf7, #95d4f6); border-radius: 10px;">

                    <div class="col-12 d-flex justify-content-center">
                        <p class="uText">User Register Form</p>
                    </div>

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

                        <div class=" col-12 d-flex justify-content-center p-3"><input type="text" name="name" id="name" class=" form-control" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter Your Name" required></div>
                        <div class=" col-12 d-flex justify-content-center"><span class="error"><?php echo $name_err; ?></span></div>


                        <div class=" col-12 d-flex justify-content-center p-3"><input type="email" name="email" id="email" class=" form-control" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your Email" required></div>
                        <div class=" col-12 d-flex justify-content-center"><span class="error"><?php echo $email_err; ?></span></div>


                        <div class=" col-12 d-flex justify-content-center p-3"><input type="password" name="password" id="password" class=" form-control" placeholder="Enter New Password" required></div>
                        <div class=" col-12 d-flex justify-content-center"><span class="error"><?php echo $password_err; ?></span></div>


                        <div class=" col-12 d-flex justify-content-center my-2"><button type="submit" class=" btn btn-outline-primary">Register</button></div>

                    </form>

                    <div class=" col-12 d-flex justify-content-center">
                        <p>Already have an account? <a href="login.php" class=" link-primary">Login here</a>.</p>
                    </div>

                </div>
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>



</body>

</html>