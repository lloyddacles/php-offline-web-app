# LD TechLab - Offline Programming Tutorial Web App

A self-contained, offline programming tutorial website with **84 interactive lessons** across 7 programming topics. Learn by doing — every lesson includes live code sandboxes that execute directly in your browser.

**Created by Mr. Lloyd Christopher F. Dacles, MIS**

---

## What Is This?

This is a **portable PHP web application** that runs entirely on localhost. Copy it to any computer with PHP installed, run the start script, and you have a full interactive programming tutorial — no internet required.

### Key Features

| Feature | Description |
|---------|-------------|
| **84 Interactive Lessons** | PHP, Python, Java, MySQL, DBMS, DSA, Programming Logic |
| **Live Code Sandboxes** | Edit and run code directly in the browser |
| **Multi-Language Support** | PHP, Python 3, and Java sandboxes with syntax highlighting |
| **Fully Offline** | No CDN, no external dependencies — works without internet |
| **Portable** | Copy the folder to any computer, run one script |
| **Bundled PHP** | PHP binary included — no pre-installation needed |
| **Auto Setup** | Setup script downloads PHP if missing, checks all dependencies |
| **Cross-Platform** | Works on macOS, Linux, and Windows |

---

## Quick Start

### 1. Run Setup (first time only)
```bash
./setup.sh          # macOS / Linux
# or double-click setup.bat on Windows
```

### 2. Start the Server
```bash
./start-server.sh   # macOS / Linux
# or double-click start-server.bat on Windows
```

### 3. Open Your Browser
Navigate to **http://localhost:8000**

That's it! The server auto-opens your browser.

---

## Lesson Library

### Programming Logic (12 Lessons)
*Learn how to think like a programmer*

| # | Topic | Sandbox |
|---|-------|---------|
| 1 | What is Programming Logic? | Yes |
| 2 | Computational Thinking | Yes |
| 3 | Flowcharts & Pseudocode | Yes |
| 4 | Sequential Thinking | Yes |
| 5 | Conditional Logic | Yes |
| 6 | Loop Thinking | Yes |
| 7 | Functions & Modularity | Yes |
| 8 | Thinking About Data | Yes |
| 9 | Debugging Thinking | Yes |
| 10 | Algorithmic Thinking | Yes |
| 11 | Pattern Recognition & Abstraction | Yes |
| 12 | A Problem-Solving Framework | Yes |

### Python (12 Lessons)
*Interactive Python with live execution*

| # | Topic | Sandbox |
|---|-------|---------|
| 1 | Introduction to Python | Yes |
| 2 | Python Syntax Basics | Yes |
| 3 | Variables & Data Types | Yes |
| 4 | Python Operators | Yes |
| 5 | Conditional Statements | Yes |
| 6 | Loop Statements | Yes |
| 7 | Lists & Tuples | Yes |
| 8 | Dictionaries & Sets | Yes |
| 9 | String Mastery | Yes |
| 10 | Functions | Yes |
| 11 | Object-Oriented Programming | Yes |
| 12 | File Handling & Error Handling | Yes |

### Java (12 Lessons)
*Interactive Java with compile-and-run*

| # | Topic | Sandbox |
|---|-------|---------|
| 1 | Introduction to Java | Yes |
| 2 | Java Syntax Basics | Yes |
| 3 | Variables & Data Types | Yes |
| 4 | Java Operators | Yes |
| 5 | Conditional Statements | Yes |
| 6 | Loop Statements | Yes |
| 7 | Arrays & Strings | Yes |
| 8 | Methods | Yes |
| 9 | Object-Oriented Programming | Yes |
| 10 | Inheritance & Polymorphism | Yes |
| 11 | Collections & Generics | Yes |
| 12 | File Handling & Exception Handling | Yes |

### Data Structures & Algorithms (12 Lessons)
*PHP implementations of classic DSA*

| # | Topic | Sandbox |
|---|-------|---------|
| 1 | Introduction to DSA | Yes |
| 2 | Big O Notation | Yes |
| 3 | Arrays & Strings | Yes |
| 4 | Linked Lists | Yes |
| 5 | Stacks | Yes |
| 6 | Queues | Yes |
| 7 | Hash Tables | Yes |
| 8 | Binary Trees & BST | Yes |
| 9 | Graphs | Yes |
| 10 | Sorting Algorithms | Yes |
| 11 | Searching Algorithms | Yes |
| 12 | Dynamic Programming | Yes |

### DBMS Theory (10 Lessons)
*Database design and management concepts*

| # | Topic |
|---|-------|
| 1 | Introduction to DBMS |
| 2 | Database Models |
| 3 | Entity-Relationship Diagrams |
| 4 | Relational Database Concepts |
| 5 | Normalization |
| 6 | Advanced Normalization |
| 7 | SQL Data Definition Language |
| 8 | Transaction Management |
| 9 | Database Security |
| 10 | Database Design Project |

