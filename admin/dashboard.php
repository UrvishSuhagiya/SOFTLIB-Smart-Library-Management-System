<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) { 
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>SOFTLIB Management System | Admin Dashboard</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, rgb(251, 249, 249),rgb(211, 241, 231));
            margin: 0;
            padding: 0;
        }
        .content-wrapper {
            padding: 20px;
        }
        .dashboard-header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 20px;
        }
        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .dashboard-card {
            width: 250px;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: white;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .dashboard-card i {
            font-size: 50px;
            margin-bottom: 10px;
        }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-warning { background-color: #fff3cd; color: #856404; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }
        .alert-info { background-color: #d1ecf1; color: #0c5460; }
        .alert-primary { background-color: #cce5ff; color: #004085; }
        @media (max-width: 768px) {
            .dashboard-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    
    <div class="content-wrapper">
        <div class="container">
            <h4 class="dashboard-header">Admin Dashboard</h4>
            <div class="dashboard-row">

                <a href="manage-categories.php">
                    <div class="dashboard-card alert-primary">
                        <i class="fa fa-file-archive-o"></i>
                        <?php 
                        $sql5 = "SELECT id FROM tblcategory";
                        $query5 = $dbh->prepare($sql5);
                        $query5->execute();
                        $listdcats = $query5->rowCount();
                        ?>
                        <h3><?php echo htmlentities($listdcats); ?></h3>
                        Listed Categories
                    </div>
                </a>

                <a href="manage-authors.php">
                    <div class="dashboard-card alert-info">
                        <i class="fa fa-user"></i>
                        <?php 
                        $sql4 = "SELECT id FROM tblauthors";
                        $query4 = $dbh->prepare($sql4);
                        $query4->execute();
                        $listdathrs = $query4->rowCount();
                        ?>
                        <h3><?php echo htmlentities($listdathrs); ?></h3>
                        Authors Listed
                    </div>
                </a>

                <a href="manage-books.php">
                    <div class="dashboard-card alert-success">
                        <i class="fa fa-book"></i>
                        <?php 
                        $sql = "SELECT id FROM tblbooks";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $listdbooks = $query->rowCount();
                        ?>
                        <h3><?php echo htmlentities($listdbooks); ?></h3>
                        Books Listed
                    </div>
                </a>

                <a href="manage-issued-books.php">
                    <div class="dashboard-card alert-warning">
                        <i class="fa fa-recycle"></i>
                        <?php 
                        $sql2 = "SELECT id FROM tblissuedbookdetails WHERE (RetrunStatus='' OR RetrunStatus IS NULL)";
                        $query2 = $dbh->prepare($sql2);
                        $query2->execute();
                        $returnedbooks = $query2->rowCount();
                        ?>
                        <h3><?php echo htmlentities($returnedbooks); ?></h3>
                        Books Not Returned Yet
                    </div>
                </a>

                
                <a href="reg-students.php">
                    <div class="dashboard-card alert-danger">
                        <i class="fa fa-users"></i>
                        <?php 
                        $sql3 = "SELECT id FROM tblstudents";
                        $query3 = $dbh->prepare($sql3);
                        $query3->execute();
                        $regstds = $query3->rowCount();
                        ?>
                        <h3><?php echo htmlentities($regstds); ?></h3>
                        Registered Users
                    </div>
                </a>
                
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
