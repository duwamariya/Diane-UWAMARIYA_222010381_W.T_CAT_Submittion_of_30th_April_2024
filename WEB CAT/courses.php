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
            color: purple;
            background-color: blue;
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
            background-color: yellow;
        }

        a:active {
            background-color: green;
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
            background-color: green;
            background-color: skyblue;
        }

        th {
            background-color: blue;
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
        <li style="display: inline; margin-right: 10px;"><a href="./users.php">users</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./student.php">student</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./faculty.php">faculty</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./events.php">events</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./departments.php">departments</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./courses.php">courses</a></li>
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
    <h1><u>Courses Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="course_code">Course Code:</label>
        <input type="number" id="course_code" name="course_code"><br><br>
        <label for="course_title">Course Title:</label>
        <input type="text" id="course_title" name="course_title" required><br><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>
        <label for="credit_hours">Credit Hours:</label>
        <input type="number" id="credit_hours" name="credit_hours" required><br><br>
        
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $connection->prepare("INSERT INTO courses(course_code, course_title, description, credit_hours) VALUES (?, ?, ?, ?)"); 
        $stmt->bind_param("isss", $course_code, $course_title, $description, $credit_hours);

        // Set parameters
        $course_code = $_POST['course_code'];
        $course_title = $_POST['course_title'];    
        $description = $_POST['description'];
        $credit_hours = $_POST['credit_hours'];
       
        // Execute the statement
        if ($stmt->execute()) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // SQL query to fetch data from the courses table
    $sql = "SELECT * FROM courses";
    $result = $connection->query($sql);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail Information of Courses</title>
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
    </head>
    <body>
        <center>
            <form action="search_courses.php" method="GET">
                <input type="text" name="query" placeholder="Search here">
                <button type="submit">Search</button>
            </form>
            <h2>Table of Courses</h2>
        </center>
        <table border="5">
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Description</th>
                <th>Credit Hours</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Check if there are any courses
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $course_code = $row['course_code']; // Corrected variable name
                    echo "<tr>
                        <td>" . $row['course_code'] . "</td>
                        <td>" . $row['course_title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>" . $row['credit_hours'] . "</td>
                        <td><a style='padding:4px' href='delete_courses.php?course_code=$course_code'>Delete</a></td> 
                        <td><a style='padding:4px' href='update_courses.php?course_code=$course_code'>Update</a></td>
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
