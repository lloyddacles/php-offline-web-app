<?php $pageTitle = 'Computational Thinking'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 2; $sectionDir = 'programming-logic'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Computational Thinking</h1>
    <p class="lesson-desc">Master the 4 pillars of computational thinking that every programmer uses to solve problems.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When you have a big project due at school, how do you break it into smaller tasks to make it manageable?</li>
        <li>Think about cleaning your room. How would you organize the work into groups (clothes, books, trash)?</li>
        <li>When studying for exams, how do you decide what to focus on and what to skip?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Computational thinking is a problem-solving approach that breaks complex problems into manageable parts using four core pillars: <strong>Decomposition</strong>, <strong>Pattern Recognition</strong>, <strong>Abstraction</strong>, and <strong>Algorithmic Thinking</strong>.</p>

<h3>Analogy</h3>
<p>Imagine you're planning a birthday party. Instead of thinking "I need to plan a party" (overwhelming!), you break it into smaller pieces: pick a venue, send invitations, order food, plan games, buy a cake. Each piece is easier to handle on its own. That's decomposition — the first pillar of computational thinking.</p>

<h3>How It Works (Step by Step)</h3>
<p>The four pillars work together like this:</p>
<ol>
    <li><strong>Decomposition:</strong> Break the big problem into smaller, manageable sub-problems.</li>
    <li><strong>Pattern Recognition:</strong> Look for similarities, trends, or recurring elements across the sub-problems.</li>
    <li><strong>Abstraction:</strong> Filter out unnecessary details and focus only on what matters.</li>
    <li><strong>Algorithmic Thinking:</strong> Create clear, step-by-step instructions to solve each sub-problem.</li>
</ol>

<h3>PHP Example</h3>
<pre><code class="language-php">&lt;?php
// Store exam scores
$scores = [85, 92, 78, 95, 88];
// Add up all scores
$sum = 0;
// Loop through each score
foreach ($scores as $score) {
    // Add score to sum
    $sum += $score;
}
// Count the scores
$count = count($scores);
// Calculate average
$average = $sum / $count;
// Print the result
echo "Average: $average";
</code></pre>
<strong>Output:</strong>
<pre>Average: 87.6</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Store exam scores
scores = [85, 92, 78, 95, 88]
# Add up all scores
total = 0
# Loop through each score
for score in scores:
    # Add score to total
    total += score
# Count the scores
count = len(scores)
# Calculate average
average = total / count
# Print the result
print(f"Average: {average}")
</code></pre>
<strong>Output:</strong>
<pre>Average: 87.6</pre>

<h3>Java Example</h3>
<pre><code class="language-java">public class Main {
    public static void main(String[] args) {
        // Store exam scores
        int[] scores = {85, 92, 78, 95, 88};
        // Add up all scores
        int sum = 0;
        // Loop through each score
        for (int score : scores) {
            // Add score to sum
            sum += score;
        }
        // Count the scores
        int count = scores.length;
        // Calculate average
        double average = (double) sum / count;
        // Print the result
        System.out.println("Average: " + average);
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Average: 87.6</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Science:</strong> Scientists use decomposition to break complex experiments into smaller, testable parts.</li>
    <li><strong>Business:</strong> Companies use pattern recognition to identify customer trends and predict sales.</li>
    <li><strong>Medicine:</strong> Doctors use abstraction to focus on symptoms that matter and ignore irrelevant details.</li>
    <li><strong>Daily life:</strong> Planning a trip involves decomposition (transport, hotel, activities), pattern recognition (best times to visit), abstraction (focusing on budget), and algorithmic thinking (step-by-step itinerary).</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>When facing a big problem, always start by asking: "Can I break this into 3-5 smaller problems?"</li>
    <li>Look for patterns before writing new code — someone may have solved a similar problem before.</li>
    <li>Practice writing algorithms for non-coding tasks like making breakfast or organizing your desk.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Trying to solve everything at once:</strong> Decompose first, then tackle each piece.</li>
    <li><strong>Ignoring patterns:</strong> If you see the same logic repeated, abstract it into a reusable solution.</li>
    <li><strong>Over-complicating things:</strong> Abstraction means focusing on what matters — don't get lost in details.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're organizing a class field trip to the zoo. The teacher asks you to plan the entire day, including transportation, lunch, activities, and a schedule.</p>
    <p><strong>Task:</strong> Apply all four pillars of computational thinking to plan this field trip.</p>
    <ol>
        <li><strong>Decomposition:</strong> Break the field trip into at least 4 smaller sub-tasks.</li>
        <li><strong>Pattern Recognition:</strong> Identify what patterns or similarities exist between the sub-tasks (e.g., timing, resources needed).</li>
        <li><strong>Abstraction:</strong> What details can you ignore for now? What's essential to focus on?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Decomposition):</strong> Sub-tasks could include: 1) Book transportation (bus rental, departure time). 2) Plan lunch (budget, dietary restrictions, nearby restaurants). 3) Choose activities (exhibits, shows, feeding times). 4) Create a schedule (arrival, lunch, activities, departure). 5) Prepare permissions and emergency contacts.</p>
        <p><strong>Answer 2 (Pattern Recognition):</strong> Each sub-task has timing constraints (bus must arrive before activities, lunch must be before afternoon). Each requires budgeting. Each involves group coordination. These patterns suggest you need a master timeline and a shared budget tracker.</p>
        <p><strong>Answer 3 (Abstraction):</strong> For now, ignore the specific animals at the zoo, the exact menu for lunch, and the bus company's maintenance records. Focus on: times, costs, group size, and logistics.</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>// Pseudocode for the field trip plan

// Step 1: Define constraints
SET group_size = 30 students + 3 teachers
SET budget = $500
SET available_hours = 9:00 AM to 3:00 PM

// Step 2: Book transportation
RESEARCH bus companies
COMPARE prices
BOOK bus for 8:30 AM pickup

// Step 3: Plan lunch
FIND restaurants near zoo within budget
CHECK dietary options
PRE-ORDER for 33 people

// Step 4: Choose activities
LIST zoo exhibits and show times
PRIORITY: animal feeding at 11:00 AM
PRIORITY: aquarium show at 1:00 PM

// Step 5: Create schedule
8:30  - Depart school
9:15  - Arrive at zoo
9:30  - Begin walking tour
11:00 - Animal feeding show
12:00 - Lunch
1:00  - Aquarium show
2:00  - Free exploration
2:45  - Meet at entrance
3:00  - Depart for school</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
