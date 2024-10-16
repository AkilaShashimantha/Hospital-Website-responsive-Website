<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boostrap -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <title>About Us</title>
    <link rel="icon" href="images/hospital logo.png" type="image/png">
    
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include 'header.php' ?>



            <div class="header-image col-12 col-lg-12 d-flex justify-content-center">
                <div class="header-text col-12 col-lg-12 mt-5 border-3" style=" box-shadow: 0 0 15px rgba(45, 0, 65, 0.4);  background-color: rgba(255, 255, 255, 0.4);">
                    <div class="header-title col-12 col-lg-12 d-flex justify-content-center p-lg-0 p-2">A Legacy of Caring, A Future of Health</div>
                    <div class="header-body col-12 col-lg-12 d-flex justify-content-center mx-2">Dedicated to Compassionate Care and Excellence in Health. Our mission is to provide compassionate care with cutting-edge medical expertise. Our team is committed to delivering personalized, quality healthcare to every patient, ensuring a healthier tomorrow for our community.</div>
                </div>
            </div>

            <div id="speciality " class="row">
                <div class="speciality-header col-12 col-lg-12">Our Speciality</div>
                <div class="speciality-category row text-center align-content-center ps-5 pb-2">
                    <div class="speciality-card col-4 col-lg-2 p-lg-4 p-3">Primary Care</div>
                    <div class="speciality-card col-4 col-lg-2 p-lg-4 p-3">Emergency Medicine</div>
                    <div class="speciality-card col-4 col-lg-2 p-lg-4 p-3">General Surgery</div>
                    <div class="speciality-card col-4 col-lg-2 p-lg-4 p-3">Cardiology</div>
                    <div class="speciality-card col-4 col-lg-2 p-lg-4 p-3">Dermotology</div>
                    <div class="speciality-card col-4 col-lg-2 p-lg-4 p-3">Sports Medicine</div>
                </div>
            </div>
            <div id="our-story" class="row mx-0" style="background-image: linear-gradient(to right top, #e7edf4, #e4edf6, #e1eef8, #deeef9, #daeffa);">
                <div class="col-12 col-lg-6 offset-lg-3 p-3">
                    <img src="images/img-A-2.jpg" alt="story-image" class="storyImage" style="box-shadow: 0 0 15px rgba(45, 0, 65, 0.4);">
                </div>
                <div class="story-text text-start col-12 col-lg-12">
                    <div class="story-header col-12 col-lg-12 text-center">Short Story About Us</div>

                    <div class="story-body col-12 p-1 border-2 my-4" style="box-shadow: 0 0 15px rgba(45, 0, 65, 0.2);">Welcome to Prime Care Hospital, where compassionate care meets cutting-edge technology. We are a leading healthcare institution committed to providing exceptional medical services to our community. Our team of highly skilled doctors, nurses, and healthcare professionals is dedicated to ensuring the well-being of every patient who walks through our doors.

                        With a wide range of specialties, from cardiology to oncology, pediatrics to orthopedics, we offer comprehensive care tailored to meet your unique needs. Our state-of-the-art facilities and advanced medical technologies enable us to deliver accurate diagnoses and effective treatments, ensuring the best possible outcomes for our patients.

                        In here, we believe in treating each patient with dignity, respect, and empathy. Our mission is to improve the health and quality of life of our patients by providing personalized, high-quality healthcare in a caring and supportive environment.

                        Thank you for choosing Prime Care Hospital as your trusted healthcare partner. We are here for you, every step of the way, on your journey to better health.
                    </div>
                </div>
            </div>


            <?php include 'footer.php' ?>


        </div>

    </div>

</body>

</html>