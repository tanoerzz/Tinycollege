<?php
require '../db_connect.php';

$crs_code = $_GET['code'];
$stmt = $conn->prepare("SELECT * FROM COURSE WHERE CRS_CODE = :crs_code");
$stmt->bindParam(':crs_code', $crs_code);
$stmt->execute();
$course = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_dept = $conn->query("SELECT * FROM DEPARTMENT");
$departments = $stmt_dept->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Course</h2>

    <form method="post" action="update_course_process.php">
        <input type="hidden" name="crs_code" value="<?= $course['CRS_CODE'] ?>" required>
        <input type="text" name="crs_title" value="<?= $course['CRS_TITLE'] ?>" required>
        <textarea name="crs_description" required><?= $course['CRS_DESCRIPTION'] ?></textarea>
        <input type="number" name="crs_credit" value="<?= $course['CRS_CREDIT'] ?>" required>
        <select name="dept_code" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['DEPT_CODE'] ?>" <?= $dept['DEPT_CODE'] == $course['DEPT_CODE'] ? 'selected' : '' ?>>
                    <?= $dept['DEPT_NAME'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Update Course</button>
    </form>
</body>
</html>
