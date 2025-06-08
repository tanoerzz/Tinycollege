<?php 
// Include header from the includes directory
require_once __DIR__ . '../../includes/header.php'; 
?>

<?php
require '../db_connect.php';

$stmt = $conn->query("SELECT * FROM BUILDING");
$buildings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Buildings</title>
    <link rel="stylesheet" href="bldg_style.css">
</head>
<body>
    <h2>Building Management</h2>

    <form method="post" action="insert.php">
        <input type="text" name="bldg_code" placeholder="Code" required>
        <input type="text" name="bldg_name" placeholder="Name" required>
        <input type="text" name="bldg_location" placeholder="Location" required>
        <button type="submit">Add Building</button>
    </form>

    <table>
        <tr>
            <th>Code</th><th>Name</th><th>Location</th><th>Actions</th>
        </tr>
        <?php foreach ($buildings as $b): ?>
        <tr>
            <td><?= $b['BLDG_CODE'] ?></td>
            <td><?= $b['BLDG_NAME'] ?></td>
            <td><?= $b['BLDG_LOCATION'] ?></td>
            <td>
                <a href="update.php?code=<?= $b['BLDG_CODE'] ?>">Edit</a> |
                <a href="delete.php?code=<?= $b['BLDG_CODE'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
