<?php $pageTitle = 'Linked Lists'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Linked Lists</h1>
    <p class="lesson-desc">Understand singly and doubly linked lists — how they differ from arrays and when to use them.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we explore linked lists, let's recall what you already know about arrays and linear data structures. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the time complexity for inserting an element at the beginning of an array? Why?</li>
        <li>How does PHP store an array internally — is it a true array like C, or something else?</li>
        <li>What does "dynamic size" mean, and why might it be important when choosing a data structure?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>linked list</strong> is a linear data structure where elements (nodes) are stored in separate memory locations. Each node contains <strong>data</strong> and a <strong>pointer</strong> (reference) to the next node. Unlike arrays, linked lists do not store elements in contiguous memory.</p>

<h3>Analogy</h3>
<p>Think of a <strong>train</strong>. Each car is connected to the next car by a coupling. To reach the last car, you must travel through every car in front of it. You cannot jump directly to car #5 without passing through cars 1–4. Similarly, in a linked list, you must traverse from the head to reach any node — there's no index-based access.</p>

<h3>How It Works (Step by Step)</h3>
<p>A linked list is built from <strong>nodes</strong>. Each node holds two things: the data value and a pointer to the next node. The list keeps a reference to the <strong>head</strong> (the first node). If a node's pointer is <code>null</code>, it means there is no next node — you've reached the end.</p>

<p><strong>Singly Linked List:</strong> Each node points only to the next node. Traversal goes one direction — head to tail.</p>

<pre><code class="language-php">&lt;?php
class Node {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class SinglyLinkedList {
    private $head = null;
    private $size = 0;

    // Insert at beginning — O(1)
    public function prepend($data) {
        $node = new Node($data);
        $node->next = $this->head;
        $this->head = $node;
        $this->size++;
    }

    // Insert at end — O(n)
    public function append($data) {
        $node = new Node($data);
        if (!$this->head) {
            $this->head = $node;
        } else {
            $current = $this->head;
            while ($current->next) {
                $current = $current->next;
            }
            $current->next = $node;
        }
        $this->size++;
    }

    // Delete by value — O(n)
    public function delete($data) {
        if (!$this->head) return;

        if ($this->head->data === $data) {
            $this->head = $this->head->next;
            $this->size--;
            return;
        }

        $current = $this->head;
        while ($current->next) {
            if ($current->next->data === $data) {
                $current->next = $current->next->next;
                $this->size--;
                return;
            }
            $current = $current->next;
        }
    }

    // Search — O(n)
    public function search($data) {
        $current = $this->head;
        $index = 0;
        while ($current) {
            if ($current->data === $data) return $index;
            $current = $current->next;
            $index++;
        }
        return -1;
    }

    // Display
    public function display() {
        $elements = [];
        $current = $this->head;
        while ($current) {
            $elements[] = $current->data;
            $current = $current->next;
        }
        return implode(' → ', $elements) . ' → NULL';
    }

    public function size() { return $this->size; }
}

$list = new SinglyLinkedList();
$list->append(10);
$list->append(20);
$list->append(30);
$list->prepend(5);
echo $list->display();  // 5 → 10 → 20 → 30 → NULL</code></pre>

<h3>Linked List Reversal</h3>
<pre><code class="language-php">&lt;?php
function reverseList($head) {
    $prev = null;
    $current = $head;

    while ($current) {
        $next = $current->next;
        $current->next = $prev;
        $prev = $current;
        $current = $next;
    }
    return $prev;  // New head
}</code></pre>

<p><strong>Doubly Linked List:</strong> Each node has pointers to both <strong>next</strong> and <strong>previous</strong> nodes, enabling traversal in both directions.</p>

<pre><code class="language-php">&lt;?php
class DNode {
    public $data;
    public $next;
    public $prev;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}

class DoublyLinkedList {
    private $head = null;
    private $tail = null;
    private $size = 0;

    public function append($data) {
        $node = new DNode($data);
        if (!$this->head) {
            $this->head = $this->tail = $node;
        } else {
            $node->prev = $this->tail;
            $this->tail->next = $node;
            $this->tail = $node;
        }
        $this->size++;
    }

    public function delete($data) {
        $current = $this->head;
        while ($current) {
            if ($current->data === $data) {
                if ($current->prev) $current->prev->next = $current->next;
                else $this->head = $current->next;

                if ($current->next) $current->next->prev = $current->prev;
                else $this->tail = $current->prev;

                $this->size--;
                return true;
            }
            $current = $current->next;
        }
        return false;
    }

    public function displayForward() {
        $elements = [];
        $current = $this->head;
        while ($current) {
            $elements[] = $current->data;
            $current = $current->next;
        }
        return implode(' ⇄ ', $elements);
    }

