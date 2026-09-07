<?php
/**
 * DSA Demo - Sorting Algorithm Visualizer
 * Animated visualization of sorting algorithms
 */
$demoTitle = 'Sorting Algorithm Visualizer';
$demoIcon = '&#128208;';
$demoColor = '#cba6f7';
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
        .sort-controls { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-bottom: 20px; padding: 16px; background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); }
        .sort-controls label { font-size: 0.85em; color: var(--text-muted); }
        .sort-controls select, .sort-controls input[type=range] { background: var(--bg-primary); border: 1px solid var(--border); border-radius: var(--radius); color: var(--text-primary); padding: 6px 10px; font-size: 0.85em; }
        .sort-btns { display: flex; gap: 6px; }
        .sort-visual { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; min-height: 300px; display: flex; align-items: flex-end; justify-content: center; gap: 3px; }
        .sort-bar { display: flex; flex-direction: column; align-items: center; justify-content: flex-end; transition: height 0.1s, background 0.1s; border-radius: 4px 4px 0 0; min-width: 20px; position: relative; }
        .sort-bar .bar-val { font-size: 0.7em; color: var(--text-primary); margin-bottom: 4px; font-weight: 600; }
        .sort-bar .bar-fill { width: 100%; border-radius: 4px 4px 0 0; transition: height 0.15s; }
        .bar-default { background: var(--accent); }
        .bar-comparing { background: var(--accent-yellow); }
        .bar-swapping { background: var(--accent-red); }
        .bar-sorted { background: var(--accent-green); }
        .bar-active { background: var(--accent-mauve); }
        .sort-info { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 12px; margin-top: 16px; }
        .info-card { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 12px 16px; text-align: center; }
        .info-card .info-val { font-size: 1.5em; font-weight: 700; color: var(--accent); }
        .info-card .info-lbl { font-size: 0.75em; color: var(--text-muted); margin-top: 2px; }
        .algo-desc { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 16px 20px; margin-top: 16px; }
        .algo-desc h3 { font-size: 0.95em; margin: 0 0 8px 0; color: var(--text-bright); }
        .algo-desc p { font-size: 0.88em; color: var(--text-secondary); margin: 0 0 6px 0; }
        .algo-desc .complexity { font-family: monospace; color: var(--accent); font-weight: 600; }
    </style>
</head>
<body>
    <div class="demo-layout">
        <div class="demo-content" style="margin-left:0; max-width:1200px;">
            <div class="demo-page-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h1><?= $demoIcon ?> <?= $demoTitle ?></h1>
                    <p>Watch sorting algorithms in action. Compare speed and behavior.</p>
                </div>
                <a href="/" class="btn btn-outline" style="flex-shrink:0;">&larr; Back</a>
            </div>

            <div class="sort-controls">
                <div>
                    <label>Algorithm</label><br>
                    <select id="algoSelect" onchange="resetSort()">
                        <option value="bubble">Bubble Sort</option>
                        <option value="selection">Selection Sort</option>
                        <option value="insertion">Insertion Sort</option>
                        <option value="merge">Merge Sort</option>
                        <option value="quick">Quick Sort</option>
                    </select>
                </div>
                <div>
                    <label>Array Size: <span id="sizeVal">20</span></label><br>
                    <input type="range" id="sizeSlider" min="5" max="50" value="20" oninput="document.getElementById('sizeVal').textContent=this.value; resetSort();">
                </div>
                <div>
                    <label>Speed: <span id="speedVal">50</span>ms</label><br>
                    <input type="range" id="speedSlider" min="5" max="200" value="50" oninput="document.getElementById('speedVal').textContent=this.value;">
                </div>
                <div class="sort-btns">
                    <button class="btn btn-outline" onclick="resetSort()">New Array</button>
                    <button class="btn btn-primary" id="btnSort" onclick="startSort()">▶ Sort</button>
                    <button class="btn btn-outline" id="btnStop" onclick="stopSort()" disabled>⏹ Stop</button>
                </div>
            </div>

            <div class="sort-visual" id="visualArea"></div>

            <div class="sort-info">
                <div class="info-card"><div class="info-val" id="infoCompares">0</div><div class="info-lbl">Comparisons</div></div>
                <div class="info-card"><div class="info-val" id="infoSwaps">0</div><div class="info-lbl">Swaps</div></div>
                <div class="info-card"><div class="info-val" id="infoArrayAccess">0</div><div class="info-lbl">Array Access</div></div>
                <div class="info-card"><div class="info-val" id="infoTime">0ms</div><div class="info-lbl">Time</div></div>
            </div>

            <div class="algo-desc" id="algoDesc"></div>
        </div>
    </div>

