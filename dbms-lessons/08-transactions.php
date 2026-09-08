<?php $pageTitle = 'Transaction Management'; require_once __DIR__ . '/../includes/functions.php'; $num = 8; $sectionDir = 'dbms-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Transaction Management</h1>
    <p class="lesson-desc">Keep your data consistent and reliable with transactions and ACID properties.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 7, you learned about DDL commands like CREATE and ALTER. If you accidentally run DROP TABLE, can you undo it? Why or why not?</li>
        <li>Imagine two people are buying the last concert ticket at the same time. What could go wrong if the database doesn't handle this properly?</li>
        <li>What does "all or nothing" mean in the context of a database operation?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>What is a Transaction?</h3>
<p>A <strong>transaction</strong> is a sequence of operations performed as a single logical unit of work. Either <strong>all operations succeed</strong>, or <strong>none of them do</strong>. Transactions ensure data consistency even when multiple operations or users are involved.</p>

<h3>Analogy</h3>
<p>Think of a transaction like an <strong>ATM bank transfer</strong>. When you transfer $500 from Account A to Account B, two things must happen: subtract $500 from A and add $500 to B. If the power goes out after subtracting but before adding, you'd lose money. The bank's system wraps both operations in a transaction — either both happen, or neither does.</p>

<h3>Transaction Timeline</h3>
<pre><code>Time ──────────────────────────────────────────────▶

BEGIN ──▶ UPDATE A ──▶ UPDATE B ──▶ COMMIT
  │                                    │
  │         (if error occurs)          │
  └──────────────▶ ROLLBACK ◀──────────┘
                  (undo everything)</code></pre>

<h3>Transaction Commands</h3>
<table>
    <thead>
        <tr><th>Command</th><th>Purpose</th><th>Effect</th></tr>
    </thead>
    <tbody>
        <tr><td><code>BEGIN</code> / <code>START TRANSACTION</code></td><td>Start a new transaction</td><td>Operations after this are grouped</td></tr>
        <tr><td><code>COMMIT</code></td><td>Save all changes permanently</td><td>Changes become visible to all users</td></tr>
        <tr><td><code>ROLLBACK</code></td><td>Undo all changes since BEGIN</td><td>Data reverts to before BEGIN</td></tr>
        <tr><td><code>SAVEPOINT</code></td><td>Create a rollback point</td><td>Can rollback to this point only</td></tr>
        <tr><td><code>ROLLBACK TO</code></td><td>Roll back to a specific savepoint</td><td>Partial rollback within transaction</td></tr>
    </tbody>
</table>

<h3>ACID Properties</h3>
<p>Transactions must satisfy four properties, known as <strong>ACID</strong>:</p>

<table>
    <thead>
        <tr><th>Property</th><th>Full Name</th><th>Description</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>A</strong></td><td>Atomicity</td><td>All or nothing — either all operations complete or none do</td><td>Bank transfer: both deduction and addition happen, or neither</td></tr>
        <tr><td><strong>C</strong></td><td>Consistency</td><td>Data moves from one valid state to another</td><td>Total money before = total money after transfer</td></tr>
        <tr><td><strong>I</strong></td><td>Isolation</td><td>Concurrent transactions don't interfere with each other</td><td>Two transfers at the same time don't corrupt data</td></tr>
        <tr><td><strong>D</strong></td><td>Durability</td><td>Once committed, changes are permanent (survive crashes)</td><td>Power failure after COMMIT doesn't lose data</td></tr>
    </tbody>
</table>

<h3>ACID Visual Example</h3>
<pre><code>Transaction: Transfer $500 from Alice to Bob

┌─────────────────────────────────────────────────┐
│  BEGIN TRANSACTION                               │
│                                                  │
│  Step 1: Alice.balance = Alice.balance - 500     │
│          ┌─────────────────────────────────┐     │
│          │ Alice: $1000 → $500             │     │
│          └─────────────────────────────────┘     │
│                                                  │
│  Step 2: Bob.balance = Bob.balance + 500         │
│          ┌─────────────────────────────────┐     │
│          │ Bob: $200 → $700                │     │
│          └─────────────────────────────────┘     │
│                                                  │
│  COMMIT ✅                                       │
│  Both changes saved permanently                  │
│  Total: $1000+$200 = $1200 → $500+$700 = $1200  │
│  (Consistency maintained!)                       │
└─────────────────────────────────────────────────┘</code></pre>

<h3>Concurrency Problems</h3>
<p>Without proper transaction management, concurrent transactions can cause problems:</p>

