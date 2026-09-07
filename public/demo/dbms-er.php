<?php
/**
 * DBMS Demo - ER Diagram Designer
 * Create entities and relationships visually
 */
$demoTitle = 'ER Diagram Designer';
$demoIcon = '&#128202;';
$demoColor = '#89b4fa';
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
        .er-layout { display: grid; grid-template-columns: 300px 1fr; gap: 20px; }
        .er-sidebar { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; }
        .er-sidebar h3 { font-size: 1em; margin: 0 0 12px 0; color: var(--text-bright); }
        .er-canvas { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); position: relative; min-height: 500px; overflow: auto; }
        .er-canvas svg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; }
        .er-entity { position: absolute; background: var(--bg-primary); border: 2px solid var(--accent); border-radius: var(--radius); cursor: move; user-select: none; min-width: 160px; z-index: 2; }
        .er-entity-header { background: var(--accent); color: var(--bg-primary); padding: 8px 12px; font-weight: 700; font-size: 0.9em; text-align: center; border-radius: 4px 4px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .er-entity-header button { background: none; border: none; color: var(--bg-primary); cursor: pointer; font-size: 1.1em; opacity: 0.7; }
        .er-entity-header button:hover { opacity: 1; }
        .er-entity-fields { padding: 8px 12px; }
        .er-entity-fields .ef { font-size: 0.8em; padding: 3px 0; display: flex; justify-content: space-between; border-bottom: 1px solid var(--border); }
        .er-entity-fields .ef:last-child { border: none; }
        .er-entity-fields .ef .pk { color: var(--accent-yellow); font-weight: 600; }
        .er-entity-fields .ef .fk { color: var(--accent-mauve); }
        .er-entity-fields .ef .del { background: none; border: none; color: var(--accent-red); cursor: pointer; font-size: 0.85em; padding: 0 4px; opacity: 0; transition: opacity 0.15s; }
        .er-entity-fields:hover .ef .del { opacity: 1; }
        .er-add-btn { width: 100%; margin-top: 8px; }
        .er-rel { position: absolute; padding: 6px 14px; background: var(--bg-primary); border: 2px solid var(--accent-mauve); border-radius: var(--radius); font-size: 0.8em; color: var(--accent-mauve); font-weight: 600; cursor: move; user-select: none; z-index: 2; white-space: nowrap; }
        .er-rel button { background: none; border: none; color: var(--accent-red); cursor: pointer; font-size: 0.9em; margin-left: 6px; }
        .er-toolbar { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 12px; }
        .er-toolbar .btn { font-size: 0.8em; padding: 6px 10px; }
        .er-sql-output { background: var(--bg-code); padding: 16px; border-radius: var(--radius); font-family: monospace; font-size: 0.85em; color: var(--accent-green); white-space: pre-wrap; max-height: 200px; overflow-y: auto; margin-top: 12px; }
        .field-input-row { display: flex; gap: 4px; margin-top: 8px; }
        .field-input-row input, .field-input-row select { padding: 5px 8px; background: var(--bg-primary); border: 1px solid var(--border); border-radius: var(--radius); color: var(--text-primary); font-size: 0.82em; }
        @media (max-width: 800px) { .er-layout { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="demo-layout">
        <div class="demo-content" style="margin-left:0; max-width:1200px;">
            <div class="demo-page-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h1><?= $demoIcon ?> <?= $demoTitle ?></h1>
                    <p>Design database entities, attributes, and relationships. Generate DDL SQL.</p>
                </div>
                <a href="/" class="btn btn-outline" style="flex-shrink:0;">&larr; Back</a>
            </div>

            <div class="er-toolbar">
                <button class="btn btn-outline" onclick="loadPreset('school')">School DB</button>
                <button class="btn btn-outline" onclick="loadPreset('ecommerce')">E-Commerce</button>
                <button class="btn btn-outline" onclick="loadPreset('hospital')">Hospital</button>
                <button class="btn btn-primary" onclick="generateSQL()">Generate SQL</button>
                <button class="btn btn-outline" onclick="clearAll()">Clear All</button>
            </div>

            <div class="er-layout">
                <div class="er-sidebar">
                    <h3>Add Entity</h3>
                    <div style="margin-bottom:12px;">
                        <input type="text" id="newEntityName" placeholder="Entity name" style="width:100%; padding:7px 10px; background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); color:var(--text-primary); font-size:0.88em;">
                        <button class="btn btn-primary er-add-btn" onclick="addEntity()">+ Entity</button>
                    </div>

                    <h3>Add Relationship</h3>
                    <div style="margin-bottom:12px;">
                        <select id="relFrom" style="width:100%; margin-bottom:6px; padding:6px; background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); color:var(--text-primary); font-size:0.85em;"></select>
                        <select id="relType" style="width:100%; margin-bottom:6px; padding:6px; background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); color:var(--text-primary); font-size:0.85em;">
                            <option value="1:1">1 : 1</option>
                            <option value="1:N" selected>1 : N</option>
                            <option value="M:N">M : N</option>
                        </select>
                        <select id="relTo" style="width:100%; margin-bottom:6px; padding:6px; background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); color:var(--text-primary); font-size:0.85em;"></select>
                        <button class="btn btn-primary er-add-btn" onclick="addRelationship()">+ Relationship</button>
                    </div>

                    <h3>Selected Entity</h3>
                    <div id="fieldPanel">
                        <p style="font-size:0.82em; color:var(--text-muted);">Click an entity to edit fields.</p>
                    </div>
                </div>

                <div>
                    <div class="er-canvas" id="canvas" ondrop="drop(event)" ondragover="event.preventDefault()"></div>
                    <div class="er-sql-output" id="sqlOutput">-- Click "Generate SQL" to create DDL statements</div>
                </div>
            </div>
        </div>
    </div>

<script>
var entities = {};
var relationships = [];
var selectedEntity = null;
var entityIdCounter = 0;

function addEntity(name, fields) {
    name = name || document.getElementById('newEntityName').value.trim();
    if (!name) return;
    document.getElementById('newEntityName').value = '';
    var id = 'e' + (++entityIdCounter);
    entities[id] = {
        name: name,
        fields: fields || [{name:'id', type:'INT', pk:true}],
        x: 30 + (Object.keys(entities).length % 3) * 200,
        y: 30 + Math.floor(Object.keys(entities).length / 3) * 120
    };
    renderAll();
    updateRelSelects();
}

function removeEntity(id) {
    delete entities[id];
    relationships = relationships.filter(function(r){ return r.from !== id && r.to !== id; });
    if (selectedEntity === id) selectedEntity = null;
    renderAll();
    updateRelSelects();
}

function addFieldToEntity(entityId) {
    if (!entityId) return;
    entities[entityId].fields.push({name:'new_field', type:'VARCHAR(255)', pk:false});
    renderAll();
}

function removeField(eid, fi) {
    entities[eid].fields.splice(fi, 1);
    renderAll();
}

function addRelationship() {
    var from = document.getElementById('relFrom').value;
    var to = document.getElementById('relTo').value;
    var type = document.getElementById('relType').value;
    if (!from || !to || from === to) return;
    var fromName = entities[from].name;
    var toName = entities[to].name;
    relationships.push({
        from: from, to: to, type: type,
        label: fromName + '_' + toName,
        x: (entities[from].x + entities[to].x) / 2 + 80,
        y: (entities[from].y + entities[to].y) / 2 + 40
    });
    renderAll();
}

function removeRelationship(i) {
    relationships.splice(i, 1);
    renderAll();
}

function updateRelSelects() {
    var html = '';
    var keys = Object.keys(entities);
    keys.forEach(function(k) { html += '<option value="' + k + '">' + entities[k].name + '</option>'; });
    document.getElementById('relFrom').innerHTML = html;
    document.getElementById('relTo').innerHTML = html;
}

function selectEntity(id) {
    selectedEntity = id;
    var e = entities[id];
    var html = '<p style="font-size:0.85em; font-weight:600; margin-bottom:8px;">' + e.name + '</p>';
    e.fields.forEach(function(f, i) {
        html += '<div style="display:flex; gap:4px; margin-bottom:4px; align-items:center;">';
        html += '<input type="text" value="' + f.name + '" onchange="entities[\'' + id + '\'].fields[' + i + '].name=this.value; renderAll();" style="flex:1; padding:4px 6px; background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); color:var(--text-primary); font-size:0.82em;">';
        html += '<select onchange="entities[\'' + id + '\'].fields[' + i + '].type=this.value; renderAll();" style="width:90px; padding:4px; background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); color:var(--text-primary); font-size:0.82em;">';
        ['INT','VARCHAR(255)','TEXT','DECIMAL(10,2)','DATE','BOOLEAN','FLOAT','BIGINT','DATETIME'].forEach(function(t) {
            html += '<option value="' + t + '"' + (f.type===t?' selected':'') + '>' + t + '</option>';
        });
        html += '</select>';
        html += '<label style="font-size:0.75em; color:var(--text-muted);"><input type="checkbox"' + (f.pk?' checked':'') + ' onchange="entities[\'' + id + '\'].fields[' + i + '].pk=this.checked; renderAll();"> PK</label>';
        html += '<button onclick="removeField(\'' + id + '\',' + i + ')" style="background:none; border:none; color:var(--accent-red); cursor:pointer; font-size:0.9em;">&times;</button>';
        html += '</div>';
    });
    html += '<button class="btn btn-outline" style="margin-top:8px; font-size:0.8em; width:100%;" onclick="addFieldToEntity(\'' + id + '\')">+ Field</button>';
    document.getElementById('fieldPanel').innerHTML = html;
    renderAll();
}

function renderAll() {
    var canvas = document.getElementById('canvas');
    var svgLines = '<svg xmlns="http://www.w3.org/2000/svg">';
    var html = '';
    var keys = Object.keys(entities);

    keys.forEach(function(k) {
        var e = entities[k];
        var selected = k === selectedEntity;
        html += '<div class="er-entity" style="left:' + e.x + 'px; top:' + e.y + 'px; border-color:' + (selected?'var(--accent-mauve)':'var(--accent)') + ';" draggable="true" ondragstart="event.dataTransfer.setData(\'' + k + '\',\'\')" onmousedown="selectEntity(\'' + k + '\')">';
        html += '<div class="er-entity-header"><span>' + e.name + '</span><button onclick="event.stopPropagation(); removeEntity(\'' + k + '\')">&times;</button></div>';
        html += '<div class="er-entity-fields">';
        e.fields.forEach(function(f) {
            html += '<div class="ef"><span>' + (f.pk?'<span class="pk">PK</span> ':'') + f.name + ' <span style="color:var(--text-muted);">' + f.type + '</span></span></div>';
        });
        html += '</div></div>';
    });

    relationships.forEach(function(r, i) {
        var fe = entities[r.from];
        var te = entities[r.to];
        if (!fe || !te) return;
        var fx = fe.x + 80, fy = fe.y + 30;
        var tx = te.x + 80, ty = te.y + 30;
        svgLines += '<line x1="' + fx + '" y1="' + fy + '" x2="' + tx + '" y2="' + ty + '" stroke="#cdd6f4" stroke-width="2" stroke-dasharray="5,3"/>';
        html += '<div class="er-rel" style="left:' + r.x + 'px; top:' + r.y + 'px;">' + r.type + ' ' + r.label + '<button onclick="removeRelationship(' + i + ')">&times;</button></div>';
    });

    svgLines += '</svg>';
    canvas.innerHTML = svgLines + html;
}

function generateSQL() {
    var sql = '-- Generated DDL for ER Diagram\n\n';
    Object.keys(entities).forEach(function(k) {
        var e = entities[k];
        sql += 'CREATE TABLE ' + e.name + ' (\n';
        var pks = [];
        e.fields.forEach(function(f, i) {
            var line = '    ' + f.name + ' ' + f.type;
            if (f.pk) pks.push(f.name);
            if (i < e.fields.length - 1 || pks.length) line += ',';
            sql += line + '\n';
        });
        if (pks.length) sql += '    PRIMARY KEY (' + pks.join(', ') + ')\n';
        sql += ');\n\n';
    });

    relationships.forEach(function(r) {
        if (r.type === '1:N') {
            var te = entities[r.to];
            var fkField = entities[r.from].name.toLowerCase() + '_id';
            sql += 'ALTER TABLE ' + te.name + ' ADD COLUMN ' + fkField + ' INT;\n';
            sql += 'ALTER TABLE ' + te.name + ' ADD FOREIGN KEY (' + fkField + ') REFERENCES ' + entities[r.from].name + '(id);\n\n';
        } else if (r.type === 'M:N') {
            var tname = entities[r.from].name + '_' + entities[r.to].name;
            sql += 'CREATE TABLE ' + tname + ' (\n';
            sql += '    ' + entities[r.from].name.toLowerCase() + '_id INT,\n';
            sql += '    ' + entities[r.to].name.toLowerCase() + '_id INT,\n';
            sql += '    PRIMARY KEY (' + entities[r.from].name.toLowerCase() + '_id, ' + entities[r.to].name.toLowerCase() + '_id),\n';
            sql += '    FOREIGN KEY (' + entities[r.from].name.toLowerCase() + '_id) REFERENCES ' + entities[r.from].name + '(id),\n';
            sql += '    FOREIGN KEY (' + entities[r.to].name.toLowerCase() + '_id) REFERENCES ' + entities[r.to].name + '(id)\n';
            sql += ');\n\n';
        }
    });

    document.getElementById('sqlOutput').textContent = sql;
}

function clearAll() {
    entities = {}; relationships = []; selectedEntity = null; entityIdCounter = 0;
    renderAll(); updateRelSelects();
    document.getElementById('fieldPanel').innerHTML = '<p style="font-size:0.82em; color:var(--text-muted);">Click an entity to edit fields.</p>';
    document.getElementById('sqlOutput').textContent = '-- Click "Generate SQL" to create DDL statements';
}

var presets = {
    school: function() {
        clearAll();
        addEntity('Student', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(255)',pk:false},{name:'email',type:'VARCHAR(255)',pk:false},{name:'enrolled_date',type:'DATE',pk:false}]);
        addEntity('Course', [{name:'id',type:'INT',pk:true},{name:'title',type:'VARCHAR(255)',pk:false},{name:'credits',type:'INT',pk:false}]);
        addEntity('Instructor', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(255)',pk:false},{name:'department',type:'VARCHAR(100)',pk:false}]);
        var keys = Object.keys(entities);
        document.getElementById('relFrom').value = keys[0];
        document.getElementById('relTo').value = keys[1];
        document.getElementById('relType').value = 'M:N';
        addRelationship();
        document.getElementById('relFrom').value = keys[2];
        document.getElementById('relTo').value = keys[1];
        document.getElementById('relType').value = '1:N';
        addRelationship();
    },
    ecommerce: function() {
        clearAll();
        addEntity('Customer', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(255)',pk:false},{name:'email',type:'VARCHAR(255)',pk:false}]);
        addEntity('Product', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(255)',pk:false},{name:'price',type:'DECIMAL(10,2)',pk:false},{name:'stock',type:'INT',pk:false}]);
        addEntity('Order', [{name:'id',type:'INT',pk:true},{name:'order_date',type:'DATETIME',pk:false},{name:'total',type:'DECIMAL(10,2)',pk:false}]);
        addEntity('Category', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(100)',pk:false}]);
        var keys = Object.keys(entities);
        document.getElementById('relFrom').value = keys[0];
        document.getElementById('relTo').value = keys[2];
        document.getElementById('relType').value = '1:N';
        addRelationship();
        document.getElementById('relFrom').value = keys[1];
        document.getElementById('relTo').value = keys[2];
        document.getElementById('relType').value = 'M:N';
        addRelationship();
        document.getElementById('relFrom').value = keys[3];
        document.getElementById('relTo').value = keys[1];
        document.getElementById('relType').value = '1:N';
        addRelationship();
    },
    hospital: function() {
        clearAll();
        addEntity('Patient', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(255)',pk:false},{name:'dob',type:'DATE',pk:false},{name:'gender',type:'VARCHAR(10)',pk:false}]);
        addEntity('Doctor', [{name:'id',type:'INT',pk:true},{name:'name',type:'VARCHAR(255)',pk:false},{name:'specialty',type:'VARCHAR(100)',pk:false}]);
        addEntity('Appointment', [{name:'id',type:'INT',pk:true},{name:'date',type:'DATETIME',pk:false},{name:'reason',type:'TEXT',pk:false}]);
        var keys = Object.keys(entities);
        document.getElementById('relFrom').value = keys[0];
        document.getElementById('relTo').value = keys[2];
        document.getElementById('relType').value = '1:N';
        addRelationship();
        document.getElementById('relFrom').value = keys[1];
        document.getElementById('relTo').value = keys[2];
        document.getElementById('relType').value = '1:N';
        addRelationship();
    }
};

function loadPreset(key) { presets[key](); }

renderAll();
</script>
</body>
</html>
