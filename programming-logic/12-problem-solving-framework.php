<?php $pageTitle = 'A Problem-Solving Framework'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $sectionDir = 'programming-logic'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>A Problem-Solving Framework</h1>
    <p class="lesson-desc">Bring it all together with a step-by-step framework for solving any programming problem.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When you face a difficult homework problem, what steps do you take before giving up?</li>
        <li>Think about the last time you fixed something broken. What was your process?</li>
        <li>How do you approach a big project with a deadline? Do you dive in or plan first?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>problem-solving framework</strong> is a systematic approach to tackling programming challenges. The most common framework follows five steps: <strong>Understand, Plan, Code, Test, Reflect</strong>. This framework combines all the thinking skills you've learned into a repeatable process.</p>

<h3>Analogy</h3>
<p>Think of building a house. You don't start laying bricks immediately. First, you understand what kind of house is needed (blueprints). Then you plan the construction (architectural plans). Then you build (construction). Then you inspect (quality check). Finally, you think about improvements for next time (reflection). Programming works the same way.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Understand:</strong> Read the problem multiple times. Identify inputs, outputs, constraints, and edge cases.</li>
    <li><strong>Plan:</strong> Write out your algorithm in pseudocode. Use decomposition to break it into smaller steps.</li>
    <li><strong>Code:</strong> Write the code one piece at a time. Test as you go — don't write everything at once.</li>
    <li><strong>Test:</strong> Check your code with different inputs, including edge cases (empty input, large input, invalid input).</li>
    <li><strong>Reflect:</strong> Ask "Can I make this better?" Look for repeated code, improve naming, and add error handling.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store a word
$word = "Hello";
// Store vowels to check
$vowels = "aeiou";
// Set count to 0
$count = 0;
// Loop through each letter
for ($i = 0; $i < strlen($word); $i++) {
    // Check if letter is a vowel
    if (strpos($vowels, $word[$i]) !== false) {
        // Add 1 to count
        $count++;
    }
}
// Print the count
echo "Vowels in '$word': $count";
</code></pre>
<strong>Output:</strong>
<pre>Vowels in 'Hello': 2</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store a word
word = "Hello"
# Store vowels to check
vowels = "aeiou"
# Set count to 0
count = 0
# Loop through each letter
for letter in word:
    # Check if letter is a vowel
    if letter in vowels:
        # Add 1 to count
        count += 1
# Print the count
print(f"Vowels in '{word}': {count}")
</code></pre>
<strong>Output:</strong>
<pre>Vowels in 'Hello': 2</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store a word
        String word = "Hello";
        // Store vowels to check
        String vowels = "aeiou";
        // Set count to 0
        int count = 0;
        // Loop through each letter
        for (int i = 0; i < word.length(); i++) {
            // Check if letter is a vowel
            if (vowels.indexOf(word.charAt(i)) != -1) {
                // Add 1 to count
                count++;
            }
        }
        // Print the count
        System.out.println("Vowels in '" + word + "': " + count);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Vowels in 'Hello': 2</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Software development:</strong> Every professional development team uses some version of this framework.</li>
    <li><strong>Business problem-solving:</strong> Companies use Understand-Plan-Execute-Review for projects.</li>
    <li><strong>Scientific research:</strong> Scientists follow a similar process: hypothesis, experiment, analyze, conclude.</li>
    <li><strong>Daily decisions:</strong> Even personal decisions follow this pattern: understand options, plan, act, evaluate.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Never skip the "Understand" step — most bugs come from solving the wrong problem.</li>
    <li>Write pseudocode before writing real code — it's faster to change.</li>
    <li>Test with edge cases: empty input, single item, very large input, and invalid input.</li>
    <li>The "Reflect" step is what separates beginners from experts — always look for improvements.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Coding before understanding:</strong> Jumping into code without understanding the problem wastes time.</li>
    <li><strong>Not testing enough:</strong> Testing only with the example input misses edge cases.</li>
    <li><strong>Skip reflection:</strong> Without reflection, you repeat the same mistakes in future projects.</li>
    <li><strong>Trying to write perfect code:</strong> Start with working code, then improve it.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your teacher asks you to build a complete quiz game. The game should store questions and answers, ask each question, check the answer, and keep score. You need to use the full problem-solving framework.</p>
    <p><strong>Task:</strong> Solve this problem using the 5-step framework.</p>
    <ol>
        <li><strong>Understand:</strong> What are the inputs, outputs, and requirements? What are the edge cases?</li>
        <li><strong>Plan:</strong> Write pseudocode for the quiz game algorithm.</li>
        <li><strong>Code:</strong> Implement the quiz game in PHP, starting with one question and building up.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Understand):</strong></p>
        <ul>
            <li><strong>Inputs:</strong> Questions, correct answers, user answers</li>
            <li><strong>Output:</strong> Score (number of correct answers out of total)</li>
            <li><strong>Requirements:</strong> Store questions, display them, check answers, calculate score</li>
            <li><strong>Edge cases:</strong> Empty question list, case-insensitive answers, special characters</li>
        </ul>
        <p><strong>Answer 2 (Pseudocode):</strong></p>
        <pre><code>START
  SET questions = array of question-answer pairs
  SET score = 0
  
  FOR each question in questions:
    DISPLAY question
    GET user answer
    IF user answer matches correct answer (case-insensitive):
      INCREMENT score
      DISPLAY "Correct!"
    ELSE:
      DISPLAY "Wrong! The answer was: [correct answer]"
    END IF
  END FOR
  
  DISPLAY "Final score: [score] out of [total]"
END</code></pre>
        <p><strong>Answer 3 (PHP Implementation):</strong></p>
        <pre><code>// Complete Quiz Game
$questions = [
    ["question" => "What is 2 + 2?", "answer" => "4"],
    ["question" => "Capital of France?", "answer" => "paris"],
    ["question" => "What color is the sky?", "answer" => "blue"]
];

$score = 0;
$total = count($questions);

echo "=== QUIZ GAME ===\n\n";

for ($i = 0; $i < $total; $i++) {
    echo ($i + 1) . ". " . $questions[$i]["question"] . "\n";
    echo "Your answer: ";
    $userAnswer = strtolower(trim(fgets(STDIN)));
    
    if ($userAnswer === $questions[$i]["answer"]) {
        echo "Correct!\n\n";
        $score++;
    } else {
        echo "Wrong! The answer was: " . $questions[$i]["answer"] . "\n\n";
    }
}

echo "=== RESULTS ===\n";
echo "Score: $score out of $total\n";
$percentage = ($score / $total) * 100;
echo "Percentage: $percentage%\n";

if ($percentage >= 80) {
    echo "Excellent work!\n";
} elseif ($percentage >= 60) {
    echo "Good job!\n";
} else {
    echo "Keep practicing!\n";
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
