<?php $pageTitle = 'Arrays and Dynamic Arrays'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Arrays and Dynamic Arrays</h1>
    <p class="lesson-desc">Understand how arrays work under the hour hood, the difference between static and dynamic arrays, and how PHP arrays handle memory.</p>
</div>

<h2>What Is an Array?</h2>
<p>An <strong>array</strong> is a collection of elements stored at contiguous memory locations. Each element is accessed by its <strong>index</strong> (position number).</p>

<div class="info-box note">
    <div class="box-title">Key Property</div>
    <p>Arrays provide <strong>O(1) random access</strong> — you can jump directly to any element using its index, without checking other elements.</p>
</div>

<h2>Static vs Dynamic Arrays</h2>

<table>
    <thead>
        <tr><th>Feature</th><th>Static Array</th><th>Dynamic Array</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Size</strong></td><td>Fixed at creation</td><td>Grows/shrinks automatically</td></tr>
        <tr><td><strong>Memory</strong></td><td>Pre-allocated</td><td>Re-allocates when full</td></tr>
        <tr><td><strong>Insertion</strong></td><td>No efficient insert</td><td>Amortized O(1) at end</td></tr>
        <tr><td><strong>Languages</strong></td><td>C arrays, Java int[]</td><td>PHP arrays, Java ArrayList</td></tr>
    </tbody>
</table>

<h2>How PHP Arrays Work</h2>
<p>PHP arrays are actually <strong>ordered hash maps</strong> — they can have integer or string keys, and they grow dynamically:</p>

<pre><code class="language-php">&lt;?php
// PHP arrays are dynamic by default
$fruits = ['apple', 'banana', 'cherry'];

// Add elements — no size limit
$fruits[] = 'date';           // Append
$fruits['key'] = 'value';     // Associative

// Mixed keys work
$mixed = [
    0        => 'first',
    'hello'  => 'world',
    5        => 'fifth'
];

echo count($frits);  // 3
echo $fruits[1];     // banana</code></pre>

<h2>Array Operations and Complexity</h2>

<table>
    <thead>
        <tr><th>Operation</th><th>Static Array</th><th>Dynamic Array (end)</th><th>Dynamic Array (middle)</th></tr>
    </thead>
    <tbody>
        <tr><td>Access by index</td><td>O(1)</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>Search (unsorted)</td><td>O(n)</td><td>O(n)</td><td>O(n)</td></tr>
        <tr><td>Insert at end</td><td>N/A</td><td>O(1) amortized</td><td>N/A</td></tr>
        <tr><td>Insert at middle</td><td>N/A</td><td>O(n)</td><td>O(n)</td></tr>
        <tr><td>Delete from end</td><td>N/A</td><td>O(1)</td><td>N/A</td></tr>
        <tr><td>Delete from middle</td><td>N/A</td><td>O(n)</td><td>O(n)</td></tr>
    </tbody>
</table>

<h2>Dynamic Array Resizing</h2>
<p>When a dynamic array fills up, it allocates a <strong>new, larger array</strong> (usually 2x the size) and copies all elements:</p>

<pre><code class="language-php">&lt;?php
// Simulating dynamic array resizing
function dynamicArrayDemo() {
    $arr = [];
    $capacity = 2;
    $size = 0;

    for ($i = 1; $i <= 10; $i++) {
        if ($size >= $capacity) {
            $capacity *= 2;  // Double capacity
            echo "Resized to capacity: $capacity\n";
        }
        $arr[] = $i;
        $size++;
    }
    return $arr;
}

$result = dynamicArrayDemo();
// Resized to capacity: 4
// Resized to capacity: 8
// Resized to capacity: 16</code></pre>

<div class="info-box tip">
    <div class="box-title">Amortized O(1)</div>
    <p>Even though resizing is O(n), it happens rarely enough that appending to a dynamic array is <strong>amortized O(1)</strong> — the average cost per operation is constant.</p>
</div>

<h2>PHP Array Internals</h2>
<p>Under the hood, PHP arrays use a <strong>hash table</strong> structure:</p>

<pre><code class="language-php">&lt;?php
// PHP arrays can use integer or string keys
$student = [
    'name'      => 'Juan',
    'age'       => 20,
    'grades'    => [90, 85, 92],
    'is_active' => true
];

