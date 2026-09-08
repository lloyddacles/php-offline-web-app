<?php $pageTitle = 'Algorithm Design Strategies and Performance Optimization'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 14; $sectionDir = 'dsa-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Algorithm Design Strategies and Performance Optimization</h1>
    <p class="lesson-desc">Master divide and conquer, dynamic programming, greedy algorithms, backtracking, and techniques to optimize algorithm performance.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before learning formal design strategies, think about the problem-solving approaches you already use. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>When you solve a large problem, how do you break it into smaller, manageable pieces?</li>
        <li>What is the difference between sorting an array with merge sort vs bubble sort? Why is one faster?</li>
        <li>Can you think of a situation where making the "best looking choice right now" actually leads to the best overall result?</li>
        <li>What does O(n) vs O(n²) mean in terms of how your code scales with larger inputs?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Algorithm design strategies are systematic approaches to solving problems. The four major strategies are: <strong>Divide & Conquer</strong>, <strong>Dynamic Programming</strong>, <strong>Greedy Algorithms</strong>, and <strong>Backtracking</strong>.</p>

<h3>Analogy</h3>
<p>Think of cooking a large meal. You can <strong>divide and conquer</strong> by having different people prep different dishes simultaneously. You can use <strong>dynamic programming</strong> by pre-chopping all vegetables once instead of re-chopping for each recipe. You can use a <strong>greedy</strong> approach by always cooking the dish that needs the oven next. Or you can use <strong>backtracking</strong> by trying a recipe, tasting it, and adjusting if it doesn't work.</p>

<h3>How It Works (Step by Step)</h3>

<h4>1. Divide and Conquer</h4>
<p>Break the problem into smaller subproblems, solve each recursively, then combine results.</p>
<pre><code class="language-php">&lt;?php
// Merge Sort — classic divide and conquer
function mergeSort($arr) {
    if (count($arr) <= 1) return $arr;
    $mid = intdiv(count($arr), 2);
    $left = mergeSort(array_slice($arr, 0, $mid));
    $right = mergeSort(array_slice($arr, $mid));
    return merge($left, $right);
}

function merge($l, $r) {
    $result = [];
    $i = $j = 0;
    while ($i < count($l) && $j < count($r)) {
        $result[] = $l[$i] <= $r[$j] ? $l[$i++] : $r[$j++];
    }
    return array_merge($result, array_slice($l, $i), array_slice($r, $j));
}

// Closest Pair of Points (conceptual)
// 1. Divide points into left/right halves
// 2. Recursively find closest in each half
// 3. Check strip near dividing line</code></pre>

<h4>2. Dynamic Programming</h4>
<p>Solve problems by breaking them into overlapping subproblems. Store results to avoid recalculating.</p>
<div class="info-box note">
    <div class="box-title">Two Key Properties</div>
    <p><strong>Optimal Substructure:</strong> Optimal solution contains optimal solutions to subproblems<br>
    <strong>Overlapping Subproblems:</strong> Same subproblems are solved multiple times</p>
</div>

<h5>Memoization (Top-Down)</h5>
<pre><code class="language-php">&lt;?php
function fibMemo($n, &$memo = []) {
    if ($n <= 1) return $n;
    if (isset($memo[$n])) return $memo[$n];
    $memo[$n] = fibMemo($n - 1, $memo) + fibMemo($n - 2, $memo);
    return $memo[$n];
}

echo fibMemo(50);  // 12586269025 (instant!)</code></pre>

<h5>Tabulation (Bottom-Up)</h5>
<pre><code class="language-php">&lt;?php
function fibTab($n) {
    if ($n <= 1) return $n;
    $dp = [0, 1];
    for ($i = 2; $i <= $n; $i++) {
        $dp[$i] = $dp[$i - 1] + $dp[$i - 2];
    }
    return $dp[$n];
}

// Knapsack Problem (0/1)
function knapsack($weights, $values, $capacity) {
    $n = count($weights);
    $dp = array_fill(0, $n + 1, array_fill(0, $capacity + 1, 0));

    for ($i = 1; $i <= $n; $i++) {
        for ($w = 0; $w <= $capacity; $w++) {
            $dp[$i][$w] = $dp[$i - 1][$w];  // Don't take item
            if ($weights[$i - 1] <= $w) {
                $take = $dp[$i - 1][$w - $weights[$i - 1]] + $values[$i - 1];
                $dp[$i][$w] = max($dp[$i][$w], $take);
            }
        }
    }
    return $dp[$n][$capacity];
}

$weights = [2, 3, 4, 5];
$values  = [3, 4, 5, 6];
echo knapsack($weights, $values, 8);  // 10</code></pre>

<h4>3. Greedy Algorithms</h4>
<p>Make the locally optimal choice at each step, hoping to find the global optimum.</p>
<pre><code class="language-php">&lt;?php
// Activity Selection Problem
function activitySelection($activities) {
    // Sort by finish time
    usort($activities, fn($a, $b) => $a['end'] <=> $b['end']);
    $selected = [$activities[0]];
    $lastEnd = $activities[0]['end'];

    for ($i = 1; $i < count($activities); $i++) {
        if ($activities[$i]['start'] >= $lastEnd) {
            $selected[] = $activities[$i];
            $lastEnd = $activities[$i]['end'];
        }
    }
    return $selected;
}

