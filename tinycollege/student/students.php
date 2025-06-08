<?php 
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require_once __DIR__ . '/../db_connect.php';

$stmt = $conn->query("SELECT STUDENT.*, DEPARTMENT.DEPT_NAME, PROFESSOR.PROF_FNAME, PROFESSOR.PROF_LNAME
                     FROM STUDENT
                     JOIN DEPARTMENT ON STUDENT.DEPT_CODE = DEPARTMENT.DEPT_CODE
                     JOIN PROFESSOR ON STUDENT.PROF_NUM = PROFESSOR.PROF_NUM");

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <link rel="stylesheet" href="stud_style.css">
</head>
<body>
    <h2>Student Management</h2>

     <form method="POST">
        <label for="student_id">Student ID</label>
        <input type="text" name="student_id" placeholder="Student ID" required>

        <label for="first_name">First Name</label>
        <input type="text" name="first_name" placeholder="First Name" required>

        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" placeholder="Last Name" required>

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" required>

        <label for="dept_code">Department</label>
        <select name="dept_code" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['DEPT_CODE'] ?>"><?= $dept['DEPT_NAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Student</button>
    </form>
<br><br>

    <table border="1">
        <tr>
            <th>Student Number</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Department</th><th>Professor</th><th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['STU_NUM'] ?></td>
            <td><?= $student['STU_FNAME'] ?></td>
            <td><?= $student['STU_LNAME'] ?></td>
            <td><?= $student['STU_EMAIL'] ?></td>
            <td><?= $student['DEPT_NAME'] ?></td>
            <td><?= $student['PROF_FNAME'] . ' ' . $student['PROF_LNAME'] ?></td>
            <td>
                <a href="update_student.php?num=<?= $student['STU_NUM'] ?>">Edit</a> |
                <a href="delete_student.php?num=<?= $student['STU_NUM'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>