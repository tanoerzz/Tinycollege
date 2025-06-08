<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_code = $_POST['class_code'];
    $stu_num = $_POST['stu_num'];
    $enroll_date = $_POST['enroll_date'];
    $enroll_grade = $_POST['enroll_grade'];

    $stmt = $conn->prepare("UPDATE ENROLL SET ENROLL_DATE = ?, ENROLL_GRADE = ? WHERE CLASS_CODE = ? AND STU_NUM = ?");
    $stmt->execute([$enroll_date, $enroll_grade, $class_code, $stu_num]);

    header('Location: enroll_management.php');
}

$class_code = $_GET['class_code'];
$stu_num = $_GET['stu_num'];

$stmt = $conn->prepare("SELECT * FROM ENROLL WHERE CLASS_CODE = ? AND STU_NUM = ?");
$stmt->execute([$class_code, $stu_num]);
$enroll = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_class = $conn->query("SELECT * FROM CLASS");
$classes = $stmt_class->fetchAll(PDO::FETCH_ASSOC);

$stmt_student = $conn->query("SELECT * FROM STUDENT");
$students = $stmt_student->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Enrollment</title>
</head>
<body>
    <h2>Edit Enrollment</h2>

    <form method="post">
        <label for="class_code">Class Code</label>
        <select name="class_code" required>
            <option value="<?= $enroll['CLASS_CODE'] ?>" selected><?= $enroll['CLASS_CODE'] ?></option>
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['CLASS_CODE'] ?>"><?= $class['CLASS_CODE'] ?> - <?= $class['CLASS_SECTION'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="stu_num">Student Number</label>
        <select name="stu_num" required>
            <option value="<?= $enroll['STU_NUM'] ?>" selected><?= $enroll['STU_NUM'] ?> - <?= $enroll['STU_LNAME'] ?>, <?= $enroll['STU_FNAME'] ?></option>
            <?php foreach ($students as $student): ?>
                <option value="<?= $student['STU_NUM'] ?>"><?= $student['STU_LNAME'] ?>, <?= $student['STU_FNAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="enroll_date">Enrollment Date</label>
        <input type="date" name="enroll_date" value="<?= $enroll['ENROLL_DATE'] ?>" required>

        <label for="enroll_grade">Grade</label>
        <input type="text" name="enroll_grade" value="<?= $enroll['ENROLL_GRADE'] ?>" required>

        <button type="submit">Update Enrollment</button>
    </form>
</body>
</html>
