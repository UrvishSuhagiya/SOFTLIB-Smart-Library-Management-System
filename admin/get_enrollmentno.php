<?php 
require_once("includes/config.php");

if (!empty($_POST["studentid"])) {
    $studentid = strtoupper($_POST["studentid"]);

    $sql = "SELECT EnrollmentNo FROM tblstudents WHERE StudentId = :studentid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        echo "<b>Enrollment No:</b> " . htmlentities($result->EnrollmentNo);
    } else {
        echo "<span style='color:red;'>No Enrollment Number found</span>";
    }
}
?>
