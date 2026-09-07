<?php $pageTitle = 'Algorithm Design Strategies and Performance Optimization'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 14; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Algorithm Design Strategies and Performance Optimization</h1>
    <p class="lesson-desc">Master divide and conquer, dynamic programming, greedy algorithms, backtracking, and techniques to optimize algorithm performance.</p>
</div>

<h2>Divide and Conquer</h2>
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

<h2>Dynamic Programming</h2>
<p>Solve problems by breaking them into overlapping subproblems. Store results to avoid recalculating.</p>

<div class="info-box note">
    <div class="box-title">Two Key Properties</div>
    <p><strong>Optimal Substructure:</strong> Optimal solution contains optimal solutions to subproblems<br>
    <strong>Overlapping Subproblems:</strong> Same subproblems are solved multiple times</p>
</div>

<h3>Memoization (Top-Down)</h3>
<pre><code class="language-php">&lt;?php
function fibMemo($n, &$memo = []) {
    if ($n <= 1) return $n;
    if (isset($memo[$n])) return $memo[$n];
    $memo[$n] = fibMemo($n - 1, $memo) + fibMemo($n - 2, $memo);
    return $memo[$n];
}

echo fibMemo(50);  // 12586269025 (instant!)</code></pre>

<h3>Tabulation (Bottom-Up)</h3>
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

<h2>Greedy Algorithms</h2>
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

<h2>Backtracking</h2>
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

<h2>Strategy Comparison</h2>

<table>
    <thead><tr><th>Strategy</th><th>Approach</th><th>Example</th><th>When to Use</th></tr></thead>
    <tbody>
        <tr><td>Divide & Conquer</td><td>Split → Solve → Combine</td><td>Merge Sort</td><td>Problem can be split evenly</td></tr>
        <tr><td>Dynamic Programming</td><td>Store subproblem results</td><td>Knapsack</td><td>Overlapping subproblems</td></tr>
        <tr><td>Greedy</td><td>Best local choice</td><td>Activity Selection</td><td>Greedy choice property holds</td></tr>
        <tr><td>Backtracking</td><td>Try, undo, try next</td><td>N-Queens</td><td>Need all solutions or constraints</td></tr>
    </tbody>
</table>

<h2>Performance Optimization Tips</h2>
<ul>
    <li><strong>Profile first</strong> — Don't optimize without measuring</li>
    <li><strong>Choose the right data structure</strong> — Hash map vs array vs tree</li>
    <li><strong>Reduce time complexity</strong> — O(n²) → O(n log n) by sorting first</li>
    <li><strong>Space-time tradeoff</strong> — Cache results to save computation</li>
    <li><strong>Early termination</strong> — Exit loops early when possible</li>
    <li><strong>Avoid unnecessary work</strong> — Skip redundant calculations</li>
</ul>

<h2>Python Implementation</h2>
<pre><code class="language-python"># Memoization (Top-Down) Fibonacci
def fib_memo(n, memo={}):
    if n <= 1:
        return n
    if n in memo:
        return memo[n]
    memo[n] = fib_memo(n - 1, memo) + fib_memo(n - 2, memo)
    return memo[n]

print(fib_memo(50))  # 12586269025

# Knapsack Problem (0/1)
def knapsack(weights, values, capacity):
    n = len(weights)
    dp = [[0] * (capacity + 1) for _ in range(n + 1)]

    for i in range(1, n + 1):
        for w in range(capacity + 1):
            dp[i][w] = dp[i - 1][w]  # Don't take item
            if weights[i - 1] <= w:
                take = dp[i - 1][w - weights[i - 1]] + values[i - 1]
                dp[i][w] = max(dp[i][w], take)
    return dp[n][capacity]

weights = [2, 3, 4, 5]
values = [3, 4, 5, 6]
print(knapsack(weights, values, 8))  # 10

