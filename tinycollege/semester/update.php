<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
    $stmt = $conn->prepare("SELECT * FROM SEMESTER WHERE SEMESTER_CODE = ?");
    $stmt->execute([$_GET['code']]);
    $semester = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['semester_code'];
    $year = $_POST['semester_year'];
    $term = $_POST['semester_term'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    $stmt = $conn->prepare("UPDATE SEMESTER SET SEMESTER_YEAR = ?, SEMESTER_TERM = ?, SEMESTER_START_DATE = ?, SEMESTER_END_DATE = ? WHERE SEMESTER_CODE = ?");
    $stmt->execute([$year, $term, $start, $end, $code]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Semester</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Semester</h2>
    <form method="post">
        <input type="text" name="semester_code" value="<?= $semester['SEMESTER_CODE'] ?>" readonly>
        <input type="number" name="semester_year" value="<?= $semester['SEMESTER_YEAR'] ?>" required>
        <input type="text" name="semester_term" value="<?= $semester['SEMESTER_TERM'] ?>" required>
        <input type="date" name="start_date" value="<?= $semester['SEMESTER_START_DATE'] ?>" required>
        <input type="date" name="end_date" value="<?= $semester['SEMESTER_END_DATE'] ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
