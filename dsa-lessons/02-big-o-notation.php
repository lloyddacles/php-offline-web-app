<?php $pageTitle = 'Big O Notation'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 2; $sectionDir = 'dsa-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Big O Notation</h1>
    <p class="lesson-desc">Learn how to measure algorithm efficiency and understand time and space complexity.</p>
</div>

<!-- PART 1 -->
<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before learning Big O Notation, you should understand the basics of loops, functions, and how code execution takes time.</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>If you have a loop that runs from 0 to n-1, how many iterations does it perform? What happens to the number of iterations if n doubles?</li>
        <li>Consider two functions: one that prints every element in a list, and another that prints every pair of elements. Which one does more work? How does the work grow as the list gets bigger?</li>
        <li>Why might two programs that produce the same result be considered "different" in terms of quality?</li>
    </ol>
</div>

<!-- PART 2 -->
<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Big O notation</strong> describes how an algorithm's performance scales with input size. It answers the question: <em>"How does the runtime grow as the data grows?"</em> It focuses on the <strong>worst-case</strong> scenario and ignores constants to give a high-level picture of efficiency.</p>

<h3>Analogy</h3>
<p>Imagine you're looking for a name in a phone book. <strong>O(1)</strong> is like someone telling you the exact page. <strong>O(log n)</strong> is opening to the middle and eliminating half each time. <strong>O(n)</strong> is reading every page from the start. <strong>O(n&sup2;)</strong> is checking every name against every other name. Big O tells you <em>which strategy scales</em> when the phone book has 100 entries vs. 100 million entries.</p>

<h3>Time vs Space Complexity</h3>
<table>
    <thead>
        <tr>
            <th>Type</th>
            <th>Measures</th>
            <th>Example</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Time Complexity</strong></td>
            <td>How long an algorithm takes to run</td>
            <td>Searching through a list</td>
        </tr>
        <tr>
            <td><strong>Space Complexity</strong></td>
            <td>How much memory an algorithm uses</td>
            <td>Creating a copy of an array</td>
        </tr>
    </tbody>
</table>

<h3>How It Works (Step by Step)</h3>
<p>Big O measures the number of operations relative to input size <code>n</code>:</p>
<ol>
    <li><strong>O(1) &mdash; Constant:</strong> Same time regardless of input size (e.g., accessing an array index).</li>
    <li><strong>O(log n) &mdash; Logarithmic:</strong> Work halves each step (e.g., binary search).</li>
    <li><strong>O(n) &mdash; Linear:</strong> One pass through the data (e.g., a single loop).</li>
    <li><strong>O(n log n) &mdash; Linearithmic:</strong> Divide and conquer (e.g., merge sort).</li>
    <li><strong>O(n&sup2;) &mdash; Quadratic:</strong> Nested loops over the data (e.g., comparing every pair).</li>
    <li><strong>O(2&sup;n;) &mdash; Exponential:</strong> Doubles with each added element (e.g., recursive Fibonacci).</li>
</ol>

<h3>Common Complexities</h3>
<table>
    <thead>
        <tr>
            <th>Big O</th>
            <th>Name</th>
            <th>Example</th>
            <th>10 items</th>
            <th>1,000 items</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>O(1)</code></td>
            <td>Constant</td>
            <td>Array access by index</td>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <td><code>O(log n)</code></td>
            <td>Logarithmic</td>
            <td>Binary search</td>
            <td>3</td>
            <td>10</td>
        </tr>
        <tr>
            <td><code>O(n)</code></td>
            <td>Linear</td>
            <td>Loop through array</td>
            <td>10</td>
            <td>1,000</td>
        </tr>
        <tr>
            <td><code>O(n log n)</code></td>
            <td>Linearithmic</td>
            <td>Merge sort</td>
            <td>33</td>
            <td>10,000</td>
        </tr>
        <tr>
            <td><code>O(n&sup2;)</code></td>
            <td>Quadratic</td>
            <td>Nested loops</td>
            <td>100</td>
            <td>1,000,000</td>
        </tr>
        <tr>
            <td><code>O(2&sup;n;)</code></td>
            <td>Exponential</td>
            <td>Recursive Fibonacci</td>
            <td>1,024</td>
            <td>1.07 &times; 10&sup3;&sup3;&sup2;</td>
        </tr>
    </tbody>
</table>

