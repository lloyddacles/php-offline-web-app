<?php $pageTitle = 'MySQL JOINs'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>MySQL JOINs</h1>
    <p class="lesson-desc">Combine data from multiple tables using different types of joins.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Why do we split data into multiple tables instead of one big table?</li>
        <li>What is a foreign key, and how does it relate two tables?</li>
        <li>What happens to a query result when a column contains NULL values?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>JOIN</strong> combines rows from two or more tables based on a related column. <code>INNER JOIN</code> returns only matching rows. <code>LEFT JOIN</code> returns all rows from the left table plus matches. <code>RIGHT JOIN</code> returns all rows from the right table plus matches.</p>

<h3>Analogy</h3>
<p>Think of JOINs as <strong>matching two columns in a Venn diagram</strong>. INNER JOIN is the overlapping section. LEFT JOIN is the entire left circle plus the overlap. RIGHT JOIN is the entire right circle plus the overlap.</p>

<h3>How It Works</h3>
<p>MySQL compares rows from both tables using the ON condition. When a match is found, the rows are combined. The type of JOIN determines which non-matching rows are included.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Sample tables
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    building VARCHAR(50)
);

INSERT INTO departments (name, building) VALUES
('Engineering', 'Building A'),
('Marketing', 'Building B'),
('Sales', 'Building C'),
('HR', 'Building D');

-- INNER JOIN: only employees with a matching department
SELECT e.name, e.salary, d.name AS department, d.building
FROM employees e
INNER JOIN departments d ON e.department_id = d.id;

-- LEFT JOIN: all employees, even those without a department
SELECT e.name, d.name AS department
FROM employees e
LEFT JOIN departments d ON e.department_id = d.id;

-- RIGHT JOIN: all departments, even those with no employees
SELECT d.name AS department, e.name AS employee
FROM employees e
RIGHT JOIN departments d ON e.department_id = d.id;
</code></pre>
<strong>Output (RIGHT JOIN):</strong>
<pre>+-------------+--------------+
| department  | employee     |
+-------------+--------------+
| Engineering | Alice Smith  |
| Engineering | Carol White  |
| Marketing   | Bob Jones    |
| Sales       | David Brown  |
| Sales       | Grace Kim    |
| HR          | NULL         |
+-------------+--------------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>E-commerce</strong> — JOIN orders with customers to show who bought what</li>
    <li><strong>Schools</strong> — JOIN students with their grades and courses</li>
    <li><strong>HR Systems</strong> — JOIN employees with their departments and managers</li>
    <li><strong>Reporting</strong> — Combine data from multiple tables for dashboards</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <strong>table aliases</strong> (e.g., <code>e</code> for employees) to keep queries short</li>
    <li>Always specify the <strong>JOIN type</strong> (INNER, LEFT, etc.) — don't rely on default behavior</li>
    <li>Use <code>LEFT JOIN ... WHERE right_table.id IS NULL</code> to find unmatched rows</li>
    <li>Index the columns used in JOIN conditions for better performance</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting the <code>ON</code> condition — produces a Cartesian product (every row paired with every other row)</li>
    <li>Using INNER JOIN when you need LEFT JOIN — missing rows with no matches</li>
    <li>Joining on columns with different data types — causes unexpected results</li>
    <li>Not aliasing tables in multi-table queries — ambiguous column names</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You manage a school database with three tables: <code>students</code>, <code>courses</code>, and <code>enrollments</code> (which links students to courses with a grade).</p>
    <p><strong>Task:</strong> Write the SQL queries to complete the following:</p>
    <ol>
        <li>List all students with their enrolled course names and grades (use INNER JOIN)</li>
        <li>List all courses and any students enrolled in them, including courses with no students (use LEFT JOIN)</li>
        <li>Find all students who are NOT enrolled in any course</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Students with their courses and grades
SELECT s.first_name, s.last_name, c.course_name, e.grade
FROM students s
INNER JOIN enrollments e ON s.id = e.student_id
INNER JOIN courses c ON e.course_id = c.id;

-- 2. All courses with enrolled students (including empty courses)
SELECT c.course_name, s.first_name, s.last_name, e.grade
FROM courses c
LEFT JOIN enrollments e ON c.id = e.course_id
LEFT JOIN students s ON e.student_id = s.id;

-- 3. Students not enrolled in any course
SELECT s.first_name, s.last_name
FROM students s
LEFT JOIN enrollments e ON s.id = e.student_id
WHERE e.student_id IS NULL;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
