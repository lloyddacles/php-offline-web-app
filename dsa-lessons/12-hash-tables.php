<?php $pageTitle = 'Hash Tables and Hash Maps'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Hash Tables and Hash Maps</h1>
    <p class="lesson-desc">Understand hashing, collision handling, and how hash tables provide O(1) average-case operations.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we dive into hash tables, let's think about how we organize and find information. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How does a librarian find a book? Do they check every shelf, or do they use a filing system to go directly to the right location?</li>
        <li>What is the time complexity for searching in an unsorted array? What if the data were sorted?</li>
        <li>Have you used a PHP associative array like <code>$student['name']</code>? How does PHP know where to find the value for a given key?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>hash table</strong> (hash map) stores key-value pairs using a <strong>hash function</strong> to compute an index into an array of buckets. This enables O(1) average-case lookup, insert, and delete — far faster than searching an array.</p>

<h3>Analogy</h3>
<p>Think of a <strong>library's Dewey Decimal System</strong>. Instead of searching every shelf for a book about "physics," the system tells you exactly which shelf to look at — shelf 530. The hash function works the same way: it takes a key (like a book title) and computes exactly which "shelf" (bucket) to look in. No need to search through everything.</p>

<h3>How It Works (Step by Step)</h3>
<pre>
Key → Hash Function → Hash Code → Index in Array
"juan" → hash("juan") → 847293 → 847293 % 10 = 3 → Bucket 3
</pre>

<p>The <strong>hash function</strong> converts a key into a numeric index. When two keys map to the same index, that's a <strong>collision</strong>. There are two main strategies to handle collisions:</p>

<h3>PHP Arrays (Built-in Hash Maps)</h3>
<pre><code class="language-php">&lt;?php
// PHP arrays ARE hash maps under the hood!
$student = [
    'name'  => 'Juan',
    'age'   => 20,
    'grade' => 'A'
];

// All operations are O(1) average
$student['email'] = 'juan@gcollege.edu';  // Insert
unset($student['age']);                     // Delete
echo $student['name'];                     // Lookup</code></pre>

<h3>Chaining (Linked List at Each Bucket)</h3>
<pre><code class="language-php">&lt;?php
class HashTableChaining {
    private $buckets;
    private $size;

    public function __construct($size = 16) {
        $this->size = $size;
        $this->buckets = array_fill(0, $size, []);
    }

    private function hash($key) {
        $hash = 0;
        for ($i = 0; $i < strlen($key); $i++) {
            $hash = ($hash * 31 + ord($key[$i])) % $this->size;
        }
        return $hash;
    }

    public function set($key, $value) {
        $index = $this->hash($key);
        // Update if key exists
        foreach ($this->buckets[$index] as &$pair) {
            if ($pair[0] === $key) {
                $pair[1] = $value;
                return;
            }
        }
        $this->buckets[$index][] = [$key, $value];
    }

    public function get($key) {
        $index = $this->hash($key);
        foreach ($this->buckets[$index] as $pair) {
            if ($pair[0] === $key) return $pair[1];
        }
        return null;
    }

    public function remove($key) {
        $index = $this->hash($key);
        foreach ($this->buckets[$index] as $i => $pair) {
            if ($pair[0] === $key) {
                unset($this->buckets[$index][$i]);
                return true;
            }
        }
        return false;
    }
}

$ht = new HashTableChaining();
$ht->set('name', 'Juan');
$ht->set('age', 20);
echo $ht->get('name');  // Juan</code></pre>

<h3>Open Addressing (Linear Probing)</h3>
<pre><code class="language-php">&lt;?php
class HashTableLinearProbe {
    private $keys;
    private $values;
    private $size;

    public function __construct($size = 16) {
        $this->size = $size;
        $this->keys = array_fill(0, $size, null);
        $this->values = array_fill(0, $size, null);
    }

    private function hash($key) {
        $hash = 0;
        for ($i = 0; $i < strlen($key); $i++) {
            $hash = ($hash * 31 + ord($key[$i])) % $this->size;
        }
        return $hash;
    }

    public function set($key, $value) {
        $index = $this->hash($key);
        while ($this->keys[$index] !== null && $this->keys[$index] !== $key) {
            $index = ($index + 1) % $this->size;  // Linear probe
        }
        $this->keys[$index] = $key;
        $this->values[$index] = $value;
    }

    public function get($key) {
        $index = $this->hash($key);
        while ($this->keys[$index] !== null) {
            if ($this->keys[$index] === $key) return $this->values[$index];
            $index = ($index + 1) % $this->size;
        }
        return null;
    }
}</code></pre>

<h3>Hash Table Complexity</h3>

<table>
    <thead><tr><th>Operation</th><th>Average</th><th>Worst</th></tr></thead>
    <tbody>
        <tr><td>Insert</td><td>O(1)</td><td>O(n)</td></tr>
        <tr><td>Lookup</td><td>O(1)</td><td>O(n)</td></tr>
        <tr><td>Delete</td><td>O(1)</td><td>O(n)</td></tr>
    </tbody>
</table>

