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

<h3>What is a Database Design Project?</h3>
<p>A <strong>database design project</strong> is a comprehensive exercise that applies all DBMS concepts — ER diagrams, relational design, normalization, DDL, transactions, and security — to build a complete, well-structured database from a set of requirements.</p>

<h3>Analogy</h3>
<p>Designing a database is like <strong>planning and building a house</strong>:</p>
<table>
    <thead>
        <tr><th>Step</th><th>House Analogy</th><th>Database Equivalent</th></tr>
    </thead>
    <tbody>
        <tr><td>1. Requirements</td><td>Client brief: What rooms needed?</td><td>What data to store?</td></tr>
        <tr><td>2. ERD</td><td>Architectural blueprint</td><td>Entities, attributes, relationships</td></tr>
        <tr><td>3. Normalization</td><td>Efficient layout</td><td>Remove redundancy</td></tr>
        <tr><td>4. DDL</td><td>Construction</td><td>CREATE TABLE statements</td></tr>
        <tr><td>5. Security</td><td>Locks and alarms</td><td>Users and permissions</td></tr>
    </tbody>
</table>

<h3>The Design Process</h3>
<table>
    <thead>
        <tr><th>Step</th><th>Action</th><th>Output</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Identify Requirements</td><td>Requirements document</td></tr>
        <tr><td>2</td><td>Identify Entities &amp; Attributes</td><td>Entity list with attributes</td></tr>
        <tr><td>3</td><td>Draw the ERD</td><td>Visual diagram</td></tr>
        <tr><td>4</td><td>Normalize (1NF → 3NF)</td><td>Normalized schema</td></tr>
        <tr><td>5</td><td>Write DDL</td><td>CREATE TABLE statements</td></tr>
        <tr><td>6</td><td>Add Security</td><td>Users and privileges</td></tr>
    </tbody>
</table>

<h3>Example: School Management System</h3>

<h4>Step 1: Requirements</h4>
<table>
    <thead>
        <tr><th>Requirement</th><th>Details</th></tr>
    </thead>
    <tbody>
        <tr><td>Students enroll in courses</td><td>Each student can take multiple courses</td></tr>
        <tr><td>Courses have teachers</td><td>Each course has one teacher</td></tr>
        <tr><td>Teachers belong to departments</td><td>Each teacher is in one department</td></tr>
        <tr><td>Students receive grades</td><td>Grade per course per student</td></tr>
    </tbody>
</table>

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
<pre><code>┌────────────────┐                ┌────────────────┐
│   DEPARTMENT   │                │    STUDENT     │
├────────────────┤                ├────────────────┤
│ *dept_id  (PK) │                │ *student_id(PK)│
│  name          │                │  first_name    │
│  building      │                │  last_name     │
└───────┬────────┘                │  email         │
        │                         └───────┬────────┘
        │ 1:N                             │
┌───────▼────────┐                ┌───────▼────────┐
│    TEACHER     │                │  ENROLLMENT    │
├────────────────┤                ├────────────────┤
│ *teacher_id(PK)│                │ *student_id(FK)│
│  first_name    │                │ *course_id(FK) │
│  last_name     │                │  semester      │
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

<h4>Step 4: Normalization Check</h4>
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

<h4>Step 5: DDL Summary</h4>
<table>
    <thead>
        <tr><th>Table</th><th>Primary Key</th><th>Foreign Keys</th><th>Constraints</th></tr>
    </thead>
    <tbody>
        <tr><td>departments</td><td>dept_id</td><td>—</td><td>name NOT NULL</td></tr>
        <tr><td>teachers</td><td>id</td><td>dept_id → departments</td><td>name NOT NULL</td></tr>
        <tr><td>students</td><td>id</td><td>—</td><td>name NOT NULL, email UNIQUE</td></tr>
        <tr><td>courses</td><td>id</td><td>teacher_id → teachers</td><td>title NOT NULL</td></tr>
        <tr><td>enrollments</td><td>(student_id, course_id)</td><td>student_id → students, course_id → courses</td><td>Composite PK</td></tr>
        <tr><td>grades</td><td>id</td><td>student_id → students, course_id → courses</td><td>grade NOT NULL</td></tr>
    </tbody>
</table>

