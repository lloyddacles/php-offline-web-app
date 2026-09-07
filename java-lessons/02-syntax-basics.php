<?php $pageTitle = 'Java Syntax Basics'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 2; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Java Syntax Basics</h1>
    <p class="lesson-desc">Master the fundamental building blocks of Java: classes, methods, statements, and how to output text to the console.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the entry point of every Java program? What is it called?</li>
        <li>What symbol marks the end of a Java statement?</li>
        <li>Why does Java require code to be enclosed in curly braces <code>{ }</code>?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Java syntax is the set of rules that defines how programs must be written. Every Java program lives inside a <strong>class</strong>, starts at the <code>main</code> method, and uses <strong>statements</strong> ending with semicolons to perform actions.</p>

<h3>Analogy</h3>
<p>Think of Java syntax like grammar rules in English. You need a subject and verb to make a sentence. In Java, you need a class, a main method, and properly terminated statements to make a working program.</p>

<h3>How It Works</h3>
<p>A Java program has this structure:</p>
<ul>
    <li><strong>Class</strong> — A container for your code (name must match filename)</li>
    <li><strong>Main method</strong> — The starting point: <code>public static void main(String[] args)</code></li>
    <li><strong>Statements</strong> — Individual instructions ending with <code>;</code></li>
    <li><strong>Comments</strong> — Notes ignored by the compiler (<code>// single-line</code> or <code>/* multi-line */</code>)</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class Main {                         // Class is a container for code
    public static void main(String[] args) { // Main method is the entry point
        // Print text to the console
        System.out.println("Hello!");        // println adds a new line
        System.out.print("World");           // print stays on same line
        System.out.println("!");             // This continues on same line

        // Variables store data
        String name = "Maria";               // String holds text
        int age = 21;                        // int holds whole numbers
        System.out.println(name + " is " + age); // Combine text with +
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Hello!
World!
Maria is 21</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Logging</strong> — <code>System.out.println()</code> is used to debug and track program behavior</li>
    <li><strong>Code Documentation</strong> — Comments explain complex logic to other developers</li>
    <li><strong>Code Organization</strong> — Code blocks group related instructions together</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <strong>PascalCase</strong> for class names (e.g., <code>MyClass</code>)</li>
    <li>Use <strong>camelCase</strong> for method and variable names (e.g., <code>calculateTotal</code>)</li>
    <li>Use <strong>UPPER_SNAKE_CASE</strong> for constants (e.g., <code>MAX_SIZE</code>)</li>
    <li>Always use <code>println</code> when you want output on a new line</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting the semicolon — the most common beginner error</li>
    <li>Mismatched braces — every <code>{</code> must have a matching <code>}</code></li>
    <li>Capitalizing <code>System</code> incorrectly — it must be uppercase <code>S</code></li>
    <li>Using <code>print</code> when you meant <code>println</code> (output stays on same line)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are creating a simple profile card program that displays a person's name, age, and city on separate lines.</p>
    <p><strong>Task:</strong> Write a complete Java program that prints a formatted profile card using proper syntax.</p>
    <ol>
        <li>Create a class called <code>ProfileCard</code></li>
        <li>Use variables to store name, age, and city</li>
        <li>Print each piece of information on its own line with a label</li>
        <li>Add at least one single-line comment and one multi-line comment</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point
        String name = "Ana";                 // Store name
        int age = 20;                        // Store age
        String city = "Manila";              // Store city

        System.out.println("=== Profile Card ==="); // Print header
        System.out.println("Name: " + name);        // Print name
        System.out.println("Age: " + age);           // Print age
        System.out.println("City: " + city);         // Print city
        System.out.println("===================="); // Print footer
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>=== Profile Card ===
Name: Ana
Age: 20
City: Manila
====================</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
