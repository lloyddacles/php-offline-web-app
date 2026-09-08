<?php $pageTitle = 'Queues'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $sectionDir = 'dsa-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Queues</h1>
    <p class="lesson-desc">Master the FIFO (First In, First Out) data structure — enqueue, dequeue, and queue applications.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we explore queues, let's recall concepts you already know. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between a stack and a queue in terms of ordering?</li>
        <li>What does "FIFO" stand for? Can you give a real-life example?</li>
        <li>In the previous lesson, you learned about the browser back button using stacks. What data structure would you use for a "print queue" instead, and why?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>queue</strong> is a linear data structure that follows the <strong>FIFO (First In, First Out)</strong> principle. The first element added is the first one removed. Think of it as a line at a store — first come, first served.</p>

<h3>Analogy</h3>
<p>Imagine a line of customers at a grocery store. The first person to get in line is the first to be served at the register. New customers join at the <strong>back</strong> of the line, and the customer at the <strong>front</strong> is served next. No one cuts the line — that's the FIFO rule.</p>

<h3>How It Works (Step by Step)</h3>
<p>A queue supports four core operations:</p>
<ul>
    <li><strong>enqueue(item)</strong> — Add an element to the rear/back.</li>
    <li><strong>dequeue()</strong> — Remove and return the front element.</li>
    <li><strong>front()/peek()</strong> — View the front element without removing it.</li>
    <li><strong>isEmpty()</strong> — Check if the queue has no elements.</li>
</ul>

<table>
    <thead><tr><th>Operation</th><th>Description</th><th>Time</th></tr></thead>
    <tbody>
        <tr><td>enqueue(item)</td><td>Add to rear/back</td><td>O(1)</td></tr>
        <tr><td>dequeue()</td><td>Remove from front</td><td>O(1)</td></tr>
        <tr><td>front()/peek()</td><td>View front element</td><td>O(1)</td></tr>
        <tr><td>isEmpty()</td><td>Check if empty</td><td>O(1)</td></tr>
    </tbody>
</table>

<h3>Queue Implementation</h3>
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

<h3>Python Example: Queue Operations</h3>
<p>A queue is like a line at a store — first person in, first person out.</p>
<pre><code class="language-python">from collections import deque

# Queue: First In, First Out (FIFO)
class Queue:
    def __init__(self):
        self.items = deque()

    # Add to back - O(1)
    def enqueue(self, item):
        self.items.append(item)

    # Remove from front - O(1)
    def dequeue(self):
        if not self.is_empty():
            return self.items.popleft()
        return None

    # Look at front without removing - O(1)
    def front(self):
        if not self.is_empty():
            return self.items[0]
        return None

    # Check if empty - O(1)
    def is_empty(self):
        return len(self.items) == 0

# Test it
queue = Queue()
queue.enqueue("Juan")
queue.enqueue("Maria")
queue.enqueue("Pedro")
print(queue.dequeue())   # Juan (first in, first out)
print(queue.front())     # Maria (now first in line)
print(queue.dequeue())   # Maria
print(queue.is_empty())  # False
</code></pre>
<strong>Output:</strong>
<pre>Juan
Maria
Maria
False</pre>

<h3>Java Example: Queue Operations</h3>
<p>A queue is like a line at a store — first person in, first person out.</p>
<pre><code class="language-java">import java.util.LinkedList;
import java.util.Queue;

