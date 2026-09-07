<?php $pageTitle = 'Database Design Project'; require_once __DIR__ . '/../includes/functions.php'; $num = 10; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Database Design Project</h1>
    <p class="lesson-desc">Apply everything you've learned by designing a complete database system from scratch.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>List the complete database design process from Lessons 3-9 in order: ERD, keys, normalization, DDL, security. What step comes first and why?</li>
        <li>If you were designing a database for a new project, would you start by writing CREATE TABLE statements or by drawing an ERD? Explain your reasoning.</li>
        <li>Name three security measures you should implement in any database-backed application and explain why each is important.</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>database design project</strong> is a comprehensive exercise that applies all DBMS concepts — ER diagrams, relational design, normalization, DDL, transactions, and security — to build a complete, well-structured database from a set of requirements.</p>

<h3>Analogy</h3>
<p>Designing a database is like <strong>planning and building a house</strong>:</p>
<ol>
    <li><strong>Requirements = Client brief:</strong> What rooms do they need? How many bedrooms?</li>
    <li><strong>ERD = Architectural blueprint:</strong> Rooms, sizes, and how they connect.</li>
    <li><strong>Normalization = Efficient layout:</strong> No wasted space, every room has a clear purpose.</li>
    <li><strong>DDL = Construction:</strong> Pouring foundations, building walls.</li>
    <li><strong>Security = Locks and alarms:</strong> Protecting the finished home.</li>
</ol>
<p>You wouldn't start building without a blueprint. The same applies to databases.</p>

<h3>How It Works: The Design Process</h3>

<h4>Step 1: Identify Requirements</h4>
<p>Understand what data needs to be stored and what operations the system must support.</p>

<h4>Step 2: Identify Entities and Attributes</h4>
<p>List all the "things" (entities) and their properties (attributes).</p>

<h4>Step 3: Draw the ERD</h4>
<p>Map entities, attributes, and relationships visually.</p>

<h4>Step 4: Normalize</h4>
<p>Apply 1NF, 2NF, 3NF to eliminate redundancy and anomalies.</p>

<h4>Step 5: Write DDL</h4>
<p>Translate the design into CREATE TABLE statements with keys and constraints.</p>

<h4>Step 6: Add Security</h4>
<p>Create users, assign privileges, and implement authentication.</p>

<h3>Example: School Management System</h3>

<h4>Requirements</h4>
<ul>
    <li>Students can enroll in courses</li>
    <li>Courses have teachers</li>
    <li>Teachers belong to departments</li>
    <li>Students receive grades</li>
    <li>Track attendance</li>
</ul>

<h4>Step 2: Entities</h4>
<table>
    <thead>
        <tr><th>Entity</th><th>Description</th><th>Key Attributes</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Student</strong></td><td>A person enrolled in the school</td><td>id, name, email, date_of_birth</td></tr>
        <tr><td><strong>Teacher</strong></td><td>A person who teaches courses</td><td>id, name, email, hire_date</td></tr>
        <tr><td><strong>Course</strong></td><td>A subject offered by the school</td><td>id, title, credits, code</td></tr>
        <tr><td><strong>Department</strong></td><td>An organizational unit</td><td>id, name, building</td></tr>
        <tr><td><strong>Enrollment</strong></td><td>Student-Course relationship</td><td>student_id, course_id, semester</td></tr>
        <tr><td><strong>Grade</strong></td><td>Student's grade in a course</td><td>enrollment_id, grade, date</td></tr>
    </tbody>
</table>

<h4>Step 3: ERD</h4>
<pre><code>  ┌────────────────┐                ┌────────────────┐
   │   DEPARTMENT   │                │    STUDENT     │
   ├────────────────┤                ├────────────────┤
   │ *dept_id  (PK) │                │ *student_id(PK)│
   │  name          │                │  first_name    │
   │  building      │                │  last_name     │
   │  budget        │                │  email         │
   └───────┬────────┘                │  date_of_birth │
           │                         └───────┬────────┘
           │ 1:N                             │
   ┌───────▼────────┐                ┌───────▼────────┐
   │    TEACHER     │                │  ENROLLMENT    │
   ├────────────────┤                ├────────────────┤
   │ *teacher_id(PK)│                │ *student_id(FK)│
   │  first_name    │                │ *course_id(FK) │
   │  last_name     │                │  semester      │
   │  email         │                │  enrollment_dt │
   │  dept_id  (FK) │                └───────┬────────┘
   └───────┬────────┘                        │
           │                                 │
           │ 1:N                             │ M:N
   ┌───────▼────────┐                ┌───────▼────────┐
   │    COURSE      │                │    GRADE       │
   ├────────────────┤                ├────────────────┤
   │ *course_id(PK) │                │ *grade_id (PK) │
   │  title         │                │  student_id    │
   │  code          │                │  course_id     │
   │  credits       │                │  grade         │
   │  teacher_id(FK)│                │  graded_date   │
   └────────────────┘                └────────────────┘</code></pre>

