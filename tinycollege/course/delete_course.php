<?php
require '../db_connect.php';

if (isset($_GET['code'])) {
    $crs_code = $_GET['code'];

    $stmt = $conn->prepare("DELETE FROM COURSE WHERE CRS_CODE = :crs_code");
    $stmt->bindParam(':crs_code', $crs_code);

    if ($stmt->execute()) {
        echo "Course deleted successfully!";
    } else {
        echo "Error deleting course.";
    }
}
?>
