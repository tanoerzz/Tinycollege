<?php 
// Adjust path if using subdirectories
require_once __DIR__ . '/../includes/header.php';  
?>

<?php
require __DIR__ . '/../db_connect.php';

$stmt = $conn->query("SELECT * FROM DEPARTMENT JOIN SCHOOL ON DEPARTMENT.SCHOOL_CODE = SCHOOL.SCHOOL_CODE");
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Departments</title>
    <link rel="stylesheet" href="dept_style.css">
</head>
<body>
    <h2>Department Management</h2>

    <form method="POST">
        <label for="dept_code">Department Code</label>
        <input type="text" name="dept_code" placeholder="Department Code" required>

        <label for="dept_name">Department Name</label>
        <input type="text" name="dept_name" placeholder="Department Name" required>

        <label for="school_code">School</label>
        <select name="school_code" required>
            <option value="">Select School</option>
            <?php foreach ($schools as $school): ?>
                <option value="<?= $school['SCHOOL_CODE'] ?>"><?= $school['SCHOOL_NAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Department</button>
    </form>

    <table border="1">
        <tr>
            <th>Department Code</th><th>Department Name</th><th>School Name</th><th>Actions</th>
        </tr>
        <?php foreach ($departments as $dept): ?>
        <tr>
            <td><?= $dept['DEPT_CODE'] ?></td>
            <td><?= $dept['DEPT_NAME'] ?></td>
            <td><?= $dept['SCHOOL_NAME'] ?></td>
            <td>
                <a href="update_department.php?code=<?= $dept['DEPT_CODE'] ?>">Edit</a> |
                <a href="delete_department.php?code=<?= $dept['DEPT_CODE'] ?>" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>