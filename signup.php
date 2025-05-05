<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
session_start();
    include('includes/config.php');
    error_reporting(0);

    if (isset($_POST['signup'])) {
        // Generate unique student ID
        $count_my_page = "studentid.txt";
        $hits = file($count_my_page);
        $hits[0]++;
        $fp = fopen($count_my_page, "w");
        fputs($fp, "$hits[0]");
        fclose($fp);
        $StudentId = $hits[0];

        // Get and sanitize inputs
        $fname = trim($_POST['fullname']);
        $enrollmentno = trim($_POST['enrollmentno']);
        $mobileno = trim($_POST['mobileno']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $status = 1;

        // Validate password match
        if ($password !== $confirmpassword) {
            echo "<script>alert('Password and Confirm Password do not match!');</script>";
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/", $password)) {
            echo "<script>alert('Password must be at least 6 characters, include 1 uppercase, 1 lowercase, 1 number, and 1 special character.');</script>";
        } elseif (!preg_match("/^[0-9]{10}$/", $mobileno)) {
            echo "<script>alert('Invalid mobile number. It must be 10 digits.');</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.');</script>";
        } else {
            // Check for duplicate email or enrollment number
            $check = $dbh->prepare("SELECT * FROM tblstudents WHERE EmailId = :email OR EnrollmentNo = :enrollmentno");
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->bindParam(':enrollmentno', $enrollmentno, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                echo "<script>alert('Email or Enrollment Number already exists.');</script>";
            } else {
                $hashedPassword = md5($password);
                $sql = "INSERT INTO tblstudents(StudentId, FullName, EnrollmentNo, MobileNumber, EmailId, Password, Status) 
                        VALUES(:StudentId, :fname, :enrollmentno, :mobileno, :email, :password, :status)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
                $query->bindParam(':fname', $fname, PDO::PARAM_STR);
                $query->bindParam(':enrollmentno', $enrollmentno, PDO::PARAM_STR);
                $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->execute();

                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    echo "<script>alert('Your registration was successful. Your student ID is $StudentId');</script>";
                } else {
                    echo "<script>alert('Something went wrong. Please try again.');</script>";
                }
            }
        }
    }
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Signup - SOFTLIB Management System</title>
        <link rel="stylesheet" href="assets\css\bootstrap.css">
        <link rel="stylesheet" href="assets\css\font-awesome.css">
        <link rel="stylesheet" href="assets\css\style.css">
        <script type="text/javascript">
            function valid() {
                if (document.signup.password.value != document.signup.confirmpassword.value) {
                    alert("Password and Confirm Password Field do not match  !!");
                    document.signup.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
        <script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data: 'email=' + $("#email").val(),
                    type: "POST",
                    success: function (data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {
                    }
                });
            }
        </script>
        <script type="text/javascript">
            window.onload = function () {
                document.querySelector("form").addEventListener("submit", function(e) {
                    var pwd = document.getElementById("password").value;
                    var cpwd = document.getElementById("confirmpassword").value;
                    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

                    if (!regex.test(pwd)) {
                        alert("Password must be at least 6 characters,\ninclude 1 uppercase, 1 lowercase, 1 number\nand 1 special character.");
                        e.preventDefault();
                        return;
                    }

                    if (pwd !== cpwd) {
                        alert("Passwords do not match.");
                        e.preventDefault();
                        return;
                    }
                });
            };
        </script>



        <style>
            body {
                background: linear-gradient(to top,rgb(252, 252, 252),rgb(228, 241, 252),rgb(215, 232, 246));
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                /* background: white; */
                background: linear-gradient(to bottom, rgb(250, 250, 250), rgb(225, 241, 253));
                padding: 15px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .logo {
                height: 60px;
            }
            .nav-links {
                display: flex;
                gap: 20px;
            }
            .nav-links a {
                text-decoration: none;
                color: #333;
                font-weight: bold;
                transition: color 0.3s;
            }
            .nav-links a:hover {
                color: #007bff;
            }
            .login-container {
                max-width: 400px;
                background: linear-gradient(to bottom,rgb(206, 230, 248),rgb(252, 252, 252));
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
                margin: auto;
                margin-top: 50px;
                position: relative;
                transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            }
            .login-container:hover {
                transform: scale(1.05);
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            }
            .login-container h3 {
                text-align: center;
                color: #007bff;
                font-weight: bold;
                font-size: 25px;
            }
            .login-container input {
                width: 100%;
                padding: 10px;
                margin: 10px -10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                transition: all 0.3s;
            }
            .login-container input:focus {
                border-color: #007bff;
                box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
            }
        .btn-custom {
                background:rgb(45, 145, 251);
                color: white;
                font-size: 15px;
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                transition: all 0.3s ease;
            }
            .btn-custom:hover {
                background: #007bff;
                transform: scale(1.05);
                font-size: 18px;
            }
            footer {
                text-align: center;
                padding: 20px;
                background: #007bff;
                color: white;
                margin-top: 50px;
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <img src="assets/img/SOFTLIBlogo.png" alt="Library Logo" class="logo">
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="index.php#ulogin">User Login</a>
                <a href="adminlogin.php">Admin Login</a>
            </div>
        </nav>
        <div class="login-container">
            <h3>User Signup</h3>
            <form method="post" action="./signup.php">
                <input type="text" name="fullname" placeholder="Enter Full Name" required>
                <input type="text" name="enrollmentno" placeholder="Enter Enrollment Number" minlength="11" maxlength="11" required>
                <input type="text" name="mobileno" placeholder="Mobile Number" maxlength="10" required>
                <input type="email" name="email" id="email" placeholder="Enter Email" onBlur="checkAvailability()" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
                <button type="submit" name="signup" class="btn btn-custom">Sign Up</button>
            </form>
        </div>
        <footer>
            &copy; <?php echo date('Y'); ?> SOFTLIB Management System | All Rights Reserved
        </footer>
    </body>
    </html>
