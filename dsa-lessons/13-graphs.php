<?php $pageTitle = 'Graphs and Graph Traversal Algorithms'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 13; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Graphs and Graph Traversal Algorithms</h1>
    <p class="lesson-desc">Learn about directed/undirected graphs, adjacency lists, BFS, DFS, and shortest path algorithms.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before diving into graphs, consider what you already know about connected structures. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>How is a tree different from an array? What makes trees useful for hierarchical data?</li>
        <li>In a linked list, how do you traverse from one node to the next? What would happen if nodes could point to multiple neighbors?</li>
        <li>What is a queue and a stack? How do their FIFO and LIFO behaviors affect traversal order?</li>
        <li>What is the time complexity of searching through an unsorted array vs a sorted array?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>graph</strong> G = (V, E) consists of <strong>vertices</strong> (nodes) and <strong>edges</strong> (connections between nodes). Unlike trees, graphs can have cycles and nodes can have multiple connections.</p>

<h3>Analogy</h3>
<p>Think of a social network: each person is a vertex, and each friendship is an edge. On Facebook, friendships are mutual (undirected). On Twitter, following is one-way (directed). The distance or strength of a connection can be a weight.</p>

<h3>How It Works (Step by Step)</h3>
<p><strong>Graph Types:</strong></p>
<table>
    <thead><tr><th>Type</th><th>Description</th><th>Example</th></tr></thead>
    <tbody>
        <tr><td><strong>Undirected</strong></td><td>Edges go both ways</td><td>Facebook friends</td></tr>
        <tr><td><strong>Directed</strong></td><td>Edges have direction</td><td>Twitter followers</td></tr>
        <tr><td><strong>Weighted</strong></td><td>Edges have costs</td><td>GPS distances</td></tr>
        <tr><td><strong>Unweighted</strong></td><td>All edges equal</td><td>Social network</td></tr>
    </tbody>
</table>

<h3>Graph Representations</h3>

<h4>Adjacency List (Recommended)</h4>
<pre><code class="language-php">&lt;?php
// Undirected graph using adjacency list
$graph = [
    'A' => ['B', 'C'],
    'B' => ['A', 'D', 'E'],
    'C' => ['A', 'F'],
    'D' => ['B'],
    'E' => ['B', 'F'],
    'F' => ['C', 'E']
];</code></pre>

<h4>Adjacency Matrix</h4>
<pre><code class="language-php">&lt;?php
//  0  1  2  3  4  5
$matrix = [
    [0, 1, 1, 0, 0, 0],  // A
    [1, 0, 0, 1, 1, 0],  // B
    [1, 0, 0, 0, 0, 1],  // C
    [0, 1, 0, 0, 0, 0],  // D
    [0, 1, 0, 0, 0, 1],  // E
    [0, 0, 1, 0, 1, 0],  // F
];</code></pre>

<h3>BFS — Breadth-First Search</h3>
<p>Explores all neighbors at the current depth before moving deeper. Uses a <strong>queue</strong>.</p>
<pre><code class="language-php">&lt;?php
function bfs($graph, $start) {
    $visited = [$start => true];
    $queue = [$start];
    $order = [];

    while (!empty($queue)) {
        $node = array_shift($queue);
        $order[] = $node;

        foreach ($graph[$node] as $neighbor) {
            if (!isset($visited[$neighbor])) {
                $visited[$neighbor] = true;
                $queue[] = $neighbor;
            }
        }
    }
    return $order;
}

print_r(bfs($graph, 'A'));  // A, B, C, D, E, F</code></pre>

<h3>DFS — Depth-First Search</h3>
<p>Goes as deep as possible before backtracking. Uses a <strong>stack</strong> (or recursion).</p>
<pre><code class="language-php">&lt;?php
function dfs($graph, $start) {
    $visited = [];
    $stack = [$start];
    $order = [];

    while (!empty($stack)) {
        $node = array_pop($stack);
        if (isset($visited[$node])) continue;
        $visited[$node] = true;
        $order[] = $node;

        foreach ($graph[$node] as $neighbor) {
            if (!isset($visited[$neighbor])) {
                $stack[] = $neighbor;
            }
        }
    }
    return $order;
}

