<?php $pageTitle = 'Stacks'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 8; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Stacks</h1>
    <p class="lesson-desc">Learn the LIFO (Last In, First Out) data structure — push, pop, peek, and real-world applications.</p>
</div>

<h2>What Is a Stack?</h2>
<p>A <strong>stack</strong> is a linear data structure that follows the <strong>LIFO (Last In, First Out)</strong> principle. Think of a stack of plates — you add to the top and remove from the top.</p>

<div class="info-box note">
    <div class="box-title">Core Operations</div>
    <p><strong>push(item)</strong> — Add to top<br>
    <strong>pop()</strong> — Remove from top<br>
    <strong>peek()/top()</strong> — View top without removing<br>
    <strong>isEmpty()</strong> — Check if empty<br>
    <strong>size()</strong> — Number of elements</p>
</div>

<h2>Implementation Using Arrays</h2>
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

<h2>Real-World Applications</h2>

<h3>1. Undo/Redo</h3>
<pre><code class="language-php">&lt;?php
class UndoRedo {
    private $undoStack = [];
    private $redoStack = [];

    public function performAction($action) {
        $this->undoStack[] = $action;
        $this->redoStack = [];  // Clear redo on new action
    }

    public function undo() {
        if (empty($this->undoStack)) return null;
        $action = array_pop($this->undoStack);
        $this->redoStack[] = $action;
        return "Undid: $action";
    }

    public function redo() {
        if (empty($this->redoStack)) return null;
        $action = array_pop($this->redoStack);
        $this->undoStack[] = $action;
        return "Redid: $action";
    }
}

$editor = new UndoRedo();
$editor->performAction('Type "Hello"');
$editor->performAction('Bold text');
$editor->performAction('Change color');
echo $editor->undo();  // Undid: Change color</code></pre>

<h3>2. Balanced Parentheses</h3>
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

<h3>3. Infix to Postfix Conversion</h3>
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

<h3>4. Browser History</h3>
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

<h2>Stack Complexity</h2>

<table>
    <thead><tr><th>Operation</th><th>Time</th><th>Space</th></tr></thead>
    <tbody>
        <tr><td>push</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>pop</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>peek</td><td>O(1)</td><td>O(1)</td></tr>
        <tr><td>search</td><td>O(n)</td><td>O(1)</td></tr>
    </tbody>
</table>

<h2>Python Implementation</h2>
<pre><code class="language-python">
class Stack:
    def __init__(self):
        self.items = []

    def push(self, item):
        self.items.append(item)

    def pop(self):
        if self.is_empty():
            raise IndexError("Stack underflow")
        return self.items.pop()

    def peek(self):
        if self.is_empty():
            raise IndexError("Stack is empty")
        return self.items[-1]

    def is_empty(self):
        return len(self.items) == 0

    def size(self):
        return len(self.items)

stack = Stack()
stack.push(10)
stack.push(20)
stack.push(30)
print(stack.peek())   # 30
print(stack.pop())    # 30
print(stack.pop())    # 20
print(stack.size())   # 1

def is_balanced(s):
    stack = Stack()
    pairs = {')': '(', ']': '[', '}': '{'}
    for char in s:
        if char in '([{':
            stack.push(char)
        elif char in pairs:
            if stack.is_empty() or stack.pop() != pairs[char]:
                return False
    return stack.is_empty()

print(is_balanced('({[]})'))  # True
print(is_balanced('({[}])'))  # False

class BrowserHistory:
    def __init__(self, url):
        self.current = url
        self.back_stack = []
        self.forward_stack = []

    def visit(self, url):
        self.back_stack.append(self.current)
        self.current = url
        self.forward_stack = []

    def back(self):
        if not self.back_stack:
            return
        self.forward_stack.append(self.current)
        self.current = self.back_stack.pop()

    def forward(self):
        if not self.forward_stack:
            return
        self.back_stack.append(self.current)
        self.current = self.forward_stack.pop()

    def get_current(self):
        return self.current

history = BrowserHistory('google.com')
history.visit('youtube.com')
history.visit('github.com')
history.back()
print(history.get_current())  # youtube.com
</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">
import java.util.ArrayList;
import java.util.List;

class Stack&lt;T&gt; {
    private List&lt;T&gt; items = new ArrayList&lt;&gt;();

    public void push(T item) {
        items.add(item);
    }

    public T pop() {
        if (isEmpty()) throw new RuntimeException("Stack underflow");
        return items.remove(items.size() - 1);
    }

    public T peek() {
        if (isEmpty()) throw new RuntimeException("Stack is empty");
        return items.get(items.size() - 1);
    }

    public boolean isEmpty() {
        return items.isEmpty();
    }

    public int size() {
        return items.size();
    }
}

class BrowserHistory {
    private Stack&lt;String&gt; backStack = new Stack&lt;&gt;();
    private Stack&lt;String&gt; forwardStack = new Stack&lt;&gt;();
    private String current;

    public BrowserHistory(String url) {
        this.current = url;
    }

    public void visit(String url) {
        backStack.push(current);
        current = url;
        forwardStack = new Stack&lt;&gt;();
    }

    public void back() {
        if (backStack.isEmpty()) return;
        forwardStack.push(current);
        current = backStack.pop();
    }

    public void forward() {
        if (forwardStack.isEmpty()) return;
        backStack.push(current);
        current = forwardStack.pop();
    }

    public String getCurrent() {
        return current;
    }
}

public class Main {
    public static boolean isBalanced(String s) {
        Stack&lt;Character&gt; stack = new Stack&lt;&gt;();
        for (char c : s.toCharArray()) {
            if (c == '(' || c == '[' || c == '{') {
                stack.push(c);
            } else if (c == ')' || c == ']' || c == '}') {
                if (stack.isEmpty()) return false;
                char top = stack.pop();
                if ((c == ')' &amp;&amp; top != '(') ||
                    (c == ']' &amp;&amp; top != '[') ||
                    (c == '}' &amp;&amp; top != '{')) {
                    return false;
                }
            }
        }
        return stack.isEmpty();
    }

    public static void main(String[] args) {
        Stack&lt;Integer&gt; stack = new Stack&lt;&gt;();
        stack.push(10);
        stack.push(20);
        stack.push(30);
        System.out.println(stack.peek());  // 30
        System.out.println(stack.pop());   // 30

        System.out.println(isBalanced("({[]})"));  // true
        System.out.println(isBalanced("({[}])"));  // false
    }
}
</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
