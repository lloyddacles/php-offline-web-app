<?php $pageTitle = 'Conditional Statements'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Conditional Statements</h1>
    <p class="lesson-desc">Make your code decide between different paths using if, elif, and else.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What are the three types of conditional statements in Python?</li>
        <li>What is the purpose of the colon (<code>:</code>) at the end of an <code>if</code> statement?</li>
        <li>What is a ternary expression, and when would you use it instead of a full if/else block?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Conditional statements let your program make decisions. Python uses <code>if</code> to test a condition, <code>elif</code> to test additional conditions, and <code>else</code> as a fallback. Each block is followed by a colon and an indented block of code that runs only when the condition is true.</p>

<h3>Analogy</h3>
<p>Think of conditionals like a choose-your-own-adventure book. At each decision point, you read a question ("Is it raining?"). If yes, you turn to one page. If no, you turn to another. The <code>elif</code> options are like backup questions when the first condition doesn't apply — "Is it snowing? Is it sunny?" The <code>else</code> is the default path when nothing else matches.</p>

<h3>How It Works</h3>
<p>Python evaluates conditions from top to bottom. When it finds a true condition, it executes that block and skips the rest. If no condition is true, it runs the <code>else</code> block (if present). The ternary expression <code>"yes" if condition else "no"</code> is a shorthand for simple if/else assignments.</p>

<h3>Example</h3>
<pre><code class="language-python"># Basic if/elif/else
temperature = 72

if temperature > 85:
    print("It's hot outside!")
elif temperature > 65:
    print("It's nice outside!")  # This runs
elif temperature > 40:
    print("It's cool outside!")
else:
    print("It's cold outside!")

# Ternary expression
age = 20
status = "adult" if age >= 18 else "minor"
print(f"You are an {status}")

# Nested conditionals
score = 85
has_bonus = True

if score >= 80:
    if has_bonus:
        grade = "A+"
    else:
        grade = "A"
else:
    grade = "B"
print(f"Grade: {grade}")
</code></pre>
<strong>Output:</strong>
<pre>It's nice outside!
You are an adult
Grade: A+</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Login Systems:</strong> Check if username/password is correct before granting access</li>
    <li><strong>Discount Logic:</strong> Apply different discount percentages based on customer tier</li>
    <li><strong>Form Validation:</strong> Verify that email, phone, and age inputs are valid</li>
    <li><strong>Game Mechanics:</strong> Determine win/lose/tie based on player and computer choices</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Order your conditions from most specific to least specific</li>
    <li>Use the ternary expression for simple one-line assignments</li>
    <li>Avoid deeply nested if/else — refactor into functions or use early returns</li>
    <li>Leverage Python's truthiness: <code>if items:</code> is cleaner than <code>if len(items) > 0:</code></li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting the colon after <code>if</code>, <code>elif</code>, or <code>else</code></li>
    <li>Using assignment <code>=</code> instead of comparison <code>==</code> inside conditions</li>
    <li>Misordering elif conditions — Python stops at the first true condition</li>
    <li>Writing <code>else if</code> instead of <code>elif</code></li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a movie ticket pricing system. The price depends on the customer's age and whether it's a weekend. Children (under 12) pay $8, adults (12-64) pay $12, and seniors (65+) pay $9. Weekend tickets cost $2 more.</p>
    <p><strong>Task:</strong> Write a program that calculates the ticket price based on age and day of the week.</p>
    <ol>
        <li>Create variables for age and is_weekend (boolean)</li>
        <li>Use if/elif/else to determine the base price</li>
        <li>Add the weekend surcharge using a conditional</li>
        <li>Print the final price using an f-string</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should use if/elif/else to set base price, then apply weekend surcharge.</p>
        <pre><code># Movie ticket pricing
age = 35
is_weekend = True

# Determine base price
if age < 12:
    base_price = 8
elif age < 65:
    base_price = 12
else:
    base_price = 9

# Apply weekend surcharge
final_price = base_price + (2 if is_weekend else 0)

print(f"Age: {age}")
print(f"Weekend: {is_weekend}")
print(f"Base price: ${base_price}")
print(f"Final price: ${final_price}")</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
