<?php $pageTitle = 'File Handling & Exception Handling'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

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
<pre><code class="language-java">import java.io.*;

public class FileHandlingDemo {
    public static void main(String[] args) {
        String filename = "demo.txt";

        // Writing to a file using try-with-resources
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(filename))) {
            writer.write("Line 1: Hello from Java!");
            writer.newLine();
            writer.write("Line 2: File handling is useful.");
            writer.newLine();
            writer.write("Line 3: Writing data to disk.");
            System.out.println("Successfully wrote to " + filename);
        } catch (IOException e) {
            System.out.println("Error writing: " + e.getMessage());
        }

        // Reading from a file
        File file = new File(filename);
        System.out.println("File exists: " + file.exists());
        System.out.println("File size: " + file.length() + " bytes");

        try (BufferedReader reader = new BufferedReader(new FileReader(filename))) {
            String line;
            int lineNum = 1;
            while ((line = reader.readLine()) != null) {
                System.out.println(lineNum + ": " + line);
                lineNum++;
            }
        } catch (IOException e) {
            System.out.println("Error reading: " + e.getMessage());
        }

        // Exception handling demo
        System.out.println("\n--- Exception Handling ---");
        try {
            int result = 10 / 0;  // ArithmeticException
        } catch (ArithmeticException e) {
            System.out.println("Caught: " + e.getMessage());
        } finally {
            System.out.println("Finally block always runs!");
        }
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Successfully wrote to demo.txt
File exists: true
File size: 105 bytes
1: Line 1: Hello from Java!
2: Line 2: File handling is useful.
3: Line 3: Writing data to disk.

--- Exception Handling ---
Caught: / by zero
Finally block always runs!</pre>

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
        <pre><code class="language-java">import java.io.*;

public class NoteApp {
    public static void main(String[] args) {
        String filename = "notes.txt";

        // Write notes to file
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(filename))) {
            writer.write("Note 1: Learn Java basics");
            writer.newLine();
            writer.write("Note 2: Practice exception handling");
            writer.newLine();
            writer.write("Note 3: Master file I/O operations");
            writer.newLine();
            System.out.println("Notes saved successfully!");
        } catch (IOException e) {
            System.out.println("Error saving notes: " + e.getMessage());
        }

        // Read notes from file
        System.out.println("\n--- Your Notes ---");
        File file = new File(filename);

        if (!file.exists()) {
            System.out.println("No notes file found. Create some notes first!");
            return;
        }

        try (BufferedReader reader = new BufferedReader(new FileReader(filename))) {
            String line;
            int lineNum = 1;
            while ((line = reader.readLine()) != null) {
                System.out.println(lineNum + ". " + line);
                lineNum++;
            }
        } catch (FileNotFoundException e) {
            System.out.println("File not found: " + e.getMessage());
        } catch (IOException e) {
            System.out.println("Error reading notes: " + e.getMessage());
        } finally {
            System.out.println("\n--- Session Complete ---");
        }
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Notes saved successfully!

--- Your Notes ---
1. Note 1: Learn Java basics
2. Note 2: Practice exception handling
3. Note 3: Master file I/O operations

--- Session Complete ---</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
