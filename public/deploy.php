<?php
$pageTitle = 'Deployment Guide';
require_once __DIR__ . '/../includes/header.php';
?>

<nav class="breadcrumbs">
    <a href="/">Home</a>
    <span class="sep">/</span>
    <span class="current">Deployment Guide</span>
</nav>

<div class="lesson-header">
    <h1>Deployment Guide</h1>
    <p class="lesson-desc">Step-by-step instructions for setting up and running LD TechLab on any computer.</p>
</div>

<div class="lesson-content">

<!-- Quick Start -->
<h2 id="quick-start">Quick Start (3 Steps)</h2>

<div style="background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-lg); padding:20px; margin:16px 0;">
    <p style="font-size:0.95em; color:var(--text-secondary); margin-bottom:16px;">If you already have the ZIP file, this is all you need:</p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:16px;">
        <div style="background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); padding:16px; text-align:center;">
            <div style="font-size:2em; font-weight:700; color:var(--accent);">1</div>
            <div style="font-weight:600; margin:8px 0;">Extract the ZIP</div>
            <div style="font-size:0.82em; color:var(--text-muted);">Unzip to any folder on your computer</div>
        </div>
        <div style="background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); padding:16px; text-align:center;">
            <div style="font-size:2em; font-weight:700; color:var(--accent);">2</div>
            <div style="font-weight:600; margin:8px 0;">Start the server</div>
            <div style="font-size:0.82em; color:var(--text-muted);">Double-click <code>start.command</code> (Mac) or <code>start.bat</code> (Windows)</div>
        </div>
        <div style="background:var(--bg-primary); border:1px solid var(--border); border-radius:var(--radius); padding:16px; text-align:center;">
            <div style="font-size:2em; font-weight:700; color:var(--accent);">3</div>
            <div style="font-weight:600; margin:8px 0;">Open your browser</div>
            <div style="font-size:0.82em; color:var(--text-muted);">Go to <code>http://localhost:8080</code></div>
        </div>
    </div>
</div>

<hr>

<!-- System Requirements -->
<h2 id="requirements">System Requirements</h2>

<table style="width:100%; border-collapse:collapse; margin:16px 0;">
    <thead>
        <tr>
            <th style="text-align:left; padding:10px; border-bottom:2px solid var(--border); color:var(--text-muted);">Component</th>
            <th style="text-align:left; padding:10px; border-bottom:2px solid var(--border); color:var(--text-muted);">Requirement</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border); font-weight:600;">Operating System</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">macOS, Windows 10+, Linux (Ubuntu/Debian/Fedora)</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border); font-weight:600;">Disk Space</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">~150 MB (with PHP binaries)</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border); font-weight:600;">RAM</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">512 MB minimum</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border); font-weight:600;">Internet</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Not required (fully offline)</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border); font-weight:600;">Browser</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Any modern browser (Chrome, Firefox, Safari, Edge)</td>
        </tr>
    </tbody>
</table>

<hr>

<!-- macOS Setup -->
<h2 id="macos">macOS Setup</h2>

<h3 id="macos-apple-silicon">Apple Silicon Macs (M1, M2, M3, M4)</h3>

<ol style="margin:12px 0; padding-left:24px; line-height:2;">
    <li>Extract the ZIP file to your desired location (e.g., Desktop)</li>
    <li>Open the extracted folder</li>
    <li>Double-click <code>start.command</code></li>
    <li>If prompted about security: <strong>Right-click</strong> &rarr; <strong>Open</strong> &rarr; <strong>Open</strong></li>
    <li>A terminal window will open with the server running</li>
    <li>Open your browser to <code>http://localhost:8080</code></li>
</ol>

<h3 id="macos-intel">Intel Macs</h3>

<p>The setup is the same as Apple Silicon. The correct PHP binary is auto-detected based on your Mac's processor.</p>

<div style="background:var(--bg-surface); border:1px solid var(--accent-yellow); border-radius:var(--radius); padding:14px 16px; margin:12px 0;">
    <strong style="color:var(--accent-yellow);">Security Warning?</strong>
    <p style="font-size:0.85em; color:var(--text-secondary); margin-top:4px;">macOS may block the app because it's from an unidentified developer. To fix:</p>
    <ol style="font-size:0.85em; color:var(--text-secondary); padding-left:20px; margin-top:8px; line-height:1.8;">
        <li>Go to <strong>System Settings</strong> &rarr; <strong>Privacy & Security</strong></li>
        <li>Scroll down and click <strong>Open Anyway</strong> next to the blocked message</li>
        <li>Enter your password to confirm</li>
    </ol>
