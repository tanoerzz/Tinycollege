<?php
require '../db_connect.php';

$dept_code = $_GET['code'];

$stmt = $conn->prepare("DELETE FROM DEPARTMENT WHERE DEPT_CODE = ?");
$stmt->execute([$dept_code]);

header('Location: departments.php');
?>
