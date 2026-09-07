<?php $pageTitle = 'Conditional Logic'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Conditional Logic</h1>
    <p class="lesson-desc">Learn to think in decisions — every conditional is just asking a question and acting on the answer.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When do you make decisions during the day? Can you think of a time when you said "If this, then that"?</li>
        <li>If it's raining outside, what do you do? What if it's sunny? How does the weather determine your actions?</li>
        <li>Have you ever checked if you had enough money before buying something? How did that decision process work?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Conditional logic</strong> is the ability to make decisions in code. You ask a question (a condition), and based on whether the answer is true or false, you take different actions. The main tools are <code>if</code>, <code>else</code>, and <code>elseif</code> statements.</p>

<h3>Analogy</h3>
<p>Think of a traffic light. The light "asks" a question: "What color am I?" If green → go. If yellow → slow down. If red → stop. Your program does the same thing — it asks a question and acts based on the answer.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Write a condition:</strong> Use comparison operators (==, !=, >, <, >=, <=) to create a true/false question.</li>
    <li><strong>Use if:</strong> The code inside the if block runs only when the condition is true.</li>
    <li><strong>Use else:</strong> The else block runs when the condition is false (the "otherwise" case).</li>
    <li><strong>Use elseif:</strong> Check additional conditions when the first one is false.</li>
    <li><strong>Combine conditions:</strong> Use AND (&&), OR (||), and NOT (!) to create complex decisions.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a student's age
$age = 20;
// Check if age is 18 or older
if ($age >= 18) {
    // Student can vote
    echo "You can vote!";
} else {
    // Student cannot vote
    echo "You are too young to vote.";
}
</code></pre>
<strong>Output:</strong>
<pre>You can vote!</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a student's age
age = 20
# Check if age is 18 or older
if age >= 18:
    # Student can vote
    print("You can vote!")
else:
    # Student cannot vote
    print("You are too young to vote.")
</code></pre>
<strong>Output:</strong>
<pre>You can vote!</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a student's age
        int age = 20;
        // Check if age is 18 or older
        if (age >= 18) {
            // Student can vote
            System.out.println("You can vote!");
        } else {
            // Student cannot vote
            System.out.println("You are too young to vote.");
        }
    }
}
</code></pre>
<strong>Output:</strong>
<pre>You can vote!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Form validation:</strong> Checking if email addresses are valid, passwords meet requirements, or fields aren't empty.</li>
    <li><strong>Access control:</strong> Determining if a user has permission to view a page or perform an action.</li>
    <li><strong>Game rules:</strong> Checking if a player has enough health, has collected an item, or has reached a goal.</li>
    <li><strong>E-commerce:</strong> Applying discounts, checking stock availability, and calculating shipping costs.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use <code>===</code> (strict comparison) instead of <code>==</code> when possible to avoid type juggling bugs.</li>
    <li>Handle the "else" case — don't leave unexpected inputs unhandled.</li>
    <li>Keep nesting shallow (no more than 2-3 levels) for readability.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Using = instead of ==:</strong> Writing <code>if ($x = 5)</code> assigns 5 to $x instead of comparing.</li>
    <li><strong>Missing else case:</strong> Not handling unexpected inputs can cause your program to crash or behave unpredictably.</li>
    <li><strong>Confusing && and ||:</strong> Draw a truth table if you're unsure how conditions combine.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a login system for a school portal. The system needs to validate the user's credentials before granting access.</p>
    <p><strong>Task:</strong> Write conditional logic for the following rules:</p>
    <ol>
        <li>Username must be at least 3 characters long and cannot be empty.</li>
        <li>Password must be at least 8 characters long and must contain at least one number.</li>
        <li>If both are valid, display "Login successful!" If either fails, display a specific error message explaining what went wrong.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Check <code>strlen($username) >= 3 && !empty($username)</code>. The empty check catches empty strings, while the length check ensures it's at least 3 characters.</p>
        <p><strong>Answer 2:</strong> Check <code>strlen($password) >= 8</code> AND use <code>preg_match('/[0-9]/', $password)</code> to verify at least one digit exists.</p>
        <p><strong>Answer 3 (Sample Solution):</strong></p>
        <pre><code>// PHP Login Validation
$username = "alice";
$password = "pass1234";

// Validate username
if (empty($username)) {
    echo "Error: Username cannot be empty.\n";
} elseif (strlen($username) < 3) {
    echo "Error: Username must be at least 3 characters.\n";
} elseif (empty($password)) {
    echo "Error: Password cannot be empty.\n";
} elseif (strlen($password) < 8) {
    echo "Error: Password must be at least 8 characters.\n";
} elseif (!preg_match('/[0-9]/', $password)) {
    echo "Error: Password must contain at least one number.\n";
} else {
    echo "Login successful! Welcome, $username.\n";
}

// Output: Login successful! Welcome, alice.</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
