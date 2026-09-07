<?php $pageTitle = 'Entity-Relationship Diagrams (ERD)'; require_once __DIR__ . '/../includes/functions.php'; $num = 3; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

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

<h3>Definition</h3>
<p>An <strong>Entity-Relationship Diagram (ERD)</strong> is a visual representation of a database. It shows the <strong>entities</strong> (things), their <strong>attributes</strong> (properties), and the <strong>relationships</strong> between them. ERDs are the first step in database design — before writing any SQL.</p>

<h3>Analogy</h3>
<p>An ERD is like an <strong>architect's blueprint</strong> for a house. Before building, the architect draws the layout showing rooms (entities), room features like size and color (attributes), and how rooms connect like hallways and doors (relationships). The blueprint ensures everyone understands the design before construction begins.</p>

<h3>How It Works</h3>
<p>An ERD uses three core components:</p>

<h4>1. Entity</h4>
<p>An entity is a <strong>thing or object</strong> in the real world that is being represented in the database. Shown as a rectangle.</p>
<pre><code>  ┌─────────────┐
   │   STUDENT   │      ← Entity (shown as a rectangle)
   └─────────────┘</code></pre>
<ul>
    <li><strong>Strong Entity:</strong> Can exist independently (Student, Course)</li>
    <li><strong>Weak Entity:</strong> Depends on another entity (Enrollment depends on Student and Course)</li>
</ul>

<h4>2. Attributes</h4>
<p>Attributes are <strong>properties</strong> of an entity (the columns in a table).</p>
<pre><code>         ┌─────────────────────┐
          │      STUDENT        │
          ├─────────────────────┤
          │ * student_id (PK)   │   ← Primary Key (underlined)
          │   first_name        │
          │   last_name         │
          │   email             │
          │   date_of_birth     │
          └─────────────────────┘</code></pre>
<table>
    <thead>
        <tr><th>Attribute Type</th><th>Symbol</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Simple</strong></td><td>Regular</td><td>first_name, age</td></tr>
        <tr><td><strong>Composite</strong></td><td>Branches out</td><td>name → (first_name, last_name)</td></tr>
        <tr><td><strong>Derived</strong></td><td>Dashed oval</td><td>age (derived from date_of_birth)</td></tr>
        <tr><td><strong>Multi-valued</strong></td><td>Double oval</td><td>phone_numbers</td></tr>
    </tbody>
</table>

<h4>3. Relationships</h4>
<p>Relationships describe how entities are <strong>connected</strong> to each other.</p>
<pre><code>  ┌─────────┐                    ┌─────────┐
   │ STUDENT │───── ENROLLS ─────▶│ COURSE  │
   └─────────┘                    └─────────┘</code></pre>

<h3>Cardinality</h3>
<p>Cardinality defines how many instances of one entity can relate to another:</p>
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

<h3>Example: University ERD</h3>
<pre><code>  ┌────────────┐              ┌────────────┐
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
<ol>
    <li><strong>Identify entities</strong> — What things need to be stored? (Student, Course, Teacher)</li>
    <li><strong>Identify attributes</strong> — What properties does each entity have?</li>
    <li><strong>Identify relationships</strong> — How are entities connected?</li>
    <li><strong>Determine cardinality</strong> — 1:1, 1:N, or M:N?</li>
    <li><strong>Identify keys</strong> — Primary keys and foreign keys</li>
    <li><strong>Draw the diagram</strong> — Use a tool or draw by hand</li>
</ol>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Hospital Management:</strong> Patients, Doctors, Appointments, Departments — each entity has attributes and relationships that must be carefully mapped before building the database.</li>
    <li><strong>E-commerce:</strong> Products, Customers, Orders, Payments — the ERD ensures that orders correctly link customers to products with proper cardinality.</li>
    <li><strong>Social Media:</strong> Users, Posts, Comments, Likes — complex many-to-many relationships require junction tables in the ERD.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Start with nouns:</strong> Look at the requirements document and identify all nouns — these are likely your entities.</li>
    <li><strong>Use Crow's Foot notation:</strong> It's the most widely used ERD notation and is supported by most design tools.</li>
    <li><strong>Always resolve M:N relationships:</strong> Many-to-many relationships need a junction table in the physical design.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Skip the ERD and jump to SQL:</strong> Without a design, you'll end up restructuring tables repeatedly. The ERD saves time.</li>
    <li><strong>Forgetting cardinality:</strong> A relationship without cardinality (1:1, 1:N, M:N) is incomplete and leads to wrong table structures.</li>
    <li><strong>Over-complicating the design:</strong> Start simple. You can always add more entities and attributes later.</li>
</ul>

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
