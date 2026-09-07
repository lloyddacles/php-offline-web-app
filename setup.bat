@echo off
title LD TechLab - Setup
setlocal enabledelayedexpansion

set SCRIPT_DIR=%~dp0
set BIN_DIR=%SCRIPT_DIR%bin

echo.
echo  ==========================================
echo   LD TechLab - Windows Setup
echo  ==========================================
echo.

REM ============================================
REM Check PHP
REM ============================================
echo  Checking PHP...
echo.

set PHP_FOUND=0

REM 1. Check bundled php.exe in bin\
if exist "%BIN_DIR%\php.exe" (
    echo  [OK] Found bundled PHP: bin\php.exe
    set PHP_FOUND=1
    set PHP_PATH=%BIN_DIR%\php.exe
    goto :php_checked
)

REM 2. Check system PATH
where php >nul 2>&1
if !ERRORLEVEL! EQU 0 (
    echo  [OK] Found PHP in system PATH
    set PHP_FOUND=1
    for /f "tokens=*" %%p in ('where php') do set PHP_PATH=%%p
    goto :php_checked
)

REM 3. Check common install locations
for %%P in (
    "C:\php\php.exe"
    "C:\PHP\php.exe"
    "%ProgramFiles%\php\php.exe"
    "%LocalAppData%\Programs\PHP\php.exe"
    "C:\tools\php\php.exe"
) do (
    if exist %%P (
        echo  [OK] Found PHP at %%P
        set PHP_FOUND=1
        set PHP_PATH=%%~P
        goto :php_checked
    )
)

REM 4. Check winget
where winget >nul 2>&1
if !ERRORLEVEL! EQU 0 (
    echo  [INFO] PHP not found. Attempting install via winget...
    echo.
    winget install --id PHP.PHP --accept-package-agreements --accept-source-agreements
    if !ERRORLEVEL! EQU 0 (
        echo.
        echo  [OK] PHP installed via winget
        echo  Refreshing PATH...
        set PATH=%PATH%;C:\php
        where php >nul 2>&1
        if !ERRORLEVEL! EQU 0 (
            set PHP_FOUND=1
            for /f "tokens=*" %%p in ('where php') do set PHP_PATH=%%p
        )
    )
    goto :php_checked
)

:php_checked

if !PHP_FOUND! EQU 0 (
    echo.
    echo  ==========================================
    echo   PHP NOT FOUND - Manual Install Required
    echo  ==========================================
    echo.
    echo  PHP is required to run this tutorial website.
    echo.
    echo  Option 1 (Recommended): Install via Winget
    echo    winget install PHP.PHP
    echo.
    echo  Option 2: Manual Download
    echo    1. Go to https://windows.php.net/download/
    echo    2. Download "VS17 x64 Non Thread Safe" ZIP
    echo    3. Extract the ZIP to C:\php
    echo    4. Add C:\php to your system PATH:
    echo       - Search "Environment Variables" in Start Menu
    echo       - Edit PATH under System Variables
    echo       - Add C:\php
    echo    5. Run this setup again
    echo.
    echo  Option 3: Use Git Bash
    echo    Run: ./setup.sh
    echo.
    goto :check_python
)

REM Verify PHP works
for /f "tokens=*" %%v in ('!PHP_PATH! -v 2^>^&1') do (
    echo  %%v
    goto :php_version_done
)
:php_version_done

echo.

REM ============================================
REM Check Python (optional)
REM ============================================
:check_python
echo  Checking Python (optional for Python sandbox)...
echo.
where python >nul 2>&1
if !ERRORLEVEL! EQU 0 (
    for /f "tokens=*" %%v in ('python --version 2^>^&1') do echo  [OK] %%v
) else (
    where python3 >nul 2>&1
    if !ERRORLEVEL! EQU 0 (
        for /f "tokens=*" %%v in ('python3 --version 2^>^&1') do echo  [OK] %%v
    ) else (
        echo  [SKIP] Python not found - Python sandbox will not work
        echo         Install: winget install Python.Python.3
    )
)
echo.

REM ============================================
REM Check Java (optional)
REM ============================================
echo  Checking Java (optional for Java sandbox)...
echo.
where java >nul 2>&1
if !ERRORLEVEL! EQU 0 (
    for /f "tokens=*" %%v in ('java -version 2^>^&1') do (
        echo  [OK] %%v
        goto :java_done
    )
) else (
    echo  [SKIP] Java not found - Java sandbox will not work
    echo         Install: winget install EclipseAdoptium.Temurin.17.JDK
)
:java_done
echo.

REM ============================================
REM Done
REM ============================================
echo  ==========================================
echo   Setup Complete
echo  ==========================================
echo.
echo  To start the tutorial website:
echo    Double-click "start.bat"
echo.
echo  Then open in your browser:
echo    http://localhost:8080
echo.
echo  To stop: Close the server window or press Ctrl+C
echo  ==========================================
echo.
pause
