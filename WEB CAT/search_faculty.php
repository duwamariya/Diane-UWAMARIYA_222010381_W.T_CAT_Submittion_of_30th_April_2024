 <!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Website</title>
</head>
<body><center>
<table border="1">
    <tr>
        <th>faculty_id</th>
        <th>name</th>
        <th>contact_information</th>
        <th>course_taught</th>
        
    </tr>
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"])) {

    $search_query = $_GET["query"];
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "urhuye"; 

  
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM faculty WHERE name LIKE '%$search_query%'";

   
    $result = $conn->query($sql);

   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>welcome:</strong> " . $row["name"] . "</p>";
            echo "<hr>";
            echo "<tr>";
            echo "<td>".$row["faculty_id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["contact_information"]."</td>";
            echo "<td>".$row["course_taught"]."</td>";
             
            echo "</tr>";
           
        }
    } else {
        echo "No results found.";
    }

    // Close connection
    $conn->close();
}
?>
</table></center>/<br>
<center><button style="width: 100px;height: 40px; background-color: violet; color: white;"><a href="faculty.php">back</a></button></center>
</body>
</html>
