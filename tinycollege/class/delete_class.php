<?php
require '../db_connect.php';

$class_code = $_GET['class_code'];

$stmt = $conn->prepare("DELETE FROM CLASS WHERE CLASS_CODE = ?");
$stmt->execute([$class_code]);

header('Location: class_management.php');
?>
