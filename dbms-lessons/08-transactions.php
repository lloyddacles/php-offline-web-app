<?php $pageTitle = 'Transaction Management'; require_once __DIR__ . '/../includes/functions.php'; $num = 8; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

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

<h3>Definition</h3>
<p>A <strong>transaction</strong> is a sequence of operations performed as a single logical unit of work. Either <strong>all operations succeed</strong>, or <strong>none of them do</strong>. Transactions ensure data consistency even when multiple operations or users are involved.</p>

<h3>Analogy</h3>
<p>Think of a transaction like an <strong>ATM bank transfer</strong>. When you transfer $500 from Account A to Account B, two things must happen: subtract $500 from A and add $500 to B. If the power goes out after subtracting but before adding, you'd lose money. The bank's system wraps both operations in a transaction — either both happen, or neither does. The money is never in limbo.</p>

<h3>How It Works</h3>

<h4>Transaction Commands</h4>
<table>
    <thead>
        <tr><th>Command</th><th>Purpose</th></tr>
    </thead>
    <tbody>
        <tr><td><code>BEGIN</code> / <code>START TRANSACTION</code></td><td>Start a new transaction</td></tr>
        <tr><td><code>COMMIT</code></td><td>Save all changes permanently</td></tr>
        <tr><td><code>ROLLBACK</code></td><td>Undo all changes since BEGIN</td></tr>
        <tr><td><code>SAVEPOINT</code></td><td>Create a rollback point within a transaction</td></tr>
        <tr><td><code>ROLLBACK TO</code></td><td>Roll back to a specific savepoint</td></tr>
    </tbody>
</table>

<h3>Example</h3>
<pre><code>-- Start a transaction
BEGIN;

-- Transfer money from Alice to Bob
UPDATE accounts SET balance = balance - 500 WHERE id = 1;
UPDATE accounts SET balance = balance + 500 WHERE id = 2;

-- Check if everything looks right
SELECT * FROM accounts WHERE id IN (1, 2);

-- If OK, save changes permanently
COMMIT;

-- If something went wrong, undo everything
-- ROLLBACK;</code></pre>

<h3>ACID Properties</h3>
<p>Transactions must satisfy four properties, known as <strong>ACID</strong>:</p>
<table>
    <thead>
        <tr><th>Property</th><th>Description</th><th>Example</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>A</strong>tomicity</td><td>All or nothing — either all operations complete or none do</td><td>Bank transfer: both deduction and addition happen, or neither</td></tr>
        <tr><td><strong>C</strong>onsistency</td><td>Data moves from one valid state to another</td><td>Total money before = total money after transfer</td></tr>
        <tr><td><strong>I</strong>solation</td><td>Concurrent transactions don't interfere with each other</td><td>Two transfers at the same time don't corrupt data</td></tr>
        <tr><td><strong>D</strong>urability</td><td>Once committed, changes are permanent (survive crashes)</td><td>Power failure after COMMIT doesn't lose data</td></tr>
    </tbody>
</table>

<h3>Concurrency Problems</h3>
<p>Without proper transaction management, concurrent transactions can cause problems:</p>
<h4>1. Dirty Read</h4>
<p>Transaction B reads data that Transaction A hasn't committed yet. If A rolls back, B has invalid data.</p>
<h4>2. Non-Repeatable Read</h4>
<p>Transaction B reads the same row twice and gets different values because Transaction A modified it in between.</p>
<h4>3. Phantom Read</h4>
<p>Transaction B runs a query twice and gets different rows because Transaction A inserted or deleted rows.</p>

<h3>Isolation Levels</h3>
<table>
    <thead>
        <tr><th>Level</th><th>Dirty Read</th><th>Non-Repeatable</th><th>Phantom</th></tr>
    </thead>
    <tbody>
        <tr><td><code>READ UNCOMMITTED</code></td><td>Yes</td><td>Yes</td><td>Yes</td></tr>
        <tr><td><code>READ COMMITTED</code></td><td>No</td><td>Yes</td><td>Yes</td></tr>
        <tr><td><code>REPEATABLE READ</code></td><td>No</td><td>No</td><td>Yes</td></tr>
        <tr><td><code>SERIALIZABLE</code></td><td>No</td><td>No</td><td>No</td></tr>
    </tbody>
</table>
<pre><code>-- Set isolation level
SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED;

-- Higher isolation = more safety but slower performance
-- Lower isolation = faster but riskier</code></pre>

<h3>Transactions in PHP (PDO)</h3>
<pre><code>&lt;?php
$pdo->beginTransaction();

try {
    $pdo->exec("UPDATE accounts SET balance = balance - 500 WHERE id = 1");
    $pdo->exec("UPDATE accounts SET balance = balance + 500 WHERE id = 2");
    $pdo->commit();
    echo "Transfer successful!";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Transfer failed: " . $e->getMessage();
}
?&gt;</code></pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Banking:</strong> Every transfer, deposit, and withdrawal is a transaction ensuring money is never lost or duplicated.</li>
    <li><strong>E-commerce:</strong> Placing an order involves decrementing inventory, creating an order record, and processing payment — all in one transaction.</li>
    <li><strong>Airline Booking:</strong> Booking a seat involves checking availability, reserving the seat, and charging the customer — all must succeed together.</li>
    <li><strong>Hospital:</strong> Updating a patient's medical record across multiple departments must be atomic to prevent partial updates.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Keep transactions short:</strong> Long-running transactions hold locks and block other users.</li>
    <li><strong>Use try-catch in PHP:</strong> Always wrap transactions in try-catch so you can rollback on error.</li>
    <li><strong>Default to READ COMMITTED:</strong> It's a good balance between safety and performance for most applications.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Forgetting to COMMIT or ROLLBACK:</strong> Uncommitted transactions hold locks and can cause deadlocks.</li>
    <li><strong>Using transactions for single statements:</strong> A single INSERT doesn't need a transaction wrapper — transactions are for multi-step operations.</li>
    <li><strong>Ignoring isolation levels:</strong> Using the default without understanding it can lead to subtle bugs under concurrent load.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> An online store has an <code>inventory</code> table and an <code>orders</code> table. When a customer places an order, the system must: (1) check if the product is in stock, (2) decrease the inventory count, and (3) create an order record. If any step fails, none of the changes should be saved.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Explain which ACID property ensures that either all three steps complete or none do.</li>
        <li>Write a PHP/PDO transaction that implements this order logic for product_id = 42, quantity = 2, customer_id = 10.</li>
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
                <pre><code>&lt;?php
$pdo->beginTransaction();

try {
    // Step 1: Check stock
    $stmt = $pdo->prepare("SELECT stock FROM inventory WHERE product_id = ?");
    $stmt->execute([42]);
    $product = $stmt->fetch();

    if (!$product || $product['stock'] &lt; 2) {
        throw new Exception("Insufficient stock");
    }

    // Step 2: Decrease inventory
    $pdo->exec("UPDATE inventory SET stock = stock - 2 WHERE product_id = 42");

    // Step 3: Create order
    $pdo->exec("INSERT INTO orders (customer_id, product_id, quantity, order_date)
                VALUES (10, 42, 2, NOW())");

    $pdo->commit();
    echo "Order placed successfully!";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Order failed: " . $e->getMessage();
}
?&gt;</code></pre>
            </li>
            <li><strong>READ COMMITTED</strong> prevents dirty reads (Transaction B won't see uncommitted changes from Transaction A). To prevent phantom reads, you need <strong>SERIALIZABLE</strong> isolation, which locks the range of rows being queried so no new rows can be inserted by other transactions.</li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
