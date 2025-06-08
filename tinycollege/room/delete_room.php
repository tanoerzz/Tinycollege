<?php
require '../db_connect.php';

if (isset($_GET['code'])) {
    $room_code = $_GET['code'];

    // Delete the room from the database
    $stmt = $conn->prepare("DELETE FROM ROOM WHERE ROOM_CODE = :room_code");
    $stmt->bindParam(':room_code', $room_code);

    if ($stmt->execute()) {
        echo "Room deleted successfully!";
    } else {
        echo "Error deleting room.";
    }
}
?>
