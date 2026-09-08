<?php $pageTitle = 'Relational Database Concepts'; require_once __DIR__ . '/../includes/functions.php'; $num = 4; $sectionDir = 'dbms-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); require_once __DIR__ . '/../includes/header.php'; ?>

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

<h3>What is the Relational Model?</h3>
<p>The <strong>relational model</strong>, invented by Edgar F. Codd in 1970, organizes data into <strong>tables</strong> (relations) with rows (tuples) and columns (attributes). Tables relate to each other through <strong>common columns</strong>. Keys and constraints enforce data integrity.</p>

<h3>Analogy</h3>
<p>Think of a relational database as a set of <strong>interconnected spreadsheets</strong>. Each spreadsheet (table) has a unique header row (column names). You can link spreadsheets by referencing a value from one in another.</p>

<h3>Types of Keys</h3>
<table>
    <thead>
        <tr><th>Key Type</th><th>Purpose</th><th>Example</th><th>Rules</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Primary Key (PK)</strong></td><td>Uniquely identifies each row</td><td>student_id</td><td>Unique, NOT NULL, one per table</td></tr>
        <tr><td><strong>Foreign Key (FK)</strong></td><td>Links to a primary key in another table</td><td>department_id in employees</td><td>Must reference valid PK or be NULL</td></tr>
        <tr><td><strong>Candidate Key</strong></td><td>Minimal super key (no extra columns)</td><td>id, email</td><td>Can be chosen as PK</td></tr>
        <tr><td><strong>Super Key</strong></td><td>Any set of columns that uniquely identifies a row</td><td>(id), (email), (id, name)</td><td>Contains candidate key</td></tr>
        <tr><td><strong>Alternate Key</strong></td><td>Candidate key not chosen as primary key</td><td>email (if id is PK)</td><td>Also unique</td></tr>
        <tr><td><strong>Composite Key</strong></td><td>Primary key made of multiple columns</td><td>(student_id, course_id)</td><td>Combination is unique</td></tr>
    </tbody>
</table>

<h3>Key Relationships Visual</h3>
<pre><code>┌──────────────────┐         ┌──────────────────┐
│    Students      │         │    Courses       │
├──────────────────┤         ├──────────────────┤
│ *id (PK)         │         │ *id (PK)         │
│  name            │         │  title           │
│  email           │         │  credits         │
└────────┬─────────┘         └────────┬─────────┘
         │                            │
         └────────────┬───────────────┘
                      ▼
         ┌──────────────────────────┐
         │      Enrollments         │
         ├──────────────────────────┤
         │ *student_id (FK, PK)     │  ← Composite PK
         │ *course_id  (FK, PK)     │  ← made of FKs
         │  grade                   │
         └──────────────────────────┘</code></pre>

<h3>Constraints</h3>
<table>
    <thead>
        <tr><th>Constraint</th><th>Purpose</th><th>Example</th><th>Effect</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>NOT NULL</strong></td><td>Column cannot be empty</td><td>name VARCHAR(50) NOT NULL</td><td>Insert fails if name is NULL</td></tr>
        <tr><td><strong>UNIQUE</strong></td><td>All values in column must be different</td><td>email VARCHAR(50) UNIQUE</td><td>Insert fails if email already exists</td></tr>
        <tr><td><strong>CHECK</strong></td><td>Values must satisfy a condition</td><td>CHECK (age >= 0)</td><td>Insert fails if age is negative</td></tr>
        <tr><td><strong>DEFAULT</strong></td><td>Provides a default value if none specified</td><td>status DEFAULT 'active'</td><td>Row gets 'active' if status not provided</td></tr>
        <tr><td><strong>FOREIGN KEY</strong></td><td>Links to another table's PK</td><td>dept_id REFERENCES departments(id)</td><td>Prevents orphaned records</td></tr>
    </tbody>
</table>

<h3>Integrity Rules</h3>
<table>
    <thead>
        <tr><th>Rule</th><th>Description</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Entity Integrity</strong></td><td>Primary key must be unique and NOT NULL</td><td>No two students can have id = 1</td></tr>
        <tr><td><strong>Referential Integrity</strong></td><td>Foreign keys must reference valid primary keys</td><td>Can't enroll student_id = 99 if student 99 doesn't exist</td></tr>
        <tr><td><strong>Domain Integrity</strong></td><td>Values must be of the correct type and range</td><td>salary must be a positive number</td></tr>
    </tbody>
