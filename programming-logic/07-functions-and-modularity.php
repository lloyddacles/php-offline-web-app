<?php $pageTitle = 'Functions & Modularity'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Functions &amp; Modularity</h1>
    <p class="lesson-desc">Give a name to a thought — functions let you write code once and reuse it everywhere.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Do you have a favorite recipe you make over and over? How does having it written down make things easier?</li>
        <li>When you use a calculator, do you type out the full multiplication process every time, or do you just press the "×" button? What does the button represent?</li>
        <li>Think about shortcuts on your phone or computer. How do they save you time?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Functions</strong> are reusable blocks of code that perform a specific task. You write the code once, give it a name, and then call it whenever you need it. Functions can take inputs (parameters) and return outputs (return values).</p>

<h3>Analogy</h3>
<p>A function is like a vending machine. You put in money and press a button (input/parameters), the machine does its work (processes), and it gives you a snack (output/return value). You don't need to know how the machine works inside — you just use it. That's abstraction!</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Define the function:</strong> Use the <code>function</code> keyword, give it a name, and write the code inside curly braces.</li>
    <li><strong>Add parameters:</strong> List the inputs the function needs in parentheses after the name.</li>
    <li><strong>Write the body:</strong> The code inside the function runs when you call it.</li>
    <li><strong>Return a result:</strong> Use <code>return</code> to send a value back to whoever called the function.</li>
    <li><strong>Call the function:</strong> Use the function name followed by parentheses and any arguments.</li>
</ol>

<h3>Example</h3>
<pre><code class="language-php">// PHP Example: Functions for a calculator

// Function with no parameters, no return
function sayHello() {
    echo "Hello, World!\n";
}
sayHello();

// Function with parameters
function greet($name) {
    echo "Hello, $name!\n";
}
greet("Alice");
greet("Bob");

// Function with return value
function add($a, $b) {
    return $a + $b;
}
$sum = add(5, 3);
echo "5 + 3 = $sum\n";

// Function returning boolean
function isEven($n) {
    return $n % 2 === 0;
}
echo "4 is even: " . (isEven(4) ? "yes" : "no") . "\n";
echo "7 is even: " . (isEven(7) ? "yes" : "no") . "\n";
</code></pre>
<strong>Output:</strong>
<pre>Hello, World!
Hello, Alice!
Hello, Bob!
5 + 3 = 8
4 is even: yes
7 is even: no</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Python Example: Functions for a calculator

# Function with no parameters, no return
def say_hello():
    print("Hello, World!")
say_hello()

# Function with parameters
def greet(name):
    print(f"Hello, {name}!")
greet("Alice")
greet("Bob")

# Function with return value
def add(a, b):
    return a + b
total = add(5, 3)
print(f"5 + 3 = {total}")

# Function returning boolean
def is_even(n):
    return n % 2 == 0
print(f"4 is even: {'yes' if is_even(4) else 'no'}")
print(f"7 is even: {'yes' if is_even(7) else 'no'}")
</code></pre>
<strong>Output:</strong>
<pre>Hello, World!
Hello, Alice!
Hello, Bob!
5 + 3 = 8
4 is even: yes
7 is even: no</pre>

<h3>Java Example</h3>
<pre><code class="language-java">// Java Example: Functions for a calculator
public class Main {
    // Function with no parameters, no return
    static void sayHello() {
        System.out.println("Hello, World!");
    }

    // Function with parameters
    static void greet(String name) {
        System.out.println("Hello, " + name + "!");
    }

    // Function with return value
    static int add(int a, int b) {
        return a + b;
    }

    // Function returning boolean
    static boolean isEven(int n) {
        return n % 2 == 0;
    }

    public static void main(String[] args) {
        sayHello();
        greet("Alice");
        greet("Bob");
        int sum = add(5, 3);
        System.out.println("5 + 3 = " + sum);
        System.out.println("4 is even: " + (isEven(4) ? "yes" : "no"));
        System.out.println("7 is even: " + (isEven(7) ? "yes" : "no"));
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Hello, World!
Hello, Alice!
Hello, Bob!
5 + 3 = 8
4 is even: yes
7 is even: no</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Code reuse:</strong> Write a validation function once and use it across your entire application.</li>
    <li><strong>Readability:</strong> Functions like <code>calculateTax()</code> make code self-documenting.</li>
    <li><strong>Team collaboration:</strong> Different team members can work on different functions independently.</li>
    <li><strong>Testing:</strong> Functions can be tested in isolation, making debugging easier.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Give functions descriptive names — <code>calculateTotal()</code> is better than <code>doStuff()</code>.</li>
    <li>Follow the Single Responsibility Principle: each function should do one thing well.</li>
    <li>Avoid using <code>global</code> variables — pass data as parameters instead.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Functions that do too much:</strong> If a function validates input AND saves to database AND sends email, split it into separate functions.</li>
    <li><strong>Poor naming:</strong> Names like <code>process()</code> or <code>handle()</code> don't tell you what the function does.</li>
    <li><strong>Not returning values:</strong> Forgetting <code>return</code> means the function always returns null/None.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a simple calculator application. The teacher asks you to create four separate functions: add, subtract, multiply, and divide.</p>
    <p><strong>Task:</strong> Create functions for a calculator and test them.</p>
    <ol>
        <li>Write a function <code>add($a, $b)</code> that returns the sum of two numbers.</li>
        <li>Write functions for subtract, multiply, and divide. For divide, handle the case where the divisor is zero.</li>
        <li>Write a main program that calls all four functions with different inputs and displays the results.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (add function):</strong></p>
        <pre><code>function add($a, $b) {
    return $a + $b;
}</code></pre>
        <p><strong>Answer 2 (all functions):</strong></p>
        <pre><code>function subtract($a, $b) {
    return $a - $b;
}

function multiply($a, $b) {
    return $a * $b;
}

function divide($a, $b) {
    if ($b == 0) {
        return "Error: Division by zero";
    }
    return $a / $b;
}</code></pre>
        <p><strong>Answer 3 (main program):</strong></p>
        <pre><code>// Calculator test program
$num1 = 20;
$num2 = 5;

echo "Numbers: $num1 and $num2\n";
echo "Add: " . add($num1, $num2) . "\n";
echo "Subtract: " . subtract($num1, $num2) . "\n";
echo "Multiply: " . multiply($num1, $num2) . "\n";
echo "Divide: " . divide($num1, $num2) . "\n";
echo "Divide by zero: " . divide($num1, 0) . "\n";

// Output:
// Numbers: 20 and 5
// Add: 25
// Subtract: 15
// Multiply: 100
// Divide: 4
// Divide by zero: Error: Division by zero</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
