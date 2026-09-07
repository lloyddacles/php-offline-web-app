<?php $pageTitle = 'Selecting Data'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Selecting Data</h1>
    <p class="lesson-desc">Retrieve data from tables using SELECT statements.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What does the <code>SELECT</code> statement do in SQL?</li>
        <li>What is the difference between <code>SELECT *</code> and <code>SELECT column1, column2</code>?</li>
        <li>How do you filter rows in a SELECT statement?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>The <code>SELECT</code> statement retrieves data from one or more tables. You can filter results with <code>WHERE</code>, sort them with <code>ORDER BY</code>, and limit them with <code>LIMIT</code>.</p>

<h3>Analogy</h3>
<p>Think of SELECT as <strong>asking a librarian a question</strong>. You can ask for all books (<code>SELECT *</code>), only books by a certain author (<code>WHERE</code>), books sorted by title (<code>ORDER BY</code>), or just the first 5 results (<code>LIMIT</code>).</p>

<h3>How It Works</h3>
<p>MySQL processes SELECT statements in this order: FROM → WHERE → GROUP BY → HAVING → SELECT → ORDER BY → LIMIT. The WHERE clause filters rows before they are returned.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Create a students table
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    grade INT
);

-- Insert sample data
INSERT INTO students VALUES (1, 'Juan', 95), (2, 'Maria', 88), (3, 'Pedro', 92);

-- Find students with grade above 90
SELECT * FROM students WHERE grade > 90;
</code></pre>
<strong>Output:</strong>
<pre>+----+-------+-------+
| id | name  | grade |
+----+-------+-------+
|  1 | Juan  |    95 |
|  3 | Pedro |    92 |
+----+-------+-------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Search Functions</strong> — Finding products, users, or records by name or category</li>
    <li><strong>Reports</strong> — Generating lists of top sellers, recent orders, or overdue payments</li>
    <li><strong>Dashboards</strong> — Displaying filtered, sorted data for business insights</li>
    <li><strong>Pagination</strong> — Showing results page by page using LIMIT and OFFSET</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use <code>LIMIT</code> when exploring large tables to avoid overwhelming output</li>
    <li>Use <code>AS</code> to rename columns in output for clarity</li>
    <li>Combine <code>WHERE</code> with <code>AND</code>/<code>OR</code>/<code>NOT</code> for complex filters</li>
    <li>Use <code>IS NULL</code> and <code>IS NOT NULL</code> — never use <code>= NULL</code></li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using <code>= NULL</code> instead of <code>IS NULL</code> — NULL comparisons never work with equals</li>
    <li>Forgetting <code>ORDER BY</code> — results appear in arbitrary order without it</li>
    <li>Using <code>SELECT *</code> in production code — select only needed columns</li>
    <li>Applying functions to indexed columns (e.g., <code>WHERE YEAR(date) = 2024</code>), which prevents index usage</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You manage a customer database for a retail store. The manager needs specific information from the customers table.</p>
    <p><strong>Task:</strong> Write the SQL queries to complete the following:</p>
    <ol>
        <li>List all customers who live in 'Manila', sorted by last name ascending</li>
        <li>Find all customers whose email contains the word 'gmail'</li>
        <li>Get the 5 most recently registered customers</li>
        <li>List customers who have no phone number on file</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Customers in Manila, sorted by last name
SELECT * FROM customers
WHERE city = 'Manila'
ORDER BY last_name ASC;

-- 2. Customers with gmail addresses
SELECT * FROM customers
WHERE email LIKE '%gmail%';

-- 3. 5 most recent customers
SELECT * FROM customers
ORDER BY created_at DESC
LIMIT 5;

-- 4. Customers with no phone number
SELECT * FROM customers
WHERE phone IS NULL;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
