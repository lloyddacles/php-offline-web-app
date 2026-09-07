<?php $pageTitle = 'Methods'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Methods</h1>
    <p class="lesson-desc">Learn to declare methods, use parameters and return types, understand scope, and explore method overloading.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is code reuse? Why is it important to avoid repeating the same code in multiple places?</li>
        <li>What is the difference between a variable that holds a value and a block of code that performs a task?</li>
        <li>Can you think of a real-life action that takes input (like ingredients) and produces output (like a meal)?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>method</strong> is a reusable block of code that performs a specific task. Methods take <strong>parameters</strong> (input), perform operations, and optionally <strong>return</strong> a result. They help organize code, avoid repetition, and make programs easier to understand.</p>

<h3>Analogy</h3>
<p>Think of a method like a vending machine. You put in coins (parameters), press a button (call the method), and get a snack (return value). The machine's internal workings are hidden — you just need to know what to put in and what comes out.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>Declaration</strong> — Define the method with access modifier, return type, name, and parameters</li>
    <li><strong>Parameters</strong> — Input values the method receives</li>
    <li><strong>Return type</strong> — The data type of the result (use <code>void</code> if nothing is returned)</li>
    <li><strong>Static methods</strong> — Belong to the class, called without creating an object</li>
    <li><strong>Method overloading</strong> — Multiple methods with the same name but different parameters</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class MethodsDemo {

    // Method with return value
    static int add(int a, int b) {
        return a + b;
    }

    // Method with no return value (void)
    static void greet(String name) {
        System.out.println("Hello, " + name + "!");
    }

    // Method overloading: same name, different parameters
    static int max(int a, int b) {
        return (a > b) ? a : b;
    }

    static double max(double a, double b) {
        return (a > b) ? a : b;
    }

    static int max(int a, int b, int c) {
        return max(max(a, b), c);
    }

    public static void main(String[] args) {
        // Call methods
        int sum = add(15, 25);
        System.out.println("15 + 25 = " + sum);

        greet("Alice");
        greet("Bob");

        // Method overloading in action
        System.out.println("max(10, 20): " + max(10, 20));
        System.out.println("max(3.5, 2.1): " + max(3.5, 2.1));
        System.out.println("max(5, 15, 8): " + max(5, 15, 8));
    }
}
</code></pre>
<strong>Output:</strong>
<pre>15 + 25 = 40
Hello, Alice!
Hello, Bob!
max(10, 20): 20
max(3.5, 2.1): 3.5
max(5, 15, 8): 15</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Math utilities</strong> — Methods for area, perimeter, and unit conversions</li>
    <li><strong>Data validation</strong> — Methods that check if input is valid before processing</li>
    <li><strong>String formatting</strong> — Methods that capitalize names, format dates, or clean input</li>
    <li><strong>Game logic</strong> — Methods for scoring, collision detection, and AI behavior</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Give methods clear, descriptive names — <code>calculateArea()</code> is better than <code>calc()</code></li>
    <li>Keep methods short — each method should do one thing well</li>
    <li>Use overloading to provide convenient variations of the same operation</li>
    <li>Use <code>static</code> for utility methods that don't need object state</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting <code>return</code> in non-void methods — causes a compilation error</li>
    <li>Returning the wrong type — <code>int</code> method cannot return <code>String</code></li>
    <li>Method overloading confusion — return type alone does not determine overloading</li>
    <li>Not calling the method — defining it is not enough; you must invoke it</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a math utility library. You need methods to calculate the area of a circle, check if a number is prime, and format a number as currency.</p>
    <p><strong>Task:</strong> Write a Java class with three utility methods and demonstrate calling them.</p>
    <ol>
        <li>Create a method <code>circleArea(double radius)</code> that returns the area</li>
        <li>Create a method <code>isPrime(int number)</code> that returns true/false</li>
        <li>Create a method <code>formatCurrency(double amount)</code> that returns a formatted string</li>
        <li>Call each method from main and print the results</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class MathUtils {

    // Calculate area of a circle
    static double circleArea(double radius) {
        return Math.PI * radius * radius;
    }

    // Check if a number is prime
    static boolean isPrime(int number) {
        if (number < 2) return false;
        for (int i = 2; i <= Math.sqrt(number); i++) {
            if (number % i == 0) return false;
        }
        return true;
    }

    // Format number as currency
    static String formatCurrency(double amount) {
        return "$" + String.format("%.2f", amount);
    }

    public static void main(String[] args) {
        // Test circleArea
        double radius = 5.0;
        System.out.println("Circle area (r=" + radius + "): " + circleArea(radius));

        // Test isPrime
        int[] testNumbers = {2, 7, 10, 13, 1};
        for (int num : testNumbers) {
            System.out.println(num + " is prime: " + isPrime(num));
        }

        // Test formatCurrency
        double[] prices = {19.99, 150.5, 0.99};
        for (double price : prices) {
            System.out.println("Price: " + formatCurrency(price));
        }
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Circle area (r=5.0): 78.53981633974483
2 is prime: true
7 is prime: true
10 is prime: false
13 is prime: true
1 is prime: false
Price: $19.99
Price: $150.50
Price: $0.99</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
