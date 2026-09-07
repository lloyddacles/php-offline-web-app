# LD TechLab - Distribution Guide

## For the Distributor (You)

### Building the Distribution ZIP

1. Make sure PHP binaries are in the `bin/` folder:
   - `php-macos-arm64` (Apple Silicon Macs)
   - `php-macos-x86_64` (Intel Macs)
   - `php-linux-x86_64` (Linux PCs)

2. Run the build script:
   ```bash
   ./build-dist.sh
   ```

3. Share the generated ZIP from `/tmp/` with your co-teachers.

---

## For Teachers (Recipients)

### Quick Start

1. **Extract** the ZIP file to any folder (e.g., `Desktop/LD-TechLab`)

2. **Start the server**:

   | OS | How to Start |
   |---|---|
   | **macOS** | Double-click `start.command` |
   | **Linux** | Open terminal, run `./start.sh` |
   | **Windows** | Double-click `start.bat` |

3. **Open your browser** to `http://localhost:8080`

4. **Start teaching!**

### What's Included

- **84 interactive lessons** across 7 subjects
  - Programming Logic, PHP, Python, Java, DSA, DBMS, MySQL
- **7 interactive demos** for in-class demonstrations
  - Student Portal, Algorithm Tracer, Python Data Lab
  - Java OOP Designer, Sorting Visualizer
  - ER Diagram Designer, SQL Playground
- **Live code sandboxes** for PHP, Python, and Java
- **All files run offline** - no internet required

### Requirements

- **macOS**: Nothing extra needed (PHP is bundled)
- **Linux**: Nothing extra needed (PHP is bundled)
- **Windows**: PHP must be installed separately (see Windows Setup below)

### Windows Setup (First Time)

Windows requires PHP to be installed. Choose ONE method:

#### Method 1: Winget (Easiest)
1. Open **Command Prompt** or **PowerShell**
2. Run: `winget install PHP.PHP`
3. Close and reopen the terminal
4. Double-click `start.bat`

#### Method 2: Manual Install
1. Go to https://windows.php.net/download/
2. Under **PHP 8.5**, click **Zip** next to "VS17 x64 Non Thread Safe"
3. Extract the ZIP to `C:\php`
4. Add `C:\php` to your system PATH:
   - Press `Win + S`, search **"Environment Variables"**
   - Click **"Edit the system environment variables"**
   - Click **"Environment Variables"** button
   - Under **System variables**, find `Path`, click **Edit**
   - Click **New**, type `C:\php`, click **OK**
5. Double-click `start.bat`

#### Method 3: Place php.exe in bin folder
1. Download PHP from https://windows.php.net/download/
2. Extract `php.exe` from the ZIP
3. Copy `php.exe` into the `bin\` folder of LD TechLab
4. Double-click `start.bat`

#### Method 4: Git Bash / WSL
1. Open Git Bash or WSL terminal
2. Run: `./setup.sh`
3. This auto-downloads PHP for your platform

### Troubleshooting

**Port 8080 already in use:**
- Edit `start.sh` or `start.bat` and change `PORT=8080` to another number (e.g., 8888)

**macOS says "unidentified developer":**
- Right-click `start.command` → Open → Open
- Or: System Settings → Privacy & Security → Open Anyway

**Linux permission denied:**
- Run: `chmod +x start.sh && ./start.sh`

**Windows: "php is not recognized":**
- Install PHP and add it to your PATH, or place `php.exe` in the `bin/` folder

### File Structure

```
LD-TechLab/
├── bin/                    # PHP binaries (auto-detected)
├── public/                 # Web root
│   ├── index.php           # Dashboard
│   ├── css/style.css       # Styles
│   ├── js/app.js           # JavaScript
│   ├── demo/               # Interactive demos
│   └── ...
├── lessons/                # PHP lessons
├── python-lessons/         # Python lessons
├── java-lessons/           # Java lessons
├── dsa-lessons/            # DSA lessons
├── dbms-lessons/           # DBMS lessons
├── mysql-lessons/          # MySQL lessons
├── programming-logic/      # Logic lessons
├── sandbox/                # Code execution
├── includes/               # Shared PHP
├── start.sh                # Start script (Linux/Mac)
├── start.command           # Start script (Mac double-click)
├── start.bat               # Start script (Windows)
└── setup.sh                # Auto-download PHP
```

### Tips for Teaching

1. **Use the Dashboard** - It has quick links to all demos and lessons
2. **Start with demos** - Great for in-class demonstrations
3. **Use the sidebar** - Navigate between lessons easily
4. **Live coding** - Edit code directly in lesson sandboxes and run it
5. **Ctrl+B** - Toggle the sidebar on/off
6. **Dark/Light mode** - Toggle in the top-right corner

---

Created by **Mr. Lloyd Christopher F. Dacles, MIS**
LD TechLab Programming Tutorials
