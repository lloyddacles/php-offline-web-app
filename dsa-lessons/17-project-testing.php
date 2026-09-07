<?php $pageTitle = 'Project Testing, Optimization, and Documentation'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 17; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Project Testing, Optimization, and Documentation</h1>
    <p class="lesson-desc">Write test cases, optimize performance, profile your code, and create clear documentation for your DSA project.</p>
</div>

<h2>Testing Your Project</h2>

<h3>Unit Testing</h3>
<pre><code class="language-php">&lt;?php
// Test your data structures systematically
class DSATests {
    private int $passed = 0;
    private int $failed = 0;

    public function assertEqual($expected, $actual, string $test): void {
        if ($expected === $actual) {
            $this->passed++;
            echo "  PASS: $test\n";
        } else {
            $this->failed++;
            echo "  FAIL: $test\n";
            echo "    Expected: " . var_export($expected, true) . "\n";
            echo "    Actual:   " . var_export($actual, true) . "\n";
        }
    }

    public function testHashMap(): void {
        echo "\n=== HashMap Tests ===\n";
        $map = new StudentStore();

        // Test empty state
        $this->assertEqual(0, $map->count(), 'New map is empty');

        // Test add and get
        $s = new Student('001', 'Juan', 'BSIT');
        $map->add($s);
        $this->assertEqual('Juan', $map->getById('001')->name, 'Get by ID');
        $this->assertEqual(1, $map->count(), 'Count after add');

        // Test search
        $results = $map->searchByName('uan');
        $this->assertEqual(1, count($results), 'Search finds Juan');

        // Test not found
        $this->assertEqual(null, $map->getById('999'), 'Not found returns null');
    }

    public function testSorting(): void {
        echo "\n=== Sorting Tests ===\n";
        $arr = [5, 3, 8, 1, 2];
        mergeSort($arr);
        $this->assertEqual([1, 2, 3, 5, 8], $arr, 'Merge sort works');

        $arr = [];
        mergeSort($arr);
        $this->assertEqual([], $arr, 'Sort empty array');

        $arr = [42];
        mergeSort($arr);
        $this->assertEqual([42], $arr, 'Sort single element');
    }

    public function testBST(): void {
        echo "\n=== BST Tests ===\n";
        $bst = new BST();
        $bst->insert(50);
        $bst->insert(30);
        $bst->insert(70);

        $this->assertEqual([30, 50, 70], $bst->inOrder(), 'BST in-order is sorted');

        $bst->delete(30);
        $this->assertEqual(null, $bst->search(30), 'Deleted node not found');
        $this->assertEqual([50, 70], $bst->inOrder(), 'BST after delete');
    }

    public function summary(): void {
        echo "\n=== Results: {$this->passed} passed, {$this->failed} failed ===\n";
    }
}

$tests = new DSATests();
$tests->testHashMap();
$tests->testSorting();
$tests->testBST();
$tests->summary();</code></pre>

<h3>Test Cases to Cover</h3>
<table>
    <thead><tr><th>Category</th><th>Test Cases</th></tr></thead>
    <tbody>
        <tr><td><strong>Empty</strong></td><td>Empty array, null input, zero elements</td></tr>
        <tr><td><strong>Single</strong></td><td>One element, one node</td></tr>
        <tr><td><strong>Normal</strong></td><td>Typical input sizes</td></tr>
        <tr><td><strong>Large</strong></td><td>1000+ elements</td></tr>
        <tr><td><strong>Edge</strong></td><td>Duplicates, already sorted, reverse sorted</td></tr>
        <tr><td><strong>Boundary</strong></td><td>Min/max values, overflow</td></tr>
    </tbody>
</table>

<h2>Performance Profiling</h2>
<pre><code class="language-php">&lt;?php
// Profile your code execution time
function benchmark(callable $fn, int $iterations = 100): array {
    $times = [];
    for ($i = 0; $i < $iterations; $i++) {
        $start = hrtime(true);
        $fn();
        $times[] = (hrtime(true) - $start) / 1e6; // ms
    }
    sort($times);
    return [
        'min' => $times[0],
        'max' => end($times),
        'median' => $times[intdiv(count($times), 2)],
        'avg' => round(array_sum($times) / count($times), 3),
    ];
}

// Test different data sizes
foreach ([100, 1000, 10000] as $n) {
    $arr = range(1, $n);
    shuffle($arr);

    $stats = benchmark(function () use ($arr) {
        linearSearch($arr, $arr[count($arr) - 1]);
    }, 10);

    echo "n=$n: median={$stats['median']}ms\n";
}

// Memory usage
echo "Memory: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB\n";
echo "Peak:   " . round(memory_get_peak_usage() / 1024 / 1024, 2) . " MB\n";</code></pre>

<h2>Optimization Techniques</h2>

<table>
    <thead><tr><th>Technique</th><th>Before</th><th>After</th><th>How</th></tr></thead>
    <tbody>
        <tr><td>Memoization</td><td>O(2ⁿ)</td><td>O(n)</td><td>Cache recursive results</td></tr>
        <tr><td>Early termination</td><td>O(n)</td><td>O(1) best</td><td>Exit when answer found</td></tr>
        <tr><td>Right data structure</td><td>O(n)</td><td>O(1)</td><td>Array → Hash Map</td></tr>
        <tr><td>Sort first</td><td>O(n²)</td><td>O(n log n)</td><td>Then binary search</td></tr>
        <tr><td>In-place algorithm</td><td>O(n) space</td><td>O(1) space</td><td>No extra arrays</td></tr>
    </tbody>
</table>

<h2>Documentation</h2>

<h3>README Structure</h3>
<pre>
# Project Name

## Overview
What the project does and why.

