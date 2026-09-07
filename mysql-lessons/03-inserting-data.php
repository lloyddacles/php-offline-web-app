<?php $pageTitle = 'Inserting Data'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Inserting Data</h1>
    <p class="lesson-desc">Add data to your tables using INSERT statements.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What SQL command do you use to add data to a table?</li>
        <li>Why is it important to specify column names in an INSERT statement?</li>
        <li>What is the difference between <code>NULL</code> and omitting a column in an INSERT?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>The <code>INSERT INTO</code> statement adds new rows of data to a table. You can insert one row at a time or multiple rows in a single command.</p>

<h3>Analogy</h3>
<p>Think of inserting data as <strong>filling out a form</strong>. Each column is a field on the form, and each row is one completed form. You can fill out one form at a time or hand in a stack of forms at once.</p>

<h3>How It Works</h3>
<p>MySQL accepts the <code>INSERT INTO</code> command with a list of columns and their corresponding values. The values must match the data types and constraints defined in the table structure.</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Create a table to work with
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(50),
    salary DECIMAL(10,2),
    hire_date DATE
);

-- Insert a single row (specify columns)
INSERT INTO employees (name, department, salary, hire_date)
VALUES ('Alice Smith', 'Engineering', 75000.00, '2024-01-15');

-- Insert multiple rows at once
INSERT INTO employees (name, department, salary, hire_date) VALUES
('Carol White', 'Engineering', 82000.00, '2023-06-10'),
('David Brown', 'Sales', 58000.00, '2024-03-01'),
('Eva Green', 'Marketing', 71000.00, '2023-11-22');

-- Verify your inserts
SELECT * FROM employees;
</code></pre>
<strong>Output:</strong>
<pre>+----+--------------+-------------+----------+------------+
| id | name         | department  | salary   | hire_date  |
+----+--------------+-------------+----------+------------+
|  1 | Alice Smith  | Engineering | 75000.00 | 2024-01-15 |
|  2 | Carol White  | Engineering | 82000.00 | 2023-06-10 |
|  3 | David Brown  | Sales       | 58000.00 | 2024-03-01 |
|  4 | Eva Green    | Marketing   | 71000.00 | 2023-11-22 |
+----+--------------+-------------+----------+------------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>User Registration</strong> — Storing new user accounts in a users table</li>
    <li><strong>E-commerce</strong> — Adding new products to a catalog</li>
    <li><strong>Content Management</strong> — Publishing new blog posts or articles</li>
    <li><strong>Data Migration</strong> — Importing bulk data from CSV files</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always <strong>specify column names</strong> — it makes code clearer and less error-prone</li>
    <li>Use <strong>multi-row INSERT</strong> for bulk data — it's faster than multiple single inserts</li>
    <li>Use <code>DEFAULT</code> values for columns that don't always need input</li>
    <li>Wrap inserts in <strong>transactions</strong> for critical data to ensure all-or-nothing behavior</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Mismatched column count and value count — the number must match exactly</li>
    <li>Inserting a duplicate value into a <code>UNIQUE</code> column</li>
    <li>Violating <code>NOT NULL</code> constraints by omitting required columns</li>
    <li>Using the wrong data type (e.g., inserting text into an INT column)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building an online quiz system. You need to populate the <code>questions</code> table with quiz questions.</p>
    <p><strong>Task:</strong> Write the SQL commands to complete the following:</p>
    <ol>
        <li>Create a <code>questions</code> table with: id, question_text (text), option_a (varchar 100), option_b (varchar 100), correct_answer (char 1), and difficulty (int, default 1)</li>
        <li>Insert 3 questions with different difficulty levels</li>
        <li>Insert 2 questions using default difficulty</li>
        <li>Verify all questions were inserted correctly</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Create the questions table
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    option_a VARCHAR(100) NOT NULL,
    option_b VARCHAR(100) NOT NULL,
    correct_answer CHAR(1) NOT NULL,
    difficulty INT DEFAULT 1
);

-- 2. Insert 3 questions with different difficulty levels
INSERT INTO questions (question_text, option_a, option_b, correct_answer, difficulty) VALUES
('What is 2 + 2?', '3', '4', 'B', 1),
('What is the capital of France?', 'London', 'Paris', 'B', 2),
('What is 7 × 8?', '54', '56', 'B', 3);

-- 3. Insert 2 questions with default difficulty
INSERT INTO questions (question_text, option_a, option_b, correct_answer) VALUES
('What color is the sky?', 'Green', 'Blue', 'B'),
('How many days in a week?', '5', '7', 'B');

-- 4. Verify
SELECT * FROM questions;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
