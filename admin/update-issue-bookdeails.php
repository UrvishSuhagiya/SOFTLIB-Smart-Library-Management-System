<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1;
        $bookid = $_POST['bookid'];
        $sql = "UPDATE tblissuedbookdetails SET fine=:fine, RetrunStatus=:rstatus WHERE id=:rid;
                UPDATE tblbooks SET isIssued=0 WHERE id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Book Returned successfully";
        header('location:manage-issued-books.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SOFTLIB Management System | Issued Book Details</title>

    <!-- BOOTSTRAP CORE STYLE -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script>
    // get student name
    function getstudent() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "get_student.php",
            data: 'studentid=' + $("#studentid").val(),
            type: "POST",
            success: function(data) {
                $("#get_student_name").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }

    // get book details
    function getbook() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "get_book.php",
            data: 'bookid=' + $("#bookid").val(),
            type: "POST",
            success: function(data) {
                $("#get_book_name").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>

    <style type="text/css">
        /* Header Title */
    .header-line {
        text-align: center;
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 40px;
        color: #007bff;
        border-bottom: none;
    }

    /* Panel Styling */
    .panel-heading {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        background-color: rgba(3, 83, 169, 0.82) !important;
        color: white !important;
        padding: 15px 10px;
        border-radius: 5px 5px 0 0;
        margin-bottom: 20px;
    }

    /* Form Group Styling */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 6px;
    }

    /* Input Field Styling */
    .form-control {
        border-radius: 6px;
        padding: 10px;
        font-size: 15px;
        border: 1px solid #ccc;
        box-shadow: none;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    /* Button Styling */
    .btn-info {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 6px;
        transition: 0.3s ease-in-out;
    }

    .btn-info:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Image Display */
    .form-group img {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 4px;
        background-color: #f9f9f9;
    }

    /* Section titles */
    h4 {
        font-size: 20px;
        font-weight: 600;
        color: #444;
        margin-top: 30px;
    }

    </style>
</head>

<body>
    <!-- MENU SECTION START -->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END -->

    <div class="content-wrapper">   
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Issued Book Details</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                    <div class="panel panel-info">
                        <div class="panel-heading">Issued Book Details</div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php 
                                $rid = intval($_GET['rid']);
                                $sql = "SELECT tblstudents.StudentId, tblstudents.FullName, tblstudents.EmailId, tblstudents.MobileNumber,
                                        tblstudents.EnrollmentNo, 
                                        tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate,
                                        tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.fine,
                                        tblissuedbookdetails.RetrunStatus, tblbooks.id as bid, tblbooks.bookImage
                                        FROM tblissuedbookdetails 
                                        JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
                                        JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
                                        WHERE tblissuedbookdetails.id = :rid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?> 
                                        <input type="hidden" name="bookid" value="<?php echo htmlentities($result->bid); ?>">
                                        <h4>Student Details</h4>
                                        <hr />

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student ID :</label>
                                                <?php echo htmlentities($result->StudentId); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student Name :</label>
                                                <?php echo htmlentities($result->FullName); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Enrollment No :</label>
                                                    <?php echo htmlentities($result->EnrollmentNo); ?>
                                                </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student Email Id :</label>
                                                <?php echo htmlentities($result->EmailId); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student Contact No :</label>
                                                <?php echo htmlentities($result->MobileNumber); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><br/></label>
                                                    <label><br/></label>
                                                </div>
                                        </div>
                                        
                                        <h4>Book Details</h4>
                                        <hr />

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Book Image :</label>
                                                <img src="bookimg/<?php echo htmlentities($result->bookImage); ?>" width="120">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Book Name :</label>
                                                <?php echo htmlentities($result->BookName); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ISBN :</label>
                                                <?php echo htmlentities($result->ISBNNumber); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Book Issued Date :</label>
                                                <?php echo htmlentities($result->IssuesDate); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Book Returned Date :</label>
                                                <?php echo $result->ReturnDate ? htmlentities($result->ReturnDate) : 'Not Return Yet'; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Fine ₹ :</label>
                                                <?php if ($result->fine == "") { ?>
                                                    <input class="form-control" type="text" name="fine" id="fine" required />
                                                <?php } else {
                                                    echo htmlentities($result->fine);
                                                } ?>
                                            </div>
                                        </div>

                                        <?php if ($result->RetrunStatus == 0) { ?>
                                            <div class="col-md-12">
                                                <button type="submit" name="return" id="submit" class="btn btn-info">Return Book</button>
                                            </div>
                                        <?php }
                                    }
                                } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER SECTION -->
    <?php include('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