$activities = [
    ['start' => 1, 'end' => 4], ['start' => 3, 'end' => 5],
    ['start' => 0, 'end' => 6], ['start' => 5, 'end' => 7],
    ['start' => 3, 'end' => 9], ['start' => 5, 'end' => 9],
    ['start' => 6, 'end' => 10], ['start' => 8, 'end' => 11],
];
=count(activitySelection($activities));  // 4 activities selected</code></pre>

<h4>4. Backtracking</h4>
<p>Try a choice, recurse, and undo (backtrack) if it doesn't lead to a solution.</p>
<pre><code class="language-php">&lt;?php
// N-Queens Problem
function solveNQueens($n) {
    $solutions = [];
    $board = array_fill(0, $n, -1);

    function isSafe($board, $row, $col) {
        for ($i = 0; $i < $row; $i++) {
            if ($board[$i] === $col) return false;
            if (abs($board[$i] - $col) === abs($i - $row)) return false;
        }
        return true;
    }

    function solve(&$board, $row, $n, &$solutions) {
        if ($row === $n) {
            $solutions[] = $board;
            return;
        }
        for ($col = 0; $col < $n; $col++) {
            if (isSafe($board, $row, $col)) {
                $board[$row] = $col;
                solve($board, $row + 1, $n, $solutions);
                $board[$row] = -1;  // Backtrack
            }
        }
    }

    solve($board, 0, $n, $solutions);
    return count($solutions);
}

echo solveNQueens(8);  // 92 solutions for 8-queens</code></pre>

<h3>Strategy Comparison</h3>
<table>
    <thead><tr><th>Strategy</th><th>Approach</th><th>Example</th><th>When to Use</th></tr></thead>
    <tbody>
        <tr><td>Divide & Conquer</td><td>Split → Solve → Combine</td><td>Merge Sort</td><td>Problem can be split evenly</td></tr>
        <tr><td>Dynamic Programming</td><td>Store subproblem results</td><td>Knapsack</td><td>Overlapping subproblems</td></tr>
        <tr><td>Greedy</td><td>Best local choice</td><td>Activity Selection</td><td>Greedy choice property holds</td></tr>
        <tr><td>Backtracking</td><td>Try, undo, try next</td><td>N-Queens</td><td>Need all solutions or constraints</td></tr>
    </tbody>
</table>

<h3>Performance Optimization Tips</h3>
<ul>
    <li><strong>Profile first</strong> — Don't optimize without measuring</li>
    <li><strong>Choose the right data structure</strong> — Hash map vs array vs tree</li>
    <li><strong>Reduce time complexity</strong> — O(n²) → O(n log n) by sorting first</li>
    <li><strong>Space-time tradeoff</strong> — Cache results to save computation</li>
    <li><strong>Early termination</strong> — Exit loops early when possible</li>
    <li><strong>Avoid unnecessary work</strong> — Skip redundant calculations</li>
</ul>

<h3>Python Example: Dynamic Programming (Fibonacci)</h3>
<p>DP is like memorizing answers — save time by not recalculating.</p>
<pre><code class="language-python"># WITHOUT DP: Slow - recalculates same values
# Time: O(2^n)
def fib_slow(n):
    if n <= 1:
        return n
    return fib_slow(n - 1) + fib_slow(n - 2)

# WITH DP: Fast - stores and reuses answers
# Time: O(n)
def fib_fast(n, memo={}):
    if n in memo:
        return memo[n]          # Return saved answer
    if n <= 1:
        return n
    memo[n] = fib_fast(n - 1, memo) + fib_fast(n - 2, memo)
    return memo[n]

print(fib_slow(10))  # 55 (slow)
print(fib_fast(10))  # 55 (fast!)
print(fib_fast(30))  # 832040 (instant)
</code></pre>
<strong>Output:</strong>
<pre>55
55
832040</pre>

