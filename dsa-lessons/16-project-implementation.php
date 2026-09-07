<?php $pageTitle = 'Course Project Implementation and Integration'; require_once __DIR__ . '/../includes/functions.php'; require_once __DIR__ . '/../includes/header.php'; ?>
<?php $num = 16; $prevNext = getPrevNextLesson($num, 'dsa-lessons'); ?>

<div class="lesson-header">
    <span class="lesson-number">Lesson <?= $num ?></span>
    <h1>Course Project Implementation and Integration</h1>
    <p class="lesson-desc">Build your DSA project step by step — modular design, PHP implementation patterns, and integrating multiple data structures.</p>
</div>

<h2>Modular Design Principle</h2>
<p>Build each data structure as a <strong>separate class</strong>, then combine them in your main application.</p>

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

<h2>Core Classes</h2>

<h3>Student Model</h3>
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

<h3>HashMap for Fast Lookups</h3>
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
}</code></pre>

<h3>Ranking Service with Sorting</h3>
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

<h3>Graph for Course Prerequisites</h3>
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

<h2>Integration: Main Application</h2>
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

<h2>Implementation Checklist</h2>
<table>
    <thead><tr><th>Phase</th><th>Task</th><th>Status</th></tr></thead>
    <tbody>
        <tr><td>1</td><td>Create Student/Course classes</td><td>□</td></tr>
        <tr><td>2</td><td>Implement HashMap storage</td><td>□</td></tr>
        <tr><td>3</td><td>Add sorting and ranking</td><td>□</td></tr>
        <tr><td>4</td><td>Build search functionality</td><td>□</td></tr>
        <tr><td>5</td><td>Create course prerequisite graph</td><td>□</td></tr>
        <tr><td>6</td><td>Integrate all modules</td><td>□</td></tr>
        <tr><td>7</td><td>Add error handling</td><td>□</td></tr>
        <tr><td>8</td><td>Test edge cases</td><td>□</td></tr>
    </tbody>
</table>

<h2>Python Implementation</h2>
<pre><code class="language-python">class Student:
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

    def to_dict(self):
        return {
            "id": self.student_id,
            "name": self.name,
            "course": self.course,
            "grades": self.grades,
            "gpa": self.get_gpa()
        }


class StudentStore:
    def __init__(self):
        self.by_id = {}       # id => Student
        self.by_name = {}     # name_lower => [id, id, ...]
        self.by_course = {}   # course => [id, id, ...]

    def add(self, student):
        self.by_id[student.student_id] = student
        key = student.name.lower()
        self.by_name.setdefault(key, []).append(student.student_id)
        self.by_course.setdefault(student.course, []).append(student.student_id)

    def get_by_id(self, student_id):
        return self.by_id.get(student_id, None)

    def search_by_name(self, query):
        results = []
        query_lower = query.lower()
        for name, ids in self.by_name.items():
            if query_lower in name:
                for sid in ids:
                    results.append(self.by_id[sid])
        return results

    def get_by_course(self, course):
        ids = self.by_course.get(course, [])
        return [self.by_id[sid] for sid in ids]

    def get_all(self):
        return list(self.by_id.values())

    def count(self):
        return len(self.by_id)


# Usage
store = StudentStore()
juan = Student("2024-001", "Juan Dela Cruz", "BSIT")
juan.add_grade("Math", 90)
juan.add_grade("Programming", 95)
store.add(juan)

maria = Student("2024-002", "Maria Santos", "BSCS")
maria.add_grade("Math", 92)
maria.add_grade("Programming", 88)
store.add(maria)

print(store.search_by_name("Juan"))  # [Student object]
print(store.count())  # 2</code></pre>

<h2>Java Implementation</h2>
<pre><code class="language-java">import java.util.*;
import java.util.stream.Collectors;

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

    public String getStudentId() { return studentId; }
    public String getName() { return name; }
    public String getCourse() { return course; }
    public Map&lt;String, Double&gt; getGrades() { return grades; }
}

class StudentStore {
    private Map&lt;String, Student&gt; byId = new HashMap&lt;&gt;();
    private Map&lt;String, List&lt;String&gt;&gt; byName = new HashMap&lt;&gt;();
    private Map&lt;String, List&lt;String&gt;&gt; byCourse = new HashMap&lt;&gt;();

    public void add(Student student) {
        byId.put(student.getStudentId(), student);
        String key = student.getName().toLowerCase();
        byName.computeIfAbsent(key, k -&gt; new ArrayList&lt;&gt;()).add(student.getStudentId());
        byCourse.computeIfAbsent(student.getCourse(), k -&gt; new ArrayList&lt;&gt;()).add(student.getStudentId());
    }

    public Student getById(String id) {
        return byId.getOrDefault(id, null);
    }

    public List&lt;Student&gt; searchByName(String query) {
        List&lt;Student&gt; results = new ArrayList&lt;&gt;();
        String queryLower = query.toLowerCase();
        for (Map.Entry&lt;String, List&lt;String&gt;&gt; entry : byName.entrySet()) {
            if (entry.getKey().contains(queryLower)) {
                for (String sid : entry.getValue()) {
                    results.add(byId.get(sid));
                }
            }
        }
        return results;
    }

    public List&lt;Student&gt; getByCourse(String course) {
        List&lt;String&gt; ids = byCourse.getOrDefault(course, new ArrayList&lt;&gt;());
        return ids.stream().map(byId::get).collect(Collectors.toList());
    }

    public List&lt;Student&gt; getAll() {
        return new ArrayList&lt;&gt;(byId.values());
    }

    public int count() {
        return byId.size();
    }

    public static void main(String[] args) {
        StudentStore store = new StudentStore();
        Student juan = new Student("2024-001", "Juan Dela Cruz", "BSIT");
        juan.addGrade("Math", 90);
        juan.addGrade("Programming", 95);
        store.add(juan);

        Student maria = new Student("2024-002", "Maria Santos", "BSCS");
        maria.addGrade("Math", 92);
        maria.addGrade("Programming", 88);
        store.add(maria);

        System.out.println(store.searchByName("Juan"));  // [Student object]
        System.out.println(store.count());  // 2
    }
}</code></pre>

<?php include __DIR__ . '/../includes/prev-next-nav.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
