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
<pre><code class="language-python"># Define a class
class Dog:
    def __init__(self, name, breed):
        """Initialize a new Dog."""
        self.name = name
        self.breed = breed

    def bark(self):
        return f"{self.name} says Woof!"

    def __str__(self):
        return f"{self.name} ({self.breed})"

# Creating objects
dog1 = Dog("Rex", "German Shepherd")
dog2 = Dog("Buddy", "Golden Retriever")
print(dog1.bark())
print(dog2)

# Inheritance
class Animal:
    def __init__(self, name):
        self.name = name

    def speak(self):
        return "..."

class Cat(Animal):
    def speak(self):
        return f"{self.name} says Meow!"

class Dog2(Animal):
    def speak(self):
        return f"{self.name} says Woof!"

# Polymorphism
animals = [Cat("Whiskers"), Dog2("Rex")]
for animal in animals:
    print(animal.speak())
</code></pre>
<strong>Output:</strong>
<pre>Rex says Woof!
Buddy (Golden Retriever)
Whiskers says Meow!
Rex says Woof!</pre>

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
        <pre><code>class Book:
    def __init__(self, title, author):
        self.title = title
        self.author = author
        self.is_checked_out = False

    def check_out(self):
        if self.is_checked_out:
            print(f"'{self.title}' is already checked out.")
        else:
            self.is_checked_out = True
            print(f"'{self.title}' has been checked out.")

    def return_book(self):
        if not self.is_checked_out:
            print(f"'{self.title}' wasn't checked out.")
        else:
            self.is_checked_out = False
            print(f"'{self.title}' has been returned.")

    def __str__(self):
        status = "Checked Out" if self.is_checked_out else "Available"
        return f"'{self.title}' by {self.author} [{status}]"


class Library:
    def __init__(self, name):
        self.name = name
        self.books = []

    def add_book(self, book):
        self.books.append(book)

    def available_books(self):
        return [b for b in self.books if not b.is_checked_out]

    def display_books(self):
        print(f"\n===== {self.name} =====")
        for book in self.books:
            print(f"  {book}")
        print(f"Available: {len(self.available_books())}")


# Test the system
library = Library("City Library")
library.add_book(Book("1984", "George Orwell"))
library.add_book(Book("Python Crash Course", "Eric Matthes"))
library.add_book(Book("The Hobbit", "J.R.R. Tolkien"))

library.display_books()

library.books[0].check_out()
library.books[1].check_out()

library.display_books()

library.books[0].return_book()
library.display_books()</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
