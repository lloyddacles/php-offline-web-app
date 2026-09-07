<?php $pageTitle = 'Relational Database Concepts'; require_once __DIR__ . '/../includes/functions.php'; $num = 4; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Relational Database Concepts</h1>
    <p class="lesson-desc">Understand keys, constraints, and the fundamental principles of relational databases.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 3, you drew ERDs with entities and relationships. What is the difference between a primary key and a foreign key?</li>
        <li>Why does each row in a database table need to be uniquely identifiable? What would happen if two rows had the same ID?</li>
        <li>Think about a student enrollment system. How do you ensure that a student can only enroll in courses that actually exist?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>The <strong>relational model</strong>, invented by Edgar F. Codd in 1970, organizes data into <strong>tables</strong> (relations) with rows (tuples) and columns (attributes). Tables relate to each other through <strong>common columns</strong>. Keys and constraints enforce data integrity.</p>

<h3>Analogy</h3>
<p>Think of a relational database as a set of <strong>interconnected spreadsheets</strong>. Each spreadsheet (table) has a unique header row (column names). You can link spreadsheets by referencing a value from one in another. For example, a "Students" spreadsheet has a Student ID, and an "Enrollments" spreadsheet references that Student ID to show which courses each student took. The rules that govern these links are called <strong>constraints</strong>.</p>

<h3>How It Works</h3>

<h4>Keys</h4>
<p>Keys are special columns used to <strong>identify</strong> and <strong>link</strong> records across tables.</p>
<table>
    <thead>
        <tr><th>Key Type</th><th>Purpose</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Primary Key (PK)</strong></td><td>Uniquely identifies each row</td><td><code>student_id</code></td></tr>
        <tr><td><strong>Foreign Key (FK)</strong></td><td>Links to a primary key in another table</td><td><code>department_id</code> in employees</td></tr>
        <tr><td><strong>Composite Key</strong></td><td>Primary key made of multiple columns</td><td>(<code>student_id</code>, <code>course_id</code>)</td></tr>
        <tr><td><strong>Super Key</strong></td><td>Any set of columns that uniquely identifies a row</td><td>(<code>id</code>), (<code>email</code>), (<code>id</code>, <code>name</code>)</td></tr>
        <tr><td><strong>Candidate Key</strong></td><td>Minimal super key (no extra columns)</td><td><code>id</code>, <code>email</code></td></tr>
        <tr><td><strong>Alternate Key</strong></td><td>Candidate key not chosen as primary key</td><td><code>email</code> (if <code>id</code> is PK)</td></tr>
    </tbody>
</table>

<h4>Primary Key Rules</h4>
<ul>
    <li>Must be <strong>unique</strong> — no two rows can have the same PK value</li>
    <li>Must <strong>never be NULL</strong></li>
    <li>Each table can have only <strong>one</strong> primary key</li>
    <li>Should be <strong>immutable</strong> — avoid changing PK values</li>
</ul>

<h4>Entity Integrity</h4>
<p>The primary key must be unique and not null. This ensures every row can be uniquely identified.</p>

<h4>Referential Integrity</h4>
<p>Foreign keys must reference valid primary keys, or be NULL. This prevents "orphaned" records.</p>

<h3>Examples</h3>