<h4>Step 5: DDL</h4>
<pre><code>CREATE DATABASE school_management;
USE school_management;

CREATE TABLE departments (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    building VARCHAR(50),
    budget DECIMAL(12,2) DEFAULT 0
);

CREATE TABLE teachers (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    hire_date DATE NOT NULL,
    dept_id INT,
    FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
        ON DELETE SET NULL
);

CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    date_of_birth DATE,
    enrollment_date DATE DEFAULT (CURRENT_DATE),
    is_active BOOLEAN DEFAULT TRUE
);

CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    code VARCHAR(10) UNIQUE NOT NULL,
    credits INT NOT NULL CHECK (credits > 0),
    teacher_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id)
        ON DELETE SET NULL
);

CREATE TABLE enrollments (
    student_id INT,
    course_id INT,
    semester VARCHAR(20) NOT NULL,
    enrollment_date DATE DEFAULT (CURRENT_DATE),
    PRIMARY KEY (student_id, course_id, semester),
    FOREIGN KEY (student_id) REFERENCES students(student_id)
        ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
        ON DELETE CASCADE
);

CREATE TABLE grades (
    grade_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    semester VARCHAR(20) NOT NULL,
    grade VARCHAR(2) CHECK (grade IN ('A','B','C','D','F','I')),
    graded_date DATE DEFAULT (CURRENT_DATE),
    comments TEXT,
    FOREIGN KEY (student_id, course_id, semester)
        REFERENCES enrollments(student_id, course_id, semester)
        ON DELETE CASCADE
);</code></pre>

<h4>Step 6: Security</h4>
<pre><code>-- Create application user with limited privileges
CREATE USER 'school_app'@'localhost' IDENTIFIED BY 'secure_password_123';

-- Grant only necessary permissions
GRANT SELECT, INSERT, UPDATE ON school_management.students TO 'school_app'@'localhost';
GRANT SELECT, INSERT, UPDATE ON school_management.enrollments TO 'school_app'@'localhost';
GRANT SELECT, INSERT, UPDATE ON school_management.grades TO 'school_app'@'localhost';
GRANT SELECT ON school_management.courses TO 'school_app'@'localhost';
GRANT SELECT ON school_management.teachers TO 'school_app'@'localhost';

-- Revoke dangerous permissions
REVOKE DELETE, DROP, ALTER ON school_management.* FROM 'school_app'@'localhost';</code></pre>

<h3>Normalization Check</h3>
<table>
    <thead>
        <tr><th>Form</th><th>Check</th><th>Status</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>1NF</strong></td><td>All values atomic? No repeating groups?</td><td>Yes</td></tr>
        <tr><td><strong>2NF</strong></td><td>No partial dependencies?</td><td>Yes — grade depends on both student AND course</td></tr>
        <tr><td><strong>3NF</strong></td><td>No transitive dependencies?</td><td>Yes — teacher dept is in separate table</td></tr>
    </tbody>
</table>

<h3>Useful Queries</h3>
<pre><code>-- Student transcript
SELECT
    s.first_name, s.last_name,
    c.title AS course,
    g.grade,
    g.graded_date
FROM grades g
JOIN students s ON g.student_id = s.student_id
JOIN courses c ON g.course_id = c.course_id
WHERE s.student_id = 1
ORDER BY g.graded_date DESC;

-- GPA calculation
SELECT
    s.first_name, s.last_name,
    AVG(CASE g.grade
        WHEN 'A' THEN 4.0
        WHEN 'B' THEN 3.0
        WHEN 'C' THEN 2.0
        WHEN 'D' THEN 1.0
        WHEN 'F' THEN 0.0
    END) AS gpa
