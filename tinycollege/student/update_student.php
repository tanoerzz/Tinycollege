<?php
require '../db_connect.php';

$stu_num = $_GET['num'];

// Fetch the student details
$stmt = $conn->prepare("SELECT * FROM STUDENT WHERE STU_NUM = ?");
$stmt->execute([$stu_num]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all departments and professors for the dropdown
$stmt_dept = $conn->query("SELECT * FROM DEPARTMENT");
$departments = $stmt_dept->fetchAll(PDO::FETCH_ASSOC);

$stmt_prof = $conn->query("SELECT * FROM PROFESSOR");
$professors = $stmt_prof->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stu_fname = $_POST['stu_fname'];
    $stu_lname = $_POST['stu_lname'];
    $stu_email = $_POST['stu_email'];
    $dept_code = $_POST['dept_code'];
    $prof_num = $_POST['prof_num'];

    $stmt_update = $conn->prepare("UPDATE STUDENT SET STU_FNAME = ?, STU_LNAME = ?, STU_EMAIL = ?, DEPT_CODE = ?, PROF_NUM = ? WHERE STU_NUM = ?");
    $stmt_update->execute([$stu_fname, $stu_lname, $stu_email, $dept_code, $prof_num, $stu_num]);

    header('Location: students.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Student</h2>

    <form method="POST">
        <label for="stu_fname">First Name</label>
        <input type="text" name="stu_fname" value="<?= $student['STU_FNAME'] ?>" required>

        <label for="stu_lname">Last Name</label>
        <input type="text" name="stu_lname" value="<?= $student['STU_LNAME'] ?>" required>

        <label for="stu_email">Email</label>
        <input type="email" name="stu_email" value="<?= $student['STU_EMAIL'] ?>" required>

        <label for="dept_code">Department</label>
        <select name="dept_code" required>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['DEPT_CODE'] ?>" <?= ($dept['DEPT_CODE'] == $student['DEPT_CODE']) ? 'selected' : '' ?>><?= $dept['DEPT_NAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="prof_num">Professor</label>
        <select name="prof_num" required>
            <?php foreach ($professors as $prof): ?>
                <option value="<?= $prof['PROF_NUM'] ?>" <?= ($prof['PROF_NUM'] == $student['PROF_NUM']) ? 'selected' : '' ?>><?= $prof['PROF_FNAME'] . ' ' . $prof['PROF_LNAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Student</button>
    </form>

    <br><br>
    <a href="students.php">Back to Students List</a>
</body>
</html>
