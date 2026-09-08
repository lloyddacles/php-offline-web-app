<?php $pageTitle = 'Entity-Relationship Diagrams (ERD)'; require_once __DIR__ . '/../includes/functions.php'; $num = 3; $sectionDir = 'dbms-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Entity-Relationship Diagrams (ERD)</h1>
    <p class="lesson-desc">Design databases visually using ER diagrams — the blueprint of a database.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 2, you learned about the relational model. What are "tables" and how do they relate to each other?</li>
        <li>Imagine you are designing a library system. Name three "things" (entities) you would need to track and one property (attribute) for each.</li>
        <li>What is the difference between a strong entity (like a Student) and a weak entity (like an Enrollment record)?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>What is an ERD?</h3>
<p>An <strong>Entity-Relationship Diagram (ERD)</strong> is a visual representation of a database. It shows the <strong>entities</strong> (things), their <strong>attributes</strong> (properties), and the <strong>relationships</strong> between them. ERDs are the first step in database design — before writing any SQL.</p>

<h3>Analogy</h3>
<p>An ERD is like an <strong>architect's blueprint</strong> for a house. Before building, the architect draws the layout showing rooms (entities), room features like size and color (attributes), and how rooms connect like hallways and doors (relationships).</p>

<h3>Entity Types</h3>
<table>
    <thead>
        <tr><th>Entity Type</th><th>Description</th><th>Example</th><th>Symbol</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Strong Entity</strong></td><td>Can exist independently</td><td>Student, Course, Employee</td><td>Rectangle</td></tr>
        <tr><td><strong>Weak Entity</strong></td><td>Depends on another entity for existence</td><td>Enrollment, Order Item</td><td>Double Rectangle</td></tr>
        <tr><td><strong>Associative Entity</strong></td><td>Resolves M:N relationship into an entity</td><td>Student_Course (with its own attributes)</td><td>Rectangle + Diamond</td></tr>
    </tbody>
</table>

<h3>Attribute Types</h3>
<table>
    <thead>
        <tr><th>Attribute Type</th><th>Description</th><th>Example</th><th>Symbol</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Simple</strong></td><td>Cannot be divided further</td><td>age, gender</td><td>Oval</td></tr>
        <tr><td><strong>Composite</strong></td><td>Can be divided into sub-parts</td><td>name → (first_name, last_name)</td><td>Oval with branches</td></tr>
        <tr><td><strong>Derived</strong></td><td>Calculated from other attributes</td><td>age (from date_of_birth)</td><td>Dashed oval</td></tr>
        <tr><td><strong>Multi-valued</strong></td><td>Can have multiple values</td><td>phone_numbers, skills</td><td>Double oval</td></tr>
        <tr><td><strong>Key</strong></td><td>Uniquely identifies an entity</td><td>student_id, email</td><td>Underlined text</td></tr>
    </tbody>
</table>

<h3>Relationship Types (Cardinality)</h3>
<table>
    <thead>
        <tr><th>Type</th><th>Notation</th><th>Description</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>One-to-One (1:1)</strong></td><td>1 ──── 1</td><td>One instance relates to exactly one other</td><td>Person ↔ Passport</td></tr>
        <tr><td><strong>One-to-Many (1:N)</strong></td><td>1 ──── N</td><td>One instance relates to many others</td><td>Department → Employees</td></tr>
        <tr><td><strong>Many-to-Many (M:N)</strong></td><td>M ──── N</td><td>Many instances relate to many others</td><td>Students ↔ Courses</td></tr>
    </tbody>
</table>

<h3>ERD Symbols Quick Reference</h3>
<pre><code>┌──────────────┬──────────────────────────────────┐
│   Symbol     │   Meaning                        │
├──────────────┼──────────────────────────────────┤
│ Rectangle    │ Entity                           │
│ Double Rect  │ Weak Entity                      │
│ Oval         │ Attribute                        │
│ Double Oval  │ Multi-valued Attribute           │
│ Dashed Oval  │ Derived Attribute                │
│ Underlined   │ Key Attribute (Primary Key)      │
│ Diamond      │ Relationship                     │
│ Line         │ Connection                       │
└──────────────┴──────────────────────────────────┘</code></pre>

