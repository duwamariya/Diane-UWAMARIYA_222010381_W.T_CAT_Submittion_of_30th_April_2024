<?php
// Connection details
$servername = "localhost";
$username = "Diane";
$password = "222010381";
$dbname = "urhuye";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($stmt->execute()) {
        // Redirect to employeetable.php after successful deletion
        header('location: users.php?msg=Data deleted successfully');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
      }
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "user_id is not set.";
}

$conn->close();
?>
