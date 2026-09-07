<?php $pageTitle = 'DSA Project Testing'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 17; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>DSA Project Testing</h1>
    <p class="lesson-desc">Write test cases, optimize performance, profile your code, and create clear documentation for your DSA project.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Testing is a critical part of software development. Think about your past experiences and consider these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Have you ever written code that "worked" on your test cases but failed for a user? What happened?</li>
        <li>What is the difference between testing with an empty array vs testing with a single-element array?</li>
        <li>If your function has O(n²) time complexity, how long will it take for n=1000 vs n=10,000?</li>
        <li>What is a "boundary condition"? Why are edge cases often where bugs hide?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Testing means verifying that your code produces correct results for a variety of inputs, including normal cases, edge cases, and large datasets. Unit testing checks individual functions; performance testing measures speed and memory.</p>

<h3>Analogy</h3>
<p>Like a car factory quality check: you test each engine component individually (unit test), then test the whole car on a highway (integration test), and measure fuel efficiency (performance test). A car that passes the factory test but breaks on the road is a failure.</p>

<h3>How It Works (Step by Step)</h3>

<h4>Unit Testing</h4>
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

<h4>Test Cases to Cover</h4>
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

<h4>Performance Profiling</h4>
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

<h4>Optimization Techniques</h4>
<table>
    <thead><tr><th>Technique</th><th>Before</th><th>After</th><th>How</th></tr></thead>
    <tbody>
        <tr><td>Memoization</td><td>O(2^n)</td><td>O(n)</td><td>Cache recursive results</td></tr>
        <tr><td>Early termination</td><td>O(n)</td><td>O(1) best</td><td>Exit when answer found</td></tr>
        <tr><td>Right data structure</td><td>O(n)</td><td>O(1)</td><td>Array to Hash Map</td></tr>
        <tr><td>Sort first</td><td>O(n^2)</td><td>O(n log n)</td><td>Then binary search</td></tr>
        <tr><td>In-place algorithm</td><td>O(n) space</td><td>O(1) space</td><td>No extra arrays</td></tr>
    </tbody>
</table>

<h3>Python Example: Unit Testing</h3>
<p>Testing verifies your code works correctly.</p>
<pre><code class="language-python"># Simple unit test for a hash map
def test_hashmap():
    store = {}

    # Test 1: Add and get
    store["001"] = "Juan"
    assert store["001"] == "Juan", "Test 1 Failed"
    print("Test 1 PASSED: Add and get works")

    # Test 2: Get non-existent key
    result = store.get("999")
    assert result is None, "Test 2 Failed"
    print("Test 2 PASSED: Not found returns None")

    # Test 3: Delete
    del store["001"]
    assert "001" not in store, "Test 3 Failed"
    print("Test 3 PASSED: Delete works")

    # Test 4: Count
    store["002"] = "Maria"
    assert len(store) == 1, "Test 4 Failed"
    print("Test 4 PASSED: Count works")

test_hashmap()
</code></pre>
<strong>Output:</strong>
<pre>Test 1 PASSED: Add and get works
Test 2 PASSED: Not found returns None
Test 3 PASSED: Delete works
Test 4 PASSED: Count works</pre>

<h3>Java Example: Unit Testing</h3>
<p>Testing verifies your code works correctly.</p>
<pre><code class="language-java">import java.util.HashMap;

public class Main {
    static int passed = 0, failed = 0;

    static void assertEqual(Object expected, Object actual, String test) {
        if (expected == null ? actual == null : expected.equals(actual)) {
            passed++;
            System.out.println("PASSED: " + test);
        } else {
            failed++;
            System.out.println("FAILED: " + test);
        }
    }

