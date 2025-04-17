<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{ 
    if(isset($_GET['del']))
    {
        $id=$_GET['del'];
        $sql = "DELETE FROM tblcategory WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id',$id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg']="Category deleted successfully";
        header('location:manage-categories.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SOFTLIB Management System | Manage Categories</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
        }
        .panel-heading {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            background: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background: #f1faff;
        }
        .btn-custom {
            padding: 6px 12px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
        .badge-active {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge-inactive {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        /* Custom Styling for Records per Page */
        .dataTables_length {
            margin-bottom: 10px;
        }
        .dataTables_length select {
            padding: 6px;
            border-radius: 5px;
            border: 2px solid #007bff;
            outline: none;
            cursor: pointer;
        }
        /* Stylish Search Box */
        .dataTables_filter {
            text-align: right;
        }
        .dataTables_filter input {
            width: 250px;
            padding: 8px;
            border: 2px solid #007bff;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease-in-out;
        }
        .dataTables_filter input:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12 text-center">
                    <h2 class="header-line" style="font-weight: bold; color: #007bff; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                        Manage Categories
                    </h2>
                </div>
            </div>
            <div class="row">
                <?php if($_SESSION['delmsg']!="") { ?>
                <div class="col-md-12">
                    <div class="alert alert-success text-center">
                        <strong>Success :</strong> <?php echo htmlentities($_SESSION['delmsg']); ?>
                        <?php echo htmlentities($_SESSION['delmsg']=""); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Categories Listing</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Creation Date</th>
                                            <th>Updation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $sql = "SELECT * from tblcategory";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result) { ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->CategoryName); ?></td>
                                            <td><?php echo ($result->Status==1) ? '<span class="badge badge-active">Active</span>' : '<span class="badge badge-inactive">Inactive</span>'; ?></td>
                                            <td><?php echo htmlentities($result->CreationDate); ?></td>
                                            <td><?php echo htmlentities($result->UpdationDate); ?></td>
                                            <td>
                                                <a href="edit-category.php?catid=<?php echo htmlentities($result->id); ?>" class="btn btn-primary btn-custom"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="manage-categories.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-custom"><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php $cnt++; } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
