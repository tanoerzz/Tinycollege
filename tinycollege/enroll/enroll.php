<?php 
// Adjust path if using subdirectories
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require __DIR__ . '/../db_connect.php';

$stmt = $conn->query("SELECT ENROLL.CLASS_CODE, ENROLL.STU_NUM, ENROLL.ENROLL_DATE, ENROLL.ENROLL_GRADE, CLASS.CLASS_SECTION, STUDENT.STU_LNAME, STUDENT.STU_FNAME FROM ENROLL
                      JOIN CLASS ON ENROLL.CLASS_CODE = CLASS.CLASS_CODE
                      JOIN STUDENT ON ENROLL.STU_NUM = STUDENT.STU_NUM");
$enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_class = $conn->query("SELECT * FROM CLASS");
$classes = $stmt_class->fetchAll(PDO::FETCH_ASSOC);

$stmt_student = $conn->query("SELECT * FROM STUDENT");
$students = $stmt_student->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Management</title>
    <link rel="stylesheet" href="enroll_style.css">
</head>
<body$e>
    <h2>Enrollment Management</h2>

    <form method="POST" action="insert_enroll.php">
        <label for="class_code">Class Code</label>
        <select name="class_code" required>
            <option value="">Select Class</option>
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['CLASS_CODE'] ?>"><?= $class['CLASS_CODE'] ?> - <?= $class['CLASS_SECTION'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="stu_num">Student Number</label>
        <select name="stu_num" required>
            <option value="">Select Student</option>
            <?php foreach ($students as $student): ?>
                <option value="<?= $student['STU_NUM'] ?>"><?= $student['STU_LNAME'] ?>, <?= $student['STU_FNAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="enroll_date">Enrollment Date</label>
        <input type="date" name="enroll_date" required>

        <label for="enroll_grade">Grade</label>
        <input type="text" name="enroll_grade" placeholder="Grade" required>

        <button type="submit">Enroll Student</button>
    </form>

    <table>
        <tr>
            <th>Class Code</th><th>Student</th><th>Enrollment Date</th><th>Grade</th><th>Actions</th>
        </tr>
        <?php foreach ($enrollments as $enroll): ?>
        <tr>
            <td><?= $enroll['CLASS_CODE'] ?></td>
            <td><?= $enroll['STU_LNAME'] ?>, <?= $enroll['STU_FNAME'] ?></td>
            <td><?= $enroll['ENROLL_DATE'] ?></td>
            <td><?= $enroll['ENROLL_GRADE'] ?></td>
            <td>
                <a href="update_enroll.php?class_code=<?= $enroll['CLASS_CODE'] ?>&stu_num=<?= $enroll['STU_NUM'] ?>">Edit</a> |
                <a href="delete_enroll.php?class_code=<?= $enroll['CLASS_CODE'] ?>&stu_num=<?= $enroll['STU_NUM'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body$e>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>