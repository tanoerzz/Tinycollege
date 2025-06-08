<?php 
// Adjust path if using subdirectories
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require __DIR__ . '/../db_connect.php';

$stmt = $conn->query("SELECT * FROM SEMESTER");
$semesters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Semesters</title>
    <link rel="stylesheet" href="sem_style.css">
</head>
<body>
    <h2>Semester Management</h2>

    <form method="post" action="insert.php">
        <input type="text" name="semester_code" placeholder="Code" required>
        <input type="number" name="semester_year" placeholder="Year" required>
        <input type="text" name="semester_term" placeholder="Term (e.g. Fall)" required>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Add Semester</button>
    </form>

    <table>
        <tr>
            <th>Code</th><th>Year</th><th>Term</th><th>Start</th><th>End</th><th>Actions</th>
        </tr>
        <?php foreach ($semesters as $s): ?>
        <tr>
            <td><?= $s['SEMESTER_CODE'] ?></td>
            <td><?= $s['SEMESTER_YEAR'] ?></td>
            <td><?= $s['SEMESTER_TERM'] ?></td>
            <td><?= $s['SEMESTER_START_DATE'] ?></td>
            <td><?= $s['SEMESTER_END_DATE'] ?></td>
            <td>
                <a href="update.php?code=<?= $s['SEMESTER_CODE'] ?>">Edit</a> |
                <a href="delete.php?code=<?= $s['SEMESTER_CODE'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>