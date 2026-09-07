<?php $pageTitle = 'SQL Data Definition Language'; require_once __DIR__ . '/../includes/functions.php'; $num = 7; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>SQL Data Definition Language (DDL)</h1>
    <p class="lesson-desc">Define and manage database structure using DDL commands.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lessons 5-6, you learned about normalization. When you design a normalized schema, what is the next step before you can start inserting data?</li>
        <li>What is the difference between defining the structure of a database (schema) and manipulating the data inside it?</li>
        <li>Think about building a house. What comes first: pouring the foundation and framing the walls, or furnishing the rooms? How does this relate to DDL vs DML?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>DDL (Data Definition Language)</strong> commands are used to define, modify, and delete database structures (tables, indexes, views). They don't manipulate data — they define the <strong>schema</strong>.</p>

<h3>Analogy</h3>
<p>DDL is like the <strong>architect and construction crew</strong> building a house. They lay the foundation (CREATE DATABASE), build the walls and rooms (CREATE TABLE), renovate rooms (ALTER TABLE), demolish structures (DROP TABLE), or clear out all the furniture while keeping the rooms (TRUNCATE TABLE). They don't arrange the furniture inside — that's DML's job.</p>

<h3>How It Works</h3>
<table>
    <thead>
        <tr><th>Command</th><th>Purpose</th></tr>
    </thead>
    <tbody>
        <tr><td><code>CREATE</code></td><td>Create new database objects</td></tr>
        <tr><td><code>ALTER</code></td><td>Modify existing database objects</td></tr>
        <tr><td><code>DROP</code></td><td>Delete database objects</td></tr>
        <tr><td><code>TRUNCATE</code></td><td>Remove all data from a table (keep structure)</td></tr>
        <tr><td><code>RENAME</code></td><td>Rename database objects</td></tr>
    </tbody>
</table>

<h3>Example</h3>

<h4>CREATE DATABASE</h4>
<pre><code class="language-sql">-- Create a new database
CREATE DATABASE university;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 1 row affected</pre>

<pre><code class="language-sql">-- Create only if it doesn't exist
CREATE DATABASE IF NOT EXISTS university;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 1 row affected, 1 warning</pre>

<pre><code class="language-sql">-- Select a database to use
USE university;
</code></pre>
<strong>Output:</strong>
<pre>Database changed</pre>

<h4>CREATE TABLE</h4>
<pre><code class="language-sql">-- Create a students table with constraints
CREATE TABLE students (
    id INT PRIMARY KEY,              -- Unique identifier
    name VARCHAR(50) NOT NULL,       -- Required name
    email VARCHAR(50) UNIQUE,        -- Must be unique
    grade INT CHECK (grade >= 0)     -- Must be non-negative
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>ALTER TABLE</h4>
<pre><code class="language-sql">-- Add a column
ALTER TABLE students ADD phone VARCHAR(20);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Modify column type
ALTER TABLE students MODIFY phone VARCHAR(30);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Drop a column
ALTER TABLE students DROP phone;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>DROP TABLE</h4>
<pre><code class="language-sql">-- Delete a table permanently
DROP TABLE students;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Delete only if it exists
DROP TABLE IF EXISTS students;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected, 1 warning</pre>

<h4>TRUNCATE TABLE</h4>
<pre><code class="language-sql">-- Remove all rows, keep structure
TRUNCATE TABLE students;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>Views</h4>
<pre><code class="language-sql">-- Create a view (virtual table)
CREATE VIEW active_students AS
SELECT id, name, grade
FROM students
WHERE grade >= 90;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Use the view like a table
SELECT * FROM active_students;
</code></pre>
<strong>Output:</strong>
<pre>+----+-------+-------+
| id | name  | grade |
+----+-------+-------+
|  1 | Alice |    90 |
+----+-------+-------+</pre>

<pre><code class="language-sql">-- Delete a view
DROP VIEW IF EXISTS active_students;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>Indexes</h4>
<pre><code class="language-sql">-- Create an index (speeds up queries)
CREATE INDEX idx_name ON students(name);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Drop an index
DROP INDEX idx_name ON students;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h3>DDL vs DML</h3>
<table>
    <thead>
        <tr><th>DDL</th><th>DML</th></tr>
    </thead>
    <tbody>
        <tr><td>Defines structure (schema)</td><td>Manipulates data</td></tr>
        <tr><td>CREATE, ALTER, DROP</td><td>SELECT, INSERT, UPDATE, DELETE</td></tr>
        <tr><td>Affects tables, views, indexes</td><td>Affects rows in tables</td></tr>
        <tr><td>Implicitly commits</td><td>Can be rolled back (in transactions)</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Application Development:</strong> Every web app starts with DDL — creating the database and tables before any data is inserted.</li>
    <li><strong>Database Migrations:</strong> When requirements change, ALTER TABLE adds new columns or constraints without losing existing data.</li>
    <li><strong>Data Warehousing:</strong> Views simplify complex reports by pre-defining JOINs and aggregations.</li>
    <li><strong>Performance Tuning:</strong> Indexes created with DDL dramatically speed up slow queries.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Always use IF EXISTS/IF NOT EXISTS:</strong> Prevents errors when scripts run multiple times.</li>
    <li><strong>Back up before DROP:</strong> DROP TABLE is permanent. Always have a backup.</li>
    <li><strong>Use meaningful names:</strong> Table and column names should describe their content (e.g., <code>student_enrollment_date</code> not <code>date1</code>).</li>
    <li><strong>Index strategically:</strong> Index columns used in WHERE, JOIN, and ORDER BY clauses, but avoid over-indexing (slows down writes).</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Confusing DROP with TRUNCATE:</strong> DROP removes the table structure entirely; TRUNCATE keeps the structure but removes all data.</li>
    <li><strong>Forgetting constraints:</strong> Without CHECK, UNIQUE, or FOREIGN KEY constraints, invalid data can enter your tables.</li>
    <li><strong>Over-indexing:</strong> Every index speeds up reads but slows down writes. Only index columns that are frequently queried.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a library management system. You need to create a database with tables for books, members, and loans. Requirements: books have ISBN (PK), title, author, and genre. Members have member_id (PK), name, email, and join_date. Loans track which member borrowed which book, with loan_date and due_date. A book can be loaned many times, and a member can have many loans.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Write the CREATE DATABASE and USE statements.</li>
        <li>Write the CREATE TABLE statements for all three tables with proper primary keys, foreign keys, and constraints.</li>
        <li>After creating the tables, the library decides to add a "returned_date" column to the loans table. Write the ALTER TABLE statement.</li>
        <li>Create a view called "overdue_loans" that shows all loans where due_date is in the past and returned_date is NULL.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <pre><code class="language-sql">-- Create library database
CREATE DATABASE IF NOT EXISTS library;
USE library;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 1 row affected</pre>

<pre><code class="language-sql">-- Create books table
CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create members table
CREATE TABLE members (
    id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create loans table
CREATE TABLE loans (
    id INT PRIMARY KEY,
    isbn VARCHAR(20),
    member_id INT,
    loan_date DATE,
    due_date DATE,
    FOREIGN KEY (isbn) REFERENCES books(isbn),
    FOREIGN KEY (member_id) REFERENCES members(id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Add returned_date column
ALTER TABLE loans ADD returned_date DATE;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create overdue_loans view
CREATE VIEW overdue_loans AS
SELECT l.id, b.title, m.name, l.due_date
FROM loans l
JOIN books b ON l.isbn = b.isbn
JOIN members m ON l.member_id = m.id
WHERE l.due_date < CURRENT_DATE AND l.returned_date IS NULL;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
