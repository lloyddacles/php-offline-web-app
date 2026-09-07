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
<pre><code class="language-python"># Dictionaries
person = {
    "name": "Alice",
    "age": 30,
    "city": "New York"
}

print(f"Name: {person['name']}")
print(f"Email: {person.get('email', 'N/A')}")  # Safe access

# Iterate over dictionary
for key, value in person.items():
    print(f"  {key}: {value}")

# Dictionary comprehension
prices = {"apple": 1.5, "banana": 0.5, "steak": 15.0}
expensive = {k: v for k, v in prices.items() if v > 2.0}
print(f"Expensive: {expensive}")

# Sets
set_a = {1, 2, 3, 4}
set_b = {3, 4, 5, 6}

print(f"Union: {set_a | set_b}")        # {1, 2, 3, 4, 5, 6}
print(f"Intersection: {set_a & set_b}") # {3, 4}
print(f"A - B: {set_a - set_b}")        # {1, 2}

# Remove duplicates
numbers = [1, 2, 2, 3, 3, 3]
unique = set(numbers)
print(f"Unique: {unique}")
</code></pre>
<strong>Output:</strong>
<pre>Name: Alice
Email: N/A
  name: Alice
  age: 30
  city: New York
Expensive: {'steak': 15.0}
Union: {1, 2, 3, 4, 5, 6}
Intersection: {3, 4}
A - B: {1, 2}
Unique: {1, 2, 3}</pre>

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
    "Alice": {"phone": "555-0101", "email": "alice@email.com"},
    "Bob": {"phone": "555-0102", "email": "bob@email.com"},
    "Charlie": {"phone": "555-0103", "email": "charlie@email.com"},
    "Diana": {"phone": "555-0104", "email": "diana@email.com"},
}

# Safe retrieval
def get_email(contacts, name):
    return contacts.get(name, {}).get("email", "Not found")

print(f"Alice's email: {get_email(contacts, 'Alice')}")
print(f"Eve's email: {get_email(contacts, 'Eve')}")

# Group operations
work_group = {"Alice", "Bob", "Charlie"}
personal_group = {"Bob", "Diana", "Alice"}

both = work_group & personal_group
work_only = work_group - personal_group
all_contacts = work_group | personal_group

print(f"\nIn both groups: {both}")
print(f"Work only: {work_only}")
print(f"All contacts: {all_contacts}")</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
