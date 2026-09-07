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

<h3>What is a DBMS?</h3>
<p>A <strong>Database Management System (DBMS)</strong> is software that allows you to create, manage, and interact with databases. It acts as an intermediary between users and the database, ensuring data is stored efficiently, consistently, and securely.</p>

<h3>Analogy</h3>
<p>Think of a DBMS as a <strong>librarian</strong>. You don't search the shelves yourself — you tell the librarian what you need, and they retrieve it efficiently. The librarian also enforces rules (only library members can borrow books, overdue books incur fines) and keeps the catalog up to date.</p>

<h3>File System vs DBMS</h3>
<p>Before DBMS, data was stored in flat files (text files, spreadsheets). Here's how they compare:</p>

<table>
    <thead>
        <tr><th>Feature</th><th>File System</th><th>DBMS</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Data Redundancy</strong></td><td>Same data duplicated in multiple files</td><td>Data stored once, shared efficiently</td></tr>
        <tr><td><strong>Data Inconsistency</strong></td><td>Same data differs across files</td><td>Single source of truth</td></tr>
        <tr><td><strong>Data Isolation</strong></td><td>Data scattered in different formats</td><td>Unified data storage</td></tr>
        <tr><td><strong>Security</strong></td><td>Little or no access control</td><td>Granular access permissions</td></tr>
        <tr><td><strong>Integrity</strong></td><td>No validation rules</td><td>Constraints enforce data quality</td></tr>
        <tr><td><strong>Concurrent Access</strong></td><td>Data corruption with multiple users</td><td>Handles simultaneous access safely</td></tr>
        <tr><td><strong>Backup/Recovery</strong></td><td>Manual copying</td><td>Automated backup and recovery tools</td></tr>
    </tbody>
</table>

<h3>Key DBMS Concepts</h3>
<table>
    <thead>
        <tr><th>Concept</th><th>Description</th><th>Analogy</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Data</strong></td><td>Raw facts and figures</td><td>Ingredients in a kitchen</td></tr>
        <tr><td><strong>Database (DB)</strong></td><td>Organized collection of related data</td><td>The recipe book</td></tr>
        <tr><td><strong>DBMS</strong></td><td>Software to manage the database</td><td>The chef who organizes and uses the recipes</td></tr>
        <tr><td><strong>Schema</strong></td><td>The structure/design of the database</td><td>The layout of the recipe book</td></tr>
        <tr><td><strong>Query</strong></td><td>A request to retrieve or manipulate data</td><td>Asking the chef for a specific dish</td></tr>
        <tr><td><strong>Table (Relation)</strong></td><td>A collection of rows and columns</td><td>A page in the recipe book</td></tr>
        <tr><td><strong>Record (Tuple)</strong></td><td>A single row in a table</td><td>One recipe on the page</td></tr>
        <tr><td><strong>Field (Attribute)</strong></td><td>A single column in a table</td><td>One detail of the recipe (ingredients, time, etc.)</td></tr>
    </tbody>
</table>

<h3>How a DBMS Works</h3>
<pre><code>┌─────────────────────────────────────────┐
│           Users / Applications           │
├─────────────────────────────────────────┤
│            DBMS Software                 │
│  ┌───────────┬───────────┬───────────┐   │
│  │ Query     │ Storage   │ Security  │   │
│  │ Processor │ Manager   │ Manager   │   │
│  └───────────┴───────────┴───────────┘   │
├─────────────────────────────────────────┤
│           Database Files                 │
└─────────────────────────────────────────┘</code></pre>

<h3>Types of DBMS</h3>
<table>
    <thead>
        <tr><th>Type</th><th>Data Structure</th><th>Examples</th><th>Best For</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Relational (RDBMS)</strong></td><td>Tables (rows &amp; columns)</td><td>MySQL, PostgreSQL, Oracle, SQL Server</td><td>Structured, predictable data</td></tr>
        <tr><td><strong>Object-Oriented</strong></td><td>Objects (like OOP classes)</td><td>db4o, ObjectDB</td><td>Complex data structures, multimedia</td></tr>
        <tr><td><strong>NoSQL</strong></td><td>Documents, key-value, graphs</td><td>MongoDB, Redis, Neo4j</td><td>Flexible schema, large-scale data</td></tr>
        <tr><td><strong>Hierarchical</strong></td><td>Tree (parent-child)</td><td>IBM IMS</td><td>Org charts, file systems</td></tr>
    </tbody>
</table>

<h3>Example: Student Data in a Database</h3>
<p>Here's what student data looks like in a DBMS table:</p>

<table>
    <thead>
        <tr><th>student_id</th><th>name</th><th>email</th><th>grade</th><th>department</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Alice Santos</td><td>alice@school.edu</td><td>95</td><td>Computer Science</td></tr>
        <tr><td>2</td><td>Bob Reyes</td><td>bob@school.edu</td><td>88</td><td>Mathematics</td></tr>
        <tr><td>3</td><td>Charlie Cruz</td><td>charlie@school.edu</td><td>92</td><td>Computer Science</td></tr>
        <tr><td>4</td><td>Diana Lim</td><td>diana@school.edu</td><td>85</td><td>Physics</td></tr>
    </tbody>
</table>

<h3>Real-World Examples</h3>
<table>
    <thead>
        <tr><th>Industry</th><th>What the DBMS Stores</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Banking</strong></td><td>Customer accounts, transactions, loans</td></tr>
        <tr><td><strong>Hospital</strong></td><td>Patient records, appointments, prescriptions</td></tr>
        <tr><td><strong>University</strong></td><td>Student records, courses, grades</td></tr>
        <tr><td><strong>E-commerce</strong></td><td>Products, orders, customers</td></tr>
        <tr><td><strong>Social Media</strong></td><td>Users, posts, comments, connections</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Application</th><th>Data Stored</th><th>Why DBMS is Needed</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Online Shopping</strong></td><td>Product catalog, shopping cart, order history</td><td>Multiple users browsing and buying simultaneously</td></tr>
        <tr><td><strong>Hospital Records</strong></td><td>Patient data, medical history, prescriptions</td><td>Security and reliability for sensitive data</td></tr>
        <tr><td><strong>Banking Systems</strong></td><td>Account balances, transfers, transaction logs</td><td>Accuracy and prevention of double-spending</td></tr>
        <tr><td><strong>Social Media</strong></td><td>User profiles, posts, friendships</td><td>Millions of queries per second</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Start with RDBMS</strong></td><td>Most widely used and a great starting point for any project</td></tr>
        <tr><td><strong>Understand your data first</strong></td><td>Map out what data you need and how it relates before choosing a DBMS</td></tr>
        <tr><td><strong>Use the right tool for the job</strong></td><td>NoSQL for flexible data; RDBMS for structured, transactional data</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Storing everything in flat files</td><td>No data integrity or concurrent access</td><td>Use a DBMS instead</td></tr>
        <tr><td>Ignoring data redundancy</td><td>Inconsistency when updates are needed</td><td>Normalize your database</td></tr>
        <tr><td>Choosing NoSQL by default</td><td>Overkill for structured data</td><td>Use RDBMS if data is relational</td></tr>
    </tbody>
</table>

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
