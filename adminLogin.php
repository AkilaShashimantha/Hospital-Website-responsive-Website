<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php include "header.php"; ?>
      <hr class="my-0">
      <div class="col-12" style="background-color: #d3ffd3;">
        <div class="offset-lg-4 col-lg-4 offset-2 col-8 offset-md-4 col-md-4 mt-5 my-5" style="background-color: #a6ffa6; border-radius: 20px;">
          <div class="row">
            <div class="col-12 text-center text-primary fs-1">
              <p>Admin Login</p>
            </div>
            <div class="col-12 my-3">
              <form method="post" action="adminSignInProcess.php"> <!-- Added method and action attributes -->
                <div class="mb-3 mx-1">
                  <label for="adminEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="adminEmail" name="e" required>
                </div>

                <div class="row">
                  <div class="mb-3 mx-1 col-10">
                    <label for="adminPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="adminPassword" name="p" required>
                  </div>

                  <div class="col-1 mt-3 align-content-center">
                    <img src="images/eye-slash-fill.svg" alt="" id="pShow">
                  </div>
                </div>

                <div class="offset-1 col-2">
                  <button class="btn btn-primary" type="submit">Sign In</button> <!-- Submit button -->
                  <span class="col-3 text-danger text-center" id="msg"></span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include "footer.php"; ?>
    </div>
  </div>
</body>

</html>
