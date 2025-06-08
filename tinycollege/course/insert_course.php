<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crs_code = $_POST['crs_code'];
    $crs_title = $_POST['crs_title'];
    $crs_description = $_POST['crs_description'];
    $crs_credit = $_POST['crs_credit'];
    $dept_code = $_POST['dept_code'];

    $stmt = $conn->prepare("INSERT INTO COURSE (CRS_CODE, CRS_TITLE, CRS_DESCRIPTION, CRS_CREDIT, DEPT_CODE) VALUES (:crs_code, :crs_title, :crs_description, :crs_credit, :dept_code)");
    $stmt->bindParam(':crs_code', $crs_code);
    $stmt->bindParam(':crs_title', $crs_title);
    $stmt->bindParam(':crs_description', $crs_description);
    $stmt->bindParam(':crs_credit', $crs_credit);
    $stmt->bindParam(':dept_code', $dept_code);

    if ($stmt->execute()) {
        echo "Course added successfully!";
    } else {
        echo "Error adding course.";
    }
}
?>
