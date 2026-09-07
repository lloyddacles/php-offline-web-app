<?php $pageTitle = 'Recursion'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 6; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Recursion</h1>
    <p class="lesson-desc">Learn how functions call themselves to solve problems by breaking them into smaller subproblems.</p>
</div>

<h2>What Is Recursion?</h2>
<p>A function is <strong>recursive</strong> if it calls itself. Recursion works by breaking a problem into smaller, identical subproblems until reaching a simple <strong>base case</strong>.</p>

<div class="info-box note">
    <div class="box-title">Two Essential Rules</div>
    <p>Every recursive function needs:<br>
    1. <strong>Base case</strong> — stops the recursion (no more self-calls)<br>
    2. <strong>Recursive case</strong> — moves toward the base case</p>
</div>

<h2>The Classic: Factorial</h2>
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

<h2>Fibonacci Numbers</h2>
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
    <p>Naive recursion for Fibonacci is O(2ⁿ) because it recalculates the same values many times. Use memoization or iteration for large inputs.</p>
</div>

<h2>Recursion vs Iteration</h2>

<table>
    <thead><tr><th>Feature</th><th>Recursion</th><th>Iteration</th></tr></thead>
    <tbody>
        <tr><td><strong>Code clarity</strong></td><td>Often cleaner</td><td>Can be more verbose</td></tr>
        <tr><td><strong>Memory</strong></td><td>Uses call stack O(n)</td><td>Constant O(1)</td></tr>
        <tr><td><strong>Speed</strong></td><td>Function call overhead</td><td>Generally faster</td></tr>
        <tr><td><strong>Risk</strong></td><td>Stack overflow</td><td>Infinite loop</td></tr>
    </tbody>
</table>

<h2>Common Recursive Patterns</h2>

<h3>Power / Exponentiation</h3>
<pre><code class="language-php">&lt;?php
function power($base, $exp) {
    if ($exp === 0) return 1;
    if ($exp % 2 === 0) {
        $half = power($base, intdiv($exp, 2));
        return $half * $half;
    }
    return $base * power($base, $exp - 1);
}

echo power(2, 10);  // 1024</code></pre>

<h3>String Reversal</h3>
<pre><code class="language-php">&lt;?php
function reverseString($str) {
    if (strlen($str) <= 1) return $str;
    return reverseString(substr($str, 1)) . $str[0];
}

echo reverseString('hello');  // olleh</code></pre>

<h3>Sum of Digits</h3>
<pre><code class="language-php">&lt;?php
function digitSum($n) {
    $n = abs($n);
    if ($n < 10) return $n;
    return ($n % 10) + digitSum(intdiv($n, 10));
}

echo digitSum(12345);  // 15 (1+2+3+4+5)</code></pre>

<h3>Palindrome Check</h3>
<pre><code class="language-php">&lt;?php
function isPalindrome($str, $left = 0, $right = null) {
    if ($right === null) $right = strlen($str) - 1;
    if ($left >= $right) return true;
    if ($str[$left] !== $str[$right]) return false;
    return isPalindrome($str, $left + 1, $right - 1);
}

echo isPalindrome('racecar');  // true
echo isPalindrome('hello');    // false</code></pre>

<h2>Tower of Hanoi</h2>
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

<h2>When to Use Recursion</h2>
<ul>
    <li><strong>Tree traversal</strong> — natural fit for hierarchical data</li>
    <li><strong>Divide and conquer</strong> — merge sort, quick sort</li>
    <li><strong>Backtracking</strong> — puzzles, mazes, permutations</li>
    <li><strong>Mathematical</strong> — factorial, fibonacci, combinatorics</li>
    <li><strong>Avoid when:</strong> Simple iteration works (factorial, simple loops)</li>
</ul>

<h2>Python Implementation</h2>
<pre><code class="language-python">
# Factorial - O(n)
def factorial(n):
    if n <= 1:
        return 1  # Base case
    return n * factorial(n - 1)  # Recursive case

# Fibonacci - O(2^n) naive, O(n) with memoization
def fibonacci(n):
    if n <= 0:
        return 0  # Base case 1
    if n == 1:
        return 1  # Base case 2
    return fibonacci(n - 1) + fibonacci(n - 2)

# Tower of Hanoi
def tower_of_hanoi(n, source='A', auxiliary='B', destination='C'):
    if n == 1:
        print(f"Move disk 1 from {source} to {destination}")
        return
    tower_of_hanoi(n - 1, source, destination, auxiliary)
    print(f"Move disk {n} from {source} to {destination}")
    tower_of_hanoi(n - 1, auxiliary, source, destination)

# Usage
print(f"Factorial of 5: {factorial(5)}")  # 120
print(f"Fibonacci of 10: {fibonacci(10)}")  # 55
print("Tower of Hanoi with 3 disks:")
tower_of_hanoi(3)
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
public class RecursionExamples {
    // Factorial - O(n)
    public static int factorial(int n) {
        if (n <= 1) return 1;  // Base case
        return n * factorial(n - 1);  // Recursive case
    }

    // Fibonacci - O(2^n) naive
    public static int fibonacci(int n) {
        if (n <= 0) return 0;  // Base case 1
        if (n == 1) return 1;  // Base case 2
        return fibonacci(n - 1) + fibonacci(n - 2);
    }

    // Tower of Hanoi
    public static void towerOfHanoi(int n, char source, char auxiliary, char destination) {
        if (n == 1) {
            System.out.println("Move disk 1 from " + source + " to " + destination);
            return;
        }
        towerOfHanoi(n - 1, source, destination, auxiliary);
        System.out.println("Move disk " + n + " from " + source + " to " + destination);
        towerOfHanoi(n - 1, auxiliary, source, destination);
    }

    public static void main(String[] args) {
        System.out.println("Factorial of 5: " + factorial(5));  // 120
        System.out.println("Fibonacci of 10: " + fibonacci(10));  // 55
        System.out.println("Tower of Hanoi with 3 disks:");
        towerOfHanoi(3, 'A', 'B', 'C');
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
