<?php

require "connection.php";

$resultset1 = Database::search("SELECT * FROM `specialization`");
$resultset2 = Database::search("SELECT * FROM `specialization`");

// Function to get dates for the next 3 days
function getNextThreeDays()
{
    $dates = [];
    for ($i = 0; $i < 4; $i++) {
        $dates[] = date('Y-m-d', strtotime("+$i day"));
    }
    return $dates;
}

// Get the dates and display them


$appointment_count = null;

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doctor']) && isset($_POST['date'])) {
    // Get doctor and date from the form
    $doctor = $_POST['doctor'];
    $aDate = $_POST['date'];



   // Query to count appointments for the selected doctor and date
   $query = "SELECT COUNT(*) as appointment_count FROM appointment WHERE doctor LIKE '" . $doctor . "' AND aDate = '" . $aDate . "'";
   $result = Database::search($query);

   // Fetch the result and get the count
   if ($row = $result->fetch_assoc()) {
       $appointment_count = $row['appointment_count'];
   } else {
       $appointment_count = 0; // Default to 0 if no results found
   }



 
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Search</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>
            <hr class="my-0">
            <div class=" col-12 ">

                <div class="row px-lg-5 px-0" style="background-image: linear-gradient(to right top, #020437, #082a62, #124f8e, #1877bc, #1aa2ea);">

                    <!-- Select Speciality Part -->


                    <form action="AppointmentSearch.php" method="POST" id="appointmentSearchForm">

                        <div class="row">

                            <div class=" col-6 col-lg-4 mt-0 mx-lg-4 mx-2 px-lg-5 my-0 p-0">

                                <select name="speciality" id="speciality" class="form-select">
                                    <option value="" disabled selected>Select a speciality</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($resultset1)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['specialization']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Select Doctor Part -->
                            <div class="col-5 col-lg-4 mt-5 px-lg-5 p-0">
                                <select name="doctor" id="doctor" class="form-select">
                                    <option value="" disabled selected>Select Doctor</option>
                                </select>
                            </div>

                            <div class=" col-6 col-lg-3 mt-lg-5 my-sm-2 p-0 mx-2 px-lg-5">

                                <select name="date" id="date" class=" form-select">
                                    <option value="" disabled selected>Select a date</option>

                                    <?php
                                    $dates = getNextThreeDays();
                                    foreach ($dates as $date) {

                                    ?>
                                        <option><?php echo " $date "; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>


                            <div class="d-flex col-5 col-lg-12  my-2 mt-0 justify-content-center">
                                <button class=" btn btn-light col-lg-4" name="search" type="submit" id="searchBtn"><i class="bi bi-search"></i>Search</button>
                            </div>


                        </div>


                </div>

            </div>


            </form>

            <!-- Display the appointment count if form has been submitted -->

            <div class="alert alert-info mt-3 my-0" id="resultDiv" style="display: none;">
                <strong>Appointment Count:</strong> <?php echo $appointment_count; ?>
            </div>




            <!-- Searching Item Display Part -->

            <div class="col-12 col-lg-12 mt-0 p-0">
                <!-- Warning message -->

                <div class=" alertmessagdiv1 alert alert-warning text-center text-dark p-3  " id="alertDiv" style="display: none;">
                    <strong>All Appointments are closed on this date.</strong>

                </div>
            </div>


            <!--Appointment making form -->

            <div class="col-12 d-flex justify-content-center">

                <div class=" col-10 col-lg-4 mt-3 p-3 my-3" style=" background-image: linear-gradient(to right top, #e7edf4, #d6e6f5, #c3e0f6, #aedaf7, #95d4f6); border-radius: 10px; box-shadow: 0 0 15px rgba(45, 0, 65, 0.2); display: none;" id="AppointmentForm">

<div class=" col-12  p-0 ">
    <div class="col-12 p-0  d-flex justify-content-center"><img src="https://www.primecareltd.com/uploads/company/logo.png" alt="Hospital Logo" class="col-lg-4 col-4"></div>
<div class="col-12 appointment_header d-flex justify-content-center fs-lg-2 fs-3">Prime Care Hospital</div>
<div class=" col-12 fs-6 d-flex justify-content-center text-white">Please Enter the Patient Details</div>
</div>
                        <div class=" col-12 p-0 mt-5 d-flex justify-content-center p-1"><input type="text" name="pName" id="pName" class=" form-control" placeholder="Patient Name With Initials" required></div>
                        <div class=" col-12 p-0  d-flex justify-content-center p-1"><input type="text" name="nic" id="nic" class=" form-control" placeholder="Patient NIC" required></div>
                        <div class=" col-12 p-0  d-flex justify-content-center p-1"><input type="email" name="email" id="email" class=" form-control" placeholder="Enter Your Email" required></div>
                        <div class=" col-12 p-0  d-flex justify-content-center p-1"><input type="text" name="phone" id="phone" class=" form-control" placeholder="Enter your Phone Number" required></div>

                        <div class=" col-12 col-lg-6 p-1">
                            <select name="gender" id="gender" class=" form-select" required>
                                <option disabled selected>Select Patient Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>


                        <div class=" col-12 p-1 mt-1">

                            <select name="speciality2" id="speciality2" class=" form-select" required>
                                <option disabled selected>Select the speciality</option>

                                <?php
                                while ($row = mysqli_fetch_assoc($resultset2)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['specialization']; ?></option>
                                <?php
                                }
                                ?>

                            </select>

                        </div>

                        <div class=" col-12 p-1 mt-1">

                            <select name="doctor2" id="doctor2" class="form-select" required>
                                <option value="" disabled selected>Select Doctor</option>
                            </select>

                        </div>

                        <div class=" col-12 p-1 mt-1 my-2">

                            <select name="date2" id="date2" class=" form-select" required>
                                <option value="" disabled selected>Select a date</option>

                                <?php
                                $dates = getNextThreeDays();
                                foreach ($dates as $date) {

                                ?>
                                    <option><?php echo " $date "; ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>

                        <div class=" col-12 d-flex justify-content-center mt-5 my-3">

                            <button class=" col-4 p-1 btn btn-outline-primary btn-sm " onclick="appointmentValidate();">Confirm Appointment</button>

                        </div>

            

                </div>

            </div>

            <div class=" col-12 p-0" style=" margin-top: 30vh;">
                <?php include "footer.php"; ?>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {
            // When the specialization dropdown value changes
            $('#speciality').change(function() {
                var special_id = $(this).val(); // Get the selected specialization ID

                // Send AJAX request to fetch doctors based on specialization
                $.ajax({
                    url: "doctorSearching.php", // PHP file to fetch doctors
                    method: "POST",
                    data: {
                        special_id: special_id
                    }, // Send selected specialization ID
                    success: function(data) {
                        $('#doctor').html(data); // Populate the doctor dropdown with the result
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // When the specialization dropdown value changes
            $('#speciality2').change(function() {
                var special_id = $(this).val(); // Get the selected specialization ID

                // Send AJAX request to fetch doctors based on specialization
                $.ajax({
                    url: "doctorSearching.php", // PHP file to fetch doctors
                    method: "POST",
                    data: {
                        special_id: special_id
                    }, // Send selected specialization ID
                    success: function(data) {
                        $('#doctor2').html(data); // Populate the doctor dropdown with the result
                    }
                });
            });
        });
    </script>


<!--
    <script>
        // jQuery AJAX function for form submission
        $(document).ready(function() {
            
            $('#appointmentSearchForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get the values from the form
                var doctor = $('#doctor').val();
                var date = $('#date').val();

                // Send AJAX request to AppointmentCount.php
           
               $.ajax({
                    url: 'AppointmentCount.php',
                    method: 'POST',
                    data: {
                        doctor: doctor,
                        date: date
                    },
                    success: function(response) {
                        // Parse the JSON response
                        var data = JSON.parse(response);
                        var appointmentCount = data.count;

                        // Show the result in the resultDiv
                        $('#resultDiv').html('There are ' + appointmentCount + ' appointment(s) for the selected doctor and date.');
                        $('#resultDiv').show();

                        // Check if the appointment count is greater than 3, then show the alert div
                        if (appointmentCount > 2) {
                            $('#alertDiv').show(); // Show the alert div
                            $('#AppointmentForm').hide();
                        } else {
                            $('#alertDiv').hide(); // Hide the alert div if the count is 3 or less
                            $('#AppointmentForm').show();
                        }
                    },
                    error: function() {
                        alert('Error fetching appointment data.');
                    }
                });


            });
        });
    </script>
    -->

    <script>

$(document).ready(function() {

$('#appointmentSearchForm').on('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the values from the form
    var doctor = $('#doctor').val();
    var date = $('#date').val();

    // Check if doctor or date is null or empty
    if (!doctor || !date) {
        // Hide the AppointmentForm and show an alertDiv
        $('#AppointmentForm').hide();
        $('#alertDiv').html('Please select both doctor and date to proceed.').show();
        return; // Stop further execution
    }

    // Send AJAX request to AppointmentCount.php
    $.ajax({
        url: 'AppointmentCount.php',
        method: 'POST',
        data: {
            doctor: doctor,
            date: date
        },
        success: function(response) {
            // Parse the JSON response
            var data = JSON.parse(response);
            var appointmentCount = data.count;

            // Show the result in the resultDiv
            $('#resultDiv').html('There are ' + appointmentCount + ' appointment(s) for the selected doctor and date.');
            $('#resultDiv').show();

            // Check if the appointment count is greater than 2, then show the alert div
            if (appointmentCount > 2) {
                $('#alertDiv').show(); // Show the alert div
                $('#AppointmentForm').hide();
            } else {
                $('#alertDiv').hide(); // Hide the alert div if the count is 2 or less
                $('#AppointmentForm').show();
            }
        },
        error: function() {
            alert('Error fetching appointment data.');
        }
    });
});
});

    </script>

<script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>