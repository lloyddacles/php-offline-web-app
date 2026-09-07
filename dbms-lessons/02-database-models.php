<?php $pageTitle = 'Database Models'; require_once __DIR__ . '/../includes/functions.php'; $num = 2; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Database Models</h1>
    <p class="lesson-desc">Understand the different ways data can be organized and structured in a database.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 1, you learned what a DBMS is. Can you name two types of databases and explain when you would use each?</li>
        <li>Think about the file system on your computer. Files are organized in folders and subfolders. How is this similar to a database model?</li>
        <li>What is the main purpose of organizing data in a structured way instead of just dumping it all in one big file?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>What is a Data Model?</h3>
<p>A <strong>data model</strong> defines how data is stored, organized, and accessed in a database. It is the blueprint for the database structure, describing the relationships between data elements.</p>

<h3>Analogy</h3>
<p>Think of data models as different ways to organize a <strong>library</strong>:</p>
<table>
    <thead>
        <tr><th>Model</th><th>Library Analogy</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Hierarchical</strong></td><td>Family tree — library divided into sections, each section into shelves, each shelf into books</td></tr>
        <tr><td><strong>Network</strong></td><td>Mind map — books related to multiple categories and authors in a web</td></tr>
        <tr><td><strong>Relational</strong></td><td>Card catalog with index cards linked by cross-references</td></tr>
        <tr><td><strong>Object-Oriented</strong></td><td>Book kits — the book, reviews, and media all packaged together</td></tr>
    </tbody>
</table>

<h3>1. Hierarchical Model</h3>
<p>Data is organized in a <strong>tree structure</strong> with parent-child relationships. Each parent can have many children, but each child has only one parent.</p>

<pre><code>                ┌──────────┐
                │ Company  │
                └────┬─────┘
           ┌─────────┴─────────┐
      ┌────┴────┐         ┌────┴────┐
      │  Sales  │         │   IT    │
      └────┬────┘         └────┬────┘
      ┌────┴────┐         ┌────┴────┐
      │ Alice   │         │ Bob     │
      └─────────┘         └─────────┘</code></pre>

<table>
    <thead>
        <tr><th>Advantages</th><th>Disadvantages</th></tr>
    </thead>
    <tbody>
        <tr><td>Fast data retrieval (follow the tree path)</td><td>Rigid structure — hard to reorganize</td></tr>
        <tr><td>Good for hierarchical data (org charts)</td><td>No many-to-many relationships</td></tr>
        <tr><td>Efficient for 1:N relationships</td><td>Data redundancy for complex relationships</td></tr>
    </tbody>
</table>

<p><strong>Examples:</strong> IBM's IMS, Windows Registry, XML, JSON files</p>

<h3>2. Network Model</h3>
<p>An improvement over hierarchical — allows <strong>many-to-many relationships</strong> using a graph structure.</p>

<pre><code>      ┌─────────┐         ┌─────────┐
      │ Student │────────▶│ Course  │
      └────┬────┘         └────┬────┘
           │                   │
           ▼                   ▼
      ┌─────────┐         ┌─────────┐
      │  Grade  │◀────────│ Teacher │
      └─────────┘         └─────────┘</code></pre>

<table>
    <thead>
        <tr><th>Advantages</th><th>Disadvantages</th></tr>
    </thead>
    <tbody>
        <tr><td>Supports many-to-many relationships</td><td>Complex to design and maintain</td></tr>
        <tr><td>More flexible than hierarchical</td><td>Requires navigation pointers</td></tr>
        <tr><td>Better performance for some queries</td><td>Lack of structural independence</td></tr>
    </tbody>
</table>

<p><strong>Examples:</strong> IDMS, Integrated Data Store (IDS)</p>

<h3>3. Relational Model (Most Important)</h3>
<p>Data is organized in <strong>tables</strong> (relations). Tables relate to each other through <strong>keys</strong>. This is the most widely used model.</p>

<pre><code>┌──────────────────────┐       ┌──────────────────────┐
│      Students        │       │      Courses         │
├──────────────────────┤       ├──────────────────────┤
│ id (PK) │ name       │       │ id (PK) │ title      │
│ 1       │ Alice      │       │ 101     │ Math       │
│ 2       │ Bob        │       │ 102     │ Science    │
└──────────────────────┘       └──────────────────────┘
          │                            │
          └────────┬───────────────────┘
                   ▼
        ┌──────────────────────┐
        │    Enrollments       │
        ├──────────────────────┤
        │ student_id (FK)      │
        │ course_id  (FK)      │
        │ enrollment_date      │
        └──────────────────────┘</code></pre>

<table>
    <thead>
        <tr><th>Advantages</th><th>Disadvantages</th></tr>
    </thead>
    <tbody>
        <tr><td>Simple, logical structure</td><td>Can be slow for very large datasets</td></tr>
        <tr><td>Flexible queries with SQL</td><td>Complex relationships need many tables</td></tr>
        <tr><td>Data integrity with constraints</td><td>Object-relational impedance mismatch</td></tr>
        <tr><td>Standardized language (SQL)</td><td></td></tr>
    </tbody>
