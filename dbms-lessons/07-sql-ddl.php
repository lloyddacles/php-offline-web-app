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

<h3>What is DDL?</h3>
<p><strong>DDL (Data Definition Language)</strong> commands are used to define, modify, and delete database structures (tables, indexes, views). They don't manipulate data — they define the <strong>schema</strong>.</p>

<h3>Analogy</h3>
<p>DDL is like the <strong>architect and construction crew</strong> building a house. They lay the foundation (CREATE DATABASE), build the walls and rooms (CREATE TABLE), renovate rooms (ALTER TABLE), demolish structures (DROP TABLE), or clear out all the furniture while keeping the rooms (TRUNCATE TABLE).</p>

<h3>DDL Commands Quick Reference</h3>
<table>
    <thead>
        <tr><th>Command</th><th>Purpose</th><th>Reversible?</th><th>Analogy</th></tr>
    </thead>
    <tbody>
        <tr><td><code>CREATE</code></td><td>Create new database objects</td><td>Yes (DROP)</td><td>Build a new room</td></tr>
        <tr><td><code>ALTER</code></td><td>Modify existing database objects</td><td>Yes (ALTER again)</td><td>Renovate a room</td></tr>
        <tr><td><code>DROP</code></td><td>Delete database objects permanently</td><td>No</td><td>Demolish a room</td></tr>
        <tr><td><code>TRUNCATE</code></td><td>Remove all data from a table (keep structure)</td><td>No</td><td>Empty a room but keep walls</td></tr>
        <tr><td><code>RENAME</code></td><td>Rename database objects</td><td>Yes (RENAME again)</td><td>Change room name</td></tr>
    </tbody>
</table>

<h3>DDL vs DML</h3>
<table>
    <thead>
        <tr><th>Aspect</th><th>DDL</th><th>DML</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Purpose</strong></td><td>Defines structure (schema)</td><td>Manipulates data</td></tr>
        <tr><td><strong>Commands</strong></td><td>CREATE, ALTER, DROP, TRUNCATE</td><td>SELECT, INSERT, UPDATE, DELETE</td></tr>
        <tr><td><strong>Affects</strong></td><td>Tables, views, indexes</td><td>Rows in tables</td></tr>
        <tr><td><strong>Transactions</strong></td><td>Implicitly commits</td><td>Can be rolled back</td></tr>
    </tbody>
</table>

<h3>CREATE — Build New Structures</h3>
<table>
    <thead>
        <tr><th>What</th><th>Syntax</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td>Database</td><td>CREATE DATABASE name;</td><td>CREATE DATABASE school;</td></tr>
        <tr><td>Table</td><td>CREATE TABLE name (...);</td><td>CREATE TABLE students (id INT PRIMARY KEY, name VARCHAR(50));</td></tr>
        <tr><td>View</td><td>CREATE VIEW name AS ...;</td><td>CREATE VIEW honor_roll AS SELECT * FROM students WHERE grade >= 90;</td></tr>
        <tr><td>Index</td><td>CREATE INDEX name ON table(col);</td><td>CREATE INDEX idx_name ON students(name);</td></tr>
    </tbody>
</table>

<h3>ALTER — Modify Structures</h3>
<table>
    <thead>
        <tr><th>Action</th><th>Syntax</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td>Add column</td><td>ALTER TABLE t ADD col type;</td><td>ALTER TABLE students ADD phone VARCHAR(20);</td></tr>
        <tr><td>Modify column</td><td>ALTER TABLE t MODIFY col type;</td><td>ALTER TABLE students MODIFY phone VARCHAR(30);</td></tr>
        <tr><td>Drop column</td><td>ALTER TABLE t DROP col;</td><td>ALTER TABLE students DROP phone;</td></tr>
        <tr><td>Add constraint</td><td>ALTER TABLE t ADD CONSTRAINT ...;</td><td>ALTER TABLE students ADD UNIQUE(email);</td></tr>
    </tbody>
</table>

<h3>DROP vs TRUNCATE — Critical Difference</h3>
<table>
    <thead>
        <tr><th>Aspect</th><th>DROP TABLE</th><th>TRUNCATE TABLE</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>What happens</strong></td><td>Table structure AND data are permanently deleted</td><td>Only data is deleted; structure remains</td></tr>
        <tr><td><strong>Data recovery</strong></td><td>Cannot recover without backup</td><td>Cannot recover without backup</td></tr>
        <tr><td><strong>Auto-increment reset</strong></td><td>N/A (table gone)</td><td>Resets to starting value</td></tr>
        <tr><td><strong>Triggers</strong></td><td>No triggers fired</td><td>Triggers are fired</td></tr>
        <tr><td><strong>Can WHERE clause?</strong></td><td>No (deletes entire table)</td><td>No (deletes all rows)</td></tr>
    </tbody>
</table>

<h3>Example: Building a Library Database</h3>

<p><strong>Step 1: Create database</strong></p>
<table>
    <thead>
        <tr><th>Command</th><th>Result</th></tr>
    </thead>
    <tbody>
        <tr><td>CREATE DATABASE library;</td><td>New database created</td></tr>
    </tbody>
