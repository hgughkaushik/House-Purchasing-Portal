<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" )
if (isset($_POST["add"])) {
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homezone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Collect form data
    $propertyName = $_POST["propertyName"];
    $propertyLocation = $_POST["propertyLocation"];
    $propertyPrice = $_POST["propertyPrice"];
    $propertyAddress = $_POST["propertyAddress"];

    // File upload handling
    $targetDir = "uploads/"; // Create a folder named 'uploads' in the same directory as your PHP file
    $targetFile = $targetDir . basename($_FILES["propertyImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["add"])) {
        $check = getimagesize($_FILES["propertyImage"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["propertyImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" &&
        $imageFileType != "jpeg" && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else { // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["propertyImage"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["propertyImage"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO properties (name, location, price, address, image_path)
            VALUES ('$propertyName', '$propertyLocation', '$propertyPrice', '$propertyAddress', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("property added successfully....!!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();

}
?>