<h3>Java Example: Dynamic Programming (Fibonacci)</h3>
<p>DP is like memorizing answers — save time by not recalculating.</p>
<pre><code class="language-java">public class Main {
    // WITHOUT DP: Slow
    static int fibSlow(int n) {
        if (n <= 1) return n;
        return fibSlow(n - 1) + fibSlow(n - 2);
    }

    // WITH DP: Fast - stores answers in array
    static int[] memo = new int[100];
    static int fibFast(int n) {
        if (n <= 1) return n;
        if (memo[n] != 0) return memo[n];  // Return saved answer
        memo[n] = fibFast(n - 1) + fibFast(n - 2);
        return memo[n];
    }

    public static void main(String[] args) {
        System.out.println(fibSlow(10));  // 55 (slow)
        System.out.println(fibFast(10));  // 55 (fast!)
        System.out.println(fibFast(30));  // 832040 (instant)
    }
}
</code></pre>
<strong>Output:</strong>
<pre>55
55
832040</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Divide & Conquer:</strong> Parallel processing, database sharding, map-reduce computations</li>
    <li><strong>Dynamic Programming:</strong> Text diff algorithms, stock trading optimization, bioinformatics sequence alignment</li>
    <li><strong>Greedy Algorithms:</strong> Huffman coding (data compression), minimum spanning tree (Prim's/Kruskal's), Dijkstra's shortest path</li>
    <li><strong>Backtracking:</strong> Puzzle solvers, constraint satisfaction, compiler syntax parsing</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Identify overlapping subproblems first</strong> — if subproblems repeat, use DP</li>
    <li><strong>Test greedy on small cases</strong> — greedy can fail if the greedy choice property doesn't hold</li>
    <li><strong>Draw the recursion tree</strong> — helps visualize divide & conquer and backtracking</li>
    <li><strong>Start with brute force</strong> — then optimize with the right strategy</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Problem Pattern</th><th>Best Strategy</th><th>Key Indicator</th></tr></thead>
    <tbody>
        <tr><td>Sort or search efficiently</td><td>Divide & Conquer</td><td>Can split problem in half evenly</td></tr>
        <tr><td>Optimize with constraints</td><td>Dynamic Programming</td><td>Overlapping subproblems + optimal substructure</td></tr>
        <tr><td>Make a sequence of choices</td><td>Greedy</td><td>Local optimal leads to global optimal</td></tr>
        <tr><td>Find all valid configurations</td><td>Backtracking</td><td>Need to explore and undo choices</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are a store owner who needs to make change for a customer using the fewest coins possible. You have coins of denominations: 1, 5, 10, and 25 cents. The customer needs 41 cents in change.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Solve the coin change problem using a <strong>greedy approach</strong>. Show each step: which coin you pick and why. How many coins total?</li>
        <li>Now solve the same problem using <strong>dynamic programming</strong>. Build the DP table showing the minimum coins needed for each amount from 0 to 41 cents.</li>
        <li>Change the denominations to: 1, 3, 4 cents. Find the minimum coins for 6 cents using both approaches. Which approach gives the correct answer?</li>
        <li>Write PHP code that solves the general coin change problem using dynamic programming.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1: Greedy for 41 cents (denominations: 1, 5, 10, 25)</strong></p>
        <ol>
            <li>Largest coin ≤ 41: <strong>25</strong>. Remaining: 16. Coins: 1</li>
            <li>Largest coin ≤ 16: <strong>10</strong>. Remaining: 6. Coins: 2</li>
            <li>Largest coin ≤ 6: <strong>5</strong>. Remaining: 1. Coins: 3</li>
            <li>Largest coin ≤ 1: <strong>1</strong>. Remaining: 0. Coins: 4</li>
        </ol>
        <p><strong>Greedy result: 4 coins</strong> (25 + 10 + 5 + 1)</p>

        <p><strong>Answer 2: DP for 41 cents</strong></p>
        <pre><code>dp[0] = 0
dp[1] = 1  (1)
dp[2] = 2  (1+1)
dp[3] = 3  (1+1+1)
dp[4] = 4  (1+1+1+1)
dp[5] = 1  (5)
...
dp[10] = 1 (10)
...
dp[25] = 1 (25)
...
dp[41] = dp[16]+1 = dp[6]+1+1 = dp[1]+1+1+1 = 1+1+1+1 = 4</code></pre>
        <p><strong>DP result: 4 coins</strong> — same as greedy for these denominations.</p>

        <p><strong>Answer 3: 6 cents with denominations 1, 3, 4</strong></p>
        <p><strong>Greedy:</strong> Pick 4, then 1, then 1 = <strong>3 coins</strong> (4+1+1)</p>
        <p><strong>DP:</strong> dp[6] = min(dp[5]+1, dp[3]+1, dp[2]+1) = min(3, 2, 3) = <strong>2 coins</strong> (3+3)</p>
        <p><strong>Greedy fails here!</strong> The optimal is 3+3=6 using 2 coins. Greedy's choice of 4 first leads to a suboptimal result.</p>

        <p><strong>Answer 4: PHP DP Code</strong></p>
        <pre><code>&lt;?php
function coinChange($coins, $amount) {
    $dp = array_fill(0, $amount + 1, INF);
    $dp[0] = 0;
    $parent = array_fill(0, $amount + 1, -1);

    for ($i = 1; $i <= $amount; $i++) {
        foreach ($coins as $coin) {
            if ($coin <= $i && $dp[$i - $coin] + 1 < $dp[$i]) {
                $dp[$i] = $dp[$i - $coin] + 1;
                $parent[$i] = $coin;
            }
        }
    }

    if ($dp[$amount] === INF) return -1;

    // Trace back which coins were used
    $used = [];
    $rem = $amount;
    while ($rem > 0) {
        $used[] = $parent[$rem];
        $rem -= $parent[$rem];
    }

    return ['count' => $dp[$amount], 'coins' => $used];
}

print_r(coinChange([1, 5, 10, 25], 41));
// count => 4, coins => [1, 5, 10, 25]

print_r(coinChange([1, 3, 4], 6));
// count => 2, coins => [3, 3]</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