</table>

<h3>Example: Students and Enrollments</h3>

<p><strong>Students table:</strong></p>
<table>
    <thead>
        <tr><th>id (PK)</th><th>name</th><th>email</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Alice</td><td>alice@school.edu</td></tr>
        <tr><td>2</td><td>Bob</td><td>bob@school.edu</td></tr>
    </tbody>
</table>

<p><strong>Courses table:</strong></p>
<table>
    <thead>
        <tr><th>id (PK)</th><th>title</th></tr>
    </thead>
    <tbody>
        <tr><td>101</td><td>Math</td></tr>
        <tr><td>102</td><td>Science</td></tr>
    </tbody>
</table>

<p><strong>Enrollments table (composite key + foreign keys):</strong></p>
<table>
    <thead>
        <tr><th>student_id (FK, PK)</th><th>course_id (FK, PK)</th><th>grade</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>101</td><td>A</td></tr>
        <tr><td>1</td><td>102</td><td>B</td></tr>
        <tr><td>2</td><td>101</td><td>B</td></tr>
    </tbody>
</table>

<h3>Relational Algebra (Theory)</h3>
<table>
    <thead>
        <tr><th>Operation</th><th>Symbol</th><th>SQL Equivalent</th><th>What It Does</th></tr>
    </thead>
    <tbody>
        <tr><td>Selection</td><td>σ (sigma)</td><td>WHERE</td><td>Filters rows</td></tr>
        <tr><td>Projection</td><td>π (pi)</td><td>SELECT column</td><td> Picks columns</td></tr>
        <tr><td>Union</td><td>∪</td><td>UNION</td><td>Combines two result sets</td></tr>
        <tr><td>Intersection</td><td>∩</td><td>INTERSECT</td><td>Common rows in both sets</td></tr>
        <tr><td>Difference</td><td>−</td><td>EXCEPT</td><td>Rows in first but not second</td></tr>
        <tr><td>Cartesian Product</td><td>×</td><td>CROSS JOIN</td><td>All combinations of rows</td></tr>
        <tr><td>Join</td><td>⋈</td><td>JOIN</td><td>Combines tables on related columns</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Industry</th><th>How Keys are Used</th><th>How Constraints Help</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Banking</strong></td><td>PK identifies each account; FK links transactions to accounts</td><td>Prevents negative balances with CHECK</td></tr>
        <tr><td><strong>E-commerce</strong></td><td>Composite keys in order_items link products to orders</td><td>Referential integrity ensures valid product references</td></tr>
        <tr><td><strong>Healthcare</strong></td><td>Patient IDs as PK; FK in medical_records link to doctors</td><td>NOT NULL ensures critical data is always present</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Use auto-incrementing integers for PKs</strong></td><td>Simple, efficient, and never change</td></tr>
        <tr><td><strong>Always define foreign key constraints</strong></td><td>Prevents orphaned records automatically</td></tr>
        <tr><td><strong>Use ON DELETE CASCADE carefully</strong></td><td>Convenient but can delete more data than intended</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Using natural keys as PKs</td><td>Emails, SSNs can change</td><td>Use surrogate keys (auto-increment IDs)</td></tr>
        <tr><td>Forgetting FK constraints</td><td>References to non-existent records</td><td>Always define FOREIGN KEY</td></tr>
        <tr><td>Allowing NULL primary keys</td><td>Defeats purpose of PK</td><td>PK must always be NOT NULL</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are designing a database for an online bookstore. The requirements are: each book has a unique ISBN and a title. Each author can write many books, and each book can have multiple authors. Customers place orders, and each order can contain many books.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Identify the primary key for each table: Books, Authors, Orders, and the junction table for books-authors.</li>
        <li>Explain what type of key each is and why it was chosen.</li>
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
            <li>ISBN is a natural key (real-world identifier). author_id and order_id are surrogate keys (system-generated). The junction table uses a composite key because both columns together uniquely identify each row.</li>
            <li><strong>ON DELETE CASCADE</strong> means: if a referenced row is deleted, all rows referencing it are also deleted. For book_authors, this is appropriate — if a book is deleted, its author associations should also be removed. However, if an author is deleted, you might prefer ON DELETE RESTRICT to prevent accidentally removing author records that are tied to books.</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
