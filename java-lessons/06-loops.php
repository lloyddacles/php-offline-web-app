<?php $pageTitle = 'Loop Statements'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $sectionDir = 'java-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Loop Statements</h1>
    <p class="lesson-desc">Master repetition in Java: for loops, while loops, do-while loops, for-each, and break/continue.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>If you needed to print "Hello" 10 times, would you write 10 print statements? What's a better approach?</li>
        <li>What is a condition, and how can it be used to control how many times something repeats?</li>
        <li>Can you think of a real-life task that repeats until a condition is met (like checking if a door is locked)?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Loops allow your program to repeat a block of code multiple times. Java provides four loop types: <code>for</code> (known iterations), <code>while</code> (condition-first), <code>do-while</code> (executes at least once), and <code>for-each</code> (iterates over collections).</p>

<h3>Analogy</h3>
<p>Think of a loop like a washing machine. It goes through the same cycle (wash, rinse, spin) repeatedly until a condition is met (all cycles complete). The <code>for</code> loop is like a machine with a preset number of cycles. The <code>while</code> loop keeps running until you tell it to stop.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>for loop</strong> — Best when you know the exact number of iterations</li>
    <li><strong>while loop</strong> — Best when the number of iterations is unknown</li>
    <li><strong>do-while loop</strong> — Guarantees at least one execution</li>
    <li><strong>for-each loop</strong> — Cleanly iterates over arrays and collections</li>
    <li><strong>break</strong> — Exits the loop immediately</li>
    <li><strong>continue</strong> — Skips to the next iteration</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point

        // for loop: repeat a known number of times
        System.out.println("Counting 1 to 5:");
        for (int i = 1; i <= 5; i++) {       // Start at 1, end at 5
            System.out.println("Number: " + i); // Print current number
        }

        // while loop: repeat while condition is true
        System.out.println("\nSum of 1 to 5:");
        int sum = 0;                         // Start with zero
        int i = 1;                           // Counter starts at 1
        while (i <= 5) {                     // Loop while i is 5 or less
            sum = sum + i;                   // Add i to sum
            i++;                             // Increment counter
        }
        System.out.println("Total: " + sum); // Print the sum
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Counting 1 to 5:
Number: 1
Number: 2
Number: 3
Number: 4
Number: 5

Sum of 1 to 5:
Total: 15</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Data processing</strong> — Loop through records in a database to calculate totals</li>
    <li><strong>User input validation</strong> — Keep asking for input until a valid response is given</li>
    <li><strong>Game loops</strong> — Run the game continuously until the player quits</li>
    <li><strong>File processing</strong> — Read lines from a file one by one until the end</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>for</code> when you know the count — <code>for (int i = 0; i < 10; i++)</code></li>
    <li>Use <code>while</code> when the condition determines when to stop</li>
    <li>Always ensure the loop variable changes inside the loop to avoid infinite loops</li>
    <li>Use <code>for-each</code> when you only need the values, not the index</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Infinite loops — forgetting to update the loop variable causes the program to freeze</li>
    <li>Off-by-one errors — using <code>&lt;</code> vs <code>&lt;=</code> changes whether the last value is included</li>
    <li>Using <code>continue</code> when you meant <code>break</code> — skip vs exit</li>
    <li>Modifying a for-each collection during iteration — causes <code>ConcurrentModificationException</code></li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a number guessing game. The program has a secret number (42). It needs to check guesses from 1 to 50, report if each guess is too high or too low, and stop when the correct number is found.</p>
    <p><strong>Task:</strong> Write a Java program that simulates this game using loops.</p>
    <ol>
        <li>Create a class called <code>GuessingGame</code></li>
        <li>Use a for loop to iterate through guesses 1 to 50</li>
        <li>Use <code>break</code> when the correct number is found</li>
        <li>Use <code>continue</code> to skip numbers that are not close to the target</li>
        <li>Track and display the number of attempts</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Main {                         // Main class
    public static void main(String[] args) { // Entry point
        int[] scores = {85, 92, 78, 95, 88}; // Array of scores
        int total = 0;                       // Sum of scores

        // Loop through scores and add to total
        for (int i = 0; i < scores.length; i++) { // Loop by index
            total = total + scores[i];       // Add score to total
            System.out.println("Score " + (i + 1) + ": " + scores[i]); // Print score
        }

        double average = total / scores.length; // Calculate average
        System.out.println("Total: " + total);  // Print total
        System.out.println("Average: " + average); // Print average
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Score 1: 85
Score 2: 92
Score 3: 78
Score 4: 95
Score 5: 88
Total: 438
Average: 87</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
