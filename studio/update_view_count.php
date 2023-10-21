<?php
ob_start();
session_start();
?>
<?php
$host = "localhost";
$username = "bookworm_store";
$password = "1998.1989lawp";
$database = "bookworm_data";

$connection = mysqli_connect($host, $username, $password);

if (mysqli_connect_errno()) {
    echo(mysqli_connect_error());
    die();
}

mysqli_select_db($connection, $database);
if (mysqli_errno($connection)) {
    echo(mysqli_error($connection));
    die();
}

if(isset($_GET['video_id'])) {
    $videoId = $_GET['video_id'];
    $updateSql = "UPDATE videos SET view_count = view_count + 1 WHERE video_id = $videoId";
    mysqli_query($connection, $updateSql);

    echo "View count updated for video ID " . $videoId;
}

mysqli_close($connection);
ob_end_flush();
?>
