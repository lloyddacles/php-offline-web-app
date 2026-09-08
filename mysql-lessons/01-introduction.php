<?php $pageTitle = 'Introduction to MySQL'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $sectionDir = 'mysql-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to MySQL</h1>
    <p class="lesson-desc">Learn what MySQL is, why it matters, and how to get started.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a database, and how is it different from a spreadsheet?</li>
        <li>What does SQL stand for, and what is it used for?</li>
        <li>Can you name two popular websites that use MySQL?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>MySQL is the world's most popular <strong>open-source relational database management system (RDBMS)</strong>. It stores and organizes data in tables and uses <strong>SQL</strong> (Structured Query Language) to manage that data.</p>

<h3>Analogy</h3>
<p>Think of MySQL as a <strong>digital filing cabinet</strong>. The cabinet holds folders (databases), each folder contains sheets (tables), and each sheet has rows and columns of information. SQL is the language you use to ask the filing cabinet to find, add, change, or remove information.</p>

<h3>How It Works</h3>
<ol>
    <li>You write <strong>SQL statements</strong> (commands)</li>
    <li>Send them to the <strong>MySQL server</strong></li>
    <li>The server processes them and returns <strong>results</strong></li>
</ol>

<h3>Example</h3>
<pre><code class="language-sql">-- Create a students table
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    grade INT
);

-- Insert sample data
INSERT INTO students VALUES (1, 'Juan', 95);
INSERT INTO students VALUES (2, 'Maria', 88);

-- Find all students with grade above 90
SELECT * FROM students WHERE grade > 90;
</code></pre>
<strong>Output:</strong>
<pre>+----+-------+-------+
| id | name  | grade |
+----+-------+-------+
|  1 | Juan  |    95 |
+----+-------+-------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>WordPress</strong> — Stores all blog posts, users, and comments in MySQL</li>
    <li><strong>E-commerce</strong> — Manages products, orders, and customer data</li>
    <li><strong>Social Media</strong> — Handles user profiles, posts, and connections</li>
    <li><strong>Banking</strong> — Tracks accounts, transactions, and balances</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always remember your <strong>root password</strong> when installing MySQL</li>
    <li>Start with XAMPP or MAMP for a quick, bundled setup</li>
    <li>SQL keywords are <strong>case-insensitive</strong>, but table/column names may be case-sensitive</li>
    <li>Practice using the command line — it builds deeper understanding</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Confusing <strong>database</strong> (collection of tables) with <strong>table</strong> (single sheet of data)</li>
    <li>Forgetting to run <code>USE database_name;</code> before creating tables</li>
    <li>Not backing up the root password during installation</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are setting up a new online bookstore. You need to create a database to store book information.</p>
    <p><strong>Task:</strong> Write the SQL commands to complete the following:</p>
    <ol>
        <li>Create a database called <code>bookstore</code></li>
        <li>Select the <code>bookstore</code> database for use</li>
        <li>Create a table called <code>books</code> with columns: id (auto-increment primary key), title (varchar 200), author (varchar 100), price (decimal), and created_at (timestamp)</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Create the database
CREATE DATABASE bookstore;

-- 2. Select it for use
USE bookstore;

-- 3. Create the books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    author VARCHAR(100) NOT NULL,
    price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
