<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_code = $_POST['class_code'];
    $stu_num = $_POST['stu_num'];
    $enroll_date = $_POST['enroll_date'];
    $enroll_grade = $_POST['enroll_grade'];

    $stmt = $conn->prepare("INSERT INTO ENROLL (CLASS_CODE, STU_NUM, ENROLL_DATE, ENROLL_GRADE) VALUES (?, ?, ?, ?)");
    $stmt->execute([$class_code, $stu_num, $enroll_date, $enroll_grade]);

    header('Location: enroll_management.php');
}
?>
