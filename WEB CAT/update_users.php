<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "urhuye";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Prepare and execute SELECT statement to retrieve user_id details
    $stmt = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['user_id'];
        $z = $row['username'];
        $y = $row['password'];
        $y = $row['role'];
       
    } else {
        echo "users not found.";
    }
}

?>

<html>
<head><title></title>
<!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script></head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="user_id">user_id:</label>
        <input type="number" name="user_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="username">username:</label>
        <input type="text" name="username" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="password">password:</label>
        <input type="text" name="password" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="role">role:</label>
        <input type="text" name="role" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Update the users in the database
    $stmt = $connection->prepare("UPDATE users SET username=?, password=?, role=? WHERE user_id=?");

    $stmt->bind_param("ssss", $username, $password, $role, $user_id);
    
    if ($stmt->execute()) {
        // Redirect to users.php after successful update
        header('Location: users.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating users: " . $stmt->error;
    }
}
?>
