<?php $pageTitle = 'PHP Arrays'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 11; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Arrays</h1>
    <p class="lesson-desc">Store collections of data using indexed, associative, and multidimensional arrays.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you store multiple items in real life? (shopping list, class roster, playlist)</li>
        <li>When you have a list of groceries, how do you organize and access them?</li>
        <li>In the previous lessons, we used single variables. What if we needed to store 100 student names?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Arrays are ordered collections of values stored under a single variable name. They can hold multiple items of different types.</p>

<h3>Analogy</h3>
<p>Arrays are like egg cartons. Each slot holds an egg (value), and you can access any egg by its position (index). You can also label slots (associative arrays) like "large eggs" or "medium eggs".</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Indexed arrays use numeric indexes starting at 0</p>
<p>2. Associative arrays use named keys (like a dictionary)</p>
<p>3. Multidimensional arrays contain other arrays</p>
<p>4. Use count() to get array length</p>
<p>5. Use foreach to iterate through all elements</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Indexed array - access by number
$fruits = ["Apple", "Banana", "Cherry"];
echo "First: " . $fruits[0];
echo "\n";

// Loop through array
foreach ($fruits as $fruit) {
    echo "$fruit ";
}

echo "\n\n";

// Associative array - access by name
$person = [
    "name" => "Alice",
    "age" => 25
];
echo "Name: " . $person["name"];
echo "\n";
echo "Age: " . $person["age"];
</code></pre>
<strong>Output:</strong>
<pre>First: Apple
Apple Banana Cherry

Name: Alice
Age: 25</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Managing collections of data (student records, product catalogs)</li>
    <li>Storing configuration settings (key-value pairs)</li>
    <li>Processing form data and database results</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use associative arrays for named data (like database records)</li>
    <li>Use array_push() and array_pop() to add/remove elements</li>
    <li>Use array_merge() to combine arrays</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Trying to access non-existent keys (causes warnings)</li>
    <li>Forgetting that array indexes start at 0, not 1</li>
    <li>Not checking if a key exists before accessing it</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a student grades management system for a school.</p>
    <p><strong>Task:</strong> Create and manipulate arrays to manage student data.</p>
    <ol>
        <li>Create an array of 5 student names</li>
        <li>Create an associative array for one student (name, grade, subject)</li>
        <li>Loop through the students array and display each student's information</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Indexed array with string values</p>
        <p><strong>Answer 2:</strong> Associative array with key-value pairs</p>
        <p><strong>Answer 3:</strong> foreach loop to iterate and display</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
// Array of students
$students = ["Alice", "Bob", "Carol", "David", "Eve"];

// Student information
$studentInfo = [
    "name" => "Alice Smith",
    "grade" => 95,
    "subject" => "Mathematics"
];

// Display all students
echo "Class Roster:\n";
foreach ($students as $index => $student) {
    echo ($index + 1) . ". $student\n";
}

echo "\n";

// Display student info
echo "Student Details:\n";
foreach ($studentInfo as $key => $value) {
    echo ucfirst($key) . ": $value\n";
}
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>