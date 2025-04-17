<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Issued Books | SOFTLIB Management System </title>

    <!-- Bootstrap & FontAwesome CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f8fcff, #e3f2fd);
            margin: 0;
            padding: 0;
        }
        .content-wrapper {
            padding: 20px;
        }
        .panel {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            padding: 20px;
        }
        .panel-heading {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            background: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .alert {
            border-radius: 5px;
            padding: 12px;
            font-size: 14px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .table th, .table td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .btn-action {
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 5px;
            margin: 2px;
        }
        .btn-edit {
            background: #77B254;
            color: white;
            border: none;
        }
        .btn-edit:hover {
            background:rgb(95, 147, 64);
        }
        .status-not-returned {
            color: red;
            font-weight: bold;
        }
        .status-returned {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <h3 class="text-center" style="color: #007bff; font-weight: bold;">Manage Issued Books</h3>

            <!-- Success/Error Alerts -->
            <div class="row">
                <div class="col-md-12">
                    <?php if ($_SESSION['error'] != "") { ?>
                        <div class="alert alert-danger">
                            <strong>Error:</strong> <?php echo htmlentities($_SESSION['error']); ?>
                            <?php $_SESSION['error'] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['msg'] != "") { ?>
                        <div class="alert alert-success">
                            <strong>Success:</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                            <?php $_SESSION['msg'] = ""; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Issued Books Table -->
            <div class="panel panel-info">
                <div class="panel-heading">Issued Books List</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Book Name</th>
                                    <th>ISBN</th>
                                    <th>Issued Date</th>
                                    <th>Return Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT tblstudents.FullName, tblbooks.BookName, tblbooks.ISBNNumber, 
                                        tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, 
                                        tblissuedbookdetails.id as rid 
                                        FROM tblissuedbookdetails 
                                        JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
                                        JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
                                        ORDER BY tblissuedbookdetails.id DESC";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>                                        
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->FullName); ?></td>
                                            <td><?php echo htmlentities($result->BookName); ?></td>
                                            <td><?php echo htmlentities($result->ISBNNumber); ?></td>
                                            <td><?php echo htmlentities($result->IssuesDate); ?></td>
                                            <td>
                                                <?php if ($result->ReturnDate == "") { ?>
                                                    <span class="status-not-returned">Not Returned Yet</span>
                                                <?php } else { ?>
                                                    <span class="status-returned"><?php echo htmlentities($result->ReturnDate); ?></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="update-issue-bookdeails.php?rid=<?php echo htmlentities($result->rid); ?>">
                                                    <button class="btn btn-edit btn-action"><i class="fa fa-edit"></i> Edit</button>
                                                </a>
                                            </td>
                                        </tr>
                                <?php $cnt = $cnt + 1; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- JavaScript Files -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
</body>
</html>
<?php } ?>
