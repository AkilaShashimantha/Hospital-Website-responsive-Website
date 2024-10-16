<?php
// File: labreport.php

// Include the database connection
require_once 'connection.php'; // This includes the connection.php file

// NIC validation function
function validateNic($nic) {
    // Sri Lankan NIC validation (both old and new formats)
    $old_nic_pattern = '/^[0-9]{9}[vVxX]$/';   // Pattern for old format
    $new_nic_pattern = '/^[0-9]{12}$/';        // Pattern for new format

    return preg_match($old_nic_pattern, $nic) || preg_match($new_nic_pattern, $nic);
}

// Initialize variables
$nic = "";
$errors = [];
$report_found = false;
$report_file_path = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate NIC
    if (empty($_POST['nic'])) {
        $errors[] = "NIC is required.";
    } else {
        $nic = trim($_POST['nic']);
        if (!validateNic($nic)) {
            $errors[] = "Invalid NIC format. Please enter a valid NIC.";
        }
    }

    // If no errors, search for the report
    if (empty($errors)) {
        // Prepare query to search for the lab report by NIC
        $query = "SELECT * FROM lab_reports WHERE nic = ?";

        // Ensure the connection is set up
        Database::setUpConnection();

        $stmt = Database::$connection->prepare($query);
        if ($stmt) {
            $stmt->bind_param("s", $nic);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a report was found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $report_file_path = $row['file_path'];
                $report_found = true;
            } else {
                $errors[] = "No report found for the given NIC.";
            }

            $stmt->close();
        } else {
            $errors[] = "Failed to prepare the SQL statement: " . Database::$connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Report</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <?php include "header.php"; ?>
    <hr class="my-0">
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="col-lg-6 col-10 border-2 my-3 mt-3" style="background-color: #f0f2f5; border-radius: 20px; box-shadow: 0 0 15px rgba(45, 0, 65, 0.2);">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <img src="https://www.primecareltd.com/uploads/company/logo.png" alt="Hospital Logo" class="col-lg-2 col-4">
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <h1>Prime Care Hospital</h1>
                            </div>
                            <div class="col-12 d-flex justify-content-center fs-6">
                                <p style="font-size: 10px;">Maradana, Colombo 10, Sri Lanka</p>
                            </div>
                            <div class="col-12 d-flex justify-content-center fs-6">
                                <p style="font-size: 10px;">Hotline: +94112 4445558 | Laboratory: +94112 4445558</p>
                            </div>
                            <div class="col-12 d-flex justify-content-center fs-6">
                                <p style="font-size: 10px;">Email: info@primecarehospital.com | Web: www.primecarehospital.com</p>
                            </div>

                            <div class="row d-flex justify-content-center px-2">
                                <div class="col-12 col-lg-10 d-flex justify-content-center py-0 px-5">
                                    <!-- Form to submit NIC -->
                                    <form action="labreport.php" method="POST" class="w-100">
                                        <input type="text" name="nic" id="nic" class="form-control" placeholder="Enter Your NIC" required>
                                        <div class="col-12 d-flex justify-content-center my-5">
                                            <button type="submit" class="col-6 btn btn-outline-primary">Find Your Lab Report</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-12">
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?php echo htmlspecialchars($error); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if ($report_found): ?>
    <div class="alert alert-success text-center"> <!-- Add text-center for centering text -->
        <p>Lab report found! Click below to download:</p>
        <div class="d-flex justify-content-center"> <!-- Use flex to center the button -->
            <a href="<?php echo htmlspecialchars($report_file_path); ?>" class="btn btn-success">
                <i class="bi bi-download"></i> Download Lab Report
            </a>
        </div>
    </div>
<?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="script.js"></script>
</body>
</html>
