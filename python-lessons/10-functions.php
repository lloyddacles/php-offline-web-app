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
<pre><code class="language-python"># Function to calculate average
def get_average(scores):
    total = sum(scores)
    count = len(scores)
    return total / count

# Test with student scores
math = [85, 90, 78]
science = [92, 88, 95]

# Call the function
math_avg = get_average(math)
science_avg = get_average(science)

print("Math average:", math_avg)
print("Science average:", science_avg)
</code></pre>
<strong>Output:</strong>
<pre>Math average: 84.33333333333333
Science average: 91.66666666666667</pre>

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
def get_average(scores):
    return sum(scores) / len(scores)

def get_grade(score):
    if score >= 90:
        return "A"
    elif score >= 80:
        return "B"
    else:
        return "C"

# Test the functions
math_scores = [85, 90, 78]
avg = get_average(math_scores)
grade = get_grade(avg)

print("Scores:", math_scores)
print("Average:", avg)
print("Grade:", grade)
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
