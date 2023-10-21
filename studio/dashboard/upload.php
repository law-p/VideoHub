<?php
ob_start();
session_start();

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

// Ensure the user is logged in and user information is available in the session
if (!isset($_SESSION['ID'])) {
    // Redirect to a login page
    header('Location: login.php');
    exit;
}

//Get the user ID from the session
$userId = $_SESSION['ID'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === UPLOAD_ERR_OK) {
        // The file has been successfully uploaded.
        $file_tmp = $_FILES['file_path']['tmp_name']; // The temporary location of the uploaded file on the server
        $destination ="videos/" . $_FILES['file_path']['name']; // Specify the destination directory

        // Move the uploaded file 
        if (move_uploaded_file($file_tmp, $destination)) {
            // File has been successfully moved to the destination
            // Now, insert data into the "videos" table
            $title = mysqli_real_escape_string($connection, $_POST['title']); // form field for the video title
            $description = mysqli_real_escape_string($connection, $_POST['description']); //  form field for the video description

            // Perform the SQL insert
            $sql = "INSERT INTO videos (title, description, file_path, owner_id) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $destination, $userId);

                if (mysqli_stmt_execute($stmt)) {
                     // Video data successfully inserted into the "videos" table
        echo "Video uploaded successfully!";
        
        // Add a redirect header to go to another page 
        header('Location: main.php'); 
        exit; //exit to prevent further script execution
                } else {
                    // Handle insert error
                    echo "Error uploading video. (video too Large)";
                }

                mysqli_stmt_close($stmt);
            } else {
                
                echo "Error preparing SQL statement.";
            }
        } else {
            
            echo "Error moving the uploaded file (File too Large).";
        }
    } else {
       
        echo "Error uploading the file (File too Large).";
    }
}

// Close the database connection
mysqli_close($connection);
?>

<?php
ob_end_flush();
?>
