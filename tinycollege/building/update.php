<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
    $code = $_GET['code'];
    $stmt = $conn->prepare("SELECT * FROM BUILDING WHERE BLDG_CODE = ?");
    $stmt->execute([$code]);
    $building = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['bldg_code'];
    $name = $_POST['bldg_name'];
    $location = $_POST['bldg_location'];

    $stmt = $conn->prepare("UPDATE BUILDING SET BLDG_NAME=?, BLDG_LOCATION=? WHERE BLDG_CODE=?");
    $stmt->execute([$name, $location, $code]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Building</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Building</h2>
    <form method="post">
        <input type="text" name="bldg_code" value="<?= $building['BLDG_CODE'] ?>" readonly>
        <input type="text" name="bldg_name" value="<?= $building['BLDG_NAME'] ?>" required>
        <input type="text" name="bldg_location" value="<?= $building['BLDG_LOCATION'] ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
