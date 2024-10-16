<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">

            <?php include "header.php"; ?>
            <hr class=" my-0">

            <div class="col-12 col-lg-12 pt-1  text-light mx-0 p-1 d-flex justify-content-center" style="background-image: linear-gradient(to right top, #002652, #033768, #054a7f, #055d96, #0071ad);">

                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background-image: radial-gradient(circle, #001436, #00375f, #005e87, #0088aa, #01b4c8);" onclick="changeView1();">Appointment Details</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background-image: radial-gradient(circle, #001436, #00375f, #005e87, #0088aa, #01b4c8);" onclick="changeView2();">Latest News Update</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background-image: radial-gradient(circle, #001436, #00375f, #005e87, #0088aa, #01b4c8);" onclick="window.location.href='addDoctor.php';">Add Doctor</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background-image: radial-gradient(circle, #001436, #00375f, #005e87, #0088aa, #01b4c8);" onclick="window.location.href='addLabReport.php';">Add Lab Report</button>
                <button class=" col-2 btn btn-light text-light btn-btn-outline-light my-2" style="background-image: radial-gradient(circle, #001436, #00375f, #005e87, #0088aa, #01b4c8);" onclick="window.location.href='PatientRegistration.php';">Add Patient Button</button>
            </div>

            <!-- Appointment Details page import to admin home page-->

            <div class="col-12 col-lg-12" id="appointmentBox">
                <?php include "appointmentDetails.php"; ?>

               
            </div>

            <!--Latest News update form -->

            <div class="col-12 col-lg-12 d-none " style="background-color: #eee;" id="newsBox">

         

                <?php include "updateForm.php" ?>

            </div>





            <?php include "footer.php"; ?>
       

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>