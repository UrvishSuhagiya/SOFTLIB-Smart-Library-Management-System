<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard | SOFTLIB Management System</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        /* General Styling */
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

        /* Alert Box Styling */
        .alert-box {
            background: linear-gradient(to right, #FBD288, #FA812F);
            color: white;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 850px;
            margin: 0 auto 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .alert-box i {
            font-size: 50px;
            animation: shake 0.7s infinite;
            color:rgb(255, 0, 0);
        }

        .alert-number {
            font-size: 28px;
            font-weight: bold;
            color:rgb(255, 0, 0);
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .alert-number:hover {
            color: white;
            transform: scale(2.2);
        }

        .alert-message {
            font-size: 20px;
            font-weight: bold;
            margin-left: 10px;
        }

        /* Animation */
        @keyframes shake {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            50% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .dashboard-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 250px;
            text-decoration: none;
            color: inherit;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .dashboard-card i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        /* Background Colors for Cards */
        .books-card { background: #c8f7c5; }
        .issued-card { background: #c5d9f7; }

        /* Footer Styling */
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

<?php include('includes/header.php');?>

<div class="content-wrapper">
    <div class="container">
        <h2 class="text-center" style="color: #007bff; margin-bottom: 20px;">Student Dashboard</h2>

        <!-- Fetch Books Not Returned Count -->
        <?php 
        $rsts = 0;
        $sid = $_SESSION['stdid'];
        $sql2 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid AND (RetrunStatus=:rsts OR RetrunStatus IS NULL OR RetrunStatus='')";
        $query2 = $dbh->prepare($sql2);
        $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
        $query2->execute();
        $returnedbooks = $query2->rowCount();
        ?>

        <!-- Styled Books Not Returned Alert -->
        <div class="alert-box">
            <i class="fa fa-exclamation-triangle"></i>
            <p class="alert-message"> <span class="alert-number"><?php echo htmlentities($returnedbooks); ?></span> Books Not Returned Yet! </p>
            <p class="alert-message">📢 <strong>Please Return Your Books On Time!</strong></p>
        </div>

        <!-- Fetch Total Issued Books -->
        <?php 
        $ret = $dbh->prepare("SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid");
        $ret->bindParam(':sid', $sid, PDO::PARAM_STR);
        $ret->execute();
        $totalissuedbook = $ret->rowCount();
        ?>

        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <!-- Books Listed -->
            <a href="listed-books.php" class="dashboard-card books-card">
                <i class="fa fa-book text-success"></i>
                <?php 
                $sql = "SELECT id FROM tblbooks";
                $query = $dbh->prepare($sql);
                $query->execute();
                $listdbooks = $query->rowCount();
                ?>
                <h3><?php echo htmlentities($listdbooks); ?></h3>
                <p>Books Listed</p>
            </a>

            <!-- Total Issued Books -->
            <a href="issued-books.php" class="dashboard-card issued-card">
                <i class="fa fa-book text-primary"></i>
                <h3><?php echo htmlentities($totalissuedbook); ?></h3>
                <p>Total Issued Books</p>
            </a>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
