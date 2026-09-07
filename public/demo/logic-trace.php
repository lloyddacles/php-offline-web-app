<?php
/**
 * Programming Logic Demo - Algorithm Step Tracer
 * Visualize algorithms step by step with variable tracking
 */
$demoTitle = 'Algorithm Step Tracer';
$demoIcon = '&#128161;';
$demoColor = '#89b4fa';
$backUrl = '/#logic';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $demoTitle ?> - Demo</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/demo/demo.css">
    <style>
        .trace-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; }
        .trace-code { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; }
        .trace-code-header { padding: 12px 16px; background: var(--bg-active); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
        .trace-code-header h3 { margin: 0; font-size: 0.95em; border: none; padding: 0; color: var(--text-primary); }
        .trace-code-body { padding: 0; }
        .trace-line { display: flex; padding: 6px 16px; font-family: 'SF Mono', monospace; font-size: 0.88em; line-height: 1.6; border-left: 3px solid transparent; transition: all 0.15s; }
        .trace-line.active { background: var(--accent-dim); border-left-color: var(--accent); }
        .trace-line.executed { border-left-color: var(--accent-green); }
        .trace-line-num { width: 30px; color: var(--text-muted); text-align: right; margin-right: 16px; user-select: none; flex-shrink: 0; }
        .trace-line-code { color: var(--text-primary); white-space: pre; }
        .trace-panel { display: flex; flex-direction: column; gap: 16px; }
        .trace-vars { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 16px; }
        .trace-vars h3 { font-size: 0.9em; margin: 0 0 12px 0; color: var(--text-bright); border: none; padding: 0; }
        .var-item { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid var(--border); font-size: 0.88em; }
        .var-item:last-child { border: none; }
        .var-name { color: var(--accent); font-family: monospace; font-weight: 600; }
        .var-value { color: var(--text-primary); font-family: monospace; }
        .trace-output { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 16px; }
        .trace-output h3 { font-size: 0.9em; margin: 0 0 8px 0; color: var(--text-bright); border: none; padding: 0; }
        .output-text { font-family: monospace; font-size: 0.88em; color: var(--accent-green); min-height: 20px; }
        .trace-controls { display: flex; gap: 8px; margin-top: 12px; }
        .trace-controls button { flex: 1; padding: 8px; border-radius: var(--radius); border: 1px solid var(--border); background: var(--bg-surface); color: var(--text-primary); cursor: pointer; font-size: 0.85em; font-weight: 500; transition: all 0.15s; }
        .trace-controls button:hover { background: var(--bg-hover); border-color: var(--accent); }
        .trace-controls button.primary { background: var(--accent); color: var(--bg-primary); border-color: var(--accent); }
        .trace-controls button.primary:hover { background: var(--accent-hover); }
        .trace-controls button:disabled { opacity: 0.4; cursor: not-allowed; }
        .algo-select { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
        .algo-btn { padding: 8px 16px; border-radius: var(--radius); border: 1px solid var(--border); background: var(--bg-surface); color: var(--text-primary); cursor: pointer; font-size: 0.85em; transition: all 0.15s; }
        .algo-btn:hover { border-color: var(--accent); }
        .algo-btn.active { background: var(--accent); color: var(--bg-primary); border-color: var(--accent); }
        .trace-status { padding: 8px 12px; border-radius: var(--radius); font-size: 0.85em; margin-top: 8px; }
        .trace-status.running { background: var(--accent-dim); color: var(--accent); }
        .trace-status.done { background: rgba(166,227,161,0.1); color: var(--accent-green); }
        @media (max-width: 900px) { .trace-layout { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="demo-layout">
        <div class="demo-content" style="margin-left:0; max-width:1200px;">
            <div class="demo-page-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h1><?= $demoIcon ?> <?= $demoTitle ?></h1>
                    <p>Watch algorithms execute step by step. Track variables and see output in real time.</p>
                </div>
                <a href="/" class="btn btn-outline" style="flex-shrink:0;">&larr; Back</a>
            </div>

            <div class="algo-select" id="algoSelect">
                <button class="algo-btn active" data-algo="factorial">Factorial</button>
                <button class="algo-btn" data-algo="fibonacci">Fibonacci</button>
                <button class="algo-btn" data-algo="bubble">Bubble Sort</button>
                <button class="algo-btn" data-algo="sum">Sum 1 to N</button>
                <button class="algo-btn" data-algo="max">Find Maximum</button>
            </div>

            <div class="trace-layout">
                <div class="trace-code">
                    <div class="trace-code-header">
                        <h3 id="algoName">Factorial</h3>
                        <span style="font-size:0.8em; color:var(--text-muted);" id="stepCount">Step 0 / 0</span>
                    </div>
                    <div class="trace-code-body" id="codeBody"></div>
                </div>
                <div class="trace-panel">
                    <div class="trace-vars">
                        <h3>Variables</h3>
                        <div id="varsDisplay"><span style="color:var(--text-muted); font-size:0.85em;">Press Start to begin</span></div>
                    </div>
                    <div class="trace-output">
                        <h3>Output</h3>
                        <div class="output-text" id="outputDisplay"></div>
                    </div>
                    <div id="traceStatus" class="trace-status running" style="display:none;"></div>
                    <div class="trace-controls">
                        <button id="btnReset" onclick="resetTrace()">Reset</button>
                        <button id="btnStep" class="primary" onclick="stepTrace()">Step &rarr;</button>
                        <button id="btnRun" onclick="runAll()">Run All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
var algorithms = {
    factorial: {
        name: 'Factorial',
        desc: 'Calculate n! (n factorial)',
        code: [
            'function factorial(n) {',
            '  if (n <= 1) {',
            '    return 1;',
            '  }',
            '  return n * factorial(n - 1);',
            '}',
            '',
            'result = factorial(5);',
            'print(result);'
        ],
        input: 5,
        trace: function(n) {
            var steps = [];
            var callStack = [];
            function fact(n, depth) {
                callStack.push({fn:'factorial', args:{n:n}});
                steps.push({line:0, vars:{n:n, depth:depth}, stack:callStack.slice(), msg:'Call factorial(' + n + ')'});
                if (n <= 1) {
                    steps.push({line:1, vars:{n:n, depth:depth}, stack:callStack.slice(), msg:'Check: ' + n + ' <= 1 → true'});
                    steps.push({line:2, vars:{n:n, result:1, depth:depth}, stack:callStack.slice(), msg:'Return 1'});
                    callStack.pop();
                    return 1;
                }
                steps.push({line:1, vars:{n:n, depth:depth}, stack:callStack.slice(), msg:'Check: ' + n + ' <= 1 → false'});
                steps.push({line:4, vars:{n:n, depth:depth}, stack:callStack.slice(), msg:'Return ' + n + ' * factorial(' + (n-1) + ')'});
                var result = n * fact(n - 1, depth + 1);
                steps.push({line:4, vars:{n:n, result:result, depth:depth}, stack:callStack.slice(), msg:'factorial(' + n + ') = ' + result});
                callStack.pop();
                return result;
            }
            var finalResult = fact(n, 0);
            steps.push({line:7, vars:{result:finalResult}, stack:[], msg:'result = ' + finalResult});
            steps.push({line:8, vars:{result:finalResult}, stack:[], msg:'Output: ' + finalResult, output: '' + finalResult});
            return steps;
        }
    },
    fibonacci: {
        name: 'Fibonacci',
        desc: 'Calculate nth Fibonacci number',
        code: [
            'function fibonacci(n) {',
            '  if (n <= 0) return 0;',
            '  if (n === 1) return 1;',
            '  return fibonacci(n-1) + fibonacci(n-2);',
            '}',
            '',
            'result = fibonacci(6);',
            'print(result);'
        ],
        input: 6,
        trace: function(n) {
            var steps = [];
            var count = 0;
            function fib(n) {
                count++;
                if (count > 50) return 0;
                steps.push({line:0, vars:{n:n}, msg:'Call fibonacci(' + n + ')'});
                if (n <= 0) { steps.push({line:1, vars:{n:n, result:0}, msg:'Return 0'}); return 0; }
                if (n === 1) { steps.push({line:2, vars:{n:n, result:1}, msg:'Return 1'}); return 1; }
                steps.push({line:3, vars:{n:n}, msg:'Calculate fib(' + (n-1) + ') + fib(' + (n-2) + ')'});
                var a = fib(n - 1);
                var b = fib(n - 2);
                var r = a + b;
                steps.push({line:3, vars:{n:n, a:a, b:b, result:r}, msg:'fib(' + n + ') = ' + a + ' + ' + b + ' = ' + r});
                return r;
            }
            var result = fib(n);
            steps.push({line:6, vars:{result:result}, msg:'result = ' + result});
            steps.push({line:7, vars:{result:result}, msg:'Output: ' + result, output: '' + result});
            return steps;
        }
    },
    bubble: {
        name: 'Bubble Sort',
        desc: 'Sort array using bubble sort',
        code: [
            'arr = [5, 3, 8, 1, 2]',
            '',
            'for i = 0 to length-1:',
            '  for j = 0 to length-i-2:',
            '    if arr[j] > arr[j+1]:',
            '      swap(arr[j], arr[j+1])',
            '    print(arr)',
            '',
            'print("Sorted:", arr)'
        ],
        input: [5,3,8,1,2],
        trace: function(arr) {
            var steps = [];
            var a = arr.slice();
            steps.push({line:0, vars:{arr:a.slice()}, msg:'Array: [' + a.join(', ') + ']', arrState:a.slice()});
            for (var i = 0; i < a.length; i++) {
                steps.push({line:2, vars:{i:i, arr:a.slice()}, msg:'Pass ' + (i+1), arrState:a.slice()});
                for (var j = 0; j < a.length - i - 1; j++) {
                    steps.push({line:3, vars:{i:i, j:j, arr:a.slice()}, msg:'Compare arr[' + j + ']=' + a[j] + ' and arr[' + (j+1) + ']=' + a[j+1], arrState:a.slice()});
                    if (a[j] > a[j+1]) {
                        steps.push({line:4, vars:{i:i, j:j, arr:a.slice()}, msg:a[j] + ' > ' + a[j+1] + ' → Swap!', arrState:a.slice()});
                        var temp = a[j]; a[j] = a[j+1]; a[j+1] = temp;
                        steps.push({line:5, vars:{i:i, j:j, arr:a.slice()}, msg:'Swapped! Array: [' + a.join(', ') + ']', arrState:a.slice()});
                    } else {
                        steps.push({line:4, vars:{i:i, j:j, arr:a.slice()}, msg:a[j] + ' > ' + a[j+1] + ' → No swap', arrState:a.slice()});
                    }
                }
            }
            steps.push({line:8, vars:{arr:a.slice()}, msg:'Sorted: [' + a.join(', ') + ']', output:'Sorted: [' + a.join(', ') + ']', arrState:a.slice()});
            return steps;
        }
    },
    sum: {
        name: 'Sum 1 to N',
        desc: 'Calculate sum of numbers from 1 to n',
        code: [
            'function sum(n) {',
            '  total = 0;',
            '  for i = 1 to n:',
            '    total = total + i;',
            '  return total;',
            '}',
            '',
            'result = sum(10);',
            'print(result);'
        ],
        input: 10,
        trace: function(n) {
            var steps = [];
            steps.push({line:0, vars:{n:n}, msg:'Call sum(' + n + ')'});
            steps.push({line:1, vars:{n:n, total:0}, msg:'total = 0'});
            for (var i = 1; i <= n; i++) {
                steps.push({line:2, vars:{n:n, i:i, total:i-1}, msg:'i = ' + i});
                steps.push({line:3, vars:{n:n, i:i, total:i}, msg:'total = ' + (i-1) + ' + ' + i + ' = ' + i});
            }
            steps.push({line:4, vars:{n:n, total:n*(n+1)/2}, msg:'Return ' + (n*(n+1)/2)});
            steps.push({line:7, vars:{result:n*(n+1)/2}, msg:'result = ' + (n*(n+1)/2)});
            steps.push({line:8, vars:{result:n*(n+1)/2}, msg:'Output: ' + (n*(n+1)/2), output:'' + (n*(n+1)/2)});
            return steps;
        }
    },
    max: {
        name: 'Find Maximum',
        desc: 'Find the largest element in an array',
        code: [
            'arr = [3, 7, 2, 9, 5]',
            'max = arr[0]',
            '',
            'for i = 1 to length-1:',
            '  if arr[i] > max:',
            '    max = arr[i]',
            '  print("max =", max)',
            '',
            'print("Maximum:", max)'
        ],
        input: [3,7,2,9,5],
        trace: function(arr) {
            var steps = [];
            var max = arr[0];
            steps.push({line:0, vars:{arr:arr.slice()}, msg:'Array: [' + arr.join(', ') + ']', arrState:arr.slice()});
            steps.push({line:1, vars:{arr:arr.slice(), max:max}, msg:'max = arr[0] = ' + max, arrState:arr.slice()});
            for (var i = 1; i < arr.length; i++) {
                steps.push({line:3, vars:{arr:arr.slice(), i:i, max:max}, msg:'Check arr[' + i + '] = ' + arr[i], arrState:arr.slice()});
                if (arr[i] > max) {
                    steps.push({line:4, vars:{arr:arr.slice(), i:i, max:max}, msg:arr[i] + ' > ' + max + ' → true', arrState:arr.slice()});
                    max = arr[i];
                    steps.push({line:5, vars:{arr:arr.slice(), i:i, max:max}, msg:'max = ' + max, arrState:arr.slice()});
                } else {
                    steps.push({line:4, vars:{arr:arr.slice(), i:i, max:max}, msg:arr[i] + ' > ' + max + ' → false', arrState:arr.slice()});
                }
            }
            steps.push({line:8, vars:{arr:arr.slice(), max:max}, msg:'Maximum: ' + max, output:'Maximum: ' + max, arrState:arr.slice()});
            return steps;
        }
    }
};

var currentAlgo = 'factorial';
var steps = [];
var currentStep = -1;

function loadAlgo(key) {
    currentAlgo = key;
    var algo = algorithms[key];
    document.getElementById('algoName').textContent = algo.name;
    steps = algo.trace(algo.input);
    currentStep = -1;
    renderCode(algo.code);
    updateVars({});
    document.getElementById('outputDisplay').textContent = '';
    document.getElementById('stepCount').textContent = 'Step 0 / ' + steps.length;
    document.getElementById('traceStatus').style.display = 'none';
    document.getElementById('btnStep').disabled = false;
    document.getElementById('btnRun').disabled = false;
}

function renderCode(code) {
    var html = '';
    for (var i = 0; i < code.length; i++) {
        html += '<div class="trace-line" id="line' + i + '"><span class="trace-line-num">' + (i+1) + '</span><span class="trace-line-code">' + escapeHtml(code[i]) + '</span></div>';
    }
    document.getElementById('codeBody').innerHTML = html;
}

function escapeHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function stepTrace() {
    if (currentStep >= steps.length - 1) return;
    currentStep++;
    var step = steps[currentStep];
    // Highlight line
    document.querySelectorAll('.trace-line').forEach(function(el, i) {
        el.classList.remove('active');
        if (i < currentStep) el.classList.add('executed');
    });
    var lineEl = document.getElementById('line' + step.line);
    if (lineEl) { lineEl.classList.add('active'); lineEl.classList.remove('executed'); }
    updateVars(step.vars);
    if (step.output) {
        document.getElementById('outputDisplay').textContent = step.output;
    }
    document.getElementById('stepCount').textContent = 'Step ' + (currentStep+1) + ' / ' + steps.length;
    if (currentStep >= steps.length - 1) {
        document.getElementById('traceStatus').style.display = 'block';
        document.getElementById('traceStatus').className = 'trace-status done';
        document.getElementById('traceStatus').textContent = '✓ Algorithm completed!';
        document.getElementById('btnStep').disabled = true;
    }
}

function updateVars(vars) {
    var html = '';
    for (var k in vars) {
        var val = vars[k];
        if (Array.isArray(val)) val = '[' + val.join(', ') + ']';
        html += '<div class="var-item"><span class="var-name">' + escapeHtml(k) + '</span><span class="var-value">' + escapeHtml(String(val)) + '</span></div>';
    }
    if (!html) html = '<span style="color:var(--text-muted); font-size:0.85em;">No variables yet</span>';
    document.getElementById('varsDisplay').innerHTML = html;
}

function resetTrace() { loadAlgo(currentAlgo); }

function runAll() {
    var timer = setInterval(function() {
        if (currentStep >= steps.length - 1) { clearInterval(timer); return; }
        stepTrace();
    }, 200);
}

document.querySelectorAll('.algo-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.algo-btn').forEach(function(b) { b.classList.remove('active'); });
        btn.classList.add('active');
        loadAlgo(btn.getAttribute('data-algo'));
    });
});

loadAlgo('factorial');
</script>
</body>
</html>