    public function displayBackward() {
        $elements = [];
        $current = $this->tail;
        while ($current) {
            $elements[] = $current->data;
            $current = $current->prev;
        }
        return implode(' ⇄ ', $elements);
    }
}

$dll = new DoublyLinkedList();
$dll->append(10);
$dll->append(20);
$dll->append(30);
echo $dll->displayForward();   // 10 ⇄ 20 ⇄ 30
echo $dll->displayBackward();  // 30 ⇄ 20 ⇄ 10</code></pre>

<p><strong>Array vs Linked List:</strong></p>

<table>
    <thead><tr><th>Operation</th><th>Array</th><th>Linked List</th></tr></thead>
    <tbody>
        <tr><td>Access by index</td><td>O(1)</td><td>O(n)</td></tr>
        <tr><td>Search</td><td>O(n)</td><td>O(n)</td></tr>
        <tr><td>Insert at beginning</td><td>O(n)</td><td>O(1)</td></tr>
        <tr><td>Insert at end</td><td>O(1) amortized</td><td>O(n)*</td></tr>
        <tr><td>Delete</td><td>O(n)</td><td>O(n)</td></tr>
        <tr><td>Memory</td><td>Contiguous</td><td>Scattered + pointers</td></tr>
    </tbody>
</table>
<p style="font-size:0.85em; color:var(--text-muted);">* O(n) without tail pointer; O(1) with tail pointer</p>

<h3>Python Example: Singly Linked List</h3>
<p>A linked list is like a train — each car points to the next one.</p>
<pre><code class="language-python"># Node: holds data and points to next node
class Node:
    def __init__(self, data):
        self.data = data    # Store the data
        self.next = None    # Point to nothing (end of list)

# Linked List: manages the nodes
class LinkedList:
    def __init__(self):
        self.head = None    # Start with empty list

    # Add to front - O(1)
    def prepend(self, data):
        new_node = Node(data)
        new_node.next = self.head   # New node points to old head
        self.head = new_node        # New node becomes head

