<?php $pageTitle = 'Sorting Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Sorting Algorithms</h1>
    <p class="lesson-desc">Learn the fundamental sorting algorithms &mdash; from simple bubble sort to efficient merge sort and quicksort.</p>
</div>

<!-- PART 1 -->
<h2>Part 1: Activate Prior Knowledge</h2>
<p>Sorting is something you've done your whole life. Before we dive into sorting algorithms, let's think about the strategies you already use.</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Imagine you have a stack of 20 exam papers and you need to arrange them by student name. Describe two different methods you could use. Which one requires fewer movements of papers?</li>
        <li>From the previous lessons, what does O(n&sup2;) mean? Can you think of a sorting method that compares every pair of items? What makes it slow?</li>
        <li>If you have two sorted piles of papers and need to merge them into one sorted pile, describe your strategy. What is the time complexity of merging?</li>
    </ol>
</div>

<!-- PART 2 -->
<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>sorting algorithm</strong> arranges elements in a specific order (ascending or descending). Sorting is one of the most fundamental operations in computer science &mdash; it enables faster searching, simplifies data processing, and is a building block for many other algorithms.</p>

<h3>Analogy</h3>
<p>Think of sorting students by height for a class photo. <strong>Bubble sort</strong> is like comparing two adjacent students and swapping them if they're out of order, repeating until no swaps are needed. <strong>Selection sort</strong> is finding the shortest student and putting them first, then finding the next shortest. <strong>Merge sort</strong> is splitting the group in half, sorting each half separately, then merging them back together &mdash; divide and conquer.</p>

<h3>How It Works (Step by Step)</h3>

<h4>Bubble Sort &mdash; O(n&sup2;)</h4>
<ol>
    <li>Compare adjacent elements. If the left is larger, swap them.</li>
    <li>After one full pass, the largest element "bubbles" to the end.</li>
    <li>Repeat for the remaining unsorted portion.</li>
    <li>Stop early if no swaps occur (already sorted).</li>
</ol>

<h4>Selection Sort &mdash; O(n&sup2;)</h4>
<ol>
    <li>Find the minimum element in the unsorted portion.</li>
    <li>Swap it with the first unsorted element.</li>
    <li>Move the boundary of the sorted portion one element right.</li>
    <li>Repeat until fully sorted.</li>
</ol>

<h4>Insertion Sort &mdash; O(n&sup2;)</h4>
<ol>
    <li>Take the next unsorted element.</li>
    <li>Compare it with elements in the sorted portion from right to left.</li>
    <li>Shift larger elements right to make room.</li>
    <li>Insert the element in its correct position.</li>
</ol>

<h4>Merge Sort &mdash; O(n log n)</h4>
<ol>
    <li>Split the array in half recursively until each sub-array has one element.</li>
    <li>Merge pairs of sub-arrays back together in sorted order.</li>
    <li>Continue merging until the full array is sorted.</li>
</ol>

<h4>Quick Sort &mdash; O(n log n) average</h4>
<ol>
    <li>Pick a pivot element.</li>
    <li>Partition: move all smaller elements left of pivot, larger elements right.</li>
    <li>Recursively sort the left and right partitions.</li>
</ol>

<h3>PHP Implementation</h3>

<h4>Bubble Sort</h4>
<pre><code class="language-php">&lt;?php
function bubbleSort(&$arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        $swapped = false;
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                [$arr[$j], $arr[$j + 1]] = [$arr[$j + 1], $arr[$j]];
                $swapped = true;
            }
        }
        if (!$swapped) break;  // Optimized: already sorted
    }
}

$arr = [64, 34, 25, 12, 22, 11, 90];
bubbleSort($arr);
print_r($arr);  // [11, 12, 22, 25, 34, 64, 90]</code></pre>

