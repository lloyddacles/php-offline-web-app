<?php $pageTitle = 'Python Syntax Basics'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 2; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Python Syntax Basics</h1>
    <p class="lesson-desc">Master indentation, statements, comments, and the rules that make Python unique.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>In what way does Python differ from most other programming languages when it comes to defining code blocks?</li>
        <li>What is the difference between a single-line comment and a multi-line comment in Python?</li>
        <li>Why is Python considered a case-sensitive language?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Python syntax refers to the set of rules that define how code must be written. Unlike most languages that use braces <code>{}</code>, Python uses <strong>indentation</strong> to define code blocks. Statements end with colons before indented blocks, and Python is <strong>case-sensitive</strong> — meaning <code>Name</code> and <code>name</code> are different variables.</p>

<h3>Analogy</h3>
<p>Think of Python's indentation like an outline in a Word document. A main topic is flush left, subtopics are indented once, and sub-subtopics are indented further. If you mix indentation levels randomly, the outline becomes unreadable. Python enforces this outline structure so that your code is always clean and organized — it's like having an auto-formatter built into the language itself.</p>

<h3>How It Works</h3>
<p>Every compound statement in Python (if, for, while, def, class) ends with a colon, followed by an indented block. The standard indentation is <strong>4 spaces</strong>. Python tracks indentation levels to know which code belongs to which block. Mixed tabs and spaces will cause errors.</p>

<h3>Example</h3>
<pre><code class="language-python"># Store student information
name = "Juan"
age = 20

# Check if student is adult
if age >= 18:
    print(name, "is an adult")
    print("Can vote")

# Print the result
print("Done checking")
</code></pre>
<strong>Output:</strong>
<pre>Juan is an adult
Can vote
Done checking</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Team Projects:</strong> Enforced indentation ensures all developers write code in the same style</li>
    <li><strong>Code Reviews:</strong> Python code is immediately readable without needing extra formatting tools</li>
    <li><strong>Debugging:</strong> Indentation errors point you directly to where a block of code went wrong</li>
    <li><strong>Documentation:</strong> Docstrings (triple-quoted strings) serve as inline documentation</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Configure your editor to use 4 spaces for indentation (not tabs)</li>
    <li>Use parentheses for line continuation instead of backslashes — it's cleaner</li>
    <li>Write comments that explain <em>why</em>, not <em>what</em> the code does</li>
    <li>Use docstrings at the top of functions and classes to describe their purpose</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Mixing tabs and spaces — this causes <code>IndentationError</code></li>
    <li>Forgetting the colon after if/for/while/def/class statements</li>
    <li>Over-indenting or under-indenting code blocks</li>
    <li>Using <code>#</code> for multi-line comments when triple quotes are more appropriate for docstrings</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are reviewing a junior developer's Python code. The code has several syntax errors that prevent it from running. Your job is to identify and fix all the issues.</p>
    <p><strong>Task:</strong> Find and fix the errors in the following code.</p>
    <ol>
        <li>Identify the missing colon</li>
        <li>Fix the indentation error</li>
        <li>Fix the case sensitivity issue</li>
        <li>Run the corrected code and verify the output</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> The broken code has multiple issues. Here is the corrected version:</p>
        <pre><code># Store age and check
age = 22

if age >= 18:
    print("Adult")
    print("Can vote")
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