<table>
    <thead>
        <tr><th>Problem</th><th>Description</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Dirty Read</strong></td><td>Reading uncommitted data from another transaction</td><td>B reads A's uncommitted update; A rolls back → B has invalid data</td></tr>
        <tr><td><strong>Non-Repeatable Read</strong></td><td>Reading same row twice gives different results</td><td>B reads row; A updates same row; B reads again → different value</td></tr>
        <tr><td><strong>Phantom Read</strong></td><td>Query returns different rows on second execution</td><td>B counts rows; A inserts new row; B counts again → different count</td></tr>
    </tbody>
</table>

<h3>Isolation Levels</h3>
<table>
    <thead>
        <tr><th>Isolation Level</th><th>Dirty Read</th><th>Non-Repeatable</th><th>Phantom</th><th>Performance</th></tr>
    </thead>
    <tbody>
        <tr><td><code>READ UNCOMMITTED</code></td><td>Yes</td><td>Yes</td><td>Yes</td><td>Fastest</td></tr>
        <tr><td><code>READ COMMITTED</code></td><td>No</td><td>Yes</td><td>Yes</td><td>Good</td></tr>
        <tr><td><code>REPEATABLE READ</code></td><td>No</td><td>No</td><td>Yes</td><td>Moderate</td></tr>
        <tr><td><code>SERIALIZABLE</code></td><td>No</td><td>No</td><td>No</td><td>Slowest</td></tr>
    </tbody>
</table>
<p><em>Higher isolation = fewer problems but slower performance.</em></p>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Industry</th><th>Transaction Example</th><th>Why ACID Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Banking</strong></td><td>Every transfer, deposit, withdrawal</td><td>Money is never lost or duplicated</td></tr>
        <tr><td><strong>E-commerce</strong></td><td>Placing an order (inventory + order + payment)</td><td>All steps must succeed together</td></tr>
        <tr><td><strong>Airline Booking</strong></td><td>Checking availability + reserving seat + charging</td><td>Can't double-book a seat</td></tr>
        <tr><td><strong>Hospital</strong></td><td>Updating patient records across departments</td><td>Prevents partial updates</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Keep transactions short</strong></td><td>Long transactions hold locks and block other users</td></tr>
        <tr><td><strong>Use try-catch in code</strong></td><td>Always wrap transactions in error handling for rollback</td></tr>
        <tr><td><strong>Default to READ COMMITTED</strong></td><td>Good balance between safety and performance</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Forgetting to COMMIT or ROLLBACK</td><td>Uncommitted transactions hold locks</td><td>Always commit or rollback</td></tr>
        <tr><td>Using transactions for single statements</td><td>Unnecessary overhead</td><td>Use only for multi-step operations</td></tr>
        <tr><td>Ignoring isolation levels</td><td>Subtle bugs under concurrent load</td><td>Understand and set appropriate level</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> An online store has an <code>inventory</code> table and an <code>orders</code> table. When a customer places an order, the system must: (1) check if the product is in stock, (2) decrease the inventory count, and (3) create an order record. If any step fails, none of the changes should be saved.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Explain which ACID property ensures that either all three steps complete or none do.</li>
        <li>Write out the transaction flow (BEGIN, step 1, step 2, step 3, COMMIT or ROLLBACK).</li>
        <li>If two customers try to buy the last item simultaneously, what isolation level would prevent a "dirty read"? What about preventing a "phantom read"?</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li><strong>Atomicity</strong> ensures that all three steps (check stock, decrease inventory, create order) either all succeed or all fail. If step 2 fails, step 1's changes are rolled back.</li>
            <li>
                <table>
                    <thead>
                        <tr><th>Step</th><th>Operation</th><th>On Success</th><th>On Failure</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>BEGIN</td><td>Start transaction</td><td>—</td><td>—</td></tr>
                        <tr><td>1</td><td>Check stock (SELECT)</td><td>Continue</td><td>ROLLBACK</td></tr>
                        <tr><td>2</td><td>Decrease inventory (UPDATE)</td><td>Continue</td><td>ROLLBACK</td></tr>
                        <tr><td>3</td><td>Create order (INSERT)</td><td>COMMIT</td><td>ROLLBACK</td></tr>
                    </tbody>
                </table>
            </li>
            <li><strong>READ COMMITTED</strong> prevents dirty reads (Transaction B won't see uncommitted changes from Transaction A). To prevent phantom reads, you need <strong>SERIALIZABLE</strong> isolation, which locks the range of rows being queried so no new rows can be inserted by other transactions.</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
