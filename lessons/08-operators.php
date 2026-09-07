<?php $pageTitle = 'PHP Operators'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Operators</h1>
    <p class="lesson-desc">Perform operations on values using arithmetic, comparison, logical, and assignment operators.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you compare things in daily life? (is something bigger, smaller, or equal?)</li>
        <li>When you make decisions, do you consider multiple conditions? (if it's raining AND I have an umbrella)</li>
        <li>In the previous lesson, we used math operators. What other types of operations might we need?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Operators are symbols that perform operations on values. PHP has arithmetic, assignment, comparison, logical, and string operators.</p>

<h3>Analogy</h3>
<p>Operators are like verbs in a sentence. They tell PHP what to do with the values (nouns). Some operators do math (+, -), some compare (==, >), and some combine conditions (&&, ||).</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Arithmetic operators: +, -, *, /, %, ** (math operations)</p>
<p>2. Assignment operators: =, +=, -=, *=, /= (storing values)</p>
<p>3. Comparison operators: ==, ===, !=, !==, <, > (return true/false)</p>
<p>4. Logical operators: &&, ||, ! (combining conditions)</p>
<p>5. String operator: . (concatenating strings)</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Arithmetic operators
$a = 10;
$b = 3;
echo "Add: " . ($a + $b);
echo "\n";
echo "Subtract: " . ($a - $b);
echo "\n";
echo "Multiply: " . ($a * $b);
echo "\n";
echo "Divide: " . ($a / $b);
echo "\n";
echo "Remainder: " . ($a % $b);
</code></pre>
<strong>Output:</strong>
<pre>Add: 13
Subtract: 7
Multiply: 30
Divide: 3.3333333333333
Remainder: 1</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Decision making in programs (if user is logged in AND has permissions)</li>
    <li>Data processing (calculating totals, applying discounts)</li>
    <li>Form validation (checking if fields are filled correctly)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use === (strict comparison) instead of == (loose) to avoid surprises</li>
    <li>Use parentheses to clarify order of operations</li>
    <li>The ternary operator ?: is great for simple if/else shortcuts</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Confusing = (assignment) with == (comparison) and === (strict comparison)</li>
    <li>Using && when you mean || (or vice versa)</li>
    <li>Not understanding that "0" == false is true in loose comparison</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a grading system that determines student performance.</p>
    <p><strong>Task:</strong> Use operators to evaluate student grades.</p>
    <ol>
        <li>Given a score of 85, determine if the student passed (score >= 60)</li>
        <li>Check if the student is on honor roll (score >= 90) AND has perfect attendance</li>
        <li>Use the ternary operator to assign a letter grade (A, B, C, D, F)</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use comparison operator >=</p>
        <p><strong>Answer 2:</strong> Use logical AND (&&) to combine conditions</p>
        <p><strong>Answer 3:</strong> Use nested ternary operators</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
$score = 85;
$hasPerfectAttendance = true;

// Check if passed
$passed = $score >= 60;
echo "Passed: " . var_export($passed, true);
echo "\n";

// Check honor roll
$honorRoll = $score >= 90 && $hasPerfectAttendance;
echo "Honor Roll: " . var_export($honorRoll, true);
echo "\n";

// Letter grade with ternary
$grade = ($score >= 90) ? "A" :
         (($score >= 80) ? "B" :
         (($score >= 70) ? "C" :
         (($score >= 60) ? "D" : "F")));
echo "Grade: $grade";
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>