<?php
include('db_connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $activation_code = uniqid(); // Generating activation code

    // Preparing SQL query with placeholders to prevent SQL injection
    $sql = "INSERT INTO user (firstname, lastname, email, username, password, telephone, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparing and binding parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $fname, $lname, $email, $username, $password, $telephone, $activation_code);

    // Executing SQL query
    if ($stmt->execute()) {
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $stmt->error;
    }

    // Closing statement
    $stmt->close();
}

// Closing database connection
$conn->close();
?>
