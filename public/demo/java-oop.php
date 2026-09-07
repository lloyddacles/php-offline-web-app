<?php
/**
 * Java Demo - OOP Class Designer
 * Design classes and see generated Java code + class diagram
 */
$demoTitle = 'Java OOP Designer';
$demoIcon = '&#9749;';
$demoColor = '#fab387';
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
        .oop-layout { display: grid; grid-template-columns: 350px 1fr; gap: 20px; }
        .oop-form { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; }
        .oop-form h3 { font-size: 1em; margin: 0 0 16px 0; color: var(--text-bright); }
        .form-row { margin-bottom: 12px; }
        .form-row label { display: block; font-size: 0.8em; color: var(--text-muted); margin-bottom: 4px; font-weight: 500; }
        .form-row input, .form-row select { width: 100%; padding: 8px 10px; background: var(--bg-primary); border: 1px solid var(--border); border-radius: var(--radius); color: var(--text-primary); font-size: 0.88em; font-family: inherit; }
        .form-row input:focus, .form-row select:focus { outline: none; border-color: var(--accent); }
        .field-list { list-style: none; margin: 8px 0; }
        .field-item { display: flex; justify-content: space-between; align-items: center; padding: 6px 10px; background: var(--bg-primary); border-radius: var(--radius); margin-bottom: 4px; font-size: 0.85em; }
        .field-item .field-type { color: var(--accent); font-family: monospace; }
        .field-item .field-name { color: var(--text-primary); font-family: monospace; }
        .field-item button { background: none; border: none; color: var(--accent-red); cursor: pointer; font-size: 0.9em; padding: 2px 6px; }
        .oop-output { display: flex; flex-direction: column; gap: 16px; }
        .class-diagram { background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; text-align: center; }
        .class-box { display: inline-block; background: var(--bg-primary); border: 2px solid var(--accent); border-radius: var(--radius); min-width: 250px; text-align: left; }
        .class-box-header { background: var(--accent); color: var(--bg-primary); padding: 10px 16px; font-weight: 700; text-align: center; border-radius: 4px 4px 0 0; }
        .class-box-section { padding: 8px 16px; border-bottom: 1px solid var(--border); }
        .class-box-section:last-child { border: none; }
        .class-box-section .section-label { font-size: 0.7em; color: var(--text-muted); text-transform: uppercase; margin-bottom: 4px; }
        .class-box-section .field-line { font-family: monospace; font-size: 0.82em; padding: 2px 0; color: var(--text-primary); }
        .class-box-section .field-line .vis { color: var(--accent-red); }
        .class-box-section .field-line .type { color: var(--accent-green); }
        .java-code { background: var(--bg-code); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; flex: 1; }
        .java-code-header { padding: 10px 16px; background: var(--bg-active); border-bottom: 1px solid var(--border); font-size: 0.85em; font-weight: 600; }
        .java-code-body { padding: 16px; font-family: 'SF Mono', monospace; font-size: 0.85em; line-height: 1.7; color: var(--text-primary); white-space: pre-wrap; overflow-x: auto; max-height: 400px; overflow-y: auto; }
        .preset-btns { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px; }
        .preset-btn { padding: 6px 12px; border-radius: var(--radius); border: 1px solid var(--border); background: var(--bg-surface); color: var(--text-primary); cursor: pointer; font-size: 0.8em; transition: all 0.15s; }
        .preset-btn:hover { border-color: var(--accent); }
        @media (max-width: 900px) { .oop-layout { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="demo-layout">
        <div class="demo-content" style="margin-left:0; max-width:1200px;">
            <div class="demo-page-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h1><?= $demoIcon ?> <?= $demoTitle ?></h1>
                    <p>Design Java classes visually. See the class diagram and generated code.</p>
                </div>
                <a href="/" class="btn btn-outline" style="flex-shrink:0;">&larr; Back</a>
            </div>

            <div class="preset-btns">
                <button class="preset-btn" onclick="loadPreset('animal')">Animal Hierarchy</button>
                <button class="preset-btn" onclick="loadPreset('vehicle')">Vehicle System</button>
                <button class="preset-btn" onclick="loadPreset('shape')">Shape Classes</button>
                <button class="preset-btn" onclick="loadPreset('employee')">Employee System</button>
            </div>

            <div class="oop-layout">
                <div class="oop-form">
                    <h3>Class Designer</h3>
                    <div class="form-row">
                        <label>Class Name</label>
                        <input type="text" id="className" value="Student" oninput="updateOutput()">
                    </div>
                    <div class="form-row">
                        <label>Parent Class (extends)</label>
                        <input type="text" id="parentClass" value="" placeholder="None" oninput="updateOutput()">
                    </div>
                    <div class="form-row">
                        <label>Add Field</label>
                        <div style="display:flex; gap:6px;">
                            <select id="fieldVis" style="width:80px;"><option value="-">-</option><option value="+">+</option><option value="#">#</option><option value="-">-</option></select>
                            <select id="fieldType" style="width:100px;"><option>String</option><option>int</option><option>double</option><option>boolean</option><option>Student[]</option></select>
                            <input type="text" id="fieldName" placeholder="name" style="flex:1;">
                            <button class="btn btn-primary" onclick="addField()" style="padding:6px 12px;">+</button>
                        </div>
                    </div>
                    <div id="fieldList"></div>
                    <div class="form-row">
                        <label>Add Method</label>
                        <div style="display:flex; gap:6px;">
                            <select id="methodVis" style="width:80px;"><option value="+">+</option><option value="#">#</option><option value="-">-</option></select>
                            <input type="text" id="methodType" placeholder="void" style="width:80px;">
                            <input type="text" id="methodName" placeholder="getName" style="flex:1;">
                            <button class="btn btn-primary" onclick="addMethod()" style="padding:6px 12px;">+</button>
                        </div>
                    </div>
                    <div id="methodList"></div>
                </div>
                <div class="oop-output">
                    <div class="class-diagram">
                        <h3 style="margin:0 0 12px 0; font-size:0.9em; color:var(--text-muted);">Class Diagram</h3>
                        <div id="diagramArea"></div>
                    </div>
                    <div class="java-code">
                        <div class="java-code-header">Generated Java Code</div>
                        <div class="java-code-body" id="codeOutput"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
var fields = [];
var methods = [];

function addField() {
    var vis = document.getElementById('fieldVis').value;
    var type = document.getElementById('fieldType').value;
    var name = document.getElementById('fieldName').value.trim();
    if (!name) return;
    fields.push({vis:vis, type:type, name:name});
    document.getElementById('fieldName').value = '';
    updateOutput();
}

function addMethod() {
    var vis = document.getElementById('methodVis').value;
    var type = document.getElementById('methodType').value.trim() || 'void';
    var name = document.getElementById('methodName').value.trim();
    if (!name) return;
    methods.push({vis:vis, type:type, name:name});
    document.getElementById('methodName').value = '';
    updateOutput();
}

function removeField(i) { fields.splice(i,1); updateOutput(); }
function removeMethod(i) { methods.splice(i,1); updateOutput(); }

function updateOutput() {
    var cn = document.getElementById('className').value || 'MyClass';
    var pn = document.getElementById('parentClass').value;

    // Render field/method lists
    var fhtml = '';
    fields.forEach(function(f,i) { fhtml += '<div class="field-item"><span><span class="field-type">' + f.vis + ' ' + f.type + '</span> <span class="field-name">' + f.name + '</span></span><button onclick="removeField(' + i + ')">&times;</button></div>'; });
    document.getElementById('fieldList').innerHTML = fhtml;
    var mhtml = '';
    methods.forEach(function(m,i) { mhtml += '<div class="field-item"><span><span class="field-type">' + m.vis + ' ' + m.type + '()</span> <span class="field-name">' + m.name + '()</span></span><button onclick="removeMethod(' + i + ')">&times;</button></div>'; });
    document.getElementById('methodList').innerHTML = mhtml;

    // Diagram
    var dhtml = '<div class="class-box"><div class="class-box-header">' + cn + '</div>';
    if (fields.length) {
        dhtml += '<div class="class-box-section"><div class="section-label">Fields</div>';
        fields.forEach(function(f) { dhtml += '<div class="field-line"><span class="vis">' + f.vis + '</span> <span class="type">' + f.type + '</span> ' + f.name + '</div>'; });
        dhtml += '</div>';
    }
    if (methods.length) {
        dhtml += '<div class="class-box-section"><div class="section-label">Methods</div>';
        methods.forEach(function(m) { dhtml += '<div class="field-line"><span class="vis">' + m.vis + '</span> <span class="type">' + m.type + '</span> ' + m.name + '()</div>'; });
        dhtml += '</div>';
    }
    dhtml += '</div>';
    document.getElementById('diagramArea').innerHTML = dhtml;

    // Java code
    var code = 'public class ' + cn;
    if (pn) code += ' extends ' + pn;
    code += ' {\n\n';
    fields.forEach(function(f) {
        var v = f.vis === '+' ? 'public' : f.vis === '#' ? 'protected' : 'private';
        code += '    ' + v + ' ' + f.type + ' ' + f.name + ';\n';
    });
    if (fields.length) code += '\n';
    // Constructor
    code += '    public ' + cn + '(';
    var params = fields.map(function(f) { return f.type + ' ' + f.name; });
    code += params.join(', ');
    code += ') {\n';
    if (pn) code += '        super();\n';
    fields.forEach(function(f) { code += '        this.' + f.name + ' = ' + f.name + ';\n'; });
    code += '    }\n\n';
    // Getters/Setters
    fields.forEach(function(f) {
        var cap = f.name.charAt(0).toUpperCase() + f.name.slice(1);
        code += '    public ' + f.type + ' get' + cap + '() {\n        return this.' + f.name + ';\n    }\n\n';
        code += '    public void set' + cap + '(' + f.type + ' ' + f.name + ') {\n        this.' + f.name + ' = ' + f.name + ';\n    }\n\n';
    });
    // Methods
    methods.forEach(function(m) {
        var v = m.vis === '+' ? 'public' : m.vis === '#' ? 'protected' : 'private';
        code += '    ' + v + ' ' + m.type + ' ' + m.name + '() {\n';
        if (m.type !== 'void') code += '        // TODO: implement\n        return null;\n';
        else code += '        // TODO: implement\n';
        code += '    }\n\n';
    });
    code += '}';
    document.getElementById('codeOutput').textContent = code;
}

var presets = {
    animal: { name:'Animal', parent:'', fields:[{vis:'-',type:'String',name:'name'},{vis:'-',type:'int',name:'age'}], methods:[{vis:'+',type:'void',name:'speak'},{vis:'+',type:'String',name:'getName'}] },
    vehicle: { name:'Vehicle', parent:'', fields:[{vis:'-',type:'String',name:'make'},{vis:'-',type:'String',name:'model'},{vis:'-',type:'int',name:'year'}], methods:[{vis:'+',type:'void',name:'start'},{vis:'+',type:'String',name:'getInfo'}] },
    shape: { name:'Shape', parent:'', fields:[{vis:'-',type:'String',name:'color'}], methods:[{vis:'+',type:'double',name:'getArea'},{vis:'+',type:'double',name:'getPerimeter'}] },
    employee: { name:'Employee', parent:'', fields:[{vis:'-',type:'String',name:'name'},{vis:'-',type:'double',name:'salary'},{vis:'-',type:'String',name:'department'}], methods:[{vis:'+',type:'void',name:'work'},{vis:'+',type:'double',name:'calculateBonus'}] }
};

function loadPreset(key) {
    var p = presets[key];
    document.getElementById('className').value = p.name;
    document.getElementById('parentClass').value = p.parent;
    fields = JSON.parse(JSON.stringify(p.fields));
    methods = JSON.parse(JSON.stringify(p.methods));
    updateOutput();
}

updateOutput();
</script>
</body>
</html>
