<?php $pageTitle = 'Database Security'; require_once __DIR__ . '/../includes/functions.php'; $num = 9; $sectionDir = 'dbms-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); require_once __DIR__ . '/../includes/header.php'; ?>

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

<h3>What is Database Security?</h3>
<p><strong>Database security</strong> involves protecting databases from unauthorized access, misuse, and data breaches. It includes authentication (verifying identity), authorization (controlling access), encryption (protecting data), and protecting against attacks like SQL injection.</p>

<h3>Analogy</h3>
<p>Think of database security like a <strong>bank vault</strong>:</p>
<table>
    <thead>
        <tr><th>Security Layer</th><th>Bank Vault Analogy</th><th>Database Equivalent</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Authentication</strong></td><td>Key card + PIN to enter</td><td>Username + password login</td></tr>
        <tr><td><strong>Authorization</strong></td><td>Customers access their boxes; managers access vault</td><td>Role-based permissions (SELECT, INSERT, etc.)</td></tr>
        <tr><td><strong>Encryption</strong></td><td>Contents locked inside the box</td><td>Data encrypted at rest and in transit</td></tr>
        <tr><td><strong>SQL Injection Prevention</strong></td><td>ID verification at the door</td><td>Prepared statements</td></tr>
    </tbody>
</table>

<h3>Security Threats and Solutions</h3>
<table>
    <thead>
        <tr><th>Threat</th><th>Description</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>SQL Injection</strong></td><td>Attacker injects malicious SQL via user input</td><td>Prepared statements</td></tr>
        <tr><td><strong>Weak Passwords</strong></td><td>Easily guessable or cracked passwords</td><td>Password hashing (bcrypt)</td></tr>
        <tr><td><strong>Excessive Privileges</strong></td><td>Users have more access than needed</td><td>Principle of least privilege</td></tr>
        <tr><td><strong>Plain-text Storage</strong></td><td>Passwords/data stored unencrypted</td><td>Encrypt sensitive data</td></tr>
        <tr><td><strong>Error Leaks</strong></td><td>Database errors reveal structure to attackers</td><td>Generic error messages</td></tr>
    </tbody>
</table>

<h3>SQL Injection — How It Works</h3>
<pre><code>VULNERABLE CODE:
┌────────────────────────────────────────────────┐
│ username = $_POST['username']                   │
│ query = "SELECT * FROM users                    │
│          WHERE username = '$username'"           │
└────────────────────────────────────────────────┘

ATTACK:
┌────────────────────────────────────────────────┐
│ User enters: ' OR '1'='1' --                   │
│                                                  │
│ Resulting query:                                 │
│ SELECT * FROM users                              │
│ WHERE username = '' OR '1'='1' --'              │
│                                                  │
│ '1'='1' is ALWAYS TRUE → returns ALL users!     │
└────────────────────────────────────────────────┘</code></pre>

<h3>Prepared Statements — How They Prevent It</h3>
<pre><code>SAFE CODE:
┌────────────────────────────────────────────────┐
│ stmt = $pdo->prepare(                           │
│     "SELECT * FROM users                        │
│      WHERE username = :username"                │
│ );                                              │
│ stmt->execute([':username' => $input]);         │
└────────────────────────────────────────────────┘

WHY IT'S SAFE:
┌────────────────────────────────────────────────┐
│ User input is treated as DATA, not CODE.        │
│ The SQL structure is fixed; only the value      │
│ changes. Injection is impossible.               │
└────────────────────────────────────────────────┘</code></pre>

<h3>User Privileges (GRANT/REVOKE)</h3>
<table>
    <thead>
        <tr><th>Privilege</th><th>What It Allows</th><th>Risk if Misused</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>SELECT</strong></td><td>Read data from tables</td><td>Data exposure</td></tr>
        <tr><td><strong>INSERT</strong></td><td>Add new rows</td><td>Fake data injection</td></tr>
        <tr><td><strong>UPDATE</strong></td><td>Modify existing rows</td><td>Data tampering</td></tr>
        <tr><td><strong>DELETE</strong></td><td>Remove rows</td><td>Data destruction</td></tr>
        <tr><td><strong>CREATE</strong></td><td>Create databases/tables</td><td>Unauthorized schema changes</td></tr>
        <tr><td><strong>DROP</strong></td><td>Delete databases/tables</td><td>Total data loss</td></tr>
    </tbody>
</table>

<h3>Principle of Least Privilege</h3>
<table>
    <thead>
        <tr><th>User Type</th><th>Permissions Needed</th><th>Why</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Web Application</strong></td><td>SELECT, INSERT, UPDATE (specific tables)</td><td>App needs to read/write data but not delete tables</td></tr>
        <tr><td><strong>Admin</strong></td><td>Full access</td><td>Manages the database</td></tr>
        <tr><td><strong>Read-Only Analyst</strong></td><td>SELECT only</td><td>Needs reports but shouldn't modify data</td></tr>
        <tr><td><strong>Backup Service</strong></td><td>SELECT (read data for backup)</td><td>Only needs to read for backups</td></tr>
    </tbody>
