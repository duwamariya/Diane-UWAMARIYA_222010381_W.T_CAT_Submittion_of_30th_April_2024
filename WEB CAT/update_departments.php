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

// Check if department_code is set
if(isset($_REQUEST['department_code'])) {
    $department_code = $_REQUEST['department_code'];
    
    // Prepare and execute SELECT statement to retrieve departments details
    $stmt = $connection->prepare("SELECT * FROM departments WHERE department_code = ?");
    $stmt->bind_param("i", $department_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['department_code'];
        $z = $row['department_name'];
        $y = $row['department_chair'];
       
    } else {
        echo "departments not found.";
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
        <label for="department_code">department_code:</label>
        <input type="number" name="department_code" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="department_name">department_name:</label>
        <input type="text" name="department_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="department_chair">department_chair:</label>
        <input type="text" name="department_chair" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $department_code = $_POST['department_code'];
    $department_name = $_POST['department_name'];
    $department_code = $_POST['department_code'];
    

    // Update the departments in the database
    $stmt = $connection->prepare("UPDATE departments SET department_name=?, department_chair=? WHERE department_code=?");
    $stmt->bind_param("sss", $department_name, $department_chair,  $department_code);
    
    if ($stmt->execute()) {
        // Redirect to departments.php after successful update
        header('Location: departments.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating departments: " . $stmt->error;
    }
}
?>
