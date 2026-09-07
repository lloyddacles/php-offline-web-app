<?php $pageTitle = 'Final Project Presentation, Demonstration, and Technical Defense'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 18; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Final Project Presentation, Demonstration, and Technical Defense</h1>
    <p class="lesson-desc">Prepare and deliver a professional project presentation. Demonstrate your working system and defend your technical decisions.</p>
</div>

<h2>Presentation Structure</h2>
<p>A strong technical presentation follows this flow:</p>

<pre>
1. Opening (2 min)
   → Problem statement and motivation
   → What your project solves

2. Live Demo (5 min)
   → Show the working system
   → Highlight key features

3. Technical Deep Dive (5 min)
   → Data structures chosen and why
   → Algorithm complexity analysis
   → Code architecture overview

4. Results & Testing (2 min)
   → Test results
   → Performance benchmarks

5. Lessons Learned (1 min)
   → Challenges faced
   → What you'd do differently

6. Q&A (5 min)
   → Answer technical questions
</pre>

<h2>Opening: Problem Statement</h2>
<div class="info-box note">
    <div class="box-title">Template</div>
    <p>"Our project solves [PROBLEM] for [USERS]. Without this system, [CURRENT PAIN POINT]. Our solution uses [APPROACH] to achieve [RESULT] with [COMPLEXITY] performance."</p>
</div>

<h3>Example Opening</h3>
<blockquote style="border-left:3px solid var(--accent); padding:12px 16px; background:var(--bg-surface); border-radius:var(--radius); margin:16px 0;">
"Our Student Performance Tracker solves the problem of manual grade computation for 500+ students. Without it, instructors spend 3+ hours per grading period. Our solution uses hash maps for O(1) lookups and merge sort for ranking, computing class rankings in under 50ms."
</blockquote>

<h2>Live Demo Script</h2>
<pre><code class="language-php">&lt;?php
// Demo flow — show these features in order:
$demoSteps = [
    [
        'action' => 'Add a new student',
        'code'   => '$store->add(new Student("2024-010", "Ana Garcia", "BSCS"));',
        'result' => 'Student added successfully.',
        'point'  => 'Hash map enables O(1) insert'
    ],
    [
        'action' => 'Search for a student',
        'code'   => '$store->searchByName("Garcia");',
        'result' => '[Student: Ana Garcia, BS Computer Science]',
        'point'  => 'Fast search across 500+ records'
    ],
    [
        'action' => 'Show class rankings',
        'code'   => 'RankService::rankByGPA($store->getAll());',
        'result' => '1. Juan (3.85)  2. Maria (3.80)  3. Pedro (3.60)',
        'point'  => 'Merge sort: O(n log n)'
    ],
    [
        'action' => 'Check course prerequisites',
        'code'   => '$graph->canTake("DSA", ["Programming 1"]);',
        'result' => 'true — prerequisites met',
        'point'  => 'Graph traversal for dependency checking'
    ],
    [
        'action' => 'Show statistics',
        'code'   => 'RankService::getStatistics($store->getAll());',
        'result' => 'Mean: 3.65, Median: 3.70, Highest: 3.85',
        'point'  => 'O(n) single-pass computation'
    ]
];</code></pre>

<h2>Technical Defense: Common Questions</h2>

<table>
    <thead><tr><th>Question</th><strong>Good Answer</th></tr></thead>
    <tbody>
        <tr>
            <td><strong>Why hash map instead of array?</strong></td>
            <td>"Hash map gives O(1) average lookup by ID. With 500 students, searching an array is O(n) = 500 comparisons vs O(1) hash lookup."</td>
        </tr>
        <tr>
            <td><strong>Why merge sort over quick sort?</strong></td>
            <td>"Merge sort is stable — students with equal GPA maintain their original order. Quick sort could be faster but isn't stable."</td>
        </tr>
        <tr>
            <td><strong>What's the worst case?</strong></td>
            <td>"Hash collisions degrade to O(n), but with a good hash function and load factor below 0.75, this is rare in practice."</td>
        </tr>
        <tr>
            <td><strong>How does this scale?</strong></td>
            <td>"With 10,000 students, our O(n log n) ranking takes ~130,000 operations — well under 1 second. Hash lookups remain O(1)."</td>
        </tr>
        <tr>
            <td><strong>Why use a graph for prerequisites?</strong></td>
            <td>"Course prerequisites form a DAG. Topological sort gives a valid course order, and cycle detection prevents circular dependencies."</td>
        </tr>
        <tr>
            <td><strong>What would you change?</strong></td>
            <td>"I'd add a self-balancing BST (AVL) for the ranking system to maintain O(log n) insert while keeping sorted order."</td>
        </tr>
    </tbody>
</table>

<h2>Complexity Cheat Sheet</h2>
<pre>
Data Structure     Access    Search    Insert    Delete    Use Case
─────────────────────────────────────────────────────────────────────
Array              O(1)      O(n)      O(n)      O(n)      Index-based access
Linked List        O(n)      O(n)      O(1)*     O(1)*     Frequent inserts
Hash Map           N/A       O(1)      O(1)      O(1)      Key-value lookup
BST                O(log n)  O(log n)  O(log n)  O(log n)  Sorted data
Balanced BST       O(log n)  O(log n)  O(log n)  O(log n)  Always sorted
Graph (adj list)   O(1)      O(V+E)    O(1)      O(V+E)   Relationships
Heap               N/A       O(n)      O(log n)  O(log n)  Priority queue
</pre>

