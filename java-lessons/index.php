<?php
$pageTitle = 'All Java Lessons';
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons('java-lessons');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>Java Programming Lessons</h1>
    <p class="lesson-desc">Learn Java from scratch with interactive, hands-on code examples. Run code directly in your browser!</p>
</div>

<div class="section-progress" data-section="java-lessons" data-total="12">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 12</span>
</div>

<div class="info-box note">
    <div class="box-title">About These Lessons</div>
    <p class="mb-0">These lessons cover Java fundamentals through interactive examples. Each lesson includes a live sandbox where you can edit and run Java code directly in your browser. Java JDK must be installed on the server for code execution.</p>
</div>

<?php if (empty($lessons)): ?>
    <div class="info-box note">
        <div class="box-title">No Lessons Found</div>
        <p class="mb-0">Make sure the <code>java-lessons/</code> folder contains lesson files.</p>
    </div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'java-lessons') ?>" class="card" style="text-decoration:none; color:inherit;">
                <span class="lesson-num"><?= $lesson['num'] ?></span>
                <h3><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
