<?php $pageTitle = 'Lists & Tuples'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Lists & Tuples</h1>
    <p class="lesson-desc">Store collections of data with ordered, indexable lists and immutable tuples.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between a list and a tuple in Python?</li>
        <li>How do you access the last element of a list without knowing its length?</li>
        <li>What is a list comprehension, and why is it preferred over a regular for loop for building lists?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p><strong>Lists</strong> are ordered, mutable collections that can hold any data type. You can add, remove, and change elements after creation. <strong>Tuples</strong> are ordered, immutable collections — once created, they cannot be changed. Both are indexed starting at 0 and support slicing to extract portions.</p>

<h3>Analogy</h3>
<p>A list is like a whiteboard — you can write items on it, erase them, rearrange them, and add new ones at any time. A tuple is like a printed receipt — once it's printed, you can read each line (item) in order, but you can't modify what's on it. Use lists when data changes; use tuples when data should stay fixed.</p>

<h3>How It Works</h3>
<p>Lists use square brackets <code>[]</code> and support methods like <code>append()</code>, <code>remove()</code>, <code>sort()</code>, and <code>pop()</code>. Tuples use parentheses <code>()</code> and support indexing and unpacking but no modification methods. Both support slicing with <code>list[start:stop:step]</code>. List comprehensions provide a concise way to create filtered or transformed lists.</p>

<h3>Example</h3>
<pre><code class="language-python"># Lists - mutable
fruits = ["apple", "banana", "cherry"]
fruits.append("date")
fruits.insert(1, "blueberry")
print(f"Fruits: {fruits}")

# Slicing
numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
print(f"First 3: {numbers[:3]}")
print(f"Every 2nd: {numbers[::2]}")
print(f"Reversed: {numbers[::-1]}")

# List comprehension
squares = [x ** 2 for x in range(1, 6)]
evens = [x for x in range(20) if x % 2 == 0]
print(f"Squares: {squares}")
print(f"Evens: {evens}")

# Tuples - immutable
point = (3, 4)
x, y = point
print(f"Point: x={x}, y={y}")

# Tuple swapping
a, b = 1, 2
a, b = b, a
print(f"Swapped: a={a}, b={b}")
</code></pre>
<strong>Output:</strong>
<pre>Fruits: ['apple', 'blueberry', 'banana', 'cherry', 'date']
First 3: [0, 1, 2]
Every 2nd: [0, 2, 4, 6, 8]
Reversed: [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
Squares: [1, 4, 9, 16, 25]
Evens: [0, 2, 4, 6, 8, 10, 12, 14, 16, 18]
Point: x=3, y=4
Swapped: a=2, b=1</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Shopping Carts:</strong> Lists store items that are added, removed, and reordered</li>
    <li><strong>GPS Coordinates:</strong> Tuples store fixed (latitude, longitude) pairs</li>
    <li><strong>Data Filtering:</strong> List comprehensions filter database results efficiently</li>
    <li><strong>RGB Colors:</strong> Tuples represent immutable color values like <code>(255, 128, 0)</code></li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use list comprehensions for simple transformations — they're faster and more readable</li>
    <li>Use tuples for data that shouldn't change (coordinates, dictionary keys)</li>
    <li>Use <code>in</code> to check membership: <code>if "apple" in fruits:</code></li>
    <li>Use unpacking to assign multiple variables at once: <code>a, b, c = my_list</code></li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Trying to modify a tuple: <code>point[0] = 5</code> causes a TypeError</li>
    <li>Forgetting that slicing creates a new list — the original is unchanged</li>
    <li>Using <code>list.remove()</code> when the item doesn't exist — causes a ValueError</li>
    <li>Creating a single-element tuple without a trailing comma: <code>(42)</code> is just an int, <code>(42,)</code> is a tuple</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a student grade tracker. You have a list of student names and their scores. You need to find the highest score, calculate the average, and create a list of students who scored above 90.</p>
    <p><strong>Task:</strong> Use list operations and comprehensions to analyze the data.</p>
    <ol>
        <li>Create a list of tuples: <code>[("Alice", 92), ("Bob", 85), ("Charlie", 95), ("Diana", 88), ("Eve", 91)]</li>
        <li>Use a list comprehension to extract just the scores</li>
        <li>Find the highest score and the average</li>
        <li>Create a list of names of students who scored above 90</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should use list comprehensions and built-in functions.</p>
        <pre><code># Student grade analysis
students = [("Alice", 92), ("Bob", 85), ("Charlie", 95),
            ("Diana", 88), ("Eve", 91)]

# Extract scores using list comprehension
scores = [score for name, score in students]
print(f"Scores: {scores}")

# Find highest and average
highest = max(scores)
average = sum(scores) / len(scores)
print(f"Highest: {highest}")
print(f"Average: {average:.1f}")

# Filter students above 90
top_students = [name for name, score in students if score > 90]
print(f"Students above 90: {top_students}")</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
