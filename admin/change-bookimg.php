<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
    exit;
}

if (isset($_POST['update'])) {
    $bookid = intval($_GET['bookid']);
    $bookimg = $_FILES["bookpic"]["name"];
    $cimage = $_POST['curremtimage'];
    $cpath = "bookimg/" . $cimage;

    $extension = substr($bookimg, strlen($bookimg) - 4, strlen($bookimg));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    $imgnewname = md5($bookimg . time()) . $extension;

    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        move_uploaded_file($_FILES["bookpic"]["tmp_name"], "bookimg/" . $imgnewname);
        $sql = "UPDATE tblbooks SET bookImage=:imgnewname WHERE id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':imgnewname', $imgnewname, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        unlink($cpath);

        $_SESSION['msg'] = "Book image updated successfully.";
        header('location: manage-books.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SOFTLIB Management System | Edit Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>
        .form-container {
            background: #f7f7f7;
            padding: 25px;
            border-radius: 10px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
        }

        .book-img-preview {
            width: 100px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-info {
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: bold;
        }

        h4.header-line {
            font-weight: 700;
            font-size: 24px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 25px;
            color: #007bff;
        }

        .panel-info > .panel-heading {
            background-color: #007bff !important;
            color: #fff !important;
            font-weight: bold;
        }

        input[type="file"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 6px;
        }

        .btn-info:hover {
            background-color: #0056b3;
        }
        .header-line {
            text-align: center;
            font-weight: 700;
            font-size: 24px;
            padding-bottom: 10px;
            margin-bottom: 25px;
            color: #007bff;
        }

        .panel-heading {
            text-align: center !important;
            background-color: #007bff !important;
            color: #fff !important;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Edit Book Image</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">Book Info</div>
                        <div class="panel-body">
                            <div class="form-container">
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <?php 
                                    $bookid = intval($_GET['bookid']);
                                    $sql = "SELECT tblbooks.BookName, tblbooks.id as bookid, tblbooks.bookImage FROM tblbooks WHERE tblbooks.id = :bookid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>  
                                            <input type="hidden" name="curremtimage" value="<?php echo htmlentities($result->bookImage); ?>">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Current Book Image</label><br>
                                                    <img class="book-img-preview" src="bookimg/<?php echo htmlentities($result->bookImage); ?>" alt="Book Image">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Book Name<span style="color:red;">*</span></label>
                                                    <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName); ?>" readonly />
                                                </div>
                                            </div>

                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label>Upload New Book Picture<span style="color:red;">*</span></label>
                                                    <input class="form-control" type="file" name="bookpic" autocomplete="off" required />
                                                </div>
                                            </div>
                                    <?php }} ?>
                                    <div class="col-md-12">
                                        <button type="submit" name="update" class="btn btn-info">Update</button>
                                    </div>
                                </form>
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
    <script src="assets/js/custom.js"></script>
</body>
</html>
