<?php
require_once __DIR__ . '/../includes/functions.php';
$pageTitle = 'Dashboard';
require_once __DIR__ . '/../includes/header.php';

$counts = [
    'prog' => count(getLessons('programming-logic')),
    'php' => count(getLessons()),
    'python' => count(getLessons('python-lessons')),
    'java' => count(getLessons('java-lessons')),
    'dsa' => count(getLessons('dsa-lessons')),
    'dbms' => count(getLessons('dbms-lessons')),
    'mysql' => count(getLessons('mysql-lessons')),
];
$totalLessons = array_sum($counts);
?>

<!-- Welcome Hero -->
<div class="dashboard-hero">
    <div class="dashboard-hero-inner">
        <h1>Welcome to LD TechLab</h1>
        <p class="dashboard-hero-sub">An instructor-led teaching and demonstration platform for programming fundamentals.</p>
        <p class="dashboard-hero-desc">Use this tool to teach concepts, perform live coding demonstrations, and let students explore interactive examples across 7 core subjects — all running offline in a single portable app.</p>
    <div style="margin-top:16px;">
        <a href="/deploy" class="btn btn-outline" style="font-size:0.9em;">&#128295; Deployment Guide</a>
    </div>
    </div>
</div>

<!-- Stats Bar -->
<div class="dashboard-stats">
    <div class="dashboard-stat">
        <div class="dashboard-stat-num">7</div>
        <div class="dashboard-stat-label">Subjects</div>
    </div>
    <div class="dashboard-stat">
        <div class="dashboard-stat-num"><?= $totalLessons ?></div>
        <div class="dashboard-stat-label">Lessons</div>
    </div>
    <div class="dashboard-stat">
        <div class="dashboard-stat-num">7</div>
        <div class="dashboard-stat-label">Interactive Demos</div>
    </div>
    <div class="dashboard-stat">
        <div class="dashboard-stat-num">3</div>
        <div class="dashboard-stat-label">Sandboxes</div>
    </div>
</div>

<!-- Progress Card -->
<div class="progress-card" id="dashboardProgress">
    <h3>Your Learning Progress</h3>
    <div class="progress-overall">
        <div class="progress-bar-container">
            <div class="progress-bar" style="width: 0%"></div>
        </div>
        <span class="progress-text">0 / <?= $totalLessons ?> (0%)</span>
    </div>
    <div class="progress-stats" style="display: flex; gap: 24px; margin: 12px 0; font-size: 0.9em; color: var(--text-secondary);">
        <span>Quizzes Taken: <strong class="quiz-stat-taken">0</strong></span>
        <span>Perfect Scores: <strong class="quiz-stat-perfect">0</strong></span>
    </div>
    <div class="progress-sections">
        <div class="progress-section-item" data-section="programming-logic">
            <span>Prog. Logic</span>
            <span class="progress-text">0/12</span>
        </div>
        <div class="progress-section-item" data-section="lessons">
            <span>PHP</span>
            <span class="progress-text">0/16</span>
        </div>
        <div class="progress-section-item" data-section="python-lessons">
            <span>Python</span>
            <span class="progress-text">0/12</span>
        </div>
        <div class="progress-section-item" data-section="java-lessons">
            <span>Java</span>
            <span class="progress-text">0/12</span>
        </div>
        <div class="progress-section-item" data-section="dsa-lessons">
            <span>DSA</span>
            <span class="progress-text">0/18</span>
        </div>
        <div class="progress-section-item" data-section="dbms-lessons">
            <span>DBMS</span>
            <span class="progress-text">0/10</span>
        </div>
        <div class="progress-section-item" data-section="mysql-lessons">
            <span>MySQL</span>
            <span class="progress-text">0/10</span>
        </div>
    </div>
</div>