### MySQL (10 Lessons)
*SQL from basics to PHP integration*

| # | Topic |
|---|-------|
| 1 | Introduction to MySQL |
| 2 | Databases and Tables |
| 3 | Inserting Data |
| 4 | Selecting Data |
| 5 | SQL Functions |
| 6 | Updating Data |
| 7 | Deleting Data |
| 8 | MySQL JOINs |
| 9 | Indexes and Performance |
| 10 | PHP & MySQL Integration |

### PHP (16 Lessons)
*Interactive PHP with live execution*

| # | Topic | Sandbox |
|---|-------|---------|
| 1 | Introduction to PHP | Yes |
| 2 | PHP Syntax Basics | Yes |
| 3 | PHP Comments | Yes |
| 4 | PHP Variables | Yes |
| 5 | PHP Data Types | Yes |
| 6 | PHP Strings | Yes |
| 7 | PHP Numbers | Yes |
| 8 | PHP Operators | Yes |
| 9 | PHP Conditionals | Yes |
| 10 | PHP Loops | Yes |
| 11 | PHP Arrays | Yes |
| 12 | PHP Functions | Yes |
| 13 | PHP Superglobals | Yes |
| 14 | PHP Forms | Yes |
| 15 | PHP Sessions & Cookies | Yes |
| 16 | PHP File Handling | Yes |

---

## Project Structure

```
php-offline-web-app/
├── bin/                    # Bundled PHP binary
│   └── php                 # Static PHP 8.5 (macOS ARM64)
├── public/                 # Web root (DocumentRoot)
│   ├── index.php           # Homepage
│   ├── router.php          # Clean URL router
│   ├── status.php          # System status page
│   ├── css/style.css       # All styling
│   └── js/app.js           # Syntax highlighting + sandbox JS
├── lessons/                # 16 PHP lessons
├── python-lessons/         # 12 Python lessons
├── java-lessons/           # 12 Java lessons
├── dsa-lessons/            # 12 DSA lessons
├── dbms-lessons/           # 10 DBMS lessons
├── mysql-lessons/          # 10 MySQL lessons
├── programming-logic/      # 12 Programming Logic lessons
├── sandbox/                # Code execution engines
│   ├── execute.php         # PHP sandbox
│   ├── execute-python.php  # Python sandbox
│   ├── execute-java.php    # Java sandbox
│   └── restricted.ini      # PHP sandbox security config
├── includes/               # Shared PHP templates
│   ├── header.php          # Nav + head
│   ├── footer.php          # Footer
│   └── functions.php       # Helper functions
├── setup.sh                # macOS/Linux installer
├── setup.bat               # Windows installer
├── start-server.sh         # macOS/Linux launcher
└── start-server.bat        # Windows launcher
```

---

## Sandboxes

Each language sandbox runs code server-side with a 5-second timeout:

| Language | Runtime Required | How It Works |
|----------|-----------------|--------------|
| **PHP** | Bundled (included) | Executes via `proc_open` with security restrictions |
| **Python 3** | System `python3` | Executes via `shell_exec` |
| **Java** | JDK 17+ | Compiles with `javac`, runs with `java` |

Check which sandboxes are active at **http://localhost:8000/status**

---

## Transferring to Another Computer

### Option 1: Copy the Folder
1. Copy the entire project folder to a USB drive or shared location
2. Paste it on the target computer
3. Run `./setup.sh` (or `setup.bat` on Windows)
4. Run `./start-server.sh` (or `start-server.bat`)
5. Open http://localhost:8000

### Option 2: Clone from GitHub
```bash
git clone https://github.com/lloyddacles/php-offline-web-app.git
cd php-offline-web-app
./setup.sh
./start-server.sh
```

### System Requirements
- **PHP 7.4+** (auto-installed by setup script if missing)
- **Python 3** (optional — for Python sandboxes)
- **Java JDK 17+** (optional — for Java sandboxes)
- A modern web browser

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| "php: command not found" | Run `./setup.sh` to auto-install PHP |
| Python sandbox not working | Install Python: `brew install python3` |
| Java sandbox not working | Install JDK: `brew install openjdk@17` |
| Port 8000 already in use | Edit `start-server.sh` and change `PORT=8000` |
| Blank page | Check PHP: `./bin/php -v` |
| Page loads but sandbox fails | Visit `/status` to check runtime availability |

---

## License

This project was created by **Mr. Lloyd Christopher F. Dacles, MIS** for educational purposes.

---

*Built with PHP, lots of coffee, and a passion for teaching.*
