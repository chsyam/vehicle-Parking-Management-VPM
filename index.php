<?php include "conn.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Parking System</title>
    <script src="https://kit.fontawesome.com/a16ff108d1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <input type="checkbox" name="" id="check">
    <div class="log">
        <div class="login">
            <h2>Login Form</h2>
            <div class="cancel"><label for="check">Close<i class="fas fa-times"></i></label></div>
            <form action="" method="POST">
                <input type="email" name="uemail" placeholder="Email Id"><br>
                <input type="password" name="upass" id="" placeholder="Password"><br>
                <button type="submit">Login</button>
                <br>
            </form>
            <span class="login_error">
                <?php
                if (isset($_REQUEST['uemail'])) {
                    $log_email = $_REQUEST['uemail'];
                    $log_pass = $_REQUEST['upass'];
                    $login_query = "select * from users where email='$log_email' and password='$log_pass'";
                    $log_res = mysqli_query($con, $login_query);
                    if ($log_res) {
                        session_start();
                        $_SESSION['uemail'] = $log_email;
                        header("Location:dashboard.php");
                    } else {
                        echo "Invalid Credentials";
                    }
                }
                ?>
            </span>
        </div>
    </div>
    <input type="checkbox" name="" id="reg_check">
    <div class="reg">
        <div class="register">
            <form action="" method="POST">
                <h2>Register Form</h2>
                <div class="cancel"><label for="reg_check">Close<i class="fas fa-times"></i></label></div>
                <input type="text" name="first" id="" placeholder="First Name"><br>
                <input type="text" name="last" id="" placeholder="Last Name"><br>
                <input type="email" name="email" placeholder="Email Id"><br>
                <input type="number" name="phone" id="" placeholder="Contact Number"><br>
                <input type="password" name="pass" id="" placeholder="Password"><br>
                <input type="password" name="cpass" id="" placeholder="Confirm Password"><br>
                <button type="submit">Register</button><br>
                <span class="register_error">
                </span>
            </form>
            <?php
            if (isset($_REQUEST["first"])) {
                $first = $_REQUEST['first'];
                $last = $_REQUEST['last'];
                $pass = $_REQUEST['pass'];
                $cpass = $_REQUEST['cpass'];
                $number = $_REQUEST['phone'];
                $email = $_REQUEST['email'];
                $signup_query = "insert into users(firstName,lastName,email,phone,password) 
                        values('$first','$last','$email','$number','$pass')";
                $res = mysqli_query($con, $signup_query);
                if ($res) {
                    echo "Account created Successfully....!";
                } else {
                    echo "There was a problem in submitting details...! Please try again after sometime";
                }
            }
            ?>
        </div>
    </div>
    <header>
        <div class="header">
            <div class="logo">
                <ul>
                    <li class="title">Vehicle Parking System</li>
                </ul>
            </div>
            <div class="menu">
                <ul>
                    <li>About</li>
                    <li><label for="check">Login</label></li>
                    <li><label for="reg_check">Register</label></li>
                </ul>
            </div>
        </div>
    </header>
</body>

</html>