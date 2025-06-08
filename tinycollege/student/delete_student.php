<?php
require '../db_connect.php';

$stu_num = $_GET['num'];

$stmt = $conn->prepare("DELETE FROM STUDENT WHERE STU_NUM = ?");
$stmt->execute([$stu_num]);

header('Location: students.php');
?>
