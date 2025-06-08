<?php
require '../db_connect.php';

$school_code = $_GET['code'];

$stmt = $conn->prepare("SELECT * FROM SCHOOL WHERE SCHOOL_CODE = ?");
$stmt->execute([$school_code]);
$school = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_name = $_POST['school_name'];

    $stmt_update = $conn->prepare("UPDATE SCHOOL SET SCHOOL_NAME = ? WHERE SCHOOL_CODE = ?");
    $stmt_update->execute([$school_name, $school_code]);

    header('Location: schools.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit School</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit School</h2>

    <form method="POST">
        <label for="school_name">School Name</label>
        <input type="text" name="school_name" value="<?= $school['SCHOOL_NAME'] ?>" required>
        <button type="submit">Update School</button>
    </form>
    <br><br>
    <a href="schools.php">Back to Schools List</a>
</body>
</html>
