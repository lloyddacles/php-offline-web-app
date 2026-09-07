<?php $pageTitle = 'PHP & MySQL Integration'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'mysql-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP &amp; MySQL Integration</h1>
    <p class="lesson-desc">Connect PHP to MySQL and build dynamic database-driven applications.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What are the four basic CRUD operations in a database?</li>
        <li>What is SQL injection, and why is it dangerous?</li>
        <li>What is a prepared statement, and how does it protect against attacks?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>PDO</strong> (PHP Data Objects) is PHP's modern extension for connecting to databases. It supports multiple database systems and provides <strong>prepared statements</strong> that protect against SQL injection by separating SQL logic from user data.</p>

<h3>Analogy</h3>
<p>Think of PDO as a <strong>secure translator</strong> between PHP and MySQL. Instead of handing the database a message with user input mixed in (which could be hijacked), PDO sends the SQL template first, then fills in the values separately — like filling out a form with blank fields that get populated safely.</p>

<h3>How It Works</h3>
<ol>
    <li>Create a PDO connection with host, database, username, and password</li>
    <li>Prepare SQL statements with placeholders (<code>:name</code> or <code>?</code>)</li>
    <li>Execute with actual values — PDO handles safe escaping</li>
    <li>Fetch results as arrays</li>
</ol>

<h3>Example</h3>
<pre><code class="language-sql">-- Create a students table
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    grade INT
);

-- Insert sample data
INSERT INTO students VALUES (1, 'Juan', 95), (2, 'Maria', 88);

-- Find all students
SELECT * FROM students;
</code></pre>
<strong>Output:</strong>
<pre>+----+-------+-------+
| id | name  | grade |
+----+-------+-------+
|  1 | Juan  |    95 |
|  2 | Maria |    88 |
+----+-------+-------+</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Login Systems</strong> — Authenticate users with hashed passwords</li>
    <li><strong>Content Management</strong> — Dynamic pages that pull content from MySQL</li>
    <li><strong>E-commerce</strong> — Product catalogs, shopping carts, and order processing</li>
    <li><strong>APIs</strong> — Backend services that read/write data for mobile apps</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use <strong>prepared statements</strong> — never concatenate user input into SQL</li>
    <li>Use <code>password_hash()</code> and <code>password_verify()</code> for passwords</li>
    <li>Set <code>PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION</code> for proper error handling</li>
    <li>Store database credentials in a separate config file, not in your main code</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Concatenating user input into SQL strings — <strong>SQL injection vulnerability</strong></li>
    <li>Storing plain-text passwords — always use <code>password_hash()</code></li>
    <li>Not handling connection errors — the app crashes silently</li>
    <li>Leaving database connections open — waste server resources</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a student management system for a training center. The system needs to allow administrators to add, view, update, and delete student records through a web interface.</p>
    <p><strong>Task:</strong> Write the PHP/PDO code to complete the following:</p>
    <ol>
        <li>Establish a PDO connection to a database called <code>training_center</code></li>
        <li>Write a prepared INSERT statement to add a new student with first_name, last_name, and email</li>
        <li>Write a SELECT query to fetch and display all students</li>
        <li>Write an UPDATE statement to change a student's email</li>
        <li>Write a DELETE statement to remove a student by ID</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code>&lt;?php
// 1. Establish PDO connection
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=training_center;charset=utf8mb4",
        "root",
        "password",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// 2. INSERT a new student
$stmt = $pdo->prepare(
    "INSERT INTO students (first_name, last_name, email)
     VALUES (:first_name, :last_name, :email)"
);
$stmt->execute([
    ':first_name' => 'Juan',
    ':last_name' => 'Dela Cruz',
    ':email' => 'juan@example.com'
]);
echo "New student ID: " . $pdo->lastInsertId();

// 3. SELECT and display all students
$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll();
foreach ($students as $student) {
    echo $student['id'] . ' - ' .
         $student['first_name'] . ' ' .
         $student['last_name'] . ' (' .
         $student['email'] . ')&lt;br&gt;';
}

// 4. UPDATE a student's email
$stmt = $pdo->prepare(
    "UPDATE students SET email = :email WHERE id = :id"
);
$stmt->execute([
    ':email' => 'newjuan@example.com',
    ':id' => 1
]);
echo "Updated " . $stmt->rowCount() . " row(s)";

// 5. DELETE a student by ID
$stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
$stmt->execute([':id' => 1]);
echo "Deleted " . $stmt->rowCount() . " row(s)";
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
