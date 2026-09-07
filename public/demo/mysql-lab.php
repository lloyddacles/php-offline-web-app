<?php
/**
 * MySQL Demo - SQL Query Playground
 * Write and execute SQL queries against a sample database
 */
$demoTitle = 'SQL Query Playground';
$demoIcon = '&#128451;';
$demoColor = '#94e2d5';
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
        .sql-layout { display: grid; grid-template-columns: 1fr 320px; gap: 16px; }
        .sql-editor { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; }
        .sql-editor-header { padding: 10px 16px; background: var(--bg-active); border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
        .sql-editor-header span { font-size: 0.85em; font-weight: 600; }
        .sql-textarea { width: 100%; min-height: 120px; padding: 14px 16px; background: var(--bg-code); border: none; color: var(--accent-green); font-family: 'SF Mono', monospace; font-size: 0.88em; line-height: 1.6; resize: vertical; outline: none; }
        .sql-result { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; margin-top: 16px; }
        .sql-result-header { padding: 10px 16px; background: var(--bg-active); border-bottom: 1px solid var(--border); font-size: 0.85em; font-weight: 600; display: flex; justify-content: space-between; }
        .sql-result-body { overflow-x: auto; }
        .sql-result-table { width: 100%; border-collapse: collapse; font-size: 0.85em; }
        .sql-result-table th { text-align: left; padding: 8px 12px; background: var(--bg-active); border-bottom: 2px solid var(--border); color: var(--text-muted); font-weight: 600; white-space: nowrap; }
        .sql-result-table td { padding: 7px 12px; border-bottom: 1px solid var(--border); white-space: nowrap; }
        .sql-result-table tr:hover td { background: var(--bg-hover); }
        .sql-error { padding: 12px 16px; color: var(--accent-red); font-family: monospace; font-size: 0.85em; }
        .sql-success { padding: 12px 16px; color: var(--accent-green); font-family: monospace; font-size: 0.85em; }
        .sql-sidebar { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 16px; }
        .sql-sidebar h3 { font-size: 0.9em; margin: 0 0 10px 0; color: var(--text-bright); }
        .table-list { list-style: none; margin-bottom: 16px; }
        .table-list li { padding: 6px 10px; font-size: 0.85em; cursor: pointer; border-radius: var(--radius); color: var(--text-primary); display: flex; justify-content: space-between; align-items: center; }
        .table-list li:hover { background: var(--bg-hover); }
        .table-list li .tbl-icon { color: var(--accent-yellow); margin-right: 6px; }
        .table-cols { padding: 4px 0 4px 20px; font-size: 0.8em; color: var(--text-muted); }
        .table-cols span { display: block; padding: 2px 0; }
        .table-cols .col-type { color: var(--accent); font-family: monospace; font-size: 0.9em; }
        .preset-queries { list-style: none; }
        .preset-queries li { padding: 7px 10px; font-size: 0.82em; cursor: pointer; border-radius: var(--radius); color: var(--text-primary); border-bottom: 1px solid var(--border); }
        .preset-queries li:last-child { border: none; }
        .preset-queries li:hover { background: var(--bg-hover); color: var(--accent); }
        @media (max-width: 900px) { .sql-layout { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="demo-layout">
        <div class="demo-content" style="margin-left:0; max-width:1200px;">
            <div class="demo-page-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h1><?= $demoIcon ?> <?= $demoTitle ?></h1>
                    <p>Write SQL queries against a sample company database. No server needed.</p>
                </div>
                <a href="/" class="btn btn-outline" style="flex-shrink:0;">&larr; Back</a>
            </div>

            <div class="sql-layout">
                <div>
                    <div class="sql-editor">
                        <div class="sql-editor-header">
                            <span>SQL Query</span>
                            <button class="btn btn-primary" onclick="executeQuery()" style="padding:6px 14px; font-size:0.82em;">▶ Run</button>
                        </div>
                        <textarea class="sql-textarea" id="sqlInput" spellcheck="false">SELECT * FROM employees;</textarea>
                    </div>
                    <div class="sql-result" id="sqlResult">
                        <div class="sql-result-header"><span>Result</span><span id="resultMeta"></span></div>
                        <div class="sql-result-body" id="resultBody">
                            <p style="padding:16px; color:var(--text-muted); font-size:0.85em;">Click "Run" to execute the query.</p>
                        </div>
                    </div>
                </div>

                <div class="sql-sidebar">
                    <h3>Tables</h3>
                    <ul class="table-list" id="tableList"></ul>
                    <h3 style="margin-top:16px;">Example Queries</h3>
                    <ul class="preset-queries" id="presetList"></ul>
                </div>
            </div>
        </div>
    </div>

<script>
var db = {};
var schema = {};

function initDB() {
    schema = {
        departments: { cols:['id','name','budget'], types:['INT','VARCHAR','DECIMAL'] },
        employees: { cols:['id','first_name','last_name','email','hire_date','salary','dept_id'], types:['INT','VARCHAR','VARCHAR','VARCHAR','DATE','DECIMAL','INT'] },
        projects: { cols:['id','name','start_date','end_date','budget'], types:['INT','VARCHAR','DATE','DATE','DECIMAL'] },
        customers: { cols:['id','name','email','phone','city'], types:['INT','VARCHAR','VARCHAR','VARCHAR','VARCHAR'] },
        orders: { cols:['id','customer_id','order_date','total_amount','status'], types:['INT','INT','DATE','DECIMAL','VARCHAR'] },
        order_items: { cols:['id','order_id','product_name','quantity','unit_price'], types:['INT','INT','VARCHAR','INT','DECIMAL'] }
    };

    db.departments = [
        [1,'Engineering',500000],[2,'Marketing',300000],[3,'Finance',400000],
        [4,'Human Resources',250000],[5,'Operations',350000]
    ];
    db.employees = [
        [1,'Juan','Dela Cruz','juan@company.com','2022-01-15',75000,1],
        [2,'Maria','Santos','maria@company.com','2021-06-20',82000,1],
        [3,'Pedro','Reyes','pedro@company.com','2023-03-10',65000,2],
        [4,'Ana','Garcia','ana@company.com','2020-11-01',90000,3],
        [5,'Carlo','Mendoza','carlo@company.com','2022-08-05',70000,2],
        [5,'Sarah','Lim','sarah@company.com','2023-01-20',85000,1],
        [6,'Mark','Torres','mark@company.com','2021-04-12',60000,4],
        [7,'Lisa','Chen','lisa@company.com','2022-09-30',95000,5],
        [8,'Ryan','Villanueva','ryan@company.com','2023-07-01',55000,3],
        [9,'Jane','Cruz','jane@company.com','2020-02-14',110000,1]
    ];
    db.projects = [
        [1,'Website Redesign','2023-01-01','2023-06-30',120000],
        [2,'Mobile App','2023-03-15','2023-12-31',250000],
        [3,'Data Migration','2022-09-01','2023-03-31',80000],
        [4,'CRM System','2023-06-01','2024-05-31',300000]
    ];
    db.customers = [
        [1,'Acme Corp','info@acme.com','555-0101','Manila'],
        [2,'TechStart','hello@techstart.com','555-0102','Cebu'],
        [3,'GlobalTrade','contact@global.com','555-0103','Davao'],
        [4,'Prime Solutions','sales@prime.com','555-0104','Manila'],
        [5,'Island Foods','info@island.com','555-0105','Cebu']
    ];
    db.orders = [
        [1,1,'2023-06-01',15000,'Completed'],
        [2,2,'2023-06-15',8500,'Completed'],
        [3,1,'2023-07-01',22000,'Processing'],
        [4,3,'2023-07-10',5000,'Completed'],
        [5,4,'2023-08-01',18000,'Pending'],
        [6,5,'2023-08-15',9500,'Processing']
    ];
    db.order_items = [
        [1,1,'Web Hosting',1,5000],
        [2,1,'SSL Certificate',2,3000],
        [3,2,'Consulting Hours',5,1700],
        [4,3,'Server License',1,15000],
        [5,3,'Setup Fee',1,7000],
        [6,4,'Training Package',1,5000],
        [7,5,'Software License',3,6000],
        [8,5,'Support Plan',1,6000],
        [9,6,'Cloud Storage',10,950]
    ];
}

function renderTableList() {
    var html = '';
    for (var t in schema) {
        html += '<li onclick="toggleCols(this)"><span><span class="tbl-icon">&#9654;</span>' + t + '</span><span style="color:var(--text-muted); font-size:0.75em;">' + db[t].length + ' rows</span></li>';
        html += '<div class="table-cols" style="display:none;">';
        schema[t].cols.forEach(function(c, i) {
            html += '<span>' + c + ' <span class="col-type">' + schema[t].types[i] + '</span></span>';
        });
        html += '</div>';
    }
    document.getElementById('tableList').innerHTML = html;
}

function toggleCols(el) {
    var cols = el.nextElementSibling;
    cols.style.display = cols.style.display === 'none' ? 'block' : 'none';
}

var presets = [
    {label:'All employees', sql:'SELECT * FROM employees;'},
    {label:'Engineers (by dept)', sql:"SELECT first_name, last_name, salary\nFROM employees\nWHERE dept_id = 1\nORDER BY salary DESC;"},
    {label:'Department summary', sql:"SELECT d.name AS department,\n       COUNT(e.id) AS headcount,\n       ROUND(AVG(e.salary), 0) AS avg_salary\nFROM departments d\nLEFT JOIN employees e ON d.id = e.dept_id\nGROUP BY d.name\nORDER BY headcount DESC;"},
    {label:'Recent orders', sql:"SELECT c.name AS customer,\n       o.order_date,\n       o.total_amount,\n       o.status\nFROM orders o\nJOIN customers c ON o.customer_id = c.id\nORDER BY o.order_date DESC;"},
    {label:'Revenue by city', sql:"SELECT c.city,\n       COUNT(o.id) AS total_orders,\n       SUM(o.total_amount) AS revenue\nFROM customers c\nJOIN orders o ON c.id = o.customer_id\nGROUP BY c.city\nORDER BY revenue DESC;"},
    {label:'High-value orders', sql:"SELECT c.name, o.total_amount, o.status\nFROM orders o\nJOIN customers c ON o.customer_id = c.id\nWHERE o.total_amount > 10000\nORDER BY o.total_amount DESC;"},
    {label:'Order details', sql:"SELECT o.id AS order_id,\n       c.name AS customer,\n       oi.product_name,\n       oi.quantity,\n       oi.unit_price,\n       (oi.quantity * oi.unit_price) AS line_total\nFROM orders o\nJOIN customers c ON o.customer_id = c.id\nJOIN order_items oi ON o.id = oi.order_id\nORDER BY o.id;"},
    {label:'Top employees by salary', sql:"SELECT first_name, last_name, salary,\n       d.name AS department\nFROM employees e\nJOIN departments d ON e.dept_id = d.id\nORDER BY salary DESC\nLIMIT 5;"}
];

function renderPresets() {
    var html = '';
    presets.forEach(function(p, i) {
        html += '<li onclick="loadPreset(' + i + ')">' + p.label + '</li>';
    });
    document.getElementById('presetList').innerHTML = html;
}

function loadPreset(i) {
    document.getElementById('sqlInput').value = presets[i].sql;
    executeQuery();
}

function tokenize(sql) {
    sql = sql.trim().replace(/;$/, '');
    var tokens = [];
    var i = 0;
    while (i < sql.length) {
        if (sql[i] === ' ') { i++; continue; }
        if (sql[i] === "'") {
            var j = i + 1;
            while (j < sql.length && sql[j] !== "'") j++;
            tokens.push(sql.substring(i + 1, j));
            i = j + 1;
        } else if (sql[i] === '(' || sql[i] === ')' || sql[i] === ',' || sql[i] === '*' || sql[i] === '=' || sql[i] === '>' || sql[i] === '<') {
            tokens.push(sql[i]); i++;
        } else if (sql[i] === '!' && sql[i+1] === '=') {
            tokens.push('!='); i += 2;
        } else if (sql[i] === '>' && sql[i+1] === '=') {
            tokens.push('>='); i += 2;
        } else if (sql[i] === '<' && sql[i+1] === '=') {
            tokens.push('<='); i += 2;
        } else {
            var j = i;
            while (j < sql.length && sql[j] !== ' ' && sql[j] !== '(' && sql[j] !== ')' && sql[j] !== ',' && sql[j] !== ';' && sql[j] !== '=' && sql[j] !== '>' && sql[j] !== '<' && sql[j] !== '!') j++;
            tokens.push(sql.substring(i, j).toUpperCase());
            i = j;
        }
    }
    return tokens;
}

function executeQuery() {
    var sql = document.getElementById('sqlInput').value.trim();
    if (!sql) return;
    try {
        var result = runSQL(sql);
        if (result.error) {
            document.getElementById('resultBody').innerHTML = '<div class="sql-error">Error: ' + result.error + '</div>';
            document.getElementById('resultMeta').textContent = '';
        } else if (result.message) {
            document.getElementById('resultBody').innerHTML = '<div class="sql-success">' + result.message + '</div>';
            document.getElementById('resultMeta').textContent = '';
        } else {
            var html = '<table class="sql-result-table"><thead><tr>';
            result.cols.forEach(function(c) { html += '<th>' + c + '</th>'; });
            html += '</tr></thead><tbody>';
            result.rows.forEach(function(row) {
                html += '<tr>';
                row.forEach(function(v) { html += '<td>' + (v === null ? '<span style="color:var(--text-muted);">NULL</span>' : v) + '</td>'; });
                html += '</tr>';
            });
            html += '</tbody></table>';
            document.getElementById('resultBody').innerHTML = html;
            document.getElementById('resultMeta').textContent = result.rows.length + ' row' + (result.rows.length !== 1 ? 's' : '');
        }
    } catch(e) {
        document.getElementById('resultBody').innerHTML = '<div class="sql-error">Error: ' + e.message + '</div>';
        document.getElementById('resultMeta').textContent = '';
    }
}

function runSQL(sql) {
    var tokens = tokenize(sql);
    if (!tokens.length) return {error:'Empty query'};
    var keyword = tokens[0];

    if (keyword === 'SELECT') return execSelect(tokens);
    if (keyword === 'INSERT') return execInsert(tokens);
    if (keyword === 'UPDATE') return execUpdate(tokens);
    if (keyword === 'DELETE') return execDelete(tokens);
    return {error:'Unsupported: ' + keyword};
}

function getTable(name) {
    name = name.toLowerCase();
    if (!db[name]) return null;
    return {name:name, cols:schema[name].cols, rows:db[name]};
}

function findColIdx(table, colName) {
    colName = colName.toLowerCase();
    var idx = table.cols.indexOf(colName);
    if (idx >= 0) return idx;
    for (var i = 0; i < table.cols.length; i++) {
        if (table.cols[i].toLowerCase() === colName) return i;
    }
    return -1;
}

function execSelect(tokens) {
    var i = 1;
    var selectCols = [];
    while (i < tokens.length && tokens[i] !== 'FROM') { selectCols.push(tokens[i]); i++; }
    if (tokens[i] !== 'FROM') return {error:'Missing FROM'};
    i++;
    var tableName = tokens[i].toLowerCase();
    var table = getTable(tableName);
    if (!table) return {error:'Unknown table: ' + tableName};
    i++;

    var whereFn = null;
    if (tokens[i] === 'WHERE') {
        i++;
        var cond = [];
        while (i < tokens.length && !['ORDER','GROUP','LIMIT','HAVING'].includes(tokens[i])) { cond.push(tokens[i]); i++; }
        whereFn = buildWhere(cond, table);
    }

    var groupBy = null;
    var havingFn = null;
    if (tokens[i] === 'GROUP') {
        i++; i++; // GROUP BY
        groupBy = [];
        while (i < tokens.length && tokens[i] !== 'HAVING' && tokens[i] !== 'ORDER' && tokens[i] !== 'LIMIT') { groupBy.push(tokens[i]); i++; }
        if (tokens[i] === 'HAVING') {
            i++;
            var hcond = [];
            while (i < tokens.length && tokens[i] !== 'ORDER' && tokens[i] !== 'LIMIT') { hcond.push(tokens[i]); i++; }
            havingFn = buildHaving(hcond, table, groupBy);
        }
    }

    var orderBy = null;
    if (tokens[i] === 'ORDER') {
        i++; i++; // ORDER BY
        orderBy = [];
        while (i < tokens.length && tokens[i] !== 'LIMIT') { orderBy.push(tokens[i]); i++; }
    }

    var limit = null;
    if (tokens[i] === 'LIMIT') { i++; limit = parseInt(tokens[i]); }

    var rows = table.rows.slice();
    if (whereFn) rows = rows.filter(function(r) { return whereFn(r); });

    if (groupBy) {
        var groups = {};
        rows.forEach(function(r) {
            var key = groupBy.map(function(g) { var ci = findColIdx(table, g); return ci >= 0 ? r[ci] : g; }).join('||');
            if (!groups[key]) groups[key] = [];
            groups[key].push(r);
        });
        rows = [];
        for (var key in groups) {
            var grp = groups[key];
            var outRow = [];
            var hasAgg = selectCols.some(function(c) { return /^(COUNT|SUM|AVG|MAX|MIN)\(/.test(c); });
            if (hasAgg) {
                selectCols.forEach(function(sc) {
                    var m = sc.match(/^(COUNT|SUM|AVG|MAX|MIN)\((\*|\w+)\)(?:\s+AS\s+(\w+))?$/i);
                    if (m) {
                        var fn = m[1].toUpperCase();
                        var col = m[2];
                        if (fn === 'COUNT') outRow.push(grp.length);
                        else if (fn === 'SUM') {
                            var ci = findColIdx(table, col);
                            outRow.push(ci >= 0 ? grp.reduce(function(a, r) { return a + (parseFloat(r[ci]) || 0); }, 0) : 0);
                        } else if (fn === 'AVG') {
                            var ci = findColIdx(table, col);
                            outRow.push(ci >= 0 ? Math.round(grp.reduce(function(a, r) { return a + (parseFloat(r[ci]) || 0); }, 0) / grp.length) : 0);
                        } else if (fn === 'MAX') {
                            var ci = findColIdx(table, col);
                            outRow.push(ci >= 0 ? Math.max.apply(null, grp.map(function(r) { return parseFloat(r[ci]) || 0; })) : 0);
                        } else if (fn === 'MIN') {
                            var ci = findColIdx(table, col);
                            outRow.push(ci >= 0 ? Math.min.apply(null, grp.map(function(r) { return parseFloat(r[ci]) || 0; })) : 0);
                        }
                    } else {
                        var ci = findColIdx(table, sc);
                        if (ci >= 0) outRow.push(grp[0][ci]);
                    }
                });
            } else {
                groupBy.forEach(function(g) { var ci = findColIdx(table, g); outRow.push(ci >= 0 ? grp[0][ci] : g); });
            }
            rows.push(outRow);
        }
        if (havingFn) rows = rows.filter(function(r) { return havingFn(r); });
    } else {
        var hasAgg = selectCols.some(function(c) { return /^(COUNT|SUM|AVG|MAX|MIN)\(/.test(c); });
        if (hasAgg) {
            var outRow = [];
            selectCols.forEach(function(sc) {
                var m = sc.match(/^(COUNT|SUM|AVG|MAX|MIN)\((\*|\w+)\)(?:\s+AS\s+(\w+))?$/i);
                if (m) {
                    var fn = m[1].toUpperCase();
                    var col = m[2];
                    if (fn === 'COUNT') outRow.push(rows.length);
                    else if (fn === 'SUM') {
                        var ci = findColIdx(table, col);
                        outRow.push(ci >= 0 ? rows.reduce(function(a, r) { return a + (parseFloat(r[ci]) || 0); }, 0) : 0);
                    } else if (fn === 'AVG') {
                        var ci = findColIdx(table, col);
                        outRow.push(ci >= 0 ? Math.round(rows.reduce(function(a, r) { return a + (parseFloat(r[ci]) || 0); }, 0) / rows.length) : 0);
                    } else if (fn === 'MAX') {
                        var ci = findColIdx(table, col);
                        outRow.push(ci >= 0 ? Math.max.apply(null, rows.map(function(r) { return parseFloat(r[ci]) || 0; })) : 0);
                    } else if (fn === 'MIN') {
                        var ci = findColIdx(table, col);
                        outRow.push(ci >= 0 ? Math.min.apply(null, rows.map(function(r) { return parseFloat(r[ci]) || 0; })) : 0);
                    }
                }
            });
            rows = [outRow];
        } else {
            rows = rows.map(function(r) {
                if (selectCols[0] === '*') return r;
                return selectCols.map(function(sc) { var ci = findColIdx(table, sc); return ci >= 0 ? r[ci] : null; });
            });
        }
    }

    if (orderBy) {
        for (var oi = orderBy.length - 1; oi >= 0; oi--) {
            var col = orderBy[oi];
            var desc = false;
            if (col.toUpperCase() === 'DESC') { desc = true; continue; }
            if (col.toUpperCase() === 'ASC') continue;
            var ci = -1;
            if (groupBy) { ci = groupBy.indexOf(col); }
            if (ci < 0) ci = findColIdx(table, col);
            if (ci >= 0) {
                (function(ci, desc) {
                    rows.sort(function(a, b) {
                        var va = a[ci], vb = b[ci];
                        if (typeof va === 'number' && typeof vb === 'number') return desc ? vb - va : va - vb;
                        va = String(va); vb = String(vb);
                        return desc ? vb.localeCompare(va) : va.localeCompare(vb);
                    });
                })(ci, desc);
            }
        }
    }

    if (limit) rows = rows.slice(0, limit);

    var outCols = [];
    if (groupBy) {
        if (selectCols[0] === '*') outCols = groupBy;
        else {
            outCols = selectCols.map(function(sc) {
                var m = sc.match(/^(?:COUNT|SUM|AVG|MAX|MIN)\(\*|\w+\)(?:\s+AS\s+(\w+))?$/i);
                if (m && m[1]) return m[1];
                var m2 = sc.match(/^(COUNT|SUM|AVG|MAX|MIN)\((\*|\w+)\)/i);
                if (m2) return m2[1].toLowerCase() + '_' + m2[2];
                return sc;
            });
        }
    } else {
        if (selectCols[0] === '*') outCols = table.cols;
        else outCols = selectCols.map(function(sc) {
            var m = sc.match(/^(?:COUNT|SUM|AVG|MAX|MIN)\(\*|\w+\)(?:\s+AS\s+(\w+))?$/i);
            if (m && m[1]) return m[1];
            return sc;
        });
    }

    return {cols:outCols, rows:rows};
}

function buildWhere(cond, table) {
    var col = cond[0];
    var op = cond[1];
    var val = cond[2];
    var ci = findColIdx(table, col);
    if (ci < 0) return null;
    return function(r) {
        var rv = r[ci];
        if (op === '=') return String(rv) === val.replace(/'/g, '');
        if (op === '!=') return String(rv) !== val.replace(/'/g, '');
        if (op === '>') return parseFloat(rv) > parseFloat(val);
        if (op === '<') return parseFloat(rv) < parseFloat(val);
        if (op === '>=') return parseFloat(rv) >= parseFloat(val);
        if (op === '<=') return parseFloat(rv) <= parseFloat(val);
        if (op === 'LIKE') {
            var pattern = val.replace(/'/g, '').replace(/%/g, '.*');
            return new RegExp('^' + pattern + '$', 'i').test(String(rv));
        }
        return true;
    };
}

function buildHaving(cond, table, groupBy) {
    var col = cond[0];
    var op = cond[1];
    var val = cond[2];
    return function(row) {
        var idx = -1;
        var m = col.match(/^(COUNT|SUM|AVG|MAX|MIN)\((\*|\w+)\)/i);
        if (m) idx = groupBy ? groupBy.indexOf(col) : -1;
        else idx = groupBy ? groupBy.indexOf(col) : findColIdx(table, col);
        if (idx < 0) idx = 0;
        var rv = parseFloat(row[idx]);
        if (op === '>') return rv > parseFloat(val);
        if (op === '<') return rv < parseFloat(val);
        if (op === '>=') return rv >= parseFloat(val);
        if (op === '<=') return rv <= parseFloat(val);
        if (op === '=') return rv === parseFloat(val);
        return true;
    };
}

function execInsert(tokens) {
    var i = 1; // INTO
    i++;
    var table = getTable(tokens[i]); i++;
    i++; // VALUES
    i++; // (
    var vals = [];
    while (i < tokens.length && tokens[i] !== ')') {
        if (tokens[i] !== ',') vals.push(tokens[i].replace(/'/g, ''));
        i++;
    }
    table.rows.push(vals);
    renderTableList();
    return {message:'Inserted 1 row into ' + table.name};
}

function execUpdate(tokens) {
    var i = 1;
    var table = getTable(tokens[i]); i++;
    if (tokens[i] !== 'SET') return {error:'Expected SET'};
    i++;
    var assignments = [];
    while (i < tokens.length && tokens[i] !== 'WHERE') {
        if (tokens[i] !== ',') {
            var col = tokens[i]; i++;
            var eq = tokens[i]; i++;
            var val = tokens[i].replace(/'/g, ''); i++;
            assignments.push({col:col, val:val});
        } else { i++; }
    }
    var count = 0;
    table.rows.forEach(function(r) {
        assignments.forEach(function(a) {
            var ci = findColIdx(table, a.col);
            if (ci >= 0) { r[ci] = isNaN(a.val) ? a.val : parseFloat(a.val); count++; }
        });
    });
    renderTableList();
    return {message:'Updated rows in ' + table.name};
}

function execDelete(tokens) {
    var i = 1; // FROM
    i++;
    var table = getTable(tokens[i]); i++;
    var before = table.rows.length;
    if (tokens[i] === 'WHERE') {
        i++;
        var cond = [];
        while (i < tokens.length) { cond.push(tokens[i]); i++; }
        var fn = buildWhere(cond, table);
        table.rows = table.rows.filter(function(r) { return !fn(r); });
    } else {
        table.rows = [];
    }
    renderTableList();
    return {message:'Deleted ' + (before - table.rows.length) + ' row(s) from ' + table.name};
}

document.getElementById('sqlInput').addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') { e.preventDefault(); executeQuery(); }
});

initDB();
renderTableList();
renderPresets();
</script>
</body>
</html>
