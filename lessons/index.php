<?php
$pageTitle = 'All Lessons';
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons();
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>All Lessons</h1>
    <p class="lesson-desc">Follow these lessons in order for the best learning experience.</p>
</div>

<div class="section-progress" data-section="lessons" data-total="16">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 16</span>
</div>

<?php if (empty($lessons)): ?>
    <div class="info-box note">
        <div class="box-title">No Lessons Found</div>
        <p class="mb-0">Lesson files are being loaded. Make sure the <code>lessons/</code> folder contains lesson files.</p>
    </div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug']) ?>" class="card" style="text-decoration:none; color:inherit;">
                <span class="lesson-num"><?= $lesson['num'] ?></span>
                <h3><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
