<?php $pageTitle = 'Binary Search Trees (BSTs)'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 11; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Binary Search Trees (BSTs)</h1>
    <p class="lesson-desc">Combine trees with binary search for efficient O(log n) operations — insertion, search, deletion, and balancing.</p>
</div>

<h2>What Is a BST?</h2>
<p>A <strong>Binary Search Tree</strong> is a binary tree where for every node: all values in the <strong>left subtree</strong> are smaller, and all values in the <strong>right subtree</strong> are larger.</p>

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

<h2>BST Operations Complexity</h2>

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

<h2>BST from Sorted Array</h2>
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

<h2>Validate BST</h2>
<pre><code class="language-php">&lt;?php
function isValidBST($node, $min = null, $max = null) {
    if (!$node) return true;
    if ($min !== null && $node->data <= $min) return false;
    if ($max !== null && $node->data >= $max) return false;
    return isValidBST($node->left, $min, $node->data)
        && isValidBST($node->right, $node->data, $max);
}</code></pre>

<h2>Lowest Common Ancestor</h2>
<pre><code class="language-php">&lt;?php
function lowestCommonAncestor($root, $p, $q) {
    if (!$root) return null;
    if ($p < $root->data && $q < $root->data)
        return lowestCommonAncestor($root->left, $p, $q);
    if ($p > $root->data && $q > $root->data)
        return lowestCommonAncestor($root->right, $p, $q);
    return $root->data;  // Split point = LCA
}</code></pre>

<h2>Python Implementation</h2>
<pre><code class="language-python">
class BSTNode:
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
        if not node:
            return BSTNode(data)
        if data < node.data:
            node.left = self._insert_node(node.left, data)
        elif data > node.data:
            node.right = self._insert_node(node.right, data)
        return node

    def search(self, data):
        return self._search_node(self.root, data)

    def _search_node(self, node, data):
        if not node:
            return None
        if data == node.data:
            return node
        if data < node.data:
            return self._search_node(node.left, data)
        return self._search_node(node.right, data)

    def in_order(self):
        result = []
        self._in_order_traversal(self.root, result)
        return result

    def _in_order_traversal(self, node, result):
        if not node:
            return
        self._in_order_traversal(node.left, result)
        result.append(node.data)
        self._in_order_traversal(node.right, result)

    def delete(self, data):
        self.root = self._delete_node(self.root, data)

    def _delete_node(self, node, data):
        if not node:
            return None
        if data < node.data:
            node.left = self._delete_node(node.left, data)
        elif data > node.data:
            node.right = self._delete_node(node.right, data)
        else:
            if not node.left and not node.right:
                return None
            if not node.left:
                return node.right
            if not node.right:
                return node.left
            successor = self._find_min(node.right)
            node.data = successor.data
            node.right = self._delete_node(node.right, successor.data)
        return node

    def _find_min(self, node):
        while node.left:
            node = node.left
        return node

bst = BST()
bst.insert(50)
bst.insert(30)
bst.insert(70)
bst.insert(20)
bst.insert(40)
bst.insert(60)
bst.insert(80)

print(bst.in_order())  # [20, 30, 40, 50, 60, 70, 80]
print("Found" if bst.search(40) else "Not found")  # Found
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
class BSTNode {
    int data;
    BSTNode left, right;

    BSTNode(int data) {
        this.data = data;
        this.left = null;
        this.right = null;
    }
}

class BST {
    private BSTNode root = null;

    public void insert(int data) {
        root = insertNode(root, data);
    }

    private BSTNode insertNode(BSTNode node, int data) {
        if (node == null) return new BSTNode(data);
        if (data < node.data) node.left = insertNode(node.left, data);
        else if (data > node.data) node.right = insertNode(node.right, data);
        return node;
    }

    public BSTNode search(int data) {
        return searchNode(root, data);
    }

    private BSTNode searchNode(BSTNode node, int data) {
        if (node == null) return null;
        if (data == node.data) return node;
        if (data < node.data) return searchNode(node.left, data);
        return searchNode(node.right, data);
    }

    public void inOrder() {
        inOrderTraversal(root);
    }

    private void inOrderTraversal(BSTNode node) {
        if (node == null) return;
        inOrderTraversal(node.left);
        System.out.print(node.data + " ");
        inOrderTraversal(node.right);
    }

    public void delete(int data) {
        root = deleteNode(root, data);
    }

    private BSTNode deleteNode(BSTNode node, int data) {
        if (node == null) return null;
        if (data < node.data) {
            node.left = deleteNode(node.left, data);
        } else if (data > node.data) {
            node.right = deleteNode(node.right, data);
        } else {
            if (node.left == null &amp;&amp; node.right == null) return null;
            if (node.left == null) return node.right;
            if (node.right == null) return node.left;
            BSTNode successor = findMin(node.right);
            node.data = successor.data;
            node.right = deleteNode(node.right, successor.data);
        }
        return node;
    }

    private BSTNode findMin(BSTNode node) {
        while (node.left != null) node = node.left;
        return node;
    }
}

public class Main {
    public static void main(String[] args) {
        BST bst = new BST();
        bst.insert(50);
        bst.insert(30);
        bst.insert(70);
        bst.insert(20);
        bst.insert(40);
        bst.insert(60);
        bst.insert(80);

        bst.inOrder();  // 20 30 40 50 60 70 80
        System.out.println();
        System.out.println(bst.search(40) != null ? "Found" : "Not found"); // Found
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
