<?php $pageTitle = 'Recursion'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Recursion</h1>
    <p class="lesson-desc">Learn how functions call themselves to solve problems by breaking them into smaller subproblems.</p>
</div>

<!-- PART 1 -->
<h2>Part 1: Activate Prior Knowledge</h2>
<p>Recursion is a concept that appears in nature, art, and everyday life. Before we formalize it in code, let's think about where you've already seen it.</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Look at a mirror. What happens when you hold a mirror in front of another mirror? How is this similar to a function that calls itself?</li>
        <li>From the previous lessons, what is a base case? Why would a function need a condition that stops it from doing more work?</li>
        <li>Imagine you need to count the total number of folders inside a folder that contains other folders, which may contain more folders. Describe how you would do this. Is your method recursive? What is your "stopping point"?</li>
    </ol>
</div>

<!-- PART 2 -->
<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A function is <strong>recursive</strong> if it calls itself. Recursion works by breaking a problem into smaller, identical subproblems until reaching a simple <strong>base case</strong> that can be solved directly.</p>

<h3>Analogy</h3>
<p>Imagine you're in a line of people, and you ask the person in front of you: "What position am I in?" They don't know either, so they ask the person in front of them. This continues until the <strong>first person</strong> (the base case) says "I'm position 1." Then the answer propagates back: "You're position 2," "You're position 3," and so on until you get your answer.</p>

<h3>How It Works (Step by Step)</h3>
<p>Every recursive function has two essential parts:</p>
<ol>
    <li><strong>Base case:</strong> The simplest version of the problem that can be answered directly. This stops the recursion.</li>
    <li><strong>Recursive case:</strong> Breaks the problem into a smaller subproblem and calls itself with that smaller input, moving toward the base case.</li>
</ol>
<p>When a function calls itself, the computer uses a <strong>call stack</strong> &mdash; each call is placed on top of the previous one. When the base case is reached, the calls start "unwinding," returning values back up the stack.</p>

<h3>The Classic: Factorial</h3>
<p><strong>Definition:</strong> <code>n! = n &times; (n-1) &times; (n-2) &times; ... &times; 1</code>, with <code>0! = 1</code>.</p>

<pre><code class="language-php">&lt;?php
function factorial($n) {
    if ($n <= 1) return 1;        // Base case
    return $n * factorial($n - 1); // Recursive case
}

echo factorial(5);  // 120 (5 × 4 × 3 × 2 × 1)
echo factorial(10); // 3628800</code></pre>

<h3>Call Stack Visualization</h3>
<pre>
factorial(5)
  → 5 * factorial(4)
    → 4 * factorial(3)
      → 3 * factorial(2)
        → 2 * factorial(1)
          → returns 1     (base case hit!)
        → returns 2 * 1 = 2
      → returns 3 * 2 = 6
    → returns 4 * 6 = 24
  → returns 5 * 24 = 120
</pre>

<h3>Fibonacci Numbers</h3>
<pre><code class="language-php">&lt;?php
function fibonacci($n) {
    if ($n <= 0) return 0;  // Base case 1
    if ($n === 1) return 1; // Base case 2
    return fibonacci($n - 1) + fibonacci($n - 2);
}

// F(0)=0, F(1)=1, F(2)=1, F(3)=2, F(4)=3, F(5)=5
echo fibonacci(5);   // 5
echo fibonacci(10);  // 55</code></pre>

<div class="info-box warning">
    <div class="box-title">Warning: Exponential Time</div>
    <p>Naive recursion for Fibonacci is O(2&sup;n;) because it recalculates the same values many times. Use <strong>memoization</strong> (caching results) or iteration for large inputs.</p>
</div>

