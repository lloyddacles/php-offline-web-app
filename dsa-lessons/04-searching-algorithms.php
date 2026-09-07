<?php $pageTitle = 'Searching Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 4; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Searching Algorithms</h1>
    <p class="lesson-desc">Master linear search, binary search, and their variants. Learn when to use each and how to implement them.</p>
</div>

<h2>Linear Search</h2>
<p>The simplest search — check every element one by one until you find the target or reach the end.</p>

<pre><code class="language-php">&lt;?php
function linearSearch($arr, $target) {
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] === $target) {
            return $i;  // Found at index i
        }
    }
    return -1;  // Not found
}

// Usage
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

<h2>Binary Search</h2>
<p>Works on <strong>sorted arrays</strong>. Repeatedly divides the search space in half.</p>

<div class="info-box note">
    <div class="box-title">Prerequisite</div>
    <p>The array <strong>must be sorted</strong> before binary search can be applied.</p>
</div>

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

// Usage (array MUST be sorted)
$sorted = [2, 5, 8, 12, 16, 23, 38, 56, 72, 91];
echo binarySearch($sorted, 23);  // 5
echo binarySearch($sorted, 100); // -1</code></pre>

<h2>Visual Walkthrough</h2>
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

<h2>Recursive Binary Search</h2>

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

<h2>Binary Search Variants</h2>

<h3>Find First Occurrence</h3>
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

<h3>Find Insertion Position</h3>
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

<h2>Comparison</h2>

<table>
    <thead>
        <tr><th>Algorithm</th><th>Time</th><th>Requires Sorted?</th><th>Best For</th></tr>
    </thead>
    <tbody>
        <tr><td>Linear Search</td><td>O(n)</td><td>No</td><td>Small or unsorted data</td></tr>
        <tr><td>Binary Search</td><td>O(log n)</td><td>Yes</td><td>Large sorted datasets</td></tr>
        <tr><td>Binary Search (recursive)</td><td>O(log n)</td><td>Yes</td><td>Elegant implementation</td></tr>
    </tbody>
</table>

<h2>Practice: Search Problems</h2>

<pre><code class="language-php">&lt;?php
// Find ceiling (smallest element >= target)
function findCeiling($arr, $target) {
    $left = 0;
    $right = count($arr) - 1;
    $result = -1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($arr[$mid] >= $target) {
            $result = $arr[$mid];
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    return $result;
}

$nums = [2, 5, 8, 12, 16, 23];
echo findCeiling($nums, 9);   // 12
echo findCeiling($nums, 16);  // 16
echo findCeiling($nums, 25);  // -1</code></pre>

<h2>Python Implementation</h2>
<pre><code class="language-python">
# Linear Search - O(n)
def linear_search(arr, target):
    for i in range(len(arr)):
        if arr[i] == target:
            return i  # Found at index i
    return -1  # Not found

# Binary Search - O(log n) - array MUST be sorted
def binary_search(arr, target):
    left, right = 0, len(arr) - 1
    while left <= right:
        mid = (left + right) // 2
        if arr[mid] == target:
            return mid  # Found
        elif arr[mid] < target:
            left = mid + 1  # Search right half
        else:
            right = mid - 1  # Search left half
    return -1  # Not found

# Recursive Binary Search
def binary_search_recursive(arr, target, left, right):
    if left > right:
        return -1
    mid = (left + right) // 2
    if arr[mid] == target:
        return mid
    if arr[mid] < target:
        return binary_search_recursive(arr, target, mid + 1, right)
    else:
        return binary_search_recursive(arr, target, left, mid - 1)

# Usage
numbers = [10, 23, 45, 70, 11, 15]
print(f"Linear search for 70: {linear_search(numbers, 70)}")  # 3
print(f"Linear search for 99: {linear_search(numbers, 99)}")  # -1

sorted_arr = [2, 5, 8, 12, 16, 23, 38, 56, 72, 91]
print(f"Binary search for 23: {binary_search(sorted_arr, 23)}")  # 5
print(f"Binary search for 100: {binary_search(sorted_arr, 100)}")  # -1
print(f"Recursive binary search for 23: {binary_search_recursive(sorted_arr, 23, 0, len(sorted_arr)-1)}")  # 5
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
public class SearchingAlgorithms {
    // Linear Search - O(n)
    public static int linearSearch(int[] arr, int target) {
        for (int i = 0; i < arr.length; i++) {
            if (arr[i] == target) {
                return i;  // Found at index i
            }
        }
        return -1;  // Not found
    }

    // Binary Search - O(log n) - array MUST be sorted
    public static int binarySearch(int[] arr, int target) {
        int left = 0, right = arr.length - 1;
        while (left <= right) {
            int mid = left + (right - left) / 2;
            if (arr[mid] == target) return mid;  // Found
            if (arr[mid] < target) left = mid + 1;  // Search right half
            else right = mid - 1;  // Search left half
        }
        return -1;  // Not found
    }

    // Recursive Binary Search
    public static int binarySearchRecursive(int[] arr, int target, int left, int right) {
        if (left > right) return -1;
        int mid = left + (right - left) / 2;
        if (arr[mid] == target) return mid;
        if (arr[mid] < target)
            return binarySearchRecursive(arr, target, mid + 1, right);
        else
            return binarySearchRecursive(arr, target, left, mid - 1);
    }

    public static void main(String[] args) {
        int[] numbers = {10, 23, 45, 70, 11, 15};
        System.out.println("Linear search for 70: " + linearSearch(numbers, 70));  // 3
        System.out.println("Linear search for 99: " + linearSearch(numbers, 99));  // -1

        int[] sorted = {2, 5, 8, 12, 16, 23, 38, 56, 72, 91};
        System.out.println("Binary search for 23: " + binarySearch(sorted, 23));  // 5
        System.out.println("Binary search for 100: " + binarySearch(sorted, 100));  // -1
        System.out.println("Recursive binary search for 23: " + binarySearchRecursive(sorted, 23, 0, sorted.length - 1));  // 5
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
