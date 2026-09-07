<?php $pageTitle = 'Hash Tables and Hash Maps'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 12; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Hash Tables and Hash Maps</h1>
    <p class="lesson-desc">Understand hashing, collision handling, and how hash tables provide O(1) average-case operations.</p>
</div>

<h2>What Is a Hash Table?</h2>
<p>A <strong>hash table</strong> (hash map) stores key-value pairs using a <strong>hash function</strong> to compute an index into an array of buckets. This enables O(1) average-case lookup, insert, and delete.</p>

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

<h2>How Hashing Works</h2>
<pre>
Key → Hash Function → Hash Code → Index in Array
"juan" → hash("juan") → 847293 → 847293 % 10 = 3 → Bucket 3
</pre>

<h2>Collision Handling</h2>

<h3>1. Chaining (Linked List at Each Bucket)</h3>
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

<h3>2. Open Addressing (Linear Probing)</h3>
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

<h2>Hash Table Complexity</h2>

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
    <p>Distributes keys uniformly across buckets. A bad hash function clusters all keys together, degrading to O(n).</p>
</div>

<h2>Hash Table Applications</h2>
<pre><code class="language-php">&lt;?php
// 1. Frequency Counter
function charFrequency($str) {
    $freq = [];
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        $freq[$char] = ($freq[$char] ?? 0) + 1;
    }
    arsort($freq);
    return $freq;
}
print_r(charFrequency('hello'));  // [l=>2, h=>1, e=>1, o=>1]

// 2. Two Sum Problem
function twoSum($nums, $target) {
    $map = [];
    for ($i = 0; $i < count($nums); $i++) {
        $diff = $target - $nums[$i];
        if (isset($map[$diff])) return [$map[$diff], $i];
        $map[$nums[$i]] = $i;
    }
    return [];
}
print_r(twoSum([2, 7, 11, 15], 9));  // [0, 1]

// 3. Group Anagrams
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

<h2>Python Implementation</h2>
<pre><code class="language-python">
class HashTableChaining:
    def __init__(self, size=16):
        self.size = size
        self.buckets = [[] for _ in range(size)]

    def _hash(self, key):
        hash_val = 0
        for char in str(key):
            hash_val = (hash_val * 31 + ord(char)) % self.size
        return hash_val

    def set(self, key, value):
        index = self._hash(key)
        for i, (k, v) in enumerate(self.buckets[index]):
            if k == key:
                self.buckets[index][i] = (key, value)
                return
        self.buckets[index].append((key, value))

    def get(self, key):
        index = self._hash(key)
        for k, v in self.buckets[index]:
            if k == key:
                return v
        return None

    def remove(self, key):
        index = self._hash(key)
        for i, (k, v) in enumerate(self.buckets[index]):
            if k == key:
                del self.buckets[index][i]
                return True
        return False

ht = HashTableChaining()
ht.set('name', 'Juan')
ht.set('age', 20)
print(ht.get('name'))  # Juan

def two_sum(nums, target):
    seen = {}
    for i, num in enumerate(nums):
        diff = target - num
        if diff in seen:
            return [seen[diff], i]
        seen[num] = i
    return []

print(two_sum([2, 7, 11, 15], 9))  # [0, 1]

def char_frequency(s):
    freq = {}
    for char in s:
        freq[char] = freq.get(char, 0) + 1
    return dict(sorted(freq.items(), key=lambda x: x[1], reverse=True))

print(char_frequency('hello'))  # {'l': 2, 'h': 1, 'e': 1, 'o': 1}
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

class HashTableChaining&lt;K, V&gt; {
    private static class Entry&lt;K, V&gt; {
        K key;
        V value;
        Entry(K key, V value) {
            this.key = key;
            this.value = value;
        }
    }

    private ArrayList&lt;Entry&lt;K, V&gt;&gt;[] buckets;
    private int size;

    @SuppressWarnings("unchecked")
    public HashTableChaining(int size) {
        this.size = size;
        this.buckets = new ArrayList[size];
        for (int i = 0; i &lt; size; i++) {
            buckets[i] = new ArrayList&lt;&gt;();
        }
    }

    private int hash(K key) {
        int hash = 0;
        for (char c : key.toString().toCharArray()) {
            hash = (hash * 31 + c) % size;
        }
        return hash;
    }

    public void set(K key, V value) {
        int index = hash(key);
        for (Entry&lt;K, V&gt; entry : buckets[index]) {
            if (entry.key.equals(key)) {
                entry.value = value;
                return;
            }
        }
        buckets[index].add(new Entry&lt;&gt;(key, value));
    }

    public V get(K key) {
        int index = hash(key);
        for (Entry&lt;K, V&gt; entry : buckets[index]) {
            if (entry.key.equals(key)) return entry.value;
        }
        return null;
    }
}

public class Main {
    public static int[] twoSum(int[] nums, int target) {
        HashMap&lt;Integer, Integer&gt; seen = new HashMap&lt;&gt;();
        for (int i = 0; i &lt; nums.length; i++) {
            int diff = target - nums[i];
            if (seen.containsKey(diff)) {
                return new int[]{seen.get(diff), i};
            }
            seen.put(nums[i], i);
        }
        return new int[]{};
    }

    public static void main(String[] args) {
        HashTableChaining&lt;String, Object&gt; ht = new HashTableChaining&lt;&gt;(16);
        ht.set("name", "Juan");
        ht.set("age", 20);
        System.out.println(ht.get("name"));  // Juan

        int[] result = twoSum(new int[]{2, 7, 11, 15}, 9);
        System.out.println("[" + result[0] + ", " + result[1] + "]");  // [0, 1]
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
