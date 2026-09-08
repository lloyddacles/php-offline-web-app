<?php $pageTitle = 'Deleting Data'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $sectionDir = 'mysql-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Deleting Data</h1>
    <p class="lesson-desc">Remove records from tables using DELETE and TRUNCATE.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between <code>DELETE</code> and <code>DROP</code>?</li>
        <li>Why should you always use a <code>WHERE</code> clause with DELETE?</li>
        <li>What does <code>TRUNCATE</code> do that <code>DELETE</code> does not?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>The <code>DELETE</code> statement removes specific rows from a table. <code>TRUNCATE</code> removes all rows and resets auto-increment counters. <code>DROP</code> deletes the entire table structure and data.</p>

<h3>Analogy</h3>
<p>Think of deleting as <strong>removing pages from a notebook</strong>. <code>DELETE</code> tears out specific pages. <code>TRUNCATE</code> rips out all pages but keeps the notebook binding. <code>DROP</code> throws away the entire notebook.</p>

<h3>How It Works</h3>
<p>DELETE finds rows matching the WHERE condition and removes them one by one. Without WHERE, all rows are deleted. TRUNCATE is faster because it deallocates data pages directly without scanning rows.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Create a students table
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    grade INT
);

-- Insert sample data
INSERT INTO students VALUES (1, 'Juan', 95), (2, 'Maria', 88);

-- Delete one student
DELETE FROM students WHERE id = 2;

-- Verify deletion
SELECT * FROM students;
</code></pre>
<strong>Output:</strong>
<pre>+----+------+-------+
| id | name | grade |
+----+------+-------+
|  1 | Juan |    95 |
+----+------+-------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>User Management</strong> — Deleting accounts that violated terms of service</li>
    <li><strong>Data Cleanup</strong> — Removing duplicate or outdated records</li>
    <li><strong>Soft Deletes</strong> — Setting a "deleted" flag instead of actually deleting rows</li>
    <li><strong>Archiving</strong> — Moving old data to archive tables before deleting from main tables</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Always SELECT first</strong> — preview which rows will be deleted</li>
    <li>Use <strong>soft deletes</strong> (add a <code>deleted_at</code> timestamp column) for recoverable data</li>
    <li>Back up important data before running DELETE or TRUNCATE</li>
    <li>Use <code>DELETE ... LIMIT</code> to delete in batches for large tables</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Running <code>DELETE FROM table</code> without WHERE — deletes ALL rows</li>
    <li>Using <code>DROP</code> when you meant <code>DELETE</code> — table structure is lost forever</li>
    <li>Not checking foreign key constraints — deleting rows referenced by other tables</li>
    <li>Using <code>TRUNCATE</code> on a table with foreign key constraints (fails in MySQL InnoDB)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You manage a blog platform. Some spam accounts need to be removed, and you need to clean up old data.</p>
    <p><strong>Task:</strong> Write the SQL commands to complete the following:</p>
    <ol>
        <li>Preview all users with email addresses containing 'spam'</li>
        <li>Delete all users whose email contains 'spam'</li>
        <li>Delete all comments that are more than 2 years old</li>
        <li>What is the difference between DELETE and TRUNCATE in this context?</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Preview spam users
SELECT * FROM users WHERE email LIKE '%spam%';

-- 2. Delete spam users
DELETE FROM users WHERE email LIKE '%spam%';

-- 3. Delete old comments (more than 2 years)
DELETE FROM comments
WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 2 YEAR);

-- 4. Answer: DELETE removes specific rows and can be rolled back in a transaction.
-- TRUNCATE removes ALL rows, resets AUTO_INCREMENT, and is faster but cannot
-- target specific rows. For cleaning up specific spam accounts, DELETE is correct
-- because we need the WHERE clause to target specific rows.</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