print_r(dfs($graph, 'A'));  // A, C, F, E, B, D (varies)</code></pre>

<h4>Recursive DFS</h4>
<pre><code class="language-php">&lt;?php
function dfsRecursive($graph, $node, &$visited = []) {
    $visited[$node] = true;
    $order = [$node];
    foreach ($graph[$node] as $neighbor) {
        if (!isset($visited[$neighbor])) {
            $order = array_merge($order, dfsRecursive($graph, $neighbor, $visited));
        }
    }
    return $order;
}</code></pre>

<h3>BFS vs DFS Comparison</h3>
<table>
    <thead><tr><th>Feature</th><th>BFS</th><th>DFS</th></tr></thead>
    <tbody>
        <tr><td>Data structure</td><td>Queue</td><td>Stack / Recursion</td></tr>
        <tr><td>Shortest path (unweighted)</td><td>Yes</td><td>No</td></tr>
        <tr><td>Memory usage</td><td>O(w) — width</td><td>O(h) — height</td></tr>
        <tr><td>Use case</td><td>Level-order, shortest path</td><td>Topological sort, cycles</td></tr>
    </tbody>
</table>

<h3>Dijkstra's Shortest Path (Weighted)</h3>
<pre><code class="language-php">&lt;?php
function dijkstra($graph, $start) {
    $dist = array_fill_keys(array_keys($graph), INF);
    $dist[$start] = 0;
    $visited = [];
    $pq = [['node' => $start, 'dist' => 0]];  // Min-heap simulation

    while (!empty($pq)) {
        usort($pq, fn($a, $b) => $a['dist'] <=> $b['dist']);
        $current = array_shift($pq);
        $node = $current['node'];

        if (isset($visited[$node])) continue;
        $visited[$node] = true;

        foreach ($graph[$node] as ['node' => $neighbor, 'weight' => $weight]) {
            $newDist = $dist[$node] + $weight;
            if ($newDist < $dist[$neighbor]) {
                $dist[$neighbor] = $newDist;
                $pq[] = ['node' => $neighbor, 'dist' => $newDist];
            }
        }
    }
    return $dist;
}

$weighted = [
    'A' => [['node' => 'B', 'weight' => 4], ['node' => 'C', 'weight' => 2]],
    'B' => [['node' => 'C', 'weight' => 1], ['node' => 'D', 'weight' => 5]],
    'C' => [['node' => 'D', 'weight' => 8]],
    'D' => []
];
print_r(dijkstra($weighted, 'A'));  // A=>0, B=>4, C=>2, D=>9</code></pre>

<h3>Detecting Cycles</h3>
<pre><code class="language-php">&lt;?php
function hasCycle($graph) {
    $visited = [];
    $recStack = [];

    function dfs($node) {
        global $visited, $recStack, $graph;
        $visited[$node] = true;
        $recStack[$node] = true;

        foreach ($graph[$node] as $neighbor) {
            if (!isset($visited[$neighbor])) {
                if (dfs($neighbor)) return true;
            } elseif (isset($recStack[$neighbor])) {
                return true;
            }
        }
        unset($recStack[$node]);
        return false;
    }

    foreach (array_keys($graph) as $node) {
        if (!isset($visited[$node]) && dfs($node)) return true;
    }
    return false;
}</code></pre>

<h3>Python Implementation</h3>
<pre><code class="language-python">
from collections import deque
import heapq

def bfs(graph, start):
    visited = {start}
    queue = deque([start])
    order = []
    while queue:
        node = queue.popleft()
        order.append(node)
        for neighbor in graph[node]:
            if neighbor not in visited:
                visited.add(neighbor)
                queue.append(neighbor)
    return order

