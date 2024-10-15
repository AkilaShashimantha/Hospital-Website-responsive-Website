<?php
// File: addLabReport.php

// Include the database connection
require_once 'connection.php';

// Initialize variables
$nic = "";
$errors = [];
$success = "";

// NIC validation function
function validateNic($nic) {
    $old_nic_pattern = '/^[0-9]{9}[vVxX]$/';   // Old NIC format
    $new_nic_pattern = '/^[0-9]{12}$/';        // New NIC format
    return preg_match($old_nic_pattern, $nic) || preg_match($new_nic_pattern, $nic);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $nic = trim($_POST['nic']);

    // Validate NIC
    if (empty($nic)) {
        $errors[] = "NIC is required.";
    } elseif (!validateNic($nic)) {
        $errors[] = "Invalid NIC format. Please enter a valid NIC.";
    }

    // Handle Upload
    if ($action === 'upload') {
        if (!isset($_FILES['report_file']) || $_FILES['report_file']['error'] == UPLOAD_ERR_NO_FILE) {
            $errors[] = "No file uploaded.";
        } else {
            $file = $_FILES['report_file'];
            $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if ($file['size'] > $max_size) {
                $errors[] = "File size exceeds 5MB.";
            }

            if (!in_array($file['type'], $allowed_types)) {
                $errors[] = "Invalid file type. Only PDF and Word documents are allowed.";
            }
        }

        if (empty($errors)) {
            $report_id = 'lbN_' . substr(md5(uniqid()), 0, 13);
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $unique_file_name = $report_id . '.' . $file_extension;
            $file_path = $upload_dir . $unique_file_name;

            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $query = "INSERT INTO lab_reports (report_id, nic, file_path) VALUES (?, ?, ?)";
                Database::iud($query, [$report_id, $nic, $file_path], 'sss');
                $success = "Lab report uploaded successfully. Report ID: " . $report_id;
            } else {
                $errors[] = "Failed to upload the file.";
            }
        }
    }

    // Handle Update
    if ($action === 'update') {
        if (!isset($_FILES['update_file']) || $_FILES['update_file']['error'] == UPLOAD_ERR_NO_FILE) {
            $errors[] = "No file uploaded.";
        } else {
            $file = $_FILES['update_file'];
            $upload_dir = 'uploads/';
            $file_path = $upload_dir . basename($file['name']);

            $query = "SELECT file_path FROM lab_reports WHERE nic = ?";
            $result = Database::select($query, [$nic], 's');

            if (count($result) > 0) {
                $old_file_path = $result[0]['file_path'];
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            } else {
                $errors[] = "NIC not found in the database.";
            }

            if (empty($errors) && move_uploaded_file($file['tmp_name'], $file_path)) {
                $query = "UPDATE lab_reports SET file_path = ? WHERE nic = ?";
                Database::iud($query, [$file_path, $nic], 'ss');
                $success = "Lab report updated successfully.";
            } else {
                $errors[] = "Failed to upload the file.";
            }
        }
    }

    // Handle Delete
    if ($action === 'delete') {
        $query = "SELECT file_path FROM lab_reports WHERE nic = ?";
        $result = Database::select($query, [$nic], 's');

        if (count($result) > 0) {
            $file_path = $result[0]['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $query = "DELETE FROM lab_reports WHERE nic = ?";
            Database::iud($query, [$nic], 's');
            $success = "Lab report deleted successfully.";
        } else {
            $errors[] = "No report found for the given NIC.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <title>Lab Report Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1{
            margin-top: 20px;
            margin-bottom: 30px;
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
        form input[type="text"], form input[type="file"] {
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
        form .delete {
            background-color: #d9534f;
        }
        form .delete:hover {
            background-color: #c9302c;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            background-color: #5cb85c;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
        }
        .buttons button.delete {
            background-color: #d9534f;
        }
        .buttons button:hover {
            opacity: 0.9;
        }
        .form-section {
            display: none;
            margin-top: 20px;
        }
    </style>
    <script>
        function showForm(action) {
            document.getElementById('upload-form').style.display = 'none';
            document.getElementById('update-form').style.display = 'none';
            document.getElementById('delete-form').style.display = 'none';
            
            if (action === 'upload') {
                document.getElementById('upload-form').style.display = 'block';
            } else if (action === 'update') {
                document.getElementById('update-form').style.display = 'block';
            } else if (action === 'delete') {
                document.getElementById('delete-form').style.display = 'block';
            }
        }
    </script>
</head>
<body>



<div class="container">
<div class="col-12 d-flex justify-content-center">
  <img src="https://www.primecareltd.com/uploads/company/logo.png" alt="Hospital Logo" class="col-lg-2 col-4">
</div>
    
<div class="col-12 d-flex justify-content-center">
    <h1 style="font-family: 'Roboto', sans-serif; font-weight: 700;">Lab Report Manager</h1>
</div>



    <?php
    if (!empty($errors)) {
        echo '<div class="error"><ul>';
        foreach ($errors as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul></div>';
    }

    if (!empty($success)) {
        echo '<div class="success">' . htmlspecialchars($success) . '</div>';
    }
    ?>

    <div class="buttons">
        <button onclick="showForm('upload')">Upload Report</button>
        <button onclick="showForm('update')">Update Report</button>
        <button class="delete" onclick="showForm('delete')">Delete Report</button>
    </div>

    <div id="upload-form" class="form-section">
        <form action="addLabReport.php" method="POST" enctype="multipart/form-data">
            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" required>

            <label for="report_file">Upload Report File:</label>
            <input type="file" name="report_file" id="report_file" accept=".pdf, .doc, .docx" required>

            <input type="hidden" name="action" value="upload">
            <input type="submit" value="Upload Report">
        </form>
    </div>

    <div id="update-form" class="form-section">
        <form action="addLabReport.php" method="POST" enctype="multipart/form-data">
            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" required>

            <label for="update_file">Update Report File:</label>
            <input type="file" name="update_file" id="update_file" accept=".pdf, .doc, .docx" required>

            <input type="hidden" name="action" value="update">
            <input type="submit" value="Update Report">
        </form>
    </div>

    <div id="delete-form" class="form-section">
        <form action="addLabReport.php" method="POST">
            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" required>

            <input type="hidden" name="action" value="delete">
            <input type="submit" value="Delete Report" class="delete">
        </form>
    </div>
</div>

</body>
</html>
