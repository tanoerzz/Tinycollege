<?php
require '../db_connect.php';

// Fetch the room details for editing
$room_code = $_GET['code'];
$stmt = $conn->prepare("SELECT * FROM ROOM WHERE ROOM_CODE = :room_code");
$stmt->bindParam(':room_code', $room_code);
$stmt->execute();
$room = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch buildings for the dropdown
$stmt_bldg = $conn->query("SELECT * FROM BUILDING");
$buildings = $stmt_bldg->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Room</h2>

    <form method="post" action="update_room_process.php">
        <input type="hidden" name="room_code" value="<?= $room['ROOM_CODE'] ?>" required>
        <input type="text" name="room_type" value="<?= $room['ROOM_TYPE'] ?>" required>
        <select name="bldg_code" required>
            <option value="">Select Building</option>
            <?php foreach ($buildings as $bldg): ?>
                <option value="<?= $bldg['BLDG_CODE'] ?>" <?= $bldg['BLDG_CODE'] == $room['BLDG_CODE'] ? 'selected' : '' ?>>
                    <?= $bldg['BLDG_NAME'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Update Room</button>
    </form>
</body>
</html>
