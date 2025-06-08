<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_code = $_POST['room_code'];
    $room_type = $_POST['room_type'];
    $bldg_code = $_POST['bldg_code'];

    // Insert the new room into the database
    $stmt = $conn->prepare("INSERT INTO ROOM (ROOM_CODE, ROOM_TYPE, BLDG_CODE) VALUES (:room_code, :room_type, :bldg_code)");
    $stmt->bindParam(':room_code', $room_code);
    $stmt->bindParam(':room_type', $room_type);
    $stmt->bindParam(':bldg_code', $bldg_code);

    if ($stmt->execute()) {
        echo "Room added successfully!";
    } else {
        echo "Error adding room.";
    }
}
?>
