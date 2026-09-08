<?php $pageTitle = 'PHP Sessions'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 15; $sectionDir = 'lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Sessions &amp; Cookies</h1>
    <p class="lesson-desc">Maintain user state across pages using sessions and cookies.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do websites remember you when you log in? What keeps you logged in as you browse different pages?</li>
        <li>When you add items to an online shopping cart, how does the website remember what you selected?</li>
        <li>In the previous lesson, we learned about forms. What happens to the data after you submit a form?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Sessions and cookies allow websites to remember user information across multiple page visits. Cookies store data in the browser, while sessions store data on the server.</p>

<h3>Analogy</h3>
<p>Cookies are like a name tag you wear - everyone can see it. Sessions are like a VIP pass - only you and the server know about it, and it's more secure.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Cookies: stored in browser, sent with every request, limited to ~4KB</p>
<p>2. Sessions: stored on server, identified by session ID in cookie</p>
<p>3. session_start() must be called before using sessions</p>
<p>4. $_SESSION superglobal stores session data</p>
<p>5. session_destroy() removes all session data</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Start session (must be first!)
session_start();

// Store data in session
$_SESSION["username"] = "Alice";
$_SESSION["logged_in"] = true;

// Read session data
echo "Welcome, " . $_SESSION["username"];

// Check if logged in
echo "\n";
if ($_SESSION["logged_in"] ?? false) {
    echo "You are logged in!";
}
</code></pre>
<strong>Output:</strong>
<pre>Welcome, Alice
You are logged in!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>User login systems (keeping users logged in across pages)</li>
    <li>Shopping carts (remembering items between page visits)</li>
    <li>Personalization (remembering user preferences)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always call session_start() at the top of any page using sessions</li>
    <li>Never store passwords in sessions</li>
    <li>Regenerate session ID after login to prevent session fixation attacks</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Not calling session_start() before using $_SESSION</li>
    <li>Storing sensitive data in cookies (use sessions instead)</li>
    <li>Forgetting to destroy sessions on logout</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a simple login system for a student portal.</p>
    <p><strong>Task:</strong> Create a login/logout system using sessions.</p>
    <ol>
        <li>Create a login page that stores the username in a session</li>
        <li>Create a protected page that checks if the user is logged in</li>
        <li>Create a logout page that destroys the session</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use session_start() and store username in $_SESSION</p>
        <p><strong>Answer 2:</strong> Check if session variable exists before allowing access</p>
        <p><strong>Answer 3:</strong> Use session_destroy() to clear all session data</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// login.php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? "";
    if (!empty($username)) {
        $_SESSION["username"] = $username;
        $_SESSION["logged_in"] = true;
        header("Location: dashboard.php");
        exit;
    }
}
?&gt;

&lt;!-- dashboard.php --&gt;
&lt;?php
session_start();
if (!($_SESSION["logged_in"] ?? false)) {
    header("Location: login.php");
    exit;
}
echo "Welcome, " . $_SESSION["username"];
echo "&lt;a href='logout.php'&gt;Logout&lt;/a&gt;";
?&gt;

&lt;!-- logout.php --&gt;
&lt;?php
session_start();
session_destroy();
header("Location: login.php");
exit;
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>