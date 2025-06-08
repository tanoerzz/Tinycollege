<?php
require '../db_connect.php';

$class_code = $_GET['class_code'];
$stu_num = $_GET['stu_num'];

$stmt = $conn->prepare("DELETE FROM ENROLL WHERE CLASS_CODE = ? AND STU_NUM = ?");
$stmt->execute([$class_code, $stu_num]);

header('Location: enroll_management.php');
?>