def dfs(graph, start):
    visited = set()
    stack = [start]
    order = []
    while stack:
        node = stack.pop()
        if node in visited:
            continue
        visited.add(node)
        order.append(node)
        for neighbor in graph[node]:
            if neighbor not in visited:
                stack.append(neighbor)
    return order

def dfs_recursive(graph, node, visited=None):
    if visited is None:
        visited = set()
    visited.add(node)
    order = [node]
    for neighbor in graph[node]:
        if neighbor not in visited:
            order.extend(dfs_recursive(graph, neighbor, visited))
    return order

def dijkstra(graph, start):
    dist = {node: float('inf') for node in graph}
    dist[start] = 0
    pq = [(0, start)]
    visited = set()

    while pq:
        current_dist, node = heapq.heappop(pq)
        if node in visited:
            continue
        visited.add(node)
        for neighbor, weight in graph[node]:
            new_dist = current_dist + weight
            if new_dist < dist[neighbor]:
                dist[neighbor] = new_dist
                heapq.heappush(pq, (new_dist, neighbor))
    return dist

graph = {
    'A': ['B', 'C'],
    'B': ['A', 'D', 'E'],
    'C': ['A', 'F'],
    'D': ['B'],
    'E': ['B', 'F'],
    'F': ['C', 'E']
}

print(bfs(graph, 'A'))  # ['A', 'B', 'C', 'D', 'E', 'F']
print(dfs(graph, 'A'))  # ['A', 'C', 'F', 'E', 'B', 'D']

weighted = {
    'A': [('B', 4), ('C', 2)],
    'B': [('C', 1), ('D', 5)],
    'C': [('D', 8)],
    'D': []
}
print(dijkstra(weighted, 'A'))  # {'A': 0, 'B': 4, 'C': 2, 'D': 9}
</code></pre>

<h3>Java Implementation</h3>
<pre><code class="language-java">
import java.util.*;

public class Graph {
    public static List&lt;String&gt; bfs(HashMap&lt;String, List&lt;String&gt;&gt; graph, String start) {
        List&lt;String&gt; order = new ArrayList&lt;&gt;();
        Queue&lt;String&gt; queue = new LinkedList&lt;&gt;();
        HashSet&lt;String&gt; visited = new HashSet&lt;&gt;();
        queue.add(start);
        visited.add(start);

        while (!queue.isEmpty()) {
            String node = queue.poll();
            order.add(node);
            for (String neighbor : graph.get(node)) {
                if (!visited.contains(neighbor)) {
                    visited.add(neighbor);
                    queue.add(neighbor);
                }
            }
        }
        return order;
    }

    public static List&lt;String&gt; dfs(HashMap&lt;String, List&lt;String&gt;&gt; graph, String start) {
        List&lt;String&gt; order = new ArrayList&lt;&gt;();
        HashSet&lt;String&gt; visited = new HashSet&lt;&gt;();
        Stack&lt;String&gt; stack = new Stack&lt;&gt;();
        stack.push(start);

        while (!stack.isEmpty()) {
            String node = stack.pop();
            if (visited.contains(node)) continue;
            visited.add(node);
            order.add(node);
            for (String neighbor : graph.get(node)) {
                if (!visited.contains(neighbor)) {
                    stack.push(neighbor);
                }
            }
        }
        return order;
    }

    public static List&lt;String&gt; dfsRecursive(HashMap&lt;String, List&lt;String&gt;&gt; graph, String node, HashSet&lt;String&gt; visited) {
        visited.add(node);
        List&lt;String&gt; order = new ArrayList&lt;&gt;();
        order.add(node);
        for (String neighbor : graph.get(node)) {
            if (!visited.contains(neighbor)) {
                order.addAll(dfsRecursive(graph, neighbor, visited));
            }
        }
        return order;
    }

