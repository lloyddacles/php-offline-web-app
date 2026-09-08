<?php $pageTitle = 'Introduction to Java'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $sectionDir = 'java-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to Java</h1>
    <p class="lesson-desc">Discover what Java is, why it dominates the programming world, and how to write your very first program.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What programming languages have you heard of or used before? How do they run on a computer?</li>
        <li>What does it mean when someone says a language is "platform-independent"?</li>
        <li>Have you ever installed software that required a specific operating system? Why does that matter?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Java is a <strong>high-level, object-oriented programming language</strong> created by James Gosling at Sun Microsystems in 1995. It compiles to bytecode that runs on the Java Virtual Machine (JVM), allowing the same program to run on Windows, macOS, Linux, and billions of devices worldwide.</p>

<h3>Analogy</h3>
<p>Think of Java like a universal translator. Instead of writing a separate book for each language, you write one book in "Java," and the translator (JVM) converts it for any audience (operating system). This is Java's famous <strong>"Write Once, Run Anywhere"</strong> promise.</p>

<h3>How It Works</h3>
<p>Java programs follow a simple pipeline:</p>
<ol>
    <li>You write source code in a <code>.java</code> file</li>
    <li>The compiler (<code>javac</code>) converts it to <strong>bytecode</strong> in a <code>.class</code> file</li>
    <li>The <strong>JVM</strong> reads the bytecode and executes it on your machine</li>
</ol>

<p>Three key components you need to know:</p>
<ul>
    <li><strong>JDK (Java Development Kit)</strong> — Tools for developing Java programs (includes compiler)</li>
    <li><strong>JRE (Java Runtime Environment)</strong> — Libraries needed to run Java programs</li>
    <li><strong>JVM (Java Virtual Machine)</strong> — Executes Java bytecode on any platform</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class Main {                         // Class name must match filename
    public static void main(String[] args) { // Entry point of the program
        String name = "Juan";                 // Store a name in a variable
        int age = 20;                         // Store age as a number

        System.out.println("Name: " + name); // Print the name
        System.out.println("Age: " + age);    // Print the age
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Name: Juan
Age: 20</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Android Apps</strong> — Most Android apps are written in Java</li>
    <li><strong>Enterprise Systems</strong> — Banks, hospitals, and governments use Java for large-scale applications</li>
    <li><strong>Web Backends</strong> — Spring Boot powers millions of web servers</li>
    <li><strong>IoT Devices</strong> — Smart TVs, Blu-ray players, and embedded systems run Java</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always install the <strong>JDK</strong> (not just the JRE) when learning to code</li>
    <li>Use an IDE like IntelliJ IDEA, Eclipse, or VS Code for better code editing</li>
    <li>The class name must match the filename (e.g., <code>HelloWorld.java</code> must contain <code>class HelloWorld</code>)</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting that <code>System</code> must be capitalized — <code>system.out.println()</code> will not compile</li>
    <li>Missing the semicolon at the end of statements</li>
    <li>Mismatched curly braces — every <code>{</code> needs a matching <code>}</code></li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your friend wants to learn programming. They ask you: "Why should I learn Java instead of another language?"</p>
    <p><strong>Task:</strong> Write a Java program that prints a comparison showing three benefits of Java.</p>
    <ol>
        <li>Create a class called <code>WhyJava</code></li>
        <li>In the main method, print three lines explaining Java advantages</li>
        <li>Compile and run your program</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point
        String reason1 = "Platform Independent"; // Can run anywhere
        String reason2 = "High Job Demand";     // Many job opportunities
        String reason3 = "Rich Ecosystem";      // Many libraries available

        System.out.println("1. " + reason1);    // Print reason 1
        System.out.println("2. " + reason2);    // Print reason 2
        System.out.println("3. " + reason3);    // Print reason 3
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>1. Platform Independent
2. High Job Demand
3. Rich Ecosystem</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