<h3>Tower of Hanoi</h3>
<pre><code class="language-php">&lt;?php
function towerOfHanoi($n, $source, $aux, $dest, &$moves = []) {
    if ($n === 1) {
        $moves[] = "Move disk 1 from $source to $dest";
        return $moves;
    }
    towerOfHanoi($n - 1, $source, $dest, $aux, $moves);
    $moves[] = "Move disk $n from $source to $dest";
    towerOfHanoi($n - 1, $aux, $source, $dest, $moves);
    return $moves;
}

$result = towerOfHanoi(3, 'A', 'B', 'C');
foreach ($result as $move) echo $move . "\n";
// 7 moves for 3 disks</code></pre>

<h3>Recursion vs Iteration</h3>
<table>
    <thead><tr><th>Feature</th><th>Recursion</th><th>Iteration</th></tr></thead>
    <tbody>
        <tr><td><strong>Code clarity</strong></td><td>Often cleaner</td><td>Can be more verbose</td></tr>
        <tr><td><strong>Memory</strong></td><td>Uses call stack O(n)</td><td>Constant O(1)</td></tr>
        <tr><td><strong>Speed</strong></td><td>Function call overhead</td><td>Generally faster</td></tr>
        <tr><td><strong>Risk</strong></td><td>Stack overflow</td><td>Infinite loop</td></tr>
    </tbody>
</table>

<h3>Python Example: Factorial and Fibonacci</h3>
<pre><code class="language-python"># Factorial: n! = n × (n-1) × (n-2) × ... × 1
# Example: 5! = 5 × 4 × 3 × 2 × 1 = 120
def factorial(n):
    if n <= 1:          # Base case: stop when n is 1 or less
        return 1
    return n * factorial(n - 1)  # Recursive case: multiply and call again

print(factorial(5))   # 120
print(factorial(3))   # 6

# Fibonacci: 0, 1, 1, 2, 3, 5, 8, 13, ...
# Each number is the sum of the two before it
def fibonacci(n):
    if n <= 0:          # Base case
        return 0
    if n == 1:          # Base case
        return 1
    return fibonacci(n - 1) + fibonacci(n - 2)  # Sum of two previous

print(fibonacci(6))   # 8
print(fibonacci(8))   # 21
</code></pre>
<strong>Output:</strong>
<pre>120
6
8
21</pre>

<h3>Java Example: Factorial and Fibonacci</h3>
<pre><code class="language-java">public class Main {
    // Factorial: n! = n × (n-1) × (n-2) × ... × 1
    static int factorial(int n) {
        if (n <= 1) {          // Base case: stop when n is 1 or less
            return 1;
        }
        return n * factorial(n - 1);  // Recursive case
    }

    // Fibonacci: 0, 1, 1, 2, 3, 5, 8, 13, ...
    static int fibonacci(int n) {
        if (n <= 0) return 0;   // Base case
        if (n == 1) return 1;   // Base case
        return fibonacci(n - 1) + fibonacci(n - 2);  // Sum of two previous
    }

    public static void main(String[] args) {
        System.out.println(factorial(5));  // 120
        System.out.println(factorial(3));  // 6
        System.out.println(fibonacci(6));  // 8
        System.out.println(fibonacci(8));  // 21
    }
}
</code></pre>
<strong>Output:</strong>
<pre>120
6
8
21</pre>

