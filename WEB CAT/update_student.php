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
if(isset($_REQUEST['student_id'])) {
    $student_id = $_REQUEST['student_id'];
    
    // Prepare and execute SELECT statement to retrieve user_id details
    $stmt = $connection->prepare("SELECT * FROM student WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['student_id'];
        $z = $row['name'];
        $y = $row['dob'];
        $y = $row['program'];
       
    } else {
        echo "student not found.";
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
        <label for="student_id">student_id:</label>
        <input type="number" name="student_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="name">name:</label>
        <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="dob">dob:</label>
        <input type="text" name="dob" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="program">program:</label>
        <input type="text" name="program" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $program = $_POST['program'];

    // Update the student in the database
    $stmt = $connection->prepare("UPDATE student SET name=?, dob=?, program=? WHERE student_id=?");

    $stmt->bind_param("ssss", $name, $dob, $program, $student_id);
    
    if ($stmt->execute()) {
        // Redirect to student.php after successful update
        header('Location: student.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating student: " . $stmt->error;
    }
}
?>
