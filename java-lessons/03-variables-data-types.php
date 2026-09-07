<?php $pageTitle = 'Variables & Data Types'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

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
<pre><code class="language-java">public class DataTypes {
    public static void main(String[] args) {
        // Primitive types
        byte smallNum = 127;              // 1 byte: -128 to 127
        short mediumNum = 32000;          // 2 bytes
        int bigNum = 2000000000;          // 4 bytes (most common for whole numbers)
        long hugeNum = 9000000000L;       // 8 bytes (note the L suffix)

        float decimal1 = 3.14f;           // 4 bytes (note the f suffix)
        double decimal2 = 3.14159265;     // 8 bytes (default for decimals)

        char letter = 'J';               // 2 bytes (single character in single quotes)
        boolean isJavaFun = true;         // true or false

        // Reference type
        String language = "Java";         // Objects use double quotes

        // Print all values
        System.out.println("byte:    " + smallNum);
        System.out.println("short:   " + mediumNum);
        System.out.println("int:     " + bigNum);
        System.out.println("long:    " + hugeNum);
        System.out.println("float:   " + decimal1);
        System.out.println("double:  " + decimal2);
        System.out.println("char:    " + letter);
        System.out.println("boolean: " + isJavaFun);
        System.out.println("String:  " + language);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>byte:    127
short:   32000
int:     2000000000
long:    9000000000
float:   3.14
double:  3.14159265
char:    J
boolean: true
String:  Java</pre>

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
        <pre><code class="language-java">public class StudentRecord {
    public static void main(String[] args) {
        // Student information using appropriate data types
        String name = "Maria Santos";      // String for text
        int age = 20;                       // int for whole number
        double gpa = 3.85;                  // double for decimal
        boolean isEnrolled = true;          // boolean for true/false

        final double MAX_GPA = 4.0;        // final constant

        // Display the record
        System.out.println("=== Student Record ===");
        System.out.println("Name: " + name);
        System.out.println("Age: " + age);
        System.out.println("GPA: " + gpa);
        System.out.println("Enrolled: " + isEnrolled);
        System.out.println("Maximum GPA: " + MAX_GPA);
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>=== Student Record ===
Name: Maria Santos
Age: 20
GPA: 3.85
Enrolled: true
Maximum GPA: 4.0</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
