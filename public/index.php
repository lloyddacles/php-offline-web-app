<?php
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons();
$pageTitle = 'Home';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>LD TechLab Programming Tutorials</h1>
    <p class="lesson-desc">Interactive programming lessons with live code execution. Learn by doing — edit and run code directly in your browser.</p>
</div>

<div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap:10px; margin: 32px 0;">
    <?php
    $quickLinks = [
        ['title' => '&#9881; Programming Logic', 'url' => lessonUrl(1, 'what-is-programming-logic', 'programming-logic')],
        ['title' => '&#9651; Python', 'url' => lessonUrl(1, 'introduction', 'python-lessons')],
        ['title' => '&#9752; Java', 'url' => lessonUrl(1, 'introduction', 'java-lessons')],
        ['title' => '&#9830; DSA', 'url' => lessonUrl(1, 'introduction-to-data-structures-algorithms', 'dsa-lessons')],
        ['title' => '&#9901; DBMS Theory', 'url' => lessonUrl(1, 'introduction-to-dbms', 'dbms-lessons')],
        ['title' => '&#128451; MySQL', 'url' => lessonUrl(1, 'introduction-to-mysql', 'mysql-lessons')],
        ['title' => '&#60;? PHP', 'url' => lessonUrl(1, 'introduction', 'lessons')],
    ];
    foreach ($quickLinks as $i => $link): ?>
        <a href="<?= $link['url'] ?>" class="btn <?= $i === 6 ? 'btn-primary' : 'btn-outline' ?>" style="justify-content:center;"><?= $link['title'] ?></a>
    <?php endforeach; ?>
</div>

<hr>

<!-- Programming Logic -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#9881; Programming Logic</h2>
        <p>Learn how to think like a programmer — logic, patterns, and problem-solving</p>
    </div>
    <div class="lessons-grid">
        <?php foreach (getLessons('programming-logic') as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'programming-logic') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<hr>

<!-- Python -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#9651; Python</h2>
        <p>Interactive Python lessons with live code execution</p>
    </div>
    <div class="lessons-grid">
        <?php foreach (getLessons('python-lessons') as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'python-lessons') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<hr>

<!-- Java -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#9752; Java</h2>
        <p>Interactive Java lessons with compile-and-run sandbox</p>
    </div>
    <div class="lessons-grid">
        <?php foreach (getLessons('java-lessons') as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'java-lessons') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<hr>

<!-- DSA -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#9830; Data Structures &amp; Algorithms</h2>
        <p>Master fundamental DSA with hands-on PHP implementations</p>
    </div>
    <div class="lessons-grid">
        <?php foreach (getLessons('dsa-lessons') as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'dsa-lessons') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<hr>

<!-- DBMS -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#9901; DBMS Theory</h2>
        <p>Database design, normalization, ER diagrams, and security</p>
    </div>
    <div class="lessons-grid">
        <?php foreach (getLessons('dbms-lessons') as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'dbms-lessons') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<hr>

<!-- MySQL -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#128451; MySQL</h2>
        <p>SQL from basics to PHP integration</p>
    </div>
    <div class="lessons-grid">
        <?php foreach (getLessons('mysql-lessons') as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'mysql-lessons') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<hr>

<!-- PHP -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#60;? PHP</h2>
        <p>Interactive PHP lessons with live code execution</p>
    </div>
    <div class="lessons-grid">
        <?php foreach ($lessons as $lesson): ?>
            <a href="<?= lessonUrl($lesson['num'], $lesson['slug'], 'lessons') ?>" class="lesson-card">
                <span class="lesson-card-number"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="lesson-card-title"><?= htmlspecialchars($lesson['title']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
