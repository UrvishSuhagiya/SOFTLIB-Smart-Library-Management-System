<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['update'])) {    
        $sid = $_SESSION['stdid'];  
        $fname = $_POST['fullanme'];
        $enrollmentno = $_POST['enrollmentno'];
        $mobileno = $_POST['mobileno'];

        $sql = "UPDATE tblstudents 
                SET FullName = :fname, 
                    EnrollmentNo = :enrollmentno,
                    MobileNumber = :mobileno 
                WHERE StudentId = :sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':enrollmentno', $enrollmentno, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Your profile has been updated")</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Profile | SOFTLIB Management</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #f8f9fa, #d7e8f6);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex-grow: 1;
            padding-bottom: 80px;
        }
        .profile-container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        .profile-header {
            background:rgb(55, 131, 212);
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-size: 20px;
            text-align: center;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
        }
        .btn {
            background-color:rgb(111, 198, 168);
            border-color: rgb(14, 79, 57);
            color: black;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 6px;
            transition: 0.3s ease-in-out;
        }
        .btn:hover {
            background-color:rgb(30, 106, 81);
            border-color: rgb(14, 79, 57);
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="profile-container">
            <div class="profile-header">My Profile</div>
            <div class="panel-body">
                <form name="signup" method="post">
                    <?php 
                    $sid = $_SESSION['stdid'];
                    $sql = "SELECT StudentId, FullName, EnrollmentNo, EmailId, MobileNumber, RegDate, UpdationDate, Status 
                            FROM tblstudents WHERE StudentId = :sid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { ?>  

                    <div class="form-group">
                        <label>Student ID:</label>
                        <p class="form-control-static"> <?php echo htmlentities($result->StudentId); ?> </p>
                    </div>
                    <div class="form-group">
                        <label>Reg Date:</label>
                        <p class="form-control-static"> <?php echo htmlentities($result->RegDate); ?> </p>
                    </div>
                    <?php if($result->UpdationDate!="") { ?>
                    <div class="form-group">
                        <label>Last Updation Date:</label>
                        <p class="form-control-static"> <?php echo htmlentities($result->UpdationDate); ?> </p>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Profile Status:</label>
                        <p class="form-control-static" style="color: <?php echo $result->Status == 1 ? 'green' : 'red'; ?>;"> 
                            <?php echo $result->Status == 1 ? 'Active' : 'Blocked'; ?>
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Enter Full Name</label>
                        <input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName); ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Enrollment Number</label>
                        <input class="form-control" type="text" name="enrollmentno" value="<?php echo htmlentities($result->EnrollmentNo); ?>" minlength="11" maxlength="11" required />
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber); ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo htmlentities($result->EmailId); ?>" readonly />
                    </div>
                    <?php } } ?>
                    <button type="submit" name="update" class="btn btn-primary">Update Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