<table>
    <thead><tr><th>Case</th><th>Time</th><th>Space</th></tr></thead>
    <tbody>
        <tr><td>Best (sorted)</td><td>O(n)</td><td>O(1)</td></tr>
        <tr><td>Average</td><td>O(n&sup2;)</td><td>O(1)</td></tr>
        <tr><td>Worst</td><td>O(n&sup2;)</td><td>O(1)</td></tr>
    </tbody>
</table>

<h4>Selection Sort</h4>
<pre><code class="language-php">&lt;?php
function selectionSort(&$arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        $minIdx = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$j] < $arr[$minIdx]) $minIdx = $j;
        }
        [$arr[$i], $arr[$minIdx]] = [$arr[$minIdx], $arr[$i]];
    }
}

$arr = [64, 25, 12, 22, 11];
selectionSort($arr);
print_r($arr);  // [11, 12, 22, 25, 64]</code></pre>

<h4>Insertion Sort</h4>
<pre><code class="language-php">&lt;?php
function insertionSort(&$arr) {
    $n = count($arr);
    for ($i = 1; $i < $n; $i++) {
        $key = $arr[$i];
        $j = $i - 1;
        while ($j >= 0 && $arr[$j] > $key) {
            $arr[$j + 1] = $arr[$j];
            $j--;
        }
        $arr[$j + 1] = $key;
    }
}

$arr = [12, 11, 13, 5, 6];
insertionSort($arr);
print_r($arr);  // [5, 6, 11, 12, 13]</code></pre>

<h4>Merge Sort</h4>
<pre><code class="language-php">&lt;?php
function mergeSort($arr) {
    if (count($arr) <= 1) return $arr;

    $mid = intdiv(count($arr), 2);
    $left = mergeSort(array_slice($arr, 0, $mid));
    $right = mergeSort(array_slice($arr, $mid));

    return merge($left, $right);
}

function merge($left, $right) {
    $result = [];
    $i = $j = 0;

    while ($i < count($left) && $j < count($right)) {
        if ($left[$i] <= $right[$j]) {
            $result[] = $left[$i++];
        } else {
            $result[] = $right[$j++];
        }
    }
    return array_merge($result, array_slice($left, $i), array_slice($right, $j));
}

$arr = [38, 27, 43, 3, 9, 82, 10];
print_r(mergeSort($arr));  // [3, 9, 10, 27, 38, 43, 82]</code></pre>

<table>
    <thead><tr><th>Case</th><th>Time</th><th>Space</th><th>Stable?</th></tr></thead>
    <tbody>
        <tr><td>All cases</td><td>O(n log n)</td><td>O(n)</td><td>Yes</td></tr>
    </tbody>
</table>

<h4>Quick Sort</h4>
<pre><code class="language-php">&lt;?php
function quickSort(&$arr, $low, $high) {
    if ($low < $high) {
        $pi = partition($arr, $low, $high);
        quickSort($arr, $low, $pi - 1);
        quickSort($arr, $pi + 1, $high);
    }
}

function partition(&$arr, $low, $high) {
    $pivot = $arr[$high];
    $i = $low - 1;

    for ($j = $low; $j < $high; $j++) {
        if ($arr[$j] < $pivot) {
            $i++;
            [$arr[$i], $arr[$j]] = [$arr[$j], $arr[$i]];
        }
    }
    [$arr[$i + 1], $arr[$high]] = [$arr[$high], $arr[$i + 1]];
    return $i + 1;
}

$arr = [10, 7, 8, 9, 1, 5];
quickSort($arr, 0, count($arr) - 1);
print_r($arr);  // [1, 5, 7, 8, 9, 10]</code></pre>

<table>
    <thead><tr><th>Case</th><th>Time</th><th>Space</th><th>Stable?</th></tr></thead>
    <tbody>
        <tr><td>Best/Average</td><td>O(n log n)</td><td>O(log n)</td><td>No</td></tr>
        <tr><td>Worst</td><td>O(n&sup2;)</td><td>O(n)</td><td>No</td></tr>
    </tbody>
