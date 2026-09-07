<?php $pageTitle = 'Stacks'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Stacks</h1>
    <p class="lesson-desc">Learn the LIFO (Last In, First Out) data structure — push, pop, peek, and real-world applications.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Before we learn about stacks, let's think about everyday experiences and prior knowledge. Ask yourself these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a stack of plates? When you take a plate, which one do you grab — the top or the bottom?</li>
        <li>In a linked list, how do you access the last element added? What would happen if you always removed from the end?</li>
        <li>What does "LIFO" stand for, and can you think of a real-life example besides plates?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>A <strong>stack</strong> is a linear data structure that follows the <strong>LIFO (Last In, First Out)</strong> principle. The last element added is the first one removed. You can only access the <strong>top</strong> of the stack.</p>

<h3>Analogy</h3>
<p>Imagine a stack of plates in a cafeteria. You always add a plate to the <strong>top</strong> and remove from the <strong>top</strong>. You can't pull a plate from the middle or bottom without disrupting the whole stack. The same rule applies to data in a stack — operations happen at one end only.</p>

<h3>How It Works (Step by Step)</h3>
<p>A stack supports four core operations:</p>
<ul>
    <li><strong>push(item)</strong> — Add an element to the top.</li>
    <li><strong>pop()</strong> — Remove and return the top element.</li>
    <li><strong>peek()/top()</strong> — View the top element without removing it.</li>
    <li><strong>isEmpty()</strong> — Check if the stack has no elements.</li>
    <li><strong>size()</strong> — Return the number of elements.</li>
</ul>

<h3>Stack Implementation</h3>
<pre><code class="language-php">&lt;?php
class Stack {
    private $items = [];

    public function push($item) {
        $this->items[] = $item;
    }

    public function pop() {
        if ($this->isEmpty()) throw new \Exception("Stack underflow");
        return array_pop($this->items);
    }

    public function peek() {
        if ($this->isEmpty()) throw new \Exception("Stack is empty");
        return end($this->items);
    }

    public function isEmpty() {
        return empty($this->items);
    }

    public function size() {
        return count($this->items);
    }
}

$stack = new Stack();
$stack->push(10);
$stack->push(20);
$stack->push(30);
echo $stack->peek();   // 30
echo $stack->pop();    // 30
echo $stack->pop();    // 20
echo $stack->size();   // 1</code></pre>

<h3>Balanced Parentheses</h3>
<p>A classic stack problem: given a string of parentheses, check if they are balanced (every opening bracket has a matching closing bracket in the correct order).</p>
<pre><code class="language-php">&lt;?php
function isBalanced($str) {
    $stack = new Stack();
    $pairs = [')' => '(', ']' => '[', '}' => '{'];

    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        if (in_array($char, ['(', '[', '{'])) {
            $stack->push($char);
        } elseif (array_key_exists($char, $pairs)) {
            if ($stack->isEmpty() || $stack->pop() !== $pairs[$char]) {
                return false;
            }
        }
    }
    return $stack->isEmpty();
}

echo isBalanced('({[]})') . "\n";  // true
echo isBalanced('({[}])') . "\n";  // false
echo isBalanced('((()') . "\n";    // false</code></pre>

<h3>Infix to Postfix Conversion</h3>
<pre><code class="language-php">&lt;?php
function infixToPostfix($expression) {
    $output = '';
    $stack = new Stack();
    $precedence = ['+' => 1, '-' => 1, '*' => 2, '/' => 2];

    $tokens = preg_split('/\s+/', $expression);

    foreach ($tokens as $token) {
        if (is_numeric($token)) {
            $output .= $token . ' ';
        } elseif ($token === '(') {
            $stack->push($token);
        } elseif ($token === ')') {
            while (!$stack->isEmpty() && $stack->peek() !== '(') {
                $output .= $stack->pop() . ' ';
            }
            $stack->pop(); // Remove '('
        } else {
            while (!$stack->isEmpty() && $stack->peek() !== '(' &&
                   ($precedence[$stack->peek()] ?? 0) >= ($precedence[$token] ?? 0)) {
                $output .= $stack->pop() . ' ';
            }
            $stack->push($token);
        }
    }
    while (!$stack->isEmpty()) $output .= $stack->pop() . ' ';
    return trim($output);
}

