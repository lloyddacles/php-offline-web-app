<?php
/**
 * Quiz Data for All Lessons
 * Returns array of questions for a given lesson
 */

function getQuizData($section, $lessonNum) {
    $quizzes = [
        // Programming Logic Lessons
        'programming-logic/1' => [
            'title' => 'Quiz: What is Programming Logic?',
            'questions' => [
                [
                    'question' => 'What is programming logic?',
                    'options' => ['A way to organize files', 'A systematic approach to solving problems with step-by-step instructions', 'A programming language', 'A type of computer hardware'],
                    'answer' => 1
                ],
                [
                    'question' => 'Why is programming logic important?',
                    'options' => ['It makes code run faster', 'It helps break down complex problems into manageable steps', 'It replaces the need for coding', 'It only works with specific languages'],
                    'answer' => 1
                ],
                [
                    'question' => 'Which is the first step in solving a programming problem?',
                    'options' => ['Write code immediately', 'Understand the problem completely', 'Choose a programming language', 'Install software'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/2' => [
            'title' => 'Quiz: Computational Thinking',
            'questions' => [
                [
                    'question' => 'What is decomposition in computational thinking?',
                    'options' => ['Breaking a complex problem into smaller, manageable parts', 'Combining small problems into one', 'Writing computer code', 'Testing a program'],
                    'answer' => 0
                ],
                [
                    'question' => 'Pattern recognition helps us:',
                    'options' => ['Write longer code', 'Identify similarities and trends in problems', 'Run programs faster', 'Delete files'],
                    'answer' => 1
                ],
                [
                    'question' => 'Abstraction means:',
                    'options' => ['Showing every detail', 'Focusing on essential features while hiding unnecessary details', 'Making code longer', 'Using abstract art'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/3' => [
            'title' => 'Quiz: Flowcharts and Pseudocode',
            'questions' => [
                [
                    'question' => 'What shape represents a decision in a flowchart?',
                    'options' => ['Rectangle', 'Diamond', 'Circle', 'Triangle'],
                    'answer' => 1
                ],
                [
                    'question' => 'Pseudocode is:',
                    'options' => ['Real code that runs on computers', 'Plain language description of algorithm steps', 'A type of flowchart', 'A programming language'],
                    'answer' => 1
                ],
                [
                    'question' => 'The oval shape in a flowchart represents:',
                    'options' => ['Process', 'Decision', 'Start/End', 'Input/Output'],
                    'answer' => 2
                ]
            ]
        ],
        'programming-logic/4' => [
            'title' => 'Quiz: Sequential Thinking',
            'questions' => [
                [
                    'question' => 'Sequential thinking means:',
                    'options' => ['Doing tasks in random order', 'Following steps in a specific order from start to finish', 'Skipping steps', 'Only thinking about numbers'],
                    'answer' => 1
                ],
                [
                    'question' => 'In a recipe, steps must be followed in order because:',
                    'options' => ['It looks better', 'Each step may depend on the previous one', 'The chef said so', 'It does not matter'],
                    'answer' => 1
                ],
                [
                    'question' => 'Which is an example of sequential processing?',
                    'options' => ['Checking multiple doors at once', 'Washing, then drying, then folding clothes', 'Playing two songs simultaneously', 'Running and walking at the same time'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/5' => [
            'title' => 'Quiz: Conditional Logic',
            'questions' => [
                [
                    'question' => 'Conditional logic allows a program to:',
                    'options' => ['Only run one way', 'Make decisions based on conditions', 'Avoid using if statements', 'Run without conditions'],
                    'answer' => 1
                ],
                [
                    'question' => 'The IF-THEN-ELSE structure means:',
                    'options' => ['Always do the same thing', 'Do one thing if true, another if false', 'Skip all conditions', 'Only use THEN'],
                    'answer' => 1
                ],
                [
                    'question' => 'Nested conditions are:',
                    'options' => ['Conditions inside other conditions', 'Conditions that run at the same time', 'Conditions that never end', 'Simple conditions'],
                    'answer' => 0
                ]
            ]
        ],
        'programming-logic/6' => [
            'title' => 'Quiz: Loop Thinking',
            'questions' => [
                [
                    'question' => 'A loop is used to:',
                    'options' => ['Run code once', 'Repeat a block of code multiple times', 'Delete code', 'Skip code'],
                    'answer' => 1
                ],
                [
                    'question' => 'A FOR loop is best when:',
                    'options' => ['You do not know how many times to repeat', 'You know exactly how many iterations you need', 'You want to loop forever', 'You only need one iteration'],
                    'answer' => 1
                ],
                [
                    'question' => 'An infinite loop is:',
                    'options' => ['A loop that runs once', 'A loop that never stops unless explicitly broken', 'A loop with no code', 'A broken loop'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/7' => [
            'title' => 'Quiz: Functions and Modularity',
            'questions' => [
                [
                    'question' => 'A function is:',
                    'options' => ['A variable', 'A reusable block of code that performs a specific task', 'A type of loop', 'A class'],
                    'answer' => 1
                ],
                [
                    'question' => 'Modularity means:',
                    'options' => ['Writing one long program', 'Breaking code into smaller, independent modules', 'Using only one file', 'Avoiding functions'],
                    'answer' => 1
                ],
                [
                    'question' => 'Parameters are:',
                    'options' => ['Output values', 'Inputs passed to a function', 'Loop counters', 'Variable names'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/8' => [
            'title' => 'Quiz: Data Thinking',
            'questions' => [
                [
                    'question' => 'Data types define:',
                    'options' => ['How fast code runs', 'The kind of value a variable can hold', 'The color of text', 'The file name'],
                    'answer' => 1
                ],
                [
                    'question' => 'An integer is:',
                    'options' => ['A decimal number', 'A whole number without fractions', 'A text string', 'A boolean value'],
                    'answer' => 1
                ],
                [
                    'question' => 'A boolean can have values:',
                    'options' => ['0 to 100', 'True or False', 'Any text', 'Any number'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/9' => [
            'title' => 'Quiz: Debugging Thinking',
            'questions' => [
                [
                    'question' => 'Debugging is:',
                    'options' => ['Writing new code', 'Finding and fixing errors in code', 'Deleting code', 'Running code once'],
                    'answer' => 1
                ],
                [
                    'question' => 'A syntax error means:',
                    'options' => ['The code runs but gives wrong results', 'The code violates the language rules', 'The program crashes at runtime', 'The code is too slow'],
                    'answer' => 1
                ],
                [
                    'question' => 'A logical error is when:',
                    'options' => ['The program crashes', 'The code runs but produces incorrect output', 'The syntax is wrong', 'The program does not start'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/10' => [
            'title' => 'Quiz: Algorithmic Thinking',
            'questions' => [
                [
                    'question' => 'An algorithm is:',
                    'options' => ['A programming language', 'A step-by-step procedure to solve a problem', 'A type of variable', 'A computer program'],
                    'answer' => 1
                ],
                [
                    'question' => 'A good algorithm should be:',
                    'options' => ['Vague and unclear', 'Clear, finite, and effective', 'Infinite and complex', 'Written in code only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Time complexity measures:',
                    'options' => ['How much memory is used', 'How the running time grows with input size', 'How many lines of code exist', 'How fast the computer is'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/11' => [
            'title' => 'Quiz: Pattern Recognition',
            'questions' => [
                [
                    'question' => 'Pattern recognition in programming means:',
                    'options' => ['Drawing patterns', 'Identifying recurring similarities in problems', 'Creating art', 'Using templates only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Recognizing patterns helps because:',
                    'options' => ['It makes code longer', 'We can reuse solutions for similar problems', 'It eliminates all errors', 'It is not useful'],
                    'answer' => 1
                ],
                [
                    'question' => 'Which is an example of a pattern?',
                    'options' => ['A single calculation', 'Repeated addition (loop)', 'One variable', 'A comment'],
                    'answer' => 1
                ]
            ]
        ],
        'programming-logic/12' => [
            'title' => 'Quiz: Problem-Solving Framework',
            'questions' => [
                [
                    'question' => 'The first step in problem-solving is:',
                    'options' => ['Write code', 'Understand the problem', 'Choose tools', 'Test the program'],
                    'answer' => 1
                ],
                [
                    'question' => 'After understanding the problem, you should:',
                    'options' => ['Start coding immediately', 'Design a solution plan', 'Give up', 'Ask someone else to do it'],
                    'answer' => 1
                ],
                [
                    'question' => 'Testing is important because:',
                    'options' => ['It takes time', 'It verifies the solution works correctly', 'It is required by teachers', 'It is optional'],
                    'answer' => 1
                ]
            ]
        ],

        // PHP Lessons
        'lessons/1' => [
            'title' => 'Quiz: Introduction to PHP',
            'questions' => [
                [
                    'question' => 'What does PHP stand for?',
                    'options' => ['Personal Home Page', 'PHP: Hypertext Preprocessor', 'Private Home Processor', 'Public HTML Protocol'],
                    'answer' => 1
                ],
                [
                    'question' => 'Where does PHP code execute?',
                    'options' => ['In the browser', 'On the web server', 'On the user\'s computer', 'In the database'],
                    'answer' => 1
                ],
                [
                    'question' => 'What tag opens PHP code?',
                    'options' => ['<script>', '<?php', '<php>', '<?'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/2' => [
            'title' => 'Quiz: PHP Syntax Basics',
            'questions' => [
                [
                    'question' => 'Every PHP statement must end with:',
                    'options' => ['A comma', 'A semicolon', 'A period', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'PHP code is enclosed in:',
                    'options' => ['<php> tags', '<?php ?> tags', '{ } brackets', '[ ] brackets'],
                    'answer' => 1
                ],
                [
                    'question' => 'The echo statement is used to:',
                    'options' => ['Delete text', 'Output text to the browser', 'Store variables', 'Create functions'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/3' => [
            'title' => 'Quiz: PHP Comments',
            'questions' => [
                [
                    'question' => 'Single-line comments in PHP use:',
                    'options' => ['#', '//', '--', '**'],
                    'answer' => 1
                ],
                [
                    'question' => 'Multi-line comments are enclosed in:',
                    'options' => ['/* */', '// //', '# #', '-- --'],
                    'answer' => 0
                ],
                [
                    'question' => 'Comments are used to:',
                    'options' => ['Run code faster', 'Explain code for readability', 'Store data', 'Create variables'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/4' => [
            'title' => 'Quiz: PHP Variables',
            'questions' => [
                [
                    'question' => 'Variable names in PHP must start with:',
                    'options' => ['A number', 'A letter or underscore', 'A special character', 'A dollar sign only'],
                    'answer' => 1
                ],
                [
                    'question' => 'The $ prefix is used for:',
                    'options' => ['Comments', 'Variables', 'Functions', 'Classes'],
                    'answer' => 1
                ],
                [
                    'question' => 'PHP is a:',
                    'options' => ['Statically typed language', 'Dynamically typed language', 'Strongly typed only', 'Untyped language'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/5' => [
            'title' => 'Quiz: PHP Data Types',
            'questions' => [
                [
                    'question' => 'Which is a string data type?',
                    'options' => ['42', '"Hello"', 'true', '3.14'],
                    'answer' => 1
                ],
                [
                    'question' => 'A float stores:',
                    'options' => ['Whole numbers', 'Decimal numbers', 'Text', 'Boolean values'],
                    'answer' => 1
                ],
                [
                    'question' => 'The boolean type has values:',
                    'options' => ['0 and 1 only', 'true and false', 'yes and no', 'null and void'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/6' => [
            'title' => 'Quiz: PHP Strings',
            'questions' => [
                [
                    'question' => 'The concatenation operator in PHP is:',
                    'options' => ['+', '.', '&', '*'],
                    'answer' => 1
                ],
                [
                    'question' => 'strlen() returns:',
                    'options' => ['String content', 'Length of a string', 'String type', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'strtolower() converts text to:',
                    'options' => ['Uppercase', 'Lowercase', 'Numbers', 'Boolean'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/7' => [
            'title' => 'Quiz: PHP Numbers',
            'questions' => [
                [
                    'question' => 'Which is an integer?',
                    'options' => ['3.14', '42', '"42"', 'true'],
                    'answer' => 1
                ],
                [
                    'question' => 'The result of 10 / 3 in PHP is:',
                    'options' => ['3', '3.333...', '103', 'Error'],
                    'answer' => 1
                ],
                [
                    'question' => 'PHP follows which order of operations?',
                    'options' => ['Left to right always', 'PEMDAS/BODMAS', 'Random', 'No order'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/8' => [
            'title' => 'Quiz: PHP Operators',
            'questions' => [
                [
                    'question' => 'The == operator checks:',
                    'options' => ['Assignment', 'Equality', 'Identity', 'Not equal'],
                    'answer' => 1
                ],
                [
                    'question' => 'The === operator checks:',
                    'options' => ['Value only', 'Value and type', 'Assignment', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'The && operator means:',
                    'options' => ['OR', 'AND', 'NOT', 'XOR'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/9' => [
            'title' => 'Quiz: PHP Conditionals',
            'questions' => [
                [
                    'question' => 'An if statement executes code when:',
                    'options' => ['Always', 'Condition is true', 'Condition is false', 'Never'],
                    'answer' => 1
                ],
                [
                    'question' => 'The else clause runs when:',
                    'options' => ['Condition is true', 'Condition is false', 'Always', 'Never'],
                    'answer' => 1
                ],
                [
                    'question' => 'elseif is used to:',
                    'options' => ['End the program', 'Check another condition if the first is false', 'Repeat code', 'Define functions'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/10' => [
            'title' => 'Quiz: PHP Loops',
            'questions' => [
                [
                    'question' => 'A while loop repeats while:',
                    'options' => ['Condition is false', 'Condition is true', 'Variable exists', 'Program ends'],
                    'answer' => 1
                ],
                [
                    'question' => 'A for loop is best when:',
                    'options' => ['Unknown iterations', 'Known number of iterations', 'No iterations', 'One iteration only'],
                    'answer' => 1
                ],
                [
                    'question' => 'break exits:',
                    'options' => ['The current loop', 'The entire program', 'The function', 'Nothing'],
                    'answer' => 0
                ]
            ]
        ],
        'lessons/11' => [
            'title' => 'Quiz: PHP Arrays',
            'questions' => [
                [
                    'question' => 'An indexed array uses:',
                    'options' => ['Named keys', 'Numeric indexes', 'No organization', 'Random keys'],
                    'answer' => 1
                ],
                [
                    'question' => 'count() returns:',
                    'options' => ['Array content', 'Number of elements', 'Array type', 'First element'],
                    'answer' => 1
                ],
                [
                    'question' => 'A associative array uses:',
                    'options' => ['Only numbers', 'Key-value pairs', 'No keys', 'Only strings'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/12' => [
            'title' => 'Quiz: PHP Functions',
            'questions' => [
                [
                    'question' => 'A function is defined with:',
                    'options' => ['function keyword', 'def keyword', 'func keyword', 'sub keyword'],
                    'answer' => 0
                ],
                [
                    'question' => 'Parameters are:',
                    'options' => ['Output values', 'Inputs to a function', 'Loop counters', 'Variable names'],
                    'answer' => 1
                ],
                [
                    'question' => 'return does what?',
                    'options' => ['Prints output', 'Sends a value back from the function', 'Ends the program', 'Creates a variable'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/13' => [
            'title' => 'Quiz: PHP Superglobals',
            'questions' => [
                [
                    'question' => '$_GET is used to:',
                    'options' => ['Send data via POST', 'Retrieve data from URL query string', 'Delete data', 'Create files'],
                    'answer' => 1
                ],
                [
                    'question' => '$_POST is used to:',
                    'options' => ['Get URL data', 'Send form data securely via POST method', 'Print output', 'Define variables'],
                    'answer' => 1
                ],
                [
                    'question' => '$_SESSION stores:',
                    'options' => ['URL parameters', 'Data that persists across page loads', 'Database queries', 'File contents'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/14' => [
            'title' => 'Quiz: PHP Forms',
            'questions' => [
                [
                    'question' => 'The form action attribute specifies:',
                    'options' => ['Form method', 'Where form data is sent', 'Form id', 'Input types'],
                    'answer' => 1
                ],
                [
                    'question' => 'POST method is preferred over GET because:',
                    'options' => ['It is faster', 'Data is not visible in URL', 'It uses less memory', 'It is simpler'],
                    'answer' => 1
                ],
                [
                    'question' => 'Input validation should happen:',
                    'options' => ['On client side only', 'On server side (always)', 'Not needed', 'Only in database'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/15' => [
            'title' => 'Quiz: PHP Sessions',
            'questions' => [
                [
                    'question' => 'Sessions store data:',
                    'options' => ['In the browser', 'On the server', 'In cookies only', 'In the URL'],
                    'answer' => 1
                ],
                [
                    'question' => 'session_start() must be called:',
                    'options' => ['At the end of script', 'Before using any session variables', 'Only once per site', 'Never'],
                    'answer' => 1
                ],
                [
                    'question' => 'Sessions are more secure than cookies because:',
                    'options' => ['They use encryption', 'Data stays on server', 'They are faster', 'They are public'],
                    'answer' => 1
                ]
            ]
        ],
        'lessons/16' => [
            'title' => 'Quiz: PHP File Handling',
            'questions' => [
                [
                    'question' => 'fopen() opens:',
                    'options' => ['A browser', 'A file for reading/writing', 'A database', 'A connection'],
                    'answer' => 1
                ],
                [
                    'question' => 'file_put_contents() does what?',
                    'options' => ['Reads a file', 'Writes content to a file', 'Deletes a file', 'Copies a file'],
                    'answer' => 1
                ],
                [
                    'question' => 'Always validate file uploads because:',
                    'options' => ['It is optional', 'Security - prevent malicious files', 'It is faster', 'It saves space'],
                    'answer' => 1
                ]
            ]
        ],

        // Python Lessons
        'python-lessons/1' => [
            'title' => 'Quiz: Introduction to Python',
            'questions' => [
                [
                    'question' => 'Python was created by:',
                    'options' => ['Bill Gates', 'Guido van Rossum', 'Mark Zuckerberg', 'Steve Jobs'],
                    'answer' => 1
                ],
                [
                    'question' => 'Python is known for being:',
                    'options' => ['Difficult to learn', 'Readable and beginner-friendly', 'Only for web development', 'Compiled language'],
                    'answer' => 1
                ],
                [
                    'question' => 'Python is:',
                    'options' => ['Compiled', 'Interpreted', 'Assembly', 'Machine code'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/2' => [
            'title' => 'Quiz: Python Syntax Basics',
            'questions' => [
                [
                    'question' => 'Python uses indentation for:',
                    'options' => ['Decoration', 'Code blocks', 'Comments', 'Variable names'],
                    'answer' => 1
                ],
                [
                    'question' => 'print() outputs:',
                    'options' => ['Files', 'Text to the console', 'Images', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Python statements do NOT require:',
                    'options' => ['Indentation', 'Semicolons', 'Variables', 'Functions'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/3' => [
            'title' => 'Quiz: Variables and Data Types',
            'questions' => [
                [
                    'question' => 'Variable names in Python can include:',
                    'options' => ['Spaces', 'Letters, numbers, underscore', 'Special characters', 'Start with number'],
                    'answer' => 1
                ],
                [
                    'question' => 'type() returns:',
                    'options' => ['Value', 'Data type of a variable', 'Variable name', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Python is:',
                    'options' => ['Statically typed', 'Dynamically typed', 'Not typed', 'Weakly typed'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/4' => [
            'title' => 'Quiz: Operators',
            'questions' => [
                [
                    'question' => 'The ** operator does:',
                    'options' => ['Addition', 'Exponentiation', 'Multiplication', 'Division'],
                    'answer' => 1
                ],
                [
                    'question' => '// performs:',
                    'options' => ['Regular division', 'Floor division (integer result)', 'Modulo', 'Power'],
                    'answer' => 1
                ],
                [
                    'question' => '% is the:',
                    'options' => ['Percentage operator', 'Modulo operator', 'Division operator', 'Addition operator'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/5' => [
            'title' => 'Quiz: Conditionals',
            'questions' => [
                [
                    'question' => 'elif is short for:',
                    'options' => ['End loop if', 'Else if', 'Else later', 'Enter line'],
                    'answer' => 1
                ],
                [
                    'question' => 'Python uses which keyword for conditions?',
                    'options' => ['switch', 'if', 'when', 'case'],
                    'answer' => 1
                ],
                [
                    'question' => 'Indentation in if blocks:',
                    'options' => ['Is optional', 'Is required', 'Uses tabs only', 'Uses braces'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/6' => [
            'title' => 'Quiz: Loops',
            'questions' => [
                [
                    'question' => 'for x in range(5) loops:',
                    'options' => ['5 times', '4 times', '6 times', 'Infinite times'],
                    'answer' => 0
                ],
                [
                    'question' => 'while True creates:',
                    'options' => ['A finite loop', 'An infinite loop', 'No loop', 'A for loop'],
                    'answer' => 1
                ],
                [
                    'question' => 'break exits:',
                    'options' => ['Python', 'The current loop', 'The function', 'The program'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/7' => [
            'title' => 'Quiz: Lists and Tuples',
            'questions' => [
                [
                    'question' => 'Lists are:',
                    'options' => ['Immutable', 'Mutable (can be changed)', 'Fixed size', 'Read-only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Tuples use which brackets?',
                    'options' => ['[ ]', '( )', '{ }', '< >'],
                    'answer' => 1
                ],
                [
                    'question' => '.append() adds to:',
                    'options' => ['A tuple', 'A list', 'A string', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/8' => [
            'title' => 'Quiz: Dictionaries and Sets',
            'questions' => [
                [
                    'question' => 'Dictionaries store:',
                    'options' => ['Indexed items only', 'Key-value pairs', 'Single values', 'Boolean values'],
                    'answer' => 1
                ],
                [
                    'question' => 'Sets contain:',
                    'options' => ['Duplicate items', 'Unique items only', 'Ordered items', 'Key-value pairs'],
                    'answer' => 1
                ],
                [
                    'question' => 'Accessing a dictionary key uses:',
                    'options' => ['Parentheses', 'Square brackets', 'Curly braces', 'Angle brackets'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/9' => [
            'title' => 'Quiz: Strings',
            'questions' => [
                [
                    'question' => 'f-strings allow:',
                    'options' => ['Formatting only', 'String interpolation with variables', 'File operations', 'Nothing special'],
                    'answer' => 1
                ],
                [
                    'question' => '.strip() removes:',
                    'options' => ['Characters in the middle', 'Leading/trailing whitespace', 'All text', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'String slicing uses:',
                    'options' => ['( )', '[ ]', '{ }', '/ /'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/10' => [
            'title' => 'Quiz: Functions',
            'questions' => [
                [
                    'question' => 'Functions are defined with:',
                    'options' => ['function', 'def', 'func', 'define'],
                    'answer' => 1
                ],
                [
                    'question' => 'Default parameters:',
                    'options' => ['Are required', 'Have fallback values', 'Cannot be used', 'Only work with integers'],
                    'answer' => 1
                ],
                [
                    'question' => 'return does what?',
                    'options' => ['Prints output', 'Returns a value from the function', 'Ends the program', 'Deletes variables'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/11' => [
            'title' => 'Quiz: Object-Oriented Programming',
            'questions' => [
                [
                    'question' => 'A class is:',
                    'options' => ['An instance', 'A blueprint for objects', 'A function', 'A variable'],
                    'answer' => 1
                ],
                [
                    'question' => 'self refers to:',
                    'options' => ['The class itself', 'The current instance of the class', 'A parent class', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => '__init__ is:',
                    'options' => ['A regular method', 'The constructor method', 'A variable', 'A loop'],
                    'answer' => 1
                ]
            ]
        ],
        'python-lessons/12' => [
            'title' => 'Quiz: File Handling and Errors',
            'questions' => [
                [
                    'question' => 'with open() ensures:',
                    'options' => ['File stays open forever', 'File is properly closed', 'File is deleted', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'try/except handles:',
                    'options' => ['Success only', 'Errors gracefully', 'Loops', 'Variables'],
                    'answer' => 1
                ],
                [
                    'question' => '"r" mode opens a file for:',
                    'options' => ['Writing', 'Reading', 'Appending', 'Deleting'],
                    'answer' => 1
                ]
            ]
        ],

        // Java Lessons
        'java-lessons/1' => [
            'title' => 'Quiz: Introduction to Java',
            'questions' => [
                [
                    'question' => 'Java was developed by:',
                    'options' => ['Microsoft', 'Sun Microsystems (now Oracle)', 'Google', 'Apple'],
                    'answer' => 1
                ],
                [
                    'question' => 'Java programs run on:',
                    'options' => ['Native machine code', 'Java Virtual Machine (JVM)', 'Browser only', 'Server only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Java is:',
                    'options' => ['Interpreted only', 'Compiled and interpreted', 'Assembly language', 'Machine code'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/2' => [
            'title' => 'Quiz: Java Syntax Basics',
            'questions' => [
                [
                    'question' => 'Every Java program needs:',
                    'options' => ['A main method', 'A class', 'Both a class and main method', 'Nothing special'],
                    'answer' => 2
                ],
                [
                    'question' => 'System.out.println() does what?',
                    'options' => ['Reads input', 'Outputs text with newline', 'Creates variables', 'Defines functions'],
                    'answer' => 1
                ],
                [
                    'question' => 'Statements in Java must end with:',
                    'options' => ['A period', 'A semicolon', 'A comma', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/3' => [
            'title' => 'Quiz: Variables and Data Types',
            'questions' => [
                [
                    'question' => 'int stores:',
                    'options' => ['Decimal numbers', 'Whole numbers', 'Text', 'Boolean'],
                    'answer' => 1
                ],
                [
                    'question' => 'double stores:',
                    'options' => ['Integers', 'Decimal numbers', 'Strings', 'Characters'],
                    'answer' => 1
                ],
                [
                    'question' => 'Java is:',
                    'options' => ['Dynamically typed', 'Statically typed', 'Untyped', 'Weakly typed'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/4' => [
            'title' => 'Quiz: Operators',
            'questions' => [
                [
                    'question' => 'The == operator checks:',
                    'options' => ['Assignment', 'Equality', 'Not equal', 'Greater than'],
                    'answer' => 1
                ],
                [
                    'question' => '&& means:',
                    'options' => ['OR', 'AND', 'NOT', 'XOR'],
                    'answer' => 1
                ],
                [
                    'question' => 'The ternary operator is:',
                    'options' => ['?:', '::', '->', '=='],
                    'answer' => 0
                ]
            ]
        ],
        'java-lessons/5' => [
            'title' => 'Quiz: Conditionals',
            'questions' => [
                [
                    'question' => 'switch is used for:',
                    'options' => ['Loops', 'Multiple fixed-value comparisons', 'Single conditions', 'Functions'],
                    'answer' => 1
                ],
                [
                    'question' => 'if-else controls:',
                    'options' => ['Loop count', 'Flow based on conditions', 'Variable types', 'Class definitions'],
                    'answer' => 1
                ],
                [
                    'question' => 'Each case in switch needs:',
                    'options' => ['A return', 'A break', 'A continue', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/6' => [
            'title' => 'Quiz: Loops',
            'questions' => [
                [
                    'question' => 'for loop has:',
                    'options' => ['1 part', '2 parts', '3 parts', '4 parts'],
                    'answer' => 2
                ],
                [
                    'question' => 'while loop checks condition:',
                    'options' => ['After each iteration', 'Before each iteration', 'Only once', 'Never'],
                    'answer' => 1
                ],
                [
                    'question' => 'do-while executes at least:',
                    'options' => ['Zero times', 'Once', 'Twice', 'Infinite times'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/7' => [
            'title' => 'Quiz: Arrays and Strings',
            'questions' => [
                [
                    'question' => 'Array size in Java is:',
                    'options' => ['Dynamic', 'Fixed at creation', 'Unlimited', 'Zero'],
                    'answer' => 1
                ],
                [
                    'question' => 'String in Java is:',
                    'options' => ['Primitive type', 'Object (immutable)', 'Array', 'Integer'],
                    'answer' => 1
                ],
                [
                    'question' => 'array.length gives:',
                    'options' => ['First element', 'Number of elements', 'Last element', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/8' => [
            'title' => 'Quiz: Methods',
            'questions' => [
                [
                    'question' => 'A method is:',
                    'options' => ['A variable', 'A reusable block of code in a class', 'A class', 'An object'],
                    'answer' => 1
                ],
                [
                    'question' => 'void means:',
                    'options' => ['Returns integer', 'Returns nothing', 'Returns string', 'Returns object'],
                    'answer' => 1
                ],
                [
                    'question' => 'Method overloading means:',
                    'options' => ['Too many methods', 'Same name, different parameters', 'No return type', 'Private methods'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/9' => [
            'title' => 'Quiz: Object-Oriented Programming',
            'questions' => [
                [
                    'question' => 'A class is:',
                    'options' => ['An object', 'A blueprint for objects', 'A method', 'A variable'],
                    'answer' => 1
                ],
                [
                    'question' => 'An object is:',
                    'options' => ['A class', 'An instance of a class', 'A method', 'A variable type'],
                    'answer' => 1
                ],
                [
                    'question' => 'The constructor:',
                    'options' => ['Destroys objects', 'Initializes new objects', 'Returns values', 'Is optional always'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/10' => [
            'title' => 'Quiz: Inheritance and Polymorphism',
            'questions' => [
                [
                    'question' => 'Inheritance allows:',
                    'options' => ['Creating objects', 'A class to inherit properties from another', 'Multiple main methods', 'Nothing special'],
                    'answer' => 1
                ],
                [
                    'question' => 'Polymorphism means:',
                    'options' => ['Many objects', 'Same interface, different implementations', 'One class only', 'No inheritance'],
                    'answer' => 1
                ],
                [
                    'question' => '@Override indicates:',
                    'options' => ['New method', 'Redefining a parent method', 'Deleting method', 'Private method'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/11' => [
            'title' => 'Quiz: Collections and Generics',
            'questions' => [
                [
                    'question' => 'ArrayList differs from array because:',
                    'options' => ['Same size', 'Dynamic size', 'Fixed size', 'No differences'],
                    'answer' => 1
                ],
                [
                    'question' => 'HashMap stores:',
                    'options' => ['Indexed items', 'Key-value pairs', 'Only integers', 'Only strings'],
                    'answer' => 1
                ],
                [
                    'question' => 'Generics provide:',
                    'options' => ['Speed', 'Type safety', 'Memory savings', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'java-lessons/12' => [
            'title' => 'Quiz: File Handling and Errors',
            'questions' => [
                [
                    'question' => 'try-catch handles:',
                    'options' => ['Success', 'Exceptions/errors gracefully', 'Loops', 'Variables'],
                    'answer' => 1
                ],
                [
                    'question' => 'finally block:',
                    'options' => ['Runs only on error', 'Always executes', 'Runs only on success', 'Is optional'],
                    'answer' => 1
                ],
                [
                    'question' => 'FileReader is used for:',
                    'options' => ['Writing only', 'Reading text files', 'Creating folders', 'Deleting files'],
                    'answer' => 1
                ]
            ]
        ],

        // MySQL Lessons
        'mysql-lessons/1' => [
            'title' => 'Quiz: Introduction to MySQL',
            'questions' => [
                [
                    'question' => 'MySQL is:',
                    'options' => ['A programming language', 'A relational database management system', 'An operating system', 'A web browser'],
                    'answer' => 1
                ],
                [
                    'question' => 'SQL stands for:',
                    'options' => ['Simple Query Language', 'Structured Query Language', 'Standard Question Language', 'System Query Logic'],
                    'answer' => 1
                ],
                [
                    'question' => 'A database stores:',
                    'options' => ['HTML files', 'Structured data in tables', 'Images only', 'Music files'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/2' => [
            'title' => 'Quiz: Databases and Tables',
            'questions' => [
                [
                    'question' => 'CREATE DATABASE creates:',
                    'options' => ['A table', 'A new database', 'A user', 'A view'],
                    'answer' => 1
                ],
                [
                    'question' => 'A table consists of:',
                    'options' => ['Files only', 'Rows and columns', 'Just text', 'Images'],
                    'answer' => 1
                ],
                [
                    'question' => 'Primary key uniquely:',
                    'options' => ['Deletes rows', 'Identifies each row', 'Sorts data', 'Creates tables'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/3' => [
            'title' => 'Quiz: Inserting Data',
            'questions' => [
                [
                    'question' => 'INSERT INTO adds:',
                    'options' => ['Tables', 'New rows of data', 'Columns only', 'Databases'],
                    'answer' => 1
                ],
                [
                    'question' => 'VALUES specifies:',
                    'options' => ['Column names', 'Data to insert', 'Table name', 'Database name'],
                    'answer' => 1
                ],
                [
                    'question' => 'You can insert multiple rows with:',
                    'options' => ['One INSERT statement', 'Multiple INSERT statements', 'Only SELECT', 'Not possible'],
                    'answer' => 0
                ]
            ]
        ],
        'mysql-lessons/4' => [
            'title' => 'Quiz: Selecting Data',
            'questions' => [
                [
                    'question' => 'SELECT retrieves:',
                    'options' => ['Tables', 'Data from database', 'Users', 'Databases'],
                    'answer' => 1
                ],
                [
                    'question' => 'WHERE filters:',
                    'options' => ['All rows', 'Rows matching condition', 'Columns', 'Tables'],
                    'answer' => 1
                ],
                [
                    'question' => 'ORDER BY sorts:',
                    'options' => ['By default only', 'Results by specified column', 'Randomly', 'By insertion order only'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/5' => [
            'title' => 'Quiz: SQL Functions',
            'questions' => [
                [
                    'question' => 'COUNT() returns:',
                    'options' => ['Sum', 'Number of rows', 'Average', 'Maximum'],
                    'answer' => 1
                ],
                [
                    'question' => 'GROUP BY groups:',
                    'options' => ['All data', 'Rows with same values', 'Tables', 'Databases'],
                    'answer' => 1
                ],
                [
                    'question' => 'AVG() calculates:',
                    'options' => ['Total', 'Average value', 'Count', 'Sum'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/6' => [
            'title' => 'Quiz: Updating Data',
            'questions' => [
                [
                    'question' => 'UPDATE modifies:',
                    'options' => ['Database structure', 'Existing rows', 'Creates new table', 'Deletes database'],
                    'answer' => 1
                ],
                [
                    'question' => 'SET specifies:',
                    'options' => ['New table name', 'New column values', 'Database name', 'User permissions'],
                    'answer' => 1
                ],
                [
                    'question' => 'Without WHERE, UPDATE affects:',
                    'options' => ['No rows', 'One row', 'All rows', 'Only first row'],
                    'answer' => 2
                ]
            ]
        ],
        'mysql-lessons/7' => [
            'title' => 'Quiz: Deleting Data',
            'questions' => [
                [
                    'question' => 'DELETE removes:',
                    'options' => ['Tables', 'Rows from a table', 'Databases', 'Users'],
                    'answer' => 1
                ],
                [
                    'question' => 'TRUNCATE is:',
                    'options' => ['Same as DELETE', 'Faster - removes all rows', 'Creates backup', 'Deletes columns'],
                    'answer' => 1
                ],
                [
                    'question' => 'Always use WHERE with:',
                    'options' => ['TRUNCATE', 'DELETE', 'CREATE', 'SELECT'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/8' => [
            'title' => 'Quiz: Joins',
            'questions' => [
                [
                    'question' => 'JOIN combines:',
                    'options' => ['Databases', 'Rows from multiple tables', 'Columns only', 'Users'],
                    'answer' => 1
                ],
                [
                    'question' => 'INNER JOIN returns:',
                    'options' => ['All rows', 'Only matching rows', 'Non-matching rows', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'LEFT JOIN returns:',
                    'options' => ['Right table only', 'All left + matching right', 'No rows', 'All rows'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/9' => [
            'title' => 'Quiz: Indexes and Performance',
            'questions' => [
                [
                    'question' => 'An index:',
                    'options' => ['Slows queries', 'Speeds up data retrieval', 'Uses more storage', 'Both B and C'],
                    'answer' => 3
                ],
                [
                    'question' => 'Primary key automatically:',
                    'options' => ['Creates index', 'Deletes data', 'Sorts data', 'Nothing'],
                    'answer' => 0
                ],
                [
                    'question' => 'Too many indexes can:',
                    'options' => ['Only help', 'Slow down INSERT/UPDATE', 'Do nothing', 'Delete data'],
                    'answer' => 1
                ]
            ]
        ],
        'mysql-lessons/10' => [
            'title' => 'Quiz: PHP MySQL Integration',
            'questions' => [
                [
                    'question' => 'PDO provides:',
                    'options' => ['File access', 'Database connection abstraction', 'HTML rendering', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Prepared statements prevent:',
                    'options' => ['Errors only', 'SQL injection attacks', 'Slow queries', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'fetch() retrieves:',
                    'options' => ['All data at once', 'One row at a time', 'Nothing', 'Database structure'],
                    'answer' => 1
                ]
            ]
        ],

        // DBMS Lessons
        'dbms-lessons/1' => [
            'title' => 'Quiz: Introduction to DBMS',
            'questions' => [
                [
                    'question' => 'A DBMS is:',
                    'options' => ['A programming language', 'Software to manage databases', 'Hardware component', 'An operating system'],
                    'answer' => 1
                ],
                [
                    'question' => 'Why use a DBMS?',
                    'options' => ['To make things harder', 'Efficient data management and access', 'For decoration', 'No reason'],
                    'answer' => 1
                ],
                [
                    'question' => 'A relational database uses:',
                    'options' => ['Files only', 'Tables with relationships', 'No structure', 'Random data'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/2' => [
            'title' => 'Quiz: Database Models',
            'questions' => [
                [
                    'question' => 'The relational model uses:',
                    'options' => ['Trees', 'Tables (relations)', 'Graphs', 'Arrays'],
                    'answer' => 1
                ],
                [
                    'question' => 'A schema defines:',
                    'options' => ['Data content', 'Database structure', 'User passwords', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Foreign key links:',
                    'options' => ['Databases', 'Tables together', 'Users', 'Files'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/3' => [
            'title' => 'Quiz: ER Diagrams',
            'questions' => [
                [
                    'question' => 'In ER diagrams, entities are shown as:',
                    'options' => ['Circles', 'Rectangles', 'Diamonds', 'Triangles'],
                    'answer' => 1
                ],
                [
                    'question' => 'Relationships are shown as:',
                    'options' => ['Rectangles', 'Diamonds', 'Circles', 'Lines only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Cardinality shows:',
                    'options' => ['Entity name', 'How many instances relate', 'Table size', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/4' => [
            'title' => 'Quiz: Relational Concepts',
            'questions' => [
                [
                    'question' => 'A candidate key:',
                    'options' => ['Can be any column', 'Uniquely identifies rows', 'Is always foreign', 'Is optional'],
                    'answer' => 1
                ],
                [
                    'question' => 'Referential integrity ensures:',
                    'options' => ['Speed', 'Foreign keys point to valid rows', 'No duplicates', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'An attribute is:',
                    'options' => ['A table', 'A column in a table', 'A row', 'A database'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/5' => [
            'title' => 'Quiz: Normalization',
            'questions' => [
                [
                    'question' => 'Normalization reduces:',
                    'options' => ['Data redundancy', 'Query speed', 'Table count', 'Nothing'],
                    'answer' => 0
                ],
                [
                    'question' => '1NF requires:',
                    'options' => ['No primary key', 'Atomic values in each cell', 'Multiple values', 'No columns'],
                    'answer' => 1
                ],
                [
                    'question' => '2NF eliminates:',
                    'options' => ['Primary keys', 'Partial dependencies', 'All dependencies', 'Tables'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/6' => [
            'title' => 'Quiz: Advanced Normalization',
            'questions' => [
                [
                    'question' => '3NF eliminates:',
                    'options' => ['Primary keys', 'Transitive dependencies', 'All keys', 'Tables'],
                    'answer' => 1
                ],
                [
                    'question' => 'BCNF is:',
                    'options' => ['Same as 3NF', 'Stricter than 3NF', 'Weaker than 3NF', 'Not related'],
                    'answer' => 1
                ],
                [
                    'question' => 'Over-normalization can:',
                    'options' => ['Only help', 'Slow down queries', 'Save space only', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/7' => [
            'title' => 'Quiz: SQL DDL',
            'questions' => [
                [
                    'question' => 'CREATE TABLE creates:',
                    'options' => ['Database', 'New table structure', 'Users', 'Views'],
                    'answer' => 1
                ],
                [
                    'question' => 'ALTER TABLE modifies:',
                    'options' => ['Data only', 'Table structure', 'Users', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'DROP TABLE:',
                    'options' => ['Empties table', 'Removes table completely', 'Creates backup', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/8' => [
            'title' => 'Quiz: Transactions',
            'questions' => [
                [
                    'question' => 'A transaction is:',
                    'options' => ['Single query', 'Group of operations treated as one unit', 'Table name', 'User action'],
                    'answer' => 1
                ],
                [
                    'question' => 'ACID stands for:',
                    'options' => ['Simple properties', 'Atomicity, Consistency, Isolation, Durability', 'Advanced concepts', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'COMMIT saves:',
                    'options' => ['Nothing', 'All changes permanently', 'Partial changes', 'Structure only'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/9' => [
            'title' => 'Quiz: Security',
            'questions' => [
                [
                    'question' => 'GRANT gives:',
                    'options' => ['Data', 'Permissions to users', 'Tables', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'SQL injection is:',
                    'options' => ['A feature', 'Malicious SQL through user input', 'A query type', 'Safe'],
                    'answer' => 1
                ],
                [
                    'question' => 'Prepared statements prevent:',
                    'options' => ['Errors only', 'SQL injection', 'Slow queries', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dbms-lessons/10' => [
            'title' => 'Quiz: Design Project',
            'questions' => [
                [
                    'question' => 'Database design starts with:',
                    'options' => ['Writing SQL', 'Requirements analysis', 'Creating tables', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'A data dictionary contains:',
                    'options' => ['Words', 'Metadata about database objects', 'User data', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Testing includes:',
                    'options' => ['Only queries', 'All CRUD operations and constraints', 'Just SELECT', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],

        // DSA Lessons
        'dsa-lessons/1' => [
            'title' => 'Quiz: Introduction to DSA',
            'questions' => [
                [
                    'question' => 'Data structures are:',
                    'options' => ['Programming languages', 'Ways to organize and store data efficiently', 'Hardware components', 'Operating systems'],
                    'answer' => 1
                ],
                [
                    'question' => 'Algorithms are:',
                    'options' => ['Data types', 'Step-by-step procedures to solve problems', 'Variables', 'Functions only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Why study DSA?',
                    'options' => ['It is required', 'To write efficient, optimized code', 'For fun only', 'No reason'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/2' => [
            'title' => 'Quiz: Big O Notation',
            'questions' => [
                [
                    'question' => 'Big O describes:',
                    'options' => ['Exact time', 'Upper bound of time/space complexity', 'Memory only', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'O(1) means:',
                    'options' => ['Slow', 'Constant time (very fast)', 'Linear time', 'Logarithmic time'],
                    'answer' => 1
                ],
                [
                    'question' => 'O(n) is:',
                    'options' => ['Constant', 'Linear (scales with input)', 'Logarithmic', 'Exponential'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/3' => [
            'title' => 'Quiz: Arrays and Dynamic Arrays',
            'questions' => [
                [
                    'question' => 'Array access by index is:',
                    'options' => ['O(n)', 'O(1) - constant time', 'O(log n)', 'O(n²)'],
                    'answer' => 1
                ],
                [
                    'question' => 'Dynamic arrays:',
                    'options' => ['Cannot resize', 'Can grow/shrink as needed', 'Are always small', 'Do not exist'],
                    'answer' => 1
                ],
                [
                    'question' => 'Insert at beginning of array is:',
                    'options' => ['O(1)', 'O(n) - must shift elements', 'O(log n)', 'O(n²)'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/4' => [
            'title' => 'Quiz: Searching Algorithms',
            'questions' => [
                [
                    'question' => 'Linear search checks:',
                    'options' => ['Only middle', 'Every element one by one', 'Random elements', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Binary search requires:',
                    'options' => ['Any array', 'Sorted array', 'Linked list', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Binary search time is:',
                    'options' => ['O(n)', 'O(log n)', 'O(1)', 'O(n²)'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/5' => [
            'title' => 'Quiz: Sorting Algorithms',
            'questions' => [
                [
                    'question' => 'Bubble sort time complexity:',
                    'options' => ['O(n)', 'O(n²)', 'O(log n)', 'O(1)'],
                    'answer' => 1
                ],
                [
                    'question' => 'Merge sort uses:',
                    'options' => ['Iteration only', 'Divide and conquer', 'Random sort', 'Nothing special'],
                    'answer' => 1
                ],
                [
                    'question' => 'Stable sort preserves:',
                    'options' => ['Speed only', 'Relative order of equal elements', 'Nothing', 'Memory'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/6' => [
            'title' => 'Quiz: Recursion',
            'questions' => [
                [
                    'question' => 'Recursion means:',
                    'options' => ['Looping', 'Function calling itself', 'Using arrays', 'Nothing special'],
                    'answer' => 1
                ],
                [
                    'question' => 'Base case is:',
                    'options' => ['The recursive call', 'When recursion stops', 'The first call', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Too much recursion can cause:',
                    'options' => ['Faster code', 'Stack overflow', 'Nothing', 'Better performance'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/7' => [
            'title' => 'Quiz: Linked Lists',
            'questions' => [
                [
                    'question' => 'A linked list node contains:',
                    'options' => ['Only data', 'Data and pointer to next node', 'Only pointer', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Insert at beginning is:',
                    'options' => ['O(n)', 'O(1) - very fast', 'O(log n)', 'O(n²)'],
                    'answer' => 1
                ],
                [
                    'question' => 'Linked list vs array:',
                    'options' => ['Same', 'Linked list better for insertions', 'Array always better', 'No difference'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/8' => [
            'title' => 'Quiz: Stacks',
            'questions' => [
                [
                    'question' => 'Stack follows:',
                    'options' => ['FIFO', 'LIFO - Last In First Out', 'Random order', 'Priority order'],
                    'answer' => 1
                ],
                [
                    'question' => 'push() adds to:',
                    'options' => ['Beginning', 'Top of stack', 'Bottom', 'Middle'],
                    'answer' => 1
                ],
                [
                    'question' => 'pop() removes from:',
                    'options' => ['Bottom', 'Top of stack', 'Middle', 'Anywhere'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/9' => [
            'title' => 'Quiz: Queues',
            'questions' => [
                [
                    'question' => 'Queue follows:',
                    'options' => ['LIFO', 'FIFO - First In First Out', 'Random', 'Priority only'],
                    'answer' => 1
                ],
                [
                    'question' => 'enqueue() adds to:',
                    'options' => ['Front', 'Rear/back of queue', 'Middle', 'Anywhere'],
                    'answer' => 1
                ],
                [
                    'question' => 'dequeue() removes from:',
                    'options' => ['Rear', 'Front of queue', 'Middle', 'Random'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/10' => [
            'title' => 'Quiz: Trees',
            'questions' => [
                [
                    'question' => 'A binary tree node has at most:',
                    'options' => ['1 child', '2 children', '3 children', 'Unlimited'],
                    'answer' => 1
                ],
                [
                    'question' => 'BST stands for:',
                    'options' => ['Binary Search Tree', 'Basic Sorted Tree', 'Big Simple Tree', 'None'],
                    'answer' => 0
                ],
                [
                    'question' => 'In-order traversal of BST gives:',
                    'options' => ['Random order', 'Sorted order', 'Reverse order', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/11' => [
            'title' => 'Quiz: Binary Search Trees',
            'questions' => [
                [
                    'question' => 'BST property: left child is:',
                    'options' => ['Greater than parent', 'Less than parent', 'Equal to parent', 'Random'],
                    'answer' => 1
                ],
                [
                    'question' => 'Average BST search time:',
                    'options' => ['O(n)', 'O(log n)', 'O(1)', 'O(n²)'],
                    'answer' => 1
                ],
                [
                    'question' => 'Unbalanced BST can become:',
                    'options' => ['Better', 'Like a linked list (slow)', 'Smaller', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/12' => [
            'title' => 'Quiz: Hash Tables',
            'questions' => [
                [
                    'question' => 'Hash table average lookup is:',
                    'options' => ['O(n)', 'O(1) - constant time', 'O(log n)', 'O(n²)'],
                    'answer' => 1
                ],
                [
                    'question' => 'Collision occurs when:',
                    'options' => ['Table is empty', 'Two keys hash to same index', 'Table is full', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Hash function converts:',
                    'options' => ['Numbers to strings', 'Keys to array indexes', 'Strings to booleans', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/13' => [
            'title' => 'Quiz: Graphs',
            'questions' => [
                [
                    'question' => 'A graph consists of:',
                    'options' => ['Tables only', 'Vertices and edges', 'Just arrays', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Directed graph edges have:',
                    'options' => ['No direction', 'One-way direction', 'Bidirectional only', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'BFS explores:',
                    'options' => ['Deepest node first', 'Level by level', 'Randomly', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/14' => [
            'title' => 'Quiz: Algorithm Design Strategies',
            'questions' => [
                [
                    'question' => 'Divide and conquer:',
                    'options' => ['Solves directly', 'Breaks problem into smaller subproblems', 'Uses no recursion', 'Nothing special'],
                    'answer' => 1
                ],
                [
                    'question' => 'Greedy algorithms:',
                    'options' => ['Always optimal', 'Make locally optimal choices', 'Try all options', 'Use recursion only'],
                    'answer' => 1
                ],
                [
                    'question' => 'Dynamic programming:',
                    'options' => ['Ignores overlapping problems', 'Stores solutions to avoid recalculation', 'Uses only loops', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/15' => [
            'title' => 'Quiz: Project Planning',
            'questions' => [
                [
                    'question' => 'Requirements analysis means:',
                    'options' => ['Writing code', 'Understanding what the project needs', 'Testing', 'Deploying'],
                    'answer' => 1
                ],
                [
                    'question' => 'System design includes:',
                    'options' => ['Only coding', 'Planning data structures and architecture', 'Only testing', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Time estimation helps:',
                    'options' => ['Make code run faster', 'Plan and manage project timeline', 'Nothing', 'Write better code'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/16' => [
            'title' => 'Quiz: Project Implementation',
            'questions' => [
                [
                    'question' => 'Implementation means:',
                    'options' => ['Planning only', 'Writing the actual code', 'Testing only', 'Designing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Code organization includes:',
                    'options' => ['Writing everything in one file', 'Modular, well-structured code', 'No comments', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Version control helps:',
                    'options' => ['Delete code', 'Track changes and collaborate', 'Run code faster', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/17' => [
            'title' => 'Quiz: Project Testing',
            'questions' => [
                [
                    'question' => 'Testing verifies:',
                    'options' => ['Code style', 'Code works correctly', 'Code is short', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Edge cases are:',
                    'options' => ['Normal inputs', 'Extreme or unusual inputs', 'No inputs', 'Nothing'],
                    'answer' => 1
                ],
                [
                    'question' => 'Unit tests check:',
                    'options' => ['Entire program', 'Individual functions/components', 'UI only', 'Nothing'],
                    'answer' => 1
                ]
            ]
        ],
        'dsa-lessons/18' => [
            'title' => 'Quiz: Final Presentation',
            'questions' => [
                [
                    'question' => 'Project presentation should include:',
                    'options' => ['Code only', 'Problem, solution, demo, and results', 'Nothing', 'Just slides'],
                    'answer' => 1
                ],
                [
                    'question' => 'Documentation helps:',
                    'options' => ['Make code longer', 'Others understand and maintain the project', 'Nothing', 'Slow down development'],
                    'answer' => 1
                ],
                [
                    'question' => 'A good project demonstrates:',
                    'options' => ['Only theory', 'Practical application of DSA concepts', 'Nothing new', 'Only one data structure'],
                    'answer' => 1
                ]
            ]
        ],
    ];

    $key = $section . '/' . $lessonNum;
    return isset($quizzes[$key]) ? $quizzes[$key] : null;
}
