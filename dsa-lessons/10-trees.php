<?php $pageTitle = 'Trees'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Trees</h1>
    <p class="lesson-desc">Understand tree data structures — nodes, edges, traversal methods, and tree terminology.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we dive into tree data structures, let's connect to things you already know. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a family tree? How does it show relationships between grandparents, parents, and children?</li>
        <li>Have you ever used a decision tree — like "If it's raining, take an umbrella; else, wear sunglasses"? How many choices can you make at each step?</li>
        <li>In a linked list, how many "next" pointers does each node have? What would happen if a node could point to two other nodes?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>tree</strong> is a hierarchical data structure consisting of <strong>nodes</strong> connected by <strong>edges</strong>. It has a single <strong>root</strong> node at the top and no cycles (you can't follow a path and end up where you started).</p>

<h3>Analogy</h3>
<p>Think of a <strong>family tree</strong>. Your grandparents are at the top (root). They have children (your parents), who in turn have children (you and your siblings). At the bottom are leaves — family members with no children of their own. Each person is a <strong>node</strong>, and each parent-child relationship is an <strong>edge</strong>.</p>

<h3>How It Works (Step by Step)</h3>

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

<p>A <strong>binary tree</strong> is a tree where each node has at most <strong>2 children</strong> (left and right).</p>

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

<h3>In-Order Traversal (Left → Root → Right)</h3>
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

<h3>Pre-Order Traversal (Root → Left → Right)</h3>
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

<h3>Post-Order Traversal (Left → Right → Root)</h3>
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

<h3>Level-Order Traversal (BFS)</h3>
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

<h3>Tree Properties</h3>
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

<h3>Traversals Summary</h3>

<table>
    <thead><tr><th>Traversal</th><th>Order</th><th>Use Case</th></tr></thead>
    <tbody>
        <tr><td>In-Order</td><td>Left → Root → Right</td><td>BST sorted output</td></tr>
        <tr><td>Pre-Order</td><td>Root → Left → Right</td><td>Copy/serialize tree</td></tr>
        <tr><td>Post-Order</td><td>Left → Right → Root</td><td>Delete tree, evaluate expressions</td></tr>
        <tr><td>Level-Order</td><td>BFS by level</td><td>Shortest path, level processing</td></tr>
    </tbody>
</table>

<h3>Python Implementation</h3>
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

<h3>Java Implementation</h3>
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

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>File Systems</strong> — Folders and files form a tree. Each folder can contain subfolders (children) or files (leaves).</li>
    <li><strong>HTML DOM</strong> — Every HTML element is a node. The <code>&lt;html&gt;</code> tag is the root; <code>&lt;head&gt;</code> and <code>&lt;body&gt;</code> are its children.</li>
    <li><strong>Organizational Charts</strong> — CEO at the root, VPs as children, managers below them, and individual contributors as leaves.</li>
    <li><strong>Expression Trees</strong> — Compilers build trees from mathematical expressions to evaluate them.</li>
    <li><strong>Decision Trees in AI</strong> — Each node is a question, branches are answers, and leaves are decisions.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Draw the tree on paper before writing traversal code — visualizing helps avoid mistakes.</li>
    <li>Remember: <strong>in-order</strong> on a BST always gives sorted output.</li>
    <li><strong>Pre-order</strong> is useful for copying or serializing a tree (you visit the root first).</li>
    <li><strong>Post-order</strong> is useful for deleting a tree (you delete children before the parent).</li>
    <li>Level-order always uses a <strong>queue</strong>; the other three use <strong>recursion</strong> (or an explicit stack).</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use Tree When...</th><th>Use Array/Linked List When...</th></tr></thead>
    <tbody>
        <tr><td>Data is hierarchical (parent-child)</td><td>Data is linear (sequential)</td></tr>
        <tr><td>Need fast search on sorted data (BST)</td><td>Need fast index-based access (array)</td></tr>
        <tr><td>Representing file systems, org charts</td><td>Simple list or stack/queue operations</td></tr>
        <tr><td>Building parsers, compilers, expression evaluation</td><td>Known, fixed-size data</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are given a company's organizational chart represented as a binary tree:</p>
    <pre><code>        CEO (100)
       /        \
    CTO (200)   CFO (300)
    /    \         \
  Dev (400) QA (500) Finance (600)
  /
Intern (700)</code></pre>
    <p><strong>Task:</strong> Perform all 4 traversals on this tree and provide the output for each. Use node values as identifiers.</p>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Expected Answers:</strong></p>
        <pre><code>In-Order (Left → Root → Right):   [400, 700, 200, 500, 100, 600, 300]
Pre-Order (Root → Left → Right):  [100, 200, 400, 700, 500, 300, 600]
Post-Order (Left → Right → Root): [700, 400, 500, 200, 600, 300, 100]
Level-Order (BFS by level):       [100, 200, 300, 400, 500, 600, 700]</code></pre>

        <p><strong>PHP Solution</strong></p>
        <pre><code>&lt;?php
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

$ceo = new TreeNode(100);
$cto = new TreeNode(200);
$cfo = new TreeNode(300);
$dev = new TreeNode(400);
$qa = new TreeNode(500);
$fin = new TreeNode(600);
$intern = new TreeNode(700);

$ceo->left = $cto; $ceo->right = $cfo;
$cto->left = $dev; $cto->right = $qa;
$cfo->right = $fin;
$dev->left = $intern;

function inOrder($node) {
    if (!$node) return [];
    return array_merge(inOrder($node->left), [$node->data], inOrder($node->right));
}
function preOrder($node) {
    if (!$node) return [];
    return array_merge([$node->data], preOrder($node->left), preOrder($node->right));
}
function postOrder($node) {
    if (!$node) return [];
    return array_merge(postOrder($node->left), postOrder($node->right), [$node->data]);
}
function levelOrder($root) {
    if (!$root) return [];
    $result = []; $queue = [$root];
    while (!empty($queue)) {
        $node = array_shift($queue);
        $result[] = $node->data;
        if ($node->left) $queue[] = $node->left;
        if ($node->right) $queue[] = $node->right;
    }
    return $result;
}

print_r(inOrder($ceo));     // [400, 700, 200, 500, 100, 600, 300]
print_r(preOrder($ceo));    // [100, 200, 400, 700, 500, 300, 600]
print_r(postOrder($ceo));   // [700, 400, 500, 200, 600, 300, 100]
print_r(levelOrder($ceo));  // [100, 200, 300, 400, 500, 600, 700]</code></pre>

        <p><strong>Python Solution</strong></p>
        <pre><code>from collections import deque

class TreeNode:
    def __init__(self, data):
        self.data = data
        self.left = None
        self.right = None

ceo = TreeNode(100)
cto = TreeNode(200)
cfo = TreeNode(300)
dev = TreeNode(400)
qa = TreeNode(500)
fin = TreeNode(600)
intern = TreeNode(700)

ceo.left = cto; ceo.right = cfo
cto.left = dev; cto.right = qa
cfo.right = fin
dev.left = intern

def in_order(node):
    if not node: return []
    return in_order(node.left) + [node.data] + in_order(node.right)

def pre_order(node):
    if not node: return []
    return [node.data] + pre_order(node.left) + pre_order(node.right)

def post_order(node):
    if not node: return []
    return post_order(node.left) + post_order(node.right) + [node.data]

def level_order(root):
    if not root: return []
    result, queue = [], deque([root])
    while queue:
        node = queue.popleft()
        result.append(node.data)
        if node.left: queue.append(node.left)
        if node.right: queue.append(node.right)
    return result

print(in_order(ceo))     # [400, 700, 200, 500, 100, 600, 300]
print(pre_order(ceo))    # [100, 200, 400, 700, 500, 300, 600]
print(post_order(ceo))   # [700, 400, 500, 200, 600, 300, 100]
print(level_order(ceo))  # [100, 200, 300, 400, 500, 600, 700]</code></pre>

        <p><strong>Java Solution</strong></p>
        <pre><code>import java.util.*;

class TreeNode {
    int data;
    TreeNode left, right;
    TreeNode(int data) { this.data = data; }
}

public class Main {
    public static List&lt;Integer&gt; inOrder(TreeNode node) {
        List&lt;Integer&gt; r = new ArrayList&lt;&gt;();
        if (node == null) return r;
        r.addAll(inOrder(node.left));
        r.add(node.data);
        r.addAll(inOrder(node.right));
        return r;
    }
    public static List&lt;Integer&gt; preOrder(TreeNode node) {
        List&lt;Integer&gt; r = new ArrayList&lt;&gt;();
        if (node == null) return r;
        r.add(node.data);
        r.addAll(preOrder(node.left));
        r.addAll(preOrder(node.right));
        return r;
    }
    public static List&lt;Integer&gt; postOrder(TreeNode node) {
        List&lt;Integer&gt; r = new ArrayList&lt;&gt;();
        if (node == null) return r;
        r.addAll(postOrder(node.left));
        r.addAll(postOrder(node.right));
        r.add(node.data);
        return r;
    }
    public static List&lt;Integer&gt; levelOrder(TreeNode root) {
        List&lt;Integer&gt; r = new ArrayList&lt;&gt;();
        if (root == null) return r;
        Queue&lt;TreeNode&gt; q = new LinkedList&lt;&gt;();
        q.add(root);
        while (!q.isEmpty()) {
            TreeNode n = q.poll();
            r.add(n.data);
            if (n.left != null) q.add(n.left);
            if (n.right != null) q.add(n.right);
        }
        return r;
    }

    public static void main(String[] args) {
        TreeNode ceo = new TreeNode(100);
        ceo.left = new TreeNode(200);
        ceo.right = new TreeNode(300);
        ceo.left.left = new TreeNode(400);
        ceo.left.right = new TreeNode(500);
        ceo.right.right = new TreeNode(600);
        ceo.left.left.left = new TreeNode(700);

        System.out.println(inOrder(ceo));     // [400, 700, 200, 500, 100, 600, 300]
        System.out.println(preOrder(ceo));    // [100, 200, 400, 700, 500, 300, 600]
        System.out.println(postOrder(ceo));   // [700, 400, 500, 200, 600, 300, 100]
        System.out.println(levelOrder(ceo));  // [100, 200, 300, 400, 500, 600, 700]
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
