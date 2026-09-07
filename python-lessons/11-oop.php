<?php $pageTitle = 'Object-Oriented Programming'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 11; $prevNext = getPrevNextLesson($num, 'python-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Object-Oriented Programming</h1>
    <p class="lesson-desc">Model real-world things with classes, objects, inheritance, and encapsulation.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between a class and an object?</li>
        <li>What is the purpose of the <code>__init__</code> method in a class?</li>
        <li>What is inheritance, and why is it useful in programming?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>
<h3>Definition</h3>
<p>Object-Oriented Programming (OOP) organizes code into <strong>classes</strong> (blueprints) and <strong>objects</strong> (instances). A class defines attributes (data) and methods (behavior). <code>__init__</code> is the constructor that initializes new objects. <strong>Inheritance</strong> lets child classes reuse and extend parent class behavior. <strong>Encapsulation</strong> hides internal details using naming conventions.</p>

<h3>Analogy</h3>
<p>A class is like a cookie cutter — it defines the shape. The cookies you make from it are the objects. Every cookie has the same shape (class structure), but each can have different frosting (instance data). Inheritance is like having a "fancy cookie cutter" that extends a basic cutter with extra details. Encapsulation is like putting the cookie dough recipe inside a locked box — you can use the cookies, but the recipe stays protected.</p>

<h3>How It Works</h3>
<p>Define a class with <code>class ClassName:</code>. The <code>__init__</code> method runs when you create an object with <code>ClassName()</code>. The <code>self</code> parameter refers to the current instance. Methods are functions inside a class. Child classes inherit from parents with <code>class Child(Parent):</code> and can override methods. Python uses naming conventions for access control: <code>_protected</code> and <code>__private</code>.</p>

<h3>Example</h3>
<pre><code class="language-python"># Create a Student class
class Student:
    def __init__(self, name, grade):
        self.name = name
        self.grade = grade

    def is_passing(self):
        return self.grade >= 75

# Create student objects
juan = Student("Juan", 85)
maria = Student("Maria", 72)

# Print student info
print("Student:", juan.name)
print("Grade:", juan.grade)
print("Passing:", juan.is_passing())

print("\nStudent:", maria.name)
print("Grade:", maria.grade)
print("Passing:", maria.is_passing())
</code></pre>
<strong>Output:</strong>
<pre>Student: Juan
Grade: 85
Passing: True

Student: Maria
Grade: 72
Passing: False</pre>

<h2>Part 3: Apply New Knowledge</h2>
<h3>Real-World Applications</h3>
<ul>
    <li><strong>Game Development:</strong> Characters, enemies, and items as objects with shared behaviors</li>
    <li><strong>GUI Applications:</strong> Buttons, windows, and menus as objects with methods</li>
    <li><strong>Banking Systems:</strong> Account classes with deposit, withdraw, and transfer methods</li>
    <li><strong>Web Frameworks:</strong> Django models define database tables as classes</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use <code>__str__</code> to define a human-readable string representation of your objects</li>
    <li>Prefer composition (objects containing other objects) over deep inheritance chains</li>
    <li>Use <code>super().__init__()</code> in child classes to call the parent constructor</li>
    <li>Keep classes focused — each class should represent one concept</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Forgetting <code>self</code> as the first parameter in instance methods</li>
    <li>Confusing class variables (shared) with instance variables (per-object)</li>
    <li>Creating overly complex inheritance hierarchies — keep it shallow</li>
    <li>Not calling <code>super().__init__()</code> in child classes when needed</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a library management system. You need a <code>Book</code> class and a <code>Library</code> class. The library can add books, check out books, and return books. Books should track their title, author, and whether they are currently checked out.</p>
    <p><strong>Task:</strong> Create the Book and Library classes with proper methods.</p>
    <ol>
        <li>Create a <code>Book</code> class with title, author, and is_checked_out attributes</li>
        <li>Add methods to check out and return a book</li>
        <li>Create a <code>Library</code> class that holds a list of books</li>
        <li>Add methods to add books and display available books</li>
        <li>Create objects and test the functionality</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong> Students should create classes with proper __init__, methods, and object interaction.</p>
        <pre><code># Book class
class Book:
    def __init__(self, title, author):
        self.title = title
        self.author = author
        self.is_checked_out = False

    def check_out(self):
        self.is_checked_out = True
        print(self.title, "checked out")

    def return_book(self):
        self.is_checked_out = False
        print(self.title, "returned")

# Test the book
book = Book("Python 101", "John Smith")
print("Title:", book.title)
print("Checked out:", book.is_checked_out)

book.check_out()
print("After checkout:", book.is_checked_out)

book.return_book()
print("After return:", book.is_checked_out)
</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
