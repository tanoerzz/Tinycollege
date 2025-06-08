<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_code = $_POST['room_code'];
    $room_type = $_POST['room_type'];
    $bldg_code = $_POST['bldg_code'];

    // Update the room details in the database
    $stmt = $conn->prepare("UPDATE ROOM SET ROOM_TYPE = :room_type, BLDG_CODE = :bldg_code WHERE ROOM_CODE = :room_code");
    $stmt->bindParam(':room_code', $room_code);
    $stmt->bindParam(':room_type', $room_type);
    $stmt->bindParam(':bldg_code', $bldg_code);

    if ($stmt->execute()) {
        echo "Room updated successfully!";
    } else {
        echo "Error updating room.";
    }
}
?>
