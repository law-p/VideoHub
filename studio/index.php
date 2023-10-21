<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
</head>
<body>
<?php include 'header.php'; ?>

    <?php
        include('display_videos.php');
    ?>

<!-- jQuery library -->   
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
ob_end_flush();
?>
</body>
</html>
