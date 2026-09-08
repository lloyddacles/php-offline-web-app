<?php $pageTitle = 'PHP Strings'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $sectionDir = 'lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>PHP Strings</h1>
    <p class="lesson-desc">Master working with text using PHP's powerful string functions.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you work with text messages on your phone? What operations do you perform on text?</li>
        <li>When you write an essay, how do you count words, find specific text, or change capitalization?</li>
        <li>In previous lessons, we used strings with echo. What other operations might we need to perform on text?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Strings are sequences of characters used to represent text. PHP provides many built-in functions to manipulate and work with strings.</p>

<h3>Analogy</h3>
<p>Strings are like sentences in a book. You can count the words (strlen), change capitalization (strtoupper), find specific words (strpos), replace words (str_replace), or extract parts (substr).</p>

<h3>How It Works (Step by Step)</h3>
<p>1. Create strings with single quotes ('literal') or double quotes ("parsed")</p>
<p>2. Use strlen() to get the length of a string</p>
<p>3. Use strtoupper() and strtolower() to change case</p>
<p>4. Use strpos() to find text within a string</p>
<p>5. Use substr() to extract parts of a string</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Store a name
$name = "Alice";
echo "Hello, $name!";

// Get string length
echo "\n";
echo "Length: " . strlen($name) . " characters";

// Convert to uppercase
echo "\n";
echo "Upper: " . strtoupper($name);

// Convert to lowercase
echo "\n";
echo "Lower: " . strtolower($name);
</code></pre>
<strong>Output:</strong>
<pre>Hello, Alice!
Length: 5 characters
Upper: ALICE
Lower: alice</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>Formatting user input for display (names, addresses, messages)</li>
    <li>Validating data (checking if email contains @, password length)</li>
    <li>Creating dynamic content (personalized messages, search results)</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use single quotes for literal text (faster, no parsing)</li>
    <li>Use double quotes when you need variable interpolation</li>
    <li>Always check if text exists before extracting (strpos returns false if not found)</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Forgetting that strpos() returns false (not 0) when text isn't found</li>
    <li>Using double quotes when you don't need variable parsing (wastes resources)</li>
    <li>Not trimming whitespace from user input (causes comparison errors)</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building a user profile system and need to format names properly.</p>
    <p><strong>Task:</strong> Create a name formatter that processes user input.</p>
    <ol>
        <li>Given "alice smith", capitalize the first letter of each word</li>
        <li>Count how many characters are in the full name</li>
        <li>Extract just the first name and last name initials</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> Use ucwords() to capitalize first letters</p>
        <p><strong>Answer 2:</strong> Use strlen() to count characters</p>
        <p><strong>Answer 3:</strong> Use substr() to extract initials</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
$name = "alice smith";
$formatted = ucwords($name);  // "Alice Smith"
echo "Formatted: " . $formatted;
echo "\n";

echo "Length: " . strlen($formatted) . " characters";
echo "\n";

// Extract initials
$firstInitial = substr($formatted, 0, 1);  // "A"
$lastInitial = substr($formatted, strpos($formatted, " ") + 1, 1);  // "S"
echo "Initials: " . $firstInitial . "." . $lastInitial . ".";
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>