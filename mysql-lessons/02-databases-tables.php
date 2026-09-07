<?php $pageTitle = 'Databases and Tables'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 2; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Databases and Tables</h1>
    <p class="lesson-desc">Create databases and design tables with the right data types.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What SQL command do you use to create a new database?</li>
        <li>What is a primary key, and why does every table need one?</li>
        <li>What is the difference between a database and a table?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>database</strong> is a container that holds related tables. A <strong>table</strong> is a structured set of rows and columns that stores specific data. <strong>Data types</strong> define what kind of data each column can hold.</p>

<h3>Analogy</h3>
<p>Think of a database as a <strong>filing cabinet</strong>. Each drawer is a table — one for students, one for courses, one for grades. The data type of each column is like a <strong>label on a folder</strong>: it tells you what can go inside (numbers, text, dates).</p>

<h3>How It Works</h3>
<p>MySQL requires you to define the structure of your data before storing it. You create a database, then create tables inside it with specific columns and data types. This ensures data consistency and integrity.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Create a students table
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    grade INT
);

-- View the table structure
DESCRIBE students;
</code></pre>
<strong>Output:</strong>
<pre>+-------+-------------+------+-----+---------+-------+
| Field | Type        | Null | Key | Default | Extra |
+-------+-------------+------+-----+---------+-------+
| id    | int         | NO   | PRI | NULL    |       |
| name  | varchar(50) | YES  |     | NULL    |       |
| grade | int         | YES  |     | NULL    |       |
+-------+-------------+------+-----+---------+-------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Schools</strong> — Student records, courses, grades, and attendance</li>
    <li><strong>Hospitals</strong> — Patient records, appointments, and medical history</li>
    <li><strong>Stores</strong> — Inventory, sales, and customer information</li>
    <li><strong>Apps</strong> — User accounts, settings, and activity logs</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>DECIMAL</code> for money, not <code>FLOAT</code> (FLOAT is approximate)</li>
    <li>Always set a <strong>PRIMARY KEY</strong> — use <code>AUTO_INCREMENT</code> for simplicity</li>
    <li>Use <code>NOT NULL</code> for required fields to prevent missing data</li>
    <li>Run <code>DESCRIBE table_name;</code> to check your table structure anytime</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using <code>VARCHAR(255)</code> for everything — choose appropriate sizes</li>
    <li>Forgetting <code>NOT NULL</code> on required fields, allowing empty data</li>
    <li>Running <code>DROP TABLE</code> without <code>IF EXISTS</code>, causing errors on re-runs</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a library management system. You need to create a database to track books and their authors.</p>
    <p><strong>Task:</strong> Write the SQL commands to complete the following:</p>
    <ol>
        <li>Create a database called <code>library</code></li>
        <li>Create a <code>books</code> table with: id, title (varchar 200), isbn (varchar 13, unique), published_year (int), and is_available (boolean, default true)</li>
        <li>Create an <code>authors</code> table with: id, name (varchar 100), and birth_year (int)</li>
        <li>View the structure of both tables</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Create the database
CREATE DATABASE IF NOT EXISTS library;
USE library;

-- 2. Create the books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    isbn VARCHAR(13) UNIQUE NOT NULL,
    published_year INT,
    is_available BOOLEAN DEFAULT TRUE
);

-- 3. Create the authors table
CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birth_year INT
);

-- 4. View structures
DESCRIBE books;
DESCRIBE authors;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
