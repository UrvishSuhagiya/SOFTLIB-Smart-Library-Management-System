<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['change'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $email = $_SESSION['login'];

        $sql = "SELECT Password FROM tblstudents WHERE EmailId=:email and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if($query->rowCount() > 0) {
            $con = "UPDATE tblstudents SET Password=:newpassword WHERE EmailId=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Your Password has been successfully changed";
        } else {
            $error = "Your current password is incorrect";  
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password | SOFTLIB Management System</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password do not match!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>

    <style>
        body {
            background: linear-gradient(to bottom, #f8f9fa, #d7e8f6);
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        .change-password-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .change-password-box h3 {
            color: #007bff;
            font-size: 22px;
            margin-bottom: 20px;
            margin-top: 0px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .btn-custom {
            background: #007bff;
            color: white;
            font-size: 16px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .errorWrap {
            background: #ffcccc;
            border-left: 4px solid #dd3d36;
            color: #a94442;
        }

        .succWrap {
            background: #dff0d8;
            border-left: 4px solid #5cb85c;
            color: #3c763d;
        }

        footer {
            text-align: center;
            padding: 15px;
            background: #007bff;
            color: white;
            margin-top: auto;
        }
    </style>
</head>
<body>

<?php include('includes/header.php');?>

<div class="container">
    <div class="change-password-box">
        <h3>Change Password</h3><hr>

        <?php if($error) { ?>
            <div class="message errorWrap"><?php echo htmlentities($error); ?></div>
        <?php } else if($msg) { ?>
            <div class="message succWrap"><?php echo htmlentities($msg); ?></div>
        <?php } ?>

        <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
            <div class="form-group">
                <label>Current Password</label>
                <input class="form-control" type="password" name="password" required />
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input class="form-control" type="password" name="newpassword" required />
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input class="form-control" type="password" name="confirmpassword" required />
            </div>

            <button type="submit" name="change" class="btn-custom">Change Password</button>
        </form>
    </div>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> SOFTLIB Management System | All Rights Reserved
</footer>

</body>
</html>
