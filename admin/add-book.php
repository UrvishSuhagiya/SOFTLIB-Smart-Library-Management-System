<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 

    if (isset($_POST['add'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $bqty = $_POST['bqty'];
        $bookimg = $_FILES["bookpic"]["name"];

        $extension = substr($bookimg, strlen($bookimg) - 4, strlen($bookimg));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

        $imgnewname = md5($bookimg . time()) . $extension;

        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif allowed');</script>";
        } else {
            move_uploaded_file($_FILES["bookpic"]["tmp_name"], "bookimg/" . $imgnewname);
            
            $sql = "INSERT INTO tblbooks(BookName, CatId, AuthorId, ISBNNumber, BookPrice, bookImage, bookQty) 
                    VALUES(:bookname, :category, :author, :isbn, :price, :imgnewname, :bqty)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
            $query->bindParam(':category', $category, PDO::PARAM_STR);
            $query->bindParam(':author', $author, PDO::PARAM_STR);
            $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $query->bindParam(':price', $price, PDO::PARAM_STR);
            $query->bindParam(':imgnewname', $imgnewname, PDO::PARAM_STR);
            $query->bindParam(':bqty', $bqty, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                echo "<script>alert('Book Listed successfully');</script>";
                echo "<script>window.location.href='manage-books.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again');</script>";    
                echo "<script>window.location.href='manage-books.php'</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>SOFTLIB Management System | Add Book</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f8fcff, #e3f2fd);
            margin: 0;
            padding: 0;
        }
        .content-wrapper {
            padding: 30px;
        }
        .panel {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            padding: 20px;
        }
        .panel-heading {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            background: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 6px;
            border: 1px solid rgb(49, 47, 47);
            transition: all 0.3s ease-in-out;
            font-size: 14px;
            padding: 5px;
        }
        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
        }
        .btn-custom {
            background: #007bff;
            color: white;
            font-size: 16px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background: #0056b3;
            color: white;
            font-size: 18px;
            transform: scale(1.05);
        }
        .help-block {
            font-size: 12px;
            color: gray;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h2 class="header-line text-center" style="font-weight: bold; color: #007bff; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                        Add New Book
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">Book Information</div>
                        <div class="panel-body">
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Book Name<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="bookname" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label>ISBN Number<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="isbn" required />
                                        <p class="help-block">ISBN must be unique.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Category<span style="color:red;">*</span></label>
                                        <select class="form-control" name="category" required>
                                            <option value="">Select Category</option>
                                            <?php 
                                            $status = 1;
                                            $sql = "SELECT * from tblcategory where Status=:status";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':status', $status, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($results as $result) { ?>  
                                                <option value="<?php echo htmlentities($result->id); ?>">
                                                    <?php echo htmlentities($result->CategoryName); ?>
                                                </option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Author<span style="color:red;">*</span></label>
                                        <select class="form-control" name="author" required>
                                            <option value="">Select Author</option>
                                            <?php 
                                            $sql = "SELECT * from tblauthors";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($results as $result) { ?>  
                                                <option value="<?php echo htmlentities($result->id); ?>">
                                                    <?php echo htmlentities($result->AuthorName); ?>
                                                </option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Price<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="price" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Book Quantity<span style="color:red;">*</span></label>
                                        <input class="form-control" type="number" name="bqty" required />
                                    </div>
                                    <div class="col-md-12">
                                        <label>Book Picture<span style="color:red;">*</span></label>
                                        <input class="form-control" type="file" name="bookpic" required />
                                    </div>
                                </div>
                                <br>
                                <button type="submit" name="add" class="btn btn-custom">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
<?php } ?>
