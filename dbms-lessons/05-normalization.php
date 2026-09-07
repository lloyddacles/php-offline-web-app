<?php $pageTitle = 'Database Normalization'; require_once __DIR__ . '/../includes/functions.php'; $num = 5; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Database Normalization</h1>
    <p class="lesson-desc">Eliminate data redundancy and improve data integrity through normalization.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 4, you learned about keys and constraints. Why is it important that a primary key is unique and never NULL?</li>
        <li>Imagine you store a student's name, email, and department name all in one table. If the department name changes, how many rows would you need to update?</li>
        <li>What is a "dependency" between two columns? Give an example: if you know a student's ID, what else can you determine?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>What is Normalization?</h3>
<p><strong>Normalization</strong> is the process of organizing data to reduce redundancy and improve data integrity. It involves breaking large tables into smaller, well-structured tables and defining relationships between them.</p>

<h3>Analogy</h3>
<p>Think of normalization like <strong>organizing a cluttered closet</strong>. Instead of throwing all clothes into one big pile (unnormalized), you separate them: shirts in one drawer, pants in another, socks in a third. Each item has one proper place.</p>

<h3>Why Normalize?</h3>
<table>
    <thead>
        <tr><th>Benefit</th><th>Description</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Reduce Redundancy</strong></td><td>Don't store the same data in multiple places</td><td>Store department name once, not in every employee row</td></tr>
        <tr><td><strong>Prevent Anomalies</strong></td><td>Avoid insertion, update, and deletion problems</td><td>Can add a department without having an employee</td></tr>
        <tr><td><strong>Improve Consistency</strong></td><td>Data changes only need to be made in one place</td><td>Renaming a department updates one row, not hundreds</td></tr>
    </tbody>
</table>

<h3>The Three Anomalies</h3>
<table>
    <thead>
        <tr><th>Anomaly</th><th>Problem</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Insertion Anomaly</strong></td><td>Can't add certain data without other unrelated data</td><td>Can't add a course without a student enrolled in it</td></tr>
        <tr><td><strong>Update Anomaly</strong></td><td>Updating one piece of data requires updating multiple rows</td><td>If teacher changes name, must update ALL rows where they appear</td></tr>
        <tr><td><strong>Deletion Anomaly</strong></td><td>Deleting one record unintentionally deletes other data</td><td>Deleting the last student in a course also loses all info about that course</td></tr>
    </tbody>
</table>

<h3>Normalization Forms</h3>

<h4>First Normal Form (1NF)</h4>
<p><strong>Rule:</strong> Each cell must contain a single (atomic) value. No repeating groups.</p>

<p><strong>BAD (Violates 1NF):</strong></p>
<table>
    <thead>
        <tr><th>id</th><th>name</th><th>courses</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Alice</td><td>Math, Science</td></tr>
        <tr><td>2</td><td>Bob</td><td>Math, English</td></tr>
    </tbody>
</table>
<p><em>Problem: "courses" column has multiple values in one cell!</em></p>

<p><strong>GOOD (Satisfies 1NF):</strong></p>
<table>
    <thead>
        <tr><th>student_id</th><th>name</th><th>course</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Alice</td><td>Math</td></tr>
        <tr><td>1</td><td>Alice</td><td>Science</td></tr>
        <tr><td>2</td><td>Bob</td><td>Math</td></tr>
        <tr><td>2</td><td>Bob</td><td>English</td></tr>
    </tbody>
</table>
<p><em>Each cell now has exactly one value.</em></p>

<h4>Second Normal Form (2NF)</h4>
<p><strong>Rule:</strong> Must be in 1NF + every non-key column must depend on the <strong>entire</strong> primary key (not just part of it).</p>

<p><strong>BAD (Violates 2NF):</strong></p>
<table>
    <thead>
        <tr><th>student_id (PK)</th><th>course_id (PK)</th><th>course_name</th><th>grade</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>101</td><td>Math</td><td>A</td></tr>
        <tr><td>1</td><td>102</td><td>Science</td><td>B</td></tr>
    </tbody>
</table>
<p><em>Problem: course_name depends only on course_id, not on the full PK (student_id + course_id).</em></p>

<p><strong>GOOD (Satisfies 2NF):</strong></p>
<table>
    <thead>
        <tr><th>student_id</th><th>course_id</th><th>grade</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>101</td><td>A</td></tr>
        <tr><td>1</td><td>102</td><td>B</td></tr>
    </tbody>
</table>
<table>
    <thead>
        <tr><th>course_id (PK)</th><th>course_name</th></tr>
    </thead>
    <tbody>
        <tr><td>101</td><td>Math</td></tr>
        <tr><td>102</td><td>Science</td></tr>
    </tbody>
</table>
<p><em>course_name moved to its own table where it depends on the full PK.</em></p>

