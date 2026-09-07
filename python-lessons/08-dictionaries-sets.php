<?php $pageTitle = 'Dictionaries & Sets'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Dictionaries & Sets</h1>
    <p class="lesson-desc">Map key-value pairs with dictionaries and handle unique collections with sets.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between a list and a dictionary? When would you use each?</li>
        <li>How do you safely access a dictionary key that might not exist?</li>
        <li>What makes sets different from lists, and why are sets faster for membership checks?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p><strong>Dictionaries</strong> store key-value pairs — like a real dictionary where you look up a word (key) to find its definition (value). They are mutable and indexed by keys, not positions. <strong>Sets</strong> are unordered collections of unique elements, perfect for removing duplicates and testing membership.</p>

<h3>Analogy</h3>
<p>A dictionary is like a contact list on your phone — you look up "Mom" (key) to find her phone number (value). A set is like a bag of unique marbles — if you try to put two identical marbles in, only one stays. Sets automatically remove duplicates and answer the question "Do I have this marble?" very quickly.</p>

<h3>How It Works</h3>
<p>Dictionaries use curly braces <code>{}</code> with <code>key: value</code> pairs. Access values with <code>dict[key]</code> or <code>dict.get(key, default)</code>. Iterate with <code>.items()</code> for key-value pairs. Sets use <code>{}</code> or <code>set()</code> and support mathematical operations: union (<code>|</code>), intersection (<code>&</code>), difference (<code>-</code>).</p>

<h3>Example</h3>
<pre><code class="language-python"># Create student record
student = {
    "name": "Juan",
    "age": 20,
    "grade": "A"
}

# Access values
print("Name:", student["name"])
print("Age:", student["age"])

# Add new data
student["course"] = "Python"
print("Course:", student["course"])
</code></pre>
<strong>Output:</strong>
<pre>Name: Juan
Age: 20
Course: Python</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>User Profiles:</strong> Dictionaries store user data (name, email, preferences)</li>
    <li><strong>Word Frequency:</strong> Count word occurrences in text using dictionary keys</li>
    <li><strong>Unique Tags:</strong> Sets automatically deduplicate tags or categories</li>
    <li><strong>Database Results:</strong> Dictionaries represent rows from a database table</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>.get(key, default)</code> instead of <code>dict[key]</code> to avoid KeyError</li>
    <li>Use set intersection (<code>&</code>) to find common elements between two lists</li>
    <li>Use dictionary comprehensions to transform or filter dictionaries concisely</li>
    <li>Use <code>.keys()</code>, <code>.values()</code>, and <code>.items()</code> to iterate over dictionaries</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Accessing a missing key with <code>dict[key]</code> — use <code>.get()</code> instead</li>
    <li>Trying to use mutable types (lists) as dictionary keys — only immutable types work</li>
    <li>Forgetting that sets are unordered — you cannot index into a set</li>
    <li>Using <code>{}</code> for an empty dict instead of an empty set — use <code>set()</code> for empty sets</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a contact book app. You need to store contacts with their phone numbers and emails, find contacts by name, and identify which contacts are in both your "Work" and "Personal" groups.</p>
    <p><strong>Task:</strong> Use dictionaries and sets to manage contact data.</p>
    <ol>
        <li>Create a dictionary of contacts with name as key and a sub-dictionary of phone/email as value</li>
        <li>Write a function that safely retrieves a contact's email</li>
        <li>Create two sets of contact names (Work and Personal groups)</li>
        <li>Use set operations to find contacts in both groups, only in Work, and all unique contacts</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should demonstrate dictionary creation, safe access, and set operations.</p>
        <pre><code># Contact book
contacts = {
    "Alice": "555-0101",
    "Bob": "555-0102",
    "Charlie": "555-0103"
}

# Access contact
print("Alice:", contacts["Alice"])

# Add new contact
contacts["Diana"] = "555-0104"
print("Diana:", contacts["Diana"])

# Print all contacts
for name, phone in contacts.items():
    print(name, "->", phone)
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
