<?php $pageTitle = 'Queues'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Queues</h1>
    <p class="lesson-desc">Master the FIFO (First In, First Out) data structure — enqueue, dequeue, and queue applications.</p>
</div>

<h2>What Is a Queue?</h2>
<p>A <strong>queue</strong> is a linear data structure that follows the <strong>FIFO (First In, First Out)</strong> principle. Think of a line at a store — first person in line is first to be served.</p>

<h2>Queue Operations</h2>
<table>
    <thead><tr><th>Operation</th><th>Description</th><th>Time</th></tr></thead>
    <tbody>
        <tr><td>enqueue(item)</td><td>Add to rear/back</td><td>O(1)</td></tr>
        <tr><td>dequeue()</td><td>Remove from front</td><td>O(1)</td></tr>
        <tr><td>front()/peek()</td><td>View front element</td><td>O(1)</td></tr>
        <tr><td>isEmpty()</td><td>Check if empty</td><td>O(1)</td></tr>
    </tbody>
</table>

<h2>Implementation</h2>
<pre><code class="language-php">&lt;?php
class Queue {
    private $items = [];
    private $front = 0;

    public function enqueue($item) {
        $this->items[] = $item;
    }

    public function dequeue() {
        if ($this->isEmpty()) throw new \Exception("Queue is empty");
        $item = $this->items[$this->front];
        $this->front++;
        // Reset when mostly empty to free memory
        if ($this->front > 100 && $this->front > count($this->items) / 2) {
            $this->items = array_slice($this->items, $this->front);
            $this->front = 0;
        }
        return $item;
    }

    public function peek() {
        if ($this->isEmpty()) throw new \Exception("Queue is empty");
        return $this->items[$this->front];
    }

    public function isEmpty() {
        return $this->front >= count($this->items);
    }

    public function size() {
        return count($this->items) - $this->front;
    }
}

$queue = new Queue();
$queue->enqueue('Alice');
$queue->enqueue('Bob');
$queue->enqueue('Charlie');
echo $queue->dequeue();  // Alice (first in, first out)
echo $queue->peek();     // Bob</code></pre>

<h2>Types of Queues</h2>

<h3>Circular Queue</h3>
<p>Wraps around when it reaches the end — efficient use of fixed-size arrays.</p>
<pre><code class="language-php">&lt;?php
class CircularQueue {
    private $items;
    private $size;
    private $front = -1;
    private $rear = -1;

    public function __construct($size) {
        $this->size = $size;
        $this->items = array_fill(0, $size, null);
    }

    public function enqueue($item) {
        if ($this->isFull()) throw new \Exception("Queue is full");
        if ($this->front === -1) $this->front = 0;
        $this->rear = ($this->rear + 1) % $this->size;
        $this->items[$this->rear] = $item;
    }

    public function dequeue() {
        if ($this->isEmpty()) throw new \Exception("Queue is empty");
        $item = $this->items[$this->front];
        if ($this->front === $this->rear) {
            $this->front = $this->rear = -1;
        } else {
            $this->front = ($this->front + 1) % $this->size;
        }
        return $item;
    }

    public function isEmpty() { return $this->front === -1; }
    public function isFull() { return ($this->rear + 1) % $this->size === $this->front; }
}</code></pre>

<h3>Priority Queue</h3>
<p>Each element has a priority. Higher-priority elements are dequeued first.</p>
<pre><code class="language-php">&lt;?php
class PriorityQueue {
    private $items = [];

    public function enqueue($item, $priority) {
        $this->items[] = ['item' => $item, 'priority' => $priority];
        usort($this->items, fn($a, $b) => $b['priority'] <=> $a['priority']);
    }

    public function dequeue() {
        if (empty($this->items)) throw new \Exception("Empty");
        return array_shift($this->items)['item'];
    }

    public function isEmpty() { return empty($this->items); }
}

$pq = new PriorityQueue();
$pq->enqueue('Low priority', 1);
$pq->enqueue('High priority', 10);
$pq->enqueue('Medium priority', 5);
echo $pq->dequeue();  // High priority</code></pre>

<h2>Queue Applications</h2>

<h3>BFS (Breadth-First Search)</h3>
<pre><code class="language-php">&lt;?php
function bfs($graph, $start) {
    $visited = [];
    $queue = new Queue();
    $queue->enqueue($start);
    $visited[$start] = true;
    $order = [];

    while (!$queue->isEmpty()) {
        $node = $queue->dequeue();
        $order[] = $node;

        foreach ($graph[$node] as $neighbor) {
            if (!isset($visited[$neighbor])) {
                $visited[$neighbor] = true;
                $queue->enqueue($neighbor);
            }
        }
    }
    return $order;
}

$graph = [
    'A' => ['B', 'C'],
    'B' => ['A', 'D'],
    'C' => ['A', 'D'],
    'D' => ['B', 'C']
];
print_r(bfs($graph, 'A'));  // A, B, C, D</code></pre>

