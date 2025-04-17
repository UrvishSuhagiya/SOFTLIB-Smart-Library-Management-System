<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    if(isset($_POST['update'])) {
        $athrid = intval($_GET['athrid']);
        $author = $_POST['author'];

        $sql = "UPDATE tblauthors SET AuthorName=:author WHERE id=:athrid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':athrid', $athrid, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['updatemsg'] = "Author info updated successfully";
        header('location:manage-authors.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Author | SOFTLIB</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        .panel {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }
        .panel-heading {
            font-size: 22px;
            font-weight: bold;
            background: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            letter-spacing: 1px;
        }
        .form-control {
            border: 2px solid #007bff;
            border-radius: 5px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #ccc;
        }

        .btn-custom-update {
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-custom-update:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        input[type="text"]:focus {
            outline: none;
            box-shadow: none;
            border-color: #ccc !important;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12 text-center">
                <h2 class="header-line" style="font-weight: bold; color: #007bff;">Edit Author</h2>
            </div>
        </div>
        <div class="row">
            <?php 
            $athrid = intval($_GET['athrid']);
            $sql = "SELECT * FROM tblauthors WHERE id=:athrid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':athrid', $athrid, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            ?>
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Author Info</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Author Name</label>
                                <input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->AuthorName); ?>" required />
                            </div>

                            <button type="submit" name="update" class="btn btn-success btn-custom-update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
