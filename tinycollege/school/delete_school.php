<?php
require '../db_connect.php';

$school_code = $_GET['code'];

$stmt = $conn->prepare("DELETE FROM SCHOOL WHERE SCHOOL_CODE = ?");
$stmt->execute([$school_code]);

header('Location: schools.php');
?>
