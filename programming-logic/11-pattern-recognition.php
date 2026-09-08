<?php $pageTitle = 'Pattern Recognition'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 11; $sectionDir = 'programming-logic'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Pattern Recognition</h1>
    <p class="lesson-desc">Learn to spot repeated patterns in code and data, and transform them into clean, reusable solutions.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What patterns do you see in nature? (sunrise/sunset, seasons, day/night cycle)</li>
        <li>Think about your daily routine. What parts repeat every day? How does recognizing that pattern help you plan?</li>
        <li>When you listen to music, how do you recognize the chorus? What makes it a pattern?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Pattern recognition</strong> is the ability to identify similarities, trends, or recurring structures in data and code. When you spot a pattern, you can reuse solutions instead of starting from scratch, making your code shorter, clearer, and easier to maintain.</p>

<h3>Analogy</h3>
<p>Think of a cookie cutter. Instead of shaping each cookie by hand (repetitive work), you use a cutter once and press it into the dough repeatedly. Pattern recognition in programming is like finding the "cookie cutter" — the repeated logic that you can extract and reuse.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Look for repetition:</strong> Find code or data that appears multiple times with slight variations.</li>
    <li><strong>Identify what changes:</strong> Determine which parts stay the same and which parts differ between repetitions.</li>
    <li><strong>Abstract the pattern:</strong> Create a function or loop that handles the varying parts as inputs.</li>
    <li><strong>Apply the abstraction:</strong> Replace the repeated code with calls to the new function or loop.</li>
    <li><strong>Test and verify:</strong> Make sure the abstracted code produces the same results as the original.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a list of numbers
$numbers = [1, 2, 3, 4, 5];
// Start with sum at 0
$sum = 0;
// Loop through each number
foreach ($numbers as $num) {
    // Add number to sum
    $sum += $num;
}
// Print the sum
echo "Sum: $sum";
</code></pre>
<strong>Output:</strong>
<pre>Sum: 15</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a list of numbers
numbers = [1, 2, 3, 4, 5]
# Start with sum at 0
total = 0
# Loop through each number
for num in numbers:
    # Add number to total
    total += num
# Print the sum
print(f"Sum: {total}")
</code></pre>
<strong>Output:</strong>
<pre>Sum: 15</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a list of numbers
        int[] numbers = {1, 2, 3, 4, 5};
        // Start with sum at 0
        int sum = 0;
        // Loop through each number
        for (int num : numbers) {
            // Add number to sum
            sum += num;
        }
        // Print the sum
        System.out.println("Sum: " + sum);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Sum: 15</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Data analysis:</strong> Finding trends in sales data, student performance, or website traffic.</li>
    <li><strong>Predictions:</strong> Using historical patterns to forecast future outcomes.</li>
    <li><strong>Optimization:</strong> Identifying repeated operations that can be combined or simplified.</li>
    <li><strong>Code refactoring:</strong> Transforming repeated code into reusable functions or loops.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use the "Rule of Three": if you see the same pattern three times, it's time to abstract it.</li>
    <li>Look for what changes between repetitions — those become your function parameters.</li>
    <li>Keep your abstractions simple and focused on one task.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Over-abstracting:</strong> Don't create a function for something that only appears once.</li>
    <li><strong>Making abstractions too complex:</strong> If a function does too many things, split it.</li>
    <li><strong>Ignoring patterns:</strong> Repeated code is a bug waiting to happen — if you change one instance, you might forget the others.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're given several number sequences and need to identify the pattern to predict the next values.</p>
    <p><strong>Task:</strong> Identify the patterns and predict the next values.</p>
    <ol>
        <li>Sequence: 2, 4, 6, 8, 10, ___. What comes next? What is the pattern?</li>
        <li>Sequence: 3, 6, 12, 24, 48, ___. What comes next? What is the pattern?</li>
        <li>Sequence: 1, 1, 2, 3, 5, 8, ___. What comes next? What is the pattern?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Next value: 12. Pattern: Add 2 to each number (arithmetic sequence with common difference of 2). This is the even numbers sequence.</p>
        <p><strong>Answer 2:</strong> Next value: 96. Pattern: Multiply each number by 2 (geometric sequence with common ratio of 2). Each number is double the previous.</p>
        <p><strong>Answer 3:</strong> Next value: 13. Pattern: Fibonacci sequence — each number is the sum of the two preceding numbers (5 + 8 = 13).</p>
        <p><strong>PHP Implementation:</strong></p>
        <pre><code>// Pattern 1: Arithmetic sequence (add 2)
echo "Sequence 1: ";
$num = 10;
for ($i = 1; $i <= 5; $i++) {
    $num += 2;
    echo "$num ";
}
echo "\n"; // Output: 12 14 16 18 20

// Pattern 2: Geometric sequence (multiply by 2)
echo "Sequence 2: ";
$num = 48;
for ($i = 1; $i <= 5; $i++) {
    $num *= 2;
    echo "$num ";
}
echo "\n"; // Output: 96 192 384 768 1536

// Pattern 3: Fibonacci sequence
echo "Sequence 3: ";
$a = 5;
$b = 8;
for ($i = 1; $i <= 5; $i++) {
    $c = $a + $b;
    echo "$c ";
    $a = $b;
    $b = $c;
}
echo "\n"; // Output: 13 21 34 55 89</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
