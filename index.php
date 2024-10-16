<?php
// Include the database connection
include 'connection.php';

// Fetch card data from the database
//$sql = "SELECT card_id, title, text_content, image_path, last_updated FROM cards";


$resultset = Database::search("SELECT card_id, title, text_content, image_path, last_updated FROM cards");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Prime Care Hospital</title>
  <link rel="icon" href="images/hospital logo.png" type="image/png">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
-->
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body>

  <div class="container-fluid">

    <div class="row">

      <?php include "header.php"; ?>

      <hr class="my-0">



      <nav class="navbar navbar-dark col-sm-12 mt-0" style="background-image: linear-gradient(to right top, #120946, #1d1b64, #262d85, #2b41a7, #2b56cb);">
        <div class="container-fluid">

          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

            <div class="offcanvas-header">
              <!-- <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>-->
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">

              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house-fill mx-2"></i>Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="about.php"><i class="bi bi-info-circle mx-2"></i>About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="AppointmentSearch.php"><i class="bi bi-hospital mx-2"></i>Appointment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="labreport.php"><i class="bi bi-file-earmark-text mx-2"></i>Lab Report</a>
                </li>
                <!--   <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
              </li>
              </ul>
              <form class="d-flex mt-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button>
              </form>-->



              </ul>
            </div>

            <div class="col-12 align-self-end align-items-center">

              <div class="col-12  mx-1 mt-3 text-center">
                <h5 class="text-warning">PRIME CARE HOSPITAL</h5>
                <p>Here we are the primcecarehospital.lk&trade; to support you for maintain your health</p>

              </div>

              <div class="col-12 mx-2">

                <ul class="nav-item">
                  <a class="nav-link active" aria-current="page" href="adminLogin.php"><i class="bi bi-file-earmark-text mx-2"></i>Admin Login</a>
                </ul>
              </div>

            </div>


          </div>
        </div>
      </nav>

      <div style="background-image: linear-gradient(to right top, #f3f3f3, #f4f4f5, #f4f6f8, #f4f7fa, #f4f9fc);">

        <div class="col-12 offset-lg-1 col-lg-10 mt-2">

          <div class="row">
            <!--  carousel images  Auto scrolling -->

            <div id="carouselExampleSlidesOnly" class="carousel slide p-0" data-bs-ride="carousel" style="  box-shadow: 0 0 15px rgba(45, 0, 65, 0.2);">
              <div class="carousel-inner p-0">

                <div class="carousel-item active p-0">

                  <div class="col-12 c-img-1">
                    <div class="c-img1-text ">Where Healing Begins with Heart, Your Trusted Partner in Health</div>
                    <img src="images/img1.jpg" class="d-block w-100" alt="..." style="position: relative;">
                    <img src="images/c-img1.jpg" alt="" class="bg-img">
                  </div>

                </div>

                <div class="carousel-item">

                  <div class="col-12 c-img-1">
                    <div class="c-img1-text ">Caring for the Community, Committed to You</div>
                    <img src="images/img2.jpg" class="d-block w-100" alt="..." style="position: relative;">
                    <img src="images/c-img2.jpg" alt="" class="bg-img2">
                  </div>

                </div>

                <div class="carousel-item">

                  <div class="col-12 c-img-1">
                    <div class="c-img3-text ">Caring for the Community, Committed to You</div>
                    <img src="images/img3.jpg" class="d-block w-100" alt="..."  style="position: relative;">
                    <img src="images/c-img3.jpg" alt="" class="bg-img3">
                  </div>

                </div>

              </div>
            </div>



            <div class="col-12 offset-lg-2 col-lg-8 mt-3 my-2">

              <div class="row">


                <div class="card p-3 w-100">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="images/img5.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">International Patient Care </h5>
                        <p class="card-text">Prime Care Hospital has a dedicated team to handle the care of international patients within the hospital. This includes coordinating not only the patient’s stay at the hospital and insurance coverage but also airport drop off and pickups as well as hotel accommodation. </p>
                        <p class="card-text"><small class="text-body-secondary"></small></p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>

            <div class="col-12 mt-2 my-2 mt-lg-3 my-lg-3">
              <div class="row">

                <div class=" col-12 col-lg-5 p-0 d-flex justify-content-center hover-animate">
                  <img src="images/h-img1.png" alt="" class="col-9 col-lg-12">
                </div>


                <div class="col-12 col-lg-5 p-0 d-flex justify-content-center mt-2 mt-lg-0 hover-animate2">
                  <img src="images/h-img2.png" alt="" class="col-9 col-lg-12 offset-lg-10">
                </div>

              </div>

            </div>

            <div class="col-12 my-4">
              <div class="card-group">
                <?php
                if ($resultset->num_rows > 0) {
                  while ($row = $resultset->fetch_assoc()) {
                ?>
                    <div class="card" id="<?php echo $row['card_id']; ?>">
                      <img src="<?php echo $row['image_path']; ?>" class="card-img-top hover-zoom " alt="Card image">
                      <div class="card-body">
                        <h3 class="card-title"><?php echo $row['title']; ?></h3>
                        <p class="card-text"><?php echo $row['text_content']; ?></p>
                        <p class="card-text"><small class="text-body-secondary">Last updated <?php echo $row['last_updated']; ?></small></p>
                      </div>
                    </div>
                <?php
                  }
                } else {
                  echo "<p>No cards available.</p>";
                }
                ?>
              </div>
            </div>
          </div>



          <!-- Welcome Div -->
          <div id="welcomeDiv" class="welcome-overlay " style="display: none;" onclick="hideWelcomeMessage()">
            <div class="welcome-message ">
              <button class="close-btn" onclick="hideWelcomeMessage()">×</button>
              <div class="col-12 d-flex justify-content-center"><img src="https://www.primecareltd.com/uploads/company/logo.png" alt="Hospital Logo" class="col-lg-4 col-4"></div>
              <h1>Welcome to Prime Care Hospital</h1>
              <p>Your health, our priority.</p>
            </div>
          </div>




          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

          <script>
            function hideWelcomeMessage() {
              $('#welcomeDiv').fadeOut();
              localStorage.setItem('welcomeMessageSeen', 'true');
            }


            $(document).ready(function() {

              var welcomeMessageSeen = localStorage.getItem('welcomeMessageSeen');

              if (!welcomeMessageSeen) {
                $('#welcomeDiv').show();

                setTimeout(function() {
                  hideWelcomeMessage();
                }, 6000);
              }
            });
          </script>


        </div>

      </div>
      <hr class=" my-0">
    </div>
  </div>

  <?php include "footer.php"; ?>


<script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>