## Data Structures Used
- HashMap: for O(1) student lookups
- BST: for sorted grade rankings
- Graph: for course prerequisites

## How to Run
php index.php

## Complexity Analysis
| Operation | Time | Space |
|-----------|------|-------|
| Add       | O(1) | O(1)  |
| Search    | O(1) | O(1)  |
| Rank      | O(n log n) | O(n) |

## Test Results
All 25 test cases passing.

## Author
Your Name — Course Section
</pre>

<h2>Common Pitfalls to Avoid</h2>
<ul>
    <li><strong>Not testing edge cases</strong> — empty input, single element</li>
    <li><strong>Ignoring error handling</strong> — what if the data is malformed?</li>
    <li><strong>Over-optimizing</strong> — profile first, optimize what's slow</li>
    <li><strong>No documentation</strong> — future you won't remember what you did</li>
    <li><strong>Hardcoding values</strong> — use constants and configuration</li>
</ul>

<h2>Python Implementation</h2>
<pre><code class="language-python"># Unit Testing with assert
def test_student_store():
    store = StudentStore()

    # Test empty state
    assert store.count() == 0, "New store is empty"

    # Test add and get
    s = Student("001", "Juan", "BSIT")
    store.add(s)
    assert store.get_by_id("001").name == "Juan", "Get by ID"
    assert store.count() == 1, "Count after add"

    # Test search
    results = store.search_by_name("uan")
    assert len(results) == 1, "Search finds Juan"

    # Test not found
    assert store.get_by_id("999") is None, "Not found returns None"

    print("All StudentStore tests passed!")


def test_sorting():
    # Test merge sort
    def merge_sort(arr):
        if len(arr) &lt;= 1:
            return arr
        mid = len(arr) // 2
        left = merge_sort(arr[:mid])
        right = merge_sort(arr[mid:])
        return merge(left, right)

    def merge(l, r):
        result = []
        i = j = 0
        while i &lt; len(l) and j &lt; len(r):
            if l[i] &lt;= r[j]:
                result.append(l[i])
                i += 1
            else:
                result.append(r[j])
                j += 1
        result.extend(l[i:])
        result.extend(r[j:])
        return result

    assert merge_sort([5, 3, 8, 1, 2]) == [1, 2, 3, 5, 8], "Merge sort works"
    assert merge_sort([]) == [], "Sort empty array"
    assert merge_sort([42]) == [42], "Sort single element"

    print("All sorting tests passed!")


def test_gpa_calculation():
    s = Student("001", "Juan", "BSIT")
    assert s.get_gpa() == 0.0, "Empty grades GPA"

    s.add_grade("Math", 90)
    s.add_grade("Programming", 95)
    assert s.get_gpa() == 92.5, "GPA calculation"

    print("All GPA tests passed!")


# Run all tests
test_student_store()
test_sorting()
test_gpa_calculation()
print("\nAll tests passed!")</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">import java.util.*;

public class DSATests {
    private static int passed = 0;
    private static int failed = 0;

    static void assertEqual(Object expected, Object actual, String test) {
        if (Objects.equals(expected, actual)) {
            passed++;
            System.out.println("  PASS: " + test);
        } else {
            failed++;
            System.out.println("  FAIL: " + test);
            System.out.println("    Expected: " + expected);
            System.out.println("    Actual:   " + actual);
        }
    }

    static void testStudentStore() {
        System.out.println("\n=== StudentStore Tests ===");
        StudentStore store = new StudentStore();

        assertEqual(0, store.count(), "New store is empty");

        Student s = new Student("001", "Juan", "BSIT");
        store.add(s);
        assertEqual("Juan", store.getById("001").getName(), "Get by ID");
        assertEqual(1, store.count(), "Count after add");

        List&lt;Student&gt; results = store.searchByName("uan");
        assertEqual(1, results.size(), "Search finds Juan");

        assertEqual(null, store.getById("999"), "Not found returns null");
    }

    static void testSorting() {
        System.out.println("\n=== Sorting Tests ===");
        int[] arr = {5, 3, 8, 1, 2};
        mergeSort(arr, 0, arr.length - 1);
        assertEqual("12358", Arrays.toString(arr).replaceAll("[\\[\\], ]", ""), "Merge sort works");
    }

    static void mergeSort(int[] arr, int left, int right) {
        if (left &lt; right) {
            int mid = (left + right) / 2;
            mergeSort(arr, left, mid);
            mergeSort(arr, mid + 1, right);
            merge(arr, left, mid, right);
        }
    }

    static void merge(int[] arr, int left, int mid, int right) {
        int[] temp = new int[right - left + 1];
        int i = left, j = mid + 1, k = 0;
        while (i &lt;= mid &amp;&amp; j &lt;= right) {
            if (arr[i] &lt;= arr[j]) temp[k++] = arr[i++];
            else temp[k++] = arr[j++];
        }
        while (i &lt;= mid) temp[k++] = arr[i++];
        while (j &lt;= right) temp[k++] = arr[j++];
        System.arraycopy(temp, 0, arr, left, temp.length);
    }

    static void testGPACalculation() {
        System.out.println("\n=== GPA Tests ===");
        Student s = new Student("001", "Juan", "BSIT");
        assertEqual(0.0, s.getGPA(), "Empty grades GPA");

        s.addGrade("Math", 90);
        s.addGrade("Programming", 95);
        assertEqual(92.5, s.getGPA(), "GPA calculation");
    }

    static void summary() {
        System.out.println("\n=== Results: " + passed + " passed, " + failed + " failed ===");
    }

    public static void main(String[] args) {
        testStudentStore();
        testSorting();
        testGPACalculation();
        summary();
    }
}</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