<h3>Example: University ERD</h3>
<pre><code>┌────────────┐              ┌────────────┐
│  STUDENT   │              │  TEACHER   │
├────────────┤              ├────────────┤
│ *id (PK)   │              │ *id (PK)   │
│ name       │              │ name       │
│ email      │              │ dept       │
│ phone      │              │ hire_date  │
└─────┬──────┘              └─────┬──────┘
      │                           │
      │         ┌────────────┐    │
      ├────────▶│ ENROLLMENT │◀───┤
      │         ├────────────┤    │
      │         │ student_id │    │
      │         │ course_id  │    │
      │         │ grade      │    │
      │         └─────┬──────┘    │
      │               │           │
      │         ┌─────▼──────┐    │
      │         │  COURSE    │────┘
      │         ├────────────┤
      │         │ *id (PK)   │
      │         │ title      │
      │         │ credits    │
      │         │ teacher_id │
      │         └────────────┘</code></pre>

<h3>Steps to Create an ERD</h3>
<table>
    <thead>
        <tr><th>Step</th><th>Action</th><th>Example (Library System)</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Identify entities</td><td>Book, Member, Loan</td></tr>
        <tr><td>2</td><td>Identify attributes</td><td>Book: title, author, ISBN</td></tr>
        <tr><td>3</td><td>Identify relationships</td><td>Member borrows Book</td></tr>
        <tr><td>4</td><td>Determine cardinality</td><td>1 Member → many Loans</td></tr>
        <tr><td>5</td><td>Identify keys</td><td>ISBN (PK), member_id (PK)</td></tr>
        <tr><td>6</td><td>Draw the diagram</td><td>Use rectangles, ovals, diamonds</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Application</th><th>Entities</th><th>Key Relationships</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Hospital</strong></td><td>Patient, Doctor, Appointment, Department</td><td>Doctor belongs to Department (1:N)</td></tr>
        <tr><td><strong>E-commerce</strong></td><td>Product, Customer, Order, Payment</td><td>Customer places Order (1:N)</td></tr>
        <tr><td><strong>Social Media</strong></td><td>User, Post, Comment, Like</td><td>User creates Post (1:N), Post has Comments (1:N)</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Start with nouns</strong></td><td>Nouns in requirements = entities, verbs = relationships</td></tr>
        <tr><td><strong>Use Crow's Foot notation</strong></td><td>Most widely used ERD notation</td></tr>
        <tr><td><strong>Always resolve M:N</strong></td><td>Many-to-many relationships need a junction table</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Skip the ERD, jump to SQL</td><td>Restructuring tables repeatedly</td><td>Draw ERD first, saves time</td></tr>
        <tr><td>Forgetting cardinality</td><td>Incomplete relationships → wrong tables</td><td>Always specify 1:1, 1:N, or M:N</td></tr>
        <tr><td>Over-complicating</td><td>Too many entities early on</td><td>Start simple, add complexity later</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A hospital asks you to design a database. They need to track: patients, doctors, appointments, and departments. Rules: a doctor belongs to one department, a department has many doctors. A patient can book many appointments, and each appointment is with one doctor. Appointments have a date, time, and reason.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>List the entities and at least 3 attributes for each.</li>
        <li>Identify all relationships and their cardinality (1:1, 1:N, M:N).</li>
        <li>Draw the ERD showing all entities, attributes, and relationships.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>Patient:</strong> patient_id (PK), name, email, phone, date_of_birth</li>
                    <li><strong>Doctor:</strong> doctor_id (PK), name, specialty, email, dept_id (FK)</li>
                    <li><strong>Appointment:</strong> appointment_id (PK), patient_id (FK), doctor_id (FK), date, time, reason</li>
                    <li><strong>Department:</strong> dept_id (PK), name, building</li>
                </ul>
            </li>
            <li>
                <ul>
                    <li>Department → Doctor: <strong>1:N</strong> (one department has many doctors)</li>
                    <li>Patient → Appointment: <strong>1:N</strong> (one patient has many appointments)</li>
                    <li>Doctor → Appointment: <strong>1:N</strong> (one doctor has many appointments)</li>
                    <li>Patient ↔ Doctor: <strong>M:N</strong> through Appointment (a patient sees many doctors over time, a doctor sees many patients)</li>
                </ul>
            </li>
            <li>Expected ERD:
                <pre><code>┌────────────┐              ┌────────────┐
│ DEPARTMENT │              │  PATIENT   │
├────────────┤              ├────────────┤
│*dept_id(PK)│              │*patient_id │
│ name       │              │ name       │
│ building   │              │ email      │
└─────┬──────┘              │ phone      │
      │ 1:N                 └─────┬──────┘
┌─────▼──────┐                    │ 1:N
│   DOCTOR   │              ┌─────▼──────┐
├────────────┤              │ APPOINTMENT│
│*doctor_id  │──────────────▶├────────────┤
│ name       │     1:N      │*appt_id(PK)│
│ specialty  │              │ patient_id │
│ dept_id(FK)│              │ doctor_id  │
└────────────┘              │ date, time │
                            │ reason     │
                            └────────────┘</code></pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