<h3>PHP Implementation</h3>

<div class="sandbox">
    <div class="sandbox-header">
        <span class="label">Try It Yourself &mdash; O(1) Constant Time</span>
    </div>
    <textarea class="sandbox-code" data-example="<?= base64_encode('<?php
// O(1): Constant time - always takes the same time
// regardless of array size

$numbers = range(1, 1000000);

$start = microtime(true);

// Access element at index 500000
$value = $numbers[500000];

$end = microtime(true);
$time = ($end - $start) * 1000;

echo "Accessed index 500000\n";
echo "Value: $value\n";
echo "Time: " . round($time, 6) . " ms\n";
echo "This is O(1) - constant time!\n";
'); ?>"></textarea>
    <div class="sandbox-actions">
        <button class="btn btn-success run-btn">Run Code</button>
        <span class="text-muted" style="font-size:0.85em;">Ctrl+Enter to run</span>
    </div>
    <div class="sandbox-result">
        <div class="output-label">Output:</div>
        <div class="output-content"></div>
    </div>
</div>

<div class="sandbox">
    <div class="sandbox-header">
        <span class="label">Try It Yourself &mdash; O(n) vs O(n&sup2;)</span>
    </div>
    <textarea class="sandbox-code" data-example="<?= base64_encode('<?php
// Comparing O(n) vs O(n²)

$n = 1000;
$arr = range(1, $n);

// O(n) - Linear: one loop
$start = microtime(true);
$count = 0;
for ($i = 0; $i < $n; $i++) {
    $count++;
}
$end = microtime(true);
$linearTime = ($end - $start) * 1000;

// O(n²) - Quadratic: nested loops
$start = microtime(true);
$count = 0;
for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n; $j++) {
        $count++;
    }
}
$end = microtime(true);
$quadraticTime = ($end - $start) * 1000;

echo "Array size: $n elements\n\n";
echo "O(n) Linear:\n";
echo "  Operations: $n\n";
echo "  Time: " . round($linearTime, 4) . " ms\n\n";
echo "O(n²) Quadratic:\n";
echo "  Operations: " . ($n * $n) . "\n";
echo "  Time: " . round($quadraticTime, 4) . " ms\n\n";
echo "Ratio: O(n²) is " . round($quadraticTime / $linearTime) . "x slower!\n";
'); ?>"></textarea>
    <div class="sandbox-actions">
        <button class="btn btn-success run-btn">Run Code</button>
        <span class="text-muted" style="font-size:0.85em;">Ctrl+Enter to run</span>
    </div>
    <div class="sandbox-result">
        <div class="output-label">Output:</div>
        <div class="output-content"></div>
    </div>
</div>

<h3>Python Example: Comparing Speed</h3>
<p>Let's see how different code speeds compare.</p>
<pre><code class="language-python"># O(1) - Constant: Same speed no matter the size
def get_first(items):
    return items[0]  # Just grab the first item

# O(n) - Linear: Speed grows with input size
def find_item(items, target):
    for item in items:      # Check each item one by one
        if item == target:
            return item
    return None

# O(n²) - Quadratic: Very slow for large inputs
def find_duplicates(items):
    duplicates = []
    for i in items:           # First loop
        for j in items:       # Second loop (inside first)
            if i == j and items.count(i) > 1:
                duplicates.append(i)
    return duplicates

# Test with small list
numbers = [1, 2, 3, 4, 5]
print(get_first(numbers))        # 1
print(find_item(numbers, 3))     # 3
print(find_duplicates([1,2,2,3]))# [2, 2]
</code></pre>
<strong>Output:</strong>
<pre>1
3
[2, 2]</pre>

<h3>Java Example: Comparing Speed</h3>
<p>Let's see how different code speeds compare.</p>
<pre><code class="language-java">public class Main {
    // O(1) - Constant: Same speed no matter the size
    static int getFirst(int[] items) {
        return items[0];  // Just grab the first item
    }

    // O(n) - Linear: Speed grows with input size
    static int findItem(int[] items, int target) {
        for (int item : items) {      // Check each item
            if (item == target) {
                return item;
            }
        }
        return -1;
    }

    public static void main(String[] args) {
        int[] numbers = {1, 2, 3, 4, 5};
        System.out.println(getFirst(numbers));      // 1
        System.out.println(findItem(numbers, 3));   // 3
    }
}
</code></pre>
<strong>Output:</strong>
<pre>1
3</pre>

