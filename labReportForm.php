<?php
// File: lab_report.php

// Include the database connection
require_once 'connection.php';

// Initialize variables
$nic = "";
$errors = [];
$success = "";

// NIC validation function
function validateNic($nic) {
    // Sri Lankan NIC validation (both old and new formats)
    // Old NIC format: 9 digits + 'V' or 'X' (e.g., 123456789V)
    // New NIC format: 12 digits (e.g., 199012345678)
    
    $old_nic_pattern = '/^[0-9]{9}[vVxX]$/';   // Pattern for old format
    $new_nic_pattern = '/^[0-9]{12}$/';        // Pattern for new format

    if (preg_match($old_nic_pattern, $nic) || preg_match($new_nic_pattern, $nic)) {
        return true;  // Valid NIC
    } else {
        return false; // Invalid NIC
    }
}

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

    // Validate file upload
    if (!isset($_FILES['report_file']) || $_FILES['report_file']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors[] = "No file uploaded.";
    } else {
        $file = $_FILES['report_file'];
        $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $max_size = 5 * 1024 * 1024; // 5MB

        // Check file size
        if ($file['size'] > $max_size) {
            $errors[] = "File size exceeds 5MB.";
        }

        // Check file type
        if (!in_array($file['type'], $allowed_types)) {
            $errors[] = "Invalid file type. Only PDF and Word documents are allowed.";
        }
    }

    // If no errors, proceed to upload and save data
    if (empty($errors)) {
        // Generate a unique report ID similar to txn_670cd47ab2b97
        $report_id = 'lbN_' . substr(md5(uniqid()), 0, 13);

        // Define the upload directory
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate a unique file name to prevent overwriting
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $unique_file_name = $report_id . '.' . $file_extension;
        $file_path = $upload_dir . $unique_file_name;

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            // Prepare SQL query to insert data
            $query = "INSERT INTO lab_reports (report_id, nic, file_path) VALUES (?, ?, ?)";
            $params = [$report_id, $nic, $file_path];
            $types = "sss"; // s = string

            // Execute the query
            Database::iud($query, $params, $types);

            $success = "Lab report uploaded successfully. Report ID: " . $report_id;
            // Clear the form fields
            $nic = "";
        } else {
            $errors[] = "Failed to upload the file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab Report Upload</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px #ccc;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        .error {
            background-color: #f8d7da;
            color: #a94442;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            margin-top: 15px;
        }
        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        form input[type="submit"] {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #5cb85c;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
        }
        form input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload Lab Report</h2>

    <?php
    // Display errors
    if (!empty($errors)) {
        echo '<div class="error"><ul>';
        foreach ($errors as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul></div>';
    }

    // Display success message
    if (!empty($success)) {
        echo '<div class="success">' . htmlspecialchars($success) . '</div>';
    }
    ?>

    <form action="labReportForm.php" method="POST" enctype="multipart/form-data">
        <label for="nic">NIC:</label>
        <input type="text" name="nic" id="nic" value="<?php echo htmlspecialchars($nic); ?>" required>

        <label for="report_file">Upload Report File:</label>
        <input type="file" name="report_file" id="report_file" accept=".pdf, .doc, .docx" required>

        <input type="submit" value="Upload Report">
    </form>
</div>

</body>
</html>