// Memory usage
echo memory_get_usage() . " bytes\n";

// Add many elements
for ($i = 0; $i < 1000; $i++) {
    $student['item_' . $i] = $i;
}
echo memory_get_usage() . " bytes\n";
// Grows automatically as needed</code></pre>

<h2>When to Use Arrays</h2>
<ul>
    <li><strong>Use when:</strong> You need fast random access by index</li>
    <li><strong>Use when:</strong> You know the approximate size in advance</li>
    <li><strong>Avoid when:</strong> You need frequent insertions/deletions in the middle</li>
    <li><strong>Avoid when:</strong> The data has no natural index</li>
</ul>

<h2>Practice: Array Operations</h2>

<pre><code class="language-php">&lt;?php
// Find the maximum element — O(n)
function findMax($arr) {
    $max = $arr[0];
    for ($i = 1; $i < count($arr); $i++) {
        if ($arr[$i] > $max) $max = $arr[$i];
    }
    return $max;
}

// Reverse an array — O(n)
function reverseArray($arr) {
    $left = 0;
    $right = count($arr) - 1;
    while ($left < $right) {
        $temp = $arr[$left];
        $arr[$left] = $arr[$right];
        $arr[$right] = $temp;
        $left++;
        $right--;
    }
    return $arr;
}

// Rotate array right by k — O(n)
function rotateRight($arr, $k) {
    $n = count($arr);
    $k = $k % $n;
    return array_merge(
        array_slice($arr, -$k),
        array_slice($arr, 0, $n - $k)
    );
}

echo findMax([3, 7, 2, 9, 1]);    // 9
print_r(reverseArray([1, 2, 3]));  // [3, 2, 1]
print_r(rotateRight([1,2,3,4,5], 2)); // [4, 5, 1, 2, 3]</code></pre>

<h2>Python Implementation</h2>
<pre><code class="language-python">
# Find the maximum element — O(n)
def find_max(arr):
    max_val = arr[0]
    for num in arr[1:]:
        if num > max_val:
            max_val = num
    return max_val

# Reverse an array — O(n)
def reverse_array(arr):
    left, right = 0, len(arr) - 1
    while left < right:
        arr[left], arr[right] = arr[right], arr[left]
        left += 1
        right -= 1
    return arr

# Rotate array right by k — O(n)
def rotate_right(arr, k):
    n = len(arr)
    k = k % n
    return arr[-k:] + arr[:-k]

# Dynamic array operations
def dynamic_array_demo():
    arr = []
    capacity = 2
    size = 0
    for i in range(1, 11):
        if size >= capacity:
            capacity *= 2
            print(f"Resized to capacity: {capacity}")
        arr.append(i)
        size += 1
    return arr

print(find_max([3, 7, 2, 9, 1]))  # 9
print(reverse_array([1, 2, 3]))  # [3, 2, 1]
print(rotate_right([1,2,3,4,5], 2))  # [4, 5, 1, 2, 3]
print(dynamic_array_demo())
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
import java.util.ArrayList;

public class ArrayOperations {
    // Find the maximum element — O(n)
    public static int findMax(int[] arr) {
        int max = arr[0];
        for (int i = 1; i < arr.length; i++) {
            if (arr[i] > max) max = arr[i];
        }
        return max;
    }

    // Reverse an array — O(n)
    public static int[] reverseArray(int[] arr) {
        int left = 0, right = arr.length - 1;
        while (left < right) {
            int temp = arr[left];
            arr[left] = arr[right];
            arr[right] = temp;
            left++;
            right--;
        }
        return arr;
    }

    // ArrayList operations (dynamic array)
    public static void dynamicArrayDemo() {
        ArrayList&lt;Integer&gt; arr = new ArrayList&lt;&gt;();
        int capacity = 2;
        for (int i = 1; i <= 10; i++) {
            if (arr.size() >= capacity) {
                capacity *= 2;
                System.out.println("Resized to capacity: " + capacity);
            }
            arr.add(i);
        }
        System.out.println("Array: " + arr);
    }

    public static void main(String[] args) {
        int[] nums = {3, 7, 2, 9, 1};
        System.out.println("Max: " + findMax(nums));

        int[] arr = {1, 2, 3};
        System.out.println("Reversed: " + java.util.Arrays.toString(reverseArray(arr)));

        dynamicArrayDemo();
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
