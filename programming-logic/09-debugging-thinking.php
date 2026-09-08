<?php $pageTitle = 'Debugging Thinking'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $sectionDir = 'programming-logic'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Debugging Thinking</h1>
    <p class="lesson-desc">Learn to think like a detective — finding and fixing bugs is a core programmer skill.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When you make a mistake on your homework, how do you find and correct the error?</li>
        <li>Have you ever followed a recipe but the dish didn't turn out right? How did you figure out what went wrong?</li>
        <li>Think about a time when something didn't work as expected. What steps did you take to fix it?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Debugging</strong> is the process of finding and fixing errors (bugs) in your code. A bug is any behavior in your program that isn't what you intended. Debugging follows a systematic process: reproduce, isolate, understand, fix, and test.</p>

<h3>Analogy</h3>
<p>Debugging is like being a detective investigating a crime scene. You look for clues (error messages), narrow down suspects (lines of code), figure out the cause (understand the bug), make an arrest (fix the code), and verify justice was served (test the fix).</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Reproduce:</strong> Make the bug happen again reliably. If you can't reproduce it, you can't fix it.</li>
    <li><strong>Isolate:</strong> Narrow down where the bug happens. Use print statements or a debugger to trace the code.</li>
    <li><strong>Understand:</strong> Figure out WHY the bug happens. What is the code actually doing vs. what you expected?</li>
    <li><strong>Fix:</strong> Make the minimal change that corrects the problem.</li>
    <li><strong>Test:</strong> Verify the fix works and doesn't break anything else.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a student's name
$name = "Juan";
// Print a greeting
echo "Hello, $name!\n";
// Store a number
$age = 15;
// Print the age
echo "Age: $age";
</code></pre>
<strong>Output:</strong>
<pre>Hello, Juan!
Age: 15</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a student's name
name = "Juan"
# Print a greeting
print(f"Hello, {name}!")
# Store a number
age = 15
# Print the age
print(f"Age: {age}")
</code></pre>
<strong>Output:</strong>
<pre>Hello, Juan!
Age: 15</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a student's name
        String name = "Juan";
        // Print a greeting
        System.out.println("Hello, " + name + "!");
        // Store a number
        int age = 15;
        // Print the age
        System.out.println("Age: " + age);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Hello, Juan!
Age: 15</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Testing:</strong> Writing tests before and after fixing bugs ensures the bug stays fixed.</li>
    <li><strong>Error handling:</strong> Using try-catch blocks to handle unexpected inputs gracefully.</li>
    <li><strong>Code reviews:</strong> Having someone else look at your code often reveals bugs you missed.</li>
    <li><strong>Preventive debugging:</strong> Writing clear code from the start reduces the number of bugs.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>var_dump()</code> and <code>print_r()</code> to inspect variables at different points in your code.</li>
    <li>Try "rubber duck debugging" — explain your code line by line to someone (or something) else.</li>
    <li>If you've been stuck for more than 15 minutes, take a break and come back with fresh eyes.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Trying to fix everything at once:</strong> Change one thing at a time and test after each change.</li>
    <li><strong>Ignoring error messages:</strong> PHP error messages tell you exactly what went wrong and where.</li>
    <li><strong>Not testing edge cases:</strong> Test with empty inputs, very large inputs, and unexpected values.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your classmate wrote a program to calculate the average of a list of numbers, but it's giving wrong results. They need your help debugging it.</p>
    <p><strong>Task:</strong> Find and fix the bugs in the code below.</p>
    <ol>
        <li>Identify all the bugs in the code (there are at least 3).</li>
        <li>Explain what each bug does and why it causes incorrect results.</li>
        <li>Rewrite the code with all bugs fixed.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Buggy Code:</strong></p>
        <pre><code>$scores = [85, 92, 78, 95]
$sum = 0
for ($i = 0; $i <= count($scores); $i++) {
    $sum += $scores[$i];
}
$average = $sum / count($scores) - 1;
echo "Average: $average";</code></pre>
        <p><strong>Answer 1 (Bugs Found):</strong></p>
        <ul>
            <li>Bug 1: Missing semicolon after the array declaration.</li>
            <li>Bug 2: Using <code><=</code> instead of <code><</code> in the for loop (off-by-one error).</li>
            <li>Bug 3: Subtracting 1 from the average calculation.</li>
        </ul>
        <p><strong>Answer 2 (Explanation):</strong></p>
        <ul>
            <li>Bug 1 causes a parse error — PHP can't understand the code.</li>
            <li>Bug 2 causes an "undefined offset" error because the loop tries to access an index that doesn't exist.</li>
            <li>Bug 3 gives the wrong result by subtracting 1 from the correct average.</li>
        </ul>
        <p><strong>Answer 3 (Fixed Code):</strong></p>
        <pre><code>// Fixed: Added semicolon, fixed loop condition, removed -1
$scores = [85, 92, 78, 95];
$sum = 0;
for ($i = 0; $i < count($scores); $i++) {
    $sum += $scores[$i];
}
$average = $sum / count($scores);
echo "Average: $average\n";

// Output: Average: 87.5</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
