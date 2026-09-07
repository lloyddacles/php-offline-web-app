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

<h3>Definition</h3>
<p>A <strong>data model</strong> defines how data is stored, organized, and accessed in a database. It is the blueprint for the database structure, describing the relationships between data elements.</p>

<h3>Analogy</h3>
<p>Think of data models as different ways to organize a <strong>library</strong>:</p>
<ul>
    <li><strong>Hierarchical:</strong> Like a family tree — the library is divided into sections (Fiction, Non-Fiction), each section into shelves, each shelf into books. One parent, many children.</li>
    <li><strong>Network:</strong> Like a mind map — books can be related to multiple categories and authors in a web of connections.</li>
    <li><strong>Relational:</strong> Like a card catalog with index cards linked by cross-references. Each card holds specific data, and you follow references to find related information.</li>
    <li><strong>Object-Oriented:</strong> Like storing entire "book kits" — the book, its reviews, related media, all packaged together as one object.</li>
</ul>

<h3>How It Works</h3>

<h4>1. Hierarchical Model</h4>
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

<h4>2. Network Model</h4>
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

<h4>3. Relational Model (Most Important)</h4>
<p>Data is organized in <strong>tables</strong> (relations). Tables relate to each other through <strong>keys</strong>. This is the most widely used model.</p>
<pre><code>  ┌──────────────────────┐       ┌──────────────────────┐
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

<h4>4. Object-Oriented Model</h4>
<p>Data is stored as <strong>objects</strong> (like in Java or PHP classes). Combines OOP concepts with database storage.</p>
<pre><code>// Object example
class Student {
    string $name;
    int $age;
    Address $address;  // Nested object
    array $courses;    // Array of objects
}

// Stored directly in the database</code></pre>
<p><strong>Best for:</strong> Complex data types, multimedia, CAD systems</p>

<h4>5. Entity-Relationship (ER) Model</h4>
<p>A <strong>conceptual model</strong> used to design databases. Uses diagrams to show entities, attributes, and relationships. Covered in detail in Lesson 3.</p>

<h3>Example: Comparing Models</h3>
<table>
    <thead>
        <tr><th>Model</th><th>Structure</th><th>Relationships</th><th>Use Case</th></tr>
    </thead>
    <tbody>
        <tr><td>Hierarchical</td><td>Tree</td><td>1:N</td><td>Org charts, file systems</td></tr>
        <tr><td>Network</td><td>Graph</td><td>M:N</td><td>Complex data networks</td></tr>
        <tr><td>Relational</td><td>Tables</td><td>1:1, 1:N, M:N</td><td>Most applications</td></tr>
        <tr><td>Object-Oriented</td><td>Objects</td><td>All types</td><td>Complex data, multimedia</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Hierarchical:</strong> File systems on your computer, XML/JSON configuration files, organizational charts.</li>
    <li><strong>Network:</strong> Telecommunication networks, transportation route planning, social network connections.</li>
    <li><strong>Relational:</strong> Banking systems, university records, e-commerce platforms, hospital management — nearly all traditional applications.</li>
    <li><strong>Object-Oriented:</strong> Multimedia databases, CAD/CAM systems, scientific simulations with complex data structures.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Master the relational model first:</strong> It's the foundation of nearly all database work. Understanding tables, keys, and relationships will carry you far.</li>
    <li><strong>Know when to deviate:</strong> NoSQL and object-oriented databases shine when your data doesn't fit neatly into tables.</li>
    <li><strong>Think about relationships first:</strong> Before designing tables, map out how your data entities relate to each other (1:1, 1:N, M:N).</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Choosing a model without understanding the data:</strong> A social network is a poor fit for a strict hierarchical model because users have many-to-many connections.</li>
    <li><strong>Ignoring scalability:</strong> A relational database may struggle with massive unstructured data that NoSQL handles easily.</li>
    <li><strong>Over-normalizing early:</strong> Start with a clean relational design (3NF), then optimize later if performance demands it.</li>
</ul>

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
                    <li><strong>(A) Student Records → Relational Model (RDBMS).</strong> Student data is highly structured (names, IDs, grades, courses) with clear relationships (students enroll in courses, courses have teachers). SQL provides powerful querying for transcripts and reports.</li>
                    <li><strong>(B) Alumni Social Network → Network Model or Graph Database (e.g., Neo4j).</strong> Alumni connect with many other alumni, join groups, and have complex many-to-many relationships. A graph database naturally models these connections.</li>
                    <li><strong>(C) CAD System → Object-Oriented Model.</strong> Engineering designs involve complex nested objects (parts, assemblies, materials) that don't map neatly to flat tables. An object-oriented database stores these naturally.</li>
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
