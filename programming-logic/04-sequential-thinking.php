<?php $pageTitle = 'Sequential Thinking'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $sectionDir = 'programming-logic'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Sequential Thinking</h1>
    <p class="lesson-desc">Understand that code executes top-to-bottom and why the order of operations changes everything.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the first thing you do when you wake up? What comes next? Why can't you skip steps?</li>
        <li>If you were getting ready for school, would you put on your shoes before your socks? What happens if the order is wrong?</li>
        <li>Think about making instant noodles. What happens if you pour the hot water before boiling it?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Sequential thinking</strong> means understanding that instructions execute from top to bottom, one line at a time. The order of operations determines the result — changing the sequence changes the outcome.</p>

<h3>Analogy</h3>
<p>Think of a assembly line in a factory. Each worker does one task in order: first the frame is built, then the engine is installed, then the wheels are attached. If you try to attach wheels before the frame exists, the process fails. Code works the same way — each line depends on the ones before it.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Top-to-bottom execution:</strong> PHP reads your code from the first line to the last, one line at a time.</li>
    <li><strong>Each line completes before the next begins:</strong> The computer doesn't skip ahead or go back unless you tell it to.</li>
    <li><strong>Variables store their values:</strong> Once a variable is assigned, it keeps that value until you change it.</li>
    <li><strong>Order matters:</strong> The same operations in a different order can produce completely different results.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a number
$x = 10;
// Print the value
echo "x = $x\n";
// Add 5 to x
$y = $x + 5;
// Print the new value
echo "y = $y\n";
// Print final values
echo "Done!";
</code></pre>
<strong>Output:</strong>
<pre>x = 10
y = 15
Done!</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a number
x = 10
# Print the value
print(f"x = {x}")
# Add 5 to x
y = x + 5
# Print the new value
print(f"y = {y}")
# Print final values
print("Done!")
</code></pre>
<strong>Output:</strong>
<pre>x = 10
y = 15
Done!</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a number
        int x = 10;
        // Print the value
        System.out.println("x = " + x);
        // Add 5 to x
        int y = x + 5;
        // Print the new value
        System.out.println("y = " + y);
        // Print final values
        System.out.println("Done!");
    }
}
</code></pre>
<strong>Output:</strong>
<pre>x = 10
y = 15
Done!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Most programs are sequential:</strong> Almost every program starts with sequential logic — it's the foundation for all other concepts.</li>
    <li><strong>Financial calculations:</strong> Computing taxes, discounts, and totals depends on the order of operations.</li>
    <li><strong>Data processing:</strong> Reading data, transforming it, and saving results must happen in sequence.</li>
    <li><strong>User interfaces:</strong> Loading screens, form validation, and saving data follow a specific order.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Before running any code, grab a piece of paper and trace through it line by line.</li>
    <li>Write down the value of each variable at each step — this habit will make you a much better programmer.</li>
    <li>When debugging, trace through your code on paper first to find where things went wrong.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Confusing assignment (=) with equality (==):</strong> Writing <code>if ($x = 5)</code> assigns 5 to $x instead of comparing.</li>
    <li><strong>Expecting the computer to "know" what you mean:</strong> Every step must be explicit and in the right order.</li>
    <li><strong>Not tracing code:</strong> Many bugs come from wrong operation order, not wrong operations.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a simple calculator program that takes two numbers, adds them, and displays the result. However, the code below has a bug — the order of operations is wrong.</p>
    <p><strong>Task:</strong> Trace through the code and fix the sequence errors.</p>
    <ol>
        <li>Trace through the "buggy" version line by line. What value does $result have at the end?</li>
        <li>Identify which line is in the wrong position and why it causes the wrong result.</li>
        <li>Rewrite the code in the correct order so the calculator works properly.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> In the buggy version, $result would have the wrong value because the display happens before the calculation, or the calculation uses uninitialized variables.</p>
        <p><strong>Answer 2:</strong> The display line (<code>echo</code>) is placed before the calculation line. The variable $result doesn't have a value yet when it's displayed.</p>
        <p><strong>Answer 3 (Correct Code):</strong></p>
        <pre><code>// Correct order: calculate first, then display
$number1 = 10;
$number2 = 20;

// Step 1: Perform the calculation
$result = $number1 + $number2;

// Step 2: Display the result
echo "The sum of $number1 and $number2 is: $result\n";

// Output: The sum of 10 and 20 is: 30</code></pre>
        <p><strong>Key Lesson:</strong> Always ensure data is processed before it's used. Sequential thinking means understanding what happens first, what happens next, and what depends on what.</p>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
