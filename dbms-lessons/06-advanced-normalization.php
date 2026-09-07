<?php $pageTitle = 'Advanced Normalization'; require_once __DIR__ . '/../includes/functions.php'; $num = 6; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Advanced Normalization</h1>
    <p class="lesson-desc">Go beyond 3NF with BCNF and higher normal forms, and learn when denormalization is appropriate.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 5, you learned about 1NF, 2NF, and 3NF. What does 3NF eliminate that 2NF does not?</li>
        <li>What is a "transitive dependency"? Can you give a non-database example (e.g., if you know a person's country, you might also know their continent)?</li>
        <li>Why might you want to intentionally break normalization rules in a real application?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>What is Advanced Normalization?</h3>
<p><strong>Advanced normalization</strong> includes Boyce-Codd Normal Form (BCNF), Fourth Normal Form (4NF), and Fifth Normal Form (5NF). These go beyond 3NF to handle more subtle data anomalies.</p>

<h3>Analogy</h3>
<p>Think of normalization levels like <strong>security clearance</strong> in a building:</p>
<table>
    <thead>
        <tr><th>Level</th><th>Analogy</th><th>What It Handles</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>3NF</strong></td><td>Everyone has a badge — basic security</td><td>Transitive dependencies</td></tr>
        <tr><td><strong>BCNF</strong></td><td>Only managers can unlock certain doors</td><td>Anomalous dependencies where determinant isn't a superkey</td></tr>
        <tr><td><strong>4NF/5NF</strong></td><td>Even managers need special approval</td><td>Multi-valued and join dependencies</td></tr>
        <tr><td><strong>Denormalization</strong></td><td>Temporarily remove checkpoints for VIP event</td><td>Trading security for speed</td></tr>
    </tbody>
</table>

<h3>Boyce-Codd Normal Form (BCNF)</h3>
<p>A stronger version of 3NF. A table is in BCNF if for every functional dependency <strong>X → Y</strong>, X is a <strong>superkey</strong>.</p>

<p><strong>BAD (Violates BCNF):</strong></p>
<table>
    <thead>
        <tr><th>student</th><th>course</th><th>teacher</th></tr>
    </thead>
    <tbody>
        <tr><td>Alice</td><td>Math</td><td>Dr. Smith</td></tr>
        <tr><td>Bob</td><td>Math</td><td>Dr. Smith</td></tr>
        <tr><td>Charlie</td><td>Science</td><td>Dr. Jones</td></tr>
    </tbody>
</table>
<p><em>Problem: teacher → course (each teacher teaches one course), but teacher is not a superkey.</em></p>

<p><strong>GOOD (BCNF):</strong></p>
<table>
    <thead>
        <tr><th>teacher (PK)</th><th>course</th></tr>
    </thead>
    <tbody>
        <tr><td>Dr. Smith</td><td>Math</td></tr>
        <tr><td>Dr. Jones</td><td>Science</td></tr>
    </tbody>
</table>
<table>
    <thead>
        <tr><th>student</th><th>teacher (FK)</th></tr>
    </thead>
    <tbody>
        <tr><td>Alice</td><td>Dr. Smith</td></tr>
        <tr><td>Bob</td><td>Dr. Smith</td></tr>
        <tr><td>Charlie</td><td>Dr. Jones</td></tr>
    </tbody>
</table>

<h3>Fourth Normal Form (4NF)</h3>
<p><strong>Rule:</strong> Must be in BCNF + no <strong>multi-valued dependencies</strong>.</p>

<p><strong>BAD (Violates 4NF):</strong></p>
<table>
    <thead>
        <tr><th>employee</th><th>skill</th><th>language</th></tr>
    </thead>
    <tbody>
        <tr><td>Alice</td><td>Java</td><td>English</td></tr>
        <tr><td>Alice</td><td>Java</td><td>Spanish</td></tr>
        <tr><td>Alice</td><td>Python</td><td>English</td></tr>
        <tr><td>Alice</td><td>Python</td><td>Spanish</td></tr>
    </tbody>
</table>
<p><em>Problem: Skills and languages are independent facts. 2 skills × 2 languages = 4 rows (Cartesian product). Redundant!</em></p>

<p><strong>GOOD (4NF):</strong></p>
<table>
    <thead>
        <tr><th>employee (PK)</th><th>skill (PK)</th></tr>
    </thead>
    <tbody>
        <tr><td>Alice</td><td>Java</td></tr>
        <tr><td>Alice</td><td>Python</td></tr>
    </tbody>
</table>
<table>
    <thead>
        <tr><th>employee (PK)</th><th>language (PK)</th></tr>
    </thead>
    <tbody>
        <tr><td>Alice</td><td>English</td></tr>
        <tr><td>Alice</td><td>Spanish</td></tr>
    </tbody>
</table>
<p><em>Each independent fact in its own table. 2 + 2 = 4 rows total instead of 4 rows with redundancy.</em></p>

<h3>Fifth Normal Form (5NF)</h3>
<p><strong>Rule:</strong> Must be in 4NF + no <strong>join dependencies</strong>. A table can be decomposed into smaller tables and reconstructed without losing data.</p>

<p>5NF handles cases where a table can be split into three or more tables but cannot be split into two without losing information. This is rare in practice.</p>

<h3>Complete Normalization Summary</h3>
<table>
    <thead>
        <tr><th>Form</th><th>Rule</th><th>Removes</th><th>Complexity</th><th>When to Use</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>1NF</strong></td><td>Atomic values only</td><td>Multi-valued attributes</td><td>Easy</td><td>Always</td></tr>
        <tr><td><strong>2NF</strong></td><td>1NF + no partial dependencies</td><td>Partial dependencies</td><td>Moderate</td><td>Always</td></tr>
        <tr><td><strong>3NF</strong></td><td>2NF + no transitive dependencies</td><td>Transitive dependencies</td><td>Moderate</td><td>Most applications</td></tr>
        <tr><td><strong>BCNF</strong></td><td>Every determinant is a superkey</td><td>Anomalous dependencies</td><td>Advanced</td><td>When 3NF anomalies remain</td></tr>
        <tr><td><strong>4NF</strong></td><td>BCNF + no multi-valued dependencies</td><td>Multi-valued facts</td><td>Advanced</td><td>Independent multi-valued data</td></tr>
        <tr><td><strong>5NF</strong></td><td>4NF + no join dependencies</td><td>Join dependencies</td><td>Expert</td><td>Very rare cases</td></tr>
    </tbody>
</table>

<h3>Denormalization</h3>
<p>Sometimes we <strong>intentionally break normalization</strong> for performance. This is called <strong>denormalization</strong>.</p>

<table>
    <thead>
        <tr><th>Aspect</th><th>Normalized</th><th>Denormalized</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Data Redundancy</strong></td><td>Minimal</td><td>Intentional duplication</td></tr>
        <tr><td><strong>Write Speed</strong></td><td>Faster (one place to update)</td><td>Slower (multiple places to update)</td></tr>
        <tr><td><strong>Read Speed</strong></td><td>Slower (JOINs needed)</td><td>Faster (pre-joined data)</td></tr>
        <tr><td><strong>Storage</strong></td><td>Efficient</td><td>More space used</td></tr>
        <tr><td><strong>Consistency</strong></td><td>High</td><td>Risk of inconsistency</td></tr>
    </tbody>
</table>

<p><strong>When to Denormalize:</strong></p>
<table>
    <thead>
        <tr><th>Scenario</th><th>Why Denormalize</th></tr>
    </thead>
    <tbody>
        <tr><td>Read-heavy reporting dashboards</td><td>Complex JOINs are too slow for real-time queries</td></tr>
        <tr><td>Data warehousing</td><td>Historical data rarely changes</td></tr>
        <tr><td>E-commerce product pages</td><td>Display category names directly instead of joining</td></tr>
        <tr><td>Caching frequently accessed data</td><td>Avoid repeated JOIN operations</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Normal Form</th><th>Application</th><th>Why It's Needed</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>BCNF</strong></td><td>University course scheduling</td><td>Student can only take one course from a teacher, but teachers teach multiple courses</td></tr>
        <tr><td><strong>4NF</strong></td><td>Employee certification tracking</td><td>Skills and certifications are independent multi-valued facts</td></tr>
        <tr><td><strong>Denormalization</strong></td><td>Data warehouses, reporting databases</td><td>Read speed matters more than write efficiency</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Target 3NF first</strong></td><td>Only investigate BCNF if you encounter unusual anomalies</td></tr>
        <tr><td><strong>Denormalize strategically</strong></td><td>Only after measuring actual performance problems, not theoretical ones</td></tr>
        <tr><td><strong>Document denormalized data</strong></td><td>Future developers need to understand the trade-off</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Denormalizing too early</td><td>Complex, hard-to-maintain schemas</td><td>Normalize first, denormalize only when needed</td></tr>
        <tr><td>Confusing BCNF with 3NF</td><td>BCNF is stricter — every determinant must be a superkey</td><td>Check each functional dependency</td></tr>
        <tr><td>Ignoring multi-valued dependencies</td><td>Cartesian product redundancy</td><td>Split independent multi-valued facts into separate tables</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A tech company tracks employee skills and certifications. The current table looks like this:</p>
    <pre><code>employee_skills (
    emp_name VARCHAR(50),
    skill VARCHAR(50),
    certification VARCHAR(50)
);</code></pre>
    <p>Alice knows Java and Python, and holds AWS and GCP certifications. The data currently contains 4 rows for Alice: all combinations of her skills and certifications.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>What normalization violation does this table have? Which normal form does it violate?</li>
        <li>Redesign the schema to fix the violation. Show the resulting tables with example data.</li>
        <li>The company then wants a reporting dashboard that shows employee names, skills, and certifications in one view without slow JOINs. How would you solve this using denormalization?</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>This violates <strong>Fourth Normal Form (4NF)</strong>. Skills and certifications are independent multi-valued facts. Storing them in the same table creates a Cartesian product: for Alice with 2 skills and 2 certifications, 4 rows are needed (2×2), with redundant data.</li>
            <li>
                <p><strong>employee_skills:</strong></p>
                <table>
                    <thead><tr><th>emp_name (PK)</th><th>skill (PK)</th></tr></thead>
                    <tbody>
                        <tr><td>Alice</td><td>Java</td></tr>
                        <tr><td>Alice</td><td>Python</td></tr>
                    </tbody>
                </table>
                <p><strong>employee_certifications:</strong></p>
                <table>
                    <thead><tr><th>emp_name (PK)</th><th>certification (PK)</th></tr></thead>
                    <tbody>
                        <tr><td>Alice</td><td>AWS</td></tr>
                        <tr><td>Alice</td><td>GCP</td></tr>
                    </tbody>
                </table>
            </li>
            <li>Create a <strong>denormalized view or summary table</strong> specifically for reporting. This pre-combines the data so the dashboard doesn't need slow JOINs. Update the view periodically or after data changes. Trade-off: the view may be slightly out of date, but reads are fast.</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
