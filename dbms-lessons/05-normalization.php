<?php $pageTitle = 'Database Normalization'; require_once __DIR__ . '/../includes/functions.php'; $num = 5; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Database Normalization</h1>
    <p class="lesson-desc">Eliminate data redundancy and improve data integrity through normalization.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 4, you learned about keys and constraints. Why is it important that a primary key is unique and never NULL?</li>
        <li>Imagine you store a student's name, email, and department name all in one table. If the department name changes, how many rows would you need to update?</li>
        <li>What is a "dependency" between two columns? Give an example: if you know a student's ID, what else can you determine?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Normalization</strong> is the process of organizing data to reduce redundancy and improve data integrity. It involves breaking large tables into smaller, well-structured tables and defining relationships between them.</p>

<h3>Analogy</h3>
<p>Think of normalization like <strong>organizing a cluttered closet</strong>. Instead of throwing all clothes into one big pile (unnormalized), you separate them: shirts in one drawer, pants in another, socks in a third. Each item has one proper place. When you need to find something, you know exactly where to look. When you buy new pants, you put them in the pants drawer — not scattered across the closet.</p>

<h3>Why Normalize?</h3>
<ul>
    <li><strong>Reduce redundancy</strong> — Don't store the same data in multiple places</li>
    <li><strong>Prevent anomalies</strong> — Avoid insertion, update, and deletion problems</li>
    <li><strong>Improve consistency</strong> — Data changes only need to be made in one place</li>
</ul>

<h3>The Anomalies</h3>