<div class="info-box tip">
    <div class="box-title">Good Hash Function</div>
    <p>Distributes keys uniformly across buckets. A bad hash function clusters all keys together, degrading to O(n). The <strong>load factor</strong> (items / buckets) should stay below 0.75 for good performance.</p>
</div>

<h3>Frequency Counter</h3>
<pre><code class="language-php">&lt;?php
function charFrequency($str) {
    $freq = [];
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        $freq[$char] = ($freq[$char] ?? 0) + 1;
    }
    arsort($freq);
    return $freq;
}
print_r(charFrequency('hello'));  // [l=>2, h=>1, e=>1, o=>1]</code></pre>

<h3>Two Sum Problem</h3>
<pre><code class="language-php">&lt;?php
function twoSum($nums, $target) {
    $map = [];
    for ($i = 0; $i < count($nums); $i++) {
        $diff = $target - $nums[$i];
        if (isset($map[$diff])) return [$map[$diff], $i];
        $map[$nums[$i]] = $i;
    }
    return [];
}
print_r(twoSum([2, 7, 11, 15], 9));  // [0, 1]</code></pre>

<h3>Group Anagrams</h3>
<pre><code class="language-php">&lt;?php
function groupAnagrams($words) {
    $groups = [];
    foreach ($words as $word) {
        $sorted = str_split($word);
        sort($sorted);
        $key = implode('', $sorted);
        $groups[$key][] = $word;
    }
    return array_values($groups);
}
print_r(groupAnagrams(['eat', 'tea', 'tan', 'ate', 'nat', 'bat']));
// [['eat','tea','ate'], ['tan','nat'], ['bat']]</code></pre>

<h3>Python Example: Hash Table (Dictionary)</h3>
<p>A hash table is like a librarian's filing system — use a key to find data instantly.</p>
<pre><code class="language-python"># Python dictionaries ARE hash tables
# Key -> Hash Function -> Index -> Value

# Create a hash table (dictionary)
grades = {}
grades["Juan"] = 95       # Add key-value pair
grades["Maria"] = 88
grades["Pedro"] = 92

# Access by key - O(1) average
print(grades["Juan"])     # 95

# Check if key exists - O(1)
print("Maria" in grades)  # True
print("Ana" in grades)    # False

# Count character frequency using hash table
def count_chars(text):
    freq = {}
    for char in text:
        if char in freq:
            freq[char] += 1    # Already seen, increment
        else:
            freq[char] = 1     # First time, set to 1
    return freq

result = count_chars("hello")
print(result)  # {'h': 1, 'e': 1, 'l': 2, 'o': 1}
</code></pre>
<strong>Output:</strong>
<pre>95
True
False
{'h': 1, 'e': 1, 'l': 2, 'o': 1}</pre>

<h3>Java Example: Hash Table (HashMap)</h3>
<p>A hash table is like a librarian's filing system — use a key to find data instantly.</p>
<pre><code class="language-java">import java.util.HashMap;

public class Main {
    public static void main(String[] args) {
        // Create a HashMap (hash table)
        HashMap&lt;String, Integer&gt; grades = new HashMap&lt;&gt;();
        grades.put("Juan", 95);     // Add key-value pair
        grades.put("Maria", 88);
        grades.put("Pedro", 92);

        // Access by key - O(1) average
        System.out.println(grades.get("Juan"));  // 95

        // Check if key exists - O(1)
        System.out.println(grades.containsKey("Maria"));  // true
        System.out.println(grades.containsKey("Ana"));    // false

        // Count character frequency using HashMap
        String text = "hello";
        HashMap&lt;Character, Integer&gt; freq = new HashMap&lt;&gt;();
        for (char c : text.toCharArray()) {
            freq.put(c, freq.getOrDefault(c, 0) + 1);
        }
        System.out.println(freq);  // {e=1, h=1, l=2, o=1}
    }
}
</code></pre>
<strong>Output:</strong>
<pre>95
true
false
{e=1, h=1, l=2, o=1}</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Dictionaries and Translations</strong> — Word → definition mapping for instant lookups.</li>
    <li><strong>Caches</strong> — Web browsers cache pages using URLs as keys for O(1) retrieval.</li>
    <li><strong>Database Indexes</strong> — Hash indexes enable fast lookups on specific columns without scanning entire tables.</li>
    <li><strong>Sets</strong> — A hash set is a hash table where you only care about keys (no values), used for membership testing.</li>
    <li><strong>Symbols Tables in Compilers</strong> — Variable names → values/types are stored in hash tables during compilation.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>A good hash function distributes keys <strong>uniformly</strong> — bad functions cause collisions and slow down to O(n).</li>
    <li>Keep the <strong>load factor</strong> below 0.75 — resize (double the buckets) when it gets too high.</li>
    <li>Use <strong>chaining</strong> for simplicity; use <strong>open addressing</strong> when memory is tight.</li>
    <li>Hash tables are <strong>unordered</strong> — if you need sorted keys, use a tree-based map instead.</li>
    <li>For the two-sum problem, a hash map gives O(n) time vs. O(n²) with nested loops.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use Hash Table When...</th><th>Use Array/Tree When...</th></tr></thead>
    <tbody>
        <tr><td>Need O(1) average lookup by key</td><td>Need sorted data (use BST)</td></tr>
        <tr><td>Key-value mapping (dictionary, cache)</td><td>Need range queries (use tree)</td></tr>
        <tr><td>Counting frequencies or checking membership</td><td>Need guaranteed O(log n) (use balanced BST)</td></tr>
        <tr><td>Keys are not ordered</td><td>Memory is very constrained</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a text analysis tool. Given the string <code>"hello world"</code>, you need to count the frequency of each character using a hash table. Then, using a separate hash map, solve the classic two-sum problem.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Count the character frequency of <code>"hello world"</code> and show the hash table contents.</li>
        <li>Given the array <code>[3, 5, 2, 7, 1]</code> and target <code>9</code>, use a hash map to find two numbers that add up to the target. Show the hash map at each step.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Step 1: Character Frequency</strong></p>
        <pre><code>Input: "hello world"

