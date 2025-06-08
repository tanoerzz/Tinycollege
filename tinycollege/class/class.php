<?php 
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require_once __DIR__ . '/../db_connect.php';


$stmt = $conn->query("SELECT CLASS.CLASS_CODE, CLASS.CLASS_SECTION, CLASS.CLASS_TIME, COURSE.CRS_TITLE, PROFESSOR.PROF_FNAME, PROFESSOR.PROF_LNAME, ROOM.ROOM_TYPE, SEMESTER.SEMESTER_TERM, SEMESTER.SEMESTER_YEAR
                      FROM CLASS
                      JOIN COURSE ON CLASS.CRS_CODE = COURSE.CRS_CODE
                      JOIN PROFESSOR ON CLASS.PROF_NUM = PROFESSOR.PROF_NUM
                      JOIN ROOM ON CLASS.ROOM_CODE = ROOM.ROOM_CODE
                      JOIN SEMESTER ON CLASS.SEMESTER_CODE = SEMESTER.SEMESTER_CODE");
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt_course = $conn->query("SELECT * FROM COURSE");
$courses = $stmt_course->fetchAll(PDO::FETCH_ASSOC);

$stmt_professor = $conn->query("SELECT * FROM PROFESSOR");
$professors = $stmt_professor->fetchAll(PDO::FETCH_ASSOC);

$stmt_room = $conn->query("SELECT * FROM ROOM");
$rooms = $stmt_room->fetchAll(PDO::FETCH_ASSOC);

$stmt_semester = $conn->query("SELECT * FROM SEMESTER");
$semesters = $stmt_semester->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Class Management</title>
    <link rel="stylesheet" href="class_style.css">
</head>
<body>
    <h2>Class Management</h2>

    <form method="post" action="insert_class.php">
        <label for="class_code">Class Code</label>
        <input type="text" name="class_code" required>

        <label for="class_section">Class Section</label>
        <input type="text" name="class_section" required>

        <label for="class_time">Class Time</label>
        <input type="text" name="class_time" required>

        <label for="crs_code">Course Code</label>
        <select name="crs_code" required>
            <option value="">Select Course</option>
            <?php foreach ($courses as $course): ?>
                <option value="<?= $course['CRS_CODE'] ?>"><?= $course['CRS_CODE'] ?> - <?= $course['CRS_TITLE'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="prof_num">Professor</label>
        <select name="prof_num" required>
            <option value="">Select Professor</option>
            <?php foreach ($professors as $professor): ?>
                <option value="<?= $professor['PROF_NUM'] ?>"><?= $professor['PROF_FNAME'] ?> <?= $professor['PROF_LNAME'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="room_code">Room</label>
        <select name="room_code" required>
            <option value="">Select Room</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room['ROOM_CODE'] ?>"><?= $room['ROOM_CODE'] ?> - <?= $room['ROOM_TYPE'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="semester_code">Semester</label>
        <select name="semester_code" required>
            <option value="">Select Semester</option>
            <?php foreach ($semesters as $semester): ?>
                <option value="<?= $semester['SEMESTER_CODE'] ?>"><?= $semester['SEMESTER_TERM'] ?> <?= $semester['SEMESTER_YEAR'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Class</button>
    </form>

    <table>
        <tr>
            <th>Class Code</th><th>Class Section</th><th>Course Title</th><th>Professor</th><th>Room</th><th>Semester</th><th>Actions</th>
        </tr>
        <?php foreach ($classes as $class): ?>
        <tr>
            <td><?= $class['CLASS_CODE'] ?></td>
            <td><?= $class['CLASS_SECTION'] ?></td>
            <td><?= $class['CRS_TITLE'] ?></td>
            <td><?= $class['PROF_FNAME'] ?> <?= $class['PROF_LNAME'] ?></td>
            <td><?= $class['ROOM_TYPE'] ?></td>
            <td><?= $class['SEMESTER_TERM'] ?> <?= $class['SEMESTER_YEAR'] ?></td>
            <td>
                <a href="update_class.php?class_code=<?= $class['CLASS_CODE'] ?>">Edit</a> |
                <a href="delete_class.php?class_code=<?= $class['CLASS_CODE'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>