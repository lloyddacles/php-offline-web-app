<?php $pageTitle = 'String Mastery'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $sectionDir = 'python-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>String Mastery</h1>
    <p class="lesson-desc">Manipulate text with string methods, f-strings, slicing, and formatting.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Why are strings called "immutable" in Python? What does this mean for operations on strings?</li>
        <li>How do you format a string to include the value of a variable using an f-string?</li>
        <li>What is the difference between <code>split()</code> and <code>join()</code>?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Strings in Python are <strong>immutable sequences of Unicode characters</strong>. You can read and access their contents but cannot modify them in place — operations always create new strings. Python provides powerful methods for searching, replacing, splitting, joining, and formatting text.</p>

<h3>Analogy</h3>
<p>Think of a string like a sentence written in permanent ink. You can read every word, copy the sentence, highlight parts of it, or create a new sentence based on it — but you can't erase a single letter from the original. Every "edit" creates a brand new copy with your changes.</p>

<h3>How It Works</h3>
<p>Strings support indexing (<code>s[0]</code>), slicing (<code>s[1:4]</code>), and a rich set of methods. f-strings (formatted string literals) let you embed expressions inside <code>{}</code> within a string. Common methods include <code>.upper()</code>, <code>.lower()</code>, <code>.strip()</code>, <code>.split()</code>, <code>.replace()</code>, and <code>.find()</code>.</p>

<h3>Example</h3>
<pre><code class="language-python"># Store student name
name = "  juan dela cruz  "

# Clean up the name
clean_name = name.strip()
print("Clean:", clean_name)

# Convert to uppercase
upper_name = clean_name.upper()
print("Upper:", upper_name)

# Get the length
length = len(clean_name)
print("Length:", length)
</code></pre>
<strong>Output:</strong>
<pre>Clean: juan dela cruz
Upper: JUAN DELA CRUZ
Length: 14</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Data Cleaning:</strong> Strip whitespace, normalize case, and remove unwanted characters from user input</li>
    <li><strong>Report Generation:</strong> Format numbers, align columns, and create readable output with f-strings</li>
    <li><strong>CSV Parsing:</strong> Split comma-separated values and join them back for storage</li>
    <li><strong>Template Systems:</strong> Replace placeholders in email templates or HTML content</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use f-strings over <code>.format()</code> — they're faster and more readable</li>
    <li>Use <code>.strip()</code> before comparisons to handle accidental whitespace</li>
    <li>Use <code>.startswith()</code> and <code>.endswith()</code> instead of slicing for prefix/suffix checks</li>
    <li>Chain methods: <code>message.strip().lower()</code> is clean and Pythonic</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Trying to modify a string in place: <code>text[0] = 'h'</code> causes a TypeError</li>
    <li>Forgetting that <code>.find()</code> returns -1 when the substring is not found</li>
    <li>Using <code>+</code> for string concatenation in loops — use <code>.join()</code> instead for better performance</li>
    <li>Confusing <code>.split(",")</code> with <code>.split()</code> — the latter splits on any whitespace</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a contact form processor. Users enter their full name, email, and a short bio. You need to clean up the input (remove extra spaces, normalize casing) and generate a formatted user profile.</p>
    <p><strong>Task:</strong> Process raw user input and create a clean profile string.</p>
    <ol>
        <li>Create variables with messy user input (extra spaces, mixed casing)</li>
        <li>Clean the name (strip spaces, title case)</li>
        <li>Lowercase the email and verify it contains <code>@</code></li>
        <li>Truncate the bio to 50 characters if it's too long</li>
        <li>Format everything into a clean profile string using f-strings</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should demonstrate string cleaning and formatting methods.</p>
        <pre><code># Raw user input
raw_name = "  john doe  "
raw_email = "  John@Email.COM  "

# Clean the data
name = raw_name.strip().title()
email = raw_email.strip().lower()

# Print clean profile
print("Name:", name)
print("Email:", email)
print("Has @:", "@" in email)
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