public class Main {
    public static void main(String[] args) {
        // Java Queue using LinkedList
        Queue&lt;String&gt; queue = new LinkedList&lt;&gt;();

        // Add to back - O(1)
        queue.offer("Juan");
        queue.offer("Maria");
        queue.offer("Pedro");

        // Remove from front - O(1)
        System.out.println(queue.poll());   // Juan (first in, first out)

        // Look at front without removing - O(1)
        System.out.println(queue.peek());  // Maria (now first in line)

        // Remove more
        System.out.println(queue.poll());   // Maria

        // Check if empty - O(1)
        System.out.println(queue.isEmpty());  // false
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Juan
Maria
Maria
false</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Print Queue</strong> — Documents are printed in the order they are submitted (FIFO).</li>
    <li><strong>Task Scheduling</strong> — Operating systems use queues to manage CPU scheduling and process execution.</li>
    <li><strong>BFS in Social Networks</strong> — Finding shortest paths, suggested friends, or people within N connections.</li>
    <li><strong>Message Queues</strong> — Systems like RabbitMQ or Kafka use queues for asynchronous communication between services.</li>
    <li><strong>Buffering</strong> — Video streaming buffers data in a queue so playback stays smooth.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <strong>circular queues</strong> when you have a fixed buffer size — they prevent wasted space.</li>
    <li>Use <strong>priority queues</strong> when not all tasks are equal — e.g., emergency room triage.</li>
    <li>BFS with a queue explores nodes level by level — perfect for <strong>shortest path</strong> problems in unweighted graphs.</li>
    <li>Never dequeue from an empty queue — always check <code>isEmpty()</code> first.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use Queue When...</th><th>Use Stack When...</th></tr></thead>
    <tbody>
        <tr><td>FIFO ordering is needed</td><td>LIFO ordering is needed</td></tr>
        <tr><td>BFS traversal</td><td>DFS traversal or backtracking</td></tr>
        <tr><td>Task scheduling / print queues</td><td>Undo/redo functionality</td></tr>
        <tr><td>Producer-consumer patterns</td><td>Expression parsing</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a hospital triage system. Patients arrive and are assigned a priority: Critical (3), Urgent (2), or Normal (1). Higher priority patients are treated first. The system must also support a regular FIFO waiting room for patients of the same priority.</p>
    <p><strong>Task:</strong> Given the following patient arrivals, implement a priority queue and process them:</p>
    <ol>
        <li>Patient "Alice" arrives with priority Normal (1)</li>
        <li>Patient "Bob" arrives with priority Critical (3)</li>
        <li>Patient "Charlie" arrives with priority Urgent (2)</li>
        <li>Patient "Diana" arrives with priority Normal (1)</li>
        <li>Process (dequeue) all patients and show the order they are treated.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Expected Treatment Order:</strong> Bob (Critical, 3) → Charlie (Urgent, 2) → Alice (Normal, 1) → Diana (Normal, 1)</p>
        <p><strong>PHP Solution</strong></p>
        <pre><code>&lt;?php
class PriorityQueue {
    private $items = [];

    public function enqueue($item, $priority) {
        $this->items[] = ['item' => $item, 'priority' => $priority];
        usort($this->items, fn($a, $b) => $b['priority'] <=> $a['priority']);
    }

    public function dequeue() {
        if (empty($this->items)) throw new \Exception("Queue is empty");
        return array_shift($this->items);
    }

    public function isEmpty() { return empty($this->items); }
}

$triage = new PriorityQueue();
$triage->enqueue('Alice', 1);    // Normal
$triage->enqueue('Bob', 3);      // Critical
$triage->enqueue('Charlie', 2);  // Urgent
$triage->enqueue('Diana', 1);    // Normal

echo "Treatment Order:\n";
while (!$triage->isEmpty()) {
    $patient = $triage->dequeue();
    $level = match($patient['priority']) { 3 => 'Critical', 2 => 'Urgent', default => 'Normal' };
    echo "  {$patient['item']} ({$level})\n";
}
// Bob (Critical)
// Charlie (Urgent)
// Alice (Normal)
// Diana (Normal)</code></pre>

        <p><strong>Python Solution</strong></p>
        <pre><code>class PriorityQueue:
    def __init__(self):
        self.items = []

    def enqueue(self, item, priority):
        self.items.append({'item': item, 'priority': priority})
        self.items.sort(key=lambda x: x['priority'], reverse=True)

    def dequeue(self):
        if not self.items:
            raise IndexError("Queue is empty")
        return self.items.pop(0)

    def is_empty(self):
        return len(self.items) == 0

triage = PriorityQueue()
triage.enqueue('Alice', 1)     # Normal
triage.enqueue('Bob', 3)       # Critical
triage.enqueue('Charlie', 2)   # Urgent
triage.enqueue('Diana', 1)     # Normal

print("Treatment Order:")
levels = {3: 'Critical', 2: 'Urgent', 1: 'Normal'}
while not triage.is_empty():
    patient = triage.dequeue()
    print(f"  {patient['item']} ({levels[patient['priority']]})")
# Bob (Critical)
# Charlie (Urgent)
# Alice (Normal)
# Diana (Normal)</code></pre>

        <p><strong>Java Solution</strong></p>
        <pre><code>import java.util.ArrayList;
import java.util.List;

class PriorityQueue {
    private List&lt;String[]&gt; items = new ArrayList&lt;&gt;();

    public void enqueue(String item, int priority) {
        items.add(new String[]{item, String.valueOf(priority)});
        items.sort((a, b) -> Integer.parseInt(b[1]) - Integer.parseInt(a[1]));
    }

    public String[] dequeue() {
        if (items.isEmpty()) throw new RuntimeException("Queue is empty");
        return items.remove(0);
    }

    public boolean isEmpty() { return items.isEmpty(); }
}

public class Main {
    public static void main(String[] args) {
        PriorityQueue triage = new PriorityQueue();
        triage.enqueue("Alice", 1);     // Normal
        triage.enqueue("Bob", 3);       // Critical
        triage.enqueue("Charlie", 2);   // Urgent
        triage.enqueue("Diana", 1);     // Normal

        String[] levels = {"", "Normal", "Urgent", "Critical"};
        System.out.println("Treatment Order:");
        while (!triage.isEmpty()) {
            String[] patient = triage.dequeue();
            int p = Integer.parseInt(patient[1]);
            System.out.println("  " + patient[0] + " (" + levels[p] + ")");
        }
        // Bob (Critical)
        // Charlie (Urgent)
        // Alice (Normal)
        // Diana (Normal)
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