    public static void main(String[] args) {
        HashMap&lt;String, String&gt; store = new HashMap&lt;&gt;();

        // Test 1: Add and get
        store.put("001", "Juan");
        assertEqual("Juan", store.get("001"), "Add and get works");

        // Test 2: Get non-existent key
        assertEqual(null, store.get("999"), "Not found returns null");

        // Test 3: Delete
        store.remove("001");
        assertEqual(true, !store.containsKey("001"), "Delete works");

        // Test 4: Count
        store.put("002", "Maria");
        assertEqual(1, store.size(), "Count works");

        System.out.println("\nResults: " + passed + " passed, " + failed + " failed");
    }
}
</code></pre>
<strong>Output:</strong>
<pre>PASSED: Add and get works
PASSED: Not found returns null
PASSED: Delete works
PASSED: Count works
Results: 4 passed, 0 failed</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Continuous Integration:</strong> Automated tests run on every code change to catch regressions</li>
    <li><strong>Performance Tuning:</strong> Profiling identifies bottlenecks before they affect users</li>
    <li><strong>Quality Assurance:</strong> Test coverage metrics ensure critical paths are verified</li>
    <li><strong>Documentation:</strong> Tests serve as executable documentation showing expected behavior</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Test early, test often</strong> — don't wait until the project is "done"</li>
    <li><strong>Test edge cases first</strong> — empty inputs, single elements, and boundaries find the most bugs</li>
    <li><strong>Profile before optimizing</strong> — measure, don't guess what's slow</li>
    <li><strong>Write testable code</strong> — small functions with clear inputs/outputs are easy to test</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Activity</th><th>When</th><th>Tools/Methods</th></tr></thead>
    <tbody>
        <tr><td>Unit testing</td><td>During implementation</td><td>assert statements, test frameworks</td></tr>
        <tr><td>Integration testing</td><td>After combining modules</td><td>End-to-end test scripts</td></tr>
        <tr><td>Performance profiling</td><td>When code feels slow</td><td>benchmark functions, timers</td></tr>
        <tr><td>Stress testing</td><td>Before submission</td><td>Large datasets, timing</td></tr>
        <tr><td>Documentation</td><td>Throughout development</td><td>README, inline comments</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You have implemented a HashMap-based StudentStore for your Student Performance Tracking System. Before submitting your project, you need to verify that all operations work correctly.</p>
    <p><strong>Task:</strong> Write unit tests for the HashMap implementation covering these scenarios:</p>
    <ol>
        <li><strong>Empty state:</strong> A new store should have count 0 and return null for any ID lookup.</li>
        <li><strong>Add and retrieve:</strong> Add a student, then retrieve by ID. Verify all fields match.</li>
        <li><strong>Search by name:</strong> Add 3 students, search by a partial name that matches 2 of them. Verify correct students are returned.</li>
        <li><strong>Delete:</strong> Add a student, delete them, verify count decreases and getById returns null.</li>
        <li><strong>Duplicate ID:</strong> Try adding two students with the same ID. The second should overwrite the first.</li>
    </ol>
    <p>Write test code in PHP, Python, and Java.</p>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer: PHP Tests</strong></p>
        <pre><code>&lt;?php
function testEmptyState() {
    $store = new StudentStore();
    assert($store->count() === 0, 'Empty store count');
    assert($store->getById('001') === null, 'Empty store returns null');
    echo "PASS: Empty state tests\n";
}

function testAddAndRetrieve() {
    $store = new StudentStore();
    $s = new Student('001', 'Juan Dela Cruz', 'BSIT');
    $s->addGrade('Math', 90);
    $store->add($s);

    $found = $store->getById('001');
    assert($found !== null, 'Student found');
    assert($found->name === 'Juan Dela Cruz', 'Name matches');
    assert($found->getGPA() === 90.0, 'GPA matches');
    echo "PASS: Add and retrieve tests\n";
}

function testSearchByName() {
    $store = new StudentStore();
    $store->add(new Student('001', 'Juan Dela Cruz', 'BSIT'));
    $store->add(new Student('002', 'Juan Santos', 'BSCS'));
    $store->add(new Student('003', 'Maria Reyes', 'BSIT'));

    $results = $store->searchByName('uan');
    assert(count($results) === 2, 'Search finds 2 Juans');

    $results = $store->searchByName('aria');
    assert(count($results) === 1, 'Search finds Maria');
    echo "PASS: Search tests\n";
}

function testDelete() {
    $store = new StudentStore();
    $store->add(new Student('001', 'Juan', 'BSIT'));
    $store->add(new Student('002', 'Maria', 'BSCS'));

    $deleted = $store->delete('001');
    assert($deleted === true, 'Delete returns true');
    assert($store->count() === 1, 'Count after delete');
    assert($store->getById('001') === null, 'Deleted student not found');

    $deleted = $store->delete('999');
    assert($deleted === false, 'Delete non-existent returns false');
    echo "PASS: Delete tests\n";
}

function testDuplicateId() {
    $store = new StudentStore();
    $store->add(new Student('001', 'Juan', 'BSIT'));
    $store->add(new Student('001', 'Pedro', 'BSCS'));

    assert($store->count() === 1, 'Duplicate ID overwrites');
    assert($store->getById('001')->name === 'Pedro', 'Second student kept');
    echo "PASS: Duplicate ID tests\n";
}

