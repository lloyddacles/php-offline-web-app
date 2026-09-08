<?php $pageTitle = 'DSA Project Implementation'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 16; $sectionDir = 'dsa-lessons'; $prevNext = getPrevNextLesson($num, $sectionDir); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>DSA Project Implementation</h1>
    <p class="lesson-desc">Build your DSA project step by step — modular design, implementation patterns, and integrating multiple data structures.</p>
</div>

<h2>Part 1: Activate Prior Knowledge</h2>
<p>Now that you've planned your project, it's time to implement. Consider what you already know about writing organized code:</p>
<div class="info-box note">
    <div class="box-title">Review Questions</div>
    <ol>
        <li>What is a class? How does it differ from a function? Why do we use classes for complex data?</li>
        <li>What is encapsulation? How does hiding internal details make code easier to maintain?</li>
        <li>Why do we separate code into different files or modules? What problems does this solve?</li>
        <li>If you have a HashMap and need to add a new feature, what is the advantage of modifying one class vs rewriting all your code?</li>
    </ol>
</div>

<h2>Part 2: Acquire New Knowledge</h2>

<h3>Definition</h3>
<p>Modular design means building each data structure and service as a <strong>separate class</strong>, with clear interfaces, then combining them in your main application. Each module handles one responsibility.</p>

<h3>Analogy</h3>
<p>Think of a car factory. The engine team builds engines, the transmission team builds transmissions, and the assembly line connects them. Each team works independently with a clear interface (bolt patterns, shaft sizes). If the engine design changes, the transmission team isn't affected.</p>

<h3>How It Works (Step by Step)</h3>

<h4>Project Structure</h4>
<pre><code class="language-php">&lt;?php
// Project structure:
// project/
//   ├── data/
//   │   ├── Student.php
//   │   └── Course.php
//   ├── structures/
//   │   ├── HashMap.php
//   │   ├── BinarySearchTree.php
//   │   ├── PriorityQueue.php
//   │   └── Graph.php
//   ├── services/
//   │   ├── GradeService.php
//   │   ├── RankService.php
//   │   └── SearchService.php
//   └── index.php (main app)</code></pre>

<h4>Student Class</h4>
<pre><code class="language-php">&lt;?php
class Student {
    public string $id;
    public string $name;
    public string $course;
    public array $grades = [];  // subject => grade

    public function __construct(string $id, string $name, string $course) {
        $this->id = $id;
        $this->name = $name;
        $this->course = $course;
    }

    public function addGrade(string $subject, float $grade): void {
        $this->grades[$subject] = $grade;
    }

    public function getGPA(): float {
        if (empty($this->grades)) return 0.0;
        return round(array_sum($this->grades) / count($this->grades), 2);
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'course' => $this->course,
            'grades' => $this->grades,
            'gpa' => $this->getGPA()
        ];
    }
}</code></pre>

<h4>StudentStore (HashMap)</h4>
<pre><code class="language-php">&lt;?php
class StudentStore {
    private array $byId = [];      // id => Student
    private array $byName = [];    // name_lower => [id, id, ...]
    private array $byCourse = [];  // course => [id, id, ...]

    public function add(Student $student): void {
        $this->byId[$student->id] = $student;
        $key = strtolower($student->name);
        $this->byName[$key][] = $student->id;
        $this->byCourse[$student->course][] = $student->id;
    }

    public function getById(string $id): ?Student {
        return $this->byId[$id] ?? null;
    }

    public function searchByName(string $query): array {
        $results = [];
        foreach ($this->byName as $name => $ids) {
            if (str_contains($name, strtolower($query))) {
                foreach ($ids as $id) {
                    $results[] = $this->byId[$id];
                }
            }
        }
        return $results;
    }

    public function getByCourse(string $course): array {
        $ids = $this->byCourse[$course] ?? [];
        return array_map(fn($id) => $this->byId[$id], $ids);
    }

    public function getAll(): array {
        return array_values($this->byId);
    }

    public function count(): int {
        return count($this->byId);
    }

    public function delete(string $id): bool {
        if (!isset($this->byId[$id])) return false;
        $student = $this->byId[$id];
        unset($this->byId[$id]);
        $nameKey = strtolower($student->name);
        $this->byName[$nameKey] = array_diff($this->byName[$nameKey], [$id]);
        $this->byCourse[$student->course] = array_diff($this->byCourse[$student->course], [$id]);
        return true;
    }
}</code></pre>

<h4>RankService (Sorting)</h4>
<pre><code class="language-php">&lt;?php
class RankService {
    public static function rankByGPA(array $students): array {
        $ranked = $students;
        usort($ranked, fn($a, $b) => $b->getGPA() <=> $a->getGPA());

        $result = [];
        $rank = 1;
        foreach ($ranked as $i => $student) {
            if ($i > 0 && $student->getGPA() < $ranked[$i - 1]->getGPA()) {
                $rank = $i + 1;
            }
            $result[] = ['rank' => $rank, 'student' => $student];
        }
        return $result;
    }

