<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif; 
        }

        #patientForm {
            background-color: #e6f7ff; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px; 
            margin: auto; 
        }

       
        .form-image {
            width: 100%; 
            height: auto; 
            max-height: 200px; 
            object-fit: cover; 
            margin-bottom: 15px; 
            border-radius: 10px; 
        }

       
        .required {
            color: red; 
        }

        
        .form-group {
            margin-bottom: 15px; 
        }

        
        label {
            font-weight: bold; 
            display: block; 
            margin-bottom: 5px; 
        }

       
        .form-buttons {
            text-align: center; 
        }

        .form-buttons button {
            min-width: 120px; 
            padding: 10px 15px; 
            margin: 5px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s ease; 
        }

        .form-buttons button:hover {
            background-color: #0056b3;
        }

        
        .radio-group {
            margin-bottom: 15px; 
        }

        
        h3 {
            text-align: center; 
            color: #333; 
        }
    </style>
</head>

<body>

<?php include "header.php"; ?>
    <hr class="my-0">

    <div class="col-12 p-0 mx-2 mt-2">
                <div class="col-2">
                    <button class="btn btn-dark p-2" onclick="window.location.href='adminHome.php';">
                        <i class="bi bi-arrow-left-square-fill col-1 mx-1"></i>Back
                    </button>
                </div>
            </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

               
                <form id="patientForm" class="p-4 border rounded" action="addPatientProcess.php" method="POST">
                
                    <div class="text-center mb-3">
                        <img src="images/regsiter.jpg" alt="Doctor with patient" class="form-image">
                    </div>

                    <h3 class="mb-3">Patient Registration Form</h3>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name">Patient Name:<span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="nic">NIC:<span class="required">*</span></label>
                            <input type="text" id="nic" name="nic" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">Patient Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="phone">Patient Phone Number:<span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 radio-group">
                            <label>Gender:<span class="required">*</span></label>
                            <div>
                                <label><input type="radio" name="gender" value="male" required> Male</label>
                                <label><input type="radio" name="gender" value="female"> Female</label>
                                <label><input type="radio" name="gender" value="other"> Other</label>
                            </div>
                        </div>

                        <div class="col-md-6 radio-group">
                            <label>Marital Status:<span class="required">*</span></label>
                            <div>
                                <label><input type="radio" name="marital_status" value="single" required> Single</label>
                                <label><input type="radio" name="marital_status" value="married"> Married</label>
                                <label><input type="radio" name="marital_status" value="divorced"> Divorced</label>
                                <label><input type="radio" name="marital_status" value="widowed"> Widowed</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:<span class="required">*</span></label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-buttons mt-3">
                        <button type="submit" class="btn" onclick="insertPatient()">Add</button>
                        <button type="button" class="btn" onclick="updatePatient()">Update</button>
                        <button type="button" class="btn" onclick="deletePatient()">Delete</button>
                        <button type="button" class="btn" onclick="clearForm()">Clear</button>
                    </div>
                </form>

                
                <div id="responseMessage" class="text-center mt-4"></div>

            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script src="script.js"></script>
</body>

</html>
