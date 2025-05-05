<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT EmailId, Password, StudentId, Status FROM tblstudents WHERE EmailId=:email AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    
    if ($result) {
        $_SESSION['stdid'] = $result->StudentId;
        if ($result->Status == 1) {
            $_SESSION['login'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Your account has been blocked. Please contact admin.');</script>";
        }
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image\png" href="assets\img\SOFTLIBlogo3.png">
    <title>SOFTLIB Management System</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="style.css">
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

        .hero {
            position: relative; /* Make the hero section relative */
            text-align: center;
            padding: 100px 20px;
            font-size: 2em;
            height: 300px;
            animation: fadeIn 5s ease-in-out;
            overflow: hidden; 
            background: linear-gradient(to top,rgb(252, 252, 252),rgb(228, 241, 252),rgb(196, 223, 245));
            text-align: center;
            backdrop-filter: blur(1px);
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: url('assets/img/L7.jpg') no-repeat center center/cover; Same background */
            filter: blur(5px); /* Adjust the blur amount */
            z-index: 0; /* Send it to the back */
        }

        .hero h1, .hero p {
            /* color: #222; */
            color: #000;
            align-item: center;
            text-shadow: 2px 2px 5px rgba(255, 255, 255, 0.8);
            position: relative; /* Position text above the blurred background */
            z-index: 1; /* Bring text to the front */
        }

        .login-container {
            max-width: 400px;
            /* background: linear-gradient(135deg, #ffffff, #e3f2fd); */
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
            font-size : 22px;
        }
        .login-container input {
            width: 100%;
            padding: 10px 10px;
            margin: 10px -10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .login-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }
        .login-container form {
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .forgot-password-btn,
        .not-registered-btn {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .forgot-password-btn {
            background:rgb(135, 139, 143);
            color: white;
        }

        .forgot-password-btn:hover {
            background:rgb(77, 84, 88);
            transform: scale(1.05);
        }

        .not-registered-btn {
            background:rgb(186, 228, 189);
            color:rgb(48, 52, 50);
        }

        .not-registered-btn:hover {
            background:rgb(100, 173, 145);
            color: White;
            transform: scale(1.05);
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
         .image-gallery {
            overflow: hidden;
            white-space: nowrap;
            margin-top: 50px;
            position: relative;
        }
        .image-gallery-container {
            display: flex;
            animation: scrollImages 15s linear infinite;
        }
        .image-gallery img {
            width: 300px;
            height: auto;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s;
        }
        .image-gallery img:hover {
            transform: scale(1.1);
        }
        @keyframes scrollImages {
            0% { transform: translateX(0); }
            100% { transform: translateX(-30%); }
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
            <!-- <a href="#login-container">User Login</a> -->
            <a href="signup.php">User Signup</a>
            <a href="adminlogin.php">Admin Login</a>
        </div>
    </nav>
    <section class="hero">
        <h1>Welcome to the SOFTLIB</h1>
        <p>Softly Managing The Library.</p>
       
    </section>
    
     <div class="image-gallery">
        <div class="image-gallery-container">
            <img src="assets/img/L18.jpg" alt="Library Image">
            <img src="assets/img/L19.jpg" alt="Library Image">
            <img src="assets/img/L20.jpg" alt="Library Image">
            <img src="assets/img/L21.jpg" alt="Library Image">
            <img src="assets/img/L17.jpg" alt="Library Image"> 
        </div>
    </div>

    <div class="login-container">
        <h3>User Login</h3>
        <form method="post" action="index.php">
            <input type="text" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="login" class="btn btn-custom">Login</button>
            
        <div class="button-container">
            <button type="button" class="forgot-password-btn" onclick="location.href='user-forgot-password.php'">Forgot Password</button>
            <button type="button" class="not-registered-btn" onclick="location.href='signup.php'">Not Registered Yet</button>
        </div>

        </form>
    </div>
   
    <footer>
        &copy; <?php echo date('Y'); ?> SOFTLIB Management System | All Rights Reserved
    </footer>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>