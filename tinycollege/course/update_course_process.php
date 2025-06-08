<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crs_code = $_POST['crs_code'];
    $crs_title = $_POST['crs_title'];
    $crs_description = $_POST['crs_description'];
    $crs_credit = $_POST['crs_credit'];
    $dept_code = $_POST['dept_code'];

    $stmt = $conn->prepare("UPDATE COURSE SET CRS_TITLE = :crs_title, CRS_DESCRIPTION = :crs_description, CRS_CREDIT = :crs_credit, DEPT_CODE = :dept_code WHERE CRS_CODE = :crs_code");
    $stmt->bindParam(':crs_code', $crs_code);
    $stmt->bindParam(':crs_title', $crs_title);
    $stmt->bindParam(':crs_description', $crs_description);
    $stmt->bindParam(':crs_credit', $crs_credit);
    $stmt->bindParam(':dept_code', $dept_code);

    if ($stmt->execute()) {
        echo "Course updated successfully!";
    } else {
        echo "Error updating course.";
    }
}
?>
