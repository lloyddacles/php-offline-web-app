<?php $pageTitle = 'PHP Conditionals'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Conditionals</h1>
    <p class="lesson-desc">Make your programs make decisions using if, elseif, else, and switch statements.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When do you make decisions in daily life? What conditions do you consider?</li>
        <li>How do you decide what to wear in the morning? (if it's cold, wear a jacket)</li>
        <li>In the previous lesson, we used comparison operators. How can we use those results to make things happen?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Conditionals allow programs to make decisions and execute different code based on whether conditions are true or false.</p>

<h3>Analogy</h3>
<p>Conditionals are like a choose-your-own-adventure book. At each page, you read a condition (if you have the key...) and choose which path to follow based on whether it's true or false.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. if statement: executes code only when condition is true</p>
<p>2. else statement: executes code when condition is false</p>
<p>3. elseif: checks another condition if previous was false</p>
<p>4. switch: compares one value against many possible matches</p>
<p>5. Ternary operator: shorthand for simple if/else</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
$score = 85;

// if...elseif...else for grading
if ($score >= 90) {
    $grade = "A";
    $remark = "Excellent!";
} elseif ($score >= 80) {
    $grade = "B";
    $remark = "Great job!";
} elseif ($score >= 70) {
    $grade = "C";
    $remark = "Good work!";
} elseif ($score >= 60) {
    $grade = "D";
    $remark = "You passed.";
} else {
    $grade = "F";
    $remark = "You need to study more.";
}

echo "Score: $score";
echo "\n";
echo "Grade: $grade";
echo "\n";
echo "Remark: $remark";
?&gt;
</code></pre>
<strong>Output:</strong>
<pre>Score: 85
Grade: B
Remark: Great job!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Form validation (checking if fields are filled correctly)</li>
    <li>Access control (admin vs user permissions)</li>
    <li>Game logic (player wins, loses, or continues)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Start with the most common conditions first</li>
    <li>Use switch when comparing one value against many options</li>
    <li>Avoid deep nesting - use functions or early returns instead</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Forgetting break in switch statements (causes fall-through)</li>
    <li>Using = (assignment) instead of == (comparison) in conditions</li>
    <li>Not handling the else/default case (leaves edge cases unhandled)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a traffic light simulator for a programming project.</p>
    <p><strong>Task:</strong> Create a program that responds to different traffic light colors.</p>
    <ol>
        <li>Use if/elseif/else to check if the light is "red", "yellow", or "green"</li>
        <li>Output the appropriate action for each color (Stop, Caution, Go)</li>
        <li>Add a default case for invalid colors</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use conditional statements to check color values</p>
        <p><strong>Answer 2:</strong> Map colors to actions</p>
        <p><strong>Answer 3:</strong> Include default handling</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
$light = "green";

if ($light === "red") {
    echo "Stop! Wait for green.";
} elseif ($light === "yellow") {
    echo "Caution! Prepare to stop.";
} elseif ($light === "green") {
    echo "Go! Proceed with caution.";
} else {
    echo "Invalid light color: $light";
}
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>