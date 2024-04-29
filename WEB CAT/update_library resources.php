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


// Check if id is set
if(isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve library resources details
    $stmt = $connection->prepare("SELECT * FROM library resources WHERE id = ?");
    if ($stmt === false) {
        die("Error in SQL query: " . $connection->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 
        $x = $row['id'];
        $z = $row['books'];
        $y = $row['borrowing_records'];
    } else {
        echo "library resources not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="books">Books:</label>
        <input type="text" name="books" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="borrowing_records">borrowing_records:</label>
        <input type="text" name="borrowing_records" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $books = $_POST['books'];
    $borrowing_records = $_POST['borrowing_records'];

    // Update the library resources in the database
    $stmt = $connection->prepare("UPDATE library resources SET books=?, borrowing_records=? WHERE id=?");
    if ($stmt === false) {
        die("Error in SQL query: " . $connection->error);
    }
    $stmt->bind_param("ssi", $books, $borrowing_records, $id);
    
    if ($stmt->execute()) {
        // Redirect to library_resources.php after successful update
        header('Location: library resources.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating library resources: " . $stmt->error;
    }
}
?>
