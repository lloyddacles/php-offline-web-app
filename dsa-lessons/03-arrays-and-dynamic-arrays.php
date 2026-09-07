<?php $pageTitle = 'Arrays and Dynamic Arrays'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 3; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Arrays and Dynamic Arrays</h1>
    <p class="lesson-desc">Understand how arrays work under the hood, the difference between static and dynamic arrays, and how different languages handle memory.</p>
</div>

<!-- PART 1 -->
<h2>Part 1: Activate Prior Knowledge</h2>
<p>Arrays are one of the most fundamental data structures. Before we explore how they work internally, let's review what you already know about storing multiple items.</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Imagine you have a row of 10 lockers, each with a number. How would you find the item in locker #7 without opening any other locker? What property of this system makes it fast?</li>
        <li>If you have a list of student names and you want to insert a new name at position 3, what happens to the names currently at positions 3, 4, 5, and so on? Describe the shifting process.</li>
        <li>Why might a fixed-size list (like a seating chart with exactly 30 seats) be limiting compared to a list that can grow and shrink dynamically?</li>
    </ol>
</div>

<!-- PART 2 -->
<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>An <strong>array</strong> is a collection of elements stored at contiguous memory locations. Each element is accessed by its <strong>index</strong> (position number). A <strong>dynamic array</strong> is an array that can grow or shrink in size automatically as elements are added or removed.</p>

<h3>Analogy</h3>
<p>A <strong>static array</strong> is like a parking lot with a fixed number of spots. Once all spots are taken, no more cars can park. A <strong>dynamic array</strong> is like a parking lot that can <strong>build a new, larger lot</strong> nearby and move all cars there when it fills up. The move is expensive, but it happens rarely enough that the overall cost stays low.</p>

<h3>How It Works (Step by Step)</h3>
<ol>
    <li><strong>Memory allocation:</strong> When you create an array, the computer reserves a block of contiguous memory slots.</li>
    <li><strong>O(1) access:</strong> Because elements are stored side by side, you can jump directly to any index using simple math: <code>base_address + index &times; element_size</code>.</li>
    <li><strong>Static arrays:</strong> Fixed size at creation. Cannot grow. Simple but limiting.</li>
    <li><strong>Dynamic arrays:</strong> Start with a capacity. When full, allocate a new array (usually 2x larger), copy elements over, and free the old one.</li>
    <li><strong>Amortized O(1):</strong> Although resizing is O(n), it happens so rarely that the average cost per append is constant.</li>
</ol>

<h3>Array Operations and Complexity</h3>
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

<h3>Static vs Dynamic Arrays</h3>
<table>
    <thead>
        <tr><th>Feature</th><th>Static Array</th><th>Dynamic Array</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>Size</strong></td><td>Fixed at creation</td><td>Grows/shrinks automatically</td></tr>
        <tr><td><strong>Memory</strong></td><td>Pre-allocated</td><td>Re-allocates when full</td></tr>
        <tr><td><strong>Insertion</strong></td><td>No efficient insert</td><td>Amortized O(1) at end</td></tr>
        <tr><td><strong>Languages</strong></td><td>C arrays, Java int[]</td><td>PHP arrays, Python lists, Java ArrayList</td></tr>
    </tbody>
</table>

<h3>PHP Implementation</h3>

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

echo count($fruits);  // 4
echo $fruits[1];     // banana</code></pre>

<h3>Dynamic Array Resizing</h3>
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
    <p>Even though resizing is O(n), it happens rarely enough that appending to a dynamic array is <strong>amortized O(1)</strong> &mdash; the average cost per operation is constant.</p>
</div>

<h3>PHP Array Internals</h3>
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

<h3>Python Implementation</h3>
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

<h3>Java Implementation</h3>
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