<!-- Teaching Tools -->
<section class="dashboard-section">
    <h2 class="dashboard-section-title">Interactive Demos</h2>
    <p class="dashboard-section-desc">Ready-made tools for in-class demonstrations and hands-on practice.</p>
    <div class="dashboard-demos">
        <a href="/demo" class="dashboard-demo-card" style="border-top-color: var(--accent);">
            <span class="dashboard-demo-icon">&#128640;</span>
            <h3>Student Portal</h3>
            <p>Full PHP + SQLite web app with login, dashboard, grades, and enrollment.</p>
            <span class="dashboard-demo-tag">PHP</span>
        </a>
        <a href="/demo/logic-trace" class="dashboard-demo-card" style="border-top-color: var(--accent-yellow);">
            <span class="dashboard-demo-icon">&#128161;</span>
            <h3>Algorithm Tracer</h3>
            <p>Step through algorithms line-by-line. Watch variables change in real time.</p>
            <span class="dashboard-demo-tag">Logic</span>
        </a>
        <a href="/demo/python-lab" class="dashboard-demo-card" style="border-top-color: var(--accent-green);">
            <span class="dashboard-demo-icon">&#128013;</span>
            <h3>Python Data Lab</h3>
            <p>Analyze student data with charts, statistics, and correlation.</p>
            <span class="dashboard-demo-tag">Python</span>
        </a>
        <a href="/demo/java-oop" class="dashboard-demo-card" style="border-top-color: var(--accent-peach);">
            <span class="dashboard-demo-icon">&#9749;</span>
            <h3>Java OOP Designer</h3>
            <p>Design classes visually. See class diagrams and generated Java code.</p>
            <span class="dashboard-demo-tag">Java</span>
        </a>
        <a href="/demo/dsa-sort" class="dashboard-demo-card" style="border-top-color: var(--accent-mauve);">
            <span class="dashboard-demo-icon">&#128208;</span>
            <h3>Sorting Visualizer</h3>
            <p>Watch sorting algorithms animate. Compare speed, swaps, and comparisons.</p>
            <span class="dashboard-demo-tag">DSA</span>
        </a>
        <a href="/demo/dbms-er" class="dashboard-demo-card" style="border-top-color: var(--accent-blue);">
            <span class="dashboard-demo-icon">&#128202;</span>
            <h3>ER Diagram Designer</h3>
            <p>Build entities and relationships. Generate DDL SQL from your diagram.</p>
            <span class="dashboard-demo-tag">DBMS</span>
        </a>
        <a href="/demo/mysql-lab" class="dashboard-demo-card" style="border-top-color: var(--accent-teal);">
            <span class="dashboard-demo-icon">&#128451;</span>
            <h3>SQL Playground</h3>
            <p>Write SQL queries against a sample database. INSERT, UPDATE, DELETE, JOIN.</p>
            <span class="dashboard-demo-tag">MySQL</span>
        </a>
    </div>
</section>

<!-- Lessons by Subject -->
<section class="dashboard-section">
    <h2 class="dashboard-section-title">Lesson Library</h2>
    <p class="dashboard-section-desc"><?= $totalLessons ?> structured lessons across 7 subjects. Click any subject to explore.</p>
    <div class="dashboard-subjects">
        <?php
        $subjects = [
            ['icon' => '&#128161;', 'name' => 'Prog. Logic', 'dir' => 'programming-logic', 'prefix' => '/logic', 'count' => $counts['prog'], 'color' => 'var(--accent-yellow)'],
            ['icon' => '&#128421;', 'name' => 'PHP', 'dir' => 'lessons', 'prefix' => '/lesson', 'count' => $counts['php'], 'color' => 'var(--accent)'],
            ['icon' => '&#128013;', 'name' => 'Python', 'dir' => 'python-lessons', 'prefix' => '/python', 'count' => $counts['python'], 'color' => 'var(--accent-green)'],
            ['icon' => '&#9749;', 'name' => 'Java', 'dir' => 'java-lessons', 'prefix' => '/java', 'count' => $counts['java'], 'color' => 'var(--accent-peach)'],
            ['icon' => '&#128208;', 'name' => 'DSA', 'dir' => 'dsa-lessons', 'prefix' => '/dsa', 'count' => $counts['dsa'], 'color' => 'var(--accent-mauve)'],
            ['icon' => '&#128202;', 'name' => 'DBMS Theory', 'dir' => 'dbms-lessons', 'prefix' => '/dbms', 'count' => $counts['dbms'], 'color' => 'var(--accent-blue)'],
            ['icon' => '&#128451;', 'name' => 'MySQL', 'dir' => 'mysql-lessons', 'prefix' => '/mysql', 'count' => $counts['mysql'], 'color' => 'var(--accent-teal)'],
        ];
        foreach ($subjects as $subj):
            $lessons = getLessons($subj['dir']);
        ?>
        <div class="dashboard-subject-card">
            <div class="dashboard-subject-header" style="border-left-color: <?= $subj['color'] ?>;">
                <span class="dashboard-subject-icon"><?= $subj['icon'] ?></span>
                <div>
                    <h3><?= $subj['name'] ?></h3>
                    <span class="dashboard-subject-count"><?= $subj['count'] ?> lessons</span>
                </div>
            </div>
            <ul class="dashboard-subject-list">
                <?php foreach ($lessons as $lesson): ?>
                    <li><a href="<?= lessonUrl($lesson['num'], $lesson['slug'], $subj['dir']) ?>"><?= htmlspecialchars($lesson['title']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Footer note -->
<div class="dashboard-footer">
    <p>Created by <strong>Mr. Lloyd Christopher F. Dacles, MIS</strong> &mdash; LD TechLab Programming Tutorials</p>
    <p>All lessons and demos run offline. No internet required.</p>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
