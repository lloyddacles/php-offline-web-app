<?php $pageTitle = 'A Problem-Solving Framework'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

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

<h3>Example</h3>
<pre><code class="language-php">// PHP Example: Using the framework to count vowels

// STEP 1: UNDERSTAND
// Input: a string
// Output: number of vowels (a, e, i, o, u)
// Edge cases: empty string, uppercase, no vowels

// STEP 2: PLAN (Pseudocode)
// 1. Convert string to lowercase
// 2. Initialize counter to 0
// 3. For each character in string:
//    If character is a, e, i, o, or u, increment counter
// 4. Return counter

// STEP 3: CODE
function countVowels($str) {
    $str = strtolower($str);
    $count = 0;
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    
    for ($i = 0; $i < strlen($str); $i++) {
        if (in_array($str[$i], $vowels)) {
            $count++;
        }
    }
    return $count;
}

// STEP 4: TEST
echo "Testing countVowels:\n";
echo "'Hello' → " . countVowels("Hello") . " (expected: 2)\n";
echo "'Programming' → " . countVowels("Programming") . " (expected: 3)\n";
echo "'' → " . countVowels("") . " (expected: 0)\n";
echo "'AEIOU' → " . countVowels("AEIOU") . " (expected: 5)\n";
echo "'rhythm' → " . countVowels("rhythm") . " (expected: 0)\n";

// STEP 5: REFLECT
// Could improve by handling special characters
// Could make vowel list a constant for reuse
</code></pre>
<strong>Output:</strong>
<pre>Testing countVowels:
'Hello' → 2 (expected: 2)
'Programming' → 3 (expected: 3)
'' → 0 (expected: 0)
'AEIOU' → 5 (expected: 5)
'rhythm' → 0 (expected: 0)</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Python Example: Using the framework

def count_vowels(s):
    """Count vowels in a string."""
    s = s.lower()
    count = 0
    vowels = ['a', 'e', 'i', 'o', 'u']
    
    for char in s:
        if char in vowels:
            count += 1
    return count

# Test
print("Testing count_vowels:")
print(f"'Hello' → {count_vowels('Hello')} (expected: 2)")
print(f"'Programming' → {count_vowels('Programming')} (expected: 3)")
print(f"'' → {count_vowels('')} (expected: 0)")
print(f"'AEIOU' → {count_vowels('AEIOU')} (expected: 5)")
print(f"'rhythm' → {count_vowels('rhythm')} (expected: 0)")
</code></pre>
<strong>Output:</strong>
<pre>Testing count_vowels:
'Hello' → 2 (expected: 2)
'Programming' → 3 (expected: 3)
'' → 0 (expected: 0)
'AEIOU' → 5 (expected: 5)
'rhythm' → 0 (expected: 0)</pre>

<h3>Java Example</h3>
<pre><code class="language-java">// Java Example: Using the framework
public class Main {
    static int countVowels(String str) {
        str = str.toLowerCase();
        int count = 0;
        String vowels = "aeiou";
        
        for (int i = 0; i < str.length(); i++) {
            if (vowels.indexOf(str.charAt(i)) != -1) {
                count++;
            }
        }
        return count;
    }

    public static void main(String[] args) {
        System.out.println("Testing countVowels:");
        System.out.println("'Hello' → " + countVowels("Hello") + " (expected: 2)");
        System.out.println("'Programming' → " + countVowels("Programming") + " (expected: 3)");
        System.out.println("'' → " + countVowels("") + " (expected: 0)");
        System.out.println("'AEIOU' → " + countVowels("AEIOU") + " (expected: 5)");
        System.out.println("'rhythm' → " + countVowels("rhythm") + " (expected: 0)");
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Testing countVowels:
'Hello' → 2 (expected: 2)
'Programming' → 3 (expected: 3)
'' → 0 (expected: 0)
'AEIOU' → 5 (expected: 5)
'rhythm' → 0 (expected: 0)</pre>

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