    public static function getTopN(array $students, int $n): array {
        $ranked = self::rankByGPA($students);
        return array_slice($ranked, 0, $n);
    }

    public static function getStatistics(array $students): array {
        $gpas = array_map(fn($s) => $s->getGPA(), $students);
        sort($gpas);
        $count = count($gpas);
        return [
            'count' => $count,
            'mean' => round(array_sum($gpas) / $count, 2),
            'median' => $gpas[intdiv($count, 2)],
            'highest' => end($gpas),
            'lowest' => $gpas[0],
        ];
    }
}</code></pre>

<h4>CourseGraph (Graph)</h4>
<pre><code class="language-php">&lt;?php
class CourseGraph {
    private array $adjList = [];  // course => [prerequisites]

    public function addEdge(string $course, string $prerequisite): void {
        $this->adjList[$course][] = $prerequisite;
    }

    // Topological sort — valid course order
    public function topologicalSort(): array {
        $inDegree = [];
        foreach ($this->adjList as $course => $pres) {
            if (!isset($inDegree[$course])) $inDegree[$course] = 0;
            foreach ($pres as $pre) {
                $inDegree[$pre] = ($inDegree[$pre] ?? 0) + 1;
            }
        }

        $queue = [];
        foreach ($inDegree as $course => $deg) {
            if ($deg === 0) $queue[] = $course;
        }

        $order = [];
        while (!empty($queue)) {
            $course = array_shift($queue);
            $order[] = $course;
            foreach ($this->adjList[$course] ?? [] as $pre) {
                $inDegree[$pre]--;
                if ($inDegree[$pre] === 0) $queue[] = $pre;
            }
        }

        return $order;
    }

    public function canTake(string $course, array $completed): bool {
        foreach ($this->adjList[$course] ?? [] as $pre) {
            if (!in_array($pre, $completed)) return false;
        }
        return true;
    }
}</code></pre>

<h4>Integration: Main Application</h4>
<pre><code class="language-php">&lt;?php
// Main app — brings everything together
$store = new StudentStore();

// Add students
$juan = new Student('2024-001', 'Juan Dela Cruz', 'BSIT');
$juan->addGrade('Math', 90);
$juan->addGrade('Programming', 95);
$juan->addGrade('English', 85);
$store->add($juan);

$maria = new Student('2024-002', 'Maria Santos', 'BSCS');
$maria->addGrade('Math', 92);
$maria->addGrade('Programming', 88);
$maria->addGrade('English', 91);
$store->add($maria);

// Search
$results = $store->searchByName('Juan');

// Rank
$ranked = RankService::rankByGPA($store->getAll());

// Statistics
$stats = RankService::getStatistics($store->getAll());

// Course prerequisites
$graph = new CourseGraph();
$graph->addEdge('DSA', 'Programming 1');
$graph->addEdge('Database', 'Programming 1');
$graph->addEdge('Web Dev', 'HTML/CSS');

$order = $graph->topologicalSort();</code></pre>

<h3>Python Example: HashMap-Based Store</h3>
<p>Using a hash map for O(1) student lookups.</p>
<pre><code class="language-python">class Student:
    def __init__(self, sid, name, course):
        self.sid = sid
        self.name = name
        self.course = course
        self.gpa = 0.0

class StudentStore:
    def __init__(self):
        self.students = {}   # HashMap: sid -> Student

    def add(self, student):
        self.students[student.sid] = student  # O(1)

    def get(self, sid):
        return self.students.get(sid)         # O(1)

    def remove(self, sid):
        if sid in self.students:
            del self.students[sid]            # O(1)
            return True
        return False

# Test it
store = StudentStore()
store.add(Student("001", "Juan", "BSIT"))
store.add(Student("002", "Maria", "BSCS"))

print(store.get("001").name)  # Juan
store.remove("002")
print(store.get("002"))       # None
</code></pre>
<strong>Output:</strong>
<pre>Juan
None</pre>

<h3>Java Example: HashMap-Based Store</h3>
<p>Using a hash map for O(1) student lookups.</p>
<pre><code class="language-java">import java.util.HashMap;

public class Main {
    static class Student {
        String sid, name, course;
        double gpa = 0.0;

        Student(String sid, String name, String course) {
            this.sid = sid;
            this.name = name;
            this.course = course;
        }
    }

    static class StudentStore {
        HashMap&lt;String, Student&gt; students = new HashMap&lt;&gt;();

        void add(Student s) { students.put(s.sid, s); }     // O(1)
        Student get(String sid) { return students.get(sid); } // O(1)
        boolean remove(String sid) { return students.remove(sid) != null; }
    }

