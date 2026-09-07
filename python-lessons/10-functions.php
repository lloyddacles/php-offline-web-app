<?php $pageTitle = 'Functions'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Functions</h1>
    <p class="lesson-desc">Write reusable code with parameters, return values, lambda expressions, and recursion.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the purpose of the <code>def</code> keyword in Python?</li>
        <li>What is the difference between parameters and arguments?</li>
        <li>What is the scope of a variable defined inside a function?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Functions are reusable blocks of code that perform a specific task. Use <code>def</code> to define a function, specify parameters in parentheses, and use <code>return</code> to send back a value. Python supports default parameters, variable-length arguments (<code>*args</code>, <code>**kwargs</code>), lambda (anonymous) functions, and recursion.</p>

<h3>Analogy</h3>
<p>A function is like a vending machine. You put in inputs (coins and button selection), the machine processes them internally, and out comes a product (return value). You don't need to know how the machine works inside — you just need to know what inputs it accepts and what it gives back. Different machines (functions) do different jobs, and you can use the same machine as many times as you want.</p>

<h3>How It Works</h3>
<p>Define a function with <code>def name(params):</code>, followed by an indented block. Use <code>return</code> to output a value. Variables inside functions are <strong>local</strong> — they don't affect variables outside. Use <code>global</code> sparingly. Lambda functions are one-line anonymous functions: <code>lambda x: x ** 2</code>. Recursion requires a base case to stop.</p>

<h3>Example</h3>
<pre><code class="language-python"># Basic function with default parameter
def calculate_tax(price, tax_rate=0.1):
    """Calculate price with tax."""
    return price * (1 + tax_rate)

print(f"Tax on $100: ${calculate_tax(100):.2f}")
print(f"Tax at 20%: ${calculate_tax(100, 0.2):.2f}")

# *args - variable positional arguments
def find_max(*numbers):
    return max(numbers)

print(f"Max: {find_max(3, 7, 2, 9, 1)}")

# Lambda with map and filter
nums = [1, 2, 3, 4, 5]
doubled = list(map(lambda x: x * 2, nums))
evens = list(filter(lambda x: x % 2 == 0, nums))
print(f"Doubled: {doubled}")
print(f"Evens: {evens}")

# Recursion - factorial
def factorial(n):
    if n <= 1:  # Base case
        return 1
    return n * factorial(n - 1)  # Recursive case

print(f"5! = {factorial(5)}")
</code></pre>
<strong>Output:</strong>
<pre>Tax on $100: $110.00
Tax at 20%: $120.00
Max: 9
Doubled: [2, 4, 6, 8, 10]
Evens: [2, 4]
5! = 120</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Code Reuse:</strong> Write a validation function once, use it across your entire application</li>
    <li><strong>Data Processing:</strong> Create functions to clean, transform, and analyze data</li>
    <li><strong>API Design:</strong> Functions with clear parameters and return values form building blocks</li>
    <li><strong>Testing:</strong> Small, focused functions are easier to unit test</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Keep functions short and focused — one function, one job</li>
    <li>Use docstrings to describe what the function does, its parameters, and return value</li>
    <li>Prefer returning values over printing them — it makes functions more reusable</li>
    <li>Use <code>lambda</code> for short one-line operations; use <code>def</code> for everything else</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using mutable default arguments: <code>def func(items=[])</code> — the list persists across calls</li>
    <li>Forgetting to return a value — the function returns <code>None</code> implicitly</li>
    <li>Using <code>global</code> when you should pass parameters instead</li>
    <li>Deep recursion without a base case — causes a RecursionError</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a simple grade book. You need functions to calculate averages, determine letter grades, and generate a summary report. You also need a helper function using lambda to sort students by their average.</p>
    <p><strong>Task:</strong> Create functions to process student grades.</p>
    <ol>
        <li>Create a function that takes a list of scores and returns the average</li>
        <li>Create a function that converts a numeric average to a letter grade (A/B/C/D/F)</li>
        <li>Create a function that takes a dictionary of {student: [scores]} and returns a sorted list of (student, average) tuples</li>
        <li>Use a lambda to sort by average in descending order</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should create functions with proper parameters, return values, and use lambda for sorting.</p>
        <pre><code># Grade book functions
def calculate_average(scores):
    """Calculate the average of a list of scores."""
    return sum(scores) / len(scores)

def get_letter_grade(average):
    """Convert numeric average to letter grade."""
    if average >= 90:
        return "A"
    elif average >= 80:
        return "B"
    elif average >= 70:
        return "C"
    elif average >= 60:
        return "D"
    else:
        return "F"

def grade_summary(students):
    """Generate sorted summary of student grades."""
    summary = []
    for name, scores in students.items():
        avg = calculate_average(scores)
        letter = get_letter_grade(avg)
        summary.append((name, avg, letter))
    # Sort by average descending using lambda
    summary.sort(key=lambda x: x[1], reverse=True)
    return summary

# Test the functions
students = {
    "Alice": [92, 88, 95],
    "Bob": [78, 82, 80],
    "Charlie": [95, 98, 92],
    "Diana": [85, 90, 88],
}

results = grade_summary(students)
print("===== Grade Summary =====")
for name, avg, letter in results:
    print(f"{name:10} | Avg: {avg:5.1f} | Grade: {letter}")</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
