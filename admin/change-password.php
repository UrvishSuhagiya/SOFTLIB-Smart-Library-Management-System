<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['change'])) {
        $password=md5($_POST['password']);
        $newpassword=md5($_POST['newpassword']);
        $username=$_SESSION['alogin'];
        $sql ="SELECT Password FROM admin where UserName=:username and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0) {
            $con="update admin set Password=:newpassword where UserName=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg="Your Password successfully changed";
        } else {
            $error="Your current password is wrong";  
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SOFTLIB Management System | Change Password</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #e3f2fd, #bbdefb);
            margin: 0;
            padding: 0;
        }
        .content-wrapper {
            padding: 20px;
        }
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        .form-container h4 {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-custom {
            background:rgb(79, 163, 253);
            color: black;
            font-size: 16px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background: #007bff;
            transform: scale(1.05);
            color: white;
        }
    </style>
    <script>
        function valid() {
            if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password do not match!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="form-container">
                <h4>Change Password</h4>
                <?php if($error){?><div class="alert alert-danger"><?php echo htmlentities($error); ?></div><?php } 
                else if($msg){?><div class="alert alert-success"><?php echo htmlentities($msg); ?></div><?php }?>
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
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="confirmpassword" required />
                    </div>
                    <button type="submit" name="change" class="btn btn-custom">Change</button>
                </form>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
