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

    // === Syntax Highlighting ===

    // Keywords and constants (cached at module scope)
    var phpKeywords = [
        'abstract', 'and', 'array', 'as', 'break', 'callable', 'case', 'catch',
        'class', 'clone', 'const', 'continue', 'declare', 'default', 'die', 'do',
        'echo', 'else', 'elseif', 'empty', 'enddeclare', 'endfor', 'endforeach',
        'endif', 'endswitch', 'endwhile', 'eval', 'exit', 'extends', 'final',
        'finally', 'fn', 'for', 'foreach', 'function', 'global', 'goto',
        'if', 'implements', 'include', 'include_once', 'instanceof', 'insteadof',
        'interface', 'isset', 'list', 'match', 'namespace', 'new', 'or', 'print',
        'private', 'protected', 'public', 'readonly', 'require', 'require_once',
        'return', 'static', 'switch', 'throw', 'trait', 'try', 'unset', 'use',
        'var', 'while', 'xor', 'yield', 'yield_from', 'enum'
    ];
    var phpConstants = ['true', 'false', 'null', 'TRUE', 'FALSE', 'NULL', '__LINE__', '__FILE__', '__DIR__', '__FUNCTION__', '__CLASS__', '__TRAIT__', '__METHOD__', '__NAMESPACE__'];
    var pyKeywords = [
        'False', 'None', 'True', 'and', 'as', 'assert', 'async', 'await',
        'break', 'class', 'continue', 'def', 'del', 'elif', 'else', 'except',
        'finally', 'for', 'from', 'global', 'if', 'import', 'in', 'is',
        'lambda', 'nonlocal', 'not', 'or', 'pass', 'raise', 'return',
        'try', 'while', 'with', 'yield'
    ];
    var pyBuiltins = [
        'print', 'len', 'range', 'int', 'float', 'str', 'list', 'dict',
        'set', 'tuple', 'input', 'open', 'type', 'isinstance', 'enumerate',
        'zip', 'map', 'filter', 'sorted', 'sum', 'min', 'max', 'abs',
        'round', 'format', 'super', 'property', 'staticmethod', 'classmethod'
    ];
    var javaKeywords = [
        'abstract', 'assert', 'boolean', 'break', 'byte', 'case', 'catch',
        'char', 'class', 'const', 'continue', 'default', 'do', 'double',
        'else', 'enum', 'extends', 'final', 'finally', 'float', 'for',
        'goto', 'if', 'implements', 'import', 'instanceof', 'int',
        'interface', 'long', 'native', 'new', 'package', 'private',
        'protected', 'public', 'return', 'short', 'static', 'strictfp',
        'super', 'switch', 'synchronized', 'this', 'throw', 'throws',
        'transient', 'try', 'void', 'volatile', 'while', 'var', 'record',
        'sealed', 'permits', 'yield'
    ];
    var javaTypes = ['String', 'System', 'Scanner', 'Math', 'Integer', 'Double', 'Boolean', 'ArrayList', 'HashMap', 'Object'];

    // Cached regexes
    var rePhpKw = new RegExp('\\b(' + phpKeywords.join('|') + ')\\b', 'g');
    var rePhpConst = new RegExp('\\b(' + phpConstants.join('|') + ')\\b', 'g');
    var rePyKw = new RegExp('\\b(' + pyKeywords.join('|') + ')\\b', 'g');
    var rePyBuiltins = new RegExp('\\b(' + pyBuiltins.join('|') + ')\\b', 'g');
    var reJavaKw = new RegExp('\\b(' + javaKeywords.join('|') + ')\\b', 'g');
    var reJavaTypes = new RegExp('\\b(' + javaTypes.join('|') + ')\\b', 'g');
    var reNumber = /\b(\d+\.?\d*)\b/g;
    var reNumberJava = /\b(\d+\.?\d*[fFlL]?)\b/g;

    function highlightPHP(code) {
        // Remove comments first
        code = code.replace(/\/\*[\s\S]*?\*\//g, '');
        code = code.replace(/\/\/[^\n]*/g, '');
        code = code.replace(/#[^{][^\n]*/g, '');

        var escaped = code
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        escaped = escaped.replace(/(&lt;&lt;&lt;['"]?\w+['"]?[\s\S]*?\w+;)/g, '<span class="code-string">$1</span>');
        escaped = escaped.replace(/("(?:[^"\\]|\\.)*")/g, '<span class="code-string">$1</span>');
        escaped = escaped.replace(/('(?:[^'\\]|\\.)*')/g, '<span class="code-string">$1</span>');
        escaped = escaped.replace(/(&lt;\?php|\?&gt;)/g, '<span class="code-php-tag">$1</span>');
        escaped = escaped.replace(/(\$[a-zA-Z_]\w*)/g, '<span class="code-variable">$1</span>');
        escaped = escaped.replace(rePhpKw, '<span class="code-keyword">$1</span>');
        escaped = escaped.replace(rePhpConst, '<span class="code-constant">$1</span>');
        escaped = escaped.replace(reNumber, '<span class="code-number">$1</span>');

        return escaped;
    }

    function highlightPython(code) {
        // Remove comments first
        code = code.replace(/"""[\s\S]*?"""/g, '');
        code = code.replace(/'''[\s\S]*?'''/g, '');
        code = code.replace(/#[^\n]*/g, '');

        var escaped = code
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        escaped = escaped.replace(/(f?"(?:[^"\\]|\\.)*"|f?'(?:[^'\\]|\\.)*')/g, '<span class="code-string">$1</span>');
        escaped = escaped.replace(/(@\w+)/g, '<span class="code-keyword">$1</span>');
        escaped = escaped.replace(rePyKw, '<span class="code-keyword">$1</span>');
        escaped = escaped.replace(rePyBuiltins, '<span class="code-constant">$1</span>');
        escaped = escaped.replace(reNumber, '<span class="code-number">$1</span>');

        return escaped;
    }

    function highlightJava(code) {
        // Remove comments first
        code = code.replace(/\/\*[\s\S]*?\*\//g, '');
        code = code.replace(/\/\/[^\n]*/g, '');

        var escaped = code
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        escaped = escaped.replace(/("(?:[^"\\]|\\.)*")/g, '<span class="code-string">$1</span>');
        escaped = escaped.replace(/('(?:[^'\\]|\\.)*')/g, '<span class="code-string">$1</span>');
        escaped = escaped.replace(/(@\w+)/g, '<span class="code-keyword">$1</span>');
        escaped = escaped.replace(reJavaKw, '<span class="code-keyword">$1</span>');
        escaped = escaped.replace(reJavaTypes, '<span class="code-constant">$1</span>');
        escaped = escaped.replace(/\b(true|false|null)\b/g, '<span class="code-constant">$1</span>');
        escaped = escaped.replace(reNumberJava, '<span class="code-number">$1</span>');

        return escaped;
    }

    // Apply highlighting to all <pre><code> blocks
    // Store raw code for Run Code feature
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
        if (lang === 'python') {
            block.innerHTML = highlightPython(raw);
        } else if (lang === 'java') {
            block.innerHTML = highlightJava(raw);
        } else if (lang === 'php') {
            block.innerHTML = highlightPHP(raw);
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

        // Only add Run button for runnable languages
        if (lang !== 'php' && lang !== 'python' && lang !== 'java') return;

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
