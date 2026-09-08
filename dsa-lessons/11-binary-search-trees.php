<?php $pageTitle = 'Binary Search Trees (BSTs)'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 11; $sectionDir = 'dsa-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Binary Search Trees (BSTs)</h1>
    <p class="lesson-desc">Combine trees with binary search for efficient O(log n) operations — insertion, search, deletion, and balancing.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we learn about BSTs, let's connect to concepts you already know. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How does a dictionary work? When you look up a word, do you start from page 1 or do you jump to the middle and narrow down?</li>
        <li>What is the time complexity of binary search on a sorted array? Why is sorted data useful?</li>
        <li>In the previous lesson, what are the four types of tree traversals? Which one visits nodes in sorted order for a BST?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>Binary Search Tree (BST)</strong> is a binary tree where for every node: all values in the <strong>left subtree</strong> are smaller, and all values in the <strong>right subtree</strong> are larger. This property enables efficient searching.</p>

<h3>Analogy</h3>
<p>Imagine a <strong>dictionary</strong>. You don't read every page to find a word. You open to the middle — if your word comes before alphabetically, you search the left half; if after, the right half. Each time you cut the remaining pages in half. A BST works the same way: at each node, you go left (smaller) or right (larger), halving the search space each time.</p>

<h3>How It Works (Step by Step)</h3>

<div class="info-box note">
    <div class="box-title">BST Property</div>
    <p>For any node N:<br>
    <strong>left subtree</strong>.all values &lt; N.value<br>
    <strong>right subtree</strong>.all values &gt; N.value</p>
</div>

