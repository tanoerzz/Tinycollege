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

    $stmt = $conn->prepare("INSERT INTO CLASS (CLASS_CODE, CLASS_SECTION, CLASS_TIME, CRS_CODE, PROF_NUM, ROOM_CODE, SEMESTER_CODE) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$class_code, $class_section, $class_time, $crs_code, $prof_num, $room_code, $semester_code]);

    header('Location: class_management.php'); 
}
?>
