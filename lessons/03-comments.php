<?php $pageTitle = 'PHP Comments'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Comments</h1>
    <p class="lesson-desc">Learn how to write comments to document your code and make it easier to understand.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Do you take notes when studying? Why do you write them down?</li>
        <li>When you follow a recipe, do you read the instructions first? How do they help?</li>
        <li>If you wrote instructions for someone else to follow, what would you include to make it clear?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Comments are notes in your code that PHP ignores completely. They are for humans to read and help explain what the code does and why.</p>

<h3>Analogy</h3>
<p>Comments are like sticky notes on a recipe. The notes don't change how the recipe works, but they help you remember why you added extra sugar or why you preheated the oven to 350 degrees instead of 400.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Single-line comments use // or # - everything after is ignored</p>
<p>2. Multi-line comments use /* and */ - everything between is ignored</p>
<p>3. Comments can explain why code exists, not just what it does</p>
<p>4. You can temporarily disable code by commenting it out</p>
<p>5. Good comments make code maintainable for you and your team</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// This is a single-line comment
echo "Hello World!";
echo "\n";

# Hash comments also work
$price = 10;  // Comment at end of line

/*
 * This is a multi-line comment.
 * Use it for longer explanations.
 * Author: Student
 * Date: 2024
 */

$tax = $price * 0.1;  // Calculate 10% tax
echo "Tax: " . $tax;
?&gt;
</code></pre>
<strong>Output:</strong>
<pre>Hello World!
Tax: 1</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Team collaboration - other developers can understand your code</li>
    <li>Code maintenance - you can remember your logic months later</li>
    <li>Debugging - temporarily disable code to find problems</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Explain why you're doing something, not what the code does (the code already shows what)</li>
    <li>Use block comments for file headers with author, date, and purpose</li>
    <li>Keep comments updated - outdated comments are worse than no comments</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Writing obvious comments like "// add 1 to counter" - this wastes time</li>
    <li>Nesting multi-line comments (/* inside /*) causes errors</li>
    <li>Leaving commented-out code in production - clean it up</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're working on a team project and need to document code for your classmates.</p>
    <p><strong>Task:</strong> Add appropriate comments to the following code that calculates the area of a rectangle:</p>
    <pre><code class="language-php">&lt;?php
$length = 10;
$width = 5;
$area = $length * $width;
echo "Area: " . $area;
?&gt;</code></pre>
    <ol>
        <li>Add a block comment at the top explaining what the program does</li>
        <li>Add single-line comments explaining each step</li>
        <li>Add an end-of-line comment showing the expected output</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Block comment with program purpose</p>
        <p><strong>Answer 2:</strong> Single-line comments for each calculation step</p>
        <p><strong>Answer 3:</strong> End-of-line comment with expected output</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
/*
 * Program: Rectangle Area Calculator
 * Purpose: Calculate and display the area of a rectangle
 * Author: Student Name
 * Date: 2024
 */

$length = 10;  // Length in units
$width = 5;    // Width in units
$area = $length * $width;  // Area = length × width = 50
echo "Area: " . $area;  // Output: Area: 50
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>