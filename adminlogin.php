<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT UserName, Password FROM admin WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SOFTLIB Management System</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(to top,rgb(252, 252, 252),rgb(228, 241, 252),rgb(215, 232, 246));
            font-family: 'Arial', sans-serif;
        }
        .navbar {
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
            position: relative;
            text-align: center;
            padding: 100px 20px;
            font-size: 2em;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            animation: fadeInZoom 1.5s ease-in-out;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('assets/img/L23.jpg') no-repeat center center/cover;
            filter: blur(4.5px); /* Ensures blur is applied */
            z-index: 0; /* Keeps it in the background */
        }

        @keyframes fadeInZoom {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .hero h1{
            font-size:70px;
        }
        .hero h1, .hero p {
            color: rgb(253, 253, 253);
            text-shadow: 3px 3px 6px rgba(0.1, 0.1, 0.1, 0.8);
            position: relative;
            z-index: 1; /* Ensures text is above the background */
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

    </style>
</head>
<body>
    <nav class="navbar">
        <img src="assets/img/SOFTLIBlogo.png" alt="Library Logo" class="logo">
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="signup.php">User Signup</a>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome to Admin Panel</h1>
        <p>Manage SOFTLIB System Efficiently</p>
    </section>
    
    <div class="login-container">
        <h3>Admin Login</h3>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn btn-custom">Login</button>
        </form>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> SOFTLIB Management System | All Rights Reserved
    </footer>
</body>
</html>