# Activity Selection (Greedy)
def activity_selection(activities):
    activities.sort(key=lambda x: x[1])  # Sort by finish time
    selected = [activities[0]]
    last_end = activities[0][1]

    for i in range(1, len(activities)):
        if activities[i][0] >= last_end:
            selected.append(activities[i])
            last_end = activities[i][1]
    return selected

activities = [
    (1, 4), (3, 5), (0, 6), (5, 7),
    (3, 9), (5, 9), (6, 10), (8, 11),
]
print(len(activity_selection(activities)))  # 4

# N-Queens (Backtracking)
def solve_n_queens(n):
    solutions = []
    board = [-1] * n

    def is_safe(board, row, col):
        for i in range(row):
            if board[i] == col or abs(board[i] - col) == abs(i - row):
                return False
        return True

    def solve(board, row):
        if row == n:
            solutions.append(board[:])
            return
        for col in range(n):
            if is_safe(board, row, col):
                board[row] = col
                solve(board, row + 1)
                board[row] = -1  # Backtrack

    solve(board, 0)
    return len(solutions)

print(solve_n_queens(8))  # 92</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">import java.util.*;

public class AlgorithmStrategies {

    // Memoization (Top-Down) Fibonacci
    static long fibMemo(int n, Map&lt;Integer, Long&gt; memo) {
        if (n &lt;= 1) return n;
        if (memo.containsKey(n)) return memo.get(n);
        memo.put(n, fibMemo(n - 1, memo) + fibMemo(n - 2, memo));
        return memo.get(n);
    }

    // Knapsack Problem (0/1)
    static int knapsack(int[] weights, int[] values, int capacity) {
        int n = weights.length;
        int[][] dp = new int[n + 1][capacity + 1];

        for (int i = 1; i &lt;= n; i++) {
            for (int w = 0; w &lt;= capacity; w++) {
                dp[i][w] = dp[i - 1][w];
                if (weights[i - 1] &lt;= w) {
                    int take = dp[i - 1][w - weights[i - 1]] + values[i - 1];
                    dp[i][w] = Math.max(dp[i][w], take);
                }
            }
        }
        return dp[n][capacity];
    }

    // Activity Selection (Greedy)
    static List&lt;int[]&gt; activitySelection(int[][] activities) {
        Arrays.sort(activities, Comparator.comparingInt(a -&gt; a[1]));
        List&lt;int[]&gt; selected = new ArrayList&lt;&gt;();
        selected.add(activities[0]);
        int lastEnd = activities[0][1];

        for (int i = 1; i &lt; activities.length; i++) {
            if (activities[i][0] &gt;= lastEnd) {
                selected.add(activities[i]);
                lastEnd = activities[i][1];
            }
        }
        return selected;
    }

    // N-Queens (Backtracking)
    static int solveNQueens(int n) {
        List&lt;List&lt;Integer&gt;&gt; solutions = new ArrayList&lt;&gt;();
        int[] board = new int[n];
        Arrays.fill(board, -1);

        class Backtrack {
            boolean isSafe(int[] board, int row, int col) {
                for (int i = 0; i &lt; row; i++) {
                    if (board[i] == col || Math.abs(board[i] - col) == Math.abs(i - row))
                        return false;
                }
                return true;
            }

            void solve(int[] board, int row, int n) {
                if (row == n) {
                    solutions.add(Arrays.stream(board).boxed().toList());
                    return;
                }
                for (int col = 0; col &lt; n; col++) {
                    if (isSafe(board, row, col)) {
                        board[row] = col;
                        solve(board, row + 1, n);
                        board[row] = -1;
                    }
                }
            }
        }

        new Backtrack().solve(board, 0, n);
        return solutions.size();
    }

    public static void main(String[] args) {
        System.out.println(fibMemo(50, new HashMap&lt;&gt;()));  // 12586269025
        System.out.println(knapsack(new int[]{2,3,4,5}, new int[]{3,4,5,6}, 8));  // 10
        System.out.println(solveNQueens(8));  // 92
    }
}</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
