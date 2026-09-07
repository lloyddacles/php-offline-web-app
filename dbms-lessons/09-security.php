<?php $pageTitle = 'Database Security'; require_once __DIR__ . '/../includes/functions.php'; $num = 9; $prevNext = getPrevNextLesson($num, 'dbms-lessons'); require_once __DIR__ . '/../includes/header.php'; ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Database Security</h1>
    <p class="lesson-desc">Protect your data with access control, authentication, and security best practices.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In Lesson 8, you used COMMIT and ROLLBACK to ensure data consistency. But what happens if an unauthorized person gains access to your database? Can transactions protect you from that?</li>
        <li>Why is it dangerous to store user passwords as plain text in a database? What would happen if your database were hacked?</li>
        <li>Have you ever seen a login form that asks for a username and password? What do you think happens to that data before it reaches the database?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Database security</strong> involves protecting databases from unauthorized access, misuse, and data breaches. It includes authentication (verifying identity), authorization (controlling access), encryption (protecting data), and protecting against attacks like SQL injection.</p>

<h3>Analogy</h3>
<p>Think of database security like a <strong>bank vault</strong>:</p>
<ul>
    <li><strong>Authentication:</strong> You need a key card AND a PIN to enter — verifying who you are.</li>
    <li><strong>Authorization:</strong> Regular customers can access their safety deposit boxes, but only managers can access the main vault — controlling what you can do.</li>
    <li><strong>Encryption:</strong> Even if someone steals a safety deposit box, the contents inside are locked — protecting the data itself.</li>
    <li><strong>SQL Injection Prevention:</strong> The bank verifies your ID at the door instead of letting anyone walk in with a fake story.</li>
</ul>

<h3>How It Works</h3>

<h4>SQL Injection (Most Common Attack)</h4>
<pre><code class="language-php">&lt;?php
// VULNERABLE: User input goes directly into SQL
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users
          WHERE username = '$username'
          AND password = '$password'";
$result = $pdo->query($query);
?&gt;</code></pre>
<p><strong>Attack:</strong> User enters <code>' OR '1'='1' --</code> as username. The query returns ALL users!</p>

<h4>Prevention: Prepared Statements</h4>
<pre><code class="language-php">&lt;?php
// SAFE: Prepared statements separate data from SQL
$stmt = $pdo->prepare(
    "SELECT * FROM users
     WHERE username = :username
     AND password = :password"
);

$stmt->execute([
    ':username' => $_POST['username'],
    ':password' => $_POST['password']
]);

$user = $stmt->fetch();
?&gt;</code></pre>

<h3>Example</h3>

<h4>Authentication &amp; Passwords</h4>
<pre><code class="language-php">&lt;?php
// Hash a password (when creating user)
$hash = password_hash('user_password', PASSWORD_DEFAULT);

// Verify a password (when logging in)
if (password_verify($input_password, $stored_hash)) {
    echo "Password correct!";
} else {
    echo "Wrong password.";
}
?&gt;</code></pre>

<h4>Access Control</h4>
<pre><code class="language-sql">-- Create a user with limited privileges
CREATE USER 'app_user'@'localhost'
IDENTIFIED BY 'secure_password';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Grant specific permissions only
GRANT SELECT, INSERT, UPDATE
ON school.* TO 'app_user'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- View grants
SHOW GRANTS FOR 'app_user'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>+----------------------------------------------------+
| Grants for app_user@localhost                       |
+----------------------------------------------------+
| GRANT SELECT, INSERT, UPDATE ON school.* TO ...    |
+----------------------------------------------------+</pre>

<h4>Data Encryption</h4>
<pre><code class="language-sql">-- Encrypt sensitive data
INSERT INTO users (name, ssn_encrypted)
VALUES ('Alice', AES_ENCRYPT('123-45-6789', 'secret_key'));
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 1 row affected</pre>

<pre><code class="language-sql">-- Decrypt when reading
SELECT name,
       AES_DECRYPT(ssn_encrypted, 'secret_key') AS ssn
FROM users;
</code></pre>
<strong>Output:</strong>
<pre>+-------+-------------+
| name  | ssn         |
+-------+-------------+
| Alice | 123-45-6789 |
+-------+-------------+</pre>

<h3>Principle of Least Privilege</h3>
<table>
    <thead>
        <tr><th>User Type</th><th>Permissions Needed</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Web Application</strong></td><td>SELECT, INSERT, UPDATE (on specific tables only)</td></tr>
        <tr><td><strong>Admin</strong></td><td>Full access (SELECT, INSERT, UPDATE, DELETE, CREATE, DROP)</td></tr>
        <tr><td><strong>Read-Only Analyst</strong></td><td>SELECT only</td></tr>
        <tr><td><strong>Backup Service</strong></td><td>SELECT (to read data for backup)</td></tr>
    </tbody>
