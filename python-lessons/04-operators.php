<?php $pageTitle = 'Python Operators'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Python Operators</h1>
    <p class="lesson-desc">Use arithmetic, comparison, and logical operators to manipulate data and make decisions.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between the <code>=</code> and <code>==</code> operators?</li>
        <li>In mathematics, what does the modulus operator (<code>%</code>) calculate?</li>
        <li>What is the difference between <code>and</code>, <code>or</code>, and <code>not</code> in programming?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Operators are special symbols that perform operations on values (operands). Python provides <strong>arithmetic</strong> operators for math, <strong>comparison</strong> operators for evaluating conditions, and <strong>logical</strong> operators for combining boolean expressions.</p>

<h3>Analogy</h3>
<p>Think of operators as the verbs in a sentence. If variables are nouns (the things you're working with), operators are the actions you perform on them. Just like verbs tell you what's happening — "add," "compare," "combine" — operators tell Python what to do with your data.</p>

<h3>How It Works</h3>
<p>Arithmetic operators (+, -, *, /, //, %, **) return numbers. Comparison operators (==, !=, >, <, >=, <=) return <code>True</code> or <code>False</code>. Logical operators (and, or, not) combine boolean expressions. Python also has <strong>identity</strong> (<code>is</code>) and <strong>membership</strong> (<code>in</code>) operators.</p>

<h3>Example</h3>
<pre><code class="language-python"># Calculate student average
score1 = 85
score2 = 90
score3 = 78

# Add scores and divide by count
average = (score1 + score2 + score3) / 3
print("Average:", average)

# Check if passing
passed = average >= 75
print("Passed:", passed)
</code></pre>
<strong>Output:</strong>
<pre>Average: 84.33333333333333
Passed: True</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>E-commerce:</strong> Calculate discounts, taxes, and totals with arithmetic operators</li>
    <li><strong>Form Validation:</strong> Use comparison operators to check if inputs meet requirements</li>
    <li><strong>Search Filters:</strong> Combine conditions with logical operators (e.g., price > 10 AND rating >= 4)</li>
    <li><strong>Game Logic:</strong> Check if a player's score meets thresholds for levels or achievements</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Remember: <code>/</code> always returns a float. Use <code>//</code> if you need integer division</li>
    <li>Use parentheses to make complex expressions clear: <code>(a + b) * c</code></li>
    <li>Use <code>in</code> to check if a value exists in a list or string: <code>"apple" in fruits</code></li>
    <li>Know operator precedence: <code>**</code> first, then <code>*</code>/<code>/</code>, then <code>+</code>/<code>-</code></li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using <code>=</code> (assignment) instead of <code>==</code> (comparison) in conditions</li>
    <li>Expecting <code>/</code> to return an integer — it always returns a float</li>
    <li>Confusing <code>is</code> (identity) with <code>==</code> (equality) — they check different things</li>
    <li>Ignoring operator precedence: <code>2 + 3 * 4</code> is 14, not 20</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a shopping cart. The cart has items with prices, and you need to apply a discount, calculate tax, and check if the customer qualifies for free shipping (orders over $50).</p>
    <p><strong>Task:</strong> Use operators to calculate the final price and determine shipping eligibility.</p>
    <ol>
        <li>Create variables for item price, quantity, discount percentage, and tax rate</li>
        <li>Calculate the subtotal, discount amount, tax, and final total</li>
        <li>Use comparison and logical operators to check if the order qualifies for free shipping</li>
        <li>Print a receipt showing all values</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should apply arithmetic and comparison operators correctly.</p>
        <pre><code># Shopping cart calculations
price = 29.99
quantity = 2
discount = 10

# Calculate total
subtotal = price * quantity
savings = subtotal * (discount / 100)
total = subtotal - savings

print("Price:", price)
print("Quantity:", quantity)
print("Subtotal:", subtotal)
print("Discount:", savings)
print("Total:", total)
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
