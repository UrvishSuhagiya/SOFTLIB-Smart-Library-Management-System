<?php 
require_once("includes/config.php");

if (!empty($_POST["studentid"])) {
    $studentid = strtoupper($_POST["studentid"]);

    $sql = "SELECT FullName, EnrollmentNo, EmailId, MobileNumber, Status FROM tblstudents WHERE StudentId = :studentid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        if ($result->Status == 0) {
            echo "<span style='color:red'>Student ID Blocked</span><br />";
            echo "<b>Student Name:</b> " . htmlentities($result->FullName);
            echo "<script>$('#submit').prop('disabled', true);</script>";
        } else {
            echo "<b>Student Name:</b> " . htmlentities($result->FullName) . "<br />";
            echo "<b>Enrollment No:</b> " . htmlentities($result->EnrollmentNo) . "<br />";
            echo "<b>Mail Id:</b> " . htmlentities($result->EmailId) . "<br />";
            echo "<b>Mobile No:</b> " . htmlentities($result->MobileNumber);
            echo "<script>$('#submit').prop('disabled', false);</script>";
        }
    } else {
        echo "<span style='color:red'>Invalid Student ID. Please enter a valid one.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    }
}
?>
