<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prof_num = $_POST['prof_num'];
    $prof_fname = $_POST['prof_fname'];
    $prof_lname = $_POST['prof_lname'];
    $prof_email = $_POST['prof_email'];
    $dept_code = $_POST['dept_code'];

    // Insert the professor into the database
    $stmt = $conn->prepare("INSERT INTO PROFESSOR (PROF_NUM, PROF_FNAME, PROF_LNAME, PROF_EMAIL, DEPT_CODE) VALUES (:prof_num, :prof_fname, :prof_lname, :prof_email, :dept_code)");
    $stmt->bindParam(':prof_num', $prof_num);
    $stmt->bindParam(':prof_fname', $prof_fname);
    $stmt->bindParam(':prof_lname', $prof_lname);
    $stmt->bindParam(':prof_email', $prof_email);
    $stmt->bindParam(':dept_code', $dept_code);

    if ($stmt->execute()) {
        echo "Professor added successfully!";
    } else {
        echo "Error adding professor.";
    }
}
?>