<script>
var arr = [];
var running = false;
var compares = 0, swaps = 0, access = 0;
var startTime = 0;
var timer = null;

var algoInfo = {
    bubble: { name:'Bubble Sort', desc:'Repeatedly steps through the list, compares adjacent elements and swaps them if they are in the wrong order.', time:'O(n²)', space:'O(1)', best:'O(n)', stable:'Yes' },
    selection: { name:'Selection Sort', desc:'Finds the minimum element and places it at the beginning, then repeats for the remaining elements.', time:'O(n²)', space:'O(1)', best:'O(n²)', stable:'No' },
    insertion: { name:'Insertion Sort', desc:'Builds the sorted array one element at a time by inserting each element into its correct position.', time:'O(n²)', space:'O(1)', best:'O(n)', stable:'Yes' },
    merge: { name:'Merge Sort', desc:'Divides the array in half, recursively sorts each half, then merges the sorted halves.', time:'O(n log n)', space:'O(n)', best:'O(n log n)', stable:'Yes' },
    quick: { name:'Quick Sort', desc:'Picks a pivot, partitions elements around it, then recursively sorts the partitions.', time:'O(n log n)', space:'O(log n)', best:'O(n log n)', stable:'No' }
};

function generateArray() {
    var size = parseInt(document.getElementById('sizeSlider').value);
    arr = [];
    for (var i = 0; i < size; i++) arr.push(Math.floor(Math.random() * 95) + 5);
    compares = 0; swaps = 0; access = 0;
    renderBars();
    updateInfo();
    updateDesc();
}

function renderBars(highlights) {
    var max = Math.max.apply(null, arr);
    var h = 250;
    var html = '';
    arr.forEach(function(v, i) {
        var bh = (v / max) * h;
        var cls = 'bar-default';
        if (highlights) {
            if (highlights.sorted && highlights.sorted.indexOf(i) >= 0) cls = 'bar-sorted';
            if (highlights.swapping && highlights.swapping.indexOf(i) >= 0) cls = 'bar-swapping';
            if (highlights.comparing && highlights.comparing.indexOf(i) >= 0) cls = 'bar-comparing';
            if (highlights.active && highlights.active.indexOf(i) >= 0) cls = 'bar-active';
        }
        html += '<div class="sort-bar"><span class="bar-val">' + v + '</span><div class="bar-fill ' + cls + '" style="height:' + bh + 'px;"></div></div>';
    });
    document.getElementById('visualArea').innerHTML = html;
}

function updateInfo() {
    document.getElementById('infoCompares').textContent = compares;
    document.getElementById('infoSwaps').textContent = swaps;
    document.getElementById('infoArrayAccess').textContent = access;
    var elapsed = running ? (Date.now() - startTime) : 0;
    document.getElementById('infoTime').textContent = elapsed + 'ms';
}

function updateDesc() {
    var key = document.getElementById('algoSelect').value;
    var info = algoInfo[key];
    document.getElementById('algoDesc').innerHTML = '<h3>' + info.name + '</h3><p>' + info.desc + '</p><p>Time: <span class="complexity">' + info.time + '</span> | Space: <span class="complexity">' + info.space + '</span> | Best: <span class="complexity">' + info.best + '</span> | Stable: ' + info.stable + '</p>';
}

function sleep(ms) { return new Promise(function(r) { timer = setTimeout(r, ms); }); }
function getSpeed() { return parseInt(document.getElementById('speedSlider').value); }

function stopSort() { running = false; if (timer) clearTimeout(timer); document.getElementById('btnSort').disabled = false; document.getElementById('btnStop').disabled = true; }

async function startSort() {
    running = true;
    compares = 0; swaps = 0; access = 0;
    startTime = Date.now();
    document.getElementById('btnSort').disabled = true;
    document.getElementById('btnStop').disabled = false;
    var algo = document.getElementById('algoSelect').value;
    if (algo === 'bubble') await bubbleSort();
    else if (algo === 'selection') await selectionSort();
    else if (algo === 'insertion') await insertionSort();
    else if (algo === 'merge') await mergeSort(0, arr.length - 1);
    else if (algo === 'quick') await quickSort(0, arr.length - 1);
    if (running) {
        renderBars({sorted: arr.map(function(_,i){return i;})});
        document.getElementById('infoTime').textContent = (Date.now() - startTime) + 'ms';
    }
    running = false;
    document.getElementById('btnSort').disabled = false;
    document.getElementById('btnStop').disabled = true;
}

