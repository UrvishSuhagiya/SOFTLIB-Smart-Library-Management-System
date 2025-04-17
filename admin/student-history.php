<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{ 

// code for block student    
if(isset($_GET['inid']))
{
    $id=$_GET['inid'];
    $status=0;
    $sql = "update tblstudents set Status=:status  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
    header('location:reg-students.php');
}

//code for active students
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $status=1;
    $sql = "update tblstudents set Status=:status  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
    header('location:reg-students.php');
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SOFTLIB Management System | Student History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .header-line {
            text-align: center;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 40px;
            color: #007bff;
        }
        .panel-default {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .panel-heading {
            background-color: #007bff !important;
            color: white !important;
            font-size: 18px;
            font-weight: bold;
            padding: 15px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .table {
            margin-top: 20px;
            border-collapse: collapse;
        }
        .table thead {
            background-color: #343a40;
            color: white;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle !important;
            padding: 12px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-hover tbody tr:hover {
            background-color: #e8f0fe;
        }
        .table-responsive {
            border-radius: 10px;
            overflow-x: auto;
        }
        .container {
            padding-bottom: 40px;
        }
    </style>
</head>
<body>
<?php include('includes/header.php');?>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <?php $sid=$_GET['stdid']; ?>
                <h4 class="header-line">#<?php echo $sid;?> Book Issued History</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $sid;?> Details
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Enrollment No.</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Issued Book</th>
                                        <th>Issued Date</th>
                                        <th>Returned Date</th>
                                        <th>Fine (if any)</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
$sql = "SELECT 
            tblstudents.EnrollmentNo,
            tblstudents.StudentId,
            tblstudents.FullName,
            tblbooks.BookName,
            tblissuedbookdetails.IssuesDate,
            tblissuedbookdetails.ReturnDate,
            tblissuedbookdetails.fine
        FROM tblissuedbookdetails 
        JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
        JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
        WHERE tblstudents.StudentId = :sid";

$query = $dbh->prepare($sql);
$query->bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;

if($query->rowCount() > 0) {
    foreach($results as $result) {
?>
<tr class="odd gradeX">
    <td class="center"><?php echo htmlentities($cnt);?></td>
    <td class="center"><?php echo htmlentities($result->EnrollmentNo);?></td>
    <td class="center"><?php echo htmlentities($result->StudentId);?></td>
    <td class="center"><?php echo htmlentities($result->FullName);?></td>
    <td class="center"><?php echo htmlentities($result->BookName);?></td>
    <td class="center"><?php echo htmlentities($result->IssuesDate);?></td>
    <td class="center"><?php echo ($result->ReturnDate == '') ? "Not returned yet" : htmlentities($result->ReturnDate); ?></td>
    <td class="center"><?php echo ($result->ReturnDate == '') ? "Not returned yet" : htmlentities($result->fine); ?></td>
</tr>
<?php 
    $cnt++;
    }
} 
?>                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
