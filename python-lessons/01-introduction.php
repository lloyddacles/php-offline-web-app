<?php $pageTitle = 'Introduction to Python'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to Python</h1>
    <p class="lesson-desc">Discover what Python is, why it's so popular, and how to run your first program.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Have you used any programming language before? If so, which one and what did you build with it?</li>
        <li>What is the difference between a compiled language and an interpreted language?</li>
        <li>Why do you think code readability matters in software development?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Python is a high-level, interpreted, general-purpose programming language created by <strong>Guido van Rossum</strong> in 1991. It emphasizes code readability with its use of significant whitespace (indentation) and a clean, English-like syntax.</p>

<h3>Analogy</h3>
<p>Think of Python as a Swiss Army knife for programming. Just as a Swiss Army knife has a tool for almost every task — cutting, screwing, opening bottles — Python has a library or framework for almost every programming domain: web development, data science, artificial intelligence, automation, and more. It's the one tool that does many jobs well.</p>

<h3>How It Works</h3>
<p>Python runs in two main modes: <strong>Interactive Mode (REPL)</strong> where you type commands and see results immediately, and <strong>Script Mode</strong> where you save code in <code>.py</code> files and run them. Python reads your code line by line, converting it to bytecode, and executes it — no separate compilation step needed.</p>

<h3>Example</h3>
<pre><code class="language-python"># Store student information
name = "Juan"
age = 20
grade = "A"

# Print the student report
print("Student Name:", name)
print("Age:", age)
print("Grade:", grade)
</code></pre>
<strong>Output:</strong>
<pre>Student Name: Juan
Age: 20
Grade: A</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Web Development:</strong> Instagram, Spotify, and Pinterest use Python (Django/Flask frameworks)</li>
    <li><strong>Data Science & AI:</strong> Netflix recommendations, Tesla self-driving cars rely on Python libraries</li>
    <li><strong>Automation:</strong> Automate repetitive tasks like file management, web scraping, and report generation</li>
    <li><strong>Game Development:</strong> Studios use Python for prototyping and tools</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Install Python from <code>python.org</code> and use a code editor like VS Code</li>
    <li>Start with the interactive shell (REPL) to experiment before writing scripts</li>
    <li>Run <code>import this</code> in Python to read "The Zen of Python" — guiding principles for the language</li>
    <li>Use <code>print()</code> liberally to understand what your code is doing at each step</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Confusing Python 2 with Python 3 — always use Python 3 (current version)</li>
    <li>Forgetting to install Python or not adding it to PATH during installation</li>
    <li>Trying to use semicolons at end of lines like in Java or C — Python doesn't need them</li>
    <li>Using curly braces <code>{}</code> for code blocks — Python uses indentation instead</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are an intern at a tech startup. Your manager asks you to write a quick Python script that displays the company name, number of employees, and whether the company is currently hiring.</p>
    <p><strong>Task:</strong> Write a Python script that stores this information in variables and prints a formatted report.</p>
    <ol>
        <li>Create a variable for the company name, employee count, and hiring status</li>
        <li>Use <code>print()</code> with f-strings to display a clean report</li>
        <li>Run your script and verify the output</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should create variables and use print statements.</p>
        <pre><code># Company report script
company = "TechNova"
employees = 45
hiring = True

print("Company:", company)
print("Employees:", employees)
print("Hiring:", hiring)</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
