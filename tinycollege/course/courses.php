<?php 
// Adjust path if using subdirectories
require_once __DIR__ . '/../includes/header.php'; 
?>

<?php
require __DIR__ .'/../db_connect.php';

$stmt = $conn->query("SELECT COURSE.CRS_CODE, COURSE.CRS_TITLE, COURSE.CRS_CREDIT, DEPARTMENT.DEPT_NAME FROM COURSE JOIN DEPARTMENT ON COURSE.DEPT_CODE = DEPARTMENT.DEPT_CODE");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_dept = $conn->query("SELECT * FROM DEPARTMENT");
$departments = $stmt_dept->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJfX3pM2e2NqF5mr5d6FjXKMlM6KQfN8rBLOF0ktVh2Zlthv3o/fpdbXT+dD" crossorigin="anonymous">
    <link rel="stylesheet" href="course_style.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-primary">Course Management</h2>

        <div class="row">
            <!-- Form Section -->
            <div class="col-md-6 mx-auto">
                <form method="post" action="insert_course.php" class="bg-dark p-4 rounded">

                        <label for="crs_code" class="form-label text-light">Course Code</label>
                        <input type="text" name="crs_code" id="crs_code" class="form-control" placeholder="Course Code" required>


                        <label for="crs_description" class="form-label text-light">Course Description</label>
                        <textarea name="crs_description" id="crs_description" class="form-control" placeholder="Course Description" required></textarea>

                    

                        <label for="crs_credit" class="form-label text-light">Credits</label>
                        <input type="number" name="crs_credit" id="crs_credit" class="form-control" placeholder="Credits" required>

                    

                        <label for="dept_code" class="form-label text-light">Department</label>
                        <select name="dept_code" id="dept_code" class="form-select" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['DEPT_CODE'] ?>"><?= $dept['DEPT_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>


                    <button type="submit" class="btn btn-primary w-100">Add Course</button>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="mt-4">
            <h3 class="text-center text-light">Existing Courses</h3>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Title</th>
                        <th>Credits</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= $course['CRS_CODE'] ?></td>
                        <td><?= $course['CRS_TITLE'] ?></td>
                        <td><?= $course['CRS_CREDIT'] ?></td>
                        <td><?= $course['DEPT_NAME'] ?></td>
                        <td>
                            <a href="update_course.php?code=<?= $course['CRS_CODE'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_course.php?code=<?= $course['CRS_CODE'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>