<?php $pageTitle = 'File Handling & Exception Handling'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $sectionDir = 'java-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>File Handling &amp; Exception Handling</h1>
    <p class="lesson-desc">Learn to work with files using the <code>File</code> class and readers/writers, and master exception handling with <code>try-catch-finally</code>.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What happens when a program tries to read a file that doesn't exist? How should the program handle this?</li>
        <li>What is the difference between a compile-time error and a runtime error?</li>
        <li>Can you think of a real-life situation where something might fail unexpectedly (like a power outage)? How would you prepare for it?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>File handling</strong> allows your program to read from and write to files on disk. Java uses the <code>File</code> class for file operations and <code>BufferedReader</code>/<code>BufferedWriter</code> for efficient reading and writing. <strong>Exception handling</strong> uses <code>try-catch-finally</code> blocks to gracefully handle errors without crashing the program.</p>

<h3>Analogy</h3>
<p>Think of file handling like working with a filing cabinet. You need to open the drawer (File), read the document (BufferedReader), or write a new one (BufferedWriter). Sometimes the drawer is stuck or the file is missing — that's when exception handling kicks in, like having a backup plan when things go wrong.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>File class</strong> — Checks existence, gets info, creates/deletes files</li>
    <li><strong>BufferedWriter</strong> — Writes text to files efficiently</li>
    <li><strong>BufferedReader</strong> — Reads text from files line by line</li>
    <li><strong>try-catch</strong> — Catches and handles exceptions</li>
    <li><strong>finally</strong> — Runs cleanup code regardless of whether an exception occurred</li>
    <li><strong>try-with-resources</strong> — Automatically closes resources when done</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point

        // try-catch handles errors gracefully
        try {                                // Try this code first
            int a = 10;                      // First number
            int b = 0;                       // Zero causes error
            int result = a / b;              // Division by zero!
            System.out.println("Result: " + result); // Never reached
        } catch (ArithmeticException e) {    // Catch the error
            System.out.println("Error: " + e.getMessage()); // Print error
        } finally {                          // Always runs
            System.out.println("Cleanup done!"); // Final message
        }

        // Another example: array index error
        try {                                // Try this code
            int[] nums = {1, 2, 3};          // Array with 3 elements
            System.out.println(nums[5]);     // Index 5 does not exist!
        } catch (ArrayIndexOutOfBoundsException e) { // Catch index error
            System.out.println("Error: " + e.getMessage());
        }
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Error: / by zero
Cleanup done!
Error: Index 5 out of bounds for length 3</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Log files</strong> — Write application logs for debugging and monitoring</li>
    <li><strong>Data import/export</strong> — Read CSV files or write reports to disk</li>
    <li><strong>Configuration files</strong> — Read settings from a properties file</li>
    <li><strong>Error handling</strong> — Catch and log errors without crashing the application</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use <strong>try-with-resources</strong> (<code>try (resource) { }</code>) to auto-close files</li>
    <li>Catch specific exceptions — <code>FileNotFoundException</code> before <code>IOException</code></li>
    <li>Use <code>finally</code> for cleanup that must always run (like closing connections)</li>
    <li>Log exceptions with <code>e.getMessage()</code> and <code>e.printStackTrace()</code> for debugging</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Not closing files — causes resource leaks and memory problems</li>
    <li>Catching <code>Exception</code> instead of specific types — hides bugs</li>
    <li>Ignoring exceptions with empty catch blocks — errors go unnoticed</li>
    <li>Forgetting that <code>finally</code> runs even after <code>return</code> — can cause unexpected behavior</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a simple note-taking application. The program needs to save notes to a file, read them back, and handle errors gracefully if the file is missing or corrupted.</p>
    <p><strong>Task:</strong> Write a Java program that saves and reads notes with proper exception handling.</p>
    <ol>
        <li>Create a class called <code>NoteApp</code></li>
        <li>Write 3 notes to a file using <code>BufferedWriter</code></li>
        <li>Read and display all notes using <code>BufferedReader</code></li>
        <li>Handle the case where the file doesn't exist</li>
        <li>Use <code>finally</code> to display a message when operations complete</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point

        // Example 1: Division by zero
        try {                                // Try risky code
            int a = 10;                      // First number
            int b = 0;                       // Zero will cause error
            int result = a / b;              // This line fails!
            System.out.println(result);      // Never reached
        } catch (ArithmeticException e) {    // Catch the error
            System.out.println("Error: " + e.getMessage());
        }

        // Example 2: Null reference
        try {                                // Try risky code
            String text = null;              // No value assigned
            System.out.println(text.length()); // This line fails!
        } catch (NullPointerException e) {   // Catch null error
            System.out.println("Error: " + e.getMessage());
        }

        System.out.println("Program continues!"); // Still runs
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Error: / by zero
Error: null
Program continues!</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
