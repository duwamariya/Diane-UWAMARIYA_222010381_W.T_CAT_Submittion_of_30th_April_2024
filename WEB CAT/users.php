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
            background-color: white;
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
            background-color: #pink;
        }

        th {
            background-color:;
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
    <h1><u>users Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="user_id">user_id:</label>
        <input type="number" id="user_id" name="user_id"><br><br>
         <label for="username">username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">password:</label>
        <input type="text" id="password" name="password" required><br><br>
        <label for="role">role:</label>
        <input type="text" id="role" name="role" required><br><br>

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
    $stmt = $connection->prepare("INSERT INTO users(user_id, username, password, role) VALUES (?, ?, ?, ?)"); 
    $stmt->bind_param("isss", $user_id, $username, $password, $role);

    // Set parameters
    $user_id = $_POST['user_id']; // Corrected variable name
    $username = $_POST['username'];    
    $password = $_POST['password']; // Corrected variable name
    $role = $_POST['role'];
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch data from the users table
$sql = "SELECT * FROM users";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of users</title>
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
    <center><form action="search_users" method="GET"><input type="text" name="query" placeholder="search here">
    <button>search</button></form><h2>Table of users</h2></center>
    <table border="5">
        <tr>
            <th>user_id</th>
            <th>username</th>
            <th>password</th>
            <th>role</th>

            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any users
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $user_id = $row['user_id']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['role'] . "</td>
                    
                      <td><a style='padding:4px' href='delete_users.php?user_id=$user_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_users.php?user_id=$user_id'>Update</a></td>
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
