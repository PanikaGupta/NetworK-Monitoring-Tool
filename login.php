<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            background-color: #f4f4f4;
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
            border: 2px solid rgb(36, 23, 42);
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f1f1f1;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color:  #525309;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
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

        #register {
            text-align: center;
            height: 30px;
            margin-top: 20px;
        }

        .alert {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin-top: 100px;">Login</h1>
    <div class="main">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="uname">User ID:</label><br>
            <input type="text" name="uname" id="uname" required><br>
            <label for="pass">Password:</label><br>
            <input type="password" name="pass" id="pass" placeholder="Password" required><br>
            <button type="submit"><b>SUBMIT</b></button>
            <p id="register">Don't have an account? <a href="index.php" class="nav-register">Register</a></p>
        </form>
    </div>

    <!-- Display login errors -->
    <?php 
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger" style="color:red; text-align:center;">' . $login_err . '</div>';
    }
    ?>
</body>
</html>
<?php

require_once "connection.php";
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["uname"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["uname"]);
    }

    if (empty(trim($_POST["pass"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["pass"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT uname, password FROM user_details WHERE uname = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                          
                            $_SESSION["loggedin"] = true;
			    $_SESSION["username"] = $username;
			   system('/var/www/html/nvt/test2.sh');
			   // system('/var/www/html/nvt/process_packets.sh');
                            header("location: welcome.php");
                            exit;
                        } else {
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    } else {
        $login_err = "Please fill in both fields.";
    }

    mysqli_close($conn);
}
?>

<!-- Display login errors -->
<?php 
if (!empty($login_err)) {
    echo '<div class="alert alert-danger" style="color:red; text-align:center;">' . $login_err . '</div>';
}
?>

