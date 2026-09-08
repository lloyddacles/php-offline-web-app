<?php $pageTitle = 'Variables & Data Types'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $sectionDir = 'python-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Variables & Data Types</h1>
    <p class="lesson-desc">Learn how Python handles variables, data types, and type conversion.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In other languages you may have used, how do you declare a variable? Do you need to specify its type?</li>
        <li>What is the difference between an integer and a floating-point number?</li>
        <li>What is a string, and how is it different from a number?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Variables in Python are names that reference values stored in memory. Unlike Java or C, you do <strong>not declare the type</strong> — Python infers it automatically. The core data types are <code>int</code> (integers), <code>float</code> (decimals), <code>str</code> (strings), <code>bool</code> (booleans), and <code>None</code> (null value).</p>

<h3>Analogy</h3>
<p>Imagine variables as labeled storage boxes. You put a value inside (like a number or text) and put a label on the box (the variable name). In Python, the box is <em>smart</em> — it figures out what kind of item you placed inside and adjusts itself accordingly. You don't need to buy separate boxes for different item types.</p>

<h3>How It Works</h3>
<p>When you write <code>x = 42</code>, Python creates an integer object in memory and makes <code>x</code> point to it. If you later write <code>x = "hello"</code>, Python makes <code>x</code> point to a string object instead — the integer is discarded. You can check a variable's type with <code>type()</code> and convert between types using <code>int()</code>, <code>str()</code>, <code>float()</code>, and <code>bool()</code>.</p>

<h3>Example</h3>
<pre><code class="language-python"># Store student data
name = "Maria"
age = 20
grade = 95.5
passed = True

# Print each variable and its type
print("Name:", name)
print("Age:", age)
print("Grade:", grade)
print("Passed:", passed)
</code></pre>
<strong>Output:</strong>
<pre>Name: Maria
Age: 20
Grade: 95.5
Passed: True</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>User Input:</strong> Store form data (names, emails, ages) in variables for processing</li>
    <li><strong>Calculations:</strong> Use int and float for financial calculations, measurements, and statistics</li>
    <li><strong>Data Validation:</strong> Check variable types before performing operations to prevent errors</li>
    <li><strong>Configuration:</strong> Store settings as variables (app name, version, feature flags)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use descriptive variable names: <code>user_age</code> instead of <code>x</code></li>
    <li>Follow PEP 8: use <code>snake_case</code> for variable names</li>
    <li>Use <code>type()</code> to verify a variable's type during debugging</li>
    <li>Convert user input with <code>int()</code> or <code>float()</code> before doing math</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Trying to do math with strings: <code>"5" + 3</code> causes a TypeError</li>
    <li>Forgetting that <code>int("3.7")</code> truncates to 3 — use <code>float()</code> first if you need 3.7</li>
    <li>Using Python keywords as variable names: <code>if = 5</code> causes a SyntaxError</li>
    <li>Confusing assignment <code>=</code> with comparison <code>==</code></li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a simple calculator app. A user enters their age, height, and full name through a form. You need to store this data, verify its types, and convert it appropriately.</p>
    <p><strong>Task:</strong> Create variables to store user data and perform type conversions.</p>
    <ol>
        <li>Create variables for name (string), age (integer), and height (float)</li>
        <li>Convert the age to a string and print a birthday message</li>
        <li>Use <code>type()</code> to verify all three variables</li>
        <li>Convert the string "42" to an integer and add 8 to it</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should demonstrate proper variable assignment and type conversion.</p>
        <pre><code># Student data
name = "Maria"
age = 28
height = 5.4

# Print the data
print("Name:", name)
print("Age:", age)
print("Height:", height)

# Convert and calculate
next_age = age + 1
print("Next year:", next_age)
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
