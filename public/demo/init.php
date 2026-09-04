<?php
/**
 * Student Portal Demo - Database Initialization
 * Uses SQLite (no external database server needed)
 */

session_start();

define('DB_PATH', __DIR__ . '/portal.db');

function getDB(): SQLite3 {
    $db = new SQLite3(DB_PATH);
    $db->enableExceptions(true);
    $db->exec('PRAGMA journal_mode = WAL');
    return $db;
}

function initDB(): void {
    if (file_exists(DB_PATH)) return;

    $db = getDB();

    $db->exec('
        CREATE TABLE students (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            student_id TEXT UNIQUE NOT NULL,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            password TEXT NOT NULL,
            course TEXT NOT NULL,
            year_level INTEGER NOT NULL,
            avatar_color TEXT DEFAULT "#89b4fa"
        )
    ');

    $db->exec('
        CREATE TABLE courses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            code TEXT UNIQUE NOT NULL,
            name TEXT NOT NULL,
            credits INTEGER NOT NULL,
            instructor TEXT NOT NULL,
            schedule TEXT NOT NULL
        )
    ');

    $db->exec('
        CREATE TABLE enrollments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            student_id INTEGER NOT NULL,
            course_id INTEGER NOT NULL,
            semester TEXT NOT NULL,
            grade REAL DEFAULT NULL,
            status TEXT DEFAULT "enrolled",
            FOREIGN KEY (student_id) REFERENCES students(id),
            FOREIGN KEY (course_id) REFERENCES courses(id)
        )
    ');

    $db->exec('
        CREATE TABLE assignments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            course_id INTEGER NOT NULL,
            title TEXT NOT NULL,
            description TEXT NOT NULL,
            due_date TEXT NOT NULL,
            max_score INTEGER DEFAULT 100,
            FOREIGN KEY (course_id) REFERENCES courses(id)
        )
    ');

    $db->exec('
        CREATE TABLE submissions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            assignment_id INTEGER NOT NULL,
            student_id INTEGER NOT NULL,
            content TEXT NOT NULL,
            score INTEGER DEFAULT NULL,
            submitted_at TEXT NOT NULL,
            FOREIGN KEY (assignment_id) REFERENCES assignments(id),
            FOREIGN KEY (student_id) REFERENCES students(id)
        )
    ');

    // Sample students
    $db->exec("INSERT INTO students (student_id, name, email, password, course, year_level, avatar_color) VALUES
        ('2024-0001', 'Juan Dela Cruz', 'juan@gcollege.edu', 'demo123', 'BS Information Technology', 3, '#89b4fa'),
        ('2024-0002', 'Maria Santos', 'maria@gcollege.edu', 'demo123', 'BS Computer Science', 2, '#a6e3a1'),
        ('2024-0003', 'Pedro Reyes', 'pedro@gcollege.edu', 'demo123', 'BS Information Technology', 4, '#fab387')
    ");

    // Sample courses
    $db->exec("INSERT INTO courses (code, name, credits, instructor, schedule) VALUES
        ('CS101', 'Introduction to Programming', 3, 'Prof. Ana Garcia', 'MWF 8:00-9:00'),
        ('CS201', 'Data Structures & Algorithms', 3, 'Prof. Carlo Mendoza', 'TTH 10:00-11:30'),
        ('CS301', 'Database Management Systems', 3, 'Prof. Lloyd Dacles', 'MWF 10:00-11:00'),
        ('IT102', 'Web Development Fundamentals', 3, 'Prof. Sarah Lim', 'TTH 1:00-2:30'),
        ('IT202', 'Object-Oriented Programming', 3, 'Prof. Mark Torres', 'MWF 2:00-3:00'),
        ('CS401', 'Software Engineering', 3, 'Prof. Jane Cruz', 'TTH 3:00-4:30'),
        ('IT301', 'Network Security', 3, 'Prof. Ryan Villanueva', 'MWF 11:00-12:00'),
        ('CS501', 'Artificial Intelligence', 3, 'Prof. Lisa Chen', 'TTH 8:00-9:30')
    ");

    // Sample enrollments for Juan (student_id = 1)
    $db->exec("INSERT INTO enrollments (student_id, course_id, semester, grade, status) VALUES
        (1, 1, '1st Sem 2024-2025', 92, 'completed'),
        (1, 2, '1st Sem 2024-2025', 88, 'completed'),
        (1, 3, '2nd Sem 2024-2025', 95, 'enrolled'),
        (1, 4, '2nd Sem 2024-2025', 90, 'enrolled'),
        (1, 5, '2nd Sem 2024-2025', NULL, 'enrolled'),
        (1, 6, '2nd Sem 2024-2025', NULL, 'enrolled')
    ");

    // Sample assignments for enrolled courses
    $db->exec("INSERT INTO assignments (course_id, title, description, due_date, max_score) VALUES
        (3, 'ER Diagram Design', 'Design an ER diagram for a hospital management system. Include all entities, relationships, and cardinalities.', '2025-04-15', 100),
        (3, 'SQL Query Workshop', 'Write SQL queries for the given scenarios. Use JOINs, subqueries, and aggregate functions.', '2025-04-20', 100),
        (4, 'Build a Landing Page', 'Create a responsive landing page for a fictional company using HTML, CSS, and JavaScript.', '2025-04-18', 100),
        (5, 'Python OOP Project', 'Implement a library management system using Python classes and inheritance.', '2025-04-22', 100),
        (6, 'SRS Document', 'Write a Software Requirements Specification document for a student information system.', '2025-04-25', 100)
    ");

    // Sample submissions for Juan
    $db->exec("INSERT INTO submissions (assignment_id, student_id, content, score, submitted_at) VALUES
        (1, 1, 'I designed an ER diagram with entities: Patient, Doctor, Room, Appointment, and Prescription. The relationships include Patient-Doctor (many-to-many through Appointment), Doctor-Room (many-to-one), and Patient-Prescription (one-to-many).', 95, '2025-04-10 14:30:00'),
        (3, 1, 'Created a responsive landing page for TechCorp Inc. with a hero section, features grid, testimonials carousel, and contact form. Used CSS Grid and Flexbox for layout.', 88, '2025-04-15 09:15:00')
    ");

    $db->close();
}

// Initialize on include
initDB();