    public static void main(String[] args) {
        StudentStore store = new StudentStore();
        store.add(new Student("001", "Juan", "BSIT"));
        store.add(new Student("002", "Maria", "BSCS"));

        System.out.println(store.get("001").name);  // Juan
        store.remove("002");
        System.out.println(store.get("002"));        // null
    }
}
</code></pre>
<strong>Output:</strong>
<pre>Juan
null</pre>

<h2>Part 3: Apply New Knowledge</h2>

<h3>Real-World Applications</h3>
<ul>
    <li><strong>Web Applications:</strong> Separating data models, business logic, and presentation layers</li>
    <li><strong>Mobile Apps:</strong> Repository pattern for data access, service layer for business logic</li>
    <li><strong>API Development:</strong> Controllers, services, and models as separate modules</li>
    <li><strong>Large Teams:</strong> Different developers can work on different modules simultaneously</li>
</ul>

<h3>Tips for Success</h3>
<ul>
    <li><strong>One class, one responsibility</strong> — if a class does too many things, split it</li>
    <li><strong>Test each module independently</strong> — before integrating, make sure each piece works alone</li>
    <li><strong>Use clear method names</strong> — <code>getById()</code> is better than <code>get()</code></li>
    <li><strong>Handle edge cases early</strong> — what happens with null, empty, or duplicate inputs?</li>
</ul>

<h3>When to Use This</h3>
<table>
    <thead><tr><th>Scenario</th><th>Approach</th><th>Why</th></tr></thead>
    <tbody>
        <tr><td>Quick prototype</td><td>All-in-one script</td><td>Speed of development</td></tr>
        <tr><td>Small project</td><td>2-3 classes</td><td>Organized but not over-engineered</td></tr>
        <tr><td>Medium project</td><td>Full modular design</td><td>Maintainability and testability</td></tr>
        <tr><td>Team project</td><td>Interface-based modules</td><td>Parallel development</td></tr>
    </tbody>
</table>

<h2>Part 4: Assess Your Learning</h2>

<div class="info-box note">
    <div class="box-title">Scenario-Based Activity</div>
    <p><strong>Scenario:</strong> You are building the Student Performance Tracking System from Lesson 15. Your plan calls for a Student class and a StudentStore class using a HashMap for O(1) lookups.</p>
    <p><strong>Task:</strong> Implement the following:</p>
    <ol>
        <li>A <strong>Student</strong> class with properties: id, name, course, grades (associative array). Include methods: <code>addGrade(subject, grade)</code>, <code>getGPA()</code>, and <code>toArray()</code>.</li>
        <li>A <strong>StudentStore</strong> class that stores students in a HashMap by ID. Implement: <code>add(student)</code>, <code>getById(id)</code>, <code>searchByName(query)</code> (partial match), <code>delete(id)</code>, and <code>count()</code>.</li>
        <li>Write test code that adds 3 students, searches for one by partial name, retrieves one by ID, deletes one, and confirms the count is correct.</li>
    </ol>
    <p>Write your solution in PHP, Python, and Java.</p>
</div>

<details>
    <summary>Teacher Answer Key (Click to reveal)</summary>
    <div style="padding:16px; background:var(--bg-surface); border-radius:var(--radius); margin-top:12px;">
        <p><strong>Answer: PHP Implementation</strong></p>
        <pre><code>&lt;?php
class Student {
    public string $id;
    public string $name;
    public string $course;
    public array $grades = [];

    public function __construct(string $id, string $name, string $course) {
        $this->id = $id;
        $this->name = $name;
        $this->course = $course;
    }

    public function addGrade(string $subject, float $grade): void {
        $this->grades[$subject] = $grade;
    }

    public function getGPA(): float {
        if (empty($this->grades)) return 0.0;
        return round(array_sum($this->grades) / count($this->grades), 2);
    }

    public function toArray(): array {
        return [
            'id' => $this->id, 'name' => $this->name,
            'course' => $this->course, 'grades' => $this->grades,
            'gpa' => $this->getGPA()
        ];
    }
}

class StudentStore {
    private array $byId = [];
    private array $byName = [];

    public function add(Student $student): void {
        $this->byId[$student->id] = $student;
        $key = strtolower($student->name);
        $this->byName[$key][] = $student->id;
    }

    public function getById(string $id): ?Student {
        return $this->byId[$id] ?? null;
    }

    public function searchByName(string $query): array {
        $results = [];
        foreach ($this->byName as $name => $ids) {
            if (str_contains($name, strtolower($query))) {
                foreach ($ids as $id) $results[] = $this->byId[$id];
            }
        }
        return $results;
    }

    public function delete(string $id): bool {
        if (!isset($this->byId[$id])) return false;
        $student = $this->byId[$id];
        unset($this->byId[$id]);
        $key = strtolower($student->name);
        $this->byName[$key] = array_diff($this->byName[$key], [$id]);
        return true;
    }

