<?php
require '../db_connect.php';

if (isset($_GET['code'])) {
    $stmt = $conn->prepare("DELETE FROM SEMESTER WHERE SEMESTER_CODE = ?");
    $stmt->execute([$_GET['code']]);
}

header("Location: index.php");
?>
