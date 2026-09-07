<?php $pageTitle = 'Trees'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Trees</h1>
    <p class="lesson-desc">Understand tree data structures — nodes, edges, traversal methods, and tree terminology.</p>
</div>

<h2>What Is a Tree?</h2>
<p>A <strong>tree</strong> is a hierarchical data structure consisting of <strong>nodes</strong> connected by <strong>edges</strong>. It has a single <strong>root</strong> node and no cycles.</p>

<div class="info-box note">
    <div class="box-title">Tree Terminology</div>
    <p><strong>Root</strong> — Top node (no parent)<br>
    <strong>Parent</strong> — Node with children<br>
    <strong>Child</strong> — Node connected downward<br>
    <strong>Leaf</strong> — Node with no children<br>
    <strong>Height</strong> — Longest path from root to leaf<br>
    <strong>Depth</strong> — Distance from root to a node<br>
    <strong>Subtree</strong> — A tree formed by a node and its descendants</p>
</div>

<h2>Binary Tree</h2>
<p>Each node has at most <strong>2 children</strong> (left and right).</p>

<pre><code class="language-php">&lt;?php
class TreeNode {
    public $data;
    public $left;
    public $right;

    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

// Build a sample tree:
//        1
//       / \
//      2   3
//     / \
//    4   5

$root = new TreeNode(1);
$root->left = new TreeNode(2);
$root->right = new TreeNode(3);
$root->left->left = new TreeNode(4);
$root->left->right = new TreeNode(5);</code></pre>

<h2>Tree Traversals</h2>

<h3>In-Order (Left → Root → Right)</h3>
<pre><code class="language-php">&lt;?php
function inOrder($node) {
    if (!$node) return [];
    return array_merge(
        inOrder($node->left),
        [$node->data],
        inOrder($node->right)
    );
}
// For BST: visits nodes in sorted order
print_r(inOrder($root));  // [4, 2, 5, 1, 3]</code></pre>

<h3>Pre-Order (Root → Left → Right)</h3>
<pre><code class="language-php">&lt;?php
function preOrder($node) {
    if (!$node) return [];
    return array_merge(
        [$node->data],
        preOrder($node->left),
        preOrder($node->right)
    );
}
print_r(preOrder($root));  // [1, 2, 4, 5, 3]</code></pre>

<h3>Post-Order (Left → Right → Root)</h3>
<pre><code class="language-php">&lt;?php
function postOrder($node) {
    if (!$node) return [];
    return array_merge(
        postOrder($node->left),
        postOrder($node->right),
        [$node->data]
    );
}
print_r(postOrder($root));  // [4, 5, 2, 3, 1]</code></pre>

<h3>Level-Order (BFS)</h3>
<pre><code class="language-php">&lt;?php
function levelOrder($root) {
    if (!$root) return [];
    $result = [];
    $queue = [$root];

    while (!empty($queue)) {
        $node = array_shift($queue);
        $result[] = $node->data;
        if ($node->left) $queue[] = $node->left;
        if ($node->right) $queue[] = $node->right;
    }
    return $result;
}

print_r(levelOrder($root));  // [1, 2, 3, 4, 5]</code></pre>

<h2>Tree Properties</h2>
<pre><code class="language-php">&lt;?php
function treeHeight($node) {
    if (!$node) return -1;
    return 1 + max(treeHeight($node->left), treeHeight($node->right));
}

function countNodes($node) {
    if (!$node) return 0;
    return 1 + countNodes($node->left) + countNodes($node->right);
}

function countLeaves($node) {
    if (!$node) return 0;
    if (!$node->left && !$node->right) return 1;
    return countLeaves($node->left) + countLeaves($node->right);
}

echo "Height: " . treeHeight($root) . "\n";    // 2
echo "Nodes: " . countNodes($root) . "\n";      // 5
echo "Leaves: " . countLeaves($root) . "\n";    // 3</code></pre>

<h2>Python Implementation</h2>
<pre><code class="language-python">
from collections import deque

class TreeNode:
    def __init__(self, data):
        self.data = data
        self.left = None
        self.right = None

# Build sample tree:
#        1
#       / \
#      2   3
#     / \
#    4   5

root = TreeNode(1)
root.left = TreeNode(2)
root.right = TreeNode(3)
root.left.left = TreeNode(4)
root.left.right = TreeNode(5)

def in_order(node):
    if not node:
        return []
    return in_order(node.left) + [node.data] + in_order(node.right)

def pre_order(node):
    if not node:
        return []
    return [node.data] + pre_order(node.left) + pre_order(node.right)

def post_order(node):
    if not node:
        return []
    return post_order(node.left) + post_order(node.right) + [node.data]

def level_order(root):
    if not root:
        return []
    result = []
    queue = deque([root])
    while queue:
        node = queue.popleft()
        result.append(node.data)
        if node.left:
            queue.append(node.left)
        if node.right:
            queue.append(node.right)
    return result

print(in_order(root))     # [4, 2, 5, 1, 3]
print(pre_order(root))    # [1, 2, 4, 5, 3]
print(post_order(root))   # [4, 5, 2, 3, 1]
print(level_order(root))  # [1, 2, 3, 4, 5]
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
import java.util.LinkedList;
import java.util.Queue;
import java.util.ArrayList;
import java.util.List;

class TreeNode {
    int data;
    TreeNode left;
    TreeNode right;