</table>

<h3>Sorting Algorithm Comparison</h3>
<table>
    <thead>
        <tr><th>Algorithm</th><th>Best</th><th>Average</th><th>Worst</th><th>Space</th><th>Stable</th></tr>
    </thead>
    <tbody>
        <tr><td>Bubble Sort</td><td>O(n)</td><td>O(n&sup2;)</td><td>O(n&sup2;)</td><td>O(1)</td><td>Yes</td></tr>
        <tr><td>Selection Sort</td><td>O(n&sup2;)</td><td>O(n&sup2;)</td><td>O(n&sup2;)</td><td>O(1)</td><td>No</td></tr>
        <tr><td>Insertion Sort</td><td>O(n)</td><td>O(n&sup2;)</td><td>O(n&sup2;)</td><td>O(1)</td><td>Yes</td></tr>
        <tr><td>Merge Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n)</td><td>Yes</td></tr>
        <tr><td>Quick Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n&sup2;)</td><td>O(log n)</td><td>No</td></tr>
    </tbody>
</table>

<h3>Python Implementation</h3>
<pre><code class="language-python">
# Bubble Sort - O(n²)
def bubble_sort(arr):
    n = len(arr)
    for i in range(n - 1):
        swapped = False
        for j in range(n - i - 1):
            if arr[j] > arr[j + 1]:
                arr[j], arr[j + 1] = arr[j + 1], arr[j]
                swapped = True
        if not swapped:
            break  # Already sorted
    return arr

# Merge Sort - O(n log n)
def merge_sort(arr):
    if len(arr) <= 1:
        return arr
    mid = len(arr) // 2
    left = merge_sort(arr[:mid])
    right = merge_sort(arr[mid:])
    return merge(left, right)

def merge(left, right):
    result = []
    i = j = 0
    while i < len(left) and j < len(right):
        if left[i] <= right[j]:
            result.append(left[i])
            i += 1
        else:
            result.append(right[j])
            j += 1
    result.extend(left[i:])
    result.extend(right[j:])
    return result

