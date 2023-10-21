<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Video </title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for styling */
        body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1 class="mb-4 text-center">Video Upload Form</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data" class="container">
    <div class="form-group">
    <label for="file_path"><i class="fas fa-video"></i> Select Video File:</label>
    <input type="file" class="form-control" id="file_path" name="file_path" accept="video/*" required>
</div>

        <div class="form-group">
            <label for="title"><i class="fas fa-file-signature"></i> Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description"><i class="fas fa-comment"></i> Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload Video</button>
        </div>
    </form>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
   
    <?php
    ob_end_flush();
    ?> 
</body>
</html>

