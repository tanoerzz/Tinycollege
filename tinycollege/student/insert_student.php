<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $dept_code = $_POST['dept_code'];

    $stmt = $conn->prepare("INSERT INTO STUDENT (STUDENT_ID, FIRST_NAME, LAST_NAME, EMAIL, DEPT_CODE) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$student_id, $first_name, $last_name, $email, $dept_code]);

    header('Location: students.php');
}

$stmt_dept = $conn->query("SELECT * FROM DEPARTMENT");
$departments = $stmt_dept->fetchAll(PDO::FETCH_ASSOC);
?>
