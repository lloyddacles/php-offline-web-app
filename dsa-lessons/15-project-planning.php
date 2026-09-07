<?php $pageTitle = 'DSA Project Planning'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 15; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>DSA Project Planning</h1>
    <p class="lesson-desc">Learn how to plan a DSA course project — define the problem, choose data structures, design algorithms, and create a development roadmap.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Planning is essential before writing any code. Think about your past coding experiences and consider these review questions:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>Think of a time you started coding without a plan. What problems did you encounter? How did it affect your final result?</li>
        <li>What is the difference between a hash map and an array? When would you choose one over the other?</li>
        <li>Why is it important to understand the problem before choosing a solution approach?</li>
        <li>What does it mean to analyze the time and space complexity of an algorithm?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Project planning in DSA means systematically defining the problem, selecting appropriate data structures, designing efficient algorithms, analyzing complexity, and mapping out a development roadmap before writing any code.</p>

<h3>Analogy</h3>
<p>Building a house requires blueprints, material selection, and a construction schedule. Similarly, a DSA project needs a problem definition, data structure choices, and an implementation plan. Jumping straight into coding is like building walls without a blueprint — you might end up tearing everything down.</p>

<h3>How It Works (Step by Step)</h3>

<h4>Step 1: Problem Definition</h4>
<div class="info-box note">
    <div class="box-title">Template</div>
    <p><strong>Project Name:</strong> _______________________<br>
    <strong>Problem Statement:</strong> What specific problem does this solve?<br>
    <strong>Target Users:</strong> Who will use this?<br>
    <strong>Success Criteria:</strong> How do we know it works?</p>
</div>

<h4>Step 2: Requirements Analysis</h4>
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

<h4>Step 3: Data Structure Selection</h4>
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

<h4>Step 4: Algorithm Design</h4>
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

<h4>Step 5: Complexity Analysis</h4>
<pre>
Feature              Algorithm          Time        Space
─────────────────────────────────────────────────────────
Add Student          Hash Insert        O(1)        O(1)
Search by ID         Hash Lookup        O(1)        O(1)
Rank Students        Sort + Assign      O(n log n)  O(n)
Find Top 10          Sort + Slice       O(n log n)  O(n)
Find Median          Quickselect        O(n)        O(1)
Course Dependencies  Topological Sort   O(V + E)    O(V)
Shortest Path        Dijkstra           O((V+E)log V) O(V)</pre>

<h4>Step 6: Development Roadmap</h4>
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
  □ Documentation</pre>

<h3>Python Implementation</h3>
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

