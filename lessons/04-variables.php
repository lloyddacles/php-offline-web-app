<?php $pageTitle = 'PHP Variables'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $sectionDir = 'lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Variables</h1>
    <p class="lesson-desc">Learn how to store and use data with variables in PHP.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you store information about yourself? (name tag, label, memory)</li>
        <li>When you put groceries away, you put them in containers with labels. How is this similar to storing data in programming?</li>
        <li>In the previous lessons, how did we output text? What if we wanted to reuse that text later?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Variables are named containers that store data. They let you save values and retrieve them later by name.</p>

<h3>Analogy</h3>
<p>Variables are like labeled boxes in a storage room. Each box has a unique name (variable name), can hold different items (values), and you can take items out or put new ones in anytime.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Variables start with a dollar sign ($) followed by the name</p>
<p>2. Use the assignment operator (=) to store values</p>
<p>3. Variable names can contain letters, numbers, and underscores</p>
<p>4. Variable names must start with a letter or underscore (not a number)</p>
<p>5. Variables are case-sensitive ($name ≠ $Name)</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Store a name in a variable
$name = "Alice";
echo "Name: " . $name;

// Store a number
echo "\n";
$age = 20;
echo "Age: " . $age;

// Change the variable value
echo "\n";
$age = 21;
echo "Updated Age: " . $age;
</code></pre>
<strong>Output:</strong>
<pre>Name: Alice
Age: 20
Updated Age: 21</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Storing user information (name, email, preferences)</li>
    <li>Managing configuration settings (site title, colors, limits)</li>
    <li>Tracking counts and totals (shopping cart items, scores)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use descriptive names: $firstName instead of $x</li>
    <li>Follow camelCase convention: $totalAmount, $userAge</li>
    <li>Use gettype() and var_dump() to check variable types when debugging</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Using invalid names like $1name or $my-name</li>
    <li>Forgetting the $ sign when using variables</li>
    <li>Confusing = (assignment) with == (comparison)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a student profile system and need to store and display student information.</p>
    <p><strong>Task:</strong> Create variables for a complete student profile.</p>
    <ol>
        <li>Create variables for: first name, last name, age, major, and GPA</li>
        <li>Output each variable in a complete sentence</li>
        <li>Update the age variable and show the updated profile</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Properly named variables with correct values</p>
        <p><strong>Answer 2:</strong> Complete sentences using variable concatenation</p>
        <p><strong>Answer 3:</strong> Updated age variable with new output</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// Student profile variables
$firstName = "John";
$lastName = "Smith";
$age = 20;
$major = "Computer Science";
$gpa = 3.75;

// Display profile
echo "Name: " . $firstName . " " . $lastName;
echo "\n";
echo "Age: " . $age;
echo "\n";
echo "Major: " . $major;
echo "\n";
echo "GPA: " . $gpa;
echo "\n";

// Update age
$age = 21;
echo "Updated Age: " . $age;
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>