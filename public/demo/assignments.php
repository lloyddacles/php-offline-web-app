<?php
require_once __DIR__ . '/init.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: /demo/login');
    exit;
}

$db = getDB();
$studentId = $_SESSION['student_id'];

// Handle submission
$submitMsg = '';
$submitType = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assignment_id'])) {
    $assignmentId = (int)$_POST['assignment_id'];
    $content = trim($_POST['content'] ?? '');

    if (strlen($content) < 10) {
        $submitMsg = 'Please provide a more detailed submission (at least 10 characters).';
        $submitType = 'error';
    } else {
        $stmt = $db->prepare('INSERT INTO submissions (assignment_id, student_id, content, submitted_at) VALUES (:aid, :sid, :content, :time)');
        $stmt->bindValue(':aid', $assignmentId, SQLITE3_INTEGER);
        $stmt->bindValue(':sid', $studentId, SQLITE3_INTEGER);
        $stmt->bindValue(':content', $content, SQLITE3_TEXT);
        $stmt->bindValue(':time', date('Y-m-d H:i:s'), SQLITE3_TEXT);
        $stmt->execute();
        $submitMsg = 'Assignment submitted successfully!';
        $submitType = 'success';
    }
}

// Get assignments for enrolled courses
$stmt = $db->prepare('
    SELECT a.*, c.code as course_code, c.name as course_name,
           s.id as sub_id, s.score, s.submitted_at, s.content as sub_content
    FROM assignments a
    JOIN courses c ON a.course_id = c.id
    JOIN enrollments e ON e.course_id = a.course_id AND e.student_id = :id
    LEFT JOIN submissions s ON s.assignment_id = a.id AND s.student_id = :id2
    ORDER BY a.due_date ASC
');
$stmt->bindValue(':id', $studentId, SQLITE3_INTEGER);
$stmt->bindValue(':id2', $studentId, SQLITE3_INTEGER);
$assignments = [];
$result = $stmt->execute();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $assignments[] = $row;
}

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments - Student Portal</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/demo/demo.css">
    <style>
        .assignment-detail {
            padding: 16px;
            background: var(--bg-primary);
            border-radius: var(--radius);
            margin-top: 12px;
            font-size: 0.9em;
            color: var(--text-secondary);
            line-height: 1.6;
        }
        .submit-form {
            margin-top: 12px;
            padding: 16px;
            background: var(--bg-primary);
            border-radius: var(--radius);
        }
        .submit-form textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text-primary);
            font-family: inherit;
            font-size: 0.9em;
            resize: vertical;
            margin-bottom: 10px;
        }
        .submit-form textarea:focus {
            outline: none;
            border-color: var(--accent);
        }
        .submit-msg {
            padding: 10px 14px;
            border-radius: var(--radius);
            font-size: 0.9em;
            margin-bottom: 12px;
        }
        .submit-msg.success {
            background: rgba(166, 227, 161, 0.1);
            border: 1px solid var(--accent-green);
            color: var(--accent-green);
        }
        .submit-msg.error {
            background: rgba(243, 139, 168, 0.1);
            border: 1px solid var(--accent-red);
            color: var(--accent-red);
        }
        .score-display {
            font-size: 1.2em;
            font-weight: 700;
        }
        .submitted-content {
            margin-top: 12px;
            padding: 12px;
            background: var(--bg-primary);
            border-radius: var(--radius);
            font-size: 0.9em;
            color: var(--text-secondary);
            line-height: 1.6;
            border-left: 3px solid var(--accent-green);
        }
    </style>
</head>
<body>
    <div class="demo-layout">
        <?php include __DIR__ . '/includes/sidebar.php'; ?>

        <main class="demo-content">
            <div class="demo-page-header">
                <h1>Assignments</h1>
                <p>View and submit your course assignments.</p>
            </div>

            <?php if ($submitMsg): ?>
                <div class="submit-msg <?= $submitType ?>"><?= htmlspecialchars($submitMsg) ?></div>
            <?php endif; ?>

            <?php if (empty($assignments)): ?>
                <div class="empty-state">
                    <div class="empty-icon">&#128221;</div>
                    <p>No assignments available for your enrolled courses.</p>
                </div>
            <?php else: ?>
                <?php foreach ($assignments as $a): ?>
                <div class="assignment-card">
                    <div class="course-tag"><?= htmlspecialchars($a['course_code']) ?> &mdash; <?= htmlspecialchars($a['course_name']) ?></div>
                    <h3><?= htmlspecialchars($a['title']) ?></h3>
                    <p><?= htmlspecialchars($a['description']) ?></p>

                    <div class="assignment-meta">
                        <span>&#128197; Due: <?= date('M d, Y', strtotime($a['due_date'])) ?></span>
                        <span>&#127941; Max Score: <?= $a['max_score'] ?></span>
                        <?php
                        $daysLeft = (strtotime($a['due_date']) - time()) / 86400;
                        if ($a['sub_id']): ?>
                            <span style="color: var(--accent-green);">&#9989; Submitted</span>
                        <?php elseif ($daysLeft < 0): ?>
                            <span style="color: var(--accent-red);">&#9888; Overdue</span>
                        <?php elseif ($daysLeft < 3): ?>
                            <span style="color: var(--accent-yellow);">&#9200; <?= ceil($daysLeft) ?> day(s) left</span>
                        <?php else: ?>
                            <span>&#9200; <?= ceil($daysLeft) ?> days left</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($a['sub_id']): ?>
                        <!-- Already submitted -->
                        <div class="submitted-content">
                            <strong>Your Submission:</strong><br>
                            <?= nl2br(htmlspecialchars($a['sub_content'])) ?>
                        </div>
                        <div style="margin-top: 12px; display: flex; align-items: center; gap: 12px;">
                            <span style="font-size: 0.85em; color: var(--text-muted);">Score:</span>
                            <?php if ($a['score'] !== null): ?>
                                <span class="score-display <?= $a['score'] >= 90 ? 'grade-a' : ($a['score'] >= 80 ? 'grade-b' : ($a['score'] >= 70 ? 'grade-c' : 'grade-f')) ?>"><?= $a['score'] ?>/<?= $a['max_score'] ?></span>
                            <?php else: ?>
                                <span style="color: var(--text-muted);">Pending review...</span>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <!-- Submit form -->
                        <form method="POST" class="submit-form">
                            <input type="hidden" name="assignment_id" value="<?= $a['id'] ?>">
                            <label style="display:block; font-size:0.85em; color:var(--text-muted); margin-bottom:6px;">Your Answer:</label>
                            <textarea name="content" placeholder="Write your answer here..." required></textarea>
                            <button type="submit" class="btn btn-primary" style="font-size: 0.9em;">Submit Assignment</button>
                        </form>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
