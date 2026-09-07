<?php $pageTitle = 'Conditional Statements'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Conditional Statements</h1>
    <p class="lesson-desc">Learn how to make your programs decide between different paths using if/else, switch-case, and the ternary operator.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a boolean expression? What values can it have?</li>
        <li>How do the comparison operators (<code>==</code>, <code>!=</code>, <code>&gt;</code>, <code>&lt;</code>) work?</li>
        <li>Can you think of a real-life decision where you choose between more than two options?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Conditional statements allow your program to make decisions. Based on whether a condition is <code>true</code> or <code>false</code>, Java executes different blocks of code. The three main types are <code>if/else</code>, <code>switch</code>, and the <strong>ternary operator</strong>.</p>

<h3>Analogy</h3>
<p>Think of conditionals like a traffic light. Green means go (execute this block), red means stop (skip this block), and yellow means check another condition first. Your program checks conditions one by one and follows the path that matches.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>if</strong> — Executes a block only when the condition is true</li>
    <li><strong>if-else</strong> — Provides an alternative block when the condition is false</li>
    <li><strong>if-else if-else</strong> — Chains multiple conditions together</li>
    <li><strong>switch</strong> — Compares one variable against many specific values</li>
    <li><strong>Ternary</strong> — A compact one-line if-else: <code>condition ? a : b</code></li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class ConditionalsDemo {
    public static void main(String[] args) {
        // if-else if-else chain
        int score = 85;
        String grade;

        if (score >= 90) {
            grade = "A";
        } else if (score >= 80) {
            grade = "B";
        } else if (score >= 70) {
            grade = "C";
        } else if (score >= 60) {
            grade = "D";
        } else {
            grade = "F";
        }
        System.out.println("Score: " + score + " => Grade: " + grade);

        // switch statement
        int day = 3;
        String dayName;

        switch (day) {
            case 1: dayName = "Monday"; break;
            case 2: dayName = "Tuesday"; break;
            case 3: dayName = "Wednesday"; break;
            case 4: dayName = "Thursday"; break;
            case 5: dayName = "Friday"; break;
            default: dayName = "Weekend"; break;
        }
        System.out.println("Day " + day + " is " + dayName);

        // Ternary operator
        int age = 20;
        String type = (age >= 18) ? "Adult" : "Minor";
        System.out.println("Age " + age + " => " + type);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Score: 85 => Grade: B
Day 3 is Wednesday
Age 20 => Adult</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Grade calculators</strong> — Convert numeric scores to letter grades</li>
    <li><strong>Authentication</strong> — Check if username and password match before granting access</li>
    <li><strong>Menu systems</strong> — Use switch to handle user selections (1 = New Game, 2 = Settings, etc.)</li>
    <li><strong>Form validation</strong> — Check if required fields are filled before submission</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Order matters in if-else chains — put the most specific conditions first</li>
    <li>Always include a <code>default</code> case in switch statements for unexpected values</li>
    <li>Use the ternary operator for simple assignments — it keeps code concise</li>
    <li>Use <code>break</code> in each switch case to prevent fall-through</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting <code>break</code> in switch cases — causes fall-through to the next case</li>
    <li>Using <code>=</code> instead of <code>==</code> in conditions — assignment instead of comparison</li>
    <li>Not handling the else case — leaves unexpected scenarios unhandled</li>
    <li>Using <code>==</code> to compare Strings — use <code>.equals()</code> instead for content comparison</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a simple ATM system. The program needs to check the user's balance before allowing a withdrawal, and display different messages based on the account type (savings, checking, premium).</p>
    <p><strong>Task:</strong> Write a Java program that handles withdrawal logic with conditionals.</p>
    <ol>
        <li>Create a class called <code>ATMSystem</code></li>
        <li>Declare variables for balance, withdrawal amount, and account type</li>
        <li>Use if-else to check if the balance is sufficient</li>
        <li>Use switch to handle different account types and their withdrawal limits</li>
        <li>Use the ternary operator to display a status message</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class ATMSystem {
    public static void main(String[] args) {
        double balance = 5000.00;
        double withdrawAmount = 2000.00;
        String accountType = "savings";

        // Check if balance is sufficient
        if (withdrawAmount > balance) {
            System.out.println("Insufficient funds!");
            return;
        }

        // Determine withdrawal limit based on account type
        double limit;
        switch (accountType) {
            case "savings":
                limit = 10000.00;
                break;
            case "checking":
                limit = 15000.00;
                break;
            case "premium":
                limit = 50000.00;
                break;
            default:
                limit = 5000.00;
                break;
        }

        // Check if within limit
        if (withdrawAmount > limit) {
            System.out.println("Exceeds " + accountType + " limit of $" + limit);
        } else {
            balance -= withdrawAmount;
            System.out.println("Withdrew $" + withdrawAmount);
            System.out.println("Remaining balance: $" + balance);
        }

        // Ternary operator for status
        String status = (balance > 1000) ? "Account in good standing" : "Low balance warning";
        System.out.println("Status: " + status);
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Withdrew $2000.0
Remaining balance: $3000.0
Status: Account in good standing</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
