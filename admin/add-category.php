<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {  
    header('location:index.php');
} else { 

    // Check if the form is submitted
    if (isset($_POST['create'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];

        $sql = "INSERT INTO tblcategory(CategoryName, Status) VALUES(:category, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        
        if ($lastInsertId) {
            $_SESSION['msg'] = "Category Listed successfully";
            header('location:manage-categories.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-categories.php');
        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SOFTLIB Management System | Add Category</title>

    <!-- Bootstrap & FontAwesome CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            background: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid rgb(49, 47, 47);
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }
        .btn-info {
            background: #007bff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-info:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        .header-line {
            text-align: center;
            font-weight: bold;
            color: #007bff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h2 class="header-line">Add New Category</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Category Info</div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input class="form-control" type="text" name="category" required />
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" value="1" checked> Active
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" value="0"> Inactive
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" name="create" class="btn btn-info btn-block">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- JavaScript Files -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
