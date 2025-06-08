<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['semester_code'];
    $year = $_POST['semester_year'];
    $term = $_POST['semester_term'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    $stmt = $conn->prepare("INSERT INTO SEMESTER (SEMESTER_CODE, SEMESTER_YEAR, SEMESTER_TERM, SEMESTER_START_DATE, SEMESTER_END_DATE) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$code, $year, $term, $start, $end]);

    header("Location: index.php");
}
?>
