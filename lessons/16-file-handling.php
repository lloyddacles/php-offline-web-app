<?php $pageTitle = 'PHP File Handling'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 16; $sectionDir = 'lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP File Handling</h1>
    <p class="lesson-desc">Read, write, and manage files using PHP's file functions.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you save and read files on your computer? (notes, documents, photos)</li>
        <li>When you write a document in Word, how does the computer remember it after you close the program?</li>
        <li>In the previous lessons, we stored data in variables and sessions. What if we need to save data permanently?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>File handling allows PHP to read from and write to files on the server. This is essential for storing data permanently, reading configuration files, and logging activities.</p>

<h3>Analogy</h3>
<p>File handling is like a filing cabinet. You can open a file (fopen), write information in it (fwrite), read what's written (fread), and close it when done (fclose). You can also create new files or update existing ones.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. file_get_contents(): read entire file into a string</p>
<p>2. file_put_contents(): write string to file</p>
<p>3. fopen(): open a file for reading, writing, or appending</p>
<p>4. fwrite(): write data to an open file</p>
<p>5. fclose(): close the file when done</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Write text to a file
file_put_contents("notes.txt", "Hello World!\n");

// Add more text to the file
file_put_contents("notes.txt", "This is my note.\n", FILE_APPEND);

// Read the file contents
$content = file_get_contents("notes.txt");
echo $content;

// Check if file exists
if (file_exists("notes.txt")) {
    echo "File exists!";
}
</code></pre>
<strong>Output:</strong>
<pre>Hello World!
This is my note.
File exists!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Storing user data (notes, settings, preferences)</li>
    <li>Logging activities (tracking errors, user actions)</li>
    <li>Reading configuration files (database settings, API keys)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use file_get_contents() for simple file reading</li>
    <li>Always check if a file exists before reading it</li>
    <li>Use FILE_APPEND flag to add to existing files without overwriting</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Not checking if a file exists before reading (causes errors)</li>
    <li>Forgetting to close files after opening them (memory leaks)</li>
    <li>Not validating file paths (security risk - directory traversal)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a simple notepad application where users can save and read their notes.</p>
    <p><strong>Task:</strong> Create a basic notepad using file handling.</p>
    <ol>
        <li>Create a function that saves a note to a file</li>
        <li>Create a function that reads all notes from the file</li>
        <li>Create a function that displays the note with timestamp</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use file_put_contents() with FILE_APPEND</p>
        <p><strong>Answer 2:</strong> Use file_get_contents() to read the entire file</p>
        <p><strong>Answer 3:</strong> Add date() function for timestamp</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// Save a note
function saveNote($note) {
    $timestamp = date("Y-m-d H:i:s");
    $entry = "[$timestamp] $note\n";
    file_put_contents("notes.txt", $entry, FILE_APPEND);
    echo "Note saved!\n";
}

// Read all notes
function readNotes() {
    if (file_exists("notes.txt")) {
        return file_get_contents("notes.txt");
    }
    return "No notes found.";
}

// Display notes
saveNote("Buy groceries");
saveNote("Study PHP");
echo "\nAll Notes:\n";
echo readNotes();
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>