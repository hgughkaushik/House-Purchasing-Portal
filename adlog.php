<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" )
if (isset($_POST["login"])) {
    // Get username and password from the form
    $username = $_POST['adminUsername'];
    $password = $_POST['adminPassword'];

    // Database configuration
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "homezone";

    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    // Implement your login logic here
    $sql = "SELECT * FROM admin WHERE adnewUsername='$username' AND adnewPassword='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Login successful
            echo '<script>alert("Login successful. Redirecting to the dashboard...");</script>';

        header("Location: admdash.html");
    exit();
        // You can redirect the user to the dashboard here
    } else {
        // Login failed
        echo "Invalid username or password";
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the signup button is clicked
    if (isset($_POST["signup"])) {
        // Retrieve form data
        $name = $_POST["adminName"];
        $age = $_POST["adminAge"];
        $gender = $_POST["adminGender"];
        $address = $_POST["adminAddress"];
        $newUsername = $_POST["adnewUsername"];
        $newPassword = $_POST["adnewPassword"];

        // Your database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "homezone";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Your signup SQL query
        $sql = "INSERT INTO admin (adminName,adminAge,adminGender,adminAddress,
         adnewUsername, adnewPassword) VALUES ('$name','$age','$gender','$address', '$newUsername', '$newPassword')";

        if ($conn->query($sql) === TRUE) {
            // Signup successful, redirect the user to the dashboard or perform other actions
            // For now, we'll just display a success message
            echo '<script>alert("Signup successful. Redirecting to the dashboard...");</script>';
            header("Location: admdash.html");
        exit();
        } else {
            // Signup failed, handle accordingly (e.g., display an error message)
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
        // Close the database connection
        $conn->close();
    } else {
        // Handle other POST requests or perform additional logic here
    }

?>










