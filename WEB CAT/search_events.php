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
        <th>event_name</th>
        <th>dateandtime</th>
        <th>location</th>
        <th>organisers</th>
        <th>participation</th>
        
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

    
    $sql = "SELECT * FROM events WHERE event_name LIKE '%$search_query%'";

   
    $result = $conn->query($sql);

   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>welcome:</strong> " . $row["event_name"] . "</p>";
            echo "<hr>";
            echo "<tr>";
            echo "<td>".$row["event_name"]."</td>";
            echo "<td>".$row["dateandtime"]."</td>";
            echo "<td>".$row["location"]."</td>";
            echo "<td>".$row["organisers"]."</td>";
            echo "<td>".$row["participation"]."</td>";
             
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
<center><button style="width: 100px;height: 40px; background-color: violet; color: white;"><a href="events.php">back</a></button></center>
</body>
</html>
