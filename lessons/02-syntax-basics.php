<?php $pageTitle = 'PHP Syntax Basics'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 2; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Syntax Basics</h1>
    <p class="lesson-desc">Master the fundamental syntax rules of PHP programming.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When you learned to write in English, what were the first rules you learned? (capitalization, punctuation, spacing)</li>
        <li>If you were learning a new language like Spanish or Japanese, what basic rules would you need to know first?</li>
        <li>In the previous lesson, what did you notice about how PHP code was written?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>PHP syntax refers to the rules that govern how you write code in PHP. These rules tell PHP how to interpret your instructions correctly.</p>

<h3>Analogy</h3>
<p>PHP syntax is like grammar rules in writing. Just as you need periods at the end of sentences and capital letters at the start, PHP needs semicolons at the end of statements and specific tags to mark code sections.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. PHP code must be enclosed in &lt;?php ?&gt; tags</p>
<p>2. Every statement must end with a semicolon (;)</p>
<p>3. PHP keywords are case-insensitive, but variables are case-sensitive</p>
<p>4. Use the dot (.) operator to concatenate strings</p>
<p>5. Whitespace between statements is ignored - use it for readability</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// PHP tags mark the start and end of PHP code
echo "Hello World";  // Semicolon ends the statement
echo "\n";  // New line character

// Variables are case-sensitive
$name = "Alice";  // lowercase
$Name = "Bob";    // uppercase - different variable!
echo $name . " and " . $Name;  // Dot concatenates strings
?&gt;
</code></pre>
<strong>Output:</strong>
<pre>Hello World
Alice and Bob</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Clean syntax prevents errors that can crash websites</li>
    <li>Proper formatting makes code readable for team collaboration</li>
    <li>Understanding syntax rules helps you debug problems quickly</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use 4 spaces for indentation (not tabs) - it's the PHP standard</li>
    <li>Use the closing tag ?&gt; only when mixing PHP with HTML</li>
    <li>Practice reading error messages - they tell you exactly what's wrong</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Forgetting semicolons at the end of statements (most common beginner error)</li>
    <li>Confusing the dot (.) for concatenation with plus (+) for addition</li>
    <li>Not using consistent spacing and indentation, making code hard to read</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're reviewing code from a junior developer and need to fix syntax errors.</p>
    <p><strong>Task:</strong> Identify and fix the syntax errors in the following code:</p>
    <pre><code class="language-php">&lt;?php
echo "Hello World"
echo "This line has an error"
$name = "Alice"
echo $Name
?&gt;</code></pre>
    <ol>
        <li>What's wrong with each line?</li>
        <li>How would you fix these errors?</li>
        <li>Rewrite the corrected code with proper syntax</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Missing semicolons at the end of each statement, and $Name should be $name (case-sensitive)</p>
        <p><strong>Answer 2:</strong> Add semicolons and use consistent variable casing</p>
        <p><strong>Answer 3:</strong> Corrected code:</p>
        <pre><code>&lt;?php
echo "Hello World";
echo "This line has an error";
$name = "Alice";
echo $name;
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>