    public static HashMap&lt;String, Integer&gt; dijkstra(HashMap&lt;String, List&lt;int[]&gt;&gt; graph, String start) {
        HashMap&lt;String, Integer&gt; dist = new HashMap&lt;&gt;();
        for (String node : graph.keySet()) dist.put(node, Integer.MAX_VALUE);
        dist.put(start, 0);

        PriorityQueue&lt;int[]&gt; pq = new PriorityQueue&lt;&gt;(Comparator.comparingInt(a -&gt; a[1]));
        pq.add(new int[]{start.hashCode(), 0});
        HashSet&lt;String&gt; visited = new HashSet&lt;&gt;();

        while (!pq.isEmpty()) {
            int[] current = pq.poll();
            String node = String.valueOf((char) current[0]);
            int currentDist = current[1];

            if (visited.contains(node)) continue;
            visited.add(node);

            for (int[] edge : graph.get(node)) {
                String neighbor = String.valueOf((char) edge[0]);
                int weight = edge[1];
                int newDist = currentDist + weight;
                if (newDist &lt; dist.get(neighbor)) {
                    dist.put(neighbor, newDist);
                    pq.add(new int[]{neighbor.charAt(0), newDist});
                }
            }
        }
        return dist;
    }

    public static void main(String[] args) {
        HashMap&lt;String, List&lt;String&gt;&gt; graph = new HashMap&lt;&gt;();
        graph.put("A", List.of("B", "C"));
        graph.put("B", List.of("A", "D", "E"));
        graph.put("C", List.of("A", "F"));
        graph.put("D", List.of("B"));
        graph.put("E", List.of("B", "F"));
        graph.put("F", List.of("C", "E"));

        System.out.println(bfs(graph, "A"));  // [A, B, C, D, E, F]
        System.out.println(dfs(graph, "A"));  // [A, C, F, E, B, D]
    }
}
</code></pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Social Networks:</strong> Find mutual friends (BFS), detect communities (DFS), suggest connections</li>
    <li><strong>GPS Navigation:</strong> Dijkstra's algorithm finds the shortest route between two locations considering road distances</li>
    <li><strong>Recommendation Systems:</strong> Graph traversal identifies "people who liked X also liked Y"</li>
    <li><strong>Dependency Resolution:</strong> Topological sort on a DAG determines build order for software packages</li>
    <li><strong>Cycle Detection:</strong> Used in deadlock detection, circular dependency detection in package managers</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Choose adjacency list over matrix</strong> — most real-world graphs are sparse, so lists save memory</li>
    <li><strong>BFS for shortest path in unweighted graphs</strong> — it explores level by level, guaranteeing the shortest route</li>
    <li><strong>DFS for cycle detection</strong> — the recursion stack naturally tracks back edges</li>
    <li><strong>Use Dijkstra's for weighted graphs</strong> — never use BFS on weighted edges (it ignores weights)</li>
    <li><strong>Mark visited nodes immediately</strong> — prevents infinite loops in cyclic graphs</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Scenario</th><th>Algorithm</th><th>Why</th></tr></thead>
    <tbody>
        <tr><td>Find shortest path (unweighted)</td><td>BFS</td><td>Level-by-level guarantees shortest</td></tr>
        <tr><td>Find shortest path (weighted)</td><td>Dijkstra's</td><td>Considers edge weights</td></tr>
        <tr><td>Check if path exists</td><td>DFS or BFS</td><td>Either works for reachability</td></tr>
        <tr><td>Detect cycles</td><td>DFS with recursion stack</td><td>Back edges indicate cycles</td></tr>
        <tr><td>Topological ordering</td><td>DFS or Kahn's (BFS)</td><td>For DAG scheduling problems</td></tr>
        <tr><td>Find connected components</td><td>BFS or DFS</td><td>Visit all nodes in each component</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a GPS navigation app for a small city. The city has 6 intersections (A through F) connected by roads with distances (weights) shown below:</p>
    <pre>A --4-- B --1-- C
