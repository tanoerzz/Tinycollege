<?php 
// Adjust path if using subdirectories
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require_once __DIR__ . '/../db_connect.php';

// Fetch all professors and their associated department names
$stmt = $conn->query("SELECT PROFESSOR.PROF_NUM, PROFESSOR.PROF_FNAME, PROFESSOR.PROF_LNAME,PROFESSOR.PROF_EMAIL , DEPARTMENT.DEPT_NAME FROM PROFESSOR JOIN DEPARTMENT ON PROFESSOR.DEPT_CODE = DEPARTMENT.DEPT_CODE");
$professors = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_dept = $conn->query("SELECT * FROM DEPARTMENT");
$departments = $stmt_dept->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Professors</title>
    <link rel="stylesheet" href="prof_style.css">
</head>
<body>
    <h2>Professor Management</h2>

    <form method="post" action="insert_professor.php">
        <input type="text" name="prof_num" placeholder="Professor Number" required>
        <input type="text" name="prof_fname" placeholder="First Name" required>
        <input type="text" name="prof_lname" placeholder="Last Name" required>
        <input type="text" name="prof_email" placeholder="Email" required>
        <select name="dept_code" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['DEPT_CODE'] ?>"><?= $dept['DEPT_NAME'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add Professor</button>
    </form>

    <table>
        <tr>
            <th>Professor Number</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Department</th><th>Actions</th>
        </tr>
        <?php foreach ($professors as $prof): ?>
        <tr>
            <td><?= $prof['PROF_NUM'] ?></td>
            <td><?= $prof['PROF_FNAME'] ?></td>
            <td><?= $prof['PROF_LNAME'] ?></td>
            <td><?= $prof['PROF_EMAIL'] ?></td>
            <td><?= $prof['DEPT_NAME'] ?></td>
            <td>
                <a href="update_professor.php?num=<?= $prof['PROF_NUM'] ?>">Edit</a> |
                <a href="delete_professor.php?num=<?= $prof['PROF_NUM'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php require_once __DIR__ . '/includes/footer.php'; ?>