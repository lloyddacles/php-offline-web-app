<?php $pageTitle = 'Searching Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $sectionDir = 'dsa-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Searching Algorithms</h1>
    <p class="lesson-desc">Master linear search, binary search, and their variants. Learn when to use each and how to implement them.</p>
</div>

<!-- PART 1 -->
<h2>Part 1: Activate Prior Knowledge</h2>
<p>Searching is something you do every day. Before we formalize searching algorithms, think about how you search for things in real life.</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>You're looking for a word in a dictionary. Do you start at page 1 and flip through every page? What strategy do you actually use, and why is it faster?</li>
        <li>If you have an unsorted stack of 100 papers and need to find one with a specific name, what is the fastest approach? How does this change if the papers are already sorted alphabetically?</li>
        <li>From the previous lesson, what is the time complexity of accessing an element in an array by its index? How does this differ from searching for a value?</li>
    </ol>
</div>

<!-- PART 2 -->
<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>searching algorithm</strong> finds the position of a target value within a data structure. <strong>Linear search</strong> checks each element sequentially. <strong>Binary search</strong> repeatedly divides a sorted search space in half.</p>

<h3>Analogy</h3>
<p><strong>Linear search</strong> is like reading every name on a guest list at a party door &mdash; simple but slow for large lists. <strong>Binary search</strong> is like a librarian who opens a book to the middle, sees if the target is before or after that page, and repeats &mdash; dramatically faster, but the book <em>must be sorted</em>.</p>

<h3>How It Works (Step by Step)</h3>
<p><strong>Linear Search O(n):</strong></p>
<ol>
    <li>Start at the first element.</li>
    <li>Compare each element to the target.</li>
    <li>If found, return the index. If you reach the end, return -1 (not found).</li>
</ol>
<p><strong>Binary Search O(log n):</strong></p>
<ol>
    <li>Set pointers to the start and end of the sorted array.</li>
    <li>Find the middle element.</li>
    <li>If it matches, return the index.</li>
    <li>If the middle is less than the target, search the right half.</li>
    <li>If the middle is greater, search the left half.</li>
    <li>Repeat until found or the search space is empty.</li>
</ol>

<h3>PHP Implementation</h3>

<h4>Linear Search</h4>
<pre><code class="language-php">&lt;?php
function linearSearch($arr, $target) {
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] === $target) {
            return $i;  // Found at index i
        }
    }
    return -1;  // Not found
}

$numbers = [10, 23, 45, 70, 11, 15];
echo linearSearch($numbers, 70);  // 3
echo linearSearch($numbers, 99);  // -1</code></pre>

<table>
    <thead>
        <tr><th>Case</th><th>Time Complexity</th><th>When</th></tr>
    </thead>
    <tbody>
        <tr><td>Best</td><td>O(1)</td><td>Target is first element</td></tr>
        <tr><td>Average</td><td>O(n)</td><td>Target somewhere in middle</td></tr>
        <tr><td>Worst</td><td>O(n)</td><td>Target is last or not found</td></tr>
    </tbody>
</table>

<h4>Binary Search</h4>
<pre><code class="language-php">&lt;?php
function binarySearch($arr, $target) {
    $left = 0;
    $right = count($arr) - 1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);

        if ($arr[$mid] === $target) {
            return $mid;        // Found
        } elseif ($arr[$mid] < $target) {
            $left = $mid + 1;   // Search right half
        } else {
            $right = $mid - 1;  // Search left half
        }
    }
    return -1;  // Not found
}

$sorted = [2, 5, 8, 12, 16, 23, 38, 56, 72, 91];
echo binarySearch($sorted, 23);  // 5
echo binarySearch($sorted, 100); // -1</code></pre>

<h3>Visual Walkthrough</h3>
<p>Searching for <strong>23</strong> in <code>[2, 5, 8, 12, 16, 23, 38, 56, 72, 91]</code>:</p>

<pre>
Step 1: left=0, right=9, mid=4 → arr[4]=16 < 23 → search right
Step 2: left=5, right=9, mid=7 → arr[7]=56 > 23 → search left
Step 3: left=5, right=6, mid=5 → arr[5]=23 ✓ FOUND!
</pre>

<table>
    <thead>
        <tr><th>Case</th><th>Time Complexity</th><th>Space</th></tr>
    </thead>
    <tbody>
        <tr><td>Best</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>Average</td><td>O(log n)</td><td>O(1)</td></tr>
        <tr><td>Worst</td><td>O(log n)</td><td>O(1)</td></tr>
    </tbody>
