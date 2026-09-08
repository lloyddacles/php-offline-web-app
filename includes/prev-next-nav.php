<?php
/**
 * Previous / Next Navigation partial
 * Expects: $prevNext = getPrevNextLesson($num, $sectionDir), $sectionDir, $num
 */

$lessonId = $sectionDir . '/' . $num;
require_once __DIR__ . '/quizzes.php';
$quiz = getQuizData($sectionDir, $num);
?>

<?php if ($quiz): ?>
<div class="quiz-section" id="quizSection" data-lesson-id="<?= htmlspecialchars($lessonId) ?>">
    <h2><?= htmlspecialchars($quiz['title']) ?></h2>
    <div class="quiz-container">
        <?php foreach ($quiz['questions'] as $qIdx => $question): ?>
        <div class="quiz-question" data-question-index="<?= $qIdx ?>" data-correct="<?= $question['answer'] ?>">
            <p class="quiz-question-text"><strong><?= ($qIdx + 1) . '. ' ?></strong><?= htmlspecialchars($question['question']) ?></p>
            <div class="quiz-options">
                <?php foreach ($question['options'] as $oIdx => $option): ?>
                <label class="quiz-option">
                    <input type="radio" name="q<?= $qIdx ?>" value="<?= $oIdx ?>">
                    <span><?= htmlspecialchars($option) ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <button class="quiz-submit-btn" id="quizSubmitBtn">Submit Quiz</button>
        <div class="quiz-result" id="quizResult" style="display:none;"></div>
    </div>
</div>
<?php endif; ?>

<div class="lesson-complete-section">
    <button id="markCompleteBtn" class="mark-complete-btn" data-lesson-id="<?= htmlspecialchars($lessonId) ?>">
        Mark as Complete
    </button>
</div>

<?php if (!empty($prevNext['prev']) || !empty($prevNext['next'])): ?>
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
