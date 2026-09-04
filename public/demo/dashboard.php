<?php
require_once __DIR__ . '/init.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: /demo/login');
    exit;
}

$db = getDB();
$studentId = $_SESSION['student_id'];

// Get student info
$stmt = $db->prepare('SELECT * FROM students WHERE id = :id');
$stmt->bindValue(':id', $studentId, SQLITE3_INTEGER);
$student = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

// Get enrolled courses with grades
$stmt = $db->prepare('
    SELECT c.code, c.name, c.instructor, c.schedule, e.grade, e.status
    FROM enrollments e
    JOIN courses c ON e.course_id = c.id
    WHERE e.student_id = :id
    ORDER BY e.status ASC, c.code ASC
');
$stmt->bindValue(':id', $studentId, SQLITE3_INTEGER);
$enrollments = [];
$result = $stmt->execute();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $enrollments[] = $row;
}

// Count stats
$enrolledCount = 0;
$completedCount = 0;
$totalCredits = 0;
foreach ($enrollments as $e) {
    if ($e['status'] === 'enrolled') $enrolledCount++;
    if ($e['status'] === 'completed') $completedCount++;
}

// Get pending assignments
$stmt = $db->prepare('
    SELECT a.title, a.due_date, c.code as course_code, c.name as course_name
    FROM assignments a
    JOIN courses c ON a.course_id = c.id
    JOIN enrollments e ON e.course_id = a.course_id
    WHERE e.student_id = :id AND e.status = "enrolled"
    AND a.id NOT IN (SELECT assignment_id FROM submissions WHERE student_id = :id2)
    ORDER BY a.due_date ASC
    LIMIT 5
');
$stmt->bindValue(':id', $studentId, SQLITE3_INTEGER);
$stmt->bindValue(':id2', $studentId, SQLITE3_INTEGER);
$pendingAssignments = [];
$result = $stmt->execute();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $pendingAssignments[] = $row;
}

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Portal</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/demo/demo.css">
</head>
<body>
    <div class="demo-layout">
        <?php include __DIR__ . '/includes/sidebar.php'; ?>

        <main class="demo-content">
            <div class="demo-page-header">
                <h1>Welcome back, <?= htmlspecialchars(explode(' ', $student['name'])[0]) ?>!</h1>
                <p>Here's your academic overview for this semester.</p>
            </div>

            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: var(--accent-dim); color: var(--accent);">&#128218;</div>
                    <div class="stat-value"><?= $enrolledCount ?></div>
                    <div class="stat-label">Enrolled Courses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(166,227,161,0.15); color: var(--accent-green);">&#9989;</div>
                    <div class="stat-value"><?= $completedCount ?></div>
                    <div class="stat-label">Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(249,226,175,0.15); color: var(--accent-yellow);">&#128203;</div>
                    <div class="stat-value"><?= count($pendingAssignments) ?></div>
                    <div class="stat-label">Pending Tasks</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(195,124,250,0.15); color: var(--accent-mauve);">&#127942;</div>
                    <div class="stat-value"><?= $student['year_level'] ?><?= $student['year_level'] == 1 ? 'st' : ($student['year_level'] == 2 ? 'nd' : ($student['year_level'] == 3 ? 'rd' : 'th')) ?></div>
                    <div class="stat-label">Year Level</div>
                </div>
            </div>

            <!-- Current Courses -->
            <div class="demo-table-wrap">
                <div class="demo-table-header">
                    <h2>My Courses</h2>
                    <a href="/demo/courses" class="btn btn-outline" style="font-size:0.85em; padding:6px 14px;">View All</a>
                </div>
                <table class="demo-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Schedule</th>
                            <th>Instructor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enrollments)): ?>
                            <tr><td colspan="5" style="text-align:center; color:var(--text-muted); padding:24px;">No courses enrolled yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($enrollments as $e): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($e['code']) ?></strong></td>
                                <td><?= htmlspecialchars($e['name']) ?></td>
                                <td style="font-size:0.85em; color:var(--text-muted);"><?= htmlspecialchars($e['schedule']) ?></td>
                                <td><?= htmlspecialchars($e['instructor']) ?></td>
                                <td>
                                    <?php if ($e['status'] === 'enrolled'): ?>
                                        <span class="badge badge-blue">Enrolled</span>
                                    <?php else: ?>
                                        <span class="badge badge-green">Completed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pending Assignments -->
            <div class="demo-table-wrap">
                <div class="demo-table-header">
                    <h2>Pending Assignments</h2>
                    <a href="/demo/assignments" class="btn btn-outline" style="font-size:0.85em; padding:6px 14px;">View All</a>
                </div>
                <?php if (empty($pendingAssignments)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">&#10003;</div>
                        <p>All caught up! No pending assignments.</p>
                    </div>
                <?php else: ?>
                    <table class="demo-table">
                        <thead>
                            <tr>
                                <th>Assignment</th>
                                <th>Course</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendingAssignments as $a): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($a['title']) ?></strong></td>
                                <td><span class="badge badge-blue"><?= htmlspecialchars($a['course_code']) ?></span></td>
                                <td style="color: <?= strtotime($a['due_date']) < time() ? 'var(--accent-red)' : 'var(--text-muted)' ?>">
                                    <?= date('M d, Y', strtotime($a['due_date'])) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
    // Mobile sidebar toggle
    document.querySelector('.demo-sidebar-header')?.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.toggle('open');
        }
    });
    </script>
</body>
</html>