</table>

<h3>Recursive Binary Search</h3>

<pre><code class="language-php">&lt;?php
function binarySearchRecursive($arr, $target, $left, $right) {
    if ($left > $right) return -1;

    $mid = intdiv($left + $right, 2);

    if ($arr[$mid] === $target) return $mid;
    if ($arr[$mid] < $target)
        return binarySearchRecursive($arr, $target, $mid + 1, $right);
    else
        return binarySearchRecursive($arr, $target, $left, $mid - 1);
}

$sorted = [2, 5, 8, 12, 16, 23, 38, 56, 72, 91];
echo binarySearchRecursive($sorted, 23, 0, count($sorted) - 1);  // 5</code></pre>

<h3>Binary Search Variants</h3>

<h4>Find First Occurrence</h4>
<pre><code class="language-php">&lt;?php
function findFirst($arr, $target) {
    $left = 0;
    $right = count($arr) - 1;
    $result = -1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($arr[$mid] === $target) {
            $result = $mid;
            $right = $mid - 1;  // Keep searching left
        } elseif ($arr[$mid] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }
    return $result;
}

$dups = [1, 2, 2, 2, 3, 4, 5];
echo findFirst($dups, 2);  // 1 (first occurrence)</code></pre>

<h4>Find Insertion Position</h4>
<pre><code class="language-php">&lt;?php
function findInsertPos($arr, $target) {
    $left = 0;
    $right = count($arr);

    while ($left < $right) {
        $mid = intdiv($left + $right, 2);
        if ($arr[$mid] < $target) $left = $mid + 1;
        else $right = $mid;
    }
    return $left;
}

$nums = [1, 3, 5, 7];
echo findInsertPos($nums, 4);  // 2 (insert between 3 and 5)
echo findInsertPos($nums, 0);  // 0 (insert at beginning)
echo findInsertPos($nums, 9);  // 4 (insert at end)</code></pre>

<h3>Python Example: Linear and Binary Search</h3>
<pre><code class="language-python"># Linear Search - Check each item one by one
# Time: O(n)
def linear_search(arr, target):
    for i in range(len(arr)):
        if arr[i] == target:
            return i  # Return position where found
    return -1  # Not found

# Binary Search - Divide and conquer (array must be sorted)
# Time: O(log n)
def binary_search(arr, target):
    low = 0
    high = len(arr) - 1

    while low <= high:
        mid = (low + high) // 2
        if arr[mid] == target:
            return mid      # Found it
        elif arr[mid] < target:
            low = mid + 1   # Search right half
        else:
            high = mid - 1  # Search left half
    return -1  # Not found

# Test both searches
scores = [65, 72, 78, 82, 88, 92, 95]
print(linear_search(scores, 82))  # 3 (found at index 3)
print(binary_search(scores, 82))  # 3 (found at index 3)
print(linear_search(scores, 100)) # -1 (not found)
</code></pre>
<strong>Output:</strong>
<pre>3
3
-1</pre>

<h3>Java Example: Linear and Binary Search</h3>
<pre><code class="language-java">public class Main {
    // Linear Search - Check each item one by one
    static int linearSearch(int[] arr, int target) {
        for (int i = 0; i &lt; arr.length; i++) {
            if (arr[i] == target) {
                return i;  // Return position where found
            }
        }
        return -1;  // Not found
    }

    // Binary Search - Divide and conquer (array must be sorted)
    static int binarySearch(int[] arr, int target) {
        int low = 0;
        int high = arr.length - 1;

        while (low &lt;= high) {
            int mid = (low + high) / 2;
            if (arr[mid] == target) {
                return mid;      // Found it
            } else if (arr[mid] &lt; target) {
                low = mid + 1;   // Search right half
            } else {
                high = mid - 1;  // Search left half
            }
        }
        return -1;  // Not found
    }

    public static void main(String[] args) {
        int[] scores = {65, 72, 78, 82, 88, 92, 95};
        System.out.println(linearSearch(scores, 82));  // 3
        System.out.println(binarySearch(scores, 82));  // 3
        System.out.println(linearSearch(scores, 100)); // -1
    }
}
</code></pre>
<strong>Output:</strong>
<pre>3
3
-1</pre>