</table>

<p><strong>Step 2: Create tables</strong></p>
<table>
    <thead>
        <tr><th>Table</th><th>Columns</th><th>Constraints</th></tr>
    </thead>
    <tbody>
        <tr><td>books</td><td>isbn (PK), title, author, genre</td><td>isbn is PRIMARY KEY</td></tr>
        <tr><td>members</td><td>id (PK), name, email, join_date</td><td>email is UNIQUE</td></tr>
        <tr><td>loans</td><td>id (PK), isbn (FK), member_id (FK), loan_date, due_date</td><td>FK references books and members</td></tr>
    </tbody>
</table>

<p><strong>Step 3: Add a column later</strong></p>
<table>
    <thead>
        <tr><th>Command</th><th>Result</th></tr>
    </thead>
    <tbody>
        <tr><td>ALTER TABLE loans ADD returned_date DATE;</td><td>New column added to existing table</td></tr>
    </tbody>
</table>

<h3>Views and Indexes</h3>
<table>
    <thead>
        <tr><th>Feature</th><th>View</th><th>Index</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>What is it?</strong></td><td>Virtual table based on a query</td><td>Structure that speeds up data retrieval</td></tr>
        <tr><td><strong>Stores data?</strong></td><td>No (stores the query)</td><td>No (stores a lookup reference)</td></tr>
        <tr><td><strong>Purpose</strong></td><td>Simplify complex queries</td><td>Speed up WHERE/JOIN/ORDER BY</td></tr>
        <tr><td><strong>Trade-off</strong></td><td>Reads are simpler</td><td>Reads are faster, writes are slower</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Application</th><th>DDL Usage</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>App Development</strong></td><td>Every web app starts with DDL — creating the database and tables</td></tr>
        <tr><td><strong>Database Migrations</strong></td><td>ALTER TABLE adds new columns or constraints without losing data</td></tr>
        <tr><td><strong>Data Warehousing</strong></td><td>Views simplify complex reports by pre-defining JOINs</td></tr>
        <tr><td><strong>Performance Tuning</strong></td><td>Indexes dramatically speed up slow queries</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Always use IF EXISTS/IF NOT EXISTS</strong></td><td>Prevents errors when scripts run multiple times</td></tr>
        <tr><td><strong>Back up before DROP</strong></td><td>DROP TABLE is permanent</td></tr>
        <tr><td><strong>Use meaningful names</strong></td><td>student_enrollment_date not date1</td></tr>
        <tr><td><strong>Index strategically</strong></td><td>Index columns in WHERE/JOIN/ORDER BY, avoid over-indexing</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Confusing DROP with TRUNCATE</td><td>DROP deletes table; TRUNCATE deletes data only</td><td>Know the difference before executing</td></tr>
        <tr><td>Forgetting constraints</td><td>Invalid data enters tables</td><td>Add CHECK, UNIQUE, FK constraints</td></tr>
        <tr><td>Over-indexing</td><td>Speeds up reads but slows down writes</td><td>Only index frequently queried columns</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a library management system. Requirements: books have ISBN (PK), title, author, and genre. Members have member_id (PK), name, email, and join_date. Loans track which member borrowed which book, with loan_date and due_date. A book can be loaned many times, and a member can have many loans.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>List the DDL commands needed to create this database (database, 3 tables, and a view for overdue loans).</li>
        <li>After creating the tables, the library decides to add a "returned_date" column to the loans table. What command is needed?</li>
        <li>The library wants a view showing only overdue loans. What would this view show?</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <table>
                    <thead>
                        <tr><th>Step</th><th>Command</th><th>Purpose</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td>CREATE DATABASE library;</td><td>Create the database</td></tr>
                        <tr><td>2</td><td>CREATE TABLE books (isbn VARCHAR(20) PRIMARY KEY, title VARCHAR(100) NOT NULL, author VARCHAR(50) NOT NULL, genre VARCHAR(30));</td><td>Create books table</td></tr>
                        <tr><td>3</td><td>CREATE TABLE members (id INT PRIMARY KEY, name VARCHAR(50) NOT NULL, email VARCHAR(50) UNIQUE, join_date DATE);</td><td>Create members table</td></tr>
                        <tr><td>4</td><td>CREATE TABLE loans (id INT PRIMARY KEY, isbn VARCHAR(20), member_id INT, loan_date DATE, due_date DATE, FOREIGN KEY (isbn) REFERENCES books(isbn), FOREIGN KEY (member_id) REFERENCES members(id));</td><td>Create loans table with FKs</td></tr>
                        <tr><td>5</td><td>CREATE VIEW overdue_loans AS SELECT l.id, b.title, m.name, l.due_date FROM loans l JOIN books b ON l.isbn = b.isbn JOIN members m ON l.member_id = m.id WHERE l.due_date < CURRENT_DATE;</td><td>Create overdue loans view</td></tr>
                    </tbody>
                </table>
            </li>
            <li>ALTER TABLE loans ADD returned_date DATE;</li>
            <li>The view would show all loans where the due date is in the past and the book has not been returned yet (returned_date IS NULL or not yet added).</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