<p><strong>1. Primary Key</strong></p>
<pre><code class="language-sql">-- Create students table with a primary key
CREATE TABLE students (
    id INT PRIMARY KEY,    -- Unique identifier for each row
    name VARCHAR(50)       -- Student name
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<p><strong>2. Foreign Key</strong></p>
<pre><code class="language-sql">-- Create courses table
CREATE TABLE courses (
    id INT PRIMARY KEY,       -- Unique course ID
    title VARCHAR(50)         -- Course title
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create enrollments linking students to courses
CREATE TABLE enrollments (
    student_id INT,           -- References students table
    course_id INT,            -- References courses table
    grade VARCHAR(2),         -- Grade earned
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<p><strong>3. Composite Key</strong></p>
<pre><code class="language-sql">-- Insert two students
INSERT INTO students VALUES (1, 'Alice');
INSERT INTO students VALUES (2, 'Bob');
</code></pre>
<pre>Query OK, 2 rows affected</pre>

<pre><code class="language-sql">-- Insert courses
INSERT INTO courses VALUES (101, 'Math');
INSERT INTO courses VALUES (102, 'Science');
</code></pre>
<pre>Query OK, 2 rows affected</pre>

<pre><code class="language-sql">-- Enroll students (composite key: student_id + course_id)
INSERT INTO enrollments VALUES (1, 101, 'A');
INSERT INTO enrollments VALUES (1, 102, 'B');
INSERT INTO enrollments VALUES (2, 101, 'B');
</code></pre>
<strong>Output:</strong>
<pre>+------------+-----------+-------+
| student_id | course_id | grade |
+------------+-----------+-------+
|          1 |       101 | A     |
|          1 |       102 | B     |
|          2 |       101 | B     |
+------------+-----------+-------+</pre>

<p><strong>4. Entity Integrity (PK cannot be duplicate)</strong></p>
<pre><code class="language-sql">-- This fails: duplicate primary key
INSERT INTO students VALUES (1, 'Charlie');
</code></pre>
<strong>Output:</strong>
<pre>ERROR 1062: Duplicate entry '1' for key 'PRIMARY'</pre>

<p><strong>5. Referential Integrity (FK must exist)</strong></p>
<pre><code class="language-sql">-- This fails: student 99 does not exist
INSERT INTO enrollments VALUES (99, 101, 'A');
</code></pre>
<strong>Output:</strong>
<pre>ERROR 1452: Cannot add or update a child row:
a foreign key constraint fails</pre>

<h3>Domain Constraints</h3>
<p>Each column has a defined <strong>domain</strong> (set of allowed values):</p>
<pre><code class="language-sql">-- Create employees with domain constraints
CREATE TABLE employees (
    id INT PRIMARY KEY,              -- Must be an integer
    name VARCHAR(50) NOT NULL,       -- Must be text, max 50 chars
    salary DECIMAL(10,2) CHECK (salary >= 0),  -- Must be non-negative
    email VARCHAR(50) UNIQUE         -- Must be unique
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h3>Relational Algebra (Theory)</h3>
<p>The mathematical foundation of SQL operations:</p>
<table>
    <thead>
        <tr><th>Operation</th><th>Symbol</th><th>SQL Equivalent</th></tr>
    </thead>
    <tbody>
        <tr><td>Selection</td><td>σ (sigma)</td><td><code>WHERE</code></td></tr>
        <tr><td>Projection</td><td>π (pi)</td><td><code>SELECT column</code></td></tr>
        <tr><td>Union</td><td>∪</td><td><code>UNION</code></td></tr>
        <tr><td>Intersection</td><td>∩</td><td><code>INTERSECT</code></td></tr>
        <tr><td>Difference</td><td>−</td><td><code>EXCEPT</code></td></tr>
        <tr><td>Cartesian Product</td><td>×</td><td><code>CROSS JOIN</code></td></tr>
        <tr><td>Join</td><td>⋈</td><td><code>JOIN</code></td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Banking:</strong> Primary keys identify each account; foreign keys link transactions to accounts. Constraints prevent negative balances.</li>
    <li><strong>E-commerce:</strong> Composite keys in order_items link products to orders. Referential integrity ensures you can't order a product that doesn't exist.</li>
    <li><strong>Healthcare:</strong> Patient IDs serve as primary keys; foreign keys in medical_records link patients to doctors and diagnoses.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Use auto-incrementing integers for PKs:</strong> They're simple, efficient, and never change.</li>
    <li><strong>Always define foreign key constraints:</strong> They prevent orphaned records and maintain data integrity automatically.</li>
    <li><strong>Use ON DELETE CASCADE carefully:</strong> It's convenient but can delete more data than intended if misused.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Using natural keys as primary keys:</strong> Emails, names, or SSNs can change. Use surrogate keys (auto-increment IDs) instead.</li>
    <li><strong>Forgetting foreign key constraints:</strong> Without them, you can insert references to non-existent records, breaking data integrity.</li>
    <li><strong>Allowing NULL primary keys:</strong> A PK must never be NULL — it defeats the purpose of uniquely identifying rows.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are designing a database for an online bookstore. The requirements are: each book has a unique ISBN and a title. Each author can write many books, and each book can have multiple authors. Customers place orders, and each order can contain many books.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Identify the primary key for each table: Books, Authors, Orders, and the junction table for books-authors.</li>
        <li>Write the CREATE TABLE statements for the Books and Authors tables, including the junction table with proper foreign keys.</li>
        <li>Explain what ON DELETE CASCADE means and whether you would use it for the book-author relationship.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>Books:</strong> ISBN (primary key — unique identifier for each book)</li>
                    <li><strong>Authors:</strong> author_id (auto-increment integer, primary key)</li>
                    <li><strong>Orders:</strong> order_id (auto-increment integer, primary key)</li>
                    <li><strong>Book_Authors (junction):</strong> (ISBN, author_id) composite primary key</li>
                </ul>
            </li>
            <li>
                <pre><code class="language-sql">-- Create authors table
CREATE TABLE authors (
    id INT PRIMARY KEY,         -- Unique author ID
    name VARCHAR(50)            -- Author name
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create books table
CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,   -- Unique book identifier
    title VARCHAR(50),              -- Book title
    price DECIMAL(10,2)             -- Book price
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Junction table for book-author relationship
CREATE TABLE book_authors (
    isbn VARCHAR(20),
    author_id INT,
    PRIMARY KEY (isbn, author_id),
    FOREIGN KEY (isbn) REFERENCES books(isbn),
    FOREIGN KEY (author_id) REFERENCES authors(id)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>
            </li>
            <li><strong>ON DELETE CASCADE</strong> means: if a referenced row is deleted, all rows referencing it are also deleted. For book_authors, this is appropriate — if a book is deleted, its author associations should also be removed. However, if an author is deleted, you might prefer ON DELETE RESTRICT to prevent accidentally removing author records that are tied to books.</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
