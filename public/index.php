<?php
require_once __DIR__ . '/../includes/functions.php';
$lessons = getLessons();
$pageTitle = 'Home';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="lesson-header">
    <h1>LD TechLab Programming Tutorials</h1>
    <p class="lesson-desc">Interactive programming lessons with live code execution. Learn by doing — edit and run code directly in your browser.</p>
    <div style="margin-top: 16px;">
        <a href="/demo" class="btn btn-primary" style="font-size: 1em;">&#128640; Try Live Demo: Student Portal</a>
    </div>
</div>

<div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap:10px; margin: 32px 0;">
    <?php
    $quickLinks = [
        ['title' => '&#128161; Programming Logic', 'url' => lessonUrl(1, 'what-is-programming-logic', 'programming-logic')],
        ['title' => '&#128421; PHP', 'url' => lessonUrl(1, 'introduction', 'lessons')],
        ['title' => '&#128013; Python', 'url' => lessonUrl(1, 'introduction', 'python-lessons')],
        ['title' => '&#9749; Java', 'url' => lessonUrl(1, 'introduction', 'java-lessons')],
        ['title' => '&#128208; DSA', 'url' => lessonUrl(1, 'introduction', 'dsa-lessons')],
        ['title' => '&#128202; DBMS Theory', 'url' => lessonUrl(1, 'introduction', 'dbms-lessons')],
        ['title' => '&#128451; MySQL', 'url' => lessonUrl(1, 'introduction', 'mysql-lessons')],
    ];
    foreach ($quickLinks as $i => $link): ?>
        <a href="<?= $link['url'] ?>" class="btn <?= $i === 1 ? 'btn-primary' : 'btn-outline' ?>" style="justify-content:center;"><?= $link['title'] ?></a>
    <?php endforeach; ?>
</div>

<hr>

<!-- Programming Logic -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#128161; Programming Logic</h2>
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

<!-- PHP -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#128421; PHP</h2>
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

<hr>

<!-- Python -->
<section style="margin-top:32px;">
    <div class="section-title">
        <h2>&#128013; Python</h2>
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
        <h2>&#9749; Java</h2>
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
        <h2>&#128208; Data Structures &amp; Algorithms</h2>
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
        <h2>&#128202; DBMS Theory</h2>
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

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