# Quick Sort - O(n log n) average
def quick_sort(arr):
    if len(arr) <= 1:
        return arr
    pivot = arr[len(arr) // 2]
    left = [x for x in arr if x < pivot]
    middle = [x for x in arr if x == pivot]
    right = [x for x in arr if x > pivot]
    return quick_sort(left) + middle + quick_sort(right)

# Usage
arr1 = [64, 34, 25, 12, 22, 11, 90]
print(f"Bubble sort: {bubble_sort(arr1.copy())}")

arr2 = [38, 27, 43, 3, 9, 82, 10]
print(f"Merge sort: {merge_sort(arr2)}")

arr3 = [10, 7, 8, 9, 1, 5]
print(f"Quick sort: {quick_sort(arr3)}")
</code></pre>

<h3>Java Implementation</h3>
<pre><code class="language-java">
import java.util.Arrays;

public class SortingAlgorithms {
    // Bubble Sort - O(n²)
    public static void bubbleSort(int[] arr) {
        int n = arr.length;
        for (int i = 0; i < n - 1; i++) {
            boolean swapped = false;
            for (int j = 0; j < n - i - 1; j++) {
                if (arr[j] > arr[j + 1]) {
                    int temp = arr[j];
                    arr[j] = arr[j + 1];
                    arr[j + 1] = temp;
                    swapped = true;
                }
            }
            if (!swapped) break;  // Already sorted
        }
    }

    // Merge Sort - O(n log n)
    public static int[] mergeSort(int[] arr) {
        if (arr.length <= 1) return arr;
        int mid = arr.length / 2;
        int[] left = mergeSort(Arrays.copyOfRange(arr, 0, mid));
        int[] right = mergeSort(Arrays.copyOfRange(arr, mid, arr.length));
        return merge(left, right);
    }

    private static int[] merge(int[] left, int[] right) {
        int[] result = new int[left.length + right.length];
        int i = 0, j = 0, k = 0;
        while (i < left.length && j < right.length) {
            if (left[i] <= right[j]) result[k++] = left[i++];
            else result[k++] = right[j++];
        }
        while (i < left.length) result[k++] = left[i++];
        while (j < right.length) result[k++] = right[j++];
        return result;
    }

    // Quick Sort - O(n log n) average
    public static void quickSort(int[] arr, int low, int high) {
        if (low < high) {
            int pi = partition(arr, low, high);
            quickSort(arr, low, pi - 1);
            quickSort(arr, pi + 1, high);
        }
    }

    private static int partition(int[] arr, int low, int high) {
        int pivot = arr[high];
        int i = low - 1;
        for (int j = low; j < high; j++) {
            if (arr[j] < pivot) {
                i++;
                int temp = arr[i];
                arr[i] = arr[j];
                arr[j] = temp;
            }
        }
        int temp = arr[i + 1];
        arr[i + 1] = arr[high];
        arr[high] = temp;
        return i + 1;
    }

    public static void main(String[] args) {
        int[] arr1 = {64, 34, 25, 12, 22, 11, 90};
        bubbleSort(arr1);
        System.out.println("Bubble sort: " + Arrays.toString(arr1));

        int[] arr2 = {38, 27, 43, 3, 9, 82, 10};
        System.out.println("Merge sort: " + Arrays.toString(mergeSort(arr2)));

        int[] arr3 = {10, 7, 8, 9, 1, 5};
        quickSort(arr3, 0, arr3.length - 1);
        System.out.println("Quick sort: " + Arrays.toString(arr3));
    }
}
</code></pre>

<!-- PART 3 -->
<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Database Queries:</strong> When you run <code>ORDER BY</code>, the database engine uses sorting algorithms (often quicksort or merge sort variants) to return results in the requested order.</li>
    <li><strong>E-commerce Product Listings:</strong> Sorting products by price, rating, or relevance requires efficient sorting to keep page loads fast.</li>
    <li><strong>File Systems:</strong> Your operating system sorts files and folders alphabetically by default for easy browsing.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Small data (n &lt; 50):</strong> Use insertion sort &mdash; it's simple and fast for small, nearly-sorted datasets.</li>
    <li><strong>General purpose:</strong> Use quicksort for best average performance.</li>
    <li><strong>Stability needed:</strong> Use merge sort when you need equal elements to maintain their relative order.</li>
    <li><strong>Memory constrained:</strong> Use quicksort (in-place) instead of merge sort (requires O(n) extra space).</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use When...</th><th>Avoid When...</th></tr></thead>
    <tbody>
        <tr><td>Data needs to be in order for display or further processing</td><td>Data is already sorted (check first!)</td></tr>
        <tr><td>You need to search frequently &mdash; sort once, search many times</td><td>Only one search is needed &mdash; linear search is simpler</td></tr>
        <tr><td>You need guaranteed O(n log n) &mdash; use merge sort</td><td>Memory is very limited &mdash; merge sort uses O(n) extra space</td></tr>
    </tbody>
</table>

<!-- PART 4 -->
<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A teacher needs to sort 10 student GPAs in ascending order for class honors recognition. The GPAs are: <code>[3.2, 3.8, 2.9, 3.5, 3.1, 3.7, 2.8, 3.9, 3.4, 3.6]</code>.</p>
    <p><strong>Task:</strong> Trace through the <strong>merge sort</strong> algorithm step by step.</p>
    <ol>
        <li><strong>Split:</strong> Show how the array is divided into sub-arrays at each level of recursion. Draw the recursion tree.</li>
        <li><strong>Merge:</strong> Show the merge step at each level, indicating which elements are compared and in what order they are placed into the result array.</li>
        <li><strong>Final Result:</strong> Write the complete sorted array. Count the total number of comparisons made during all merge operations. How does this compare to what bubble sort would require?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Split &mdash; Recursion Tree):</strong></p>
