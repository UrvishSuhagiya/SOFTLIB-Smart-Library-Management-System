<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 

// Block Student  
if (isset($_GET['inid'])) {
    $id = $_GET['inid'];
    $status = 0;
    $sql = "UPDATE tblstudents SET Status=:status WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    header('location:reg-students.php');
}

// Activate Student
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = 1;
    $sql = "UPDATE tblstudents SET Status=:status WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    header('location:reg-students.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Registered Students | SOFTLIB Management System </title>

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
        .btn-active {
            background:rgb(92, 176, 110);
            color: black;
            border: none;
        }
        .btn-active:hover {
            background: #218838;
            color: white;
        }
        .btn-blocked {
            background:rgba(246, 48, 68, 0.61);
            color: black;
            border: none;
        }
        .btn-blocked:hover {
            background:rgb(246, 48, 68);
            color: white;
        }
        .btn-details {
            background:rgb(59, 153, 253);
            color: black;
            border: none;
        }
        .btn-details:hover {
            background: #0056b3;
            color: white;x
        }
        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-blocked {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <h3 class="text-center" style="color: #007bff; font-weight: bold;">Manage Registered Students</h3>

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

            <!-- Registered Students Table -->
            <div class="panel panel-info">
                <div class="panel-heading">Registered Students</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student ID</th>
                                    <th>Enrollment No.</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Reg Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT * FROM tblstudents";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>                                        
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->StudentId); ?></td>
                                            <td><?php echo htmlentities($result->EnrollmentNo); ?></td> <!-- NEW COLUMN -->
                                            <td><?php echo htmlentities($result->FullName); ?></td>
                                            <td><?php echo htmlentities($result->EmailId); ?></td>
                                            <td><?php echo htmlentities($result->MobileNumber); ?></td>
                                            <td><?php echo htmlentities($result->RegDate); ?></td>
                                            <td>
                                                <?php if ($result->Status == 1) { ?>
                                                    <span class="status-active">Active</span>
                                                <?php } else { ?>
                                                    <span class="status-blocked">Blocked</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($result->Status == 1) { ?>
                                                    <a href="reg-students.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to block this student?');">
                                                        <button class="btn btn-blocked btn-action"> Block  </button>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="reg-students.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to activate this student?');">
                                                        <button class="btn btn-active btn-action"> Activate</button>
                                                    </a>
                                                <?php } ?>
                                                <a href="student-history.php?stdid=<?php echo htmlentities($result->StudentId); ?>">
                                                    <button class="btn btn-details btn-action"> Details</button>
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
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
</body>
</html>
<?php } ?>
