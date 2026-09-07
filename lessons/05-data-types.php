<?php $pageTitle = 'PHP Data Types'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Data Types</h1>
    <p class="lesson-desc">Understand the different types of data PHP can work with.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What types of information do you deal with every day? (text messages, numbers, photos, true/false questions)</li>
        <li>If you were organizing items in a closet, would you put shoes with clothes? Why or why not?</li>
        <li>In the previous lesson, we stored different kinds of data in variables. What kinds of data did we use?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Data types specify what kind of value a variable can hold. PHP has eight data types, each designed for specific kinds of information.</p>

<h3>Analogy</h3>
<p>Data types are like different containers in your kitchen: you store liquids in cups, solid food in boxes, and frozen items in the freezer. Each container is designed for a specific type of item - putting the wrong item in the wrong container causes problems.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. String: Text data enclosed in quotes ("Hello" or 'Hello')</p>
<p>2. Integer: Whole numbers without decimals (42, -7, 0)</p>
<p>3. Float: Numbers with decimals (3.14, -0.5)</p>
<p>4. Boolean: True or false values (true, false)</p>
<p>5. Array: Collections of values ([1, 2, 3])</p>
<p>6. NULL: Empty or no value (null)</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Different data types
$name = "Alice";          // String - text
$age = 20;                // Integer - whole number
$price = 19.99;           // Float - decimal number
$isActive = true;         // Boolean - true/false
$scores = [95, 87, 92];   // Array - collection
$empty = null;            // NULL - no value

// Check types with gettype()
echo "Name type: " . gettype($name);
echo "\n";
echo "Age type: " . gettype($age);
echo "\n";
echo "Price type: " . gettype($price);
echo "\n";
echo "Active type: " . gettype($isActive);
echo "\n";
echo "Scores type: " . gettype($scores);
echo "\n";
echo "Empty type: " . gettype($empty);
?&gt;
</code></pre>
<strong>Output:</strong>
<pre>Name type: string
Age type: integer
Price type: double
Active type: boolean
Scores type: array
Empty type: NULL</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Choosing the right data type prevents errors in calculations</li>
    <li>Proper data types ensure data validation and security</li>
    <li>Understanding types helps with database storage and retrieval</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use is_int(), is_string(), is_float() to check specific types</li>
    <li>Use gettype() to see the type of any variable</li>
    <li>Use var_dump() for detailed information during debugging</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Confusing "5" (string) with 5 (integer) - they behave differently in calculations</li>
    <li>Forgetting that PHP automatically converts types (type juggling)</li>
    <li>Not checking types before operations - can lead to unexpected results</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a shopping cart and need to identify what data types to use for different information.</p>
    <p><strong>Task:</strong> Determine the appropriate data type for each item.</p>
    <ol>
        <li>Product name: "Wireless Mouse" - What data type?</li>
        <li>Product price: 29.99 - What data type?</li>
        <li>Quantity in stock: 150 - What data type?</li>
        <li>Is product available: true - What data type?</li>
        <li>Customer reviews: ["Great!", "Works well", "Good value"] - What data type?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> String - product name is text</p>
        <p><strong>Answer 2:</strong> Float - price has decimals</p>
        <p><strong>Answer 3:</strong> Integer - quantity is a whole number</p>
        <p><strong>Answer 4:</strong> Boolean - availability is true/false</p>
        <p><strong>Answer 5:</strong> Array - reviews is a collection of strings</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
$productName = "Wireless Mouse";     // String
$productPrice = 29.99;               // Float
$quantity = 150;                     // Integer
$isAvailable = true;                 // Boolean
$reviews = ["Great!", "Works well", "Good value"];  // Array
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>