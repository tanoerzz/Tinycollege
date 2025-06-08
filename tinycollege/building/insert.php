<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['bldg_code'];
    $name = $_POST['bldg_name'];
    $location = $_POST['bldg_location'];

    $sql = "INSERT INTO BUILDING (BLDG_CODE, BLDG_NAME, BLDG_LOCATION) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$code, $name, $location]);

    header("Location: index.php");
}
?>
