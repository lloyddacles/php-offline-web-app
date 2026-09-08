/**
 * LD TechLab - Main JavaScript
 * Sidebar, TOC, syntax highlighting, sandbox execution
 */

document.addEventListener('DOMContentLoaded', function () {

    // === Theme Toggle ===
    var themeToggle = document.getElementById('themeToggle');
    var savedTheme = localStorage.getItem('ldtechlab-theme') || 'dark';

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('ldtechlab-theme', theme);
    }

    applyTheme(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var current = document.documentElement.getAttribute('data-theme');
            applyTheme(current === 'dark' ? 'light' : 'dark');
        });
    }

    // === Progress Tracking ===
    var PROGRESS_KEY = 'ldtechlab-progress';

    function getCompletedLessons() {
        try {
            return JSON.parse(localStorage.getItem(PROGRESS_KEY)) || [];
        } catch (e) {
            return [];
        }
    }

    function saveCompletedLessons(list) {
        localStorage.setItem(PROGRESS_KEY, JSON.stringify(list));
    }

    function isLessonCompleted(lessonId) {
        return getCompletedLessons().indexOf(lessonId) !== -1;
    }

    function toggleLessonComplete(lessonId) {
        var list = getCompletedLessons();
        var idx = list.indexOf(lessonId);
        if (idx === -1) {
            list.push(lessonId);
        } else {
            list.splice(idx, 1);
        }
        saveCompletedLessons(list);
        return idx === -1;
    }

    function getProgressBySection() {
        var sections = {
            'programming-logic': 12,
            'lessons': 16,
            'python-lessons': 12,
            'java-lessons': 12,
            'mysql-lessons': 10,
            'dbms-lessons': 10,
            'dsa-lessons': 18
        };
        var completed = getCompletedLessons();
        var result = {};
        for (var sec in sections) {
            var count = 0;
            for (var i = 1; i <= sections[sec]; i++) {
                if (completed.indexOf(sec + '/' + i) !== -1) count++;
            }
            result[sec] = { completed: count, total: sections[sec] };
        }
        return result;
    }

    // "Mark as Complete" button on lesson pages
    var completeBtn = document.getElementById('markCompleteBtn');
    if (completeBtn) {
        var lessonId = completeBtn.getAttribute('data-lesson-id');
        if (lessonId) {
            // Set initial state
            if (isLessonCompleted(lessonId)) {
                completeBtn.classList.add('completed');
                completeBtn.textContent = '✓ Completed';
            }

            completeBtn.addEventListener('click', function () {
                var nowComplete = toggleLessonComplete(lessonId);
                if (nowComplete) {
                    completeBtn.classList.add('completed');
                    completeBtn.textContent = '✓ Completed';
                } else {
                    completeBtn.classList.remove('completed');
                    completeBtn.textContent = 'Mark as Complete';
                }
            });
        }
    }

    // Update sidebar checkmarks
    document.querySelectorAll('[data-lesson-link]').forEach(function (link) {
        var lid = link.getAttribute('data-lesson-link');
        if (isLessonCompleted(lid)) {
            link.classList.add('completed-lesson');
        }
    });

    // Update section progress bars
    document.querySelectorAll('.section-progress').forEach(function (container) {
        var section = container.getAttribute('data-section');
        var total = parseInt(container.getAttribute('data-total')) || 0;
        var completed = getCompletedLessons();
        var count = 0;
        for (var i = 1; i <= total; i++) {
            if (completed.indexOf(section + '/' + i) !== -1) count++;
        }
        var pct = total > 0 ? Math.round((count / total) * 100) : 0;
        var bar = container.querySelector('.progress-bar');
        var text = container.querySelector('.progress-text');
        if (bar) bar.style.width = pct + '%';
        if (text) text.textContent = count + ' / ' + total;
    });

    // Update dashboard progress
    var dashboardProgress = document.getElementById('dashboardProgress');
    if (dashboardProgress) {
        var sections = {
            'programming-logic': 12,
            'lessons': 16,
            'python-lessons': 12,
            'java-lessons': 12,
            'mysql-lessons': 10,
            'dbms-lessons': 10,
            'dsa-lessons': 18
        };
        var completed = getCompletedLessons();
        var totalAll = 0;
        var completedAll = 0;

        for (var sec in sections) {
            var total = sections[sec];
            var count = 0;
            for (var i = 1; i <= total; i++) {
                if (completed.indexOf(sec + '/' + i) !== -1) count++;
            }
            totalAll += total;
            completedAll += count;

            var item = dashboardProgress.querySelector('[data-section="' + sec + '"]');
            if (item) {
                var textEl = item.querySelector('.progress-text');
                if (textEl) textEl.textContent = count + '/' + total;
            }
        }

        var pctAll = totalAll > 0 ? Math.round((completedAll / totalAll) * 100) : 0;
        var barAll = dashboardProgress.querySelector('.progress-bar');
        var textAll = dashboardProgress.querySelector('.progress-overall .progress-text');
        if (barAll) barAll.style.width = pctAll + '%';
        if (textAll) textAll.textContent = completedAll + ' / ' + totalAll + ' (' + pctAll + '%)';

        // Update quiz stats
        var quizResults = getQuizResults();
        var quizTaken = Object.keys(quizResults).length;
        var quizPerfect = 0;
        for (var lid in quizResults) {
            if (quizResults[lid].score === quizResults[lid].total) quizPerfect++;
        }
        var quizTakenEl = dashboardProgress.querySelector('.quiz-stat-taken');
        var quizPerfectEl = dashboardProgress.querySelector('.quiz-stat-perfect');
        if (quizTakenEl) quizTakenEl.textContent = quizTaken;
        if (quizPerfectEl) quizPerfectEl.textContent = quizPerfect;
    }

    // === Quiz System ===
    var QUIZ_KEY = 'ldtechlab-quizzes';

    function getQuizResults() {
        try {
            return JSON.parse(localStorage.getItem(QUIZ_KEY)) || {};
        } catch (e) {
            return {};
        }
    }

    function saveQuizResult(lessonId, score, total) {
        var results = getQuizResults();
        results[lessonId] = { score: score, total: total, date: new Date().toISOString() };
        localStorage.setItem(QUIZ_KEY, JSON.stringify(results));
    }

    function getQuizResult(lessonId) {
        var results = getQuizResults();
        return results[lessonId] || null;
    }

    // Quiz submission
    var quizSection = document.getElementById('quizSection');
    var quizSubmitBtn = document.getElementById('quizSubmitBtn');
    var quizResult = document.getElementById('quizResult');

    if (quizSection && quizSubmitBtn && quizResult) {
        var lessonId = quizSection.getAttribute('data-lesson-id');

        // Check if quiz was already taken
        var existingResult = getQuizResult(lessonId);
        if (existingResult) {
            quizResult.style.display = 'block';
            quizResult.className = 'quiz-result ' + (existingResult.score === existingResult.total ? 'quiz-pass' : 'quiz-fail');
            quizResult.innerHTML = '<strong>Previous Result:</strong> ' + existingResult.score + ' / ' + existingResult.total + ' (' + Math.round((existingResult.score / existingResult.total) * 100) + '%)';
        }

        quizSubmitBtn.addEventListener('click', function () {
            var questions = quizSection.querySelectorAll('.quiz-question');
            var score = 0;
            var total = questions.length;
            var allAnswered = true;

            questions.forEach(function (q, idx) {
                var selected = q.querySelector('input[name="q' + idx + '"]:checked');
                if (!selected) {
                    allAnswered = false;
                } else {
                    // Get correct answer from data attribute
                    var correctAnswer = q.getAttribute('data-correct');
                    if (selected.value === correctAnswer) {
                        score++;
                        q.classList.add('quiz-correct');
                    } else {
                        q.classList.add('quiz-wrong');
                    }
                }
            });

            if (!allAnswered) {
                quizResult.style.display = 'block';
                quizResult.className = 'quiz-result quiz-warning';
                quizResult.innerHTML = 'Please answer all questions before submitting.';
                return;
            }

            // Save result
            saveQuizResult(lessonId, score, total);

            // Show result
            var pct = Math.round((score / total) * 100);
            var passed = score === total;
            quizResult.style.display = 'block';
            quizResult.className = 'quiz-result ' + (passed ? 'quiz-pass' : 'quiz-fail');
            quizResult.innerHTML = '<strong>Quiz Complete!</strong> Score: ' + score + ' / ' + total + ' (' + pct + '%)' + (passed ? ' Perfect!' : ' Review the highlighted questions.');

            // Disable submit
            quizSubmitBtn.disabled = true;
            quizSubmitBtn.textContent = 'Quiz Submitted';
        });
    }

    // === Sidebar Toggle ===
    var sidebar = document.getElementById('sidebar');
    var sidebarToggle = document.getElementById('sidebarToggle');
    var sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            if (window.innerWidth <= 900) {
                sidebar.classList.toggle('open');
                sidebarOverlay.classList.toggle('visible');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('visible');
            });
        }
    }

    // Ctrl+B to toggle sidebar
    document.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
            e.preventDefault();
            if (sidebarToggle) sidebarToggle.click();
        }
    });

    // === Sidebar Section Collapse ===
    document.querySelectorAll('.sidebar-section-header').forEach(function (header) {
        header.addEventListener('click', function () {
            var section = header.closest('.sidebar-section');
            if (section) section.classList.toggle('collapsed');
        });
    });

    // === Auto-generate Table of Contents ===
    var toc = document.getElementById('toc');
    var contentWrapper = document.querySelector('.content-wrapper');

    if (toc && contentWrapper) {
        var headings = contentWrapper.querySelectorAll('h2, h3');
        if (headings.length > 0) {
            var tocList = document.createElement('ul');
            tocList.className = 'toc-list';

            var tocTitle = document.createElement('div');
            tocTitle.className = 'toc-title';
            tocTitle.textContent = 'On this page';
            toc.appendChild(tocTitle);

            headings.forEach(function (heading, i) {
                if (!heading.id) {
                    heading.id = 'heading-' + heading.textContent
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-|-$/g, '') + '-' + i;
                }

                var li = document.createElement('li');
                var a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;

                if (heading.tagName === 'H3') {
                    a.className = 'toc-h3';
                }

                li.appendChild(a);
                tocList.appendChild(li);
            });

            toc.appendChild(tocList);

            // Active TOC highlight on scroll
            var tocLinks = tocList.querySelectorAll('a');
            var ticking = false;

            function updateTocActive() {
                var currentId = '';
                headings.forEach(function (h) {
                    if (h.getBoundingClientRect().top <= 120) {
                        currentId = h.id;
                    }
                });

                tocLinks.forEach(function (link) {
                    if (link.getAttribute('href') === '#' + currentId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
                ticking = false;
            }

            window.addEventListener('scroll', function () {
                if (!ticking) {
                    window.requestAnimationFrame(updateTocActive);
                    ticking = true;
                }
            });

            updateTocActive();
        }
    }

    // === Syntax Highlighting (Simple & Robust) ===

    // Simple keyword lists
    var keywords = {
        php: ['echo','if','else','elseif','while','for','foreach','function','class','return','true','false','null','new','public','private','protected','static','array','extends','implements','interface','try','catch','throw','finally','switch','case','break','continue','default','include','require','include_once','require_once','use','namespace','as','abstract','final','const','var','global','isset','unset','empty','print','die','exit','list','match','fn','yield','enum','readonly','trait','instanceof','insteadof','callable','goto','declare','enddeclare','endfor','endforeach','endif','endswitch','endwhile','eval','yield_from','and','or','xor','NOT','TRUE','FALSE','NULL'],
        python: ['def','class','return','if','elif','else','for','while','import','from','as','try','except','finally','raise','with','yield','lambda','pass','break','continue','and','or','not','in','is','True','False','None','del','global','nonlocal','assert','async','await','print','len','range','int','float','str','list','dict','set','tuple','input','open','type','isinstance','enumerate','zip','map','filter','sorted','sum','min','max','abs','round','super','property','staticmethod','classmethod'],
        java: ['public','private','protected','static','void','int','double','float','boolean','char','String','class','interface','extends','implements','new','return','if','else','for','while','do','switch','case','break','continue','try','catch','finally','throw','throws','this','super','abstract','final','enum','instanceof','import','package','true','false','null','System','Scanner','Math','ArrayList','HashMap','Object','Integer','Double','Boolean','long','short','byte','native','synchronized','transient','volatile','strictfp','record','sealed','permits','yield','var','assert']
    };

    function escapeHtml(text) {
        return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    function highlightCode(code, lang) {
        // Remove comments
        if (lang === 'php' || lang === 'java') {
            code = code.replace(/\/\/[^\n]*/g, '');
            code = code.replace(/\/\*[\s\S]*?\*\//g, '');
        }
        if (lang === 'php') {
            code = code.replace(/#[^{][^\n]*/g, '');
        }
        if (lang === 'python') {
            code = code.replace(/#[^\n]*/g, '');
            code = code.replace(/"""[\s\S]*?"""/g, '');
        }

        // Escape HTML
        var html = escapeHtml(code);

        // Highlight strings first (replace with placeholders)
        var strings = [];
        html = html.replace(/("(?:[^"\\]|\\.)*"|'(?:[^'\\]|\\.)*')/g, function(match) {
            strings.push(match);
            return '\x00STR' + (strings.length - 1) + '\x00';
        });

        // Highlight keywords
        var kwList = keywords[lang] || keywords.php;
        var kwRegex = new RegExp('\\b(' + kwList.join('|') + ')\\b', 'g');
        html = html.replace(kwRegex, '<span class="code-keyword">$1</span>');

        // Highlight numbers
        html = html.replace(/\b(\d+\.?\d*)\b/g, '<span class="code-number">$1</span>');

        // Restore strings with highlighting
        for (var i = 0; i < strings.length; i++) {
            html = html.replace('\x00STR' + i + '\x00', '<span class="code-string">' + strings[i] + '</span>');
        }

        return html;
    }

    // Apply highlighting to all <pre><code> blocks
    document.querySelectorAll('pre code').forEach(function (block) {
        var raw = block.textContent;
        block.setAttribute('data-raw-code', raw);
        var lang = block.getAttribute('data-lang') || '';
        if (!lang) {
            var cls = block.className || '';
            if (cls.indexOf('language-python') !== -1) lang = 'python';
            else if (cls.indexOf('language-java') !== -1) lang = 'java';
            else if (cls.indexOf('language-sql') !== -1) lang = 'sql';
            else if (cls.indexOf('language-php') !== -1) lang = 'php';
            else lang = 'php';
        }
        if (lang !== 'sql') {
            block.innerHTML = highlightCode(raw, lang);
        }
    });

    // === Run Code on Code Blocks ===
    var sandboxEndpoints = {
        'php': '/sandbox/execute.php',
        'python': '/sandbox/execute-python.php',
        'java': '/sandbox/execute-java.php'
    };

    // Wrap all code blocks and add Run buttons
    document.querySelectorAll('pre code').forEach(function (block) {
        var pre = block.parentElement;
        if (!pre || pre.parentElement.classList.contains('code-block-wrapper')) return;

        var lang = block.getAttribute('data-lang') || '';
        if (!lang) {
            var cls = block.className || '';
            if (cls.indexOf('language-python') !== -1) lang = 'python';
            else if (cls.indexOf('language-java') !== -1) lang = 'java';
            else if (cls.indexOf('language-php') !== -1) lang = 'php';
            else if (cls.indexOf('language-sql') !== -1) lang = 'sql';
            else lang = 'php';
        }

        // Only add Run button for PHP, Python, Java (not SQL/DBMS)
        if (lang !== 'php' && lang !== 'python' && lang !== 'java') return;

        // Skip code blocks inside teacher answer keys
        if (wrapper.closest('details')) return;

        // Don't add if already wrapped
        if (pre.previousElementSibling && pre.previousElementSibling.classList && pre.previousElementSibling.classList.contains('code-block-wrapper')) return;

        // Create wrapper
        var wrapper = document.createElement('div');
        wrapper.className = 'code-block-wrapper';
        pre.parentNode.insertBefore(wrapper, pre);
        wrapper.appendChild(pre);

        // Create Run button
        var runBtn = document.createElement('button');
        runBtn.className = 'run-code-btn';
        runBtn.textContent = 'Run Code';
        runBtn.type = 'button';
        wrapper.insertBefore(runBtn, pre);

        // Create output div
        var outputDiv = document.createElement('div');
        runBtn.insertAdjacentElement('afterend', outputDiv);

        // Get the clean code (stored before highlighting)
        var rawCode = block.getAttribute('data-raw-code') || block.textContent;

        runBtn.addEventListener('click', function () {
            var code = rawCode;
            if (!code.trim()) {
                outputDiv.className = 'run-code-output visible output-error';
                outputDiv.textContent = 'No code to run.';
                return;
            }

            runBtn.disabled = true;
            runBtn.textContent = 'Running...';
            outputDiv.className = 'run-code-output visible';
            outputDiv.textContent = 'Executing...';

            var endpoint = sandboxEndpoints[lang] || sandboxEndpoints['php'];

            fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'code=' + encodeURIComponent(code)
            })
            .then(function (response) { return response.json(); })
            .then(function (data) {
                if (data.error) {
                    outputDiv.className = 'run-code-output visible output-error';
                    outputDiv.textContent = data.error;
                } else {
                    outputDiv.className = 'run-code-output visible output-success';
                    outputDiv.textContent = data.output || '(No output)';
                }
            })
            .catch(function (err) {
                outputDiv.className = 'run-code-output visible output-error';
                outputDiv.textContent = 'Connection error: ' + err.message;
            })
            .finally(function () {
                runBtn.disabled = false;
                runBtn.textContent = 'Run Code';
            });
        });
    });

    // === Sandbox Code Execution (existing) ===
    document.querySelectorAll('.sandbox').forEach(function (sandbox) {
        var textarea = sandbox.querySelector('textarea');
        var runBtn = sandbox.querySelector('.run-btn');
        var resultDiv = sandbox.querySelector('.sandbox-result');
        var outputContent = resultDiv ? resultDiv.querySelector('.output-content') : null;

        if (!textarea || !runBtn || !resultDiv) return;

        var lang = textarea.getAttribute('data-lang') || 'php';
        var endpoint = sandboxEndpoints[lang] || sandboxEndpoints['php'];

        var exampleCode = textarea.getAttribute('data-example');
        if (exampleCode) {
            try {
                textarea.value = atob(exampleCode);
            } catch (e) {
                textarea.value = exampleCode;
            }
        }

        runBtn.addEventListener('click', function () {
            var code = textarea.value.trim();
            if (!code) {
                resultDiv.classList.add('visible');
                outputContent.className = 'output-content output-error';
                outputContent.textContent = 'Please write some code first.';
                return;
            }

            runBtn.disabled = true;
            runBtn.textContent = 'Running...';
            resultDiv.classList.add('visible');
            outputContent.className = 'output-content';
            outputContent.textContent = 'Executing...';

            fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'code=' + encodeURIComponent(code)
            })
            .then(function (response) { return response.json(); })
            .then(function (data) {
                if (data.error) {
                    outputContent.className = 'output-content output-error';
                    outputContent.textContent = data.error;
                } else {
                    outputContent.className = 'output-content';
                    outputContent.textContent = data.output || '(No output)';
                }
            })
            .catch(function (err) {
                outputContent.className = 'output-content output-error';
                outputContent.textContent = 'Connection error: ' + err.message;
            })
            .finally(function () {
                runBtn.disabled = false;
                runBtn.textContent = 'Run Code';
            });
        });

        textarea.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                runBtn.click();
            }
        });
    });

});
