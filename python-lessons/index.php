<?php
$pageTitle = 'All Python Lessons';
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons('python-lessons');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>Python Programming Lessons</h1>
    <p class="lesson-desc">Learn Python from scratch with interactive, hands-on code examples. Run code directly in your browser!</p>
</div>

<div class="section-progress" data-section="python-lessons" data-total="12">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 12</span>
</div>

<div class="info-box note">
    <div class="box-title">About These Lessons</div>
    <p class="mb-0">These lessons cover Python fundamentals through interactive examples. Each lesson includes a live sandbox where you can edit and run Python code directly in your browser. No installation required!</p>
</div>

<?php if (empty($lessons)): ?>
    <div class="info-box note">
        <div class="box-title">No Lessons Found</div>
        <p class="mb-0">Make sure the <code>python-lessons/</code> folder contains lesson files.</p>
    </div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'python-lessons') ?>" class="card" style="text-decoration:none; color:inherit;">
                <span class="lesson-num"><?= $lesson['num'] ?></span>
                <h3><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
