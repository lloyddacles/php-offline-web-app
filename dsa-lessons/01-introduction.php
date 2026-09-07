<?php $pageTitle = 'Introduction to Data Structures & Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to Data Structures & Algorithms</h1>
    <p class="lesson-desc">Learn what data structures and algorithms are, why they matter, and how PHP arrays serve as a powerful foundation.</p>
</div>

<h2>What Are Data Structures?</h2>
<p>A <strong>data structure</strong> is a way of organizing and storing data so that it can be accessed and modified efficiently. Think of it as a container that holds data in a specific layout.</p>

<div class="info-box note">
    <div class="box-title">Real-World Analogy</div>
    <p>A <strong>library</strong> organizes books by category, author, and title. Without this system, finding a specific book would be chaotic. Data structures do the same thing for information in programs.</p>
</div>

<h2>Why Learn DSA?</h2>
<ul>
    <li><strong>Efficiency:</strong> Choose the right structure to make programs faster</li>
    <li><strong>Problem Solving:</strong> Break complex problems into manageable pieces</li>
    <li><strong>Interviews:</strong> DSA questions are common in technical interviews</li>
    <li><strong>Scalability:</strong> Handle larger datasets without performance issues</li>
</ul>

<h2>Types of Data Structures</h2>

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

<h2>PHP Arrays: The Swiss Army Knife</h2>
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

<h2>What Is an Algorithm?</h2>
<p>An <strong>algorithm</strong> is a step-by-step procedure for solving a problem or performing a computation. It's like a recipe&mdash;follow the instructions, and you get a result.</p>

<div class="info-box tip">
    <div class="box-title">Key Insight</div>
    <p class="mb-0">The same problem can be solved with different algorithms. The goal is to find one that balances <strong>speed</strong>, <strong>memory usage</strong>, and <strong>readability</strong>.</p>
</div>

<h2>Course Overview</h2>
<p>In this lesson series, we will cover:</p>
<ol>
    <li><strong>Big O Notation</strong> &mdash; Measuring algorithm efficiency</li>
    <li><strong>Arrays & Strings</strong> &mdash; Fundamental building blocks</li>
    <li><strong>Linked Lists</strong> &mdash; Dynamic sequential data</li>
    <li><strong>Stacks & Queues</strong> &mdash; LIFO and FIFO structures</li>
    <li><strong>Trees & Graphs</strong> &mdash; Hierarchical data</li>
    <li><strong>Sorting & Searching</strong> &mdash; Essential algorithms</li>
</ol>

<div class="sandbox">
    <div class="sandbox-header">
        <span class="label">Try It Yourself</span>
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

<h2>Python Implementation</h2>
<pre><code class="language-python">
# Python lists (dynamic arrays)
fruits = ["Apple", "Banana", "Cherry"]
print("List:", fruits)

# Dictionary (associative array)
person = {"name": "Alice", "age": 25, "city": "Manila"}
print("Dictionary:", person)

# List of dictionaries (multidimensional)
students = [
    {"name": "Bob", "grade": "A"},
    {"name": "Carol", "grade": "B+"}
]
print("Students:", students)

# Basic operations
numbers = [23, 45, 12, 67, 89, 34]
print("Max:", max(numbers))
print("Reversed:", numbers[::-1])
print("Sorted:", sorted(numbers))
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Arrays;
import java.util.Collections;

public class Main {
    public static void main(String[] args) {
        // ArrayList (dynamic array)
        ArrayList&lt;String&gt; fruits = new ArrayList&lt;&gt;();
        fruits.add("Apple");
        fruits.add("Banana");
        fruits.add("Cherry");
        System.out.println("ArrayList: " + fruits);

        // HashMap (associative array)
        HashMap&lt;String, Object&gt; person = new HashMap&lt;&gt;();
        person.put("name", "Alice");
        person.put("age", 25);
        person.put("city", "Manila");
        System.out.println("HashMap: " + person);

        // ArrayList of HashMaps
        ArrayList&lt;HashMap&lt;String, String&gt;&gt; students = new ArrayList&lt;&gt;();
        HashMap&lt;String, String&gt; student1 = new HashMap&lt;&gt;();
        student1.put("name", "Bob");
        student1.put("grade", "A");
        students.add(student1);

        // Basic operations
        ArrayList&lt;Integer&gt; numbers = new ArrayList&lt;&gt;(Arrays.asList(23, 45, 12, 67, 89, 34));
        System.out.println("Max: " + Collections.max(numbers));
        Collections.sort(numbers);
        System.out.println("Sorted: " + numbers);
    }
}
</code></pre>

<div class="lesson-nav">
    <?php if ($prevNext['prev']): ?>
        <a href="<?= lessonUrl($prevNext['prev']['num'], $prevNext['prev']['slug'], 'dsa-lessons') ?>" class="prev-link">&larr; Previous: <?= htmlspecialchars($prevNext['prev']['title']) ?></a>
    <?php endif; ?>
    <?php if ($prevNext['next']): ?>
        <a href="<?= lessonUrl($prevNext['next']['num'], $prevNext['next']['slug'], 'dsa-lessons') ?>" class="next-link">Next: <?= htmlspecialchars($prevNext['next']['title']) ?> &rarr;</a>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>