</table>

<p><strong>Examples:</strong> MySQL, PostgreSQL, Oracle, SQL Server, SQLite</p>

<h3>4. Object-Oriented Model</h3>
<p>Data is stored as <strong>objects</strong> (like in Java or PHP classes). Combines OOP concepts with database storage.</p>

<table>
    <thead>
        <tr><th>Concept</th><th>OOP Class</th><th>Database Equivalent</th></tr>
    </thead>
    <tbody>
        <tr><td>Class</td><td>Student</td><td>Table</td></tr>
        <tr><td>Object</td><td>Alice (instance)</td><td>Row</td></tr>
        <tr><td>Attribute</td><td>name, age</td><td>Column</td></tr>
        <tr><td>Method</td><td>getGPA()</td><td>Stored procedure</td></tr>
    </tbody>
</table>

<p><strong>Best for:</strong> Complex data types, multimedia, CAD systems</p>

<h3>Comparison of All Models</h3>
<table>
    <thead>
        <tr><th>Model</th><th>Structure</th><th>Relationships</th><th>Use Case</th><th>Complexity</th></tr>
    </thead>
    <tbody>
        <tr><td>Hierarchical</td><td>Tree</td><td>1:N only</td><td>Org charts, file systems</td><td>Low</td></tr>
        <tr><td>Network</td><td>Graph</td><td>M:N</td><td>Complex data networks</td><td>High</td></tr>
        <tr><td>Relational</td><td>Tables</td><td>1:1, 1:N, M:N</td><td>Most applications</td><td>Medium</td></tr>
        <tr><td>Object-Oriented</td><td>Objects</td><td>All types</td><td>Complex data, multimedia</td><td>High</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Model</th><th>Application</th><th>Why It Fits</th></tr>
    </thead>
    <tbody>
        <tr><td>Hierarchical</td><td>File systems, XML/JSON configs</td><td>Natural parent-child structure</td></tr>
        <tr><td>Network</td><td>Telecom networks, transport routes</td><td>Complex interconnections</td></tr>
        <tr><td>Relational</td><td>Banking, university, e-commerce</td><td>Structured data with clear relationships</td></tr>
        <tr><td>Object-Oriented</td><td>Multimedia, CAD/CAM, scientific sims</td><td>Complex nested data structures</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Master relational first</strong></td><td>Foundation of nearly all database work</td></tr>
        <tr><td><strong>Know when to deviate</strong></td><td>NoSQL shines for unstructured data</td></tr>
        <tr><td><strong>Think about relationships first</strong></td><td>Map entity relationships before designing tables</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Choosing without understanding data</td><td>Social network in hierarchical = bad fit</td><td>Analyze data relationships first</td></tr>
        <tr><td>Ignoring scalability</td><td>RDBMS may struggle with massive unstructured data</td><td>Consider NoSQL for scale</td></tr>
        <tr><td>Over-normalizing early</td><td>Complex schema before requirements are clear</td><td>Start with clean 3NF, optimize later</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A university IT department is choosing a database model for three different systems: (A) a student records system, (B) a social network for alumni, and (C) a CAD system for the engineering department.</p>
    <p><strong>Task:</strong> Answer the following questions:</p>
    <ol>
        <li>For each system (A, B, C), recommend the most appropriate data model and explain why.</li>
        <li>The hierarchical model was popular in the 1960s-70s but is rarely used today. Name one advantage it has over the relational model and one major limitation that caused it to fall out of favor.</li>
        <li>Draw a simple tree diagram showing a hierarchical model for a company with 2 departments, each with 2 employees.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>(A) Student Records → Relational Model (RDBMS).</strong> Student data is highly structured (names, IDs, grades, courses) with clear relationships. SQL provides powerful querying for transcripts and reports.</li>
                    <li><strong>(B) Alumni Social Network → Network Model or Graph Database (e.g., Neo4j).</strong> Alumni connect with many other alumni, join groups, and have complex many-to-many relationships.</li>
                    <li><strong>(C) CAD System → Object-Oriented Model.</strong> Engineering designs involve complex nested objects (parts, assemblies, materials) that don't map neatly to flat tables.</li>
                </ul>
            </li>
            <li><strong>Advantage:</strong> Very fast data retrieval when following the tree path — you navigate directly from parent to child without needing to search or join. <strong>Limitation:</strong> It cannot handle many-to-many relationships without duplicating data, making it inflexible for complex real-world data.</li>
            <li>Expected diagram:
                <pre><code>                ┌──────────┐
                │  Company │
                └────┬─────┘
           ┌─────────┴─────────┐
      ┌────┴────┐         ┌────┴────┐
      │  Sales  │         │   IT    │
      └────┬────┘         └────┬────┘
      ┌────┴────┐         ┌────┴────┐
      │ Alice   │         │ Bob     │
      ├─────────┤         ├─────────┤
      │ Charlie │         │ Diana   │
      └─────────┘         └─────────┘</code></pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
