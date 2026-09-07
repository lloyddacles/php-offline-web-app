<?php $pageTitle = 'File Handling & Error Handling'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>File Handling & Error Handling</h1>
    <p class="lesson-desc">Read and write files safely, and handle errors gracefully with try/except.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the advantage of using the <code>with</code> statement when opening files?</li>
        <li>What is the difference between writing (<code>"w"</code>) and appending (<code>"a"</code>) to a file?</li>
        <li>Why is it bad practice to use a bare <code>except:</code> clause without specifying an exception type?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Python provides built-in functions for file I/O: <code>open()</code>, <code>read()</code>, <code>write()</code>, and <code>close()</code>. The <code>with</code> statement ensures files are automatically closed. <strong>Error handling</strong> uses <code>try/except</code> blocks to catch and respond to exceptions, preventing programs from crashing unexpectedly. <code>finally</code> runs regardless of whether an error occurred.</p>

<h3>Analogy</h3>
<p>File handling is like checking out a library book. You open it (open), read it (read), write notes in your notebook (write), and return it (close). The <code>with</code> statement is like an automatic return system — even if you get distracted, the book goes back on the shelf. Error handling is like having a backup plan: if the book is missing, you don't panic — you just check out a different one.</p>

<h3>How It Works</h3>
<p>Open files with <code>open(filename, mode)</code>. Modes include <code>"r"</code> (read), <code>"w"</code> (write/overwrite), <code>"a"</code> (append), and <code>"x"</code> (create, fail if exists). Wrap risky code in <code>try:</code> blocks and handle specific exceptions with <code>except ExceptionType:</code>. Use <code>finally</code> for cleanup code that must always run. Use <code>raise</code> to create your own exceptions.</p>

<h3>Example</h3>
<pre><code class="language-python"># Writing to a file
with open("notes.txt", "w") as file:
    file.write("Hello, World!\n")
    file.write("Second line\n")

# Appending to a file
with open("notes.txt", "a") as file:
    file.write("Third line\n")

# Reading entire file
with open("notes.txt", "r") as file:
    content = file.read()
    print(content)

# Safe division with error handling
def safe_divide(a, b):
    try:
        return a / b
    except ZeroDivisionError:
        return "Error: Cannot divide by zero!"
    except TypeError:
        return "Error: Both arguments must be numbers!"

print(f"10 / 3 = {safe_divide(10, 3):.2f}")
print(f"10 / 0 = {safe_divide(10, 0)}")

# Raising custom exceptions
def validate_age(age):
    if not isinstance(age, int):
        raise TypeError("Age must be an integer")
    if age < 0 or age > 150:
        raise ValueError("Age must be between 0 and 150")
    return "Valid age!"

try:
    print(validate_age(25))
    print(validate_age(-5))
except (TypeError, ValueError) as e:
    print(f"Validation error: {e}")
</code></pre>
<strong>Output:</strong>
<pre>Hello, World!
Second line
Third line
10 / 3 = 3.33
10 / 0 = Error: Cannot divide by zero!
Valid age!
Validation error: Age must be between 0 and 150</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Log Files:</strong> Write application logs with timestamps for debugging</li>
    <li><strong>Data Import:</strong> Read CSV/JSON files and handle missing or corrupted data</li>
    <li><strong>Configuration:</strong> Load settings from files with fallback defaults on errors</li>
    <li><strong>User Input:</strong> Validate form data and provide friendly error messages</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always use the <code>with</code> statement for file handling — it's safer and cleaner</li>
    <li>Catch specific exceptions, not generic <code>Exception</code> — it makes debugging easier</li>
    <li>Use <code>finally</code> for cleanup (closing connections, releasing resources)</li>
    <li>Log errors instead of just printing them — it helps with production debugging</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Opening files without <code>with</code> — files may not close if an error occurs</li>
    <li>Using <code>"w"</code> mode when you mean <code>"a"</code> — this overwrites the file</li>
    <li>Catching all exceptions with bare <code>except:</code> — hides bugs and catches Ctrl+C</li>
    <li>Not handling <code>FileNotFoundError</code> when opening user-provided file paths</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a word counter tool. The program reads a text file, counts the number of words, and writes a summary report to a new file. The program must handle the case where the input file doesn't exist and provide a friendly error message.</p>
    <p><strong>Task:</strong> Create a word counter that reads a file, processes the content, and writes a report.</p>
    <ol>
        <li>Write a function that reads a file and returns its content, handling FileNotFoundError</li>
        <li>Write a function that counts words in a string and returns a dictionary of word frequencies</li>
        <li>Write a function that writes the report to a new file</li>
        <li>Chain the functions together in a main program flow</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should demonstrate file handling with proper error handling and data processing.</p>
        <pre><code>def read_file(filename):
    """Read a file and return its content."""
    try:
        with open(filename, "r") as f:
            return f.read()
    except FileNotFoundError:
        print(f"Error: '{filename}' not found.")
        return None
    except PermissionError:
        print(f"Error: No permission to read '{filename}'.")
        return None

def count_words(text):
    """Count word frequencies in a string."""
    words = text.lower().split()
    word_count = {}
    for word in words:
        word_count[word] = word_count.get(word, 0) + 1
    return word_count

def write_report(filename, word_count, total_words):
    """Write a word count report to a file."""
    with open(filename, "w") as f:
        f.write("===== Word Count Report =====\n")
        f.write(f"Total words: {total_words}\n\n")
        f.write("Word Frequency:\n")
        for word, count in sorted(word_count.items(),
                                   key=lambda x: x[1], reverse=True):
            f.write(f"  {word:15} : {count}\n")
    print(f"Report written to '{filename}'")

# Main program
content = read_file("sample.txt")

if content is not None:
    word_count = count_words(content)
    total = sum(word_count.values())
    print(f"Found {total} words in the file.")
    write_report("report.txt", word_count, total)
else:
    print("Could not generate report.")</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