</div>

<hr>

<!-- Windows Setup -->
<h2 id="windows">Windows Setup</h2>

<h3 id="windows-pre-built">Option A: Pre-built (PHP bundled)</h3>

<ol style="margin:12px 0; padding-left:24px; line-height:2;">
    <li>Extract the ZIP file</li>
    <li>Double-click <code>start.bat</code></li>
    <li>A command prompt will open with the server running</li>
    <li>Open your browser to <code>http://localhost:8080</code></li>
</ol>

<h3 id="windows-manual">Option B: Manual PHP Install</h3>

<p>If PHP isn't bundled in the <code>bin/</code> folder, you need to install it. Choose ONE method:</p>

<h4>Method 1: Winget (Easiest)</h4>
<div style="background:var(--bg-code); padding:12px 16px; border-radius:var(--radius); margin:12px 0;">
    <code style="color:var(--accent-green);">winget install PHP.PHP</code>
</div>
<p style="font-size:0.85em; color:var(--text-secondary);">Then restart your terminal and run <code>start.bat</code>.</p>

<h4>Method 2: Manual Download</h4>
<ol style="margin:12px 0; padding-left:24px; line-height:2; font-size:0.9em;">
    <li>Go to <a href="https://windows.php.net/download/" style="color:var(--accent);">https://windows.php.net/download/</a></li>
    <li>Under <strong>PHP 8.5</strong>, click <strong>Zip</strong> next to "VS17 x64 Non Thread Safe"</li>
    <li>Extract the ZIP to <code>C:\php</code></li>
    <li>Add <code>C:\php</code> to your system PATH:
        <ul style="margin-top:4px; font-size:0.9em;">
            <li>Press <kbd>Win</kbd> + <kbd>S</kbd>, search <strong>"Environment Variables"</strong></li>
            <li>Click <strong>"Edit the system environment variables"</strong></li>
            <li>Click <strong>"Environment Variables"</strong> button</li>
            <li>Under <strong>System variables</strong>, find <code>Path</code>, click <strong>Edit</strong></li>
            <li>Click <strong>New</strong>, type <code>C:\php</code>, click <strong>OK</strong></li>
        </ul>
    </li>
    <li>Double-click <code>start.bat</code></li>
</ol>

<h4>Method 3: Place php.exe in bin folder</h4>
<ol style="margin:12px 0; padding-left:24px; line-height:2; font-size:0.9em;">
    <li>Download PHP from <a href="https://windows.php.net/download/" style="color:var(--accent);">windows.php.net</a></li>
    <li>Extract <code>php.exe</code> from the ZIP</li>
    <li>Copy <code>php.exe</code> into the <code>bin\</code> folder of LD TechLab</li>
    <li>Run <code>start.bat</code></li>
</ol>

<h4>Method 4: Git Bash / WSL</h4>
<div style="background:var(--bg-code); padding:12px 16px; border-radius:var(--radius); margin:12px 0;">
    <code style="color:var(--accent-green);">./setup.sh</code>
</div>
<p style="font-size:0.85em; color:var(--text-secondary);">This auto-downloads PHP for your platform.</p>

<hr>

<!-- Linux Setup -->
<h2 id="linux">Linux Setup</h2>

<h3 id="linux-bundled">Using Bundled PHP</h3>

<ol style="margin:12px 0; padding-left:24px; line-height:2;">
    <li>Extract the ZIP file</li>
    <li>Open a terminal in the extracted folder</li>
    <li>Run: <code>./start.sh</code></li>
    <li>Open your browser to <code>http://localhost:8080</code></li>
</ol>

<h3 id="linux-manual">Using System PHP</h3>

<p>Alternatively, install PHP from your package manager:</p>