<pre><code class="language-php">&lt;?php
class BSTNode {
    public $data;
    public $left;
    public $right;

    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BST {
    private $root = null;

    public function insert($data) {
        $this->root = $this->insertNode($this->root, $data);
    }

    private function insertNode($node, $data) {
        if (!$node) return new BSTNode($data);
        if ($data < $node->data) $node->left = $this->insertNode($node->left, $data);
        elseif ($data > $node->data) $node->right = $this->insertNode($node->right, $data);
        return $node;  // No duplicates
    }

    public function search($data) {
        return $this->searchNode($this->root, $data);
    }

    private function searchNode($node, $data) {
        if (!$node) return null;
        if ($data === $node->data) return $node;
        if ($data < $node->data) return $this->searchNode($node->left, $data);
        return $this->searchNode($node->right, $data);
    }

    public function inOrder() {
        $result = [];
        $this->inOrderTraversal($this->root, $result);
        return $result;
    }

    private function inOrderTraversal($node, &$result) {
        if (!$node) return;
        $this->inOrderTraversal($node->left, $result);
        $result[] = $node->data;
        $this->inOrderTraversal($node->right, $result);
    }

    public function delete($data) {
        $this->root = $this->deleteNode($this->root, $data);
    }

    private function deleteNode($node, $data) {
        if (!$node) return null;
        if ($data < $node->data) {
            $node->left = $this->deleteNode($node->left, $data);
        } elseif ($data > $node->data) {
            $node->right = $this->deleteNode($node->right, $data);
        } else {
            // Node found
            if (!$node->left && !$node->right) return null;       // Leaf
            if (!$node->left) return $node->right;                 // One child
            if (!$node->right) return $node->left;                 // One child
            // Two children: replace with in-order successor
            $successor = $this->findMin($node->right);
            $node->data = $successor->data;
            $node->right = $this->deleteNode($node->right, $successor->data);
        }
        return $node;
    }

    private function findMin($node) {
        while ($node->left) $node = $node->left;
        return $node;
    }
}

$bst = new BST();
$bst->insert(50);
$bst->insert(30);
$bst->insert(70);
$bst->insert(20);
$bst->insert(40);
$bst->insert(60);
$bst->insert(80);

print_r($bst->inOrder());  // [20, 30, 40, 50, 60, 70, 80]
echo $bst->search(40) ? "Found" : "Not found";  // Found</code></pre>

<h3>BST Operations Complexity</h3>

<table>
    <thead><tr><th>Operation</th><th>Average</th><th>Worst (skewed)</th></tr></thead>
    <tbody>
        <tr><td>Search</td><td>O(log n)</td><td>O(n)</td></tr>
        <tr><td>Insert</td><td>O(log n)</td><td>O(n)</td></tr>
        <tr><td>Delete</td><td>O(log n)</td><td>O(n)</td></tr>
    </tbody>
</table>

<div class="info-box warning">
    <div class="box-title">Skewed Tree Problem</div>
    <p>If elements are inserted in sorted order, the BST becomes a linked list with O(n) operations. Solution: use <strong>self-balancing trees</strong> (AVL, Red-Black).</p>
</div>

<h3>BST from Sorted Array</h3>
<pre><code class="language-php">&lt;?php
function sortedArrayToBST($arr, $left = 0, $right = null) {
    if ($right === null) $right = count($arr) - 1;
    if ($left > $right) return null;

    $mid = intdiv($left + $right, 2);
    $node = new BSTNode($arr[$mid]);
    $node->left = sortedArrayToBST($arr, $left, $mid - 1);
    $node->right = sortedArrayToBST($arr, $mid + 1, $right);
    return $node;
}

// Creates a balanced BST from sorted array
$arr = [1, 2, 3, 4, 5, 6, 7];
$balanced = sortedArrayToBST($arr);</code></pre>

<h3>Validate BST</h3>
<pre><code class="language-php">&lt;?php
function isValidBST($node, $min = null, $max = null) {
    if (!$node) return true;
    if ($min !== null && $node->data <= $min) return false;
    if ($max !== null && $node->data >= $max) return false;
    return isValidBST($node->left, $min, $node->data)
        && isValidBST($node->right, $node->data, $max);
}</code></pre>

<h3>Lowest Common Ancestor</h3>
<pre><code class="language-php">&lt;?php
function lowestCommonAncestor($root, $p, $q) {
    if (!$root) return null;
    if ($p < $root->data && $q < $root->data)
        return lowestCommonAncestor($root->left, $p, $q);
    if ($p > $root->data && $q > $root->data)
        return lowestCommonAncestor($root->right, $p, $q);
    return $root->data;  // Split point = LCA
}</code></pre>

<h3>Python Example: BST Insert and Search</h3>
<p>A BST is like a dictionary — smaller values go left, bigger values go right.</p>
<pre><code class="language-python">class BSTNode:
    def __init__(self, data):
        self.data = data
        self.left = None     # Smaller values
        self.right = None    # Bigger values

# Insert a value into BST
def insert(node, data):
    if node is None:
        return BSTNode(data)
    if data < node.data:
        node.left = insert(node.left, data)    # Go left
    else:
        node.right = insert(node.right, data)  # Go right
    return node

# Search for a value in BST
def search(node, data):
    if node is None or node.data == data:
        return node
    if data < node.data:
        return search(node.left, data)    # Search left
    return search(node.right, data)       # Search right

# In-order traversal (gives sorted order)
def in_order(node):
    if node:
        in_order(node.left)
        print(node.data, end=" ")
        in_order(node.right)

# Build BST with values: 50, 30, 70, 20, 40
root = None
for val in [50, 30, 70, 20, 40]:
    root = insert(root, val)

in_order(root)          # 20 30 40 50 70 (sorted!)
result = search(root, 40)
print()
print(result.data)      # 40 (found!)
result = search(root, 99)
print(result)           # None (not found)
</code></pre>
<strong>Output:</strong>
<pre>20 30 40 50 70
40
None</pre>

<h3>Java Example: BST Insert and Search</h3>
<p>A BST is like a dictionary — smaller values go left, bigger values go right.</p>
<pre><code class="language-java">public class Main {
    static class BSTNode {
        int data;
        BSTNode left, right;

        BSTNode(int data) {
            this.data = data;
            this.left = null;
            this.right = null;
        }
    }

    // Insert a value into BST
    static BSTNode insert(BSTNode node, int data) {
        if (node == null) return new BSTNode(data);
        if (data < node.data) {
            node.left = insert(node.left, data);    // Go left
        } else {
            node.right = insert(node.right, data);  // Go right
        }
        return node;
    }

    // Search for a value in BST
    static BSTNode search(BSTNode node, int data) {
        if (node == null || node.data == data) return node;
        if (data < node.data) return search(node.left, data);   // Search left
        return search(node.right, data);                         // Search right
    }

    // In-order traversal (gives sorted order)
    static void inOrder(BSTNode node) {
        if (node != null) {
            inOrder(node.left);
            System.out.print(node.data + " ");
            inOrder(node.right);
        }
    }

    public static void main(String[] args) {
        BSTNode root = null;
        int[] values = {50, 30, 70, 20, 40};
        for (int val : values) {
            root = insert(root, val);
        }

        inOrder(root);  // 20 30 40 50 70 (sorted!)
        System.out.println();

        BSTNode result = search(root, 40);
        System.out.println(result.data);  // 40 (found!)

        result = search(root, 99);
        System.out.println(result);  // null (not found)
    }
}
</code></pre>
<strong>Output:</strong>
<pre>20 30 40 50 70
40
null</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Database Indexing</strong> — B-trees (a generalization of BSTs) are used in databases for fast lookups, range queries, and sorting.</li>
    <li><strong>Auto-Complete</strong> — A BST (specifically a trie) stores possible word completions; searching narrows down suggestions.</li>
    <li><strong>Expression Trees</strong> — Compilers use BST-like structures to parse and evaluate mathematical expressions.</li>
    <li><strong>File System Directories</strong> — Sorted tree structures help locate files quickly.</li>
    <li><strong>Game Decision Trees</strong> — AI uses tree structures to evaluate possible moves and choose optimal strategies.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always check if your BST is becoming <strong>skewed</strong> — if all inserts are in order, you get O(n) performance.</li>
    <li>Use <code>inOrder()</code> to verify your BST is correct — it should return sorted values.</li>
    <li>For deletion with two children, always replace with the <strong>in-order successor</strong> (smallest in right subtree).</li>
    <li>When building a BST from a sorted array, use the middle element as root for a <strong>balanced</strong> tree.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use BST When...</th><th>Use Array When...</th></tr></thead>
    <tbody>
        <tr><td>Need sorted data with fast insert/search</td><td>Data rarely changes</td></tr>
        <tr><td>Need range queries (find all values between X and Y)</td><td>Need O(1) index access</td></tr>
        <tr><td>Data is naturally hierarchical</td><td>Data is small and simple</td></tr>
        <tr><td>Need to maintain sorted order dynamically</td><td>Can sort once and search</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a contact directory system. Contacts are stored in a BST where the key is the contact's numeric ID.</p>
    <p><strong>Task:</strong> Given the following sequence of operations, show the tree at each step and answer the questions:</p>
    <ol>
        <li>Insert IDs: 50, 30, 70, 20, 40, 60, 80 (build the initial BST)</li>
        <li>Search for ID 40 — what path is traversed?</li>
        <li>Search for ID 25 — what path is traversed and what is the result?</li>
        <li>Delete node 30 (which has two children) — show the tree after deletion.</li>
        <li>Perform an in-order traversal after deletion — what is the output?</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Step 1: Initial BST after all inserts</strong></p>
        <pre><code>        50
       /  \
      30   70
     / \   / \
    20  40 60  80</code></pre>

