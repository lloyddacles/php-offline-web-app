<?php $pageTitle = 'Introduction to DBMS'; require_once __DIR__ . '/../includes/functions.php'; $num = 1; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to DBMS</h1>
    <p class="lesson-desc">What is a Database Management System, why do we need one, and what types exist?</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Have you ever saved data in a text file or spreadsheet? What problems did you encounter when the file grew large or multiple people needed to access it?</li>
        <li>What is the difference between raw data (e.g., a list of numbers) and information (e.g., a class average)?</li>
        <li>Can you name one software application you use daily that likely stores data in a database behind the scenes?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>Database Management System (DBMS)</strong> is software that allows you to create, manage, and interact with databases. It acts as an intermediary between users and the database, ensuring data is stored efficiently, consistently, and securely.</p>

<h3>Analogy</h3>
<p>Think of a DBMS as a <strong>librarian</strong>. You don't search the shelves yourself — you tell the librarian what you need, and they retrieve it efficiently. The librarian also enforces rules (only library members can borrow books, overdue books incur fines) and keeps the catalog up to date. Without the librarian, you'd be lost in a chaotic warehouse of books.</p>

<h3>Why Do We Need a DBMS?</h3>
<p>Before DBMS, data was stored in flat files (text files, spreadsheets). This caused many problems:</p>
<table>
    <thead>
        <tr><th>Problem</th><th>Without DBMS</th><th>With DBMS</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Data Redundancy</strong></td><td>Same data duplicated in multiple files</td><td>Data stored once, shared efficiently</td></tr>
        <tr><td><strong>Data Inconsistency</strong></td><td>Same data differs across files</td><td>Single source of truth</td></tr>
        <tr><td><strong>Data Isolation</strong></td><td>Data scattered in different formats</td><td>Unified data storage</td></tr>
        <tr><td><strong>Security</strong></td><td>Little or no access control</td><td>Granular access permissions</td></tr>
        <tr><td><strong>Integrity</strong></td><td>No validation rules</td><td>Constraints enforce data quality</td></tr>
    </tbody>
</table>

<h3>Key DBMS Concepts</h3>
<table>
    <thead>
        <tr><th>Concept</th><th>Description</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Data</strong></td><td>Raw facts and figures</td></tr>
        <tr><td><strong>Database (DB)</strong></td><td>Organized collection of related data</td></tr>
        <tr><td><strong>DBMS</strong></td><td>Software to manage the database</td></tr>
        <tr><td><strong>Schema</strong></td><td>The structure/design of the database</td></tr>
        <tr><td><strong>Query</strong></td><td>A request to retrieve or manipulate data</td></tr>
        <tr><td><strong>Table (Relation)</strong></td><td>A collection of rows and columns</td></tr>
        <tr><td><strong>Record (Tuple)</strong></td><td>A single row in a table</td></tr>
        <tr><td><strong>Field (Attribute)</strong></td><td>A single column in a table</td></tr>
    </tbody>
</table>

<h3>How It Works</h3>
<pre><code>┌─────────────────────────────────────────┐
│           Users / Applications          │
├─────────────────────────────────────────┤
│            DBMS Software                │
│  ┌───────────┬───────────┬───────────┐  │
│  │ Query     │ Storage   │ Security  │  │
│  │ Processor │ Manager   │ Manager   │  │
│  └───────────┴───────────┴───────────┘  │
├─────────────────────────────────────────┤
│           Database Files                │
└─────────────────────────────────────────┘</code></pre>

<h3>Types of Databases</h3>
<h4>1. Relational Database (RDBMS)</h4>
<p>Data is organized into <strong>tables</strong> (rows and columns) with relationships between them. Uses SQL.</p>
<ul>
    <li>MySQL, PostgreSQL, Oracle, SQL Server</li>
    <li>Best for structured, predictable data</li>
</ul>

<h4>2. NoSQL Database</h4>
<p>Stores data in non-tabular formats (documents, key-value pairs, graphs).</p>
<ul>
    <li>MongoDB (document), Redis (key-value), Neo4j (graph)</li>
    <li>Flexible schema, horizontal scaling</li>
</ul>

<h4>3. Object-Oriented Database</h4>
<p>Stores data as objects (like in OOP programming).</p>
<ul>
    <li>db4o, ObjectDB</li>
    <li>Used in applications with complex data structures</li>
</ul>

<h3>Examples</h3>

<p><strong>1. Create a database</strong></p>
<pre><code class="language-sql">-- Create a new database called school
CREATE DATABASE school;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 1 row affected</pre>