echo infixToPostfix('3 + 4 * 2');      // 3 4 2 * +
echo infixToPostfix('( 3 + 4 ) * 2');  // 3 4 + 2 *</code></pre>

<h3>Browser Back Button</h3>
<pre><code class="language-php">&lt;?php
class BrowserHistory {
    private $backStack = [];
    private $forwardStack = [];
    private $current;

    public function __construct($url) { $this->current = $url; }

    public function visit($url) {
        $this->backStack[] = $this->current;
        $this->current = $url;
        $this->forwardStack = [];
    }

    public function back() {
        if (empty($this->backStack)) return;
        $this->forwardStack[] = $this->current;
        $this->current = array_pop($this->backStack);
    }

    public function forward() {
        if (empty($this->forwardStack)) return;
        $this->backStack[] = $this->current;
        $this->current = array_pop($this->forwardStack);
    }

    public function current() { return $this->current; }
}</code></pre>

<h3>Stack Complexity</h3>

<table>
    <thead><tr><th>Operation</th><th>Time</th><th>Space</th></tr></thead>
    <tbody>
        <tr><td>push</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>pop</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>peek</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>search</td><td>O(n)</td><td>O(1)</td></tr>
    </tbody>
</table>

<h3>Python Example: Stack Operations</h3>
<p>A stack is like a pile of plates — you can only add or remove from the top.</p>
<pre><code class="language-python"># Stack: Last In, First Out (LIFO)
class Stack:
    def __init__(self):
        self.items = []

    # Add to top - O(1)
    def push(self, item):
        self.items.append(item)

    # Remove from top - O(1)
    def pop(self):
        if not self.is_empty():
            return self.items.pop()
        return None

    # Look at top without removing - O(1)
    def peek(self):
        if not self.is_empty():
            return self.items[-1]
        return None

    # Check if empty - O(1)
    def is_empty(self):
        return len(self.items) == 0

# Test it
stack = Stack()
stack.push("A")
stack.push("B")
stack.push("C")
print(stack.pop())    # C (last in, first out)
print(stack.peek())   # B (now B is on top)
print(stack.pop())    # B
print(stack.pop())    # A
print(stack.is_empty())  # True
</code></pre>
<strong>Output:</strong>
<pre>C
B
B
A
True</pre>

<h3>Java Example: Stack Operations</h3>
<p>A stack is like a pile of plates — you can only add or remove from the top.</p>
<pre><code class="language-java">import java.util.Stack;

