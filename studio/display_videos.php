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

$sql = "SELECT videos.*, user.*
FROM videos
JOIN user ON videos.owner_id = user.ID;
";

$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="container mt-5">';
    echo '<div class="row btn2">';
    while ($row = mysqli_fetch_assoc($result)) {
        $videoPath = $row['file_path']; // file_path contains the video file path
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
        echo '<p class="card-text">' . $row['description'] . '</p>';
        echo '<video controls width="100%" id="view-count-' . $row['video_id'] . '" data-videoid="' . $row['video_id'] . '" onplay="updateViewCount(' . $row['video_id'] . ')">';
        echo '<source src="dashboard/' . $row['file_path'] . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
        echo '<p class="card-text">Posted by ' . $row['FNAME'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';

    mysqli_free_result($result);
} else {
    echo "No videos found.";
}

mysqli_close($connection);

ob_end_flush();
?>

<script>
function updateViewCount(videoId) {
    var viewCountElement = document.getElementById('view-count-' + videoId);
    var currentViewCount = parseInt(viewCountElement.innerText);
    viewCountElement.innerText = currentViewCount + 1;

    // Send an AJAX request to update the view count in the database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("View count updated for video ID " + videoId);
        }
    };
    xhttp.open("GET", "update_view_count.php?video_id=" + videoId, true);
    xhttp.send();
}
</script>