    TreeNode(int data) {
        this.data = data;
        this.left = null;
        this.right = null;
    }
}

public class BinaryTree {
    public static List&lt;Integer&gt; inOrder(TreeNode node) {
        List&lt;Integer&gt; result = new ArrayList&lt;&gt;();
        if (node == null) return result;
        result.addAll(inOrder(node.left));
        result.add(node.data);
        result.addAll(inOrder(node.right));
        return result;
    }

    public static List&lt;Integer&gt; preOrder(TreeNode node) {
        List&lt;Integer&gt; result = new ArrayList&lt;&gt;();
        if (node == null) return result;
        result.add(node.data);
        result.addAll(preOrder(node.left));
        result.addAll(preOrder(node.right));
        return result;
    }

    public static List&lt;Integer&gt; postOrder(TreeNode node) {
        List&lt;Integer&gt; result = new ArrayList&lt;&gt;();
        if (node == null) return result;
        result.addAll(postOrder(node.left));
        result.addAll(postOrder(node.right));
        result.add(node.data);
        return result;
    }

    public static List&lt;Integer&gt; levelOrder(TreeNode root) {
        List&lt;Integer&gt; result = new ArrayList&lt;&gt;();
        if (root == null) return result;
        Queue&lt;TreeNode&gt; queue = new LinkedList&lt;&gt;();
        queue.add(root);
        while (!queue.isEmpty()) {
            TreeNode node = queue.poll();
            result.add(node.data);
            if (node.left != null) queue.add(node.left);
            if (node.right != null) queue.add(node.right);
        }
        return result;
    }

    public static void main(String[] args) {
        TreeNode root = new TreeNode(1);
        root.left = new TreeNode(2);
        root.right = new TreeNode(3);
        root.left.left = new TreeNode(4);
        root.left.right = new TreeNode(5);

        System.out.println(inOrder(root));     // [4, 2, 5, 1, 3]
        System.out.println(preOrder(root));    // [1, 2, 4, 5, 3]
        System.out.println(postOrder(root));   // [4, 5, 2, 3, 1]
        System.out.println(levelOrder(root));  // [1, 2, 3, 4, 5]
    }
}
</code></pre>

<h2>Traversals Summary</h2>

<table>
    <thead><tr><th>Traversal</th><th>Order</th><th>Use Case</th></tr></thead>
    <tbody>
        <tr><td>In-Order</td><td>Left → Root → Right</td><td>BST sorted output</td></tr>
        <tr><td>Pre-Order</td><td>Root → Left → Right</td><td>Copy/serialize tree</td></tr>
        <tr><td>Post-Order</td><td>Left → Right → Root</td><td>Delete tree, evaluate expressions</td></tr>
        <tr><td>Level-Order</td><td>BFS by level</td><td>Shortest path, level processing</td></tr>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
