<?php
require_once __DIR__ . '/init.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: /demo/login');
    exit;
}

$db = getDB();
$studentId = $_SESSION['student_id'];

// Get all enrollments with grades
$stmt = $db->prepare('
    SELECT c.code, c.name, c.credits, e.grade, e.semester, e.status
    FROM enrollments e
    JOIN courses c ON e.course_id = c.id
    WHERE e.student_id = :id
    ORDER BY e.semester DESC, c.code ASC
');
$stmt->bindValue(':id', $studentId, SQLITE3_INTEGER);
$enrollments = [];
$result = $stmt->execute();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $enrollments[] = $row;
}

// Calculate GPA
function gradeToPoints($grade) {
    if ($grade >= 95) return 4.0;
    if ($grade >= 90) return 3.5;
    if ($grade >= 85) return 3.0;
    if ($grade >= 80) return 2.5;
    if ($grade >= 75) return 2.0;
    if ($grade >= 70) return 1.5;
    if ($grade >= 60) return 1.0;
    return 0.0;
}

function gradeToLetter($grade) {
    if ($grade >= 95) return 'A';
    if ($grade >= 90) return 'B+';
    if ($grade >= 85) return 'B';
    if ($grade >= 80) return 'C+';
    if ($grade >= 75) return 'C';
    if ($grade >= 70) return 'D';
    return 'F';
}

function gradeClass($grade) {
    if ($grade >= 90) return 'grade-a';
    if ($grade >= 80) return 'grade-b';
    if ($grade >= 70) return 'grade-c';
    return 'grade-f';
}

$totalPoints = 0;
$totalCredits = 0;
$completedCourses = [];

foreach ($enrollments as $e) {
    if ($e['status'] === 'completed' && $e['grade'] !== null) {
        $points = gradeToPoints($e['grade']);
        $totalPoints += $points * $e['credits'];
        $totalCredits += $e['credits'];
        $completedCourses[] = $e;
    }
}

$gpa = $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0;

// Group by semester
$semesters = [];
foreach ($enrollments as $e) {
    $semesters[$e['semester']][] = $e;
}

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Grades - Student Portal</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/demo/demo.css">
</head>
<body>
    <div class="demo-layout">
        <?php include __DIR__ . '/includes/sidebar.php'; ?>

        <main class="demo-content">
            <div class="demo-page-header">
                <h1>My Grades</h1>
                <p>View your academic performance and GPA.</p>
            </div>

            <!-- GPA Summary -->
            <div class="stat-grid" style="grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));">
                <div class="gpa-card">
                    <div class="gpa-value"><?= number_format($gpa, 2) ?></div>
                    <div class="gpa-label">General GPA</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= $totalCredits ?></div>
                    <div class="stat-label">Total Credits</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value"><?= count($completedCourses) ?></div>
                    <div class="stat-label">Courses Completed</div>
                </div>
            </div>

            <!-- Grades by Semester -->
            <?php foreach ($semesters as $semester => $courses): ?>
            <div class="demo-table-wrap">
                <div class="demo-table-header">
                    <h2><?= htmlspecialchars($semester) ?></h2>
                </div>
                <table class="demo-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Credits</th>
                            <th>Grade</th>
                            <th>Letter</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $c): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($c['code']) ?></strong></td>
                            <td><?= htmlspecialchars($c['name']) ?></td>
                            <td><?= $c['credits'] ?></td>
                            <td>
                                <?php if ($c['grade'] !== null): ?>
                                    <span class="grade-display <?= gradeClass($c['grade']) ?>"><?= $c['grade'] ?></span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">&mdash;</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($c['grade'] !== null): ?>
                                    <span class="badge badge-blue"><?= gradeToLetter($c['grade']) ?></span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">&mdash;</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($c['grade'] !== null): ?>
                                    <?= number_format(gradeToPoints($c['grade']), 1) ?>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">&mdash;</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>

            <!-- Grading Scale -->
            <div class="demo-table-wrap">
                <div class="demo-table-header">
                    <h2>Grading Scale</h2>
                </div>
                <table class="demo-table">
                    <thead>
                        <tr>
                            <th>Range</th>
                            <th>Letter</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>95 - 100</td><td><span class="badge badge-green">A</span></td><td>4.0</td></tr>
                        <tr><td>90 - 94</td><td><span class="badge badge-green">B+</span></td><td>3.5</td></tr>
                        <tr><td>85 - 89</td><td><span class="badge badge-blue">B</span></td><td>3.0</td></tr>
                        <tr><td>80 - 84</td><td><span class="badge badge-blue">C+</span></td><td>2.5</td></tr>
                        <tr><td>75 - 79</td><td><span class="badge badge-yellow">C</span></td><td>2.0</td></tr>
                        <tr><td>70 - 74</td><td><span class="badge badge-yellow">D</span></td><td>1.5</td></tr>
                        <tr><td>60 - 69</td><td><span class="badge badge-red">D</span></td><td>1.0</td></tr>
                        <tr><td>Below 60</td><td><span class="badge badge-red">F</span></td><td>0.0</td></tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
