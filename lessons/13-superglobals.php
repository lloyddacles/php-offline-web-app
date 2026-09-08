<?php $pageTitle = 'PHP Superglobals'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 13; $sectionDir = 'lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Superglobals</h1>
    <p class="lesson-desc">Access predefined variables that are always available in PHP.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How does PHP know about the server it's running on? What information might it need?</li>
        <li>When you visit a website, how does the server know what browser you're using?</li>
        <li>In the previous lessons, we used variables we created. Are there any variables PHP provides automatically?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Superglobals are built-in variables that are always accessible in PHP, regardless of scope. They provide information about the server, request, and environment.</p>

<h3>Analogy</h3>
<p>Superglobals are like the control panel of a car. They're always there, providing information about speed (server info), fuel level (session data), and navigation (request data) without you having to install them.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. $_GET: data sent via URL parameters (query string)</p>
<p>2. $_POST: data sent via HTTP POST method (forms)</p>
<p>3. $_SERVER: information about the server and current request</p>
<p>4. $_SESSION: session variables (stored on server)</p>
<p>5. $_COOKIE: cookies sent by the browser</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Get PHP version
echo "PHP Version: " . phpversion();

// Get request method
echo "\n";
echo "Request: " . $_SERVER["REQUEST_METHOD"];

// Get visitor IP
echo "\n";
echo "Your IP: " . $_SERVER["REMOTE_ADDR"];

// Get URL parameter (if URL is ?name=Alice)
echo "\n";
$name = $_GET["name"] ?? "Guest";
echo "Name: $name";
</code></pre>
<strong>Output:</strong>
<pre>PHP Version: 8.1.0
Request: GET
Your IP: 127.0.0.1
Name: Guest</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Form processing (collecting user input via $_POST)</li>
    <li>User detection (tracking IP address, browser type)</li>
    <li>Session management (maintaining login state across pages)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use null coalescing (??) to check if superglobal keys exist</li>
    <li>Never trust user input - always validate and sanitize</li>
    <li>Use htmlspecialchars() when outputting user input to prevent XSS attacks</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Not checking if a key exists before accessing it (causes warnings)</li>
    <li>Using $_GET for sensitive data (passwords, credit cards)</li>
    <li>Outputting user input without escaping (security risk)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a website that needs to display server information to visitors.</p>
    <p><strong>Task:</strong> Create a script that displays server details.</p>
    <ol>
        <li>Display the server software and PHP version</li>
        <li>Show the visitor's IP address and browser information</li>
        <li>Display the current request method and script name</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use $_SERVER["SERVER_SOFTWARE"] and phpversion()</p>
        <p><strong>Answer 2:</strong> Use $_SERVER["REMOTE_ADDR"] and $_SERVER["HTTP_USER_AGENT"]</p>
        <p><strong>Answer 3:</strong> Use $_SERVER["REQUEST_METHOD"] and $_SERVER["SCRIPT_NAME"]</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
echo "=== Server Information ===\n";
echo "Software: " . $_SERVER["SERVER_SOFTWARE"] . "\n";
echo "PHP Version: " . phpversion() . "\n\n";

echo "=== Client Information ===\n";
echo "Your IP: " . $_SERVER["REMOTE_ADDR"] . "\n";
echo "Browser: " . $_SERVER["HTTP_USER_AGENT"] . "\n\n";

echo "=== Request Information ===\n";
echo "Method: " . $_SERVER["REQUEST_METHOD"] . "\n";
echo "Script: " . $_SERVER["SCRIPT_NAME"] . "\n";
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>