<h3>Print Queue Simulation</h3>
<pre><code class="language-php">&lt;?php
class PrintQueue {
    private $queue = [];

    public function addJob($job) {
        $this->queue[] = $job;
        echo "Added: $job (Position: " . count($this->queue) . ")\n";
    }

    public function processNext() {
        if (empty($this->queue)) return "No jobs";
        $job = array_shift($this->queue);
        echo "Printing: $job\n";
        return $job;
    }
}

$printer = new PrintQueue();
$printer->addJob('Document1.pdf');
$printer->addJob('Photo.jpg');
$printer->addJob('Report.docx');
$printer->processNext();  // Printing: Document1.pdf</code></pre>

<h2>When to Use Queues</h2>
<ul>
    <li><strong>BFS traversal</strong> — level-order tree/graph traversal</li>
    <li><strong>Task scheduling</strong> — print queues, CPU scheduling</li>
    <li><strong>Buffering</strong> — streaming, I/O buffers</li>
    <li><strong>Producer-consumer</strong> — message queues, event systems</li>
</ul>

<h2>Python Implementation</h2>
<pre><code class="language-python">
from collections import deque

class Queue:
    def __init__(self):
        self.items = deque()

    def enqueue(self, item):
        self.items.append(item)

    def dequeue(self):
        if self.is_empty():
            raise IndexError("Queue is empty")
        return self.items.popleft()

    def peek(self):
        if self.is_empty():
            raise IndexError("Queue is empty")
        return self.items[0]

    def is_empty(self):
        return len(self.items) == 0

    def size(self):
        return len(self.items)

queue = Queue()
queue.enqueue('Alice')
queue.enqueue('Bob')
queue.enqueue('Charlie')
print(queue.dequeue())  # Alice
print(queue.peek())     # Bob

class CircularQueue:
    def __init__(self, size):
        self.size = size
        self.items = [None] * size
        self.front = -1
        self.rear = -1

    def enqueue(self, item):
        if self.is_full():
            raise IndexError("Queue is full")
        if self.front == -1:
            self.front = 0
        self.rear = (self.rear + 1) % self.size
        self.items[self.rear] = item

    def dequeue(self):
        if self.is_empty():
            raise IndexError("Queue is empty")
        item = self.items[self.front]
        if self.front == self.rear:
            self.front = self.rear = -1
        else:
            self.front = (self.front + 1) % self.size
        return item

    def is_empty(self):
        return self.front == -1

    def is_full(self):
        return (self.rear + 1) % self.size == self.front

def bfs(graph, start):
    visited = {start}
    queue = Queue()
    queue.enqueue(start)
    order = []

    while not queue.is_empty():
        node = queue.dequeue()
        order.append(node)
        for neighbor in graph[node]:
            if neighbor not in visited:
                visited.add(neighbor)
                queue.enqueue(neighbor)
    return order

graph = {
    'A': ['B', 'C'],
    'B': ['A', 'D'],
    'C': ['A', 'D'],
    'D': ['B', 'C']
}
print(bfs(graph, 'A'))  # ['A', 'B', 'C', 'D']
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
import java.util.LinkedList;
import java.util.Queue;
import java.util.HashMap;
import java.util.ArrayList;
import java.util.List;

class CircularQueue {
    private Object[] items;
    private int size;
    private int front = -1;
    private int rear = -1;

    public CircularQueue(int size) {
        this.size = size;
        this.items = new Object[size];
    }

    public void enqueue(Object item) {
        if (isFull()) throw new RuntimeException("Queue is full");
        if (front == -1) front = 0;
        rear = (rear + 1) % size;
        items[rear] = item;
    }

    public Object dequeue() {
        if (isEmpty()) throw new RuntimeException("Queue is empty");
        Object item = items[front];
        if (front == rear) {
            front = rear = -1;
        } else {
            front = (front + 1) % size;
        }
        return item;
    }

    public boolean isEmpty() { return front == -1; }
    public boolean isFull() { return (rear + 1) % size == front; }
}

public class Main {
    public static List&lt;String&gt; bfs(HashMap&lt;String, List&lt;String&gt;&gt; graph, String start) {
        List&lt;String&gt; order = new ArrayList&lt;&gt;();
        java.util.Queue&lt;String&gt; queue = new LinkedList&lt;&gt;();
        java.util.HashSet&lt;String&gt; visited = new java.util.HashSet&lt;&gt;();
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

    public static void main(String[] args) {
        Queue&lt;String&gt; queue = new LinkedList&lt;&gt;();
        queue.add("Alice");
        queue.add("Bob");
        queue.add("Charlie");
        System.out.println(queue.poll());  // Alice
        System.out.println(queue.peek());  // Bob

        HashMap&lt;String, List&lt;String&gt;&gt; graph = new HashMap&lt;&gt;();
        graph.put("A", List.of("B", "C"));
        graph.put("B", List.of("A", "D"));
        graph.put("C", List.of("A", "D"));
        graph.put("D", List.of("B", "C"));
        System.out.println(bfs(graph, "A"));  // [A, B, C, D]
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
