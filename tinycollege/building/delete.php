<?php
require '../db_connect.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $stmt = $conn->prepare("DELETE FROM BUILDING WHERE BLDG_CODE = ?");
    $stmt->execute([$code]);
}

header("Location: index.php");
?>
