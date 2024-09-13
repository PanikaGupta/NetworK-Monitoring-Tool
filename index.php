<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
  
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        h1 {
            text-align: center;
            margin-top: 100px;
            color: #333;
        }

        .main {
            padding: 20px;
            width: 50%;
            margin: 0 auto;
            border: 2px solid #24232a;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"] {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f1f1f1;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #525309;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        button:hover {
            background-color: #93944a;
        }

        label {
            display: block;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        #regiter {
            text-align: center;
            height: 30px;
            margin-top: 20px;
            font-size: 16px;
        }

        #regiter a {
            color: #007bff;
            text-decoration: none;
        }

        #regiter a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if ($pass !== $cpass) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $servername = "localhost";
        $username = "panika";
        $password = "p"; // Update this if your MySQL root password is different
	$db_name = "project_db";
	

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $db_name);

        if (!$conn) {
            die("<p>Error: Unable to connect to MySQL.</p><p>" . mysqli_connect_error() . "</p>");
        } else {
            $stmt = $conn->prepare("SELECT uname FROM user_details WHERE uname=?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<script>alert('This username already exists');</script>";
            } else {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO user_details (uname, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $uname, $hash);

                if ($stmt->execute()) {
                    echo "<script>alert('Record inserted successfully!');</script>";
                } else {
                    echo "<p>Error: " . $stmt->error . "</p>";
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>


    <h1>Register</h1>
    <div class="main">
        <form action="" method="POST">
            <label for="uname">User ID:</label>
            <input type="text" name="uname" id="uname" required>
            
            <label for="pass">Password:</label>
            <input type="password" name="pass" id="pass" placeholder="Password" required>
            
            <label for="cpass">Confirm Password:</label>
            <input type="password" name="cpass" id="cpass" placeholder="Confirm Password" required>
            
            <button type="submit"><b>SUBMIT</b></button>
            
            <p id="regiter">Already have an account? <a href="login.php" class="nav-login">LOGIN</a></p>
        </form>
    </div>
</body>
</html>
