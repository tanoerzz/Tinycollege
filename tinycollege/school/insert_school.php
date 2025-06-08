<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_code = $_POST['school_code'];
    $school_name = $_POST['school_name'];

    $stmt = $conn->prepare("INSERT INTO SCHOOL (SCHOOL_CODE, SCHOOL_NAME) VALUES (?, ?)");
    $stmt->execute([$school_code, $school_name]);

    header('Location: schools.php');
}
?>
    <h2>School Management</h2>
    
    <form method="POST">

        <label for="school_code">School Code</label>
        <input type="text" name="school_code" placeholder="School Code" required>

        <label for="school_name">School Name</label>
        <input type="text" name="school_name" placeholder="School Name" required>

        <button type="submit">Add School</button>
    </form>

    <br><br>

