<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 

    if (isset($_POST['issue'])) {
        $studentid = strtoupper($_POST['studentid']);
        $bookid = $_POST['bookid']; 
        $aremark = $_POST['aremark']; 
        $aqty = $_POST['aqty'];

        if ($aqty > 0) {
            $sql = "INSERT INTO tblissuedbookdetails(StudentID, BookId, remark) VALUES(:studentid, :bookid, :aremark)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
            $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
            $query->bindParam(':aremark', $aremark, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                $_SESSION['msg'] = "Book issued successfully";
                header('location:manage-issued-books.php');
            } else {
                $_SESSION['error'] = "Something went wrong. Please try again";
                header('location:manage-issued-books.php');
            }
        } else {
            $_SESSION['error'] = "Book not available";
            header('location:manage-issued-books.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Issue a New Book | SOFTLIB</title>

    <!-- Bootstrap & FontAwesome CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">

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
            background:rgb(55, 91, 129);
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
        .btn-submit {
            background: #007bff;
            color: white;
            font-size: 16px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            transition: all 0.3s ease-in-out;
        }
        .btn-submit:hover {
            background: #0056b3;
            color: white;
            transform: scale(1.05);
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>

    <script>
        // Fetch student name dynamically
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
                error: function () {}
            });
        }


        // Fetch book details dynamically
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
                error: function () {}
            });
        }
    </script>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">Issue a New Book</div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student ID <span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent();" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>ISBN Number or Book Title <span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()" required />
                                </div>

                                <div class="form-group" id="get_book_name"></div>

                                <div class="form-group">
                                    <label>Remark <span style="color:red;">*</span></label>
                                    <textarea class="form-control" name="aremark" id="aremark" required></textarea> 
                                </div>

                                <button type="submit" name="issue" class="btn btn-submit">Issue Book</button>
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
<?php  ?>