<h4>Step 6: Security</h4>
<table>
    <thead>
        <tr><th>Role</th><th>Permissions</th><th>Tables</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Admin</strong></td><td>Full access</td><td>All tables</td></tr>
        <tr><td><strong>Teacher</strong></td><td>SELECT, UPDATE</td><td>grades, students, courses</td></tr>
        <tr><td><strong>Student</strong></td><td>SELECT</td><td>grades (own only)</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Project</th><th>Key Entities</th><th>Design Challenge</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Hospital Management</strong></td><td>Patients, Doctors, Appointments, Billing</td><td>Complex relationships, compliance requirements</td></tr>
        <tr><td><strong>E-commerce Platform</strong></td><td>Products, Customers, Orders, Payments</td><td>High volume, inventory management</td></tr>
        <tr><td><strong>Hotel Reservation</strong></td><td>Rooms, Guests, Bookings, Staff</td><td>Real-time availability, pricing rules</td></tr>
        <tr><td><strong>Inventory Management</strong></td><td>Products, Suppliers, Warehouses</td><td>Multi-location tracking, reorder points</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Requirements first</strong></td><td>Don't start designing until you fully understand what the system needs</td></tr>
        <tr><td><strong>ERD before SQL</strong></td><td>Always draw the diagram before writing CREATE TABLE</td></tr>
        <tr><td><strong>Normalize, then check</strong></td><td>Apply normalization step by step and verify at each level</td></tr>
        <tr><td><strong>Security from day one</strong></td><td>Don't bolt on security at the end — design it in from the start</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Skip requirements, jump to coding</td><td>Incomplete designs, frequent restructuring</td><td>Document requirements thoroughly first</td></tr>
        <tr><td>Ignoring relationships</td><td>Orphaned records, data inconsistency</td><td>Always define foreign keys</td></tr>
        <tr><td>Forgetting about scale</td><td>Design works for 100 rows, fails at 1 million</td><td>Consider indexing and query performance</td></tr>
    </tbody>
</table>

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
        <li>Describe all relationships and their cardinality (1:1, 1:N, M:N).</li>
        <li>Explain your normalization check — why is this design in 3NF?</li>
        <li>Create a table showing the privileges for three user types: admin, doctor, and receptionist.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <table>
                    <thead>
                        <tr><th>Entity</th><th>Attributes</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Patient</strong></td><td>patient_id (PK), first_name, last_name, email, phone, date_of_birth, insurance_id</td></tr>
                        <tr><td><strong>Doctor</strong></td><td>doctor_id (PK), first_name, last_name, email, specialty, dept_id (FK), hire_date</td></tr>
                        <tr><td><strong>Appointment</strong></td><td>appointment_id (PK), patient_id (FK), doctor_id (FK), date, time, reason, status</td></tr>
                        <tr><td><strong>Department</strong></td><td>dept_id (PK), name, location, budget</td></tr>
                        <tr><td><strong>Billing</strong></td><td>bill_id (PK), patient_id (FK), appointment_id (FK), service_description, amount, payment_status, payment_date</td></tr>
                    </tbody>
                </table>
            </li>
            <li>
                <ul>
                    <li>Department → Doctor: <strong>1:N</strong> (one department has many doctors)</li>
                    <li>Patient → Appointment: <strong>1:N</strong> (one patient has many appointments)</li>
                    <li>Doctor → Appointment: <strong>1:N</strong> (one doctor has many appointments)</li>
                    <li>Patient → Billing: <strong>1:N</strong> (one patient has many bills)</li>
                    <li>Appointment → Billing: <strong>1:1</strong> (each appointment generates one bill)</li>
                </ul>
            </li>
            <li>The design is in 3NF: (1) All values are atomic (1NF). (2) No partial dependencies — all non-key columns depend on the full primary key (2NF). (3) No transitive dependencies — doctor specialty depends on doctor_id, not on appointment_id; department budget depends on dept_id, not on doctor_id (3NF).</li>
            <li>
                <table>
                    <thead>
                        <tr><th>Role</th><th>SELECT</th><th>INSERT</th><th>UPDATE</th><th>DELETE</th><th>Tables</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Admin</strong></td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>All tables</td></tr>
                        <tr><td><strong>Doctor</strong></td><td>✓</td><td>—</td><td>✓</td><td>—</td><td>patients, appointments</td></tr>
                        <tr><td><strong>Receptionist</strong></td><td>✓</td><td>✓</td><td>✓</td><td>—</td><td>appointments, billing</td></tr>
                    </tbody>
                </table>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