|               |
2               8
|               |
C --1-- D       D
        |
        5
        |
        E</pre>
    <p>The weighted edges are: A→B (4), A→C (2), B→C (1), B→D (5), C→D (8). All edges are bidirectional.</p>
    <p><strong>Task:</strong></p>
    <ol>
        <li>Using Dijkstra's algorithm, find the shortest path from city A to city D. Show each step of the algorithm, including the distance table updates.</li>
        <li>Perform a BFS starting from city A and list the order in which cities are visited.</li>
        <li>Would BFS give the correct shortest path from A to D? Why or why not?</li>
        <li>Write PHP code that builds this weighted graph and runs Dijkstra's algorithm to find the shortest distances from A.</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1: Dijkstra's Step-by-Step from A to D</strong></p>
        <table>
            <thead><tr><th>Step</th><th>Current Node</th><th>A</th><th>B</th><th>C</th><th>D</th><th>Visited</th></tr></thead>
            <tbody>
                <tr><td>0</td><td>A</td><td>0</td><td>∞</td><td>∞</td><td>∞</td><td>{}</td></tr>
                <tr><td>1</td><td>A</td><td><strong>0</strong></td><td>4</td><td>2</td><td>∞</td><td>{A}</td></tr>
                <tr><td>2</td><td>C (dist 2)</td><td>0</td><td>4</td><td><strong>2</strong></td><td>10</td><td>{A,C}</td></tr>
                <tr><td>3</td><td>B (dist 4)</td><td>0</td><td><strong>4</strong></td><td>2</td><td>9</td><td>{A,C,B}</td></tr>
                <tr><td>4</td><td>D (dist 9)</td><td>0</td><td>4</td><td>2</td><td><strong>9</strong></td><td>{A,C,B,D}</td></tr>
            </tbody>
        </table>
        <p><strong>Shortest path from A to D:</strong> A → B → D with total distance <strong>9</strong></p>
        <p>(A→B = 4, B→D = 5, total = 9. The path A→C→D would be 2+8=10, which is longer.)</p>

        <p><strong>Answer 2: BFS from A</strong></p>
        <p>Order: <strong>A, B, C, D</strong> (A's neighbors B,C are visited first, then B's unvisited neighbor D)</p>

        <p><strong>Answer 3:</strong> No. BFS ignores edge weights. It would report A→C→D as a 2-hop path, but the actual shortest path A→B→D has distance 9 while A→C→D has distance 10. BFS only finds shortest hops, not shortest weighted distance.</p>

        <p><strong>Answer 4: PHP Code</strong></p>
        <pre><code>&lt;?php
function dijkstra($graph, $start) {
    $dist = array_fill_keys(array_keys($graph), INF);
    $dist[$start] = 0;
    $visited = [];
    $pq = [['node' => $start, 'dist' => 0]];

    while (!empty($pq)) {
        usort($pq, fn($a, $b) => $a['dist'] <=> $b['dist']);
        $current = array_shift($pq);
        $node = $current['node'];

        if (isset($visited[$node])) continue;
        $visited[$node] = true;

        foreach ($graph[$node] as ['node' => $neighbor, 'weight' => $weight]) {
            $newDist = $dist[$node] + $weight;
            if ($newDist < $dist[$neighbor]) {
                $dist[$neighbor] = $newDist;
                $pq[] = ['node' => $neighbor, 'dist' => $newDist];
            }
        }
    }
    return $dist;
}

$city = [
    'A' => [['node' => 'B', 'weight' => 4], ['node' => 'C', 'weight' => 2]],
    'B' => [['node' => 'A', 'weight' => 4], ['node' => 'C', 'weight' => 1], ['node' => 'D', 'weight' => 5]],
    'C' => [['node' => 'A', 'weight' => 2], ['node' => 'B', 'weight' => 1], ['node' => 'D', 'weight' => 8]],
    'D' => [['node' => 'B', 'weight' => 5], ['node' => 'C', 'weight' => 8]]
];

$distances = dijkstra($city, 'A');
print_r($distances);
// A=>0, B=>4, C=>2, D=>9</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
