<?php
$pageTitle = 'All DBMS Lessons';
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons('dbms-lessons');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>Database Management System Lessons</h1>
    <p class="lesson-desc">Learn database theory, design, and management concepts from scratch.</p>
</div>

<div class="section-progress" data-section="dbms-lessons" data-total="10">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 10</span>
</div>

<div class="info-box note">
    <div class="box-title">About These Lessons</div>
    <p class="mb-0">These lessons cover the theoretical foundations of database management systems, including ER diagrams, normalization, transactions, and security. Pair these with the MySQL Lessons for hands-on SQL practice.</p>
</div>

<?php if (empty($lessons)): ?>
    <div class="info-box note">
        <div class="box-title">No Lessons Found</div>
        <p class="mb-0">Make sure the <code>dbms-lessons/</code> folder contains lesson files.</p>
    </div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'dbms-lessons') ?>" class="card" style="text-decoration:none; color:inherit;">
                <span class="lesson-num"><?= $lesson['num'] ?></span>
                <h3><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
