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

<h3>Example</h3>
<pre><code>-- Create a students table with a primary key
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Primary Key: uniquely identifies each student
    email VARCHAR(100) UNIQUE NOT NULL,  -- Candidate Key: also unique, could be PK
    name VARCHAR(100) NOT NULL
);

-- Create a courses table
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    credits INT NOT NULL CHECK (credits > 0)
);

-- Create enrollments with composite PK and foreign keys
CREATE TABLE enrollments (
    student_id INT,
    course_id INT,
    grade VARCHAR(2),
    PRIMARY KEY (student_id, course_id),  -- Composite PK: combination must be unique
    FOREIGN KEY (student_id) REFERENCES students(id)
        ON DELETE CASCADE,                 -- If student is deleted, delete enrollment
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
        ON DELETE CASCADE
);

-- This violates entity integrity (duplicate PK):
-- INSERT INTO students (id, name) VALUES (1, 'Alice');
-- INSERT INTO students (id, name) VALUES (1, 'Bob');  -- ERROR!

-- This violates referential integrity (non-existent FK):
-- INSERT INTO enrollments (student_id, course_id, grade)
-- VALUES (99, 101, 'B');  -- ERROR: student 99 doesn't exist</code></pre>

<h3>Domain Constraints</h3>
<p>Each column has a defined <strong>domain</strong> (set of allowed values):</p>
<pre><code>CREATE TABLE employees (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,                  -- Must be a string, max 100 chars
    salary DECIMAL(10,2) CHECK (salary >= 0),    -- Must be non-negative
    email VARCHAR(100) UNIQUE NOT NULL,          -- Must be unique
    hire_date DATE NOT NULL,                     -- Must be a valid date
    department VARCHAR(50) DEFAULT 'Unassigned'  -- Default value if not specified
);</code></pre>

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
                <pre><code>CREATE TABLE authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    bio TEXT
);

CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0)
);

CREATE TABLE book_authors (
    isbn VARCHAR(20),
    author_id INT,
    PRIMARY KEY (isbn, author_id),
    FOREIGN KEY (isbn) REFERENCES books(isbn) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors(author_id) ON DELETE CASCADE
);</code></pre>
            </li>
            <li><strong>ON DELETE CASCADE</strong> means: if a referenced row is deleted, all rows referencing it are also deleted. For book_authors, this is appropriate — if a book is deleted, its author associations should also be removed. However, if an author is deleted, you might prefer ON DELETE RESTRICT to prevent accidentally removing author records that are tied to books.</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
