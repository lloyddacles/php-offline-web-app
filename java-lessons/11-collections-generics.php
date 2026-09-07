<?php $pageTitle = 'Collections & Generics'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 11; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Collections &amp; Generics</h1>
    <p class="lesson-desc">Master <code>ArrayList</code>, <code>HashMap</code>, <code>HashSet</code>, iteration patterns, and generics for type-safe collections.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What are the limitations of arrays? What happens when you need to add more elements than the array can hold?</li>
        <li>How would you store pairs of related data (like names and phone numbers) together?</li>
        <li>Why is it important to ensure that a collection only contains one type of data?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Collections</strong> are dynamic data structures that grow and shrink as needed. <strong>ArrayList</strong> is a resizable list, <strong>HashMap</strong> stores key-value pairs, and <strong>HashSet</strong> stores unique elements. <strong>Generics</strong> ensure type safety by specifying what type of objects a collection can hold.</p>

<h3>Analogy</h3>
<p>Think of an <strong>ArrayList</strong> like a flexible bookshelf — you can add or remove shelves as needed. A <strong>HashMap</strong> is like a dictionary — you look up a word (key) to find its definition (value). A <strong>HashSet</strong> is like a guest list — each name appears only once, no duplicates allowed. <strong>Generics</strong> are like labels on the shelves — "Books only" or "Shoes only" — preventing wrong items from being placed there.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>ArrayList</strong> — Resizable array with methods: <code>add()</code>, <code>remove()</code>, <code>get()</code>, <code>size()</code></li>
    <li><strong>HashMap</strong> — Key-value pairs with methods: <code>put()</code>, <code>get()</code>, <code>containsKey()</code></li>
    <li><strong>HashSet</strong> — Unique elements with methods: <code>add()</code>, <code>contains()</code>, <code>remove()</code></li>
    <li><strong>Generics</strong> — Type parameter: <code>ArrayList&lt;String&gt;</code> ensures only Strings are added</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;

public class CollectionsDemo {
    public static void main(String[] args) {
        // ArrayList: dynamic, ordered list
        ArrayList&lt;String&gt; fruits = new ArrayList&lt;&gt;();
        fruits.add("Apple");
        fruits.add("Banana");
        fruits.add("Cherry");
        System.out.println("Fruits: " + fruits);
        fruits.remove("Banana");
        System.out.println("After remove: " + fruits);
        System.out.println("Size: " + fruits.size());

        // HashMap: key-value pairs
        HashMap&lt;String, Integer&gt; ages = new HashMap&lt;&gt;();
        ages.put("Alice", 25);
        ages.put("Bob", 30);
        ages.put("Carol", 22);
        System.out.println("\nAges: " + ages);
        System.out.println("Alice: " + ages.get("Alice"));
        System.out.println("Contains Bob: " + ages.containsKey("Bob"));

        // HashSet: unique elements only
        HashSet&lt;String&gt; colors = new HashSet&lt;&gt;();
        colors.add("Red");
        colors.add("Green");
        colors.add("Blue");
        colors.add("Red");  // Duplicate ignored!
        System.out.println("\nColors: " + colors);
        System.out.println("Contains Red: " + colors.contains("Red"));

        // Iteration patterns
        System.out.print("\nFruits list: ");
        for (String fruit : fruits) {
            System.out.print(fruit + " ");
        }
        System.out.println();
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Fruits: [Apple, Banana, Cherry]
After remove: [Apple, Cherry]
Size: 2

Ages: {Alice=25, Bob=30, Carol=22}
Alice: 25
Contains Bob: true

Colors: [Red, Green, Blue]
Contains Red: true

Fruits list: Apple Cherry </pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Contact lists</strong> — ArrayList stores and manages a growing list of contacts</li>
    <li><strong>Student grades</strong> — HashMap maps student IDs to their grades</li>
    <li><strong>Unique tags</strong> — HashSet ensures no duplicate tags on blog posts</li>
    <li><strong>Shopping carts</strong> — ArrayList of product objects with quantity tracking</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <strong>ArrayList</strong> when you need ordered data with fast index access</li>
    <li>Use <strong>HashMap</strong> when you need fast lookups by key</li>
    <li>Use <strong>HashSet</strong> when you need to ensure uniqueness</li>
    <li>Always use generics (<code>ArrayList&lt;String&gt;</code>) for type safety</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using raw types without generics — <code>ArrayList list</code> allows any object, causing runtime errors</li>
    <li>Forgetting to import <code>java.util.*</code> — causes compilation errors</li>
    <li>Trying to add null keys to HashMap — causes unexpected behavior</li>
    <li>Modifying a collection during for-each iteration — causes <code>ConcurrentModificationException</code></li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a student management system. You need to store student names in a list, track their scores using a map, and maintain a set of unique course enrollments.</p>
    <p><strong>Task:</strong> Write a Java program that uses all three collection types to manage student data.</p>
    <ol>
        <li>Create an <code>ArrayList</code> of student names and add 5 students</li>
        <li>Create a <code>HashMap</code> that maps student names to their scores</li>
        <li>Create a <code>HashSet</code> of unique courses and demonstrate duplicate rejection</li>
        <li>Loop through all collections and display the data</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;

public class StudentManagement {
    public static void main(String[] args) {
        // ArrayList of student names
        ArrayList&lt;String&gt; students = new ArrayList&lt;&gt;();
        students.add("Alice");
        students.add("Bob");
        students.add("Carol");
        students.add("David");
        students.add("Eve");
        System.out.println("Students: " + students);

        // HashMap: student name to score
        HashMap&lt;String, Integer&gt; scores = new HashMap&lt;&gt;();
        scores.put("Alice", 95);
        scores.put("Bob", 87);
        scores.put("Carol", 92);
        scores.put("David", 78);
        scores.put("Eve", 88);
        System.out.println("Scores: " + scores);

        // HashSet of unique courses
        HashSet&lt;String&gt; courses = new HashSet&lt;&gt;();
        courses.add("Math");
        courses.add("Science");
        courses.add("English");
        courses.add("Math");      // Duplicate ignored
        courses.add("Science");   // Duplicate ignored
        System.out.println("Courses: " + courses);

        // Display all students with their scores
        System.out.println("\n=== Student Report ===");
        for (String name : students) {
            int score = scores.get(name);
            String grade = (score >= 90) ? "A" : (score >= 80) ? "B" : "C";
            System.out.println(name + ": " + score + " (" + grade + ")");
        }

        System.out.println("Enrolled courses: " + courses.size());
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Students: [Alice, Bob, Carol, David, Eve]
Scores: {Alice=95, Bob=87, Carol=92, David=78, Eve=88}
Courses: [Math, Science, English]

=== Student Report ===
Alice: 95 (A)
Bob: 87 (B)
Carol: 92 (A)
David: 78 (C)
Eve: 88 (B)
Enrolled courses: 3</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