</table>
<pre><code class="language-sql">-- BAD: Giving all privileges
GRANT ALL PRIVILEGES ON *.* TO 'app_user'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- GOOD: Give only what's needed
GRANT SELECT, INSERT, UPDATE
ON school.students TO 'app_user'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<h3>Error Handling (Don't Leak Info)</h3>
<pre><code class="language-php">&lt;?php
// BAD: Show raw database errors to users
try {
    $pdo->query("SELECT * FROM nonexistent");
} catch (PDOException $e) {
    echo $e->getMessage();  // Exposes table name!
}

// GOOD: Log errors, show generic message
try {
    $pdo->query("SELECT * FROM nonexistent");
} catch (PDOException $e) {
    error_log("DB error: " . $e->getMessage());
    echo "An error occurred. Please try again.";
}
?&gt;</code></pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Banking:</strong> Customer financial data is encrypted at rest and in transit. Access is restricted to authorized systems only.</li>
    <li><strong>Healthcare:</strong> Patient records (PHI) must comply with HIPAA — encryption, access logging, and role-based access are mandatory.</li>
    <li><strong>E-commerce:</strong> Payment data is encrypted, and web apps use prepared statements to prevent SQL injection attacks.</li>
    <li><strong>Social Media:</strong> User passwords are hashed, and access controls prevent users from viewing private profiles.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Always use prepared statements:</strong> Never concatenate user input into SQL queries.</li>
    <li><strong>Hash passwords with bcrypt:</strong> Use <code>password_hash()</code> and <code>password_verify()</code> — never MD5 or SHA1.</li>
    <li><strong>Apply least privilege:</strong> Give database users only the permissions they need, nothing more.</li>
    <li><strong>Use HTTPS:</strong> Encrypts data in transit, preventing password interception.</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li><strong>Storing plain-text passwords:</strong> If the database is compromised, all user accounts are exposed.</li>
    <li><strong>Showing database errors to users:</strong> Errors reveal table names, column names, and database structure to attackers.</li>
    <li><strong>Granting ALL PRIVILEGES to application users:</strong> A compromised web app could then DROP tables or access sensitive data.</li>
    <li><strong>Hardcoding encryption keys:</strong> If the source code is leaked, the encryption is useless.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a login system for a student portal. The database has a <code>users</code> table with columns: user_id, username, password_hash, email, role (admin/student). A colleague suggests storing passwords using MD5 and concatenating user input directly into the query for simplicity.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Explain two reasons why using MD5 for password hashing is insecure.</li>
        <li>Write a safe login query using prepared statements that checks username and password.</li>
        <li>The system needs three user roles: admin (full access), instructor (can view and update grades), and student (can only view own grades). Write the GRANT statements for each role using the principle of least privilege.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <ol>
            <li>
                <ul>
                    <li><strong>MD5 is too fast:</strong> Modern hardware can compute billions of MD5 hashes per second, making brute-force and rainbow table attacks trivial.</li>
                    <li><strong>No salt:</strong> MD5 doesn't use a random salt, so identical passwords produce identical hashes. An attacker can precompute hashes for common passwords (rainbow tables) and match them against stolen data.</li>
                </ul>
            </li>
            <li>
                <pre><code class="language-php">&lt;?php
// Safe login with prepared statements
$stmt = $pdo->prepare(
    "SELECT id, password_hash, role
     FROM users WHERE username = :username"
);

$stmt->execute([':username' => $_POST['username']]);
$user = $stmt->fetch();

if ($user && password_verify($_POST['password'], $user['password_hash'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    echo "Welcome!";
} else {
    echo "Invalid username or password.";
}
?&gt;</code></pre>
            </li>
            <li>
                <pre><code class="language-sql">-- Admin: full access
GRANT ALL PRIVILEGES ON portal.* TO 'admin_role'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Instructor: can view and update grades
GRANT SELECT ON portal.students TO 'instructor_role'@'localhost';
GRANT SELECT, UPDATE ON portal.grades TO 'instructor_role'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>

<pre><code class="language-sql">-- Student: can only view own grades
GRANT SELECT ON portal.grades TO 'student_role'@'localhost';
</code></pre>
<strong>Output:</strong>
<pre>Query OK, 0 rows affected</pre>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
