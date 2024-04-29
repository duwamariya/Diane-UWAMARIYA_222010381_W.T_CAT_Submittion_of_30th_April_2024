<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        /* Global styles for links */
        a {
            padding: 10px;
            color: white;
            background-color: pink;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: purple;
        }

        a:link {
            color: brown;
        }

        a:hover {
            background-color: skyblue;
        }

        a:active {
            background-color: red;
        }

        /* Styles for search button and input */
        button.btn {
            margin-left: 15px;
            margin-top: 4px;
            background-color: blue;
            border: none;
        }

        input.form-control {
            width: 200px; /* Adjust width as needed */
            padding: 8px;
        }

        /* Styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: yellow;
        }

        th {
            background-color: skyblue;
        }
    </style>
    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
<header>
    <!-- Navigation Menu -->
    <ul style="list-style-type: none; padding: 0;">
        <li style="display: inline;"><a href="./home.html">HOME</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
       <li style="display: inline; margin-right: 10px;"><a href="./users.php">users</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./student.php">student</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./faculty.php">facutty</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./events.php">events</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./departments.php">departments</a>
    <li style="display: inline; margin-right: 10px;"><a href="./courses.php">courses</a>
  </li>
  </li>
        <li class="dropdown" style="display: inline; margin-right: 10px;">
            <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
            <div class="dropdown-contents">
                <!-- Dropdown Links -->
                <a href="login.html">Login</a>
                <a href="register.html">Register</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</header>

<section>
    <h1><u>events Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">event_name:</label>
        <input type="text" id="event_name" name="event_name"><br><br>
         <label for="dateandtime">dateandtime:</label>
        <input type="date" id="dateandtime" name="dateandtime" required><br><br>
        <label for="location">location:</label>
        <input type="text" id="location" name="location" required><br><br>
        <label for="organisers">organisers:</label>
        <input type="text" id="organisers" name="organisers" required><br><br>
        <label for="participation">participation:</label>
        <input type="text" id="participation" name="participation" required><br><br>
        
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
<?php
// Connection details
$host = "localhost";
$user = "Diane";
$pass = "222010381";
$database = "urhuye";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $connection->prepare("INSERT INTO events(event_name, dateandtime, location, organisers, participation) VALUES (?, ?, ?, ?, ?)"); 
    $stmt->bind_param("sssss", $event_name, $dateandtime, $location, $organisers, $participation);

    // Set parameters
    $event_name = $_POST['event_name'];
    $dateandtime = $_POST['dateandtime'];    
    $location = $_POST['location'];
    $organisers = $_POST['organisers'];
    $participation = $_POST['participation'];
   
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch data from the events table
$sql = "SELECT * FROM events";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of events</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
    <center><form action="search_events" method="GET"><input type="text" name="query" placeholder="search here">
    <button>search</button></form>
    <h2>Table of events</h2></center>
    <table border="5">
        <tr>
            <th>event_name</th>
            <th>dateandtime</th>
            <th>location</th>
            <th>organisers</th>
            <th>participation</th>

            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any events
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $en = $row['event_name']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['event_name'] . "</td>
                    <td>" . $row['dateandtime'] . "</td>
                    <td>" . $row['location'] . "</td>
                    <td>" . $row['organisers'] . "</td>
                    <td>" . $row['participation'] . "</td>
                    
                      <td><a style='padding:4px' href='delete_events.php?event_name=$en'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_events.php?event_name=$en'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>
</html>
</section>
<div><footer style="background-color:grey;text-align: center;width:100%;height:70px; color: white;font-size: 25px;"><p> Designed by Diane UWAMARIYA_222010381 &copy YEAR TWO BIT GROUP A &reg 2024</p></footer></div>
</center>
<center>
    <button style="background-color: darkgreen; width: 150px;height: 40px;" ><a href="home.html" style=" font-size: 15px;color: white;text-decoration: none" >Back Home</a></button>
</center>
</body>
</html>


