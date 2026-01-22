<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


   $fullName = $_POST["name"];
   $email = $_POST["email"];
   $address = $_POST["address"];
   $phoneNumber = $_POST["number"];
   $propertyPrice = $_POST["price"];
   $state = $_POST["state"];
   $pincode = $_POST["pincode"];

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
    $sql = "INSERT INTO purchases (name, email, address, number, price, state, pincode) VALUES ('$fullName', '$email', '$address', '$phoneNumber', '$propertyPrice', '$state', '$pincode')";

    if ($conn->query($sql) === TRUE) {
        // Purchase successful, you can redirect the user to a confirmation page or perform other actions
        echo '<script>alert("Thank you for your purchase!");</script>';
        header("Location: dashboard.html");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
//}


?>










