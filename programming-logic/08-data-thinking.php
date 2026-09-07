<?php $pageTitle = 'Thinking About Data'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Thinking About Data</h1>
    <p class="lesson-desc">Data is the "stuff" programs work with — learn to choose the right structure and model real-world information.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you organize your closet? Do you group clothes by type, color, or season?</li>
        <li>Think about your desk at home. How do you arrange your things so you can find them quickly?</li>
        <li>If you were organizing a library, how would you categorize the books? By genre? Author? Title?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Data thinking</strong> is understanding what data your program needs, how to organize it, and how to store it. In PHP, you use <strong>variables</strong> to store data, <strong>data types</strong> to define what kind of data it is, and <strong>arrays</strong> to organize collections of data.</p>

<h3>Analogy</h3>
<p>Think of your closet again. You need containers (variables) to hold your clothes (data). T-shirts go in one drawer (string), pants in another (integer), and accessories in a separate box (array). The type of container depends on what you're storing — you wouldn't put shoes in a jewelry box. Similarly, the data type depends on what kind of information you're working with.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Identify the data:</strong> What information does your program need to work with?</li>
    <li><strong>Choose the right type:</strong> Is it text (string), a number (integer/float), true/false (boolean), or a collection (array)?</li>
    <li><strong>Use meaningful names:</strong> Name your variables clearly so anyone reading the code knows what they contain.</li>
    <li><strong>Organize collections:</strong> Use indexed arrays for simple lists, associative arrays for key-value pairs, and nested arrays for complex structures.</li>
    <li><strong>Validate input:</strong> Always check that data is in the expected format before using it.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a student's name
$name = "Alice";
// Store the student's age
$age = 20;
// Store the student's grade
$grade = "A";
// Print the student info
echo "Name: $name\n";
echo "Age: $age\n";
echo "Grade: $grade";
</code></pre>
<strong>Output:</strong>
<pre>Name: Alice
Age: 20
Grade: A</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a student's name
name = "Alice"
# Store the student's age
age = 20
# Store the student's grade
grade = "A"
# Print the student info
print(f"Name: {name}")
print(f"Age: {age}")
print(f"Grade: {grade}")
</code></pre>
<strong>Output:</strong>
<pre>Name: Alice
Age: 20
Grade: A</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a student's name
        String name = "Alice";
        // Store the student's age
        int age = 20;
        // Store the student's grade
        String grade = "A";
        // Print the student info
        System.out.println("Name: " + name);
        System.out.println("Age: " + age);
        System.out.println("Grade: " + grade);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Name: Alice
Age: 20
Grade: A</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>User profiles:</strong> Storing name, email, preferences, and settings for each user in an application.</li>
    <li><strong>Inventory systems:</strong> Tracking product names, prices, quantities, and categories for a store.</li>
    <li><strong>Calculations:</strong> Using variables to store intermediate results in complex formulas.</li>
    <li><strong>Record keeping:</strong> Maintaining student grades, employee records, or financial transactions.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Start by listing all the data you need before writing any code.</li>
    <li>Use descriptive variable names — <code>$studentName</code> is better than <code>$x</code>.</li>
    <li>Choose the simplest data structure that fits your needs.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Using the wrong data type:</strong> Storing a number as a string can cause calculation errors.</li>
    <li><strong>Poor variable naming:</strong> Names like <code>$temp</code> or <code>$data</code> don't tell you what the variable contains.</li>
    <li><strong>Not validating input:</strong> Always check that data is in the expected format before using it.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a student information system for your school. The system needs to store and display information about students.</p>
    <p><strong>Task:</strong> Design the data structures for a student information system.</p>
    <ol>
        <li>List all the data fields a student record should contain (name, ID, grades, etc.).</li>
        <li>Choose the right data structure for a single student and for a list of students.</li>
        <li>Write code to create one student record and display their information.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Data Fields):</strong> A student record should include: name (string), student ID (string), age (integer), grade level (integer), grades array (array of integers), GPA (float), and active status (boolean).</p>
        <p><strong>Answer 2 (Data Structure):</strong> A single student: associative array with key-value pairs. A list of students: indexed array of associative arrays (nested structure).</p>
        <p><strong>Answer 3 (Sample Solution):</strong></p>
        <pre><code>// Single student record
$student = [
    "name" => "Alice Johnson",
    "id" => "S2024-001",
    "age" => 16,
    "grade_level" => 10,
    "grades" => [88, 92, 85, 90],
    "gpa" => 3.7,
    "active" => true
];

// Display student information
echo "Student: {$student['name']}\n";
echo "ID: {$student['id']}\n";
echo "Age: {$student['age']}\n";
echo "Grade Level: {$student['grade_level']}\n";
echo "Grades: " . implode(", ", $student['grades']) . "\n";
echo "GPA: {$student['gpa']}\n";
echo "Status: " . ($student['active'] ? "Active" : "Inactive") . "\n";

// List of students
$students = [
    $student,
    [
        "name" => "Bob Smith",
        "id" => "S2024-002",
        "age" => 17,
        "grade_level" => 11,
        "grades" => [75, 80, 78, 82],
        "gpa" => 3.2,
        "active" => true
    ]
];

echo "\nAll Students:\n";
foreach ($students as $s) {
    echo "- {$s['name']} ({$s['id']})\n";
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
