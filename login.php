<?php
// login.php
session_start();
require_once 'connection.php';

// Function to sanitize input data
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$email = $password = "";
$email_err = $password_err = $general_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email)) {
        $email_err = "Please enter your email.";
    }

    if (empty($password)) {
        $password_err = "Please enter your password.";
    }

    // If no errors, proceed to authenticate
    if (empty($email_err) && empty($password_err)) {
        // Retrieve user data
        $result = Database::search("SELECT id, password FROM users WHERE email = '$email'");
        if ($result->num_rows == 0) {
            $email_err = "No user found with this email. <a href='register.php'>Register here</a>.";
        } else {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Successful login
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                header("Location: payment.php");
                exit();
            } else {
                $password_err = "Incorrect password.";
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
    <title>Login - Hospital Payment</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body>



    <div class=" container-fluid">
        <div class="row">

            <?php include "header.php"; ?>
            <hr class=" mt-0 my-4">


            <div class="col-12 d-flex justify-content-center">

                <div class="col-lg-4 col-8 border-3 p-4 my-4" style="background-image: linear-gradient(to right top, #e7edf4, #d6e6f5, #c3e0f6, #aedaf7, #95d4f6); border-radius: 10px;">

                    <div class="col-12 d-flex justify-content-center uText my-2">User Login</div>

                    <?php
                    if (!empty($general_err)) {
                        echo "<p class='error'>$general_err</p>";
                    }
                    ?>

<form action="login.php" method="POST">


<div class="col-12 d-flex justify-content-center my-1"><input type="email" name="email" id="email" class=" form-control" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your Email" required></div>
<div class=" col-12 d-flex justify-content-center my-2"> <span class="error"><?php echo $email_err; ?></span></div>

<div class=" col-12 d-flex justify-content-center my-1"><input type="password" name="password" id="password" class=" form-control" placeholder="Enter Your Password" required></div>
<div class=" col-12 d-flex justify-content-center my-2"><span class="error"><?php echo $password_err; ?></span></div>

<div class=" col-12 d-flex justify-content-center my-2"><button type="submit" class=" btn btn-outline-primary">Login</button></div>

<div class=" col-12 d-flex justify-content-center my-2"><p>Don't have an account? <a href="register.php" class=" link-primary">Register here</a>.</p></div>
</form>

                </div>

            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>


</body>

</html>