<!-- PART 3 -->
<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Student Records Systems:</strong> Arrays store lists of students, grades, and attendance. Quick index-based access makes it easy to retrieve any student's data.</li>
    <li><strong>Image Processing:</strong> Pixels in an image are stored in a 2D array. Each pixel's color value can be accessed and modified by its row and column index.</li>
    <li><strong>Buffering:</strong> Video streaming uses a dynamic array (buffer) to store upcoming frames. The buffer grows and shrinks based on network speed.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Use arrays when</strong> you need fast random access by index and know the approximate size in advance.</li>
    <li><strong>Avoid arrays when</strong> you need frequent insertions or deletions in the middle &mdash; consider linked lists instead.</li>
    <li>PHP arrays are <strong>ordered hash maps</strong> under the hood, so they're more flexible than traditional arrays but use more memory.</li>
    <li>Always consider <strong>space vs. time</strong>: pre-allocating a large array is faster but wastes memory if unused.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use When...</th><th>Avoid When...</th></tr></thead>
    <tbody>
        <tr><td>You need O(1) access to elements by index</td><td>You need frequent insertions/deletions in the middle</td></tr>
        <tr><td>You know the approximate size in advance</td><td>The data has no natural index or order</td></tr>
        <tr><td>You're iterating through all elements sequentially</td><td>The data is highly dynamic and changes size constantly</td></tr>
    </tbody>
</table>

<!-- PART 4 -->
<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a student records system for a university. The system must handle 50,000 students. You need to implement functions to add a new student, search for a student by ID, and delete a student who has graduated.</p>
    <p><strong>Task:</strong> Using PHP (or your preferred language), implement the following operations. Analyze the time complexity of each.</p>
    <ol>
        <li><strong>Add Student:</strong> Write a function that appends a new student record (with name, ID, and GPA) to an array. What is the time complexity? What happens when the internal array needs to resize?</li>
        <li><strong>Search Student:</strong> Write a function that searches for a student by ID using a linear scan. What is the time complexity? How many comparisons are needed in the worst case for 50,000 students?</li>
        <li><strong>Delete Student:</strong> Write a function that removes a student by ID. Since the array must stay contiguous, describe what must happen to the elements after the deleted one. What is the time complexity?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Add):</strong></p>
<pre><code class="language-php">&lt;?php
function addStudent(&$students, $name, $id, $gpa) {
    $students[] = ['name' => $name, 'id' => $id, 'gpa' => $gpa];
}

$students = [];
addStudent($students, 'Juan', 1001, 3.5);
addStudent($students, 'Maria', 1002, 3.8);
print_r($students);</code></pre>
        <p>Time complexity: <strong>O(1) amortized</strong>. Appending to the end is constant time. When the array resizes, copying all elements is O(n), but this happens rarely enough that the average cost per insert is O(1).</p>

        <p><strong>Answer 2 (Search):</strong></p>
<pre><code class="language-php">&lt;?php
function searchStudent($students, $targetId) {
    for ($i = 0; $i < count($students); $i++) {
        if ($students[$i]['id'] === $targetId) {
            return $students[$i];
        }
    }
    return null;
}

$result = searchStudent($students, 1002);
echo $result['name'];  // Maria</code></pre>
        <p>Time complexity: <strong>O(n)</strong>. In the worst case, every student must be checked. For 50,000 students, that's up to 50,000 comparisons.</p>

        <p><strong>Answer 3 (Delete):</strong></p>
<pre><code class="language-php">&lt;?php
function deleteStudent(&$students, $targetId) {
    for ($i = 0; $i < count($students); $i++) {
        if ($students[$i]['id'] === $targetId) {
            // Shift all elements after $i one position left
            array_splice($students, $i, 1);
            return true;
        }
    }
    return false;
}

deleteStudent($students, 1001);
print_r($students);</code></pre>
        <p>Time complexity: <strong>O(n)</strong>. After finding the element, all subsequent elements must be shifted one position to the left to maintain contiguity. In the worst case (deleting the first element), all n-1 remaining elements must be shifted.</p>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
