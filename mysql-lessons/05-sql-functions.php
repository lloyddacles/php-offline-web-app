<?php $pageTitle = 'SQL Functions'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>SQL Functions</h1>
    <p class="lesson-desc">Aggregate and string functions to analyze and transform data.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between the <code>WHERE</code> and <code>HAVING</code> clauses?</li>
        <li>How do you count the number of rows in a table using SQL?</li>
        <li>What does <code>GROUP BY</code> do, and when would you use it?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>SQL functions are built-in operations that perform calculations on data. <strong>Aggregate functions</strong> (COUNT, SUM, AVG, MAX, MIN) operate on groups of rows and return a single value. <strong>String functions</strong> (CONCAT, UPPER, LOWER) transform text data.</p>

<h3>Analogy</h3>
<p>Think of aggregate functions as a <strong>calculator for your data</strong>. Just as a calculator can add up a list of numbers, <code>SUM()</code> adds up a column. <code>COUNT()</code> counts items, and <code>AVG()</code> finds the average. GROUP BY is like sorting items into piles before calculating.</p>

<h3>How It Works</h3>
<p>Aggregate functions scan through rows and combine them into a single result. When used with <code>GROUP BY</code>, they calculate separately for each group. The <code>HAVING</code> clause then filters those groups.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Aggregate functions
SELECT COUNT(*) AS total_employees FROM employees;
SELECT SUM(salary) AS total_salaries FROM employees;
SELECT AVG(salary) AS average_salary FROM employees;
SELECT MIN(salary) AS lowest, MAX(salary) AS highest FROM employees;

-- GROUP BY: aggregate per department
SELECT
    department,
    COUNT(*) AS employee_count,
    AVG(salary) AS avg_salary
FROM employees
GROUP BY department;

-- HAVING: filter groups
SELECT department, AVG(salary) AS avg_salary
FROM employees
GROUP BY department
HAVING avg_salary > 70000;

-- String functions
SELECT UPPER(name) AS uppercase_name FROM employees;
SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM students;
</code></pre>
<strong>Output (GROUP BY):</strong>
<pre>+-------------+----------------+-------------+
| department  | employee_count | avg_salary  |
+-------------+----------------+-------------+
| Engineering |              3 | 82333.33    |
| Marketing   |              2 | 68000.00    |
| Sales       |              2 | 56500.00    |
+-------------+----------------+-------------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Sales Reports</strong> — Total revenue, average order value, top-selling products</li>
    <li><strong>HR Analytics</strong> — Average salary by department, headcount by location</li>
    <li><strong>Inventory Management</strong> — Total stock, items below reorder level</li>
    <li><strong>Marketing</strong> — Customer segments, conversion rates by campaign</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>COUNT(*)</code> to count all rows, <code>COUNT(column)</code> to count non-NULL values</li>
    <li>Remember: <code>WHERE</code> filters rows <em>before</em> grouping, <code>HAVING</code> filters <em>after</em> grouping</li>
    <li>Use <code>AS</code> to give aggregate results meaningful names</li>
    <li>Combine <code>GROUP BY</code> with <code>ORDER BY</code> for sorted aggregate reports</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using <code>WHERE</code> with aggregate results — use <code>HAVING</code> instead</li>
    <li>Forgetting to include non-aggregated columns in <code>GROUP BY</code></li>
    <li>Confusing <code>COUNT(column)</code> (excludes NULLs) with <code>COUNT(*)</code> (counts all rows)</li>
    <li>Using <code>AVG()</code> on text columns — it only works on numeric data</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are a data analyst for a retail company. The manager wants to understand sales performance by product category.</p>
    <p><strong>Task:</strong> Write the SQL queries to complete the following:</p>
    <ol>
        <li>Find the total number of orders and total revenue across all orders</li>
        <li>Calculate the average order value for each product category</li>
        <li>List only categories where the average order value exceeds ₱5,000</li>
        <li>Find the highest and lowest individual order amounts</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Total orders and total revenue
SELECT COUNT(*) AS total_orders, SUM(amount) AS total_revenue
FROM orders;

-- 2. Average order value per category
SELECT category, AVG(amount) AS avg_order_value
FROM orders
GROUP BY category;

-- 3. Categories with average above 5000
SELECT category, AVG(amount) AS avg_order_value
FROM orders
GROUP BY category
HAVING avg_order_value > 5000;

-- 4. Highest and lowest order amounts
SELECT MAX(amount) AS highest_order, MIN(amount) AS lowest_order
FROM orders;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
