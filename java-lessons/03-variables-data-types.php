<?php $pageTitle = 'Variables & Data Types'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $sectionDir = 'java-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Variables &amp; Data Types</h1>
    <p class="lesson-desc">Learn how Java stores data in variables, the difference between primitive and reference types, and how to choose the right data type.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a variable in programming? Can you think of a real-life example of something that holds a value?</li>
        <li>Why might a program need different types of data (like whole numbers vs. text)?</li>
        <li>What happens if you try to store text in a variable meant for numbers?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>variable</strong> is a named container that stores a value. In Java, every variable has a <strong>data type</strong> that determines what kind of data it can hold. Java requires you to declare the type before using a variable, making it a <strong>statically typed</strong> language.</p>

<h3>Analogy</h3>
<p>Think of variables like labeled boxes. A box labeled "int" can only hold whole numbers. A box labeled "String" can only hold text. You cannot put a gallon of water in a pint jar — the type must match the content.</p>

<h3>How It Works</h3>
<p>Java has two categories of data types:</p>
<ul>
    <li><strong>Primitive types</strong> — Store actual values directly (8 types: byte, short, int, long, float, double, char, boolean)</li>
    <li><strong>Reference types</strong> — Store memory addresses pointing to objects (String, arrays, classes)</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point
        String name = "Ana";                 // String: text in double quotes
        int age = 19;                        // int: whole numbers
        double grade = 92.5;                 // double: numbers with decimals
        char section = 'A';                 // char: single character in single quotes
        boolean passed = true;               // boolean: true or false

        System.out.println("Name: " + name);     // Print name
        System.out.println("Age: " + age);        // Print age
        System.out.println("Grade: " + grade);    // Print grade
        System.out.println("Section: " + section); // Print section
        System.out.println("Passed: " + passed);  // Print passed status
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Name: Ana
Age: 19
Grade: 92.5
Section: A
Passed: true</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>age</strong> — Use <code>int</code> to store a person's age (whole number)</li>
    <li><strong>price</strong> — Use <code>double</code> for prices with decimals (e.g., $19.99)</li>
    <li><strong>isActive</strong> — Use <code>boolean</code> for true/false status flags</li>
    <li><strong>name</strong> — Use <code>String</code> for text data</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>int</code> for most whole numbers — it covers -2.1 billion to 2.1 billion</li>
    <li>Use <code>double</code> for decimals — it's the default and most precise</li>
    <li>Use <code>long</code> only when numbers exceed 2 billion (add <code>L</code> suffix)</li>
    <li>Use <code>final</code> to create constants that cannot change: <code>final double PI = 3.14;</code></li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting the <code>L</code> suffix for long values — <code>9000000000</code> causes an error without it</li>
    <li>Forgetting the <code>f</code> suffix for float — <code>3.14</code> is treated as double by default</li>
    <li>Using double quotes for char — <code>char c = "J";</code> is wrong; use single quotes: <code>'J'</code></li>
    <li>Trying to store 200 in a <code>byte</code> — it overflows since byte maxes at 127</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a student record system. You need to store a student's name, age, GPA, and whether they are currently enrolled.</p>
    <p><strong>Task:</strong> Write a Java program that declares the appropriate variables and prints them with labels.</p>
    <ol>
        <li>Create a class called <code>StudentRecord</code></li>
        <li>Declare variables with the correct data types for each piece of information</li>
        <li>Print each variable with a descriptive label</li>
        <li>Use a <code>final</code> constant for the maximum GPA (4.0)</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point
        String name = "Ana";                 // String for text
        int age = 20;                        // int for whole numbers
        double gpa = 3.85;                   // double for decimals
        boolean enrolled = true;             // boolean for true/false

        System.out.println("Name: " + name);       // Print name
        System.out.println("Age: " + age);          // Print age
        System.out.println("GPA: " + gpa);          // Print GPA
        System.out.println("Enrolled: " + enrolled); // Print status
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Name: Ana
Age: 20
GPA: 3.85
Enrolled: true</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
