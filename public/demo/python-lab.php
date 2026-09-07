<?php
/**
 * Python Demo - Data Lab
 * Interactive data analysis with charts
 */
$demoTitle = 'Python Data Lab';
$demoIcon = '&#128013;';
$demoColor = '#a6e3a1';
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
        .lab-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .lab-panel { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; }
        .lab-panel-header { padding: 12px 16px; background: var(--bg-active); border-bottom: 1px solid var(--border); font-weight: 600; font-size: 0.9em; display: flex; justify-content: space-between; align-items: center; }
        .lab-panel-body { padding: 16px; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 0.85em; }
        .data-table th { text-align: left; padding: 6px 10px; border-bottom: 2px solid var(--border); color: var(--text-muted); font-weight: 600; }
        .data-table td { padding: 6px 10px; border-bottom: 1px solid var(--border); }
        .chart-bar { display: flex; align-items: flex-end; gap: 4px; height: 150px; padding: 10px 0; }
        .chart-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 4px; }
        .chart-bar-fill { width: 100%; border-radius: 4px 4px 0 0; transition: height 0.3s; min-height: 2px; }
        .chart-label { font-size: 0.7em; color: var(--text-muted); text-align: center; word-break: break-all; }
        .chart-value { font-size: 0.75em; color: var(--text-primary); font-weight: 600; }
        .stat-row { display: flex; gap: 12px; margin-bottom: 12px; flex-wrap: wrap; }
        .stat-box { flex: 1; min-width: 80px; padding: 12px; background: var(--bg-primary); border-radius: var(--radius); text-align: center; }
        .stat-box .stat-num { font-size: 1.4em; font-weight: 700; color: var(--accent); }
        .stat-box .stat-lbl { font-size: 0.75em; color: var(--text-muted); margin-top: 2px; }
        .btn-group { display: flex; gap: 6px; flex-wrap: wrap; }
        .btn-sm { padding: 6px 12px; border-radius: var(--radius); border: 1px solid var(--border); background: var(--bg-surface); color: var(--text-primary); cursor: pointer; font-size: 0.8em; transition: all 0.15s; }
        .btn-sm:hover { border-color: var(--accent); }
        .btn-sm.active { background: var(--accent); color: var(--bg-primary); border-color: var(--accent); }
        .code-output { background: var(--bg-code); padding: 12px; border-radius: var(--radius); font-family: monospace; font-size: 0.85em; color: var(--accent-green); white-space: pre-wrap; margin-top: 8px; }
        @media (max-width: 768px) { .lab-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="demo-layout">
        <div class="demo-content" style="margin-left:0; max-width:1200px;">
            <div class="demo-page-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h1><?= $demoIcon ?> <?= $demoTitle ?></h1>
                    <p>Analyze student data with Python. See statistics, charts, and patterns.</p>
                </div>
                <a href="/" class="btn btn-outline" style="flex-shrink:0;">&larr; Back</a>
            </div>

            <div class="stat-row" id="statsRow"></div>

            <div class="lab-grid">
                <div class="lab-panel">
                    <div class="lab-panel-header">Student Data</div>
                    <div class="lab-panel-body" style="max-height:400px; overflow-y:auto;">
                        <table class="data-table" id="dataTable"></table>
                    </div>
                </div>
                <div class="lab-panel">
                    <div class="lab-panel-header">
                        <span>Visualization</span>
                        <div class="btn-group">
                            <button class="btn-sm active" onclick="setChart('grades')">Grades</button>
                            <button class="btn-sm" onclick="setChart('courses')">Courses</button>
                            <button class="btn-sm" onclick="setChart('scatter')">Age vs GPA</button>
                        </div>
                    </div>
                    <div class="lab-panel-body">
                        <div id="chartArea"></div>
                    </div>
                </div>
            </div>

            <div class="lab-panel" style="margin-top:16px;">
                <div class="lab-panel-header">
                    <span>Python Code Output</span>
                    <div class="btn-group">
                        <button class="btn-sm active" onclick="runAnalysis('mean')">Mean</button>
                        <button class="btn-sm" onclick="runAnalysis('median')">Median</button>
                        <button class="btn-sm" onclick="runAnalysis('mode')">Mode</button>
                        <button class="btn-sm" onclick="runAnalysis('correlation')">Correlation</button>
                        <button class="btn-sm" onclick="runAnalysis('top')">Top Students</button>
                    </div>
                </div>
                <div class="lab-panel-body">
                    <div class="code-output" id="codeOutput">Select an analysis above to see Python output.</div>
                </div>
            </div>
        </div>
    </div>

<script>
var students = [
    {name:'Juan Dela Cruz', age:20, course:'BSIT', gpa:3.8, math:92, science:88, english:85},
    {name:'Maria Santos', age:19, course:'BSCS', gpa:3.9, math:95, science:91, english:90},
    {name:'Pedro Reyes', age:21, course:'BSIT', gpa:3.5, math:78, science:82, english:80},
    {name:'Ana Garcia', age:20, course:'BSIS', gpa:3.7, math:88, science:85, english:87},
    {name:'Carlo Mendoza', age:22, course:'BSCS', gpa:3.2, math:72, science:75, english:78},
    {name:'Sarah Lim', age:19, course:'BSIT', gpa:3.95, math:97, science:94, english:92},
    {name:'Mark Torres', age:21, course:'BSIS', gpa:3.6, math:82, science:80, english:84},
    {name:'Lisa Chen', age:20, course:'BSCS', gpa:3.85, math:90, science:93, english:88},
    {name:'Ryan Villanueva', age:22, course:'BSIT', gpa:3.3, math:75, science:78, english:76},
    {name:'Jane Cruz', age:19, course:'BSIS', gpa:3.75, math:86, science:84, english:89}
];

function renderTable() {
    var html = '<thead><tr><th>Name</th><th>Age</th><th>Course</th><th>GPA</th></tr></thead><tbody>';
    students.forEach(function(s) {
        html += '<tr><td>' + s.name + '</td><td>' + s.age + '</td><td><span class="badge badge-blue">' + s.course + '</span></td><td><strong>' + s.gpa.toFixed(2) + '</strong></td></tr>';
    });
    html += '</tbody>';
    document.getElementById('dataTable').innerHTML = html;
}

function renderStats() {
    var gpas = students.map(function(s){return s.gpa;});
    var mean = gpas.reduce(function(a,b){return a+b;},0)/gpas.length;
    var sorted = gpas.slice().sort(function(a,b){return a-b;});
    var median = sorted.length%2 ? sorted[Math.floor(sorted.length/2)] : (sorted[sorted.length/2-1]+sorted[sorted.length/2])/2;
    var max = Math.max.apply(null, gpas);
    var min = Math.min.apply(null, gpas);
    document.getElementById('statsRow').innerHTML =
        '<div class="stat-box"><div class="stat-num">' + students.length + '</div><div class="stat-lbl">Students</div></div>' +
        '<div class="stat-box"><div class="stat-num">' + mean.toFixed(2) + '</div><div class="stat-lbl">Mean GPA</div></div>' +
        '<div class="stat-box"><div class="stat-num">' + median.toFixed(2) + '</div><div class="stat-lbl">Median GPA</div></div>' +
        '<div class="stat-box"><div class="stat-num">' + max.toFixed(2) + '</div><div class="stat-lbl">Highest</div></div>' +
        '<div class="stat-box"><div class="stat-num">' + min.toFixed(2) + '</div><div class="stat-lbl">Lowest</div></div>';
}

var colors = ['#89b4fa','#a6e3a1','#fab387','#cba6f7','#f38ba8','#f9e2af','#94e2d5','#f5c2e7','#74c7ec','#b4befe'];

function setChart(type) {
    document.querySelectorAll('.lab-panel-header .btn-sm').forEach(function(b){b.classList.remove('active');});
    event.target.classList.add('active');
    var html = '';
    if (type === 'grades') {
        html = '<div class="chart-bar">';
        students.forEach(function(s, i) {
            var h = (s.gpa / 4.0) * 130;
            html += '<div class="chart-col"><div class="chart-value">' + s.gpa.toFixed(1) + '</div><div class="chart-bar-fill" style="height:' + h + 'px; background:' + colors[i%colors.length] + ';"></div><div class="chart-label">' + s.name.split(' ')[0] + '</div></div>';
        });
        html += '</div>';
    } else if (type === 'courses') {
        var courses = {};
        students.forEach(function(s){ courses[s.course] = (courses[s.course]||0) + 1; });
        html = '<div class="chart-bar" style="height:120px;">';
        var i = 0;
        for (var c in courses) {
            var h = (courses[c] / students.length) * 200;
            html += '<div class="chart-col"><div class="chart-value">' + courses[c] + '</div><div class="chart-bar-fill" style="height:' + h + 'px; background:' + colors[i%colors.length] + ';"></div><div class="chart-label">' + c + '</div></div>';
            i++;
        }
        html += '</div>';
    } else if (type === 'scatter') {
        html = '<div style="position:relative; height:160px; border-left:1px solid var(--border); border-bottom:1px solid var(--border); margin:10px;">';
        students.forEach(function(s, i) {
            var x = ((s.age - 18) / 5) * 90 + 5;
            var y = 150 - ((s.gpa - 3.0) / 1.0) * 130;
            html += '<div title="' + s.name + ': Age ' + s.age + ', GPA ' + s.gpa + '" style="position:absolute; left:' + x + '%; top:' + y + 'px; width:10px; height:10px; border-radius:50%; background:' + colors[i%colors.length] + '; cursor:pointer;"></div>';
        });
        html += '<div style="position:absolute; bottom:-20px; left:0; font-size:0.7em; color:var(--text-muted);">18</div>';
        html += '<div style="position:absolute; bottom:-20px; right:0; font-size:0.7em; color:var(--text-muted);">22</div>';
        html += '<div style="position:absolute; top:-5px; left:-30px; font-size:0.7em; color:var(--text-muted);">4.0</div>';
        html += '<div style="position:absolute; bottom:0; left:-25px; font-size:0.7em; color:var(--text-muted);">3.0</div>';
        html += '</div>';
        html += '<div style="text-align:center; font-size:0.75em; color:var(--text-muted); margin-top:20px;">Age (x) vs GPA (y) — hover for details</div>';
    }
    document.getElementById('chartArea').innerHTML = html;
}

function runAnalysis(type) {
    document.querySelectorAll('.lab-panel:last-child .btn-sm').forEach(function(b){b.classList.remove('active');});
    event.target.classList.add('active');
    var output = '';
    var gpas = students.map(function(s){return s.gpa;}).sort(function(a,b){return a-b;});
    if (type === 'mean') {
        var mean = gpas.reduce(function(a,b){return a+b;},0)/gpas.length;
        output = '>>> import statistics\n>>> gpas = [' + gpas.join(', ') + ']\n>>> statistics.mean(gpas)\n' + mean.toFixed(4) + '\n\n# Average GPA of ' + students.length + ' students: ' + mean.toFixed(2);
    } else if (type === 'median') {
        var sorted = gpas;
        var median = sorted.length%2 ? sorted[Math.floor(sorted.length/2)] : (sorted[sorted.length/2-1]+sorted[sorted.length/2])/2;
        output = '>>> import statistics\n>>> gpas = [' + gpas.join(', ') + ']\n>>> statistics.median(gpas)\n' + median.toFixed(4) + '\n\n# Middle value: ' + median.toFixed(2);
    } else if (type === 'mode') {
        var mathScores = students.map(function(s){return s.math;});
        var freq = {};
        mathScores.forEach(function(v){freq[v]=(freq[v]||0)+1;});
        var maxFreq = 0; var mode = [];
        for (var v in freq) { if (freq[v]>maxFreq){maxFreq=freq[v];mode=[v];}else if(freq[v]===maxFreq){mode.push(v);} }
        output = '>>> from collections import Counter\n>>> math_scores = [' + mathScores.join(', ') + ']\n>>> Counter(math_scores).most_common(1)\n[( ' + mode[0] + ', ' + maxFreq + ')]\n\n# Most common math score: ' + mode[0] + ' (appears ' + maxFreq + ' times)';
    } else if (type === 'correlation') {
        var n = students.length;
        var sumXY=0, sumX=0, sumY=0, sumX2=0, sumY2=0;
        students.forEach(function(s){sumXY+=s.age*s.gpa; sumX+=s.age; sumY+=s.gpa; sumX2+=s.age*s.age; sumY2+=s.gpa*s.gpa;});
        var r = (n*sumXY - sumX*sumY) / Math.sqrt((n*sumX2-sumX*sumX)*(n*sumY2-sumY*sumY));
        output = '>>> import numpy as np\n>>> ages = [' + students.map(function(s){return s.age;}).join(', ') + ']\n>>> gpas = [' + gpas.join(', ') + ']\n>>> np.corrcoef(ages, gpas)[0,1]\n' + r.toFixed(4) + '\n\n# Age-GPA correlation: ' + r.toFixed(3) + '\n# ' + (Math.abs(r) < 0.3 ? 'Weak correlation' : Math.abs(r) < 0.7 ? 'Moderate correlation' : 'Strong correlation');
    } else if (type === 'top') {
        var top = students.slice().sort(function(a,b){return b.gpa-a.gpa;}).slice(0,3);
        output = '>>> sorted(students, key=lambda s: s.gpa, reverse=True)[:3]\n[\n';
        top.forEach(function(s,i){ output += '  {"name": "' + s.name + '", "gpa": ' + s.gpa + '},  # Rank ' + (i+1) + '\n'; });
        output += ']\n\n# Top 3 students by GPA';
    }
    document.getElementById('codeOutput').textContent = output;
}

renderTable();
renderStats();
setChart('grades');
</script>
</body>
</html>
