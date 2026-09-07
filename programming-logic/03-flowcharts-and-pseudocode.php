<?php $pageTitle = 'Flowcharts & Pseudocode'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Flowcharts &amp; Pseudocode</h1>
    <p class="lesson-desc">Learn to plan your programs before writing code — save time, catch errors early, and think clearly.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Have you ever drawn a map or floor plan before? How did the visual help you understand the layout?</li>
        <li>When you follow directions to a new place, do you prefer written instructions or a visual map? Why?</li>
        <li>Think about the steps to get from your house to school. Can you list them in order without forgetting anything?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Flowcharts</strong> are visual diagrams that show the flow of a program using shapes and arrows. <strong>Pseudocode</strong> is English-like code that describes what a program does without using actual programming syntax. Both are planning tools that help you think through logic before coding.</p>

<h3>Analogy</h3>
<p>A flowchart is like a map for your code — it shows you the route your program will take, including decision points (turn left or right?). Pseudocode is like writing directions in plain English before translating them into a formal programming language. Together, they're your blueprints before building the house.</p>

<h3>How It Works (Step by Step)</h3>
<p>Using flowcharts and pseudocode follows these steps:</p>
<ol>
    <li><strong>Understand the problem:</strong> Know what the program needs to do.</li>
    <li><strong>Draw the flowchart:</strong> Use shapes to represent each step — ovals for start/end, rectangles for actions, diamonds for decisions, parallelograms for input/output.</li>
    <li><strong>Write pseudocode:</strong> Translate the flowchart into English-like steps.</li>
    <li><strong>Review and refine:</strong> Check for missing steps or logic errors.</li>
    <li><strong>Convert to code:</strong> Translate the pseudocode into actual PHP, Python, or Java.</li>
</ol>

<h3>Example</h3>
<pre><code class="language-php">// PHP Example: Grade Calculator based on pseudocode
// Pseudocode:
//   START
//   READ score
//   IF score >= 90 THEN grade = "A"
//   ELSE IF score >= 80 THEN grade = "B"
//   ELSE IF score >= 70 THEN grade = "C"
//   ELSE IF score >= 60 THEN grade = "D"
//   ELSE grade = "F"
//   PRINT grade
//   END

$score = 85;

if ($score >= 90) {
    $grade = "A";
} elseif ($score >= 80) {
    $grade = "B";
} elseif ($score >= 70) {
    $grade = "C";
} elseif ($score >= 60) {
    $grade = "D";
} else {
    $grade = "F";
}

echo "Score: $score\n";
echo "Grade: $grade\n";
</code></pre>
<strong>Output:</strong>
<pre>Score: 85
Grade: B</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Python Example: Grade Calculator based on pseudocode

score = 85

if score >= 90:
    grade = "A"
elif score >= 80:
    grade = "B"
elif score >= 70:
    grade = "C"
elif score >= 60:
    grade = "D"
else:
    grade = "F"

print(f"Score: {score}")
print(f"Grade: {grade}")
</code></pre>
<strong>Output:</strong>
<pre>Score: 85
Grade: B</pre>

<h3>Java Example</h3>
<pre><code class="language-java">// Java Example: Grade Calculator based on pseudocode
public class Main {
    public static void main(String[] args) {
        int score = 85;
        char grade;

        if (score >= 90) {
            grade = 'A';
        } else if (score >= 80) {
            grade = 'B';
        } else if (score >= 70) {
            grade = 'C';
        } else if (score >= 60) {
            grade = 'D';
        } else {
            grade = 'F';
        }

        System.out.println("Score: " + score);
        System.out.println("Grade: " + grade);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Score: 85
Grade: B</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Documenting processes:</strong> Companies use flowcharts to document how things work, from customer onboarding to manufacturing.</li>
    <li><strong>Team communication:</strong> Pseudocode helps non-programmers understand what a program will do before it's built.</li>
    <li><strong>Debugging:</strong> Drawing a flowchart of your logic helps you spot errors before they become bugs.</li>
    <li><strong>Interviews:</strong> Tech companies often ask candidates to write pseudocode during interviews to test their thinking process.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Start with pseudocode — it's faster to write and easier to change than a flowchart.</li>
    <li>Use standard flowchart symbols so others can understand your diagrams.</li>
    <li>Always include a start and end point in your flowcharts.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Skipping the planning phase:</strong> Jumping straight to code leads to more bugs and wasted time.</li>
    <li><strong>Making flowcharts too detailed:</strong> Keep them high-level — the details go in the code.</li>
    <li><strong>Using programming syntax in pseudocode:</strong> Pseudocode should be readable by anyone, not just programmers.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your school wants a simple program that determines a student's letter grade based on their numeric score. The grading scale is: 90-100 = A, 80-89 = B, 70-79 = C, 60-69 = D, below 60 = F.</p>
    <p><strong>Task:</strong> Create both a flowchart (describe it in words) and pseudocode for this grading system.</p>
    <ol>
        <li>Draw a flowchart using the standard symbols (describe each shape and what it contains).</li>
        <li>Write the pseudocode for the same logic.</li>
        <li>Test your logic with three different scores: 95, 72, and 58. What grade does each receive?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Flowchart):</strong></p>
        <pre><code>OVAL: Start
  ↓
PARALLELOGRAM: Input score
  ↓
DIAMOND: Is score >= 90?
  → YES: RECTANGLE: grade = "A" → go to Output
  → NO: ↓
DIAMOND: Is score >= 80?
  → YES: RECTANGLE: grade = "B" → go to Output
  → NO: ↓
DIAMOND: Is score >= 70?
  → YES: RECTANGLE: grade = "C" → go to Output
  → NO: ↓
DIAMOND: Is score >= 60?
  → YES: RECTANGLE: grade = "D" → go to Output
  → NO: RECTANGLE: grade = "F" → go to Output
  ↓
PARALLELOGRAM: Output grade
  ↓
OVAL: End</code></pre>
        <p><strong>Answer 2 (Pseudocode):</strong></p>
        <pre><code>START
  READ score
  IF score >= 90 THEN
    grade = "A"
  ELSE IF score >= 80 THEN
    grade = "B"
  ELSE IF score >= 70 THEN
    grade = "C"
  ELSE IF score >= 60 THEN
    grade = "D"
  ELSE
    grade = "F"
  END IF
  PRINT grade
END</code></pre>
        <p><strong>Answer 3 (Testing):</strong> Score 95 → A (95 >= 90). Score 72 → C (72 >= 70 but less than 80). Score 58 → F (58 is below 60).</p>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
