<?php
$pageTitle = 'All Programming Logic Lessons';
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons('programming-logic');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>Programming Logic Lessons</h1>
    <p class="lesson-desc">Learn how to think like a programmer — master the logic, patterns, and problem-solving skills behind every great coder.</p>
</div>

<div class="section-progress" data-section="programming-logic" data-total="12">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 12</span>
</div>

<div class="info-box note">
    <div class="box-title">About These Lessons</div>
    <p class="mb-0">These lessons focus on the <strong>thinking process</strong> behind programming. You'll learn how to break down problems, design solutions, and develop the computational mindset that separates beginners from real programmers. No prior coding experience required — just logical thinking!</p>
</div>

<?php if (empty($lessons)): ?>
    <div class="info-box note">
        <div class="box-title">No Lessons Found</div>
        <p class="mb-0">Make sure the <code>programming-logic/</code> folder contains lesson files.</p>
    </div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'programming-logic') ?>" class="card" style="text-decoration:none; color:inherit;">
                <span class="lesson-num"><?= $lesson['num'] ?></span>
                <h3><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