    public function count(): int { return count($this->byId); }
}

// Test
$store = new StudentStore();
$store->add(new Student('001', 'Juan Dela Cruz', 'BSIT'));
$store->add(new Student('002', 'Maria Santos', 'BSCS'));
$store->add(new Student('003', 'Pedro Reyes', 'BSIT'));

$results = $store->searchByName('an');
echo "Search 'an': " . count($results) . " results\n";  // 2 (Juan, Maria)

$juan = $store->getById('001');
echo "Found: " . $juan->name . "\n";  // Juan Dela Cruz

$store->delete('002');
echo "Count after delete: " . $store->count() . "\n";  // 2</code></pre>

        <p><strong>Answer: Python Implementation</strong></p>
        <pre><code>class Student:
    def __init__(self, student_id, name, course):
        self.student_id = student_id
        self.name = name
        self.course = course
        self.grades = {}

    def add_grade(self, subject, grade):
        self.grades[subject] = grade

    def get_gpa(self):
        if not self.grades:
            return 0.0
        return round(sum(self.grades.values()) / len(self.grades), 2)


class StudentStore:
    def __init__(self):
        self.by_id = {}
        self.by_name = {}

    def add(self, student):
        self.by_id[student.student_id] = student
        key = student.name.lower()
        self.by_name.setdefault(key, []).append(student.student_id)

    def get_by_id(self, student_id):
        return self.by_id.get(student_id)

    def search_by_name(self, query):
        results = []
        for name, ids in self.by_name.items():
            if query.lower() in name:
                for sid in ids:
                    results.append(self.by_id[sid])
        return results

    def delete(self, student_id):
        if student_id not in self.by_id:
            return False
        student = self.by_id.pop(student_id)
        key = student.name.lower()
        self.by_name[key].remove(student_id)
        return True

    def count(self):
        return len(self.by_id)


# Test
store = StudentStore()
store.add(Student("001", "Juan Dela Cruz", "BSIT"))
store.add(Student("002", "Maria Santos", "BSCS"))
store.add(Student("003", "Pedro Reyes", "BSIT"))

results = store.search_by_name("an")
print(f"Search 'an': {len(results)} results")  # 2

juan = store.get_by_id("001")
print(f"Found: {juan.name}")  # Juan Dela Cruz

store.delete("002")
print(f"Count after delete: {store.count()}")  # 2</code></pre>

        <p><strong>Answer: Java Implementation</strong></p>
        <pre><code>import java.util.*;

class Student {
    private String id, name, course;
    private Map&lt;String, Double&gt; grades = new HashMap&lt;&gt;();

    public Student(String id, String name, String course) {
        this.id = id; this.name = name; this.course = course;
    }

    public void addGrade(String subject, double grade) {
        grades.put(subject, grade);
    }

    public double getGPA() {
        if (grades.isEmpty()) return 0.0;
        return grades.values().stream().mapToDouble(d -> d).average().orElse(0.0);
    }

    public String getId() { return id; }
    public String getName() { return name; }
}

class StudentStore {
    private Map&lt;String, Student&gt; byId = new HashMap&lt;&gt;();
    private Map&lt;String, List&lt;String&gt;&gt; byName = new HashMap&lt;&gt;();

    public void add(Student s) {
        byId.put(s.getId(), s);
        byName.computeIfAbsent(s.getName().toLowerCase(), k -> new ArrayList&lt;&gt;()).add(s.getId());
    }

    public Student getById(String id) { return byId.get(id); }

    public List&lt;Student&gt; searchByName(String query) {
        List&lt;Student&gt; results = new ArrayList&lt;&gt;();
        String q = query.toLowerCase();
        for (var e : byName.entrySet()) {
            if (e.getKey().contains(q))
                e.getValue().forEach(id -> results.add(byId.get(id)));
        }
        return results;
    }

    public boolean delete(String id) {
        Student s = byId.remove(id);
        if (s == null) return false;
        byName.get(s.getName().toLowerCase()).remove(id);
        return true;
    }

    public int count() { return byId.size(); }

    public static void main(String[] args) {
        StudentStore store = new StudentStore();
        store.add(new Student("001", "Juan Dela Cruz", "BSIT"));
        store.add(new Student("002", "Maria Santos", "BSCS"));
        store.add(new Student("003", "Pedro Reyes", "BSIT"));

        List&lt;Student&gt; results = store.searchByName("an");
        System.out.println("Search 'an': " + results.size() + " results");  // 2

        Student juan = store.getById("001");
        System.out.println("Found: " + juan.getName());  // Juan Dela Cruz

        store.delete("002");
        System.out.println("Count after delete: " + store.count());  // 2
    }
}</code></pre>
    </div>
</details>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