<h4>Third Normal Form (3NF)</h4>
<p><strong>Rule:</strong> Must be in 2NF + no <strong>transitive dependencies</strong> (non-key columns shouldn't depend on other non-key columns).</p>

<p><strong>BAD (Violates 3NF):</strong></p>
<table>
    <thead>
        <tr><th>id (PK)</th><th>name</th><th>department_id</th><th>department_name</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Alice</td><td>10</td><td>Computer Science</td></tr>
        <tr><td>2</td><td>Bob</td><td>20</td><td>Mathematics</td></tr>
    </tbody>
</table>
<p><em>Problem: department_name depends on department_id, which depends on id. This is a transitive dependency (id → department_id → department_name).</em></p>

<p><strong>GOOD (Satisfies 3NF):</strong></p>
<table>
    <thead>
        <tr><th>id (PK)</th><th>name</th><th>department_id (FK)</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Alice</td><td>10</td></tr>
        <tr><td>2</td><td>Bob</td><td>20</td></tr>
    </tbody>
</table>
<table>
    <thead>
        <tr><th>department_id (PK)</th><th>department_name</th></tr>
    </thead>
    <tbody>
        <tr><td>10</td><td>Computer Science</td></tr>
        <tr><td>20</td><td>Mathematics</td></tr>
    </tbody>
</table>
<p><em>department_name moved to its own table where it depends directly on its own PK.</em></p>

<h3>Normalization Summary</h3>
<table>
    <thead>
        <tr><th>Normal Form</th><th>Rule</th><th>Eliminates</th><th>Analogy</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>1NF</strong></td><td>Atomic values, no repeating groups</td><td>Multi-valued attributes</td><td>One item per drawer</td></tr>
        <tr><td><strong>2NF</strong></td><td>1NF + full functional dependency</td><td>Partial dependencies</td><td>Each drawer has one purpose</td></tr>
        <tr><td><strong>3NF</strong></td><td>2NF + no transitive dependencies</td><td>Transitive dependencies</td><td>Sub-dividers only where needed</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Industry</th><th>Normalization Benefit</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Banking</strong></td><td>Prevents inconsistencies where a customer's address might differ across tables</td></tr>
        <tr><td><strong>E-commerce</strong></td><td>Product descriptions exist in one place, reducing storage and update anomalies</td></tr>
        <tr><td><strong>Healthcare</strong></td><td>Prevents dangerous inconsistencies in patient medical history across departments</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Target 3NF for most applications</strong></td><td>Higher normal forms are rarely needed in practice</td></tr>
        <tr><td><strong>Work step by step</strong></td><td>Start with 1NF, then 2NF, then 3NF</td></tr>
        <tr><td><strong>Identify dependencies first</strong></td><td>Map out which columns depend on which before normalizing</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Over-normalizing</td><td>Too many tables makes queries complex and slow</td><td>Stop at 3NF unless you have a specific reason</td></tr>
        <tr><td>Ignoring anomalies</td><td>Data corruption on insert/update/delete</td><td>Always normalize before building</td></tr>
        <tr><td>Confusing 2NF with 3NF</td><td>2NF = partial dependencies; 3NF = transitive dependencies</td><td>Check each form independently</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A small clinic has one big table called <code>patient_visits</code> with these columns: visit_id, patient_name, patient_email, doctor_name, doctor_specialty, visit_date, diagnosis, medication. The clinic owner complains that when a doctor changes their specialty, they have to update many rows. Also, they can't add a new doctor without a patient visit.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Identify which anomalies (insertion, update, deletion) the clinic is experiencing.</li>
        <li>Normalize the table to 1NF, 2NF, and 3NF. For each step, explain what you changed and why.</li>
        <li>Show the final 3NF tables with example data.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>Update Anomaly:</strong> Doctor specialty is repeated in every visit row. If a doctor changes specialty, every row must be updated.</li>
                    <li><strong>Insertion Anomaly:</strong> Cannot add a new doctor without a patient visit (visit_id, visit_date, etc. would be NULL).</li>
                    <li><strong>Deletion Anomaly:</strong> If the last visit for a doctor is deleted, all information about that doctor is lost.</li>
                </ul>
            </li>
            <li>
                <ul>
                    <li><strong>1NF:</strong> Ensure all values are atomic. If "medication" contained multiple medications per visit, split into a separate table.</li>
                    <li><strong>2NF:</strong> Remove partial dependencies. patient_name and patient_email depend only on patient info (not on visit_id). Create a <code>patients</code> table. doctor_name and doctor_specialty depend only on the doctor. Create a <code>doctors</code> table.</li>
                    <li><strong>3NF:</strong> Remove transitive dependencies. If doctor_specialty depends on doctor_name (which depends on visit), create a separate <code>doctors</code> table with specialty as its own column.</li>
                </ul>
            </li>
            <li>
                <p><strong>patients:</strong></p>
                <table>
                    <thead><tr><th>id (PK)</th><th>name</th><th>email</th></tr></thead>
                    <tbody>
                        <tr><td>1</td><td>Maria Garcia</td><td>maria@email.com</td></tr>
                        <tr><td>2</td><td>John Lee</td><td>john@email.com</td></tr>
                    </tbody>
                </table>
                <p><strong>doctors:</strong></p>
                <table>
                    <thead><tr><th>id (PK)</th><th>name</th><th>specialty</th></tr></thead>
                    <tbody>
                        <tr><td>1</td><td>Dr. Santos</td><td>Cardiology</td></tr>
                        <tr><td>2</td><td>Dr. Cruz</td><td>Pediatrics</td></tr>
                    </tbody>
                </table>
                <p><strong>visits:</strong></p>
                <table>
                    <thead><tr><th>id (PK)</th><th>patient_id (FK)</th><th>doctor_id (FK)</th><th>visit_date</th><th>diagnosis</th></tr></thead>
                    <tbody>
                        <tr><td>1</td><td>1</td><td>1</td><td>2026-01-15</td><td>High blood pressure</td></tr>
                        <tr><td>2</td><td>2</td><td>2</td><td>2026-01-16</td><td>Fever</td></tr>
                    </tbody>
                </table>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