        <p><strong>Step 2: Search for 40</strong></p>
        <pre><code>Path: 50 → 30 → 40 (found!)
Compare 40 with 50: go left (40 < 50)
Compare 40 with 30: go right (40 > 30)
Compare 40 with 40: found!</code></pre>

        <p><strong>Step 3: Search for 25</strong></p>
        <pre><code>Path: 50 → 30 → 20 → null (not found)
Compare 25 with 50: go left (25 < 50)
Compare 25 with 30: go left (25 < 30)
Compare 25 with 20: go right (25 > 20)
20 has no right child → not found</code></pre>

        <p><strong>Step 4: After deleting node 30</strong></p>
        <pre><code>Node 30 has two children.
In-order successor = 40 (smallest in right subtree of 30).
Replace 30's value with 40, then delete the original 40 node.

        50
       /  \
      40   70
     /    / \
    20   60  80</code></pre>

        <p><strong>Step 5: In-order traversal after deletion</strong></p>
        <pre><code>Output: [20, 40, 50, 60, 70, 80]</code></pre>

        <p><strong>PHP Solution</strong></p>
        <pre><code>&lt;?php
class BSTNode {
    public $data;
    public $left;
    public $right;
    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BST {
    private $root = null;

    public function insert($data) {
        $this->root = $this->insertNode($this->root, $data);
    }

    private function insertNode($node, $data) {
        if (!$node) return new BSTNode($data);
        if ($data < $node->data) $node->left = $this->insertNode($node->left, $data);
        elseif ($data > $node->data) $node->right = $this->insertNode($node->right, $data);
        return $node;
    }

    public function search($data) {
        return $this->searchNode($this->root, $data);
    }

    private function searchNode($node, $data) {
        if (!$node) return null;
        if ($data === $node->data) return $node;
        if ($data < $node->data) return $this->searchNode($node->left, $data);
        return $this->searchNode($node->right, $data);
    }

    public function delete($data) {
        $this->root = $this->deleteNode($this->root, $data);
    }

    private function deleteNode($node, $data) {
        if (!$node) return null;
        if ($data < $node->data) {
            $node->left = $this->deleteNode($node->left, $data);
        } elseif ($data > $node->data) {
            $node->right = $this->deleteNode($node->right, $data);
        } else {
            if (!$node->left && !$node->right) return null;
            if (!$node->left) return $node->right;
            if (!$node->right) return $node->left;
            $successor = $this->findMin($node->right);
            $node->data = $successor->data;
            $node->right = $this->deleteNode($node->right, $successor->data);
        }
        return $node;
    }

    private function findMin($node) {
        while ($node->left) $node = $node->left;
        return $node;
    }

    public function inOrder() {
        $result = [];
        $this->inOrderTraversal($this->root, $result);
        return $result;
    }

    private function inOrderTraversal($node, &$result) {
        if (!$node) return;
        $this->inOrderTraversal($node->left, $result);
        $result[] = $node->data;
        $this->inOrderTraversal($node->right, $result);
    }
}

$bst = new BST();
foreach ([50, 30, 70, 20, 40, 60, 80] as $id) $bst->insert($id);

$found = $bst->search(40);
echo $found ? "Found 40\n" : "40 not found\n";

$notFound = $bst->search(25);
echo $notFound ? "Found 25\n" : "25 not found\n";

$bst->delete(30);
print_r($bst->inOrder());  // [20, 40, 50, 60, 70, 80]</code></pre>

