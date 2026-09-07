<?php $pageTitle = 'Introduction to Data Structures & Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to Data Structures & Algorithms</h1>
    <p class="lesson-desc">Learn what data structures and algorithms are, why they matter, and how they power the software we use every day.</p>
</div>

<!-- PART 1 -->
<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we dive into data structures and algorithms, let's make sure you have the foundational concepts down. Think about how you use lists, dictionaries, and step-by-step instructions in everyday life.</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a program, and what role does data play in making a program useful?</li>
        <li>Imagine you have a pile of unsorted exam papers. Describe the steps you would take to arrange them by student name. What does this process have in common with a computer algorithm?</li>
        <li>Why might storing 100 student records in a notebook be different from storing them in a spreadsheet? What advantages does structured storage offer?</li>
    </ol>
</div>

<!-- PART 2 -->
<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>data structure</strong> is a way of organizing and storing data so that it can be accessed and modified efficiently. An <strong>algorithm</strong> is a step-by-step procedure for solving a problem or performing a computation. Together, DSA (Data Structures & Algorithms) forms the backbone of efficient software.</p>

<h3>Analogy</h3>
<p>Think of a <strong>library</strong>. Books are organized by category, author, and title. Without this system, finding a specific book would be chaotic. Data structures do the same thing for information in programs &mdash; they provide organized containers. Algorithms are like the <strong>library's checkout process</strong>: a clear set of steps to find, retrieve, and return a book efficiently.</p>

