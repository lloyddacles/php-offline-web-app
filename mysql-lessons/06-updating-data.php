<?php $pageTitle = 'Updating Data'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Updating Data</h1>
    <p class="lesson-desc">Modify existing records using UPDATE statements.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What SQL command is used to modify existing data in a table?</li>
        <li>Why is the <code>WHERE</code> clause critical in an UPDATE statement?</li>
        <li>How can you preview which rows will be affected before running an UPDATE?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>The <code>UPDATE</code> statement modifies existing rows in a table. You specify which columns to change with <code>SET</code> and which rows to change with <code>WHERE</code>.</p>

<h3>Analogy</h3>
<p>Think of UPDATE as <strong>editing a spreadsheet</strong>. You find the rows you want to change (WHERE), then overwrite specific cells with new values (SET). Without a WHERE clause, you'd be editing every single row — like changing every student's grade at once!</p>

<h3>How It Works</h3>
<p>MySQL finds all rows matching the WHERE condition, then applies the new values from the SET clause. If no WHERE is specified, ALL rows are updated.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Update a single row
UPDATE employees
SET salary = 80000
WHERE name = 'Alice Smith';

-- Update multiple columns
UPDATE employees
SET salary = 72000, department = 'Senior Marketing'
WHERE name = 'Bob Jones';

-- Update with expressions (5% raise for Engineering)
UPDATE employees
SET salary = salary * 1.05
WHERE department = 'Engineering';

-- Preview before updating (ALWAYS do this first!)
SELECT * FROM employees WHERE department = 'Sales';
-- Check the results, then run the UPDATE with the same WHERE
</code></pre>
<strong>Output (preview):</strong>
<pre>+----+-------------+----------+----------+------------+
| id | name        | department | salary | hire_date  |
+----+-------------+----------+----------+------------+
|  4 | David Brown | Sales    | 58000.00 | 2024-03-01 |
|  7 | Grace Kim   | Sales    | 55000.00 | NULL       |
+----+-------------+----------+----------+------------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Price Changes</strong> — Updating product prices during a sale</li>
    <li><strong>Status Updates</strong> — Marking orders as "shipped" or "delivered"</li>
    <li><strong>User Profiles</strong> — Allowing users to change their email or password</li>
    <li><strong>Bulk Adjustments</strong> — Giving all employees a raise or updating department assignments</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Always run SELECT first</strong> with the same WHERE to preview affected rows</li>
    <li>Use <code>UPDATE ... LIMIT</code> to cap the number of rows changed (MySQL 8+)</li>
    <li>Wrap updates in a <strong>transaction</strong> so you can rollback if something goes wrong</li>
    <li>Use <code>CASE</code> statements for conditional updates on different rows</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting the <code>WHERE</code> clause — updates EVERY row in the table</li>
    <li>Using the wrong data type in SET (e.g., putting text in a numeric column)</li>
    <li>Not backing up data before running bulk updates</li>
    <li>Updating a primary key that other tables reference (breaks foreign keys)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You manage a student records system. The school is giving all IT students a scholarship, and you need to update their records.</p>
    <p><strong>Task:</strong> Write the SQL commands to complete the following:</p>
    <ol>
        <li>Preview all students enrolled in 'BSIT'</li>
        <li>Give all BSIT students a 10% tuition discount (reduce tuition_fee by 10%)</li>
        <li>Change the status of student with id=5 to 'Scholar'</li>
        <li>Update the contact number of student 'Maria Santos' to '09171234567'</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Preview BSIT students
SELECT * FROM students WHERE course = 'BSIT';

-- 2. Give BSIT students 10% tuition discount
UPDATE students
SET tuition_fee = tuition_fee * 0.90
WHERE course = 'BSIT';

-- 3. Change status of student id=5
UPDATE students
SET status = 'Scholar'
WHERE id = 5;

-- 4. Update contact number
UPDATE students
SET contact_number = '09171234567'
WHERE first_name = 'Maria' AND last_name = 'Santos';</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