        <p><strong>Python Solution</strong></p>
        <pre><code>class BSTNode:
    def __init__(self, data):
        self.data = data
        self.left = None
        self.right = None

class BST:
    def __init__(self):
        self.root = None

    def insert(self, data):
        self.root = self._insert_node(self.root, data)

    def _insert_node(self, node, data):
        if not node: return BSTNode(data)
        if data < node.data:
            node.left = self._insert_node(node.left, data)
        elif data > node.data:
            node.right = self._insert_node(node.right, data)
        return node

    def search(self, data):
        return self._search_node(self.root, data)

    def _search_node(self, node, data):
        if not node: return None
        if data == node.data: return node
        if data < node.data: return self._search_node(node.left, data)
        return self._search_node(node.right, data)

    def delete(self, data):
        self.root = self._delete_node(self.root, data)

    def _delete_node(self, node, data):
        if not node: return None
        if data < node.data:
            node.left = self._delete_node(node.left, data)
        elif data > node.data:
            node.right = self._delete_node(node.right, data)
        else:
            if not node.left and not node.right: return None
            if not node.left: return node.right
            if not node.right: return node.left
            successor = self._find_min(node.right)
            node.data = successor.data
            node.right = self._delete_node(node.right, successor.data)
        return node

    def _find_min(self, node):
        while node.left: node = node.left
        return node

    def in_order(self):
        result = []
        self._in_order(self.root, result)
        return result

    def _in_order(self, node, result):
        if not node: return
        self._in_order(node.left, result)
        result.append(node.data)
        self._in_order(node.right, result)

bst = BST()
for id in [50, 30, 70, 20, 40, 60, 80]:
    bst.insert(id)

print("Found 40" if bst.search(40) else "40 not found")
print("Found 25" if bst.search(25) else "25 not found")
bst.delete(30)
print(bst.in_order())  # [20, 40, 50, 60, 70, 80]</code></pre>

        <p><strong>Java Solution</strong></p>
        <pre><code>class BSTNode {
    int data;
    BSTNode left, right;
    BSTNode(int data) { this.data = data; }
}

class BST {
    private BSTNode root = null;

    public void insert(int data) { root = insertNode(root, data); }
    private BSTNode insertNode(BSTNode node, int data) {
        if (node == null) return new BSTNode(data);
        if (data < node.data) node.left = insertNode(node.left, data);
        else if (data > node.data) node.right = insertNode(node.right, data);
        return node;
    }

    public BSTNode search(int data) { return searchNode(root, data); }
    private BSTNode searchNode(BSTNode node, int data) {
        if (node == null) return null;
        if (data == node.data) return node;
        if (data < node.data) return searchNode(node.left, data);
        return searchNode(node.right, data);
    }

    public void delete(int data) { root = deleteNode(root, data); }
    private BSTNode deleteNode(BSTNode node, int data) {
        if (node == null) return null;
        if (data < node.data) node.left = deleteNode(node.left, data);
        else if (data > node.data) node.right = deleteNode(node.right, data);
        else {
            if (node.left == null &amp;&amp; node.right == null) return null;
            if (node.left == null) return node.right;
            if (node.right == null) return node.left;
            BSTNode succ = findMin(node.right);
            node.data = succ.data;
            node.right = deleteNode(node.right, succ.data);
        }
        return node;
    }
    private BSTNode findMin(BSTNode node) {
        while (node.left != null) node = node.left;
        return node;
    }

    public void inOrder() { inOrderTraversal(root); }
    private void inOrderTraversal(BSTNode node) {
        if (node == null) return;
        inOrderTraversal(node.left);
        System.out.print(node.data + " ");
        inOrderTraversal(node.right);
    }
}

public class Main {
    public static void main(String[] args) {
        BST bst = new BST();
        for (int id : new int[]{50, 30, 70, 20, 40, 60, 80}) bst.insert(id);

        System.out.println(bst.search(40) != null ? "Found 40" : "40 not found");
        System.out.println(bst.search(25) != null ? "Found 25" : "25 not found");
        bst.delete(30);
        bst.inOrder();  // 20 40 50 60 70 80
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
