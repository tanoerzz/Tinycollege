<?php 
// Adjust path if using subdirectories
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require __DIR__ . '/../db_connect.php';

// Fetch all rooms and their associated building names
$stmt = $conn->query("SELECT ROOM.ROOM_CODE, ROOM.ROOM_TYPE, BUILDING.BLDG_CODE FROM ROOM JOIN BUILDING ON ROOM.BLDG_CODE = BUILDING.BLDG_CODE");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all buildings to populate the dropdown for Room addition
$stmt_bldg = $conn->query("SELECT * FROM BUILDING");
$buildings = $stmt_bldg->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="room_style.css">
</head>
<body>
    <h2>Room Management</h2>

    <form method="post" action="insert_room.php">
        <input type="text" name="room_code" placeholder="Room Code" required>
        <input type="text" name="room_type" placeholder="Room Type" required>
        <select name="bldg_code" required>
            <option value="">Select Building</option>
            <?php foreach ($buildings as $bldg): ?>
                <option value="<?= $bldg['BLDG_CODE'] ?>"><?= $bldg['BLDG_NAME'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add Room</button>
    </form>

    <table>
        <tr>
            <th>Room Code</th><th>Room Type</th><th>Building</th><th>Actions</th>
        </tr>
        <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room['ROOM_CODE'] ?></td>
            <td><?= $room['ROOM_TYPE'] ?></td>
            <td><?= $room['BLDG_CODE'] ?></td>
            <td>
                <a href="update_room.php?code=<?= $room['ROOM_CODE'] ?>">Edit</a> |
                <a href="delete_room.php?code=<?= $room['ROOM_CODE'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>