async function bubbleSort() {
    var sorted = [];
    for (var i = arr.length - 1; i > 0; i--) {
        for (var j = 0; j < i; j++) {
            if (!running) return;
            compares++; access += 2;
            renderBars({comparing:[j,j+1], sorted:sorted});
            updateInfo();
            await sleep(getSpeed());
            if (arr[j] > arr[j+1]) {
                var t = arr[j]; arr[j] = arr[j+1]; arr[j+1] = t;
                swaps++; access += 2;
                renderBars({swapping:[j,j+1], sorted:sorted});
                updateInfo();
                await sleep(getSpeed());
            }
        }
        sorted.push(i);
    }
    sorted.push(0);
}

async function selectionSort() {
    var sorted = [];
    for (var i = 0; i < arr.length; i++) {
        var minIdx = i;
        for (var j = i + 1; j < arr.length; j++) {
            if (!running) return;
            compares++; access += 2;
            renderBars({comparing:[minIdx,j], sorted:sorted});
            updateInfo();
            await sleep(getSpeed());
            if (arr[j] < arr[minIdx]) minIdx = j;
        }
        if (minIdx !== i) {
            var t = arr[i]; arr[i] = arr[minIdx]; arr[minIdx] = t;
            swaps++; access += 4;
            renderBars({swapping:[i,minIdx], sorted:sorted});
            updateInfo();
            await sleep(getSpeed());
        }
        sorted.push(i);
    }
}

async function insertionSort() {
    var sorted = [0];
    for (var i = 1; i < arr.length; i++) {
        var key = arr[i];
        var j = i - 1;
        access++;
        while (j >= 0 && arr[j] > key) {
            if (!running) return;
            compares++; access += 2;
            arr[j+1] = arr[j]; swaps++; access += 2;
            renderBars({comparing:[j,j+1], sorted:sorted});
            updateInfo();
            await sleep(getSpeed());
            j--;
        }
        compares++; access++;
        arr[j+1] = key; access++;
        sorted.push(i);
        renderBars({swapping:[j+1], sorted:sorted});
        updateInfo();
        await sleep(getSpeed());
    }
}

async function mergeSort(left, right) {
    if (left >= right || !running) return;
    var mid = Math.floor((left + right) / 2);
    await mergeSort(left, mid);
    await mergeSort(mid + 1, right);
    await merge(left, mid, right);
}

async function merge(left, mid, right) {
    var temp = arr.slice(left, right + 1);
    var i = 0, j = mid - left + 1, k = left;
    while (i <= mid - left && j <= right - left) {
        if (!running) return;
        compares++; access += 2;
        renderBars({comparing:[left+i, left+j]});
        updateInfo();
        await sleep(getSpeed());
        if (temp[i] <= temp[j]) { arr[k] = temp[i]; i++; }
        else { arr[k] = temp[j]; j++; }
        swaps++; access++; k++;
    }
    while (i <= mid - left) { arr[k] = temp[i]; i++; k++; access++; }
    while (j <= right - left) { arr[k] = temp[j]; j++; k++; access++; }
    renderBars({active: arr.map(function(_,idx){return idx;}).filter(function(idx){return idx>=left&&idx<=right;})});
    updateInfo();
    await sleep(getSpeed());
}

async function quickSort(low, high) {
    if (low >= high || !running) return;
    var pi = await partition(low, high);
    await quickSort(low, pi - 1);
    await quickSort(pi + 1, high);
}

async function partition(low, high) {
    var pivot = arr[high];
    var i = low - 1;
    access++;
    for (var j = low; j < high; j++) {
        if (!running) return low;
        compares++; access++;
        renderBars({comparing:[j, high], active:[i>=0?i:low]});
        updateInfo();
        await sleep(getSpeed());
        if (arr[j] < pivot) {
            i++;
            var t = arr[i]; arr[i] = arr[j]; arr[j] = t;
            swaps++; access += 2;
            renderBars({swapping:[i, j]});
            updateInfo();
            await sleep(getSpeed());
        }
    }
    var t = arr[i+1]; arr[i+1] = arr[high]; arr[high] = t;
    swaps++; access += 2;
    renderBars({swapping:[i+1, high]});
    updateInfo();
    await sleep(getSpeed());
    return i + 1;
}

function resetSort() { stopSort(); generateArray(); }

generateArray();
</script>
</body>
</html>