<h2>Presentation Tips</h2>
<ul>
    <li><strong>Practice timing</strong> — Aim for 15 minutes total</li>
    <li><strong>Show, don't tell</strong> — Live demo beats slides</li>
    <li><strong>Know your numbers</strong> — Recite complexity from memory</li>
    <li><strong>Be honest</strong> — Acknowledge limitations and improvements</li>
    <li><strong>Prepare for questions</strong> — Think "why did you choose X?" for every decision</li>
    <li><strong>Have a backup</strong> — Screenshot or video in case live demo fails</li>
</ul>

<h2>Grading Rubric</h2>
<table>
    <thead><tr><th>Criteria</th><th>Weight</th><th>What's Evaluated</th></tr></thead>
    <tbody>
        <tr><td>Technical Correctness</td><td>30%</td><td>Data structures work, complexity is correct</td></tr>
        <tr><td>Code Quality</td><td>20%</td><td>Modular, readable, well-organized</td></tr>
        <tr><td>Testing</td><td>15%</td><td>Coverage of edge cases, passing tests</td></tr>
        <tr><td>Documentation</td><td>15%</td><td>README, inline comments, complexity table</td></tr>
        <tr><td>Presentation</td><td>10%</td><td>Clear communication, timing, demo flow</td></tr>
        <tr><td>Q&A Defense</td><td>10%</td><td>Answers technical questions confidently</td></tr>
    </tbody>
</table>

<h2>Final Checklist</h2>
<ul>
    <li>□ All features working and tested</li>
    <li>□ README with project overview and complexity table</li>
    <li>□ Test results showing all cases pass</li>
    <li>□ Performance benchmarks for key operations</li>
    <li>□ Presentation slides or demo script ready</li>
    <li>□ Practiced full presentation (under 15 min)</li>
    <li>□ Prepared answers for common technical questions</li>
    <li>□ Backup screenshots in case demo fails</li>
</ul>

<div class="info-box tip">
    <div class="box-title">Congratulations!</div>
    <p>You've completed the entire DSA course. You now understand the fundamental data structures, algorithm design strategies, and how to apply them to real projects. These skills form the foundation of efficient software development.</p>
</div>

<h2>Python Implementation</h2>
<pre><code class="language-python">from student_store import StudentStore, Student
from rank_service import RankService
from course_graph import CourseGraph

def main():
    # Initialize
    store = StudentStore()
    graph = CourseGraph()

    # Add students
    juan = Student("2024-001", "Juan Dela Cruz", "BSIT")
    juan.add_grade("Math", 90)
    juan.add_grade("Programming", 95)
    juan.add_grade("English", 85)
    store.add(juan)

    maria = Student("2024-002", "Maria Santos", "BSCS")
    maria.add_grade("Math", 92)
    maria.add_grade("Programming", 88)
    maria.add_grade("English", 91)
    store.add(maria)

    # Demo: Search
    results = store.search_by_name("Juan")
    print(f"Search results: {len(results)}")

    # Demo: Rankings
    ranked = RankService.rank_by_gpa(store.get_all())
    for entry in ranked[:3]:
        print(f"Rank {entry['rank']}: {entry['student'].name} ({entry['student'].get_gpa()})")

    # Demo: Course prerequisites
    graph.add_edge("DSA", "Programming 1")
    graph.add_edge("Database", "Programming 1")
    print(f"Can take DSA: {graph.can_take('DSA', ['Programming 1'])}")

    # Demo: Statistics
    stats = RankService.get_statistics(store.get_all())
    print(f"Mean GPA: {stats['mean']}, Highest: {stats['highest']}")

if __name__ == "__main__":
    main()</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">import java.util.*;

public class Main {
    public static void main(String[] args) {
        // Initialize
        StudentStore store = new StudentStore();
        CourseGraph graph = new CourseGraph();

        // Add students
        Student juan = new Student("2024-001", "Juan Dela Cruz", "BSIT");
        juan.addGrade("Math", 90);
        juan.addGrade("Programming", 95);
        juan.addGrade("English", 85);
        store.add(juan);

        Student maria = new Student("2024-002", "Maria Santos", "BSCS");
        maria.addGrade("Math", 92);
        maria.addGrade("Programming", 88);
        maria.addGrade("English", 91);
        store.add(maria);

        // Demo: Search
        List&lt;Student&gt; results = store.searchByName("Juan");
        System.out.println("Search results: " + results.size());

        // Demo: Rankings
        List&lt;Map&lt;String, Object&gt;&gt; ranked = RankService.rankByGPA(store.getAll());
        for (int i = 0; i &lt; Math.min(3, ranked.size()); i++) {
            Map&lt;String, Object&gt; entry = ranked.get(i);
            System.out.println("Rank " + entry.get("rank") + ": " +
                ((Student) entry.get("student")).getName());
        }

        // Demo: Course prerequisites
        graph.addEdge("DSA", "Programming 1");
        graph.addEdge("Database", "Programming 1");
        System.out.println("Can take DSA: " + graph.canTake("DSA", List.of("Programming 1")));

        // Demo: Statistics
        Map&lt;String, Double&gt; stats = RankService.getStatistics(store.getAll());
        System.out.println("Mean GPA: " + stats.get("mean") + ", Highest: " + stats.get("highest"));
    }
}</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
