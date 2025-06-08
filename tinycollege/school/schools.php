<?php 
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require_once __DIR__ . '/../db_connect.php';

$stmt = $conn->query("SELECT * FROM SCHOOL");
$schools = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Schools</title>
    <link rel="stylesheet" href="school_style.css">
</head>
<body>
    <h2>School Management</h2>


    <form method="POST">
        <label for="school_code">School Code</label>
        <input type="text" name="school_code" placeholder="School Code" required>

        <label for="school_name">School Name</label>
        <input type="text" name="school_name" placeholder="School Name" required>

        <button type="submit">Add School</button>
    </form>

    <br><br>

    <table border="1">
        <tr>
            <th>School Code</th><th>School Name</th><th>Actions</th>
        </tr>
        <?php foreach ($schools as $school): ?>
        <tr>
            <td><?= $school['SCHOOL_CODE'] ?></td>
            <td><?= $school['SCHOOL_NAME'] ?></td>
            <td>
                <a href="update_school.php?code=<?= $school['SCHOOL_CODE'] ?>">Edit</a> |
                <a href="delete_school.php?code=<?= $school['SCHOOL_CODE'] ?>" onclick="return confirm('Are you sure you want to delete this school?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