FROM students s
JOIN grades g ON s.student_id = g.student_id
GROUP BY s.student_id
ORDER BY gpa DESC;</code></pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Hospital Management:</strong> Design a complete system for patients, doctors, appointments, billing, and medical records.</li>
    <li><strong>E-commerce Platform:</strong> Products, categories, customers, orders, payments, and shipping — a full database design challenge.</li>
    <li><strong>Hotel Reservation System:</strong> Rooms, guests, bookings, staff, and billing with transaction support.</li>
    <li><strong>Inventory Management:</strong> Products, suppliers, warehouses, stock movements, and purchase orders.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Requirements first:</strong> Don't start designing until you fully understand what the system needs to do.</li>
    <li><strong>ERD before SQL:</strong> Always draw the diagram before writing CREATE TABLE statements.</li>
    <li><strong>Normalize, then check:</strong> Apply normalization step by step and verify at each level.</li>
    <li><strong>Security from day one:</strong> Don't bolt on security at the end — design it into the system from the start.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Skip requirements and jump to coding:</strong> This leads to incomplete designs and frequent restructuring.</li>
    <li><strong>Ignoring relationships:</strong> Tables without foreign keys create orphaned records and data inconsistency.</li>
    <li><strong>Forgetting about scale:</strong> A design that works for 100 rows may fail with 1 million. Consider indexing and query performance.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are hired to design a complete database for a <strong>Hospital Management System</strong>. The hospital needs to track:</p>
    <ul>
        <li>Patients (personal info, medical history, insurance)</li>
        <li>Doctors (personal info, specialty, department)</li>
        <li>Appointments (date, time, reason, status)</li>
        <li>Departments (name, location, budget)</li>
        <li>Billing (services rendered, amounts, payment status)</li>
    </ul>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Identify all entities and list at least 4 attributes for each.</li>
        <li>Draw the ERD showing all entities, relationships, and cardinality.</li>
        <li>Write the CREATE TABLE statements for your design with proper primary keys, foreign keys, and constraints.</li>
        <li>Ensure your design is in at least 3NF. Explain why.</li>
        <li>Write the GRANT statements for three user types: admin (full access), doctor (can view and update patient records), and receptionist (can only manage appointments and billing).</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>Patient:</strong> patient_id (PK), first_name, last_name, email, phone, date_of_birth, insurance_id</li>
                    <li><strong>Doctor:</strong> doctor_id (PK), first_name, last_name, email, specialty, dept_id (FK), hire_date</li>
                    <li><strong>Appointment:</strong> appointment_id (PK), patient_id (FK), doctor_id (FK), date, time, reason, status</li>
                    <li><strong>Department:</strong> dept_id (PK), name, location, budget</li>
                    <li><strong>Billing:</strong> bill_id (PK), patient_id (FK), appointment_id (FK), service_description, amount, payment_status, payment_date</li>
                </ul>
            </li>
            <li>Expected ERD should show: Department → 1:N → Doctor, Patient → 1:N → Appointment, Doctor → 1:N → Appointment, Patient → 1:N → Billing, Appointment → 1:1 → Billing.</li>
            <li>
                <pre><code>CREATE DATABASE hospital_management;
USE hospital_management;

CREATE TABLE departments (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100),
    budget DECIMAL(12,2) DEFAULT 0
);

CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    specialty VARCHAR(100) NOT NULL,
    dept_id INT,
    hire_date DATE NOT NULL,
    FOREIGN KEY (dept_id) REFERENCES departments(dept_id) ON DELETE SET NULL
);

CREATE TABLE patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    date_of_birth DATE,
    insurance_id VARCHAR(50)
);

CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appt_date DATE NOT NULL,
    appt_time TIME NOT NULL,
    reason TEXT,
    status VARCHAR(20) DEFAULT 'scheduled' CHECK (status IN ('scheduled','completed','cancelled')),
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE RESTRICT
);

CREATE TABLE billing (
    bill_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    appointment_id INT UNIQUE,
    service_description VARCHAR(200) NOT NULL,
    amount DECIMAL(10,2) NOT NULL CHECK (amount >= 0),
    payment_status VARCHAR(20) DEFAULT 'pending'
        CHECK (payment_status IN ('pending','paid','overdue')),
    payment_date DATE,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id)
);</code></pre>
            </li>
            <li>The design is in 3NF: (1) All values are atomic (1NF). (2) No partial dependencies — all non-key columns depend on the full primary key (2NF). (3) No transitive dependencies — doctor specialty depends on doctor_id, not on appointment_id; department budget depends on dept_id, not on doctor_id (3NF).</li>
            <li>
                <pre><code>-- Admin: full access
GRANT ALL PRIVILEGES ON hospital_management.* TO 'admin_role'@'localhost';

-- Doctor: can view and update patient records
GRANT SELECT ON hospital_management.patients TO 'doctor_role'@'localhost';
GRANT SELECT, UPDATE ON hospital_management.appointments TO 'doctor_role'@'localhost';
GRANT SELECT ON hospital_management.medical_records TO 'doctor_role'@'localhost';

-- Receptionist: can only manage appointments and billing
GRANT SELECT, INSERT, UPDATE ON hospital_management.appointments TO 'receptionist_role'@'localhost';
GRANT SELECT, INSERT, UPDATE ON hospital_management.billing TO 'receptionist_role'@'localhost';
GRANT SELECT ON hospital_management.patients TO 'receptionist_role'@'localhost';</code></pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
