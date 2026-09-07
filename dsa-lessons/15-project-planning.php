<?php $pageTitle = 'Course Project Planning and Algorithm Design'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 15; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Course Project Planning and Algorithm Design</h1>
    <p class="lesson-desc">Learn how to plan a DSA course project — define the problem, choose data structures, design algorithms, and create a development roadmap.</p>
</div>

<h2>Project Planning Framework</h2>
<p>Every successful project follows these phases:</p>

<pre>
1. Problem Definition    → What are we solving?
2. Requirements Analysis → What should it do?
3. Data Structure Design → What structures to use?
4. Algorithm Design      → How to solve it efficiently?
5. Complexity Analysis   → Is it efficient enough?
6. Implementation Plan   → What to build first?
</pre>

<h2>Step 1: Problem Definition</h2>
<div class="info-box note">
    <div class="box-title">Template</div>
    <p><strong>Project Name:</strong> _______________________<br>
    <strong>Problem Statement:</strong> What specific problem does this solve?<br>
    <strong>Target Users:</strong> Who will use this?<br>
    <strong>Success Criteria:</strong> How do we know it works?</p>
</div>

<h3>Example Project Ideas</h3>
<table>
    <thead><tr><th>Project</th><th>Problem</th><th>Key DSA</th></tr></thead>
    <tbody>
        <tr><td>Student Grade Tracker</td><td>Track and analyze student performance</td><td>Hash Map, Sorting, BST</td></tr>
        <tr><td>Task Scheduler</td><td>Prioritize and schedule tasks</td><td>Priority Queue, Graph</td></tr>
        <tr><td>Social Network Explorer</td><td>Find connections between users</td><td>Graph, BFS/DFS</td></tr>
        <tr><td>Library Management</td><td>Organize and search books</td><td>Hash Table, BST, Queue</td></tr>
        <tr><td>Route Planner</td><td>Find shortest path between locations</td><td>Graph, Dijkstra</td></tr>
    </tbody>
</table>

<h2>Step 2: Requirements Analysis</h2>
<pre><code class="language-php">&lt;?php
// Example: Student Grade Tracker Requirements
$requirements = [
    'functional' => [
        'Add/remove students',
        'Record grades per subject',
        'Calculate GPA and class rank',
        'Search students by name or ID',
        'Sort by GPA, name, or grade',
        'Generate reports and statistics',
    ],
    'non_functional' => [
        'Handle 1000+ students efficiently',
        'Response time under 100ms',
        'Data persistence (save/load)',
        'User-friendly interface',
    ]
];</code></pre>

<h2>Step 3: Data Structure Selection</h2>

<table>
    <thead><tr><th>Need</th><th>Best Choice</th><th>Why</th></tr></thead>
    <tbody>
        <tr><td>Store student records</td><td>Hash Map (assoc. array)</td><td>O(1) lookup by ID</td></tr>
        <tr><td>Rank students</td><td>BST or Sorted Array</td><td>Ordered traversal</td></tr>
        <tr><td>Course prerequisites</td><td>Graph (DAG)</td><td>Dependency relationships</td></tr>
        <tr><td>Waitlist for courses</td><td>Queue</td><td>FIFO ordering</td></tr>
        <tr><td>Priority enrollment</td><td>Priority Queue</td><td>Higher priority first</td></tr>
        <tr><td>Search by name</td><td>Trie or Hash Map</td><td>Prefix search / exact match</td></tr>
    </tbody>
</table>

<h2>Step 4: Algorithm Design</h2>
<pre><code class="language-php">&lt;?php
// Design pseudocode before coding
/*
ALGORITHM: CalculateClassRank
INPUT: students[] (array of student records)
OUTPUT: students[] with rank field added

1. Create array of (student_id, gpa) pairs
2. Sort by gpa descending (Merge Sort — O(n log n))
3. Assign rank: same gpa = same rank
4. Return sorted array with ranks
*/

