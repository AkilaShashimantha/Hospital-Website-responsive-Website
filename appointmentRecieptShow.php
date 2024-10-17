<?php 

session_start();

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION['pName'])) {
    $pName = $_SESSION['pName'];
    $nic = $_SESSION['nic'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $gender = $_SESSION['gender'];
    $doctor = $_SESSION['doctor'];
    $date = $_SESSION['date'];
    $appNum = $_SESSION['appNum'];
    $transaction_id = $_SESSION['transaction_id']  ;

    if($gender === "Male"){
$gd = "Mr.";

    }

    if($gender === "Female"){
        $gd = "Mrs.";
        
            }

         
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'primecarehospitalcontacts@gmail.com';
            $mail->Password = 'izzmhxahquulazyc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('primecarehospitalcontacts@gmail.com', 'Appointment Reciept');
           // $mail->addReplyTo('akilashashimantha84@gmail.com', 'Appointment Reciept');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'PRIME CARE Hospital Appointment Reciept';
            $bodyContent = '<h2 style="color: green;">Appointment Reciept</h2><br><br>

            <p>Patient Name : '.$gd.''.$pName.'</P>
            <p>Patient NIC : '.$nic.'</P>
            <p>Patient Email : '.$email.'</P>
            <p>Patient Phone Number : '.$phone.'</P>
            <p>Patient consulting Doctor:  Dr.'.$doctor.'</P>
            <h4> Your Appointment is booked for : '.$date.'</h4>
            <h4>Your Payment Transaction ID is : </h4> <h4 style="color:blue;">'.$transaction_id.'</h4>
            <h3>Your Appointment Number is  </h3> <h1> <center>'.$appNum.'<center></h1>

            ';
            // $bodyContent .= '******************';
            $mail->Body    = $bodyContent;
            
            $mail->send();

            if(!$mail->send()){
                echo "<script>alert('Failed to send the email');</script>";
            
            
            }else{
                echo "<script>alert('Successfully Appointment Details sent the email to $email');</script>";
            }
       

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Reciept</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    
<div class=" container-fluid">
<div class=" row">

<?php include "header.php"; ?>
<hr class=" mt-0 my-3">

<div class="col-12 d-flex justify-content-center">

<div class=" col-lg-4 col-10 border border-2 my-3 p-2">

<div class="col-12 d-flex justify-content-center"><h2 class=" form-label">Appointment Reciept</h2></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0">Patient Name</label></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control border-0 text-center my-0" value="<?php echo $gd.$pName ?>"></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0 mt-0">Patient NIC</label></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control border-0 text-center my-0" value="<?php echo $nic ?>"></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0 mt-0">Patient Email Address</label></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control border-0 text-center my-0" value="<?php echo $email ?>"></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0 mt-0">Patient Phone Number</label></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control border-0 text-center my-0" value="<?php echo $phone ?>"></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0 mt-0"> Patient consulting doctor</label></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control border-0 text-center my-0" value="<?php echo "Dr.".$doctor ?>"></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0 mt-0 "></label><h5>Your appointment is booked for</h5></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control border-0 text-center my-0 fs-5" value="<?php echo $date ?>"></div>

<div class="col-12 d-flex justify-content-center"><label for="" class=" form-label text-black my-0 mt-0"><h5>Your Appointment Number</h5></label></div>    
<div class=" col-12 d-flex justify-content-md-center"><input type="text" name="" id="" class=" form-control text-center my-0 fs-2 " value="<?php echo $appNum ?>"></div>

</div>

</div>


<?php include "footer.php"; ?>
</div>
</div>

</body>
</html>


<?php


} else {
    echo "No session data found.";
    
}


?>