<h3>Java Implementation</h3>
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

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Startup MVPs:</strong> Plan data structures before building to avoid costly rewrites</li>
    <li><strong>Enterprise Systems:</strong> Requirements gathering and complexity analysis prevent scalability bottlenecks</li>
    <li><strong>Competition Programming:</strong> Quick problem analysis and strategy selection under time pressure</li>
    <li><strong>Team Projects:</strong> Clear planning documents help team members work in parallel</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>Document first, code second</strong> — writing the problem statement forces clarity</li>
    <li><strong>Choose data structures based on operations needed</strong> — not what's "popular"</li>
    <li><strong>Analyze complexity early</strong> — if O(n²) won't scale, redesign now</li>
    <li><strong>Break into small phases</strong> — each phase should produce a testable increment</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Project Type</th><th>Key Planning Focus</th><th>Critical Step</th></tr></thead>
    <tbody>
        <tr><td>Small assignment</td><td>Problem definition + basic data structure</td><td>Choose the right structure</td></tr>
        <tr><td>Medium project</td><td>Requirements + algorithm design</td><td>Complexity analysis</td></tr>
        <tr><td>Large system</td><td>Full planning pipeline + roadmap</td><td>Phased development plan</td></tr>
        <tr><td>Team project</td><td>Document everything + define interfaces</td><td>Module decomposition</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> Your university wants a <strong>Student Performance Tracking System</strong>. The system must:</p>
    <ul>
        <li>Store records for up to 2,000 students (ID, name, course, grades per subject)</li>
        <li>Allow fast lookup by student ID</li>
        <li>Search students by partial name match</li>
        <li>Rank students by GPA within each course</li>
        <li>Track course prerequisites and verify a student can enroll in a course</li>
        <li>Generate class statistics (mean, median, highest, lowest GPA)</li>
    </ul>
    <p><strong>Task:</strong> Create a complete project plan including:</p>
    <ol>
        <li>Problem statement (1 paragraph)</li>
        <li>List of functional and non-functional requirements</li>
        <li>Data structure selection for each feature (with justification)</li>
        <li>Complexity analysis table for all operations</li>
        <li>A 4-week development roadmap with milestones</li>
    </ol>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer 1: Problem Statement</strong></p>
        <p>The Student Performance Tracking System enables university faculty to efficiently manage student records, compute class rankings, verify course enrollment prerequisites, and generate performance statistics. Currently, instructors manually track grades in spreadsheets, which is error-prone and time-consuming for 2,000+ students.</p>

        <p><strong>Answer 2: Requirements</strong></p>
        <p><strong>Functional:</strong> Add/edit/delete student records, record grades per subject, compute GPA, rank students by GPA within course, search by ID (exact) and name (partial), verify course prerequisites, generate statistics (mean, median, min, max).</p>
        <p><strong>Non-Functional:</strong> Handle 2,000 students, search under 50ms, ranking under 500ms, data persistence via file or database, clean output format.</p>

        <p><strong>Answer 3: Data Structure Selection</strong></p>
        <table>
            <thead><tr><th>Feature</th><th>Structure</th><th>Justification</th></tr></thead>
            <tbody>
                <tr><td>Student records</td><td>HashMap (ID → Student)</td><td>O(1) lookup by ID, O(1) insert</td></tr>
                <tr><td>Name search</td><td>Inverted index (name → IDs)</td><td>Pre-built index for fast partial matching</td></tr>
                <tr><td>Ranking</td><td>Sorted array (merge sort)</td><td>O(n log n) sort, stable for equal GPAs</td></tr>
                <tr><td>Course prerequisites</td><td>Directed Acyclic Graph (adj list)</td><td>Models dependencies, topological sort for valid order</td></tr>
                <tr><td>Statistics</td><td>Single-pass calculation</td><td>O(n) for mean, O(n log n) for median</td></tr>
            </tbody>
        </table>

        <p><strong>Answer 4: Complexity Analysis</strong></p>
        <table>
            <thead><tr><th>Operation</th><th>Algorithm</th><th>Time</th><th>Space</th></tr></thead>
            <tbody>
                <tr><td>Add student</td><td>HashMap insert</td><td>O(1)</td><td>O(1)</td></tr>
                <tr><td>Find by ID</td><td>HashMap lookup</td><td>O(1)</td><td>O(1)</td></tr>
                <tr><td>Search by name</td><td>Index scan</td><td>O(k) where k = matches</td><td>O(k)</td></tr>
                <tr><td>Rank all students</td><td>Merge sort + assign</td><td>O(n log n)</td><td>O(n)</td></tr>
                <tr><td>Check prerequisites</td><td>Graph DFS</td><td>O(V + E)</td><td>O(V)</td></tr>
                <tr><td>Statistics (mean)</td><td>Single pass sum</td><td>O(n)</td><td>O(1)</td></tr>
                <tr><td>Statistics (median)</td><td>Sort + index</td><td>O(n log n)</td><td>O(n)</td></tr>
            </tbody>
        </table>

        <p><strong>Answer 5: 4-Week Roadmap</strong></p>
        <pre>
Phase 1 (Week 1): Core Data Structures
  □ Student class with grades, GPA calculation
  □ StudentStore with HashMap (add, getById, delete)
  □ Name search with inverted index

Phase 2 (Week 2): Sorting and Ranking
  □ Merge sort implementation
  □ RankService: rankByGPA, getTopN
  □ Statistics: mean, median, highest, lowest

Phase 3 (Week 3): Graph Features
  □ CourseGraph with adjacency list
  □ Add edge (prerequisite relationship)
  □ canTake() — verify prerequisites met
  □ topologicalSort() — valid course order

Phase 4 (Week 4): Integration & Polish
  □ Integrate all modules
  □ Add error handling (duplicate ID, missing student)
  □ Performance test with 2,000 synthetic records
  □ Documentation (README, complexity table)</pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
