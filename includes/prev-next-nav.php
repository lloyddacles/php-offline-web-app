<?php
/**
 * Previous / Next Navigation partial
 * Expects: $prevNext = getPrevNextLesson($num, $sectionDir)
 */

if (!empty($prevNext['prev']) || !empty($prevNext['next'])): ?>
<div class="lesson-nav">
    <?php if (!empty($prevNext['prev'])): ?>
        <a href="<?= lessonUrl($prevNext['prev']['num'], $prevNext['prev']['slug'], $prevNext['prev']['dir']) ?>">
            <span class="nav-label">&larr; Previous</span>
            <span class="nav-title"><?= htmlspecialchars($prevNext['prev']['title']) ?></span>
        </a>
    <?php else: ?>
        <span></span>
    <?php endif; ?>
    <?php if (!empty($prevNext['next'])): ?>
        <a href="<?= lessonUrl($prevNext['next']['num'], $prevNext['next']['slug'], $prevNext['next']['dir']) ?>" class="next">
            <span class="nav-label">Next &rarr;</span>
            <span class="nav-title"><?= htmlspecialchars($prevNext['next']['title']) ?></span>
        </a>
    <?php endif; ?>
</div>
<?php endif; ?>
