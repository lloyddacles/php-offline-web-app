<?php
require_once __DIR__ . '/init.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: /demo/login');
    exit;
}

$db = getDB();
$studentId = $_SESSION['student_id'];

// Get all courses with enrollment status
$stmt = $db->prepare('
    SELECT c.*, e.grade, e.status as enroll_status, e.semester
    FROM courses c
    LEFT JOIN enrollments e ON e.course_id = c.id AND e.student_id = :id
    ORDER BY c.code ASC
');
$stmt->bindValue(':id', $studentId, SQLITE3_INTEGER);
$courses = [];
$result = $stmt->execute();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $courses[] = $row;
}

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Student Portal</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/demo/demo.css">
    <style>
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 16px;
        }
        .course-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: border-color 0.15s ease;
        }
        .course-card:hover {
            border-color: var(--border-light);
        }
        .course-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .course-card h3 {
            font-size: 1.1em;
            margin: 0;
            color: var(--text-bright);
        }
        .course-card .course-code {
            font-family: 'SF Mono', monospace;
            font-size: 0.85em;
            color: var(--accent);
            font-weight: 600;
        }
        .course-card .course-meta {
            font-size: 0.88em;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }
        .course-card .course-meta span {
            display: block;
            margin-bottom: 4px;
        }
        .course-card-footer {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="demo-layout">
        <?php include __DIR__ . '/includes/sidebar.php'; ?>

        <main class="demo-content">
            <div class="demo-page-header">
                <h1>Course Catalog</h1>
                <p>Browse all available courses and your enrollment status.</p>
            </div>

            <div class="course-grid">
                <?php foreach ($courses as $c): ?>
                <div class="course-card">
                    <div class="course-card-header">
                        <div>
                            <div class="course-code"><?= htmlspecialchars($c['code']) ?></div>
                            <h3><?= htmlspecialchars($c['name']) ?></h3>
                        </div>
                        <?php if ($c['enroll_status'] === 'enrolled'): ?>
                            <span class="badge badge-blue">Enrolled</span>
                        <?php elseif ($c['enroll_status'] === 'completed'): ?>
                            <span class="badge badge-green">Completed</span>
                        <?php else: ?>
                            <span class="badge badge-yellow">Available</span>
                        <?php endif; ?>
                    </div>
                    <div class="course-meta">
                        <span>&#128100; <?= htmlspecialchars($c['instructor']) ?></span>
                        <span>&#128197; <?= htmlspecialchars($c['schedule']) ?></span>
                        <span>&#128218; <?= $c['credits'] ?> Credits</span>
                    </div>
                    <?php if ($c['enroll_status'] && $c['grade'] !== null): ?>
                    <div class="course-card-footer">
                        <span style="font-size:0.85em; color:var(--text-muted);">Final Grade</span>
                        <span class="grade-display <?= $c['grade'] >= 90 ? 'grade-a' : ($c['grade'] >= 80 ? 'grade-b' : ($c['grade'] >= 70 ? 'grade-c' : 'grade-f')) ?>"><?= $c['grade'] ?></span>
                    </div>
                    <?php elseif ($c['enroll_status'] === 'enrolled'): ?>
                    <div class="course-card-footer">
                        <span style="font-size:0.85em; color:var(--text-muted);">Currently taking</span>
                        <span class="badge badge-blue">In Progress</span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
</html>
