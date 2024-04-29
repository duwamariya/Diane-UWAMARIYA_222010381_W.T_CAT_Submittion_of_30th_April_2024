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

// Check if faculty_id is set
if(isset($_REQUEST['faculty_id'])) {
    $faculty_id = $_REQUEST['faculty_id'];
    
    // Prepare and execute SELECT statement to retrieve faculty details
    $stmt = $connection->prepare("SELECT * FROM faculty WHERE faculty_id = ?");
    $stmt->bind_param("i", $faculty_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['faculty_id'];
        $z = $row['name'];
        $y = $row['contact_information'];
        $z = $row['course_taught'];
       

    } else {
        echo "faculty not found.";
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
        <label for="faculty_id">faculty_id:</label>
        <input type="number" name="faculty_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="name">name:</label>
        <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="contact_information">contact_information:</label>
        <input type="text" name="contact_information" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="course_taught">course_taught:</label>
        <input type="text" name="course_taught" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $faculty_id = $_POST['faculty_id'];
    $name = $_POST['name'];
    $contact_information = $_POST['contact_information'];
    $course_taught = $_POST['course_taught'];
    
    // Update the faculty in the database
    $stmt = $connection->prepare("UPDATE faculty SET name=?, contact_information=?, course_taught=? WHERE faculty_id=?");
    $stmt->bind_param("ssss", $name, $contact_information, $course_taught, $faculty_id);
    
    if ($stmt->execute()) {
        // Redirect to faculty.php after successful update
        header('Location: faculty.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating faculty: " . $stmt->error;
    }
}
?>