<h4>Insertion Anomaly</h4>
<p>You can't add certain data without other unrelated data.</p>
<pre><code class="language-sql">-- BAD: All in one table
CREATE TABLE student_courses (
    student_name VARCHAR(50),
    course_name VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- PROBLEM: Cannot add a course without a student
INSERT INTO student_courses (course_name)
VALUES ('Physics');
</code></pre>
<strong>Output:</strong>
<pre>ERROR 1364: Field 'student_name' doesn't have a default value</pre>

<h4>Update Anomaly</h4>
<p>Updating one piece of data requires updating multiple rows.</p>
<pre><code>-- PROBLEM: If Dr. Newton changes name, we must update ALL rows
-- where teacher_name = 'Dr. Newton'
-- Missing even one row creates inconsistent data!</code></pre>

<h4>Deletion Anomaly</h4>
<p>Deleting one record unintentionally deletes other data.</p>
<pre><code>-- PROBLEM: If we delete the last student in a course,
-- we also lose all information about that course!</code></pre>

<h3>Example: Normalization Steps</h3>

<h4>First Normal Form (1NF)</h4>
<p><strong>Rule:</strong> Each cell must contain a single (atomic) value. No repeating groups.</p>
<pre><code class="language-sql">-- BAD: Violates 1NF (multiple values in one cell)
CREATE TABLE students_bad (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    courses TEXT    -- "Math, Science" is NOT atomic!
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- GOOD: Satisfies 1NF (each value in separate row)
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Separate table for courses (atomic values)
CREATE TABLE enrollments (
    student_id INT,
    course_name VARCHAR(50),
    PRIMARY KEY (student_id, course_name)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>Second Normal Form (2NF)</h4>
<p><strong>Rule:</strong> Must be in 1NF + every non-key column must depend on the <strong>entire</strong> primary key (not just part of it).</p>
<pre><code class="language-sql">-- BAD: Violates 2NF (course_name depends only on course_id)
CREATE TABLE enrollments_bad (
    student_id INT,
    course_id INT,
    course_name VARCHAR(50),   -- Depends on course_id ONLY
    grade VARCHAR(2),          -- Depends on BOTH keys
    PRIMARY KEY (student_id, course_id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- GOOD: Split into two tables (satisfies 2NF)
CREATE TABLE courses (
    id INT PRIMARY KEY,        -- Course identifier
    name VARCHAR(50)           -- Course name
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Enrollment now only has key-dependent columns
CREATE TABLE enrollments (
    student_id INT,
    course_id INT,
    grade VARCHAR(2),
    PRIMARY KEY (student_id, course_id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>Third Normal Form (3NF)</h4>
<p><strong>Rule:</strong> Must be in 2NF + no <strong>transitive dependencies</strong> (non-key columns shouldn't depend on other non-key columns).</p>
<pre><code class="language-sql">-- BAD: Violates 3NF (department_name depends on department_id)
CREATE TABLE employees_bad (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    department_id INT,
    department_name VARCHAR(50)  -- Transitive: id → dept_id → dept_name
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- GOOD: Separate department table (satisfies 3NF)
CREATE TABLE departments (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Employee references department by foreign key
CREATE TABLE employees (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h3>Normalization Summary</h3>
<table>
    <thead>
        <tr><th>Normal Form</th><th>Rule</th><th>Eliminates</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>1NF</strong></td><td>Atomic values, no repeating groups</td><td>Multi-valued attributes</td></tr>
        <tr><td><strong>2NF</strong></td><td>1NF + full functional dependency</td><td>Partial dependencies</td></tr>
        <tr><td><strong>3NF</strong></td><td>2NF + no transitive dependencies</td><td>Transitive dependencies</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Banking:</strong> Normalizing account and transaction data prevents inconsistencies where a customer's address might differ across tables.</li>
    <li><strong>E-commerce:</strong> Product catalogs normalized to 3NF ensure that product descriptions exist in one place, reducing storage and update anomalies.</li>
    <li><strong>Healthcare:</strong> Patient records normalized prevent dangerous inconsistencies where a patient's medical history might differ between departments.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Target 3NF for most applications:</strong> Higher normal forms are rarely needed in practice.</li>
    <li><strong>Work step by step:</strong> Start with 1NF, then move to 2NF, then 3NF.</li>
    <li><strong>Identify dependencies first:</strong> Before normalizing, map out which columns depend on which.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Over-normalizing:</strong> Splitting data into too many tables makes queries complex and slow. Stop at 3NF unless you have a specific reason to go further.</li>
    <li><strong>Ignoring anomalies:</strong> Skipping normalization leads to data corruption when records are inserted, updated, or deleted.</li>
    <li><strong>Confusing 2NF with 3NF:</strong> 2NF is about partial dependencies on composite keys; 3NF is about transitive dependencies between non-key columns.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A small clinic has one big table called <code>patient_visits</code> with these columns: visit_id, patient_name, patient_email, doctor_name, doctor_specialty, visit_date, diagnosis, medication. The clinic owner complains that when a doctor changes their specialty, they have to update many rows. Also, they can't add a new doctor without a patient visit.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Identify which anomalies (insertion, update, deletion) the clinic is experiencing.</li>
        <li>Normalize the table to 1NF, 2NF, and 3NF. For each step, explain what you changed and why.</li>
        <li>Write the CREATE TABLE statements for your final 3NF design.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>Update Anomaly:</strong> Doctor specialty is repeated in every visit row. If a doctor changes specialty, every row must be updated.</li>
                    <li><strong>Insertion Anomaly:</strong> Cannot add a new doctor without a patient visit (visit_id, visit_date, etc. would be NULL).</li>
                    <li><strong>Deletion Anomaly:</strong> If the last visit for a doctor is deleted, all information about that doctor is lost.</li>
                </ul>
            </li>
            <li>
                <ul>
                    <li><strong>1NF:</strong> Ensure all values are atomic. The current table already satisfies 1NF if each cell has one value. If "medication" contained multiple medications per visit, split into a separate table.</li>
                    <li><strong>2NF:</strong> Remove partial dependencies. patient_name and patient_email depend only on patient info (not on visit_id). Create a <code>patients</code> table. doctor_name and doctor_specialty depend only on the doctor. Create a <code>doctors</code> table.</li>
                    <li><strong>3NF:</strong> Remove transitive dependencies. If doctor_specialty depends on doctor_name (which depends on visit), create a separate <code>doctors</code> table with specialty as its own column. Final tables: patients, doctors, visits.</li>
                </ul>
            </li>
            <li>
                <pre><code class="language-sql">-- Create patients table
CREATE TABLE patients (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create doctors table
CREATE TABLE doctors (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    specialty VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create visits table (normalized to 3NF)
CREATE TABLE visits (
    id INT PRIMARY KEY,
    patient_id INT,
    doctor_id INT,
    visit_date DATE,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
