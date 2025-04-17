<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT EmailId FROM tblstudents WHERE EmailId=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password successfully changed');</script>";
}
else {
echo "<script>alert('Email ID or Mobile Number is invalid');</script>"; 
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery - SOFTLIB</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("Password and Confirm Password do not match!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>

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
            background: rgb(45, 145, 251);
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
            <a href="index.php#ulogin">User Login</a>
            <a href="signup.php">User Signup</a>
            <a href="adminlogin.php">Admin Login</a>
        </div>
    </nav>

    <div class="login-container">
        <h3>Password Recovery</h3>
        <form name="chngpwd" method="post" onSubmit="return valid();">
            <input type="email" name="email" placeholder="Enter Registered Email ID" required>
            <input type="text" name="mobile" placeholder="Enter Registered Mobile No" required>
            <input type="password" name="newpassword" placeholder="New Password" required>
            <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
            <button type="submit" name="change" class="btn btn-custom">Change Password</button>
        </form>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> SOFTLIB Management System | All Rights Reserved
    </footer>
</body>
</html>
