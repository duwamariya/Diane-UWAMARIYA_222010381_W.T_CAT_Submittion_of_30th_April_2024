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
            background-color: pink;
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
            background-color: pink;
        }

        th {
            background-color: pink;
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
    <h1><u>faculty Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">faculty_id:</label>
        <input type="number" id="faculty_id" name="faculty_id"><br><br>
         <label for="name">name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="contact_information">contact_information:</label>
        <input type="text" id="contact_information" name="contact_information" required><br><br>
        <label for="course_taught">course_taught:</label>
        <input type="text" id="course_taught" name="course_taught" required><br><br>
        
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
    $stmt = $connection->prepare("INSERT INTO faculty(faculty_id, name, contact_information, course_taught) VALUES (?, ?, ?, ?)"); 
    $stmt->bind_param("isss", $faculty_id, $name, $contact_information, $course_taught);

    // Set parameters
    $faculty_id = $_POST['faculty_id']; // Corrected variable name
    $name = $_POST['name'];    
    $contact_information = $_POST['contact_information']; // Corrected variable name
    $course_taught = $_POST['course_taught']; // Corrected variable name
   
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch data from the faculty table
$sql = "SELECT * FROM faculty";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of faculty</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: skyblue;
        }

        th {
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <center><form action="search_events" method="GET"><input type="text" name="query" placeholder="search here">
    <button>search</button></form><h2>Table of faculty</h2></center>
    <table border="5">
        <tr>
            <th> faculty_id</th>
            <th>name</th>
            <th>contact_information</th>
            <th>course_taught</th>
            
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any faculty
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $fid = $row['faculty_id']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['faculty_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['contact_information'] . "</td>
                    <td>" . $row['course_taught'] . "</td>
                    
                      <td><a style='padding:4px' href='delete_faculty.php?faculty_id=$fid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_faculty.php?faculty_id=$fid'>Update</a></td>
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
