<?php
// Include the database connection
include 'dbConnection.php';

// Fetch card data from the database
$sql = "SELECT card_id, title, text_content, image_path, last_updated FROM cards";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Prime Care Hospital</title>

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


      <nav class="navbar navbar-dark col-sm-12 mt-0" style="background-color: #26905E;">
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
                  <a class="nav-link active" aria-current="page" href="Appointment.php"><i class="bi bi-hospital mx-2"></i>Appointment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-file-earmark-text mx-2"></i>Lab Report</a>
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


      <div class="col-12 offset-lg-1 col-lg-10">

        <div class="row">
          <!--  carousel images  Auto scrolling -->

          <div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-inner ">

              <div class="carousel-item active">
                <!-- <img src="images/img1.jpg" class="d-block w-100" alt="..."> -->
                <div class="image-1-display">
                <div class="image-1-text">
                  <div class="image-1-title">Where Healing Begins with Heart, Your Trusted Partner in Health</div>
                </div>
                </div>
              </div>

              <div class="carousel-item">
                <!-- <img src="images/img2.jpg" class="d-block w-100" alt="..."> -->
                <div class="image-2-display">
                <div class="image-2-text">
                  <div class="image-2-title">Caring for the Community, Committed to You</div>
                </div>
                </div>
              </div>

              <div class="carousel-item">
                <!-- <img src="images/img3.jpg" class="d-block w-100" alt="..."> -->
                <div class="image-3-display">
                <div class="image-3-text">
                  <div class="image-3-title">Excellence in Healthcare, Every Day. Together for a Healthier Tomorrow!</div>
                </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-12 " style="background-color: #E3F4CE;">

           <div class="col-12 offset-lg-2 col-lg-8 mt-3 ">

          <div class="row">


            <div class="card mb-3" style="max-width: 100%;">
              <div class="row g-0">
                <div class="col-md-4">
                  <img src="images/img5.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">International Patient Care </h5>
                    <p class="card-text">Prime Care Hospital has a dedicated team to handle the care of international patients within the hospital. This includes coordinating not only the patient’s stay at the hospital and insurance coverage but also airport drop off and pickups as well as hotel accommodation. </p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>


      <div class="container-fluid">
        <div class="row">
          <hr class="my-0">
            <div class="col-12 text-primary text-center fs-1">
              Latest News
            </div>

        <div class="col-12">
            <div class="card-group">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card" id="<?php echo $row['card_id']; ?>">
                            <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Card image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
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


      <hr>
      <?php include "footer.php"; ?>
    </div>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>