<!-- PART 3 -->
<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Tree Traversal:</strong> File systems are trees. Navigating folders recursively (list all files in this folder, and all subfolders) is a natural recursive operation.</li>
    <li><strong>Divide and Conquer Algorithms:</strong> Merge sort and quick sort both use recursion to break problems in half.</li>
    <li><strong>Puzzles and Games:</strong> Solving mazes, Sudoku, or chess moves often uses backtracking &mdash; a recursive technique that tries a path, undoes it if it fails, and tries another.</li>
    <li><strong>Mathematical Computations:</strong> Factorial, Fibonacci, combinations, permutations, and fractals are all naturally recursive.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Always define the base case first.</strong> Without it, the function calls itself infinitely and crashes.</li>
    <li><strong>Ensure each recursive call moves toward the base case.</strong> If the problem doesn't get smaller, you'll never stop.</li>
    <li><strong>Use iteration when possible.</strong> If a simple loop solves the problem, iteration is faster and uses less memory.</li>
    <li><strong>Use memoization</strong> when the same subproblems are solved multiple times (like Fibonacci).</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use When...</th><th>Avoid When...</th></tr></thead>
    <tbody>
        <tr><td>The problem is naturally recursive (trees, graphs, divide and conquer)</td><td>A simple loop solves the problem equally well</td></tr>
        <tr><td>You need to explore multiple paths (backtracking, puzzles)</td><td>The recursion depth could be very large (risk of stack overflow)</td></tr>
        <tr><td>Code clarity and elegance matter more than raw speed</td><td>Performance is critical and every millisecond counts</td></tr>
    </tbody>
</table>

<!-- PART 4 -->
<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A logistics company needs to calculate the total cost of a delivery route. The route is stored as a linked structure: each delivery stop has a cost, and points to the next stop. The last stop points to nothing (null). The costs are: Stop 1 = &pound;10, Stop 2 = &pound;20, Stop 3 = &pound;15, Stop 4 = &pound;25.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li><strong>Trace:</strong> Write a recursive function that sums all delivery costs. Trace through each recursive call, showing the call stack building up and unwinding. What is the base case?</li>
        <li><strong>Implement:</strong> Write the complete PHP (or Python/Java) function for calculating the total cost. Include the base case and recursive case.</li>
        <li><strong>Analyze:</strong> What is the time complexity and space complexity of your recursive function? If the route had 10,000 stops, what problem might occur, and how could you fix it?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Trace):</strong></p>
<pre>
totalCost(stop4)
  → 25 + totalCost(stop3)
    → 15 + totalCost(stop2)
      → 20 + totalCost(stop1)
        → 10 + totalCost(null)
          → returns 0        (base case: stop is null)
        → returns 10 + 0 = 10
      → returns 20 + 10 = 30
    → returns 15 + 30 = 45
  → returns 25 + 45 = 70
</pre>
        <p><strong>Base case:</strong> When the stop is <code>null</code>, return 0.</p>

        <p><strong>Answer 2 (Implementation):</strong></p>
<pre><code class="language-php">&lt;?php
class DeliveryStop {
    public $cost;
    public $next;
    public function __construct($cost, $next = null) {
        $this->cost = $cost;
        $this->next = $next;
    }
}

function totalCost($stop) {
    if ($stop === null) return 0;  // Base case
    return $stop->cost + totalCost($stop->next);  // Recursive case
}

// Build the route: stop1 → stop2 → stop3 → stop4
$stop4 = new DeliveryStop(25);
$stop3 = new DeliveryStop(15, $stop4);
$stop2 = new DeliveryStop(20, $stop3);
$stop1 = new DeliveryStop(10, $stop2);

echo "Total cost: " . totalCost($stop1);  // 70</code></pre>
        <p><strong>Expected Output:</strong> <code>Total cost: 70</code></p>

        <p><strong>Answer 3 (Analysis):</strong></p>
        <ul>
            <li><strong>Time complexity:</strong> O(n) &mdash; each stop is visited exactly once.</li>
            <li><strong>Space complexity:</strong> O(n) &mdash; each recursive call adds a frame to the call stack.</li>
            <li><strong>Problem at 10,000 stops:</strong> The call stack would have 10,000 frames, which could cause a <strong>stack overflow</strong> error.</li>
            <li><strong>Fix:</strong> Rewrite iteratively with a while loop, which uses O(1) space:</li>
        </ul>
<pre><code class="language-php">&lt;?php
function totalCostIterative($stop) {
    $total = 0;
    while ($stop !== null) {
        $total += $stop->cost;
        $stop = $stop->next;
    }
    return $total;
}

echo "Total cost (iterative): " . totalCostIterative($stop1);  // 70</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