function calculateClassRank(&$students) {
    // Step 1: Extract GPAs
    $gpaList = array_map(fn($s) => [
        'id' => $s['id'],
        'gpa' => $s['gpa']
    ], $students);

    // Step 2: Sort descending by GPA
    usort($gpaList, fn($a, $b) => $b['gpa'] <=> $a['gpa']);

    // Step 3: Assign ranks
    $rank = 1;
    $gpaList[0]['rank'] = $rank;
    for ($i = 1; $i < count($gpaList); $i++) {
        if ($gpaList[$i]['gpa'] < $gpaList[$i-1]['gpa']) $rank = $i + 1;
        $gpaList[$i]['rank'] = $rank;
    }

    // Step 4: Map back to students
    $rankMap = array_column($gpaList, 'rank', 'id');
    foreach ($students as &$s) {
        $s['rank'] = $rankMap[$s['id']] ?? 0;
    }
}</code></pre>

<h2>Step 5: Complexity Analysis</h2>
<pre>
Feature              Algorithm          Time        Space
─────────────────────────────────────────────────────────
Add Student          Hash Insert        O(1)        O(1)
Search by ID         Hash Lookup        O(1)        O(1)
Rank Students        Sort + Assign      O(n log n)  O(n)
Find Top 10          Sort + Slice       O(n log n)  O(n)
Find Median          Quickselect        O(n)        O(1)
Course Dependencies  Topological Sort   O(V + E)    O(V)
Shortest Path        Dijkstra           O((V+E)log V) O(V)
</pre>

<h2>Step 6: Development Roadmap</h2>
<pre>
Phase 1 (Week 1): Core Data Structures
  □ Implement Student class with hash-based storage
  □ Implement basic CRUD operations
  □ Add search functionality

Phase 2 (Week 2): Sorting and Ranking
  □ Implement merge sort for GPA ranking
  □ Add sorting by multiple fields
  ▢ Implement search algorithms

Phase 3 (Week 3): Advanced Features
  □ Course prerequisite graph
  □ Priority enrollment queue
  □ Report generation

Phase 4 (Week 4): Polish
  □ Performance testing
  □ Error handling
  □ Documentation
</pre>

<h2>Design Document Template</h2>
<div class="info-box tip">
    <div class="box-title">Save This Template</div>
    <p>For your project, document:<br>
    1. Problem statement (1 paragraph)<br>
    2. List of features with priority (must/should/could)<br>
    3. Data structures used (with justification)<br>
    4. Algorithm pseudocode for key operations<br>
    5. Complexity analysis table<br>
    6. Test cases (input → expected output)<br>
    7. Timeline with milestones</p>
</div>

<h2>Python Implementation</h2>
<pre><code class="language-python"># Planning Example: Student Class
class Student:
    def __init__(self, student_id, name, course):
        self.student_id = student_id
        self.name = name
        self.course = course
        self.grades = {}  # subject => grade

    def add_grade(self, subject, grade):
        self.grades[subject] = grade

    def get_gpa(self):
        if not self.grades:
            return 0.0
        return round(sum(self.grades.values()) / len(self.grades), 2)

    def to_dict(self):
        return {
            "id": self.student_id,
            "name": self.name,
            "course": self.course,
            "grades": self.grades,
            "gpa": self.get_gpa()
        }

# Usage
s = Student("2024-001", "Juan Dela Cruz", "BSIT")
s.add_grade("Math", 90)
s.add_grade("Programming", 95)
print(s.get_gpa())  # 92.5</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">import java.util.HashMap;
import java.util.Map;

// Planning Example: Student Class
public class Student {
    private String studentId;
    private String name;
    private String course;
    private Map&lt;String, Double&gt; grades;

    public Student(String studentId, String name, String course) {
        this.studentId = studentId;
        this.name = name;
        this.course = course;
        this.grades = new HashMap&lt;&gt;();
    }

    public void addGrade(String subject, double grade) {
        grades.put(subject, grade);
    }

    public double getGPA() {
        if (grades.isEmpty()) return 0.0;
        double sum = grades.values().stream().mapToDouble(Double::doubleValue).sum();
        return Math.round(sum / grades.size() * 100.0) / 100.0;
    }

    // Getters
    public String getStudentId() { return studentId; }
    public String getName() { return name; }
    public String getCourse() { return course; }
    public Map&lt;String, Double&gt; getGrades() { return grades; }

    public static void main(String[] args) {
        Student s = new Student("2024-001", "Juan Dela Cruz", "BSIT");
        s.addGrade("Math", 90);
        s.addGrade("Programming", 95);
        System.out.println(s.getGPA());  // 92.5
    }
}</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