Hash table contents:
'h' => 1
'e' => 1
'l' => 3  (appears 3 times: positions 2, 3, 9)
'o' => 2  (appears 2 times: positions 4, 7)
' ' => 1
'w' => 1
'r' => 1
'd' => 1

Sorted by frequency: l(3), o(2), h(1), e(1), ' '(1), w(1), r(1), d(1)</code></pre>

        <p><strong>Step 2: Two-Sum for target 9</strong></p>
        <pre><code>Array: [3, 5, 2, 7, 1], Target: 9

Step-by-step hash map building:
i=0, num=3: need 9-3=6, map={6: NOT found}, map={3:0}
i=1, num=5: need 9-5=4, map={4: NOT found}, map={3:0, 5:1}
i=2, num=2: need 9-2=7, map={7: NOT found}, map={3:0, 5:1, 2:2}
i=3, num=7: need 9-7=2, map={2: FOUND at index 2!} → return [2, 3]

Answer: indices [2, 3] → values 2 + 7 = 9</code></pre>

        <p><strong>PHP Solution</strong></p>
        <pre><code>&lt;?php
// Task 1: Character frequency
function charFrequency($str) {
    $freq = [];
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        $freq[$char] = ($freq[$char] ?? 0) + 1;
    }
    arsort($freq);
    return $freq;
}

echo "Character frequency of 'hello world':\n";
print_r(charFrequency('hello world'));

// Task 2: Two Sum
function twoSum($nums, $target) {
    $map = [];
    for ($i = 0; $i < count($nums); $i++) {
        $diff = $target - $nums[$i];
        if (isset($map[$diff])) {
            echo "Found: {$nums[$map[$diff]]} + {$nums[$i]} = $target\n";
            return [$map[$diff], $i];
        }
        $map[$nums[$i]] = $i;
    }
    return [];
}

echo "\nTwo-sum for [3,5,2,7,1] target 9:\n";
print_r(twoSum([3, 5, 2, 7, 1], 9));  // [2, 3]</code></pre>

        <p><strong>Python Solution</strong></p>
        <pre><code># Task 1: Character frequency
def char_frequency(s):
    freq = {}
    for char in s:
        freq[char] = freq.get(char, 0) + 1
    return dict(sorted(freq.items(), key=lambda x: x[1], reverse=True))

print("Character frequency of 'hello world':")
print(char_frequency('hello world'))

# Task 2: Two Sum
def two_sum(nums, target):
    seen = {}
    for i, num in enumerate(nums):
        diff = target - num
        if diff in seen:
            print(f"Found: {seen[diff]} ({nums[seen[diff]]}) + {i} ({num}) = {target}")
            return [seen[diff], i]
        seen[num] = i
    return []

print("\nTwo-sum for [3,5,2,7,1] target 9:")
print(two_sum([3, 5, 2, 7, 1], 9))  # [2, 3]</code></pre>

        <p><strong>Java Solution</strong></p>
        <pre><code>import java.util.HashMap;

public class Main {
    // Task 1: Character frequency
    public static void charFrequency(String str) {
        HashMap&lt;Character, Integer&gt; freq = new HashMap&lt;&gt;();
        for (char c : str.toCharArray()) {
            freq.put(c, freq.getOrDefault(c, 0) + 1);
        }
        System.out.println("Character frequency of 'hello world':");
        System.out.println(freq);
    }

    // Task 2: Two Sum
    public static int[] twoSum(int[] nums, int target) {
        HashMap&lt;Integer, Integer&gt; seen = new HashMap&lt;&gt;();
        for (int i = 0; i &lt; nums.length; i++) {
            int diff = target - nums[i];
            if (seen.containsKey(diff)) {
                System.out.println("Found: " + nums[seen.get(diff)] + " + " + nums[i] + " = " + target);
                return new int[]{seen.get(diff), i};
            }
            seen.put(nums[i], i);
        }
        return new int[]{};
    }

    public static void main(String[] args) {
        charFrequency("hello world");

        System.out.println("\nTwo-sum for [3,5,2,7,1] target 9:");
        int[] result = twoSum(new int[]{3, 5, 2, 7, 1}, 9);
        System.out.println("Indices: [" + result[0] + ", " + result[1] + "]");
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
