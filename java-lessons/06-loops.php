<?php $pageTitle = 'Loop Statements'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

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
<pre><code class="language-java">public class LoopsDemo {
    public static void main(String[] args) {
        // for loop: count from 1 to 5
        System.out.println("=== For Loop ===");
        for (int i = 1; i <= 5; i++) {
            System.out.println("Count: " + i);
        }

        // while loop: sum numbers 1 to 5
        System.out.println("\n=== While Loop ===");
        int sum = 0;
        int j = 1;
        while (j <= 5) {
            sum += j;
            j++;
        }
        System.out.println("Sum: " + sum);

        // do-while: executes at least once
        System.out.println("\n=== Do-While Loop ===");
        int num = 10;
        do {
            System.out.println("Number: " + num);
            num++;
        } while (num < 5);  // Condition is false, but it ran once!

        // for-each: iterate over an array
        System.out.println("\n=== For-Each Loop ===");
        String[] fruits = {"Apple", "Banana", "Cherry"};
        for (String fruit : fruits) {
            System.out.println("Fruit: " + fruit);
        }

        // break and continue
        System.out.println("\n=== Break at 3 ===");
        for (int i = 1; i <= 10; i++) {
            if (i == 4) break;       // Exit loop when i is 4
            System.out.println(i);
        }

        System.out.println("\n=== Skip Even Numbers ===");
        for (int i = 1; i <= 10; i++) {
            if (i % 2 == 0) continue;  // Skip even numbers
            System.out.println(i);
        }
    }
}
</code></pre>
<strong>Output:</strong>
<pre>=== For Loop ===
Count: 1
Count: 2
Count: 3
Count: 4
Count: 5

=== While Loop ===
Sum: 15

=== Do-While Loop ===
Number: 10

=== For-Each Loop ===
Fruit: Apple
Fruit: Banana
Fruit: Cherry

=== Break at 3 ===
1
2
3

=== Skip Even Numbers ===
1
3
5
7
9</pre>

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
        <pre><code class="language-java">public class GuessingGame {
    public static void main(String[] args) {
        int secretNumber = 42;
        int attempts = 0;

        System.out.println("Guess the number between 1 and 50!");

        for (int guess = 1; guess <= 50; guess++) {
            attempts++;

            if (guess == secretNumber) {
                System.out.println("Correct! " + guess + " is the secret number!");
                System.out.println("Found in " + attempts + " attempts.");
                break;  // Exit the loop
            }

            // Skip numbers that are more than 10 away
            if (Math.abs(guess - secretNumber) > 10) {
                continue;  // Skip to next iteration
            }

            // Give hints for close guesses
            if (guess < secretNumber) {
                System.out.println("Guess " + guess + ": Too low! (attempt " + attempts + ")");
            } else {
                System.out.println("Guess " + guess + ": Too high! (attempt " + attempts + ")");
            }
        }
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Guess the number between 1 and 50!
Guess 32: Too low! (attempt 32)
Guess 33: Too low! (attempt 33)
Guess 34: Too low! (attempt 34)
Guess 35: Too low! (attempt 35)
Guess 36: Too low! (attempt 36)
Guess 37: Too low! (attempt 37)
Guess 38: Too low! (attempt 38)
Guess 39: Too low! (attempt 39)
Guess 40: Too low! (attempt 40)
Guess 41: Too low! (attempt 41)
Correct! 42 is the secret number!
Found in 42 attempts.</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