public class Main {
    public static void main(String[] args) {
        // Java has a built-in Stack class
        Stack&lt;String&gt; stack = new Stack&lt;&gt;();

        // Add to top - O(1)
        stack.push("A");
        stack.push("B");
        stack.push("C");

        // Remove from top - O(1)
        System.out.println(stack.pop());   // C (last in, first out)

        // Look at top without removing - O(1)
        System.out.println(stack.peek());  // B (now B is on top)

        // Remove more items
        System.out.println(stack.pop());   // B
        System.out.println(stack.pop());   // A

        // Check if empty - O(1)
        System.out.println(stack.isEmpty());  // true
    }
}
</code></pre>
<strong>Output:</strong>
<pre>C
B
B
A
true</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Undo/Redo in Text Editors</strong> — Every action is pushed onto an undo stack. Undo pops from the undo stack and pushes to redo.</li>
    <li><strong>Expression Evaluation</strong> — Compilers use stacks to evaluate postfix expressions and convert infix to postfix.</li>
    <li><strong>Function Call Stack</strong> — Each function call is pushed onto the call stack; when it returns, it's popped.</li>
    <li><strong>Browser Navigation</strong> — Back and forward buttons use two stacks to track visited pages.</li>
    <li><strong>Syntax Parsing</strong> — Compilers check balanced brackets, matching tags, and nested structures using stacks.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Never pop from an empty stack — always check <code>isEmpty()</code> first.</li>
    <li>Use stacks whenever you need to process things in <strong>reverse order</strong> of how they arrived.</li>
    <li>For balanced parentheses, push opening brackets and match with closing brackets on pop.</li>
    <li>Stacks are often used <strong>recursively</strong> — recursion implicitly uses the call stack.</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Use Stack When...</th><th>Use Array/List When...</th></tr></thead>
    <tbody>
        <tr><td>You need LIFO ordering</td><td>You need random access by index</td></tr>
        <tr><td>Undo/redo functionality</td><td>You need FIFO ordering (use queue)</td></tr>
        <tr><td>Validating nested structures</td><td>You need to search or sort</td></tr>
        <tr><td>Backtracking algorithms (maze solving)</td><td>You need to iterate in both directions</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a simple text editor with undo/redo functionality. The editor supports three operations: typing text, bolding text, and changing text color. Each action can be undone or redone.</p>
    <p><strong>Task:</strong> Trace through the following sequence of operations and show the state of both stacks at each step:</p>
    <ol>
        <li>Type "Hello"</li>
        <li>Bold text</li>
        <li>Change color to red</li>
        <li>Undo (twice)</li>
        <li>Redo (once)</li>
        <li>Type "World"</li>
    </ol>
    <p>Show the undo stack, redo stack, and current state after each step.</p>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Step-by-step trace:</strong></p>
        <pre><code>Step 1: Type "Hello"
  Undo Stack: ["Type \"Hello\""]
  Redo Stack: []
  Current: "Hello"

Step 2: Bold text
  Undo Stack: ["Type \"Hello\"", "Bold text"]
  Redo Stack: []
  Current: "Hello" (bold)

Step 3: Change color
  Undo Stack: ["Type \"Hello\"", "Bold text", "Change color"]
  Redo Stack: []
  Current: "Hello" (bold, red)

Step 4: Undo (once)
  Undo Stack: ["Type \"Hello\"", "Bold text"]
  Redo Stack: ["Change color"]
  Current: "Hello" (bold)

Step 5: Undo (twice)
  Undo Stack: ["Type \"Hello\""]
  Redo Stack: ["Change color", "Bold text"]
  Current: "Hello" (plain)

Step 6: Redo (once)
  Undo Stack: ["Type \"Hello\"", "Bold text"]
  Redo Stack: ["Change color"]
  Current: "Hello" (bold)

Step 7: Type "World"
  Undo Stack: ["Type \"Hello\"", "Bold text", "Type \"World\""]
  Redo Stack: []  ← cleared because new action was performed
  Current: "Hello World" (bold)</code></pre>

        <p><strong>PHP Implementation</strong></p>
        <pre><code>&lt;?php
class TextEditor {
    private $undoStack = [];
    private $redoStack = [];
    private $content = "";

    public function performAction($action, $value = null) {
        $this->undoStack[] = ['action' => $action, 'value' => $value];
        $this->redoStack = [];

        if ($action === 'type') {
            $this->content .= $value;
        }
        echo "  Performed: $action" . ($value ? " \"$value\"" : "") . "\n";
        $this->printState();
    }

    public function undo() {
        if (empty($this->undoStack)) { echo "  Nothing to undo\n"; return; }
        $entry = array_pop($this->undoStack);
        $this->redoStack[] = $entry;
        echo "  Undid: {$entry['action']}\n";
        $this->printState();
    }

    public function redo() {
        if (empty($this->redoStack)) { echo "  Nothing to redo\n"; return; }
        $entry = array_pop($this->redoStack);
        $this->undoStack[] = $entry;
        echo "  Redid: {$entry['action']}\n";
        $this->printState();
    }

