<?php $pageTitle = 'What is Programming Logic?'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 1; $prevNext = getPrevNextLesson($num, 'programming-logic'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>What is Programming Logic?</h1>
    <p class="lesson-desc">Discover that programming is really just structured thinking — and you already do it every day.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Connect to what students already know:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What instructions do you follow every morning when you get ready for school? Write down each step in order.</li>
        <li>Have you ever followed a cooking recipe? What happens if you skip a step or do them out of order?</li>
        <li>If you had to teach someone how to make a sandwich, what steps would you give them?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Programming logic is the ability to break down a problem into clear, ordered steps that a computer can follow. It's not about memorizing code — it's about <strong>thinking in a structured way</strong>.</p>

<h3>Analogy</h3>
<p>Think of programming logic like a cooking recipe. A recipe tells you exactly what to do, in what order, and what ingredients to use. If you follow the recipe correctly, you get the same delicious dish every time. Programming works the same way — you write a "recipe" of instructions for the computer to follow.</p>

<h3>How It Works (Step by Step)</h3>
<p>Programming logic works by following these principles:</p>
<ol>
    <li><strong>Identify the problem:</strong> What are you trying to accomplish?</li>
    <li><strong>Break it down:</strong> Split the problem into smaller, manageable steps.</li>
    <li><strong>Order the steps:</strong> Arrange them in the correct sequence — order matters!</li>
    <li><strong>Write clear instructions:</strong> Each step must be specific and unambiguous.</li>
    <li><strong>Test and verify:</strong> Run through the steps to make sure they produce the right result.</li>
</ol>

<h3>Example</h3>
<pre><code class="language-php">// PHP Example: Making a cup of coffee
echo "Step 1: Get a mug\n";
echo "Step 2: Add coffee powder\n";
echo "Step 3: Boil water\n";
echo "Step 4: Pour hot water into the mug\n";
echo "Step 5: Stir\n";
echo "\nThat's programming logic — a recipe for the computer!\n";
</code></pre>
<strong>Output:</strong>
<pre>Step 1: Get a mug
Step 2: Add coffee powder
Step 3: Boil water
Step 4: Pour hot water into the mug
Step 5: Stir

That's programming logic — a recipe for the computer!</pre>

<h3>Python Example</h3>
<pre><code class="language-python"># Python Example: Making a cup of coffee
print("Step 1: Get a mug")
print("Step 2: Add coffee powder")
print("Step 3: Boil water")
print("Step 4: Pour hot water into the mug")
print("Step 5: Stir")
print()
print("That's programming logic — a recipe for the computer!")
</code></pre>
<strong>Output:</strong>
<pre>Step 1: Get a mug
Step 2: Add coffee powder
Step 3: Boil water
Step 4: Pour hot water into the mug
Step 5: Stir

That's programming logic — a recipe for the computer!</pre>

<h3>Java Example</h3>
<pre><code class="language-java">// Java Example: Making a cup of coffee
public class Main {
    public static void main(String[] args) {
        System.out.println("Step 1: Get a mug");
        System.out.println("Step 2: Add coffee powder");
        System.out.println("Step 3: Boil water");
        System.out.println("Step 4: Pour hot water into the mug");
        System.out.println("Step 5: Stir");
        System.out.println();
        System.out.println("That's programming logic — a recipe for the computer!");
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Step 1: Get a mug
Step 2: Add coffee powder
Step 3: Boil water
Step 4: Pour hot water into the mug
Step 5: Stir

That's programming logic — a recipe for the computer!</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Mobile apps:</strong> Every app on your phone uses programming logic to decide what to show, when to respond, and how to handle your taps.</li>
    <li><strong>Video games:</strong> Games use logic to determine when a player scores, loses, or levels up.</li>
    <li><strong>Websites:</strong> When you fill out a form online, programming logic validates your input and processes your submission.</li>
    <li><strong>Smart devices:</strong> Your phone's alarm, automatic lights, and voice assistants all follow programmed logic.</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always write out your steps on paper before writing code — this builds your logic skills.</li>
    <li>Think of each instruction as if you're explaining it to someone who has never done the task before.</li>
    <li>Practice by writing algorithms for everyday activities like getting dressed or making breakfast.</li>
</ul>

<h3>Common Mistakes to Avoid</h3>
<ul>
    <li><strong>Skipping steps:</strong> Don't assume the computer "knows" what to do — every step must be explicit.</li>
    <li><strong>Wrong order:</strong> Putting steps out of sequence leads to incorrect results, just like a recipe out of order.</li>
    <li><strong>Focusing on syntax first:</strong> Learn to think logically before worrying about code syntax.</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your friend asks you to teach them how to make a peanut butter and jelly sandwich. They have never made one before and need very specific instructions.</p>
    <p><strong>Task:</strong> Write down the exact steps to make a peanut butter and jelly sandwich, as if explaining to someone who has never seen the ingredients before. Be as specific as possible.</p>
    <ol>
        <li>List every step in order, from getting the ingredients to cleaning up.</li>
        <li>Identify which steps depend on other steps being completed first.</li>
        <li>What would happen if the steps were done in a different order?</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1:</strong> A sample algorithm might be: 1) Get two slices of bread. 2) Open the peanut butter jar. 3) Use a knife to scoop peanut butter. 4) Spread peanut butter on one slice. 5) Open the jelly jar. 6) Use a clean knife to scoop jelly. 7) Spread jelly on the other slice. 8) Press the two slices together. 9) Cut the sandwich in half. 10) Clean the knife and close the jars.</p>
        <p><strong>Answer 2:</strong> Steps 4 and 7 depend on steps 2-3 and 5-6 respectively (you can't spread until you've scooped). Step 8 depends on both slices being prepared. Step 1 must come first.</p>
        <p><strong>Answer 3:</strong> If you press the slices together before spreading anything, you get plain bread. If you try to spread before opening the jar, you can't do it. Order matters — this is sequential logic in action.</p>
        <p><strong>Sample Solution:</strong></p>
        <pre><code>// This is NOT code — it's an algorithm written in plain English
// The key is being precise and complete

// Step 1: Gather ingredients
// - 2 slices of bread
// - Peanut butter
// - Jelly
// - A knife

// Step 2: Prepare the first slice
// - Open the peanut butter jar
// - Use the knife to scoop peanut butter
// - Spread it evenly on one slice of bread

// Step 3: Prepare the second slice
// - Use a CLEAN knife (or wipe the first one)
// - Open the jelly jar
// - Scoop jelly
// - Spread it evenly on the other slice

// Step 4: Combine
// - Place the two slices together (peanut butter and jelly facing each other)

// Step 5: Optional finishing
// - Cut the sandwich in half diagonally or down the middle

// Step 6: Cleanup
// - Close both jars
// - Wash the knife
// - Put away ingredients</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
