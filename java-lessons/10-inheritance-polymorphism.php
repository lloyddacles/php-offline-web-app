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
<pre><code class="language-java">public class Main {                         // Main class

    // Parent class (superclass)
    static class Animal {                   // Base class for all animals
        String name;                        // Field: stores name

        Animal(String name) {               // Constructor
            this.name = name;               // Set the name
        }

        void speak() {                      // Method to override
            System.out.println(name + " makes a sound");
        }
    }

    // Child class (subclass) inherits from Animal
    static class Dog extends Animal {       // Dog IS-A Animal
        Dog(String name) {                  // Constructor
            super(name);                    // Call parent constructor
        }

        @Override                           // Override parent method
        void speak() {                      // Dog speaks differently
            System.out.println(name + " barks!");
        }
    }

    public static void main(String[] args) { // Entry point
        Animal a = new Animal("Cat");       // Create parent object
        Animal d = new Dog("Rex");          // Child stored in parent type

        a.speak();                          // Calls Animal's speak
        d.speak();                          // Calls Dog's speak (polymorphism)
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Cat makes a sound
Rex barks!</pre>

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
        <pre><code class="language-java">public class Main {                         // Main class

    static class Animal {                   // Parent class
        String name;                        // Animal name

        Animal(String name) {               // Constructor
            this.name = name;               // Set name
        }

        void speak() {                      // Method to override
            System.out.println(name + " makes a sound");
        }
    }

    static class Cat extends Animal {       // Cat inherits from Animal
        Cat(String name) {                  // Constructor
            super(name);                    // Call parent constructor
        }

        @Override                           // Override parent method
        void speak() {                      // Cat speaks differently
            System.out.println(name + " meows!");
        }
    }

    public static void main(String[] args) { // Entry point
        Animal a = new Animal("Dog");       // Parent object
        Animal c = new Cat("Kitty");        // Child in parent type

        a.speak();                          // Calls Animal's speak
        c.speak();                          // Calls Cat's speak (polymorphism)
    }
}
</code></pre>
        <p><strong>Output:</strong></p>
        <pre>Dog makes a sound
Kitty meows!</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
