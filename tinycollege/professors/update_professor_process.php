<?php
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prof_num = $_POST['prof_num'];
    $prof_fname = $_POST['prof_fname'];
    $prof_lname = $_POST['prof_lname'];
    $prof_email = $_POST['prof_email'];
    $dept_code = $_POST['dept_code'];

    // Update the professor details in the database
    $stmt = $conn->prepare("UPDATE PROFESSOR SET PROF_FNAME = :prof_fname, PROF_LNAME = :prof_lname, PROF_EMAIL = :prof_email, DEPT_CODE = :dept_code WHERE PROF_NUM = :prof_num");
    $stmt->bindParam(':prof_num', $prof_num);
    $stmt->bindParam(':prof_fname', $prof_fname);
    $stmt->bindParam(':prof_lname', $prof_lname);
    $stmt->bindParam(':prof_email', $prof_email);
    $stmt->bindParam(':dept_code', $dept_code);

    if ($stmt->execute()) {
        echo "Professor updated successfully!";
    } else {
        echo "Error updating professor.";
    }
}
?>
