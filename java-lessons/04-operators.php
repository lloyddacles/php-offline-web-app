<?php $pageTitle = 'Java Operators'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Java Operators</h1>
    <p class="lesson-desc">Explore the full range of Java operators: arithmetic, comparison, logical, and the ternary operator.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In math, what does the <code>+</code>, <code>-</code>, <code>*</code>, and <code>/</code> operator do? How might they behave differently in programming?</li>
        <li>What does it mean to compare two values? What result do you expect from <code>5 > 3</code>?</li>
        <li>Can you think of a situation where you need to check if two conditions are both true at the same time?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Operators are symbols that perform operations on values (<strong>operands</strong>). Java provides arithmetic operators for math, comparison operators for decisions, logical operators for combining conditions, and assignment operators for storing results.</p>

<h3>Analogy</h3>
<p>Think of operators like tools in a toolbox. A hammer (+) adds things together. A ruler (==) measures if two things are equal. A filter (&&) checks if multiple conditions pass. Each tool serves a specific purpose.</p>

<h3>How It Works</h3>
<p>Java has four main categories of operators:</p>
<ul>
    <li><strong>Arithmetic</strong> — <code>+ - * / % ++ --</code> (math operations)</li>
    <li><strong>Comparison</strong> — <code>== != > < >= <=</code> (return true or false)</li>
    <li><strong>Logical</strong> — <code>&& || !</code> (combine boolean expressions)</li>
    <li><strong>Assignment</strong> — <code>= += -= *= /= %=</code> (store and modify values)</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class OperatorsDemo {
    public static void main(String[] args) {
        int a = 10;
        int b = 3;

        // Arithmetic operators
        System.out.println("a + b = " + (a + b));   // 13
        System.out.println("a - b = " + (a - b));   // 7
        System.out.println("a * b = " + (a * b));   // 30
        System.out.println("a / b = " + (a / b));   // 3 (integer division!)
        System.out.println("a % b = " + (a % b));   // 1 (remainder)

        // Comparison operators
        System.out.println("a == b: " + (a == b));  // false
        System.out.println("a != b: " + (a != b));  // true
        System.out.println("a > b:  " + (a > b));   // true

        // Logical operators
        boolean x = true;
        boolean y = false;
        System.out.println("x && y: " + (x && y));  // false (both must be true)
        System.out.println("x || y: " + (x || y));  // true  (at least one true)
        System.out.println("!x:     " + (!x));       // false (inverts)

        // Ternary operator: condition ? valueIfTrue : valueIfFalse
        String result = (a > b) ? "a is bigger" : "b is bigger";
        System.out.println(result);  // a is bigger
    }
}
</code></pre>
<strong>Output:</strong>
<pre>a + b = 13
a - b = 7
a * b = 30
a / b = 3
a % b = 1
a == b: false
a != b: true
a > b:  true
x && y: false
x || y: true
!x:     false
a is bigger</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Shopping cart</strong> — Use <code>+</code> and <code>*</code> to calculate total price</li>
    <li><strong>Age verification</strong> — Use <code>>=</code> to check if someone is 18 or older</li>
    <li><strong>Login system</strong> — Use <code>&&</code> to check if both username AND password are correct</li>
    <li><strong>Discount calculator</strong> — Use ternary to apply different rates based on conditions</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use parentheses <code>( )</code> to make your intent clear — <code>(a + b) * c</code> is safer than <code>a + b * c</code></li>
    <li>Remember: <code>7 / 2</code> gives <code>3</code>, not <code>3.5</code> — use <code>7.0 / 2</code> for decimal results</li>
    <li>Use <code>+=</code> to increment: <code>count += 5</code> is the same as <code>count = count + 5</code></li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Confusing <code>=</code> (assignment) with <code>==</code> (comparison) — this causes logic bugs</li>
    <li>Integer division truncating decimals — <code>10 / 3</code> gives <code>3</code>, not <code>3.33</code></li>
    <li>Forgetting parentheses in complex expressions — operator precedence can surprise you</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a simple calculator app. A customer buys 3 items at $15.50 each with a 10% discount. You need to calculate the final price and determine if they qualify for free shipping (orders over $40).</p>
    <p><strong>Task:</strong> Write a Java program that calculates the total and checks the shipping condition.</p>
    <ol>
        <li>Declare variables for quantity, price, and discount rate</li>
        <li>Calculate the subtotal, discount amount, and final price</li>
        <li>Use a comparison operator to check if the order qualifies for free shipping</li>
        <li>Use the ternary operator to print "Free Shipping" or "Standard Shipping"</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Calculator {
    public static void main(String[] args) {
        int quantity = 3;
        double price = 15.50;
        double discountRate = 0.10;

        // Calculate totals
        double subtotal = quantity * price;          // 46.50
        double discount = subtotal * discountRate;   // 4.65
        double finalPrice = subtotal - discount;     // 41.85

        // Check free shipping (orders over $40)
        boolean freeShipping = finalPrice > 40;

        // Print results
        System.out.println("Subtotal: $" + subtotal);
        System.out.println("Discount: $" + discount);
        System.out.println("Final Price: $" + finalPrice);

        // Ternary operator for shipping
        String shipping = freeShipping ? "Free Shipping" : "Standard Shipping";
        System.out.println("Shipping: " + shipping);
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Subtotal: $46.5
Discount: $4.65
Final Price: $41.85
Shipping: Free Shipping</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
