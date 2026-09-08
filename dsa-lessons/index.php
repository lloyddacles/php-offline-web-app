<?php
$pageTitle = 'Data Structures & Algorithms';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/header.php';
$lessons = getLessons('dsa-lessons');
?>

<div class="lesson-header">
    <h1>Data Structures & Algorithms</h1>
    <p class="lesson-desc">Master fundamental DSA with hands-on PHP implementations. 18 lessons from basics to a complete course project.</p>
</div>

<div class="section-progress" data-section="dsa-lessons" data-total="18">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 18</span>
</div>

<div class="lessons-grid">
    <?php foreach ($lessons as $lesson): ?>
        <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'dsa-lessons') ?>" class="lesson-card">
            <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
            <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
        </a>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
