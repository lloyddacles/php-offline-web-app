<?php $pageTitle = 'Loop Thinking'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $sectionDir = 'programming-logic'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Loop Thinking</h1>
    <p class="lesson-desc">Stop writing the same line 100 times — learn to think in repetition and let loops do the heavy lifting.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What tasks do you repeat every day? (brushing teeth, checking your phone, walking to class)</li>
        <li>If you had to say "Good morning" to 30 classmates, would you say it once and expect it to reach everyone, or would you say it to each person individually?</li>
        <li>Think about your class schedule. How does repeating the same routine each day make things easier?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Loops</strong> are structures that repeat a block of code multiple times. Instead of writing the same code over and over, you write it once and let the loop handle the repetition. There are three main types: <code>for</code>, <code>while</code>, and <code>do-while</code>.</p>

<h3>Analogy</h3>
<p>Think of a music player on repeat mode. You don't have to press play for each song — the player automatically loops through the playlist. Loops in programming work the same way: they automatically repeat code until a condition is met.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>For loop:</strong> Use when you know how many times to repeat. It has three parts: initialization, condition, and update.</li>
    <li><strong>While loop:</strong> Use when you don't know how many times — it repeats as long as a condition is true.</li>
    <li><strong>Do-while loop:</strong> Like a while loop, but it always runs at least once because the condition is checked after the body.</li>
    <li><strong>Loop control:</strong> Use <code>break</code> to exit a loop early, and <code>continue</code> to skip to the next iteration.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Count from 1 to 5
for ($i = 1; $i <= 5; $i++) {
    // Print the current number
    echo "Number: $i\n";
}
</code></pre>
<strong>Output:</strong>
<pre>Number: 1
Number: 2
Number: 3
Number: 4
Number: 5</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Count from 1 to 5
for i in range(1, 6):
    # Print the current number
    print(f"Number: {i}")
</code></pre>
<strong>Output:</strong>
<pre>Number: 1
Number: 2
Number: 3
Number: 4
Number: 5</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Count from 1 to 5
        for (int i = 1; i <= 5; i++) {
            // Print the current number
            System.out.println("Number: " + i);
        }
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Number: 1
Number: 2
Number: 3
Number: 4
Number: 5</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Processing lists:</strong> Looping through student grades, product prices, or customer names to perform calculations.</li>
    <li><strong>Animations:</strong> Updating a game screen 60 times per second by looping through position calculations.</li>
    <li><strong>Data tables:</strong> Displaying rows of data from a database by looping through the results.</li>
    <li><strong>Input validation:</strong> Repeatedly asking the user for correct input until they provide it.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Choose the right loop: <code>for</code> when you know the count, <code>while</code> when you don't.</li>
    <li>Always make sure your loop has a way to end — otherwise you get an infinite loop.</li>
    <li>Start with simple loops and build complexity gradually.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Infinite loops:</strong> Forgetting to update the loop variable means the condition never becomes false.</li>
    <li><strong>Off-by-one errors:</strong> Using <code><=</code> instead of <code><</code> (or vice versa) causes one too many or too few iterations.</li>
    <li><strong>Modifying the loop variable inside:</strong> Changing $i inside a for loop can cause unexpected behavior.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A teacher needs you to write programs that perform repetitive tasks for the class.</p>
    <p><strong>Task:</strong> Write loop programs for the following:</p>
    <ol>
        <li><strong>Pattern Printer:</strong> Write a for loop that prints a triangle pattern of stars. Row 1 has 1 star, row 2 has 2 stars, up to row 5.</li>
        <li><strong>Sum Calculator:</strong> Write a loop that calculates the sum of all numbers from 1 to 100.</li>
        <li><strong>Even Number Finder:</strong> Write a loop that prints all even numbers between 1 and 50.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Pattern Printer):</strong></p>
        <pre><code>// PHP: Triangle pattern
for ($row = 1; $row <= 5; $row++) {
    $stars = str_repeat("*", $row);
    echo "$stars\n";
}

// Output:
// *
// **
// ***
// ****
// *****</code></pre>
        <p><strong>Answer 2 (Sum Calculator):</strong></p>
        <pre><code>// PHP: Sum of 1 to 100
$sum = 0;
for ($i = 1; $i <= 100; $i++) {
    $sum += $i;
}
echo "Sum: $sum\n";

// Output: Sum: 5050</code></pre>
        <p><strong>Answer 3 (Even Number Finder):</strong></p>
        <pre><code>// PHP: Even numbers from 1 to 50
echo "Even numbers: ";
for ($i = 2; $i <= 50; $i += 2) {
    echo "$i ";
}
echo "\n";

// Output: Even numbers: 2 4 6 8 10 12 14 16 18 20 22 24 26 28 30 32 34 36 38 40 42 44 46 48 50</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
