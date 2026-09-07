<?php $pageTitle = 'PHP Numbers'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Numbers</h1>
    <p class="lesson-desc">Work with integers, floats, and mathematical operations in PHP.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you calculate your monthly budget? What math operations do you use?</li>
        <li>When you calculate grades, what's the difference between using whole numbers versus decimals?</li>
        <li>In the previous lesson, we worked with text. How is working with numbers different?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>PHP numbers include integers (whole numbers) and floats (decimal numbers). PHP provides many mathematical functions for calculations.</p>

<h3>Analogy</h3>
<p>Numbers are like tools in a calculator. Integers are like whole dollar bills, while cents are like decimals. You need different tools for different calculations.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Integers are whole numbers: 42, -7, 0</p>
<p>2. Floats have decimals: 3.14, -0.5, 19.99</p>
<p>3. Use arithmetic operators: +, -, *, /, %, **</p>
<p>4. Use functions like round(), ceil(), floor() for rounding</p>
<p>5. Use rand() for random numbers</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Store a price
$price = 29.99;
echo "Price: " . $price;

// Calculate 8% tax
echo "\n";
$tax = $price * 0.08;
echo "Tax: " . round($tax, 2);

// Calculate total
echo "\n";
$total = $price + $tax;
echo "Total: " . round($total, 2);

// Round numbers
echo "\n";
echo "Round 3.7: " . round(3.7);
echo "\n";
echo "Round 3.2: " . round(3.2);
</code></pre>
<strong>Output:</strong>
<pre>Price: 29.99
Tax: 2.4
Total: 32.39
Round 3.7: 4
Round 3.2: 3</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Financial calculations (taxes, discounts, interest)</li>
    <li>Statistics and data analysis (averages, percentages)</li>
    <li>Game development (scores, physics, random events)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use number_format() for currency and formatted output</li>
    <li>Be careful with floating-point precision (0.1 + 0.2 ≠ 0.3)</li>
    <li>Use abs() for absolute values and rand() for random numbers</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Comparing floats with == (use abs($a - $b) < 0.0001 instead)</li>
    <li>Forgetting order of operations (PEMDAS/BODMAS)</li>
    <li>Not using parentheses when mixing operations</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a simple calculator application for a school project.</p>
    <p><strong>Task:</strong> Create a calculator that performs basic operations.</p>
    <ol>
        <li>Write code to calculate the area of a circle with radius 7 (Area = π × r²)</li>
        <li>Create a temperature converter (F = (C × 9/5) + 32)</li>
        <li>Build a tip calculator that takes a bill amount and calculates 15% and 20% tips</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use pi() function and exponentiation operator</p>
        <p><strong>Answer 2:</strong> Apply the conversion formula</p>
        <p><strong>Answer 3:</strong> Calculate percentages and format output</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// Circle area
$radius = 7;
$area = pi() * $radius ** 2;
echo "Area: " . number_format($area, 2);
echo "\n";

// Temperature conversion
$celsius = 25;
$fahrenheit = ($celsius * 9/5) + 32;
echo "$celsius°C = $fahrenheit°F";
echo "\n";

// Tip calculator
$bill = 50.00;
$tip15 = $bill * 0.15;
$tip20 = $bill * 0.20;
echo "Bill: $" . number_format($bill, 2);
echo "\n";
echo "15% tip: $" . number_format($tip15, 2);
echo "\n";
echo "20% tip: $" . number_format($tip20, 2);
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>