<p><strong>2. Create a students table</strong></p>
<pre><code class="language-sql">-- Create a students table with primary key
CREATE TABLE students (
    id INT PRIMARY KEY,     -- Unique identifier
    name VARCHAR(50),       -- Student name
    grade INT               -- Student grade
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<p><strong>3. Insert a student record</strong></p>
<pre><code class="language-sql">-- Insert one student into the table
INSERT INTO students (id, name, grade)
VALUES (1, 'Alice', 90);
</code></pre>
<pre>Query OK, 1 row affected</pre>

<p><strong>4. Query all students</strong></p>
<pre><code class="language-sql">-- Retrieve all student records
SELECT * FROM students;
</code></pre>
<strong>Output:</strong>
<pre>+----+-------+-------+
| id | name  | grade |
+----+-------+-------+
|  1 | Alice |    90 |
+----+-------+-------+</pre>

<h3>Real-World Examples</h3>
<ul>
    <li><strong>Banking</strong> — Customer accounts, transactions, loans</li>
    <li><strong>Hospital</strong> — Patient records, appointments, prescriptions</li>
    <li><strong>University</strong> — Student records, courses, grades</li>
    <li><strong>E-commerce</strong> — Products, orders, customers</li>
    <li><strong>Social Media</strong> — Users, posts, comments, connections</li>
</ul>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Online Shopping:</strong> Every product catalog, shopping cart, and order history is stored in a database managed by a DBMS.</li>
    <li><strong>Hospital Records:</strong> Patient data, medical history, prescriptions, and billing are managed through a DBMS for security and reliability.</li>
    <li><strong>Banking Systems:</strong> Account balances, transfers, and transaction logs rely on a DBMS to ensure accuracy and prevent double-spending.</li>
    <li><strong>Social Media:</strong> User profiles, posts, friendships, and notifications are all backed by databases that handle millions of queries per second.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Start with RDBMS:</strong> Relational databases (MySQL, PostgreSQL) are the most widely used and a great starting point for any project.</li>
    <li><strong>Understand your data first:</strong> Before choosing a DBMS, map out what data you need and how it relates.</li>
    <li><strong>Use the right tool for the job:</strong> NoSQL is great for flexible, unstructured data; RDBMS is better for structured, transactional data.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Storing everything in flat files:</strong> Text files and spreadsheets don't enforce data integrity or handle concurrent access.</li>
    <li><strong>Ignoring data redundancy:</strong> Duplicating the same information in multiple places leads to inconsistency when updates are needed.</li>
    <li><strong>Choosing NoSQL by default:</strong> Not every project needs a NoSQL database. If your data is structured and relational, use an RDBMS.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are hired by a small local bookstore to build a system that tracks their inventory, customers, and sales. Currently, the owner uses a paper notebook and an Excel spreadsheet. Sales data is often lost, and inventory counts are frequently wrong.</p>
    <p><strong>Task:</strong> Answer the following questions based on what you learned:</p>
    <ol>
        <li>What type of database (relational, NoSQL, or object-oriented) would you recommend for this bookstore? Justify your choice.</li>
        <li>Identify two problems the bookstore faces due to not using a DBMS, and explain how a DBMS would solve each.</li>
        <li>List three pieces of data the bookstore would need to store. For each, name the entity (table) it belongs to and the field (column) it would be.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li><strong>Relational database (RDBMS) such as MySQL or SQLite.</strong> The bookstore's data (inventory, customers, sales) is structured and has clear relationships (a customer places many orders; an order contains many products). An RDBMS enforces data integrity and supports SQL queries for reports.</li>
            <li>
                <ul>
                    <li><strong>Data Inconsistency:</strong> The same book might be listed with different titles or prices across the spreadsheet and notebook. A DBMS stores data in one place, so updates propagate everywhere.</li>
                    <li><strong>Data Redundancy:</strong> Customer information is duplicated across multiple spreadsheets. A DBMS stores customer data once and links it to orders via foreign keys, eliminating duplication.</li>
                </ul>
            </li>
            <li>Example answer:
                <ul>
                    <li><strong>Entity: Books</strong> — Fields: title, author, ISBN, price, quantity_in_stock</li>
                    <li><strong>Entity: Customers</strong> — Fields: name, email, phone, address</li>
                    <li><strong>Entity: Sales</strong> — Fields: customer_id (FK), book_id (FK), quantity, sale_date, total_amount</li>
                </ul>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