<pre>
Level 0: [3.2, 3.8, 2.9, 3.5, 3.1, 3.7, 2.8, 3.9, 3.4, 3.6]
Level 1: [3.2, 3.8, 2.9, 3.5, 3.1] | [3.7, 2.8, 3.9, 3.4, 3.6]
Level 2: [3.2, 3.8] | [2.9, 3.5, 3.1] | [3.7, 2.8] | [3.9, 3.4, 3.6]
Level 3: [3.2] | [3.8] | [2.9] | [3.5, 3.1] | [3.7] | [2.8] | [3.9] | [3.4, 3.6]
Level 4: [3.2] | [3.8] | [2.9] | [3.5] | [3.1] | [3.7] | [2.8] | [3.9] | [3.4] | [3.6]
</pre>

        <p><strong>Answer 2 (Merge Steps):</strong></p>
<pre>
Merge Level 3→2:
  [3.2] + [3.8] → [3.2, 3.8]              (1 comparison)
  [2.9] + [3.5, 3.1] → [2.9, 3.1, 3.5]   (3 comparisons)
  [3.7] + [2.8] → [2.8, 3.7]              (1 comparison)
  [3.9] + [3.4, 3.6] → [3.4, 3.6, 3.9]   (3 comparisons)

Merge Level 2→1:
  [3.2, 3.8] + [2.9, 3.1, 3.5] → [2.9, 3.1, 3.2, 3.5, 3.8]   (5 comparisons)
  [2.8, 3.7] + [3.4, 3.6, 3.9] → [2.8, 3.4, 3.6, 3.7, 3.9]   (5 comparisons)

Merge Level 1→0:
  [2.9, 3.1, 3.2, 3.5, 3.8] + [2.8, 3.4, 3.6, 3.7, 3.9]
  → [2.8, 2.9, 3.1, 3.2, 3.4, 3.5, 3.6, 3.7, 3.8, 3.9]       (9 comparisons)
</pre>

        <p><strong>Answer 3 (Final Result):</strong></p>
<pre><code>[2.8, 2.9, 3.1, 3.2, 3.4, 3.5, 3.6, 3.7, 3.8, 3.9]</code></pre>
        <p><strong>Total comparisons:</strong> 1 + 3 + 1 + 3 + 5 + 5 + 9 = <strong>27 comparisons</strong>.</p>
        <p><strong>Bubble sort comparison:</strong> Bubble sort averages n(n-1)/2 = 10&times;9/2 = <strong>45 comparisons</strong> in the average/worst case. Merge sort used ~40% fewer comparisons.</p>

        <p><strong>Bonus &mdash; PHP Implementation:</strong></p>
<pre><code class="language-php">&lt;?php
function mergeSort($arr) {
    if (count($arr) <= 1) return $arr;
    $mid = intdiv(count($arr), 2);
    $left = mergeSort(array_slice($arr, 0, $mid));
    $right = mergeSort(array_slice($arr, $mid));
    return merge($left, $right);
}

function merge($left, $right) {
    $result = [];
    $i = $j = 0;
    while ($i < count($left) && $j < count($right)) {
        if ($left[$i] <= $right[$j]) $result[] = $left[$i++];
        else $result[] = $right[$j++];
    }
    return array_merge($result, array_slice($left, $i), array_slice($right, $j));
}

$gpas = [3.2, 3.8, 2.9, 3.5, 3.1, 3.7, 2.8, 3.9, 3.4, 3.6];
print_r(mergeSort($gpas));</code></pre>
        <p><strong>Expected Output:</strong></p>
<pre>
Array
(
    [0] => 2.8
    [1] => 2.9
    [2] => 3.1
    [3] => 3.2
    [4] => 3.4
    [5] => 3.5
    [6] => 3.6
    [7] => 3.7
    [8] => 3.8
    [9] => 3.9
)
</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
