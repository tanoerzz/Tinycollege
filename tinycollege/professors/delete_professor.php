<?php
require '../db_connect.php';

if (isset($_GET['num'])) {
    $prof_num = $_GET['num'];

    // Delete the professor from the database
    $stmt = $conn->prepare("DELETE FROM PROFESSOR WHERE PROF_NUM = :prof_num");
    $stmt->bindParam(':prof_num', $prof_num);

    if ($stmt->execute()) {
        echo "Professor deleted successfully!";
    } else {
        echo "Error deleting professor.";
    }
}
?>
