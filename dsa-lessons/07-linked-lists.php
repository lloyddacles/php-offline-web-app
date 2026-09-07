<?php $pageTitle = 'Linked Lists'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 7; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Linked Lists</h1>
    <p class="lesson-desc">Understand singly and doubly linked lists — how they differ from arrays and when to use them.</p>
</div>

<h2>What Is a Linked List?</h2>
<p>A <strong>linked list</strong> is a linear data structure where elements (nodes) are stored in separate memory locations. Each node contains <strong>data</strong> and a <strong>pointer</strong> (reference) to the next node.</p>

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

<h2>Array vs Linked List</h2>

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

<h2>Doubly Linked List</h2>
<p>Each node has pointers to both <strong>next</strong> and <strong>previous</strong> nodes, enabling traversal in both directions.</p>

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

<h2>Linked List Reversal</h2>
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

<h2>Python Implementation</h2>
<pre><code class="language-python">
class Node:
    def __init__(self, data):
        self.data = data
        self.next = None

class SinglyLinkedList:
    def __init__(self):
        self.head = None
        self.size = 0

    def prepend(self, data):
        node = Node(data)
        node.next = self.head
        self.head = node
        self.size += 1

    def append(self, data):
        node = Node(data)
        if not self.head:
            self.head = node
        else:
            current = self.head
            while current.next:
                current = current.next
            current.next = node
        self.size += 1

    def delete(self, data):
        if not self.head:
            return
        if self.head.data == data:
            self.head = self.head.next
            self.size -= 1
            return
        current = self.head
        while current.next:
            if current.next.data == data:
                current.next = current.next.next
                self.size -= 1
                return
            current = current.next

    def search(self, data):
        current = self.head
        index = 0
        while current:
            if current.data == data:
                return index
            current = current.next
            index += 1
        return -1

    def display(self):
        elements = []
        current = self.head
        while current:
            elements.append(str(current.data))
            current = current.next
        return ' → '.join(elements) + ' → NULL'

lst = SinglyLinkedList()
lst.append(10)
lst.append(20)
lst.append(30)
lst.prepend(5)
print(lst.display())  # 5 → 10 → 20 → 30 → NULL
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
class Node {
    int data;
    Node next;

    Node(int data) {
        this.data = data;
        this.next = null;
    }
}

class SinglyLinkedList {
    private Node head = null;
    private int size = 0;

    public void prepend(int data) {
        Node node = new Node(data);
        node.next = head;
        head = node;
        size++;
    }

    public void append(int data) {
        Node node = new Node(data);
        if (head == null) {
            head = node;
        } else {
            Node current = head;
            while (current.next != null) {
                current = current.next;
            }
            current.next = node;
        }
        size++;
    }

    public void delete(int data) {
        if (head == null) return;
        if (head.data == data) {
            head = head.next;
            size--;
            return;
        }
        Node current = head;
        while (current.next != null) {
            if (current.next.data == data) {
                current.next = current.next.next;
                size--;
                return;
            }
            current = current.next;
        }
    }

    public int search(int data) {
        Node current = head;
        int index = 0;
        while (current != null) {
            if (current.data == data) return index;
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
        SinglyLinkedList list = new SinglyLinkedList();
        list.append(10);
        list.append(20);
        list.append(30);
        list.prepend(5);
        System.out.println(list.display()); // 5 → 10 → 20 → 30 → NULL
    }
}
</code></pre>

<h2>When to Use Linked Lists</h2>
<ul>
    <li><strong>Frequent insertions/deletions</strong> at the beginning (O(1))</li>
    <li><strong>Unknown size</strong> — grows dynamically without pre-allocation</li>
    <li><strong>No random access needed</strong> — sequential traversal is fine</li>
    <li><strong>Avoid when:</strong> You need fast index-based access (use arrays)</li>
</ul>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
