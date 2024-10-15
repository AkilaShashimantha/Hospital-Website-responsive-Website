<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Card</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    h1{
        padding: 50px;
    }
</style>
</head>
<body>

    <!-- Bootstrap container for centering -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-6 p-0" >
            <h1 class="text-center my-0 mt-0">Update Card</h1>

            <form action="updateCard.php" method="POST" enctype="multipart/form-data">
                <!-- Dropdown for selecting card ID -->
                <div class="mb-3">
                    <label for="card_id" class="form-label">Select Card ID:</label>
                    <select id="card_id" name="card_id" class="form-select" required>
                        <option value="0">Card 0</option>
                        <option value="1">Card 1</option>
                        <option value="2">Card 2</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Card Title:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Choose the image:</label>
                    <input type="file"  name="image" class="form-control" accept=" .jpg , .jpeg, .png" required>
                </div>
                
                <div class="mb-3">
                    <label for="text_content" class="form-label">Card Text:</label>
                    <textarea id="text_content" name="text_content" class="form-control" required></textarea>
                </div>
                <button type="submit" name="upload"  class="btn btn-primary w-100" value="update">Update Card</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
