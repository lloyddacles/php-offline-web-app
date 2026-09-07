<?php $pageTitle = 'Sorting Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 5; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Sorting Algorithms</h1>
    <p class="lesson-desc">Learn the fundamental sorting algorithms — from simple bubble sort to efficient merge sort and quicksort.</p>
</div>

<h2>Why Sorting Matters</h2>
<p>Sorting is one of the most fundamental operations in computer science. It enables faster searching, simplifies data processing, and is a building block for many other algorithms.</p>

<h2>Bubble Sort</h2>
<p>Repeatedly compares adjacent elements and swaps them if they're in the wrong order.</p>

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
        <tr><td>Average</td><td>O(n²)</td><td>O(1)</td></tr>
        <tr><td>Worst</td><td>O(n²)</td><td>O(1)</td></tr>
    </tbody>
</table>

<h2>Selection Sort</h2>
<p>Finds the minimum element and places it at the beginning, then repeats for the remaining elements.</p>

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

<h2>Insertion Sort</h2>
<p>Builds the sorted array one element at a time by inserting each element into its correct position.</p>

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

<h2>Merge Sort</h2>
<p>Divide-and-conquer: splits the array in half, recursively sorts each half, then merges the sorted halves.</p>

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

<h2>Quick Sort</h2>
<p>Picks a pivot, partitions elements around it, then recursively sorts the partitions.</p>

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
        <tr><td>Worst</td><td>O(n²)</td><td>O(n)</td><td>No</td></tr>
    </tbody>
</table>

<h2>Sorting Algorithm Comparison</h2>

<table>
    <thead>
        <tr><th>Algorithm</th><th>Best</th><th>Average</th><th>Worst</th><th>Space</th><th>Stable</th></tr>
    </thead>
    <tbody>
        <tr><td>Bubble Sort</td><td>O(n)</td><td>O(n²)</td><td>O(n²)</td><td>O(1)</td><td>Yes</td></tr>
        <tr><td>Selection Sort</td><td>O(n²)</td><td>O(n²)</td><td>O(n²)</td><td>O(1)</td><td>No</td></tr>
        <tr><td>Insertion Sort</td><td>O(n)</td><td>O(n²)</td><td>O(n²)</td><td>O(1)</td><td>Yes</td></tr>
        <tr><td>Merge Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n)</td><td>Yes</td></tr>
        <tr><td>Quick Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n²)</td><td>O(log n)</td><td>No</td></tr>
    </tbody>
</table>

<div class="info-box tip">
    <div class="box-title">When to Use What?</div>
    <p><strong>Small data:</strong> Insertion sort (simple, fast for small n)<br>
    <strong>General purpose:</strong> Quick sort (fastest average case)<br>
    <strong>Stability needed:</strong> Merge sort (stable, consistent O(n log n))<br>
    <strong>Memory constrained:</strong> Quick sort (in-place)</p>
</div>

<h2>Python Implementation</h2>
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

<h2>Java Implementation</h2>
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

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