<h3>How It Works (Step by Step)</h3>
<p>Every program handles data. Here's how DSA connects:</p>
<ol>
    <li><strong>Data</strong> is raw facts &mdash; numbers, names, records (e.g., a student's name and grade).</li>
    <li><strong>Information</strong> is data that has been processed and organized to be meaningful.</li>
    <li>A <strong>data structure</strong> decides how that data is stored in memory.</li>
    <li>An <strong>algorithm</strong> decides how to process that data &mdash; searching, sorting, or transforming it.</li>
    <li>Choosing the right structure and algorithm determines whether your program is fast or slow, efficient or wasteful.</li>
</ol>

<h3>Types of Data Structures</h3>
<p>Data structures are broadly classified into two categories:</p>

<table>
    <thead>
        <tr>
            <th>Type</th>
            <th>Examples</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Linear</strong></td>
            <td>Arrays, Linked Lists, Stacks, Queues</td>
            <td>Elements arranged sequentially, one after another</td>
        </tr>
        <tr>
            <td><strong>Non-Linear</strong></td>
            <td>Trees, Graphs, Hash Tables</td>
            <td>Elements connected in hierarchical or network patterns</td>
        </tr>
    </tbody>
</table>

<h3>Why DSA Matters</h3>
<ul>
    <li><strong>Efficiency:</strong> Choose the right structure to make programs faster</li>
    <li><strong>Problem Solving:</strong> Break complex problems into manageable pieces</li>
    <li><strong>Interviews:</strong> DSA questions are common in technical interviews</li>
    <li><strong>Scalability:</strong> Handle larger datasets without performance issues</li>
</ul>

<h3>PHP Implementation</h3>
<p>PHP arrays are incredibly versatile. They can function as indexed arrays, associative arrays, and even multidimensional structures&mdash;all built into one data type.</p>

<div class="sandbox">
    <div class="sandbox-header">
        <span class="label">Try It Yourself</span>
    </div>
    <textarea class="sandbox-code" data-example="<?= base64_encode('<?php
// Indexed Array - like a numbered list
$fruits = ["Apple", "Banana", "Cherry"];
echo "Indexed Array:\n";
print_r($fruits);

// Associative Array - like a dictionary
$person = ["name" => "Alice", "age" => 25, "city" => "Manila"];
echo "\nAssociative Array:\n";
print_r($person);

// Multidimensional Array - array of arrays
$students = [
    ["name" => "Bob", "grade" => "A"],
    ["name" => "Carol", "grade" => "B+"]
];
echo "\nMultidimensional Array:\n";
print_r($students);
'); ?>"></textarea>
    <div class="sandbox-actions">
        <button class="btn btn-success run-btn">Run Code</button>
        <span class="text-muted" style="font-size:0.85em;">Ctrl+Enter to run</span>
    </div>
    <div class="sandbox-result">
        <div class="output-label">Output:</div>
        <div class="output-content"></div>
    </div>
</div>

<div class="sandbox">
    <div class="sandbox-header">
        <span class="label">Try It Yourself &mdash; Simple Algorithm</span>
    </div>
    <textarea class="sandbox-code" data-example="<?= base64_encode('<?php
// Simple algorithm: Finding the maximum value
$numbers = [23, 45, 12, 67, 89, 34];

function findMax($arr) {
    $max = $arr[0];
    foreach ($arr as $num) {
        if ($num > $max) {
            $max = $num;
        }
    }
    return $max;
}

$maxValue = findMax($numbers);
echo "Array: " . implode(", ", $numbers) . "\n";
echo "Maximum value: " . $maxValue . "\n";

// Another algorithm: Reversing an array
$reversed = array_reverse($numbers);
echo "Reversed: " . implode(", ", $reversed) . "\n";
'); ?>"></textarea>
    <div class="sandbox-actions">
        <button class="btn btn-success run-btn">Run Code</button>
        <span class="text-muted" style="font-size:0.85em;">Ctrl+Enter to run</span>
    </div>
    <div class="sandbox-result">
        <div class="output-label">Output:</div>
        <div class="output-content"></div>
    </div>
</div>

<h3>Python Example: Working with Lists</h3>
<p>Python lists are like dynamic arrays — they can grow and shrink automatically.</p>
<pre><code class="language-python"># A list is a collection of items in order
students = ["Juan", "Maria", "Pedro"]

# Add a student to the end
students.append("Ana")
print(students)  # ['Juan', 'Maria', 'Pedro', 'Ana']

# Find how many students
print(len(students))  # 4

# Access first student (index starts at 0)
print(students[0])  # Juan

# Remove a student
students.remove("Maria")
print(students)  # ['Juan', 'Pedro', 'Ana']
</code></pre>
<strong>Output:</strong>
<pre>['Juan', 'Maria', 'Pedro', 'Ana']
4
Juan
['Juan', 'Pedro', 'Ana']</pre>

<h3>Java Example: Working with ArrayList</h3>
<p>Java ArrayList is like a dynamic array that can grow automatically.</p>
<pre><code class="language-java">import java.util.ArrayList;

public class Main {
    public static void main(String[] args) {
        // Create an ArrayList of strings
        ArrayList&lt;String&gt; students = new ArrayList&lt;&gt;();

        // Add students
        students.add("Juan");
        students.add("Maria");
        students.add("Pedro");
        students.add("Ana");
        System.out.println(students);  // [Juan, Maria, Pedro, Ana]

        // Find how many students
        System.out.println(students.size());  // 4

        // Access first student (index starts at 0)
        System.out.println(students.get(0));  // Juan

        // Remove a student
        students.remove("Maria");
        System.out.println(students);  // [Juan, Pedro, Ana]
    }
}
</code></pre>
<strong>Output:</strong>
<pre>[Juan, Maria, Pedro, Ana]
4
Juan
[Juan, Pedro, Ana]</pre>

<!-- PART 3 -->
<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Social Media Feeds:</strong> Posts are stored in arrays or lists and sorted by time or relevance. Algorithms decide which posts appear first in your feed.</li>
    <li><strong>GPS Navigation:</strong> Maps are represented as graphs. Shortest-path algorithms (like Dijkstra's) find the fastest route from point A to B.</li>
    <li><strong>Search Engines:</strong> Web pages are indexed using hash tables and trees. Search algorithms retrieve relevant results in milliseconds.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always ask: "What data am I working with, and what do I need to do with it?" This helps you choose the right data structure.</li>
    <li>Start simple. Arrays and loops are powerful enough for many problems.</li>
    <li>Practice translating real-world processes (like sorting mail) into step-by-step instructions.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use When...</th><th>Avoid When...</th></tr></thead>
    <tbody>
        <tr><td>You need to organize or retrieve data efficiently</td><td>The problem is trivial and doesn't involve data processing</td></tr>
        <tr><td>Your program handles large datasets</td><td>Hard-coding a solution is simpler and faster to write</td></tr>
        <tr><td>Performance and scalability matter</td><td>The data size is small and fixed (e.g., a 5-item list)</td></tr>
    </tbody>
</table>

<!-- PART 4 -->
<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a student grade book system for a school with 500 students. The system needs to store each student's name, ID number, and grades across 5 subjects. Teachers need to look up a student by ID, add new students, remove graduated students, and generate a class ranking sorted by GPA.</p>
    <p><strong>Task:</strong> Identify what data needs to be stored and what operations are needed. Answer the following:</p>
    <ol>
        <li>List all the pieces of data (fields) that need to be stored for each student. Which data structure from this lesson would you use to store a single student's record? Why?</li>
        <li>List all the operations the system must perform. For each operation, describe it in plain English as a step-by-step procedure (an algorithm).</li>
        <li>Which operation do you think would be the slowest if the school grows to 10,000 students? How might choosing a different data structure help?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Fields: name (string), ID number (integer), grades for 5 subjects (array of numbers). A <strong>PHP associative array</strong> (or Python dictionary / Java HashMap) works well for a single student because it maps field names to values: <code>['name' => 'Juan', 'id' => 1001, 'grades' => [90, 85, 92, 88, 95]]</code>.</p>
        <p><strong>Answer 2:</strong></p>
        <ul>
            <li><em>Look up by ID:</em> Loop through all students, compare each ID to the target. Return the matching student. (Linear search, O(n))</li>
            <li><em>Add student:</em> Create a new student record and append it to the list of students. (Append to array, O(1))</li>
            <li><em>Remove student:</em> Find the student by ID, then remove that entry from the list. (Search + delete, O(n))</li>
            <li><em>Rank by GPA:</em> Calculate GPA for each student, then sort the list by GPA in descending order. (Sorting, O(n log n))</li>
        </ul>
        <p><strong>Answer 3:</strong> The <strong>rank/sort operation</strong> would be slowest with a simple array at 10,000 students (O(n log n)). The <strong>lookup by ID</strong> is also slow at O(n). A <strong>hash table</strong> (associative array) could make lookups O(1) by using student ID as the key. A <strong>tree-based structure</strong> could maintain sorted order more efficiently.</p>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
