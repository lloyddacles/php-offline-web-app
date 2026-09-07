<?php $pageTitle = 'Arrays & Strings'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Arrays &amp; Strings</h1>
    <p class="lesson-desc">Master Java arrays, explore the Arrays utility class, and learn essential String manipulation techniques.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>If you need to store 100 student names, would you create 100 separate variables? What's a better approach?</li>
        <li>How is a String different from a char in Java? (Hint: single quotes vs double quotes)</li>
        <li>What does "immutable" mean? Can you think of something in real life that cannot change once created?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>An <strong>array</strong> is a fixed-size container that holds multiple values of the same type. A <strong>String</strong> is a sequence of characters that is immutable (cannot be changed after creation). Both are fundamental for storing and manipulating data in Java.</p>

<h3>Analogy</h3>
<p>An array is like a row of mailboxes — each box has a number (index) and holds one item. Once built, you cannot add more mailboxes. A String is like a stamped plate — once the words are stamped, you cannot erase them. To change the text, you must create a new plate.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>Arrays</strong> — Fixed size, zero-indexed, store same-type elements</li>
    <li><strong>String methods</strong> — Return new strings (original is unchanged)</li>
    <li><strong>StringBuilder</strong> — Mutable alternative for building strings efficiently</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">import java.util.Arrays;

public class ArraysStringsDemo {
    public static void main(String[] args) {
        // Array creation and access
        int[] numbers = {10, 20, 30, 40, 50};
        System.out.println("Array length: " + numbers.length);
        System.out.println("First element: " + numbers[0]);
        System.out.println("Last element: " + numbers[numbers.length - 1]);

        // Arrays utility class
        int[] arr = {5, 2, 8, 1, 9};
        System.out.println("Original: " + Arrays.toString(arr));
        Arrays.sort(arr);
        System.out.println("Sorted:   " + Arrays.toString(arr));

        // String methods (immutable — returns new string)
        String text = "  Hello, Java!  ";
        System.out.println("Original: \"" + text + "\"");
        System.out.println("Trimmed:  \"" + text.trim() + "\"");
        System.out.println("Upper:    \"" + text.trim().toUpperCase() + "\"");
        System.out.println("Length:   " + text.trim().length());
        System.out.println("charAt(0): " + text.trim().charAt(0));
        System.out.println("indexOf(\"Java\"): " + text.trim().indexOf("Java"));

        // StringBuilder (mutable — modifies in place)
        StringBuilder sb = new StringBuilder("Hello");
        sb.append(" World");
        sb.insert(5, ",");
        System.out.println("StringBuilder: " + sb.toString());
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Array length: 5
First element: 10
Last element: 50
Original: [5, 2, 8, 1, 9]
Sorted:   [1, 2, 5, 8, 9]
Original: "  Hello, Java!  "
Trimmed:  "Hello, Java!"
Upper:    "HELLO, JAVA!"
Length:   12
charAt(0): H
indexOf("Java"): 7
StringBuilder: Hello, World</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Shopping lists</strong> — Arrays store product names for a cart</li>
    <li><strong>Data analysis</strong> — Arrays store scores, prices, or measurements for processing</li>
    <li><strong>Text processing</strong> — String methods clean user input (trim, lowercase)</li>
    <li><strong>Report generation</strong> — StringBuilder builds long text efficiently</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>Arrays.toString()</code> to print arrays — <code>println(arr)</code> prints the memory address</li>
    <li>Use <code>Arrays.sort()</code> to sort arrays in ascending order</li>
    <li>Always assign the result of String methods: <code>text = text.trim();</code></li>
    <li>Use <code>StringBuilder</code> when building strings in loops — it's much faster</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Accessing index 5 in a 5-element array — valid indices are 0 to 4</li>
    <li>Forgetting String methods return new strings — <code>text.trim()</code> does not modify <code>text</code></li>
    <li>Using <code>==</code> to compare Strings — use <code>.equals()</code> for content comparison</li>
    <li>Not importing <code>java.util.Arrays</code> — causes a compilation error</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a contact book application. You need to store a list of names, sort them alphabetically, and search for a specific contact. You also need to format phone numbers by removing spaces and dashes.</p>
    <p><strong>Task:</strong> Write a Java program that manages contacts using arrays and String methods.</p>
    <ol>
        <li>Create an array of 5 contact names</li>
        <li>Sort the array alphabetically using <code>Arrays.sort()</code></li>
        <li>Use a loop to find and display a specific contact</li>
        <li>Use String methods to clean a phone number string (remove spaces and dashes)</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">import java.util.Arrays;

public class ContactBook {
    public static void main(String[] args) {
        // Array of contacts
        String[] contacts = {"Charlie", "Alice", "Eve", "Bob", "Diana"};
        System.out.println("Original: " + Arrays.toString(contacts));

        // Sort alphabetically
        Arrays.sort(contacts);
        System.out.println("Sorted:   " + Arrays.toString(contacts));

        // Search for a contact
        String searchName = "Eve";
        boolean found = false;
        for (String contact : contacts) {
            if (contact.equals(searchName)) {
                found = true;
                break;
            }
        }
        System.out.println("Search '" + searchName + "': " + (found ? "Found" : "Not found"));

        // Clean a phone number using String methods
        String phone = "(091) 234-5678";
        String cleaned = phone.replaceAll("[^0-9]", "");  // Remove non-digits
        System.out.println("Original phone: " + phone);
        System.out.println("Cleaned phone:  " + cleaned);
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Original: [Charlie, Alice, Eve, Bob, Diana]
Sorted:   [Alice, Bob, Charlie, Diana, Eve]
Search 'Eve': Found
Original phone: (091) 234-5678
Cleaned phone:  0912345678</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
