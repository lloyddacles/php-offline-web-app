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

<h3>Definition</h3>
<p><strong>Advanced normalization</strong> includes Boyce-Codd Normal Form (BCNF), Fourth Normal Form (4NF), and Fifth Normal Form (5NF). These go beyond 3NF to handle more subtle data anomalies. <strong>Denormalization</strong> is the intentional reversal of normalization for performance gains.</p>

<h3>Analogy</h3>
<p>Think of normalization levels like <strong>security clearance</strong> in a building:</p>
<ul>
    <li><strong>3NF:</strong> Everyone has a badge — basic security is in place.</li>
    <li><strong>BCNF:</strong> Only managers can unlock certain doors — stricter rules for edge cases.</li>
    <li><strong>4NF/5NF:</strong> Even managers need special approval for top-secret rooms — handling rare, complex situations.</li>
    <li><strong>Denormalization:</strong> For a VIP event, you temporarily remove some security checkpoints to let people move faster — trading security for speed.</li>
</ul>

<h3>How It Works</h3>

<h4>Boyce-Codd Normal Form (BCNF)</h4>
<p>A stronger version of 3NF. A table is in BCNF if for every functional dependency <strong>X → Y</strong>, X is a <strong>superkey</strong>.</p>
<pre><code class="language-sql">-- BAD: Violates BCNF
CREATE TABLE teacher_course (
    teacher VARCHAR(50),
    course VARCHAR(50),
    student VARCHAR(50),
    PRIMARY KEY (teacher, course, student)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- GOOD: Split to satisfy BCNF
CREATE TABLE enrollments (
    teacher VARCHAR(50),
    course VARCHAR(50),
    student VARCHAR(50),
    PRIMARY KEY (teacher, course, student)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Student-course mapping (separate table)
CREATE TABLE student_course (
    student VARCHAR(50) PRIMARY KEY,
    course VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>Fourth Normal Form (4NF)</h4>
<p><strong>Rule:</strong> Must be in BCNF + no <strong>multi-valued dependencies</strong>.</p>
<pre><code class="language-sql">-- BAD: Violates 4NF (two independent multi-valued facts)
CREATE TABLE employee_info (
    emp_name VARCHAR(50),
    skill VARCHAR(50),
    language VARCHAR(50)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- GOOD: Split into independent tables (satisfies 4NF)
CREATE TABLE employee_skills (
    emp_name VARCHAR(50),
    skill VARCHAR(50),
    PRIMARY KEY (emp_name, skill)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Languages stored separately
CREATE TABLE employee_languages (
    emp_name VARCHAR(50),
    language VARCHAR(50),
    PRIMARY KEY (emp_name, language)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h4>Fifth Normal Form (5NF)</h4>
<p><strong>Rule:</strong> Must be in 4NF + no <strong>join dependencies</strong>. A table can be decomposed into smaller tables and reconstructed without losing data.</p>

<h4>Denormalization</h4>
<p>Sometimes we <strong>intentionally break normalization</strong> for performance. This is called <strong>denormalization</strong>.</p>
<pre><code>-- Normalized: JOINs needed for every query
-- SELECT e.name, d.name FROM employees e JOIN departments d ON ...

-- Denormalized: Store department name directly in employees
-- Faster reads, but more storage and update overhead

-- Use denormalization when:
-- 1. Read performance is critical (reporting tables)
-- 2. Data rarely changes (historical data)
-- 3. Complex JOINs are too slow</code></pre>

<h3>Example: Normalization Summary</h3>
<table>
    <thead>
        <tr><th>Form</th><th>Rule</th><th>Removes</th><th>Complexity</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>1NF</strong></td><td>Atomic values only</td><td>Multi-valued attributes</td><td>Easy</td></tr>
        <tr><td><strong>2NF</strong></td><td>1NF + no partial dependencies</td><td>Partial dependencies</td><td>Moderate</td></tr>
        <tr><td><strong>3NF</strong></td><td>2NF + no transitive dependencies</td><td>Transitive dependencies</td><td>Moderate</td></tr>
        <tr><td><strong>BCNF</strong></td><td>Every determinant is a superkey</td><td>Anomalous dependencies</td><td>Advanced</td></tr>
        <tr><td><strong>4NF</strong></td><td>BCNF + no multi-valued dependencies</td><td>Multi-valued facts</td><td>Advanced</td></tr>
        <tr><td><strong>5NF</strong></td><td>4NF + no join dependencies</td><td>Join dependencies</td><td>Expert</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>BCNF in Practice:</strong> University course scheduling where a student can only take one course from a teacher, but teachers can teach multiple courses — the subtle dependency requires BCNF.</li>
    <li><strong>4NF in Practice:</strong> Employee certification tracking where skills and certifications are independent multi-valued facts about each employee.</li>
    <li><strong>Denormalization in Practice:</strong> Data warehouses and reporting databases where read speed matters more than write efficiency. E-commerce product pages that display category names directly instead of joining with a categories table.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Target 3NF first:</strong> Only investigate BCNF if you encounter unusual anomalies.</li>
    <li><strong>Denormalize strategically:</strong> Only denormalize after measuring actual performance problems, not theoretical ones.</li>
    <li><strong>Document denormalized data:</strong> Keep a record of what you denormalized and why, so future developers understand the trade-off.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Denormalizing too early:</strong> Premature optimization leads to complex, hard-to-maintain schemas with data consistency issues.</li>
    <li><strong>Confusing BCNF with 3NF:</strong> BCNF is stricter — in 3NF, a dependency where the determinant isn't a superkey is allowed if the dependent is part of a candidate key. BCNF doesn't allow this.</li>
    <li><strong>Ignoring multi-valued dependencies:</strong> Storing independent multi-valued facts in the same table leads to redundant data that 4NF eliminates.</li>
</ul>

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
        <li>Redesign the schema to fix the violation. Write the CREATE TABLE statements.</li>
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
                <pre><code class="language-sql">-- Create skills table
CREATE TABLE employee_skills (
    emp_name VARCHAR(50),
    skill VARCHAR(50),
    PRIMARY KEY (emp_name, skill)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Create certifications table
CREATE TABLE employee_certifications (
    emp_name VARCHAR(50),
    certification VARCHAR(50),
    PRIMARY KEY (emp_name, certification)
);
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>
            </li>
            <li>Create a <strong>denormalized view or summary table</strong> specifically for reporting:
                <pre><code class="language-sql">-- Create a view for reporting (denormalized)
CREATE VIEW employee_report AS
SELECT
    s.emp_name,
    GROUP_CONCAT(DISTINCT s.skill) AS skills
FROM employee_skills s
GROUP BY s.emp_name;
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
