<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:index.php');
}
else{ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library | Listed Books</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
        }

        .container {
            padding-top: 20px;
        }

        /* Book Grid */
        .book-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        /* Book Card */
        .book-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Book Image */
        .book-card img {
            width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        /* Book Details */
        .book-details {
            flex-grow: 1;
            text-align: center;
        }

        .book-card h5 {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        .book-card p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .available-books {
            font-size: 15px;
            font-weight: bold;
            color: green;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .book-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<?php include('includes/header.php');?>

<div class="content-wrapper">
    <div class="container">
        <h2 class="text-center" style="color: #007bff; margin-bottom: 20px;">Available Books</h2>
        <div class="book-grid">

            <?php 
            $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.ISBNNumber, tblbooks.BookPrice, 
                           tblbooks.id as bookid, tblbooks.bookImage, tblbooks.isIssued, tblbooks.bookQty,  
                           COUNT(tblissuedbookdetails.id) AS issuedBooks,
                           COUNT(tblissuedbookdetails.RetrunStatus) AS returnedbook
                    FROM tblbooks
                    LEFT JOIN tblissuedbookdetails ON tblissuedbookdetails.BookId = tblbooks.id
                    LEFT JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId
                    LEFT JOIN tblcategory ON tblcategory.id = tblbooks.CatId
                    GROUP BY tblbooks.id";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            if($query->rowCount() > 0) {
                foreach($results as $result) { 
                    $availableQty = ($result->issuedBooks == 0) ? $result->bookQty : ($result->bookQty - ($result->issuedBooks - $result->returnedbook));
            ?>  

            <!-- Book Card -->
            <div class="book-card">
                <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" alt="Book Image">
                <div class="book-details">
                    <h5><?php echo htmlentities($result->BookName); ?></h5>
                    <p><strong>Author:</strong> <?php echo htmlentities($result->AuthorName); ?></p>
                    <p><strong>ISBN:</strong> <?php echo htmlentities($result->ISBNNumber); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlentities($result->CategoryName); ?></p>
                    <p><strong>Total Quantity:</strong> <?php echo htmlentities($result->bookQty); ?></p>
                    <p class="available-books"><strong>Available:</strong> <?php echo htmlentities($availableQty); ?></p>
                </div>
            </div>

            <?php } } ?>

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
