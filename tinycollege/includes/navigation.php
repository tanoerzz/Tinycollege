        <?php
        // includes/navigation.php

        function isActive($page) {
            $current_script = basename($_SERVER['SCRIPT_NAME']);
            return $current_script === $page ? 'active' : '';
        }

        // Get base URL dynamically
        $base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        ?>

        <nav class="college-nav">
            <div class="nav-header">
                <h2>Tiny College System</h2>
            </div>
            
            <ul class="nav-menu">
        
                <li><a href="<?= $base_url ?>../../school/schools.php" class="<?= isActive('school.php') ?>">Schools</a></li>
                <li><a href="<?= $base_url ?>../../department/departments.php" class="<?= isActive('department.php') ?>">Departments</a></li>
                <li><a href="<?= $base_url ?>../../course/courses.php" class="<?= isActive('course.php') ?>">Courses</a></li>
                <li><a href="<?= $base_url ?>../../class/class.php" class="<?= isActive('class.php') ?>">Classes</a></li>
                <li><a href="<?= $base_url ?>../../student/students.php" class="<?= isActive('student.php') ?>">Students</a></li>
                <li><a href="<?= $base_url ?>../../professors/professors.php" class="<?= isActive('professors.php') ?>">Professors</a></li>     
                <li><a href="<?= $base_url ?>../../building/building.php" class="<?= isActive('building.php') ?>">Buildings</a></li>
                <li><a href="<?= $base_url ?>../../room/room.php" class="<?= isActive('room.php') ?>">Rooms</a></li>              
                <li><a href="<?= $base_url ?>../../enroll/enroll.php" class="<?= isActive('enroll.php') ?>">Enrollments</a></li>
                <li><a href="<?= $base_url ?>../../semester/semester.php" class="<?= isActive('semester.php') ?>">Semesters</a></li>
            </ul>
        </nav>

<style>
.college-nav {
    background: #ffffff; /* Changed from var(--nav-bg) to solid white */
    color: #000000; /* Changed from var(--nav-text) to solid black */
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    padding: 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Solid shadow */
    font-family: 'Inter', system-ui, sans-serif;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    border-bottom: 1px solid #e0e0e0; /* Solid light gray border */
}

.nav-header {
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e0e0e0; /* Solid light gray border */
    background: #f8f8f8; /* Light gray background */
}

.nav-header h2 {
    margin: 0;
    color: #000000; /* Solid black */
    font-size: 1.3rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    position: relative;
    padding-left: 16px;
}

.nav-header h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    height: 18px;
    width: 4px;
    background: #0077cc; /* Solid blue accent */
    border-radius: 2px;
}

.nav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    overflow-x: auto;
    background: #ffffff; /* Solid white */
    scrollbar-width: thin;
    scrollbar-color: #cccccc #f0f0f0; /* Solid scrollbar colors */
}

.nav-menu li {
    flex-shrink: 0;
    position: relative;
}

.nav-menu li a {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    color: #000000; /* Solid black */
    text-decoration: none;
    transition: all 0.2s ease; /* Solid transition */
    font-size: 0.95rem;
    position: relative;
    white-space: nowrap;
}

.nav-menu li a:hover {
    background: #e6e6e6; /* Solid light gray */
    color: #000000; /* Solid black */
}

.nav-menu li a.active {
    background: #e6f2ff; /* Solid light blue */
    color: #000000; /* Solid black */
    font-weight: 500;
}

.nav-menu li a.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 3px;
    background: #0077cc; /* Solid blue accent */
    border-radius: 2px 2px 0 0;
}

/* Dropdown styling */
.nav-dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #ffffff; /* Solid white */
    min-width: 200px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    z-index: 1001;
    border-radius: 0 0 6px 6px;
    overflow: hidden;
    border: 1px solid #e0e0e0; /* Solid light gray */
}

.nav-dropdown-content a {
    padding: 12px 16px;
    color: #555555; /* Solid dark gray */
    display: block;
}

.nav-dropdown-content a:hover {
    background: #f0f0f0; /* Solid light gray */
}

/* Scrollbar styling */
.nav-menu::-webkit-scrollbar {
    height: 4px;
}

.nav-menu::-webkit-scrollbar-thumb {
    background: #cccccc; /* Solid gray */
    border-radius: 2px;
}

/* Main content padding */
.main-content {
    padding-top: 80px;
}

/* Accessibility improvements */
.nav-menu li a:focus-visible {
    outline: 2px solid #0077cc; /* Solid blue */
    outline-offset: -2px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .nav-header {
        padding: 12px 16px;
    }
    
    .nav-menu li a {
        padding: 12px 16px;
        font-size: 0.9rem;
    }
    
    .main-content {
        padding-top: 70px;
    }
    
    .nav-dropdown-content {
        position: static;
        box-shadow: none;
        border: none;
        border-top: 1px solid #e0e0e0; /* Solid light gray */
    }
}
</style>