testEmptyState();
testAddAndRetrieve();
testSearchByName();
testDelete();
testDuplicateId();
echo "\nAll HashMap tests passed!\n";</code></pre>

        <p><strong>Answer: Python Tests</strong></p>
        <pre><code>def test_empty_state():
    store = StudentStore()
    assert store.count() == 0
    assert store.get_by_id('001') is None
    print("PASS: Empty state tests")

def test_add_and_retrieve():
    store = StudentStore()
    s = Student('001', 'Juan Dela Cruz', 'BSIT')
    s.add_grade('Math', 90)
    store.add(s)

    found = store.get_by_id('001')
    assert found is not None
    assert found.name == 'Juan Dela Cruz'
    assert found.get_gpa() == 90.0
    print("PASS: Add and retrieve tests")

def test_search_by_name():
    store = StudentStore()
    store.add(Student('001', 'Juan Dela Cruz', 'BSIT'))
    store.add(Student('002', 'Juan Santos', 'BSCS'))
    store.add(Student('003', 'Maria Reyes', 'BSIT'))

    results = store.search_by_name('uan')
    assert len(results) == 2

    results = store.search_by_name('aria')
    assert len(results) == 1
    print("PASS: Search tests")

def test_delete():
    store = StudentStore()
    store.add(Student('001', 'Juan', 'BSIT'))
    store.add(Student('002', 'Maria', 'BSCS'))

    assert store.delete('001') == True
    assert store.count() == 1
    assert store.get_by_id('001') is None
    assert store.delete('999') == False
    print("PASS: Delete tests")

def test_duplicate_id():
    store = StudentStore()
    store.add(Student('001', 'Juan', 'BSIT'))
    store.add(Student('001', 'Pedro', 'BSCS'))

    assert store.count() == 1
    assert store.get_by_id('001').name == 'Pedro'
    print("PASS: Duplicate ID tests")

test_empty_state()
test_add_and_retrieve()
test_search_by_name()
test_delete()
test_duplicate_id()
print("\nAll HashMap tests passed!")</code></pre>

        <p><strong>Answer: Java Tests</strong></p>
        <pre><code>import java.util.*;

public class HashMapTests {
    static int passed = 0, failed = 0;

    static void assertEquals(Object expected, Object actual, String test) {
        if (Objects.equals(expected, actual)) {
            passed++;
            System.out.println("  PASS: " + test);
        } else {
            failed++;
            System.out.println("  FAIL: " + test + " (expected: " + expected + ", got: " + actual + ")");
        }
    }

    static void testEmptyState() {
        StudentStore store = new StudentStore();
        assertEquals(0, store.count(), "Empty store count");
        assertEquals(null, store.getById("001"), "Empty store returns null");
    }

    static void testAddAndRetrieve() {
        StudentStore store = new StudentStore();
        Student s = new Student("001", "Juan Dela Cruz", "BSIT");
        s.addGrade("Math", 90);
        store.add(s);

        Student found = store.getById("001");
        assertEquals("Juan Dela Cruz", found.getName(), "Name matches");
        assertEquals(90.0, found.getGPA(), "GPA matches");
    }

    static void testSearchByName() {
        StudentStore store = new StudentStore();
        store.add(new Student("001", "Juan Dela Cruz", "BSIT"));
        store.add(new Student("002", "Juan Santos", "BSCS"));
        store.add(new Student("003", "Maria Reyes", "BSIT"));

        List&lt;Student&gt; results = store.searchByName("uan");
        assertEquals(2, results.size(), "Search finds 2 Juans");
    }

    static void testDelete() {
        StudentStore store = new StudentStore();
        store.add(new Student("001", "Juan", "BSIT"));
        store.add(new Student("002", "Maria", "BSCS"));

        assertEquals(true, store.delete("001"), "Delete returns true");
        assertEquals(1, store.count(), "Count after delete");
        assertEquals(null, store.getById("001"), "Deleted student not found");
        assertEquals(false, store.delete("999"), "Delete non-existent returns false");
    }

    static void testDuplicateId() {
        StudentStore store = new StudentStore();
        store.add(new Student("001", "Juan", "BSIT"));
        store.add(new Student("001", "Pedro", "BSCS"));

        assertEquals(1, store.count(), "Duplicate ID overwrites");
        assertEquals("Pedro", store.getById("001").getName(), "Second student kept");
    }

    public static void main(String[] args) {
        testEmptyState();
        testAddAndRetrieve();
        testSearchByName();
        testDelete();
        testDuplicateId();
        System.out.println("\nResults: " + passed + " passed, " + failed + " failed");
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
