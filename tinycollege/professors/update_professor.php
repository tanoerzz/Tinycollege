<?php
require '../db_connect.php';

// Fetch professor details
$prof_num = $_GET['num'];
$stmt = $conn->prepare("SELECT * FROM PROFESSOR WHERE PROF_NUM = :prof_num");
$stmt->bindParam(':prof_num', $prof_num);
$stmt->execute();
$prof = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all departments for the dropdown
$stmt_dept = $conn->query("SELECT * FROM DEPARTMENT");
$departments = $stmt_dept->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Professor</h2>

    <form method="post" action="update_professor_process.php">
        <input type="hidden" name="prof_num" value="<?= $prof['PROF_NUM'] ?>" required>
        <input type="text" name="prof_fname" value="<?= $prof['PROF_FNAME'] ?>" required>
        <input type="text" name="prof_lname" value="<?= $prof['PROF_LNAME'] ?>" required>
        <input type="text" name="prof_email" value="<?= $prof['PROF_EMAIL'] ?>" required>
        <select name="dept_code" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['DEPT_CODE'] ?>" <?= $dept['DEPT_CODE'] == $prof['DEPT_CODE'] ? 'selected' : '' ?>>
                    <?= $dept['DEPT_NAME'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Update Professor</button>
    </form>
</body>
</html>