    public function printState() {
        echo "  Undo: [" . implode(', ', array_column($this->undoStack, 'action')) . "]\n";
        echo "  Redo: [" . implode(', ', array_column($this->redoStack, 'action')) . "]\n\n";
    }
}

$editor = new TextEditor();
$editor->performAction('type', 'Hello');
$editor->performAction('bold');
$editor->performAction('color', 'red');
$editor->undo();
$editor->undo();
$editor->redo();
$editor->performAction('type', 'World');</code></pre>

        <p><strong>Python Implementation</strong></p>
        <pre><code>class TextEditor:
    def __init__(self):
        self.undo_stack = []
        self.redo_stack = []
        self.content = ""

    def perform_action(self, action, value=None):
        self.undo_stack.append({'action': action, 'value': value})
        self.redo_stack = []
        if action == 'type':
            self.content += value
        print(f"  Performed: {action}" + (f' "{value}"' if value else ""))
        self.print_state()

    def undo(self):
        if not self.undo_stack:
            print("  Nothing to undo")
            return
        entry = self.undo_stack.pop()
        self.redo_stack.append(entry)
        print(f"  Undid: {entry['action']}")
        self.print_state()

    def redo(self):
        if not self.redo_stack:
            print("  Nothing to redo")
            return
        entry = self.redo_stack.pop()
        self.undo_stack.append(entry)
        print(f"  Redid: {entry['action']}")
        self.print_state()

    def print_state(self):
        undo_actions = [e['action'] for e in self.undo_stack]
        redo_actions = [e['action'] for e in self.redo_stack]
        print(f"  Undo: {undo_actions}")
        print(f"  Redo: {redo_actions}\n")

editor = TextEditor()
editor.perform_action('type', 'Hello')
editor.perform_action('bold')
editor.perform_action('color', 'red')
editor.undo()
editor.undo()
editor.redo()
editor.perform_action('type', 'World')</code></pre>

        <p><strong>Java Implementation</strong></p>
        <pre><code>import java.util.ArrayList;
import java.util.List;
import java.util.HashMap;

class TextEditor {
    private List&lt;HashMap&lt;String, Object&gt;&gt; undoStack = new ArrayList&lt;&gt;();
    private List&lt;HashMap&lt;String, Object&gt;&gt; redoStack = new ArrayList&lt;&gt;();

    public void performAction(String action, String value) {
        HashMap&lt;String, Object&gt; entry = new HashMap&lt;&gt;();
        entry.put("action", action);
        entry.put("value", value);
        undoStack.add(entry);
        redoStack.clear();
        System.out.println("  Performed: " + action + (value != null ? " \"" + value + "\"" : ""));
        printState();
    }

    public void undo() {
        if (undoStack.isEmpty()) { System.out.println("  Nothing to undo"); return; }
        HashMap&lt;String, Object&gt; entry = undoStack.remove(undoStack.size() - 1);
        redoStack.add(entry);
        System.out.println("  Undid: " + entry.get("action"));
        printState();
    }

    public void redo() {
        if (redoStack.isEmpty()) { System.out.println("  Nothing to redo"); return; }
        HashMap&lt;String, Object&gt; entry = redoStack.remove(redoStack.size() - 1);
        undoStack.add(entry);
        System.out.println("  Redid: " + entry.get("action"));
        printState();
    }

    public void printState() {
        List&lt;String&gt; undoActions = new ArrayList&lt;&gt;();
        for (var e : undoStack) undoActions.add((String) e.get("action"));
        List&lt;String&gt; redoActions = new ArrayList&lt;&gt;();
        for (var e : redoStack) redoActions.add((String) e.get("action"));
        System.out.println("  Undo: " + undoActions);
        System.out.println("  Redo: " + redoActions + "\n");
    }
}

public class Main {
    public static void main(String[] args) {
        TextEditor editor = new TextEditor();
        editor.performAction("type", "Hello");
        editor.performAction("bold", null);
        editor.performAction("color", "red");
        editor.undo();
        editor.undo();
        editor.redo();
        editor.performAction("type", "World");
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
