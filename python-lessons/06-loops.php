<?php $pageTitle = 'Loop Statements'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $sectionDir = 'python-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Loop Statements</h1>
    <p class="lesson-desc">Repeat tasks efficiently with for loops, while loops, and loop control statements.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between a <code>for</code> loop and a <code>while</code> loop?</li>
        <li>What does the <code>range()</code> function do, and what happens if you call <code>range(5)</code>?</li>
        <li>What is the difference between <code>break</code> and <code>continue</code>?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Loops let you execute a block of code repeatedly. Python has two loop types: <strong>for</strong> loops iterate over sequences (lists, strings, ranges), and <strong>while</strong> loops repeat as long as a condition is true. Use <code>break</code> to exit a loop early and <code>continue</code> to skip to the next iteration.</p>

<h3>Analogy</h3>
<p>Think of a for loop like reading a roster — you go through each name one by one until the list ends. A while loop is like waiting at a bus stop — you keep waiting (looping) as long as the bus hasn't arrived (condition is true). <code>break</code> is like leaving the bus stop early, and <code>continue</code> is like skipping someone on the roster and moving to the next person.</p>

<h3>How It Works</h3>
<p>The <code>for</code> loop uses <code>range()</code> to generate sequences of numbers. The <code>while</code> loop checks its condition before each iteration — always make sure the condition eventually becomes false to avoid infinite loops. <code>enumerate()</code> gives you both index and value when iterating over a list.</p>

<h3>Example</h3>
<pre><code class="language-python"># Print student names
students = ["Juan", "Maria", "Pedro"]

# Loop through each student
for student in students:
    print("Student:", student)

# Count from 1 to 5
print("\nCounting:")
for i in range(1, 6):
    print(i, end=" ")
print()
</code></pre>
<strong>Output:</strong>
<pre>Student: Juan
Student: Maria
Student: Pedro

Counting:
1 2 3 4 5</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Data Processing:</strong> Loop through database records to generate reports</li>
    <li><strong>User Input Validation:</strong> Keep asking for input until the user provides valid data</li>
    <li><strong>Web Scraping:</strong> Iterate through pages of a website to collect data</li>
    <li><strong>Batch Operations:</strong> Process files in a directory one by one</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>for</code> loops when you know the number of iterations; use <code>while</code> when the end depends on a condition</li>
    <li>Always ensure your <code>while</code> loop condition will eventually become false</li>
    <li>Use <code>enumerate()</code> instead of manual index tracking: <code>for i, item in enumerate(list)</code></li>
    <li>Use <code>zip()</code> to loop over multiple lists simultaneously</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting to increment the counter in a while loop (infinite loop!)</li>
    <li>Modifying a list while iterating over it — use a copy or list comprehension</li>
    <li>Using <code>range(len(list))</code> when <code>enumerate()</code> is cleaner</li>
    <li>Not using <code>break</code> when you've found what you're looking for — wasted iterations</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a number guessing game. The computer picks a secret number between 1 and 50. The player gets 7 attempts to guess it. After each guess, the program tells the player if their guess was too high, too low, or correct.</p>
    <p><strong>Task:</strong> Write a loop that simulates this game for a fixed list of guesses.</p>
    <ol>
        <li>Set the secret number and a list of guesses to try</li>
        <li>Use a for loop to go through each guess</li>
        <li>Use if/elif/else to compare each guess to the secret number</li>
        <li>Use <code>break</code> when the correct guess is found</li>
        <li>Track the number of attempts used</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should use a for loop with break and proper comparison logic.</p>
        <pre><code># Number guessing game
secret = 37
guesses = [20, 40, 35, 37]

# Try each guess
for guess in guesses:
    print("Guessing:", guess)

    if guess == secret:
        print("Correct!")
        break
    elif guess < secret:
        print("Too low!")
    else:
        print("Too high!")
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
