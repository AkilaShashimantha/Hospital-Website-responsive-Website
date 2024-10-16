<?php
require 'connection.php';

$resultset = Database::search("SELECT * FROM `specialization`");

$docnic = "";
$dName = "";
$dEmail = "";
$special_id = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dnic = $_POST["dnic"];


$rs = Database::search("SELECT d.dName, d.dEmail, s.specialization ,d.special_id
        FROM doctor d
        JOIN specialization s ON d.special_id = s.id
        WHERE d.nic = '".$dnic."'");

while ($row = mysqli_fetch_assoc($rs)){

    $dName = $row['dName'];
  
    $dEmail = $row['dEmail'];
  
    $specialization = $row['specialization'];

    $special_id = $row['special_id'];

}

$n = $rs->num_rows;
if($n > 0){

$docnic = $dnic;
 

}
else{
    echo "<script>alert('Invalid NIC Number');</script>";
}


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>
            <hr class="my-0">

            <div class="col-12 p-0 mx-2 mt-2">
                <div class="col-2">
                    <button class="btn btn-dark p-2" onclick="window.location.href='adminHome.php';">
                        <i class="bi bi-arrow-left-square-fill col-1 mx-1"></i>Back
                    </button>
                </div>
            </div>
            <hr class="my-2">


            <div class=" col-12 d-flex justify-content-center">

                <div class="col-10 col-lg-4 my-4 mt-2 p-0" style="background-image: linear-gradient(to right top, #f3f3f3, #ebedf6, #dee8f8, #cde4fa, #b7e1fa); border-radius: 30px;">

                    <div class="col-12 d-flex justify-content-center">
                        <p class=" headDoctor">Doctor Registration Form</p>
                    </div>
                    <div class=" col-12 d-flex justify-content-center ">
                      
<form action="" method="post">

<div class=" col-lg-9 d-flex justify-content-center"><input type="text" name="dnic" id="dnic" class=" form-control" placeholder="Enter Doctor's NIC to Search" value="<?php echo htmlspecialchars($docnic);  ?>"></div>
                            <div class=" col-lg-8 mx-2 d-flex justify-content-center"><button class=" btn btn-outline-primary col-12" name="search" type="submit" id="searchBtn"><i class="bi bi-search"></i></button></div>
                       
</form>
                    </div>
                    <form action="addDoctorProcess.php" method="post" class="form-container mx-5" onsubmit="return doctorvalidate();">
                        <!-- Doctor Name -->
                        <div class="col-12">
                            <label for="dname" class="form-label">Doctor Name</label>
                            <input type="text" class="form-control" name="dname" id="dname" placeholder="Please Enter the Doctor Name" value="<?php echo htmlspecialchars($dName); ?>" required>
                        </div>
                        <!-- Doctor NIC -->
                        <div class="col-12">
                            <label for="nic" class="form-label">NIC</label>
                            <input type="text" class="form-control" placeholder="Enter NIC" name="nic" id="nic" value="<?php echo htmlspecialchars($docnic); ?>" required>
                        </div>
                        <!-- Doctor Email -->
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Please Enter the Email" class="form-control" value="<?php echo htmlspecialchars($dEmail); ?>" required>
                        </div>
                        <!-- Doctor Speciality -->
                        <div class="col-12">
                            <label for="speciality" class="form-label my-0">Select Speciality</label>
                            <select name="speciality" id="speciality" class="form-select mt-0 my-2" required>
                                <option value="" disabled selected>Select Speciality</option>

                                <?php while ($row = mysqli_fetch_assoc($resultset)) { ?>

                                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $special_id) ? 'selected' : ''; ?> ><?php echo $row['specialization']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <button class="btn btn-outline-primary  col-3 mx-3" name="add" type="submit">Add Doctor</button>
                        <button class=" btn btn-outline-primary  col-3 mx-2 " name="update" type="button" onclick="doctorUpdate();">Update Doctor</button>
                        <button class=" btn btn-outline-primary  col-3 mx-3" name="delete" type="button" onclick="deleteDoctor();">Delete Doctor</button>
                    </form>
                   
                </div>

            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>