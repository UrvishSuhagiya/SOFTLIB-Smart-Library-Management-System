<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0) {
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Issued Books | SOFTLIB Management System</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #f8f9fa, #d7e8f6);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex-grow: 1;
            padding-bottom: 80px;
        }

        .book-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .book-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 300px;
            text-decoration: none;
            color: inherit;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .book-card img {
            width: 120px;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .book-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .book-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .return-status {
            font-size: 14px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .not-returned {
            background: #ff4d4d;
            color: white;
        }

        .returned {
            background: #28a745;
            color: white;
        }

    </style>
</head>
<body>
<?php include('includes/header.php');?>
<div class="content-wrapper">
    <div class="container">
        <h2 class="text-center" style="color: #007bff; margin-bottom: 20px;"> Issued Books</h2>
        <div class="book-container">
            <?php 
            $sid = $_SESSION['stdid'];
            $sql = "SELECT tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.fine, tblbooks.bookImage FROM tblissuedbookdetails JOIN tblstudents ON tblstudents.StudentId=tblissuedbookdetails.StudentId JOIN tblbooks ON tblbooks.id=tblissuedbookdetails.BookId WHERE tblstudents.StudentId=:sid ORDER BY tblissuedbookdetails.id DESC";
            $query = $dbh->prepare($sql);
            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                    <div class="book-card">
                        <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" alt="Book Image">
                        <p class="book-title"> <?php echo htmlentities($result->BookName); ?> </p>
                        <hr>
                        <p class="book-info">ISBN : <?php echo htmlentities($result->ISBNNumber); ?></p>
                        <p class="book-info">Issued : <?php echo htmlentities($result->IssuesDate); ?></p>
                        <p class="book-info">Return : 
                            <?php if ($result->ReturnDate == "") { ?>
                                <span class="return-status not-returned">Not Returned Yet</span>
                            <?php } else { ?>
                                <?php echo htmlentities($result->ReturnDate); ?> </br><span class="return-status returned">Returned</span> 
                            <?php } ?>
                        </p>
                        <p class="book-info">Fine : <?php echo htmlentities($result->fine); ?> ₹</p>
                    </div>
                <?php } 
            } ?>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
