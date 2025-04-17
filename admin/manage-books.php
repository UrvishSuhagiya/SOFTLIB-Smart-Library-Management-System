<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
} else { 
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tblbooks WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Book deleted successfully!";
        header('location:manage-books.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Books | SOFTLIB Management System</title>

    <!-- Bootstrap & FontAwesome CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">

    <!-- Custom Styling -->
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
        .books-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .book-card {
            width: 320px;
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .book-card:hover {
            transform: scale(1.03);
        }
        .book-image {
            width: 100%;
            height: 250px; /* Adjusted to show full image */
            object-fit: contain; /* Ensures the full image is visible */
            border-radius: 8px;
            background-color: #f5f5f5;
        }
        .book-info {
            padding: 10px 0;
        }
        .book-info h5 {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }
        .book-details {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .btn-custom {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin-top: 5px;
        }
        .btn-edit {
            background: #578FCA; /* Light Blue */
            color: white;
            border: none;
        }
        .btn-edit:hover {
            background: #3674B5;
            transform: scale(1.05);
        }
        .btn-delete {
            background: rgb(250, 103, 103); /* Soft Red */
            color: white;
            border: none;
        }
        .btn-delete:hover {
            background:rgb(253, 49, 49);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <h2 class="text-center" style="font-weight: bold; color: #007bff; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                Manage Books
            </h2>

            <!-- Alerts -->
            <?php if ($_SESSION['delmsg'] != "") { ?>
                <div class="alert alert-success text-center">
                    <strong>Success:</strong> <?php echo htmlentities($_SESSION['delmsg']); ?>
                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                </div>
            <?php } ?>

            <div class="books-container">
                <?php 
                $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, 
                        tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid, tblbooks.bookImage 
                        FROM tblbooks 
                        JOIN tblcategory ON tblcategory.id = tblbooks.CatId 
                        JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>                                      
                        <div class="book-card">
                            <img src="bookimg/<?php echo htmlentities($result->bookImage); ?>" class="book-image">
                            <div class="book-info">
                                <h5><?php echo htmlentities($result->BookName); ?></h5>
                                <div class="book-details">
                                    <strong>Category:</strong> <?php echo htmlentities($result->CategoryName); ?><br>
                                    <strong>Author:</strong> <?php echo htmlentities($result->AuthorName); ?><br>
                                    <strong>ISBN:</strong> <?php echo htmlentities($result->ISBNNumber); ?><br>
                                    <strong>Price:</strong> ₹<?php echo htmlentities($result->BookPrice); ?>
                                </div>
                                <a href="edit-book.php?bookid=<?php echo htmlentities($result->bookid); ?>" class="btn btn-edit btn-custom">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="manage-books.php?del=<?php echo htmlentities($result->bookid); ?>" 
                                   onclick="return confirm('Are you sure you want to delete?');" 
                                   class="btn btn-delete btn-custom">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    <?php } 
                } else { ?>
                    <h4 class="text-center text-muted">No Books Available</h4>
                <?php } ?>                                     
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php  ?>
