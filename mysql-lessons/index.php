<?php
$pageTitle = 'All MySQL Lessons';
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons('mysql-lessons');
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>MySQL Lessons</h1>
    <p class="lesson-desc">Learn MySQL from scratch. Follow these lessons in order.</p>
</div>

<div class="section-progress" data-section="mysql-lessons" data-total="10">
    <span>Progress:</span>
    <div class="progress-bar-container">
        <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-text">0 / 10</span>
</div>

<div class="info-box note">
    <div class="box-title">Prerequisites</div>
    <p class="mb-0">You need MySQL installed on your computer. You can use MySQL Workbench, the command line, or any SQL client to run the examples.</p>
</div>

<?php if (empty($lessons)): ?>
    <div class="info-box note">
        <div class="box-title">No Lessons Found</div>
        <p class="mb-0">Make sure the <code>mysql-lessons/</code> folder contains lesson files.</p>
    </div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'mysql-lessons') ?>" class="card" style="text-decoration:none; color:inherit;">
                <span class="lesson-num"><?= $lesson['num'] ?></span>
                <h3><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
