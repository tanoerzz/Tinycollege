<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_code = $_POST['class_code'];
    $class_section = $_POST['class_section'];
    $class_time = $_POST['class_time'];
    $crs_code = $_POST['crs_code'];
    $prof_num = $_POST['prof_num'];
    $room_code = $_POST['room_code'];
    $semester_code = $_POST['semester_code'];

    $stmt = $conn->prepare("UPDATE CLASS SET CLASS_SECTION = ?, CLASS_TIME = ?, CRS_CODE = ?, PROF_NUM = ?, ROOM_CODE = ?, SEMESTER_CODE = ? 
                           WHERE CLASS_CODE = ?");
    $stmt->execute([$class_section, $class_time, $crs_code, $prof_num, $room_code, $semester_code, $class_code]);

    header('Location: class_management.php');
}

$class_code = $_GET['class_code'];

$stmt = $conn->prepare("SELECT * FROM CLASS WHERE CLASS_CODE = ?");
$stmt->execute([$class_code]);
$class = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_course = $conn->query("SELECT * FROM COURSE");
$courses = $stmt_course->fetchAll(PDO::FETCH_ASSOC);

$stmt_professor = $conn->query("SELECT * FROM PROFESSOR");
$professors = $stmt_professor->fetchAll(PDO::FETCH_ASSOC);

$stmt_room = $conn->query("SELECT * FROM ROOM");
$rooms = $stmt_room->fetchAll(PDO::FETCH_ASSOC);

$stmt_semester = $conn->query("SELECT * FROM SEMESTER");
$semesters = $stmt_semester->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Class</title>
</head>
<body>
    <h2>Edit Class</h2>

    <form method="post">
        <input type="hidden" name="class_code" value="<?= $class['CLASS_CODE'] ?>">

        <label for="class_section">Class Section</label>
        <input type="text" name="class_section" value="<?= $class['CLASS_SECTION'] ?>" required>

        <label for="class_time">Class Time</label>
        <input type="text" name="class_time" value="<?= $class['CLASS_TIME'] ?>" required>

        <label for="crs_code">Course Code</label>
        <select name="crs_code" required>
            <option value="<?= $class['CRS_CODE'] ?>" selected><?= $class['CRS_CODE'] ?></option>
            <?php foreach ($courses as $course): ?>
                <option value="<?= $course['CRS_CODE'] ?>"><?= $course['CRS_CODE'] ?> - <?= $course['CRS_TITLE'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="prof_num">Professor</label>
        <select name="prof_num" required>
            <option value="<?= $class['PROF_NUM'] ?>" selected><?= $class['PROF_NUM'] ?> - <?= $class['PROF_FNAME'] ?> <?= $class['PROF_LNAME'] ?></option>
            <?php foreach ($professors as $professor): ?>
                <option value="<?= $professor['PROF_NUM'] ?>"><?= $professor['PROF_FNAME'] ?> <?= $professor['PROF_LNAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="room_code">Room</label>
        <select name="room_code" required>
