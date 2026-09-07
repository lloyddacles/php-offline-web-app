<?php $pageTitle = 'Introduction to PHP'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $prevNext = getPrevNextLesson($num, 'lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Introduction to PHP</h1>
    <p class="lesson-desc">Learn what PHP is, how it works, and write your first PHP script.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Have you ever visited a website like Facebook or Wikipedia? How do you think they work behind the scenes?</li>
        <li>What happens when you type a URL in your browser and press Enter?</li>
        <li>Have you ever used HTML or CSS before? What's the difference between what happens in the browser versus on a server?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>PHP (PHP: Hypertext Preprocessor) is a server-side scripting language designed for web development. It runs on the web server and generates HTML that is sent to the user's browser.</p>

<h3>Analogy</h3>
<p>Think of a restaurant: the customer (browser) places an order (request), the waiter (PHP) takes it to the kitchen (server), the chef prepares the food (processes the code), and the waiter brings back the finished dish (HTML) for the customer to enjoy. The customer never sees the kitchen operations.</p>

<h3>How It Works (Step by Step)</h3>
<p>1. A user visits a PHP page in their browser</p>
<p>2. The web server reads the PHP file</p>
<p>3. PHP processes the code and generates HTML</p>
<p>4. The server sends the resulting HTML to the user's browser</p>
<p>5. The browser displays the page - the user never sees the PHP code</p>

<h3>Example</h3>
<pre><code class="language-php">&lt;?php
// Print a welcome message
echo "Hello, World!";

// Print another line
echo "\n";
echo "Welcome to PHP!";
</code></pre>
<strong>Output:</strong>
<pre>Hello, World!
Welcome to PHP!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li>WordPress powers over 40% of all websites - it's built with PHP</li>
    <li>Facebook, Wikipedia, and millions of websites use PHP for server-side processing</li>
    <li>PHP can handle form submissions, manage databases, create dynamic pages, and build complete web applications</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Start with PHP's built-in server for learning - it's simple and requires no setup</li>
    <li>Always save PHP files with the .php extension</li>
    <li>Use echo to output text and test your code as you learn</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li>Forgetting to include &lt;?php ?&gt; tags around PHP code</li>
    <li>Trying to run PHP files directly in a browser instead of through a server</li>
    <li>Not understanding the difference between client-side (browser) and server-side (PHP) processing</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You're building your first website and want to display a welcome message to visitors.</p>
    <p><strong>Task:</strong> Write a complete PHP script that outputs a personalized welcome message.</p>
    <ol>
        <li>What tags do you need to open and close PHP code?</li>
        <li>Write a PHP script that outputs "Hello, [Your Name]!" to the browser</li>
        <li>Add a second echo statement that outputs "Welcome to my first PHP website!"</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> You need &lt;?php to open and ?&gt; to close PHP code.</p>
        <p><strong>Answer 2:</strong> echo "Hello, [Your Name]!";</p>
        <p><strong>Answer 3:</strong> Complete script with both echo statements</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>&lt;?php
echo "Hello, John!";
echo "\n";
echo "Welcome to my first PHP website!";
?&gt;</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>