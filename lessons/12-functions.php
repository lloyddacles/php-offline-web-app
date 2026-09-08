<?php $pageTitle = 'PHP Functions'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $sectionDir = 'lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Functions</h1>
    <p class="lesson-desc">Create reusable blocks of code with functions. Write once, use many times!</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Do you reuse recipes when cooking? How does having a recipe save time?</li>
        <li>When you follow a recipe, what are the ingredients (parameters) and the final dish (return value)?</li>
        <li>In the previous lessons, we wrote code that does specific tasks. What if we needed to do the same task multiple times?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Functions are named blocks of code that perform specific tasks. They can accept inputs (parameters) and return outputs (return values).</p>

<h3>Analogy</h3>
<p>Functions are like vending machines. You put in money (parameters), select a product (function name), and get a snack (return value). The machine's internal workings are hidden - you just use it.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Define a function with the function keyword</p>
<p>2. Give it a descriptive name and optional parameters</p>
<p>3. Write the code to execute inside curly braces</p>
<p>4. Optionally return a value with the return keyword</p>
<p>5. Call the function by its name with parentheses</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Function that returns a value
function add($a, $b) {
    return $a + $b;
}

// Call the function
$sum = add(5, 3);
echo "5 + 3 = $sum";

echo "\n";

// Function with default parameter
function greet($name, $greeting = "Hello") {
    echo "$greeting, $name!\n";
}

greet("Alice");
greet("Bob", "Good morning");
</code></pre>
<strong>Output:</strong>
<pre>5 + 3 = 8
Hello, Alice!
Good morning, Bob!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Code reuse - write once, use many times</li>
    <li>Organization - break complex problems into smaller pieces</li>
    <li>Team collaboration - different team members can work on different functions</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use descriptive names (calculateTotal, not calc)</li>
    <li>Keep functions small and focused on one task</li>
    <li>Use type hints for better code clarity</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Creating functions that do too many things</li>
    <li>Forgetting to return a value when needed</li>
    <li>Using global variables instead of parameters</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a utility library for a development team.</p>
    <p><strong>Task:</strong> Create reusable functions for common operations.</p>
    <ol>
        <li>Create a function that calculates the area of a rectangle (width × height)</li>
        <li>Create a function that converts Celsius to Fahrenheit</li>
        <li>Create a function that formats a name properly (first letter capitalized)</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Function with width and height parameters</p>
        <p><strong>Answer 2:</strong> Function with conversion formula</p>
        <p><strong>Answer 3:</strong> Function using ucfirst() or similar</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// Rectangle area
function calculateArea($width, $height) {
    return $width * $height;
}

echo "Area: " . calculateArea(5, 10);
echo "\n";

// Temperature conversion
function celsiusToFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}

echo "25°C = " . celsiusToFahrenheit(25) . "°F";
echo "\n";

// Name formatter
function formatName($name) {
    return ucwords(strtolower($name));
}

echo "Formatted: " . formatName("john smith");
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>