<!-- PART 3 -->
<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Database Indexing:</strong> Databases use B-tree indexes (a form of search tree) to find records in O(log n) instead of scanning every row.</li>
    <li><strong>Autocomplete:</strong> When you type in a search bar, binary search on a sorted dictionary quickly narrows down matching suggestions.</li>
    <li><strong>Version Control:</strong> Git uses binary search to find when a bug was introduced (git bisect), testing the middle commit each time.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Check if data is sorted first.</strong> If it is, always prefer binary search over linear search.</li>
    <li><strong>Watch for off-by-one errors</strong> in binary search. Pay close attention to whether your loop uses <code>&lt;</code> or <code>&lt;=</code> and how you update <code>left</code> and <code>right</code>.</li>
    <li><strong>Linear search is still useful</strong> for small datasets or when data is unsorted &mdash; sorting first and then using binary search may not always be worth the overhead.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use When...</th><th>Avoid When...</th></tr></thead>
    <tbody>
        <tr><td>Data is sorted and you need fast lookups (binary search)</td><td>Data is unsorted and will only be searched once (linear search is fine)</td></tr>
        <tr><td>Dataset is large and lookups are frequent</td><td>The dataset is tiny &mdash; linear search is fast enough</td></tr>
        <tr><td>You need to find insertion position or first/last occurrence</td><td>You need the actual value, not its position &mdash; use a hash table instead</td></tr>
    </tbody>
</table>

<!-- PART 4 -->
<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A teacher has a sorted array of exam scores: <code>[55, 62, 68, 72, 78, 83, 87, 91, 95, 100]</code>. She needs to find where a specific student's score falls, determine a student's exact score, and insert a new score into the correct position.</p>
    <p><strong>Task:</strong> Given the sorted array of exam scores above, complete the following using both linear search and binary search:</p>
    <ol>
        <li><strong>Find a score:</strong> Use both linear search and binary search to find the score <code>83</code>. How many comparisons does each method make? Show the steps for binary search.</li>
        <li><strong>Find insertion position:</strong> A new score of <code>75</code> needs to be added. Using binary search logic, determine the index where it should be inserted to maintain sorted order. Show your work.</li>
        <li><strong>Find first occurrence:</strong> If the array were <code>[55, 62, 62, 72, 78, 83, 87, 91, 95, 100]</code> (with duplicate 62s), use binary search to find the index of the <em>first</em> occurrence of <code>62</code>. How does this differ from standard binary search?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Find 83):</strong></p>
        <p><em>Linear search:</em> Compares 55, 62, 68, 72, 78, 83 &mdash; <strong>6 comparisons</strong>. Found at index 5.</p>
        <p><em>Binary search steps:</em></p>
        <pre>
Step 1: left=0, right=9, mid=4 → arr[4]=78 < 83 → search right
Step 2: left=5, right=9, mid=7 → arr[7]=91 > 83 → search left
Step 3: left=5, right=6, mid=5 → arr[5]=83 ✓ FOUND!
        </pre>
        <p>Binary search: <strong>3 comparisons</strong>.</p>

        <p><strong>Answer 2 (Insert 75):</strong></p>
<pre><code class="language-php">&lt;?php
function findInsertPos($arr, $target) {
    $left = 0;
    $right = count($arr);
    while ($left < $right) {
        $mid = intdiv($left + $right, 2);
        if ($arr[$mid] < $target) $left = $mid + 1;
        else $right = $mid;
    }
    return $left;
}

$scores = [55, 62, 68, 72, 78, 83, 87, 91, 95, 100];
echo findInsertPos($scores, 75);  // 4</code></pre>
        <p>The score 75 should be inserted at <strong>index 4</strong>, between 72 (index 3) and 78 (index 4). All elements from index 4 onward shift right.</p>

        <p><strong>Answer 3 (First occurrence of 62):</strong></p>
<pre><code class="language-php">&lt;?php
function findFirst($arr, $target) {
    $left = 0;
    $right = count($arr) - 1;
    $result = -1;
    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($arr[$mid] === $target) {
            $result = $mid;
            $right = $mid - 1;  // Keep searching LEFT for earlier occurrence
        } elseif ($arr[$mid] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }
    return $result;
}

$dups = [55, 62, 62, 72, 78, 83, 87, 91, 95, 100];
echo findFirst($dups, 62);  // 1</code></pre>
        <p>Standard binary search might return index 2 (the second 62). The variant finds index <strong>1</strong> (the first 62) by continuing to search left after finding a match.</p>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