</table>

<h3>Password Security</h3>
<table>
    <thead>
        <tr><th>Method</th><th>Security</th><th>Recommendation</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Plain text</strong></td><td>None — visible to anyone</td><td>NEVER use</td></tr>
        <tr><td><strong>MD5</strong></td><td>Weak — fast to crack</td><td>NEVER use</td></tr>
        <tr><td><strong>SHA1</strong></td><td>Weak — fast to crack</td><td>NEVER use</td></tr>
        <tr><td><strong>bcrypt</strong></td><td>Strong — slow, salted</td><td>USE THIS</td></tr>
        <tr><td><strong>Argon2</strong></td><td>Strongest — memory-hard</td><td>Best choice if available</td></tr>
    </tbody>
</table>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<table>
    <thead>
        <tr><th>Industry</th><th>Security Measures</th><th>Why Critical</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Banking</strong></td><td>Encryption at rest and in transit, access logging</td><td>Financial data is high-value target</td></tr>
        <tr><td><strong>Healthcare</strong></td><td>HIPAA compliance, encryption, role-based access</td><td>Patient records are legally protected</td></tr>
        <tr><td><strong>E-commerce</strong></td><td>Payment encryption, prepared statements</td><td>Payment data is target for theft</td></tr>
        <tr><td><strong>Social Media</strong></td><td>Password hashing, access controls</td><td>User privacy protection</td></tr>
    </tbody>
</table>

<h3>Tips for Success</h3>
<table>
    <thead>
        <tr><th>Tip</th><th>Why It Matters</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Always use prepared statements</strong></td><td>Never concatenate user input into SQL</td></tr>
        <tr><td><strong>Hash passwords with bcrypt</strong></td><td>Use password_hash() and password_verify()</td></tr>
        <tr><td><strong>Apply least privilege</strong></td><td>Give users only the permissions they need</td></tr>
        <tr><td><strong>Use HTTPS</strong></td><td>Encrypts data in transit</td></tr>
    </tbody>
</table>

<h3>Common Mistakes</h3>
<table>
    <thead>
        <tr><th>Mistake</th><th>Problem</th><th>Solution</th></tr>
    </thead>
    <tbody>
        <tr><td>Storing plain-text passwords</td><td>All accounts exposed if DB is hacked</td><td>Use bcrypt hashing</td></tr>
        <tr><td>Showing database errors to users</td><td>Reveals table/column names to attackers</td><td>Log errors, show generic messages</td></tr>
        <tr><td>Granting ALL PRIVILEGES</td><td>Compromised app could DROP tables</td><td>Use least privilege principle</td></tr>
        <tr><td>Hardcoding encryption keys</td><td>Encryption useless if code is leaked</td><td>Use environment variables</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a login system for a student portal. The database has a <code>users</code> table with columns: user_id, username, password_hash, email, role (admin/student). A colleague suggests storing passwords using MD5 and concatenating user input directly into the query for simplicity.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Explain two reasons why using MD5 for password hashing is insecure.</li>
        <li>Describe how a prepared statement prevents SQL injection (in your own words, no code needed).</li>
        <li>The system needs three user roles: admin (full access), instructor (can view and update grades), and student (can only view own grades). Create a table showing the privileges each role needs.</li>
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
                    <li><strong>No salt:</strong> MD5 doesn't use a random salt, so identical passwords produce identical hashes. An attacker can precompute hashes for common passwords and match them against stolen data.</li>
                </ul>
            </li>
            <li>A prepared statement separates the SQL structure from the user data. The database compiles the SQL query first (with placeholders), then binds the user input as parameters. This means the user input is always treated as data, never as executable SQL commands. Even if someone tries to inject SQL code, the database will treat it as a literal string value, not as part of the query structure.</li>
            <li>
                <table>
                    <thead>
                        <tr><th>Role</th><th>SELECT</th><th>INSERT</th><th>UPDATE</th><th>DELETE</th><th>Tables</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Admin</strong></td><td>✓</td><td>✓</td><td>✓</td><td>✓</td><td>All tables</td></tr>
                        <tr><td><strong>Instructor</strong></td><td>✓</td><td>—</td><td>✓</td><td>—</td><td>grades, students</td></tr>
                        <tr><td><strong>Student</strong></td><td>✓</td><td>—</td><td>—</td><td>—</td><td>grades (own only)</td></tr>
                    </tbody>
                </table>
            </li>
        </ol>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