<!-- PART 3 -->
<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Database Query Optimization:</strong> A query that scans every row is O(n). Adding an index makes it O(log n) &mdash; turning a 10-second query into a millisecond one.</li>
    <li><strong>E-commerce Search:</strong> Filtering millions of products by price or category needs efficient algorithms to return results instantly.</li>
    <li><strong>Social Media Feeds:</strong> Sorting posts by relevance across millions of users requires O(n log n) or better algorithms.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Look for loops.</strong> A single loop over n elements is O(n). Two nested loops is O(n&sup2;). Three nested loops is O(n&sup3;).</li>
    <li><strong>Halving = logarithmic.</strong> If the loop count halves each time (like binary search), it's O(log n).</li>
    <li><strong>Ignore constants.</strong> O(2n) is still O(n). Big O describes the <em>growth rate</em>, not the exact time.</li>
    <li><strong>Optimize the worst case.</strong> Focus on reducing the highest complexity in your code, not micro-optimizing already-fast operations.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use When...</th><th>Avoid When...</th></tr></thead>
    <tbody>
        <tr><td>Comparing two algorithm approaches for the same problem</td><td>Micro-optimizing code that already runs fast enough</td></tr>
        <tr><td>Working with large datasets where performance matters</td><td>The data size is tiny and fixed</td></tr>
        <tr><td>Preparing for technical interviews</td><td>Prototyping &mdash; correctness comes first, optimization later</td></tr>
    </tbody>
</table>

<!-- PART 4 -->
<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> A developer is building a contact list app. They have written three functions and need to determine which approach is best for a list of 10,000 contacts.</p>
    <p><strong>Task:</strong> Analyze the time complexity of each code snippet below. Determine the Big O for each, explain your reasoning, and calculate the approximate number of operations for n = 10,000.</p>
    <ol>
        <li><strong>Snippet A:</strong> A function that loops through the contact list once to check if a specific phone number exists.
<pre><code class="language-php">&lt;?php
function findContact($contacts, $phone) {
    for ($i = 0; $i < count($contacts); $i++) {
        if ($contacts[$i]['phone'] === $phone) {
            return $contacts[$i];
        }
    }
    return null;
}</code></pre>
        </li>
        <li><strong>Snippet B:</strong> A function that compares every contact with every other contact to find duplicates by phone number.
<pre><code class="language-php">&lt;?php
function findDuplicates($contacts) {
    $duplicates = [];
    for ($i = 0; $i < count($contacts); $i++) {
        for ($j = $i + 1; $j < count($contacts); $j++) {
            if ($contacts[$i]['phone'] === $contacts[$j]['phone']) {
                $duplicates[] = $contacts[$i];
            }
        }
    }
    return $duplicates;
}</code></pre>
        </li>
        <li><strong>Snippet C:</strong> A function that repeatedly halves a sorted list of contacts to find a name (binary search).
<pre><code class="language-php">&lt;?php
function findByName($sortedContacts, $name) {
    $left = 0;
    $right = count($sortedContacts) - 1;
    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($sortedContacts[$mid]['name'] === $name) return $sortedContacts[$mid];
        if ($sortedContacts[$mid]['name'] < $name) $left = $mid + 1;
        else $right = $mid - 1;
    }
    return null;
}</code></pre>
        </li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1 (Snippet A):</strong> <strong>O(n)</strong> &mdash; Linear time. The function loops through the list once. For 10,000 contacts, it performs up to 10,000 comparisons in the worst case.</p>
        <p><strong>Answer 2 (Snippet B):</strong> <strong>O(n&sup2;)</strong> &mdash; Quadratic time. Two nested loops compare every pair. For 10,000 contacts, that's approximately 50,000,000 (n&times;(n-1)/2) comparisons.</p>
        <p><strong>Answer 3 (Snippet C):</strong> <strong>O(log n)</strong> &mdash; Logarithmic time. Binary search halves the search space each step. For 10,000 contacts, it performs at most ~14 comparisons (log<sub>2</sub> 10,000 &asymp; 13.3).</p>
        <p><strong>Key Insight:</strong> Snippet C is overwhelmingly the fastest. If the app needs to perform frequent lookups, maintaining a sorted list and using binary search is far superior to linear search, and exponentially better than the nested-loop approach.</p>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
