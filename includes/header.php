<?php require_once __DIR__ . '/functions.php';

// Determine current section and active state
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$currentDir = $currentSection = '';
$currentNum = 0;

if (preg_match('#^/lesson/#', $requestUri)) { $currentDir = 'lessons'; $currentSection = 'PHP'; }
elseif (preg_match('#^/mysql/#', $requestUri)) { $currentDir = 'mysql-lessons'; $currentSection = 'MySQL'; }
elseif (preg_match('#^/dbms/#', $requestUri)) { $currentDir = 'dbms-lessons'; $currentSection = 'DBMS'; }
elseif (preg_match('#^/dsa/#', $requestUri)) { $currentDir = 'dsa-lessons'; $currentSection = 'DSA'; }
elseif (preg_match('#^/logic/#', $requestUri)) { $currentDir = 'programming-logic'; $currentSection = 'Logic'; }
elseif (preg_match('#^/python/#', $requestUri)) { $currentDir = 'python-lessons'; $currentSection = 'Python'; }
elseif (preg_match('#^/java/#', $requestUri)) { $currentDir = 'java-lessons'; $currentSection = 'Java'; }

// Get current lesson number if on a lesson page
if ($currentDir && preg_match('#/(\d+)-#', $requestUri, $m)) {
    $currentNum = (int)$m[1];
}

// All sections for sidebar
$sections = [
    ['id' => 'logic', 'title' => 'Programming Logic', 'dir' => 'programming-logic', 'prefix' => '/logic'],
    ['id' => 'php',   'title' => 'PHP',               'dir' => 'lessons',             'prefix' => '/lesson'],
    ['id' => 'python','title' => 'Python',             'dir' => 'python-lessons',      'prefix' => '/python'],
    ['id' => 'java',  'title' => 'Java',               'dir' => 'java-lessons',        'prefix' => '/java'],
    ['id' => 'dsa',   'title' => 'DSA',                'dir' => 'dsa-lessons',         'prefix' => '/dsa'],
    ['id' => 'dbms',  'title' => 'DBMS Theory',        'dir' => 'dbms-lessons',        'prefix' => '/dbms'],
    ['id' => 'mysql', 'title' => 'MySQL',              'dir' => 'mysql-lessons',       'prefix' => '/mysql'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'LD TechLab', ENT_QUOTES, 'UTF-8') ?> - LD TechLab</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar (Ctrl+B)">
                <svg viewBox="0 0 20 20" fill="currentColor"><path d="M3 5h14a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2zm0 4h14a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2zm0 4h14a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2z"/></svg>
            </button>
            <a href="/" class="topbar-brand">LD <span>TechLab</span></a>
        </div>
        <div class="topbar-center">
            <span class="topbar-hint"><kbd>Ctrl</kbd>+<kbd>B</kbd> sidebar</span>
        </div>
        <div class="topbar-right">
            <a href="/status" class="topbar-link">Status</a>
        </div>
    </header>

    <!-- Sidebar overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <a href="/" class="sidebar-home <?= $requestUri === '/' ? 'active' : '' ?>">Home</a>

        <?php foreach ($sections as $sec): ?>
            <?php
                $secLessons = getLessons($sec['dir']);
                $isActiveSection = ($currentDir === $sec['dir']);
                $collapsed = !$isActiveSection;
            ?>
            <div class="sidebar-section <?= $collapsed ? 'collapsed' : '' ?>">
                <div class="sidebar-section-header" data-section="<?= $sec['id'] ?>">
                    <span class="sidebar-section-title"><?= $sec['title'] ?></span>
                    <span class="sidebar-section-chevron">&#9662;</span>
                </div>
                <ul class="sidebar-section-items">
                    <?php foreach ($secLessons as $lesson): ?>
                        <?php
                            $url = lessonUrl($lesson['num'], $lesson['slug'], $sec['dir']);
                            $isActive = ($isActiveSection && $currentNum === $lesson['num']);
                        ?>
                        <li>
                            <a href="<?= $url ?>" class="<?= $isActive ? 'active' : '' ?>">
                                <span class="lesson-num"><?= str_pad($lesson['num'], 2, '0', STR_PAD_LEFT) ?></span>
                                <?= htmlspecialchars($lesson['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </nav>

    <!-- Main layout -->
    <div class="layout">
        <div class="layout-content">
            <div class="content-wrapper">
                <?php if ($currentSection): ?>
                <nav class="breadcrumbs">
                    <a href="/">Home</a>
                    <span class="sep">/</span>
                    <a href="<?= $sections[array_search($currentSection, array_column($sections, 'title'))]['prefix'] ?>"><?= htmlspecialchars($currentSection) ?></a>
                    <?php if ($currentNum): ?>
                        <span class="sep">/</span>
                        <span class="current">Lesson <?= $currentNum ?></span>
                    <?php endif; ?>
                </nav>
                <?php endif; ?>
