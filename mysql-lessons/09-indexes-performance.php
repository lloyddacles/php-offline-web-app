<?php $pageTitle = 'Indexes and Performance'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Indexes and Performance</h1>
    <p class="lesson-desc">Speed up your queries with indexes and learn optimization basics.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What happens to query performance as a table grows from 1,000 to 1,000,000 rows?</li>
        <li>What is a "full table scan" and why is it slow?</li>
        <li>Which columns in a table would you most frequently search by?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>An <strong>index</strong> is a data structure that helps MySQL find rows quickly without scanning every row. It works like a book's index — instead of reading every page, you look up the page number in the index.</p>

<h3>Analogy</h3>
<p>Without an index, finding a name in a phone book means reading every single entry. With an index (alphabetical tabs), you jump directly to the right section. MySQL indexes work the same way — they let the database jump to the right rows instantly.</p>

<h3>How It Works</h3>
<p>When you create an index, MySQL builds a sorted structure (usually a B-tree). Queries using the indexed column can use binary search instead of scanning every row. This turns O(n) lookups into O(log n).</p>

<h3>Example</h3>
<pre><code class="language-sql">-- Without index: MySQL checks ALL rows
SELECT * FROM employees WHERE name = 'Alice Smith';
-- On 1 million rows: checks all 1,000,000 rows

-- Create an index on the name column
CREATE INDEX idx_name ON employees(name);

-- Now the same query uses the index
SELECT * FROM employees WHERE name = 'Alice Smith';
-- On 1 million rows: checks ~20 rows (binary search)

-- Create a UNIQUE index (no duplicate values allowed)
CREATE UNIQUE INDEX idx_email ON employees(email);

-- Create a composite index (multi-column)
CREATE INDEX idx_dept_salary ON employees(department, salary);

-- View all indexes on a table
SHOW INDEX FROM employees;

-- Analyze a query with EXPLAIN
EXPLAIN SELECT * FROM employees WHERE name = 'Alice Smith';
</code></pre>
<strong>Output (EXPLAIN):</strong>
<pre>+----+-------------+-----------+------+---------------+---------+---------+-------+------+-------------+
| id | select_type | table     | type | possible_keys | key     | key_len | ref   | rows | Extra       |
+----+-------------+-----------+------+---------------+---------+---------+-------+------+-------------+
|  1 | SIMPLE      | employees | ref  | idx_name      | idx_name| 102     | const |    1 | Using where |
+----+-------------+-----------+------+---------------+---------+---------+-------+------+-------------+
-- "type: ref" and "rows: 1" = efficient query!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>E-commerce Search</strong> — Fast product lookups by name, category, or price</li>
    <li><strong>User Authentication</strong> — Quick login checks by username or email</li>
    <li><strong>Reporting</strong> — Speed up reports that filter by date ranges or statuses</li>
    <li><strong>APIs</strong> — Ensure database queries don't slow down response times</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Index columns used in <code>WHERE</code>, <code>JOIN</code>, and <code>ORDER BY</code> clauses</li>
    <li>Use <code>EXPLAIN</code> to check if your query uses indexes effectively</li>
    <li>Composite indexes follow the <strong>leftmost prefix</strong> rule — order matters</li>
    <li>Remove indexes that are never used to reduce overhead</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Over-indexing — too many indexes slow down INSERT/UPDATE/DELETE operations</li>
    <li>Using <code>LIKE '%value'</code> — leading wildcards prevent index usage</li>
    <li>Applying functions to indexed columns (e.g., <code>WHERE YEAR(date) = 2024</code>)</li>
    <li>Not indexing foreign key columns used in JOINs</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your e-commerce website's product search is getting slower as the product catalog grows to 500,000 items. Users frequently search by product name and filter by category and price range.</p>
    <p><strong>Task:</strong> Write the SQL commands to complete the following:</p>
    <ol>
        <li>Create an index on the product name column</li>
        <li>Create a composite index for queries filtering by category and price</li>
        <li>Use EXPLAIN to analyze a search query that filters by name</li>
        <li>Explain why <code>WHERE name LIKE '%phone%</code> cannot use the index</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>-- 1. Index on product name
CREATE INDEX idx_product_name ON products(name);

-- 2. Composite index for category and price
CREATE INDEX idx_category_price ON products(category, price);

-- 3. Analyze a search query
EXPLAIN SELECT * FROM products WHERE name LIKE 'iPhone%';

-- 4. Answer: LIKE '%phone%' has a leading wildcard (%). MySQL indexes are
-- sorted alphabetically. A leading wildcard means MySQL cannot determine
-- where to start scanning in the index — it must check every entry.
-- This forces a full table scan. Trailing wildcards (LIKE 'phone%') CAN
-- use the index because MySQL can jump to entries starting with "phone".</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
