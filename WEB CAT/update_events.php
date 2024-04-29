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

// Check if event_name is set
if(isset($_REQUEST['event_name'])) {
    $event_name = $_REQUEST['event_name'];
    
    // Prepare and execute SELECT statement to retrieve event details
    $stmt = $connection->prepare("SELECT * FROM events WHERE event_name = ?");
    $stmt->bind_param("s", $event_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['event_name'];
        $z = $row['dateandtime'];
        $y = $row['location'];
        $w = $row['organisers'];
        $v = $row['participation'];
    } else {
        echo "events not found.";
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
        <label for="event_name">Event Name:</label>
        <input type="text" name="event_name" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="dateandtime">dateandtime:</label>
        <input type="date" name="dateandtime" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="organisers">Organisers:</label>
        <input type="text" name="organisers" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <label for="participation">Participation:</label>
        <input type="text" name="participation" value="<?php echo isset($v) ? $v : ''; ?>"><br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $event_name = $_POST['event_name'];
    $dateandtime = $_POST['dateandtime'];
    $location = $_POST['location'];
    $organisers = $_POST['organisers'];
    $participation = $_POST['participation'];

    // Update the event in the database
    $stmt = $connection->prepare("UPDATE events SET dateandtime=?, location=?, organisers=?, participation=? WHERE event_name=?");

    $stmt->bind_param("sssss", $dateandtime, $location, $organisers, $participation, $event_name);
    
    if ($stmt->execute()) {
        // Redirect to events.php after successful update
        header('Location: events.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating events: " . $stmt->error;
    }
}
?>