    # Print all items
    def display(self):
        current = self.head
        while current:
            print(current.data, end=" -> ")
            current = current.next
        print("None")

# Test it
ll = LinkedList()
ll.prepend("Juan")
ll.prepend("Maria")
ll.prepend("Pedro")
ll.display()  # Pedro -> Maria -> Juan -> None
</code></pre>
<strong>Output:</strong>
<pre>Pedro -> Maria -> Juan -> None</pre>

<h3>Java Example: Singly Linked List</h3>
<p>A linked list is like a train — each car points to the next one.</p>
<pre><code class="language-java">public class Main {
    // Node: holds data and points to next node
    static class Node {
        String data;
        Node next;

        Node(String data) {
            this.data = data;    // Store the data
            this.next = null;    // Point to nothing
        }
    }

    // Linked List: manages the nodes
    static class LinkedList {
        Node head = null;        // Start with empty list

        // Add to front - O(1)
        void prepend(String data) {
            Node newNode = new Node(data);
            newNode.next = this.head;   // New node points to old head
            this.head = newNode;        // New node becomes head
        }

        // Print all items
        void display() {
            Node current = head;
            while (current != null) {
                System.out.print(current.data + " -> ");
                current = current.next;
            }
            System.out.println("None");
        }
    }

    public static void main(String[] args) {
        LinkedList ll = new LinkedList();
        ll.prepend("Juan");
        ll.prepend("Maria");
        ll.prepend("Pedro");
        ll.display();  // Pedro -> Maria -> Juan -> None
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Pedro -> Maria -> Juan -> None</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Music Playlists</strong> — Adding/removing songs sequentially; no need for index access.</li>
    <li><strong>Browser History</strong> — Each visited page is a node; back/forward traversal links them.</li>
    <li><strong>Undo/Redo in Editors</strong> — Actions stored as linked nodes; undo removes the latest, redo restores it.</li>
    <li><strong>Operating System Memory Management</strong> — Free memory blocks tracked as linked lists.</li>
    <li><strong>Hash Table Collision Handling</strong> — Separate chaining uses linked lists at each bucket.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always keep track of the <code>head</code> — losing it means losing the entire list.</li>
    <li>When deleting, update the <strong>previous</strong> node's pointer, not just the current one.</li>
    <li>Use a <strong>doubly linked list</strong> when you need to traverse backward efficiently.</li>
    <li>Draw the nodes and pointers on paper — it makes pointer manipulation much easier to visualize.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use Linked List When...</th><th>Use Array When...</th></tr></thead>
    <tbody>
        <tr><td>Frequent insertions/deletions at beginning</td><td>Frequent random access by index</td></tr>
        <tr><td>Unknown or highly variable size</td><td>Size is known and relatively stable</td></tr>
        <tr><td>No need for index-based access</td><td>Cache performance matters (contiguous memory)</td></tr>
        <tr><td>Building stacks, queues, or adjacency lists</td><td>Need sorting or binary search</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a music playlist application. The app stores songs in a linked list. Users can add songs to the end, remove songs by title, and search for a song by title.</p>
    <p><strong>Task:</strong> Given a playlist that currently contains ["Blinding Lights", "Shape of You", "Bohemian Rhapsody"], implement the following operations using a linked list:</p>
    <ol>
        <li>Add "Yesterday" to the end of the playlist.</li>
        <li>Remove "Shape of You" from the playlist.</li>
        <li>Search for "Bohemian Rhapsody" and return its position (0-indexed).</li>
        <li>Display the final playlist.</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1–4: Complete PHP Solution</strong></p>
        <pre><code>&lt;?php
class Node {
    public $data;
    public $next;
    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class Playlist {
    private $head = null;

    public function addSong($title) {
        $node = new Node($title);
        if (!$this->head) {
            $this->head = $node;
            return;
        }
        $current = $this->head;
        while ($current->next) {
            $current = $current->next;
        }
        $current->next = $node;
    }

    public function removeSong($title) {
        if (!$this->head) return;
        if ($this->head->data === $title) {
            $this->head = $this->head->next;
            return;
        }
        $current = $this->head;
        while ($current->next) {
            if ($current->next->data === $title) {
                $current->next = $current->next->next;
                return;
            }
            $current = $current->next;
        }
    }

    public function findSong($title) {
        $current = $this->head;
        $index = 0;
        while ($current) {
            if ($current->data === $title) return $index;
            $current = $current->next;
            $index++;
        }
        return -1;
    }

    public function display() {
        $elements = [];
        $current = $this->head;
        while ($current) {
            $elements[] = $current->data;
            $current = $current->next;
        }
        return implode(' → ', $elements) . ' → NULL';
    }
}

$playlist = new Playlist();
$playlist->addSong("Blinding Lights");
$playlist->addSong("Shape of You");
$playlist->addSong("Bohemian Rhapsody");

$playlist->addSong("Yesterday");        // Step 1
$playlist->removeSong("Shape of You");  // Step 2
echo $playlist->findSong("Bohemian Rhapsody") . "\n"; // Step 3: returns 2
echo $playlist->display();              // Step 4
// Output: Blinding Lights → Bohemian Rhapsody → Yesterday → NULL</code></pre>

        <p><strong>Python Solution</strong></p>
        <pre><code>class Node:
    def __init__(self, data):
        self.data = data
        self.next = None

class Playlist:
    def __init__(self):
        self.head = None

    def add_song(self, title):
        node = Node(title)
        if not self.head:
            self.head = node
            return
        current = self.head
        while current.next:
            current = current.next
        current.next = node

    def remove_song(self, title):
        if not self.head:
            return
        if self.head.data == title:
            self.head = self.head.next
            return
        current = self.head
        while current.next:
            if current.next.data == title:
                current.next = current.next.next
                return
            current = current.next

    def find_song(self, title):
        current = self.head
        index = 0
        while current:
            if current.data == title:
                return index
            current = current.next
            index += 1
        return -1

    def display(self):
        elements = []
        current = self.head
        while current:
            elements.append(current.data)
            current = current.next
        return ' → '.join(elements) + ' → NULL'

playlist = Playlist()
playlist.add_song("Blinding Lights")
playlist.add_song("Shape of You")
playlist.add_song("Bohemian Rhapsody")
playlist.add_song("Yesterday")
playlist.remove_song("Shape of You")
print(playlist.find_song("Bohemian Rhapsody"))  # 2
print(playlist.display())
# Blinding Lights → Bohemian Rhapsody → Yesterday → NULL</code></pre>

        <p><strong>Java Solution</strong></p>
        <pre><code>class Node {
    String data;
    Node next;
    Node(String data) {
        this.data = data;
        this.next = null;
    }
}

class Playlist {
    private Node head = null;

    public void addSong(String title) {
        Node node = new Node(title);
        if (head == null) {
            head = node;
            return;
        }
        Node current = head;
        while (current.next != null) {
            current = current.next;
        }
        current.next = node;
    }

    public void removeSong(String title) {
        if (head == null) return;
        if (head.data.equals(title)) {
            head = head.next;
            return;
        }
        Node current = head;
        while (current.next != null) {
            if (current.next.data.equals(title)) {
                current.next = current.next.next;
                return;
            }
            current = current.next;
        }
    }

    public int findSong(String title) {
        Node current = head;
        int index = 0;
        while (current != null) {
            if (current.data.equals(title)) return index;
            current = current.next;
            index++;
        }
        return -1;
    }

    public String display() {
        StringBuilder sb = new StringBuilder();
        Node current = head;
        while (current != null) {
            sb.append(current.data);
            if (current.next != null) sb.append(" → ");
            current = current.next;
        }
        sb.append(" → NULL");
        return sb.toString();
    }

    public static void main(String[] args) {
        Playlist playlist = new Playlist();
        playlist.addSong("Blinding Lights");
        playlist.addSong("Shape of You");
        playlist.addSong("Bohemian Rhapsody");
        playlist.addSong("Yesterday");
        playlist.removeSong("Shape of You");
        System.out.println(playlist.findSong("Bohemian Rhapsody")); // 2
        System.out.println(playlist.display());
        // Blinding Lights → Bohemian Rhapsody → Yesterday → NULL
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
