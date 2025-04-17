<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Admin Dashboard - SOFTLIB</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="font-awesome.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: linear-gradient(to top, rgb(252, 252, 252), rgb(228, 241, 252), rgb(215, 232, 246));
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
        .admin-dashboard-container {
            max-width: 1200px;
            margin: auto;
            padding: 40px;
        }
        .admin-dashboard-header {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #007bff;
            padding: 20px 0;
        }
        .admin-dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }
        .admin-dashboard-card {
            background: linear-gradient(to bottom, rgb(206, 230, 248), rgb(252, 252, 252));
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 30%;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        }
        .admin-dashboard-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }
        .admin-dashboard-card i {
            font-size: 50px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .admin-dashboard-card h3 {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }
        .admin-dashboard-card p {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        .admin-dashboard-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }
        .admin-dashboard-card a:hover {
            background: #0056b3;
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

<?php include('includes/header.php');?>

<div class="admin-dashboard-container">
    <div class="admin-dashboard-header">Welcome to Admin Panel</div>

    <div class="admin-dashboard-cards">
        <div class="admin-dashboard-card">
            <i class="fa fa-book"></i>
            <?php 
            $sql ="SELECT id FROM tblbooks";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $listdbooks = $query->rowCount();
            ?>
            <h3><?php echo htmlentities($listdbooks); ?></h3>
            <p>Books Listed</p>
            <a href="manage-books.php">View Details</a>
        </div>

        <div class="admin-dashboard-card">
            <i class="fa fa-recycle"></i>
            <?php 
            $sql2 ="SELECT id FROM tblissuedbookdetails WHERE (RetrunStatus='' OR RetrunStatus IS NULL)";
            $query2 = $dbh -> prepare($sql2);
            $query2->execute();
            $returnedbooks = $query2->rowCount();
            ?>
            <h3><?php echo htmlentities($returnedbooks); ?></h3>
            <p>Books Not Returned</p>
            <a href="manage-issued-books.php">View Details</a>
        </div>

        <div class="admin-dashboard-card">
            <i class="fa fa-users"></i>
            <?php 
            $sql3 ="SELECT id FROM tblstudents";
            $query3 = $dbh -> prepare($sql3);
            $query3->execute();
            $regstds = $query3->rowCount();
            ?>
            <h3><?php echo htmlentities($regstds); ?></h3>
            <p>Registered Users</p>
            <a href="reg-students.php">View Details</a>
        </div>

        <div class="admin-dashboard-card">
            <i class="fa fa-user"></i>
            <?php 
            $sq4 ="SELECT id FROM tblauthors";
            $query4 = $dbh -> prepare($sq4);
            $query4->execute();
            $listdathrs = $query4->rowCount();
            ?>
            <h3><?php echo htmlentities($listdathrs); ?></h3>
            <p>Authors Listed</p>
            <a href="manage-authors.php">View Details</a>
        </div>

        <div class="admin-dashboard-card">
            <i class="fa fa-file-archive-o"></i>
            <?php 
            $sql5 ="SELECT id FROM tblcategory";
            $query5 = $dbh -> prepare($sql5);
            $query5->execute();
            $listdcats = $query5->rowCount();
            ?>
            <h3><?php echo htmlentities($listdcats); ?> </h3>
            <p>Listed Categories</p>
            <a href="manage-categories.php">View Details</a>
        </div>
    </div>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> SOFTLIB Management System | All Rights Reserved
</footer>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
