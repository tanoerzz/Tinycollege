<?php
require '../db_connect.php';

$dept_code = $_GET['code'];

$stmt = $conn->prepare("SELECT * FROM DEPARTMENT WHERE DEPT_CODE = ?");
$stmt->execute([$dept_code]);
$department = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_school = $conn->query("SELECT * FROM SCHOOL");
$schools = $stmt_school->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dept_name = $_POST['dept_name'];
    $school_code = $_POST['school_code'];

    $stmt_update = $conn->prepare("UPDATE DEPARTMENT SET DEPT_NAME = ?, SCHOOL_CODE = ? WHERE DEPT_CODE = ?");
    $stmt_update->execute([$dept_name, $school_code, $dept_code]);

    header('Location: departments.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Department</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Department</h2>

    <form method="POST">
        <label for="dept_name">Department Name</label>
        <input type="text" name="dept_name" value="<?= $department['DEPT_NAME'] ?>" required>

        <label for="school_code">School</label>
        <select name="school_code" required>
            <?php foreach ($schools as $school): ?>
                <option value="<?= $school['SCHOOL_CODE'] ?>" <?= ($school['SCHOOL_CODE'] == $department['SCHOOL_CODE']) ? 'selected' : '' ?>><?= $school['SCHOOL_NAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Department</button>
    </form>

    <br><br>
    <a href="departments.php">Back to Departments List</a>
</body>
</html>
