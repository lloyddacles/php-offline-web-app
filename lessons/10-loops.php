<?php $pageTitle = 'PHP Loops'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Loops</h1>
    <p class="lesson-desc">Repeat code efficiently using while, for, foreach, and do-while loops.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What do you repeat in your daily life? (exercises, practice routines, study habits)</li>
        <li>If you had to write "I will study hard" 100 times, how would you do it efficiently?</li>
        <li>In the previous lessons, we wrote code line by line. What if we needed to do the same thing many times?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Loops allow you to execute a block of code multiple times without rewriting it. They're essential for processing collections of data and repeating tasks.</p>

<h3>Analogy</h3>
<p>Loops are like a washing machine cycle. The machine repeats the same steps (wash, rinse, spin) until the clothes are clean. You set the conditions, and the machine does the repetitive work.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. while loop: repeats as long as a condition is true</p>
<p>2. for loop: best when you know the exact number of iterations</p>
<p>3. foreach loop: specifically designed for arrays</p>
<p>4. do...while loop: runs at least once before checking condition</p>
<p>5. Use break to exit early, continue to skip to next iteration</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Count from 1 to 5 with for loop
for ($i = 1; $i <= 5; $i++) {
    echo "Count: $i\n";
}

echo "\n";

// Loop through an array with foreach
$colors = ["Red", "Green", "Blue"];
foreach ($colors as $color) {
    echo "Color: $color\n";
}
</code></pre>
<strong>Output:</strong>
<pre>Count: 1
Count: 2
Count: 3
Count: 4
Count: 5

Color: Red
Color: Green
Color: Blue</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Processing lists of data (user records, product catalogs)</li>
    <li>Creating animations and visual patterns</li>
    <li>Generating reports and data tables</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use for when you know the count, foreach for arrays, while for unknown iterations</li>
    <li>Always ensure the loop condition eventually becomes false</li>
    <li>Use break and continue to control loop flow</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Infinite loops (forgetting to increment the counter)</li>
    <li>Off-by-one errors (starting at 0 vs 1, < vs <=)</li>
    <li>Using the wrong loop type for the task</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're creating educational materials for a math class.</p>
    <p><strong>Task:</strong> Use loops to generate math practice materials.</p>
    <ol>
        <li>Print the multiplication table for 5 (5×1=5, 5×2=10, etc.)</li>
        <li>Create a number pattern where each row has increasing stars (*, **, ***, etc.)</li>
        <li>Find all even numbers between 1 and 20</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use for loop with multiplication</p>
        <p><strong>Answer 2:</strong> Use nested loops for pattern</p>
        <p><strong>Answer 3:</strong> Use modulo operator with loop</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// Multiplication table
echo "Multiplication Table for 5:\n";
for ($i = 1; $i <= 10; $i++) {
    echo "5 × $i = " . (5 * $i) . "\n";
}

echo "\n";

// Star pattern
echo "Star Pattern:\n";
for ($row = 1; $row <= 5; $row++) {
    for ($col = 1; $col <= $row; $col++) {
        echo "*";
    }
    echo "\n";
}

echo "\n";

// Even numbers
echo "Even numbers 1-20:\n";
for ($i = 1; $i <= 20; $i++) {
    if ($i % 2 == 0) {
        echo "$i ";
    }
}
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>