<div style="background:var(--bg-code); padding:12px 16px; border-radius:var(--radius); margin:12px 0; font-family:monospace; font-size:0.85em; line-height:1.8;">
    <div style="color:var(--text-muted);"># Ubuntu / Debian</div>
    <div style="color:var(--accent-green);">sudo apt update && sudo apt install php-cli</div>
    <br>
    <div style="color:var(--text-muted);"># Fedora</div>
    <div style="color:var(--accent-green);">sudo dnf install php-cli</div>
    <br>
    <div style="color:var(--text-muted);"># Arch Linux</div>
    <div style="color:var(--accent-green);">sudo pacman -S php</div>
</div>

<hr>

<!-- Network Setup -->
<h2 id="network">Network Setup (Multiple Students)</h2>

<p>If you want multiple students to access the server from their own devices on the same network:</p>

<h3 id="network-steps">Steps</h3>

<ol style="margin:12px 0; padding-left:24px; line-height:2;">
    <li>Find your computer's local IP address:
        <div style="background:var(--bg-code); padding:8px 12px; border-radius:var(--radius); margin:8px 0; font-family:monospace; font-size:0.85em;">
            <span style="color:var(--text-muted);"># macOS / Linux</span><br>
            <span style="color:var(--accent-green);">ifconfig | grep "inet " | grep -v 127.0.0.1</span><br><br>
            <span style="color:var(--text-muted);"># Windows</span><br>
            <span style="color:var(--accent-green);">ipconfig</span>
        </div>
    </li>
    <li>Edit <code>start.sh</code> or <code>start.bat</code> and change <code>127.0.0.1</code> to <code>0.0.0.0</code></li>
    <li>Restart the server</li>
    <li>Students open <code>http://YOUR-IP:8080</code> on their devices</li>
</ol>

<div style="background:var(--bg-surface); border:1px solid var(--accent-red); border-radius:var(--radius); padding:14px 16px; margin:12px 0;">
    <strong style="color:var(--accent-red);">Firewall Warning</strong>
    <p style="font-size:0.85em; color:var(--text-secondary); margin-top:4px;">You may need to allow port 8080 through your firewall for other devices to connect.</p>
</div>

<hr>

<!-- Customization -->
<h2 id="customize">Customization</h2>

<h3 id="change-port">Change the Port</h3>

<p>Edit <code>start.sh</code> (Mac/Linux) or <code>start.bat</code> (Windows) and change:</p>
<div style="background:var(--bg-code); padding:8px 12px; border-radius:var(--radius); margin:8px 0; font-family:monospace; font-size:0.85em;">
    <span style="color:var(--accent-red);">PORT=8080</span> &rarr; <span style="color:var(--accent-green);">PORT=3000</span>
</div>

<h3 id="change-content">Add Your Own Lessons</h3>

<ol style="margin:12px 0; padding-left:24px; line-height:2; font-size:0.9em;">
    <li>Create a new <code>.php</code> file in the appropriate folder (e.g., <code>lessons/</code>, <code>python-lessons/</code>)</li>
    <li>Follow the existing lesson file format</li>
    <li>The lesson will auto-appear in the sidebar and homepage</li>
</ol>

<h3 id="change-branding">Change Branding</h3>

<p>Edit <code>includes/header.php</code> and change the school/instructor name:</p>
<div style="background:var(--bg-code); padding:8px 12px; border-radius:var(--radius); margin:8px 0; font-family:monospace; font-size:0.85em;">
    LD <span style="color:var(--accent-green);">TechLab</span>
</div>

<hr>

<!-- Troubleshooting -->
<h2 id="troubleshooting">Troubleshooting</h2>

<table style="width:100%; border-collapse:collapse; margin:16px 0; font-size:0.9em;">
    <thead>
        <tr>
            <th style="text-align:left; padding:10px; border-bottom:2px solid var(--border); color:var(--text-muted); min-width:200px;">Problem</th>
            <th style="text-align:left; padding:10px; border-bottom:2px solid var(--border); color:var(--text-muted);">Solution</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">"Port 8080 already in use"</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Change PORT to another number (e.g., 8888) in start.sh/start.bat</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">"php not found" / "PHP is not installed"</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Run <code>./setup.sh</code> or install PHP from <a href="https://www.php.net/downloads" style="color:var(--accent);">php.net</a></td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">macOS: "unidentified developer"</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Right-click start.command &rarr; Open &rarr; Open. Or System Settings &rarr; Privacy & Security &rarr; Open Anyway</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Windows: "php is not recognized"</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Install PHP via <code>winget install PHP.PHP</code> or copy php.exe to bin\ folder</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Linux: "permission denied"</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Run <code>chmod +x start.sh && ./start.sh</code></td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Page shows 404</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Make sure you're accessing <code>localhost:8080</code> (not a file path)</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Code sandbox doesn't execute</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Ensure PHP binary has exec permissions. Run <code>chmod +x bin/php-*</code></td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Students can't connect</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Change 127.0.0.1 to 0.0.0.0 in start script. Check firewall settings.</td>
        </tr>
    </tbody>
