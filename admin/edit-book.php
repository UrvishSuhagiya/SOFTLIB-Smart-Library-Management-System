<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 

if(isset($_POST['update'])) {
    $bookname = $_POST['bookname'];
    $category = $_POST['category'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $price = $_POST['price'];
    $bookid = intval($_GET['bookid']);
    $bqty = $_POST['bqty'];

    $sql = "UPDATE tblbooks SET BookName=:bookname, CatId=:category, AuthorId=:author, BookPrice=:price, bookQty=:bqty WHERE id=:bookid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
    $query->bindParam(':category', $category, PDO::PARAM_STR);
    $query->bindParam(':author', $author, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
    $query->bindParam(':bqty', $bqty, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Book info updated successfully');</script>";
    echo "<script>window.location.href='manage-books.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SOFTLIB Management System | Edit Book</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f8fcff, #e3f2fd);
            margin: 0;
            padding: 0;
        }
        .content-wrapper {
            padding: 30px 20px;
        }
        .header-line {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
        .panel {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            background: #ffffff;
            padding: 20px;
        }
        .panel-heading {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            background-color:rgba(3, 83, 169, 0.82);
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        label{            font-size: 14px;
}
        .form-control {
            border-radius: 6px;
            padding: 7px;
            font-size: 14px;
        }
        .btn-info {
            background-color: #007bff;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            color: white;
        }
        .btn-info:hover {
            background-color: #0056b3;
        }
        img.book-img {
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #fff;
            border-radius: 6px;
            margin-top: 10px;
            max-width: 120px;
        }
        .help-block {
            font-size: 12px;
            color: #777;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row mb-4">
                <div class="text-center">
                    <h4 class="header-line">Edit Book</h4>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="row justify-content-center">
                    <div class="panel">
                        <div class="panel-heading">Book Info</div>
                        <div class="panel-body">
                            <form method="post">
                                <?php 
                                $bookid = intval($_GET['bookid']);
                                $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblcategory.id as cid, tblauthors.AuthorName, tblauthors.id as athrid, tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid, tblbooks.bookImage, bookQty FROM tblbooks 
                                JOIN tblcategory ON tblcategory.id=tblbooks.CatId 
                                JOIN tblauthors ON tblauthors.id=tblbooks.AuthorId 
                                WHERE tblbooks.id=:bookid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                                ?>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label>Book Image</label><br>
                                        <img src="bookimg/<?php echo htmlentities($result->bookImage); ?>" class="book-img"><br>
                                        <a href="change-bookimg.php?bookid=<?php echo htmlentities($result->bookid); ?>">Change Book Image</a>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Book Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label>Category<span style="color:red;">*</span></label>
                                            <select class="form-control" name="category" required>
                                                <option value="<?php echo htmlentities($result->cid); ?>"> <?php echo htmlentities($catname=$result->CategoryName); ?></option>
                                                <?php 
                                                $status=1;
                                                $sql1 = "SELECT * from tblcategory where Status=:status";
                                                $query1 = $dbh->prepare($sql1);
                                                $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                                $query1->execute();
                                                $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                                if($query1->rowCount() > 0) {
                                                    foreach($resultss as $row) {
                                                        if($catname != $row->CategoryName) {
                                                ?>
                                                <option value="<?php echo htmlentities($row->id); ?>"><?php echo htmlentities($row->CategoryName); ?></option>
                                                <?php }}} ?> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Author<span style="color:red;">*</span></label>
                                            <select class="form-control" name="author" required>
                                                <option value="<?php echo htmlentities($result->athrid); ?>"> <?php echo htmlentities($athrname=$result->AuthorName); ?></option>
                                                <?php 
                                                $sql2 = "SELECT * from tblauthors";
                                                $query2 = $dbh->prepare($sql2);
                                                $query2->execute();
                                                $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                if($query2->rowCount() > 0) {
                                                    foreach($result2 as $ret) {
                                                        if($athrname != $ret->AuthorName) {
                                                ?>
                                                <option value="<?php echo htmlentities($ret->id); ?>"><?php echo htmlentities($ret->AuthorName); ?></option>
                                                <?php }}} ?> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>ISBN Number<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber); ?>" readonly />
                                            <p class="help-block">An ISBN is an International Standard Book Number. ISBN must be unique.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Price in INR<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->BookPrice); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label>Book Quantity<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="bqty" value="<?php echo htmlentities($result->bookQty); ?>" required />
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" name="update" class="btn btn-info">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
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
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
