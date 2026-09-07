<?php $pageTitle = 'Object-Oriented Programming'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 9; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Object-Oriented Programming</h1>
    <p class="lesson-desc">Learn the foundations of OOP in Java: classes, constructors, the <code>this</code> keyword, access modifiers, and getters/setters.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is the difference between a blueprint and the actual thing it creates? Can you give an example?</li>
        <li>Why would you want to group related data and behavior together in one place?</li>
        <li>What is encapsulation? Why is it important to hide internal details from the outside world?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Object-Oriented Programming (OOP)</strong> is a programming paradigm organized around objects rather than functions. A <strong>class</strong> is a blueprint that defines fields (data) and methods (behavior). An <strong>object</strong> is an instance of that class. <strong>Constructors</strong> initialize objects when they are created.</p>

<h3>Analogy</h3>
<p>Think of a class like a cookie cutter. The cutter defines the shape (fields and methods). Each cookie you make is an object — same shape, but each is its own independent cookie with its own frosting (data). The <code>this</code> keyword is like pointing to yourself: "I'm talking about <em>this</em> specific cookie."</p>

<h3>How It Works</h3>
<ul>
    <li><strong>Class</strong> — Defines the structure (fields) and behavior (methods)</li>
    <li><strong>Object</strong> — An instance created with <code>new</code>: <code>Car myCar = new Car();</code></li>
    <li><strong>Constructor</strong> — Special method called when creating an object (same name as class, no return type)</li>
    <li><strong>this keyword</strong> — Refers to the current object instance</li>
    <li><strong>Access modifiers</strong> — Control visibility: <code>public</code>, <code>private</code>, <code>protected</code></li>
    <li><strong>Getters/Setters</strong> — Provide controlled access to private fields</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class Main {                         // Main class

    // A class is a blueprint for objects
    static class Student {                  // Student blueprint
        String name;                        // Field: stores name
        int age;                            // Field: stores age

        // Constructor: called when creating new object
        Student(String name, int age) {     // Takes name and age
            this.name = name;               // 'this' refers to this object
            this.age = age;                 // Set the age field
        }

        // Method: defines behavior
        void introduce() {                  // No return value (void)
            System.out.println("Hi, I'm " + name + ", age " + age);
        }
    }

    public static void main(String[] args) { // Entry point
        Student s1 = new Student("Juan", 20); // Create first student
        Student s2 = new Student("Ana", 21);  // Create second student

        s1.introduce();                     // Call introduce on s1
        s2.introduce();                     // Call introduce on s2
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Hi, I'm Juan, age 20
Hi, I'm Ana, age 21</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>User accounts</strong> — Classes model users with name, email, and permissions</li>
    <li><strong>Game entities</strong> — Player, enemy, and item classes with health, position, and actions</li>
    <li><strong>Product catalogs</strong> — Product classes with name, price, and inventory methods</li>
    <li><strong>Banking systems</strong> — Account classes with deposit, withdrawal, and balance tracking</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Always make fields <code>private</code> and provide getters/setters for controlled access</li>
    <li>Use constructors to ensure objects are created in a valid state</li>
    <li>Use <code>this</code> to resolve naming conflicts between parameters and fields</li>
    <li>Override <code>toString()</code> for meaningful object representations</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Making fields public — breaks encapsulation and allows invalid states</li>
    <li>Forgetting the <code>new</code> keyword — <code>Car myCar;</code> creates a null reference, not an object</li>
    <li>Confusing <code>=</code> (assignment) with <code>==</code> (comparison) for objects</li>
    <li>Not calling the constructor — objects start with null/zero values if not initialized</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building a library management system. Each book has a title, author, and availability status. The system needs to allow borrowing and returning books.</p>
    <p><strong>Task:</strong> Write a Java program that models a Book class and demonstrates creating and using book objects.</p>
    <ol>
        <li>Create a <code>Book</code> class with private fields for title, author, and isAvailable</li>
        <li>Create a constructor that initializes all fields</li>
        <li>Create methods: <code>borrowBook()</code> and <code>returnBook()</code></li>
        <li>Create a getter method for the availability status</li>
        <li>Create two Book objects and demonstrate borrowing and returning</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class Main {                         // Main class

    static class Car {                      // Car blueprint
        String brand;                       // Brand of car
        int year;                           // Year of car

        Car(String brand, int year) {       // Constructor
            this.brand = brand;             // Set brand
            this.year = year;               // Set year
        }

        void display() {                    // Display method
            System.out.println(brand + " " + year); // Print car info
        }
    }

    public static void main(String[] args) { // Entry point
        Car c1 = new Car("Toyota", 2020);   // Create first car
        Car c2 = new Car("Honda", 2022);    // Create second car

        c1.display();                       // Display first car
        c2.display();                       // Display second car
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Toyota 2020
Honda 2022</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