</table>

<hr>

<!-- Stopping the Server -->
<h2 id="stop">Stopping the Server</h2>

<table style="width:100%; border-collapse:collapse; margin:16px 0; font-size:0.9em;">
    <thead>
        <tr>
            <th style="text-align:left; padding:10px; border-bottom:2px solid var(--border); color:var(--text-muted);">OS</th>
            <th style="text-align:left; padding:10px; border-bottom:2px solid var(--border); color:var(--text-muted);">How to Stop</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">macOS / Linux</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Press <kbd>Ctrl</kbd>+<kbd>C</kbd> in the terminal window</td>
        </tr>
        <tr>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Windows</td>
            <td style="padding:10px; border-bottom:1px solid var(--border);">Press <kbd>Ctrl</kbd>+<kbd>C</kbd> in the command prompt, or close the window</td>
        </tr>
    </tbody>
</table>

<hr>

<!-- File Structure -->
<h2 id="files">File Structure</h2>

<div style="background:var(--bg-code); padding:16px; border-radius:var(--radius); margin:16px 0; font-family:monospace; font-size:0.85em; line-height:1.8; overflow-x:auto;">
<pre style="margin:0; color:var(--text-primary);">LD-TechLab/
├── bin/                    <span style="color:var(--text-muted);">PHP binaries (auto-detected per OS)</span>
│   ├── php-macos-arm64     <span style="color:var(--text-muted);">Apple Silicon Macs</span>
│   ├── php-macos-x86_64    <span style="color:var(--text-muted);">Intel Macs</span>
│   └── php-linux-x86_64    <span style="color:var(--text-muted);">Linux PCs</span>
├── public/                 <span style="color:var(--text-muted);">Web root (served by PHP)</span>
│   ├── index.php           <span style="color:var(--text-muted);">Dashboard homepage</span>
│   ├── css/style.css       <span style="color:var(--text-muted);">All styles</span>
│   ├── js/app.js           <span style="color:var(--text-muted);">JavaScript</span>
│   ├── status.php          <span style="color:var(--text-muted);">System status page</span>
│   ├── deploy.php          <span style="color:var(--text-muted);">This guide</span>
│   ├── demo/               <span style="color:var(--text-muted);">7 interactive demos</span>
│   └── router.php          <span style="color:var(--text-muted);">URL routing</span>
├── lessons/                <span style="color:var(--text-muted);">16 PHP lessons</span>
├── python-lessons/         <span style="color:var(--text-muted);">12 Python lessons</span>
├── java-lessons/           <span style="color:var(--text-muted);">12 Java lessons</span>
├── dsa-lessons/            <span style="color:var(--text-muted);">12 DSA lessons</span>
├── dbms-lessons/           <span style="color:var(--text-muted);">10 DBMS lessons</span>
├── mysql-lessons/          <span style="color:var(--text-muted);">10 MySQL lessons</span>
├── programming-logic/      <span style="color:var(--text-muted);">12 Logic lessons</span>
├── sandbox/                <span style="color:var(--text-muted);">Code execution engines</span>
├── includes/               <span style="color:var(--text-muted);">Shared PHP (header, footer, functions)</span>
├── start.sh                <span style="color:var(--text-muted);">Start server (Mac/Linux)</span>
├── start.command           <span style="color:var(--text-muted);">Start server (Mac double-click)</span>
├── start.bat               <span style="color:var(--text-muted);">Start server (Windows)</span>
├── setup.sh                <span style="color:var(--text-muted);">Auto-download PHP</span>
└── build-dist.sh           <span style="color:var(--text-muted);">Build distribution ZIP</span></pre>
</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
