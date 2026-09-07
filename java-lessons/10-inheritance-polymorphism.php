<?php $pageTitle = 'Inheritance & Polymorphism'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 10; $prevNext = getPrevNextLesson($num, 'java-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Inheritance &amp; Polymorphism</h1>
    <p class="lesson-desc">Explore class hierarchies with <code>extends</code>, use <code>super</code>, override methods, and understand polymorphism, abstract classes, and interfaces.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>If you have a Dog class and a Cat class, what do they have in common? Could you create a parent class they both share?</li>
        <li>What does it mean to "override" a method? Why would a child class want to change a parent's behavior?</li>
        <li>Can you think of a situation where different objects respond to the same action in different ways (like a shape calculating its own area)?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p><strong>Inheritance</strong> allows a child class to reuse fields and methods from a parent class using <code>extends</code>. <strong>Polymorphism</strong> means "many forms" — a parent reference can point to a child object, and the correct overridden method is called at runtime. <strong>Interfaces</strong> define contracts that classes must follow.</p>

<h3>Analogy</h3>
<p>Think of inheritance like a family tree. Children inherit traits from parents but can also have their own unique characteristics. Polymorphism is like a universal remote — one button (method call) works differently depending on which device (object) it controls. An interface is like a job description — it lists what you must do, but each person (class) does it their own way.</p>

<h3>How It Works</h3>
<ul>
    <li><strong>extends</strong> — Child class inherits from parent class</li>
    <li><strong>@Override</strong> — Redefine a parent method in the child class</li>
    <li><strong>super</strong> — Access parent class methods or constructors</li>
    <li><strong>Abstract class</strong> — Cannot be instantiated; provides partial implementation</li>
    <li><strong>Interface</strong> — Defines a contract; a class can implement multiple interfaces</li>
</ul>

<h3>Example</h3>
<pre><code class="language-java">public class InheritanceDemo {

    // Abstract parent class
    static abstract class Shape {
        String name;
        Shape(String name) { this.name = name; }

        abstract double area();       // Each shape must implement this
        abstract double perimeter();

        void describe() {
            System.out.println(name + " - Area: " + String.format("%.2f", area())
                + ", Perimeter: " + String.format("%.2f", perimeter()));
        }
    }

    // Child classes override parent methods
    static class Circle extends Shape {
        double radius;
        Circle(double radius) {
            super("Circle");         // Call parent constructor
            this.radius = radius;
        }

        @Override
        double area() { return Math.PI * radius * radius; }

        @Override
        double perimeter() { return 2 * Math.PI * radius; }
    }

    static class Rectangle extends Shape {
        double width, height;
        Rectangle(double w, double h) {
            super("Rectangle");
            this.width = w;
            this.height = h;
        }

        @Override
        double area() { return width * height; }

        @Override
        double perimeter() { return 2 * (width + height); }
    }

    // Interface
    interface Drawable {
        void draw();
    }

    static class Canvas implements Drawable {
        public void draw() {
            System.out.println("Drawing on canvas");
        }
    }

    public static void main(String[] args) {
        // Polymorphism: parent type references child objects
        Shape circle = new Circle(5);
        Shape rectangle = new Rectangle(4, 6);

        circle.describe();
        rectangle.describe();

        // Interface usage
        Drawable d = new Canvas();
        d.draw();
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Circle - Area: 78.54, Perimeter: 31.42
Rectangle - Area: 24.00, Perimeter: 20.00
Drawing on canvas</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>GUI frameworks</strong> — Buttons, labels, and text fields inherit from a base Component class</li>
    <li><strong>Game development</strong> — Enemy, NPC, and player classes inherit from a base Character class</li>
    <li><strong>Payment systems</strong> — Credit card, PayPal, and bank transfer implement a Payment interface</li>
    <li><strong>Vehicle systems</strong> — Car, truck, and motorcycle inherit from a Vehicle class</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li>Use inheritance for "is-a" relationships — a Dog <em>is an</em> Animal</li>
    <li>Use interfaces for "can-do" relationships — a Car <em>can</em> be Drivable</li>
    <li>Always use <code>@Override</code> annotation when overriding methods</li>
    <li>Use <code>super()</code> in child constructors to initialize parent fields</li>
</ul>

<h3>Common Mistakes</h3>
<ul>
    <li>Using inheritance for "has-a" relationships — a Car <em>has an</em> Engine, not <em>is an</em> Engine</li>
    <li>Forgetting to call <code>super()</code> — parent fields remain uninitialized</li>
    <li>Not using <code>@Override</code> — typos in method names create new methods instead of overriding</li>
    <li>Trying to instantiate an abstract class — causes a compilation error</li>
</ul>

<h2>Part 4: Assess Your Learning</h2>
<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are designing a simple game with different types of characters. Each character has a name and health, but warriors attack with swords and mages attack with spells. You need to use inheritance and polymorphism to handle different attack styles.</p>
    <p><strong>Task:</strong> Write a Java program that demonstrates inheritance and polymorphism with character classes.</p>
    <ol>
        <li>Create an abstract <code>Character</code> class with name, health, and an abstract <code>attack()</code> method</li>
        <li>Create a <code>Warrior</code> class that extends Character and implements attack with melee</li>
        <li>Create a <code>Mage</code> class that extends Character and implements attack with magic</li>
        <li>Create an array of Character objects and loop through them calling attack()</li>
    </ol>
</div>
<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answers:</strong></p>
        <pre><code class="language-java">public class GameCharacters {

    static abstract class Character {
        String name;
        int health;

        Character(String name, int health) {
            this.name = name;
            this.health = health;
        }

        abstract void attack();

        void display() {
            System.out.println(name + " (HP: " + health + ")");
        }
    }

    static class Warrior extends Character {
        Warrior(String name, int health) {
            super(name, health);
        }

        @Override
        void attack() {
            System.out.println(name + " swings a mighty sword!");
        }
    }

    static class Mage extends Character {
        Mage(String name, int health) {
            super(name, health);
        }

        @Override
        void attack() {
            System.out.println(name + " casts a fireball spell!");
        }
    }

    public static void main(String[] args) {
        Character[] party = {
            new Warrior("Conan", 100),
            new Mage("Gandalf", 80),
            new Warrior("Bjorn", 120),
            new Mage("Merlin", 70)
        };

        for (Character c : party) {
            c.display();
            c.attack();   // Polymorphism: correct attack method called
            System.out.println();
        }
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Conan (HP: 100)
Conan swings a mighty sword!

Gandalf (HP: 80)
Gandalf casts a fireball spell!

Bjorn (HP: 120)
Bjorn swings a mighty sword!

Merlin (HP: 70)
Merlin casts a fireball spell!</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
