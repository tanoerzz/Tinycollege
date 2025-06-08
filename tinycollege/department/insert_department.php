<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dept_code = $_POST['dept_code'];
    $dept_name = $_POST['dept_name'];
    $school_code = $_POST['school_code'];

    $stmt = $conn->prepare("INSERT INTO DEPARTMENT (DEPT_CODE, DEPT_NAME, SCHOOL_CODE) VALUES (?, ?, ?)");
    $stmt->execute([$dept_code, $dept_name, $school_code]);

    header('Location: departments.php');
}

$stmt_school = $conn->query("SELECT * FROM SCHOOL");
$schools = $stmt_school->fetchAll(PDO::FETCH_ASSOC);
?>

