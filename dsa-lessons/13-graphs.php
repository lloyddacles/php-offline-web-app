<?php $pageTitle = 'Graphs and Graph Traversal'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 13; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Graphs and Graph Traversal Algorithms</h1>
    <p class="lesson-desc">Learn about directed/undirected graphs, adjacency lists, BFS, DFS, and shortest path algorithms.</p>
</div>

<h2>What Is a Graph?</h2>
<p>A <strong>graph</strong> G = (V, E) consists of <strong>vertices</strong> (nodes) and <strong>edges</strong> (connections between nodes). Unlike trees, graphs can have cycles.</p>

<table>
    <thead><tr><th>Type</th><th>Description</th><th>Example</th></tr></thead>
    <tbody>
        <tr><td><strong>Undirected</strong></td><td>Edges go both ways</td><td>Facebook friends</td></tr>
        <tr><td><strong>Directed</strong></td><td>Edges have direction</td><td>Twitter followers</td></tr>
        <tr><td><strong>Weighted</strong></td><td>Edges have costs</td><td>GPS distances</td></tr>
        <tr><td><strong>Unweighted</strong></td><td>All edges equal</td><td>Social network</td></tr>
    </tbody>
</table>

<h2>Graph Representations</h2>

<h3>Adjacency List (Recommended)</h3>
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

<h3>Adjacency Matrix</h3>
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

<h2>BFS — Breadth-First Search</h2>
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

<h2>DFS — Depth-First Search</h2>
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

<h3>Recursive DFS</h3>
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

<h2>BFS vs DFS</h2>

<table>
    <thead><tr><th>Feature</th><th>BFS</th><th>DFS</th></tr></thead>
    <tbody>
        <tr><td>Data structure</td><td>Queue</td><td>Stack / Recursion</td></tr>
        <tr><td>Shortest path (unweighted)</td><td>Yes</td><td>No</td></tr>
        <tr><td>Memory usage</td><td>O(w) — width</td><td>O(h) — height</td></tr>
        <tr><td>Use case</td><td>Level-order, shortest path</td><td>Topological sort, cycles</td></tr>
    </tbody>
</table>

<h2>Dijkstra's Shortest Path (Weighted)</h2>
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

<h2>Detecting Cycles</h2>
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

<h2>Python Implementation</h2>
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

<h2>Java Implementation</h2>
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

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
