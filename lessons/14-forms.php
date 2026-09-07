<?php $pageTitle = 'PHP Forms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 14; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Forms</h1>
    <p class="lesson-desc">Process HTML form data with PHP, handle submissions, and validate input.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do websites get information from users? (contact forms, search boxes, login pages)</li>
        <li>When you fill out a registration form online, what happens after you click Submit?</li>
        <li>In the previous lesson, we learned about $_GET and $_POST. How can we use them to process form data?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>PHP forms allow websites to collect user input through HTML forms and process that data on the server. The form sends data via GET or POST methods.</p>

<h3>Analogy</h3>
<p>Forms are like order forms at a restaurant. You (the user) fill in your order (input fields), hand it to the waiter (submit button), and the kitchen (PHP) processes your order and brings back your meal (response).</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Create an HTML form with input fields and a submit button</p>
<p>2. Set the form's method attribute to GET or POST</p>
<p>3. Set the action attribute to the PHP file that processes the form</p>
<p>4. PHP receives the data via $_GET or $_POST superglobal</p>
<p>5. Validate and sanitize the input before using it</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data with null coalescing
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";

    // Validate fields are not empty
    if (empty($name) || empty($email)) {
        echo "All fields are required!";
    } else {
        echo "Hello, $name!";
        echo "\n";
        echo "Email: $email";
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Hello, Alice!
Email: alice@example.com</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Contact forms (collecting messages from visitors)</li>
    <li>Registration forms (creating new user accounts)</li>
    <li>Search forms (finding content on the website)</li>
    <li>Survey forms (collecting feedback and opinions)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always validate form data on the server side (never trust client-side validation alone)</li>
    <li>Use htmlspecialchars() to prevent XSS attacks when displaying user input</li>
    <li>Use the same file for both the form and processing (check REQUEST_METHOD)</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Not validating form data (allows malicious input)</li>
    <li>Forgetting to check if form was actually submitted</li>
    <li>Not sanitizing output (security vulnerabilities)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a complete registration system for a new website.</p>
    <p><strong>Task:</strong> Create a registration form with validation.</p>
    <ol>
        <li>Create an HTML form with fields for name, email, and password</li>
        <li>Add server-side validation to check all fields are filled</li>
        <li>Validate that the email is in correct format</li>
        <li>Display appropriate success or error messages</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> HTML form with POST method and required fields</p>
        <p><strong>Answer 2:</strong> Check if fields are empty using empty()</p>
        <p><strong>Answer 3:</strong> Use filter_var() with FILTER_VALIDATE_EMAIL</p>
        <p><strong>Answer 4:</strong> Display different messages based on validation results</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
$errors = [];
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if (empty($errors)) {
        echo "Registration successful! Welcome, $name!";
    }
}
?&gt;

&lt;form method="POST" action=""&gt;
    &lt;input type="text" name="name" value="&lt;?= htmlspecialchars($name) ?&gt;"&gt;
    &lt;input type="email" name="email" value="&lt;?= htmlspecialchars($email) ?&gt;"&gt;
    &lt;input type="password" name="password"&gt;
    &lt;button type="submit"&gt;Register&lt;/button&gt;
&lt;/form&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>