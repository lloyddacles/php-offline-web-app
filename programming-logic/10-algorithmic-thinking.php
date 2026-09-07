<?php $pageTitle = 'Algorithmic Thinking'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Algorithmic Thinking</h1>
    <p class="lesson-desc">Learn to break problems down into clear, step-by-step instructions — the foundation of all programming.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How do you solve a math problem like 15 × 12? Do you multiply digit by digit, or use a shortcut?</li>
        <li>When you solve a jigsaw puzzle, do you start with the edges or the middle? Why?</li>
        <li>Think about following a recipe. What makes a recipe easy to follow vs. confusing?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Algorithmic thinking</strong> is the ability to create a clear, step-by-step set of instructions to solve a problem. An algorithm must have a clear starting point, definite steps, and a guaranteed stopping point. It's the foundation of all programming.</p>

<h3>Analogy</h3>
<p>An algorithm is like GPS directions. It takes you from where you are (start) to where you want to go (end) with specific, unambiguous steps: "Turn left at Main Street, go 2 blocks, turn right." If the directions are vague ("go somewhere"), you'll get lost. The same applies to programming — vague algorithms produce bugs.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Understand the problem:</strong> What exactly are you trying to solve?</li>
    <li><strong>Define inputs and outputs:</strong> What data goes in, and what should come out?</li>
    <li><strong>Write the steps:</strong> Create precise, ordered instructions that anyone could follow.</li>
    <li><strong>Refine the algorithm:</strong> Test it mentally with different inputs to make sure it works.</li>
    <li><strong>Convert to code:</strong> Translate the algorithm into actual programming code.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a list of numbers
$numbers = [3, 7, 2, 9, 5];
// Start with the first number as largest
$largest = $numbers[0];
// Loop through each number
for ($i = 1; $i < count($numbers); $i++) {
    // Check if current number is larger
    if ($numbers[$i] > $largest) {
        // Update largest
        $largest = $numbers[$i];
    }
}
// Print the largest number
echo "Largest: $largest";
</code></pre>
<strong>Output:</strong>
<pre>Largest: 9</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a list of numbers
numbers = [3, 7, 2, 9, 5]
# Start with the first number as largest
largest = numbers[0]
# Loop through each number
for i in range(1, len(numbers)):
    # Check if current number is larger
    if numbers[i] > largest:
        # Update largest
        largest = numbers[i]
# Print the largest number
print(f"Largest: {largest}")
</code></pre>
<strong>Output:</strong>
<pre>Largest: 9</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a list of numbers
        int[] numbers = {3, 7, 2, 9, 5};
        // Start with the first number as largest
        int largest = numbers[0];
        // Loop through each number
        for (int i = 1; i < numbers.length; i++) {
            // Check if current number is larger
            if (numbers[i] > largest) {
                // Update largest
                largest = numbers[i];
            }
        }
        // Print the largest number
        System.out.println("Largest: " + largest);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Largest: 9</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Problem-solving interviews:</strong> Tech companies test your algorithmic thinking with coding challenges.</li>
    <li><strong>Competitive programming:</strong> Writing efficient algorithms to solve problems under time constraints.</li>
    <li><strong>Real projects:</strong> Every software project starts with designing the algorithm before writing code.</li>
    <li><strong>Daily life:</strong> Planning routes, organizing tasks, and solving puzzles all use algorithmic thinking.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Start with the simplest version of the algorithm, then add complexity.</li>
    <li>Write the algorithm in plain English first — if you can't explain it, you can't code it.</li>
    <li>Test your algorithm mentally with different inputs before coding it.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Vague steps:</strong> "Process the data" is not an algorithm. "Add 1 to each number in the list" is.</li>
    <li><strong>Infinite loops:</strong> Make sure every algorithm has a clear stopping condition.</li>
    <li><strong>Ignoring edge cases:</strong> What happens with empty input, one item, or very large input?</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your teacher asks you to design an algorithm that finds the tallest student in a class of 30 students. You need to write the algorithm in plain English first, then implement it in PHP.</p>
    <p><strong>Task:</strong> Design and implement an algorithm to find the tallest student.</p>
    <ol>
        <li>Write the algorithm in plain English (at least 5 clear steps).</li>
        <li>Identify what the inputs are and what the output should be.</li>
        <li>Implement the algorithm in PHP and test it with sample data.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Algorithm in Plain English):</strong></p>
        <pre><code>Algorithm: Find Tallest Student

INPUT: A list of students with their heights
OUTPUT: The name and height of the tallest student

Step 1: Check if the list is empty. If yes, return "No students."
Step 2: Assume the first student is the tallest.
Step 3: For each remaining student in the list:
  Step 3a: Compare this student's height to the current tallest.
  Step 3b: If this student is taller, they become the new tallest.
Step 4: After checking all students, the current tallest is the answer.
Step 5: Return the name and height of the tallest student.</code></pre>
        <p><strong>Answer 2 (Inputs/Outputs):</strong></p>
        <ul>
            <li><strong>Input:</strong> An array of student records, each containing a name and height.</li>
            <li><strong>Output:</strong> The name and height of the tallest student found.</li>
        </ul>
        <p><strong>Answer 3 (PHP Implementation):</strong></p>
        <pre><code>// Complete PHP implementation
$students = [
    ["name" => "Alice", "height" => 165],
    ["name" => "Bob", "height" => 180],
    ["name" => "Charlie", "height" => 170],
    ["name" => "Diana", "height" => 175],
    ["name" => "Eve", "height" => 160]
];

function findTallest($students) {
    // Step 1: Check for empty list
    if (empty($students)) {
        return "No students.";
    }
    
    // Step 2: Assume first is tallest
    $tallest = $students[0];
    
    // Step 3: Compare each student
    for ($i = 1; $i < count($students); $i++) {
        if ($students[$i]['height'] > $tallest['height']) {
            $tallest = $students[$i];
        }
    }
    
    // Step 5: Return result
    return "{$tallest['name']} ({$tallest['height']}cm)";
}

echo "Tallest: " . findTallest($students) . "\n";
// Output: Tallest: Bob (180cm)</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
