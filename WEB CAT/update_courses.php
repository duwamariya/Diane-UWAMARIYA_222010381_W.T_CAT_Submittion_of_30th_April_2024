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

// Check if course_code is set
if(isset($_REQUEST['course_code'])) {
    $course_code = $_REQUEST['course_code'];
    
    // Prepare and execute SELECT statement to retrieve courses details
    $stmt = $connection->prepare("SELECT * FROM courses WHERE course_code = ?");
    $stmt->bind_param("i", $course_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['course_code'];
        $z = $row['course_title'];
        $y = $row['description'];
        $z = $row['credit_hours'];
       

    } else {
        echo "courses not found.";
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
        <label for="course_code">course_code:</label>
        <input type="number" name="course_code" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="course_title">course_title:</label>
        <input type="text" name="course_title" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="description">description:</label>
        <input type="text" name="description" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="credit_hours">credit_hours:</label>
        <input type="number" name="credit_hours" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $course_code = $_POST['course_code'];
    $course_title = $_POST['course_title'];
    $description = $_POST['description'];
    $credit_hours = $_POST['credit_hours'];
    
    // Update the courses in the database
    $stmt = $connection->prepare("UPDATE courses SET course_title=?, description=?, credit_hours=? WHERE course_code=?");
    $stmt->bind_param("ssss", $course_title, $description, $credit_hours, $course_code);
    
    if ($stmt->execute()) {
        // Redirect to courses.php after successful update
        header('Location: courses.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating courses: " . $stmt->error;
    }
}
?>
