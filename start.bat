@echo off
title LD TechLab Programming Tutorials
setlocal enabledelayedexpansion

cd /d "%~dp0"

set PORT=8080

echo.
echo  ==========================================
echo   LD TechLab Programming Tutorials
echo  ==========================================
echo.

REM ============================================
REM Find PHP executable
REM ============================================
set PHP_BIN=

REM 1. Check bundled php.exe
if exist "bin\php.exe" (
    set PHP_BIN=bin\php.exe
    goto :found
)

REM 2. Check system PATH
where php >nul 2>&1
if !ERRORLEVEL! EQU 0 (
    set PHP_BIN=php
    goto :found
)

REM 3. Check common locations
for %%P in (
    "C:\php\php.exe"
    "C:\PHP\php.exe"
    "%ProgramFiles%\php\php.exe"
    "%LocalAppData%\Programs\PHP\php.exe"
    "C:\tools\php\php.exe"
) do (
    if exist %%P (
        set PHP_BIN=%%~P
        goto :found
    )
)

REM PHP not found
echo  PHP is not installed.
echo.
echo  To fix this, run setup.bat first, or install PHP:
echo.
echo    Option 1: winget install PHP.PHP
echo    Option 2: https://windows.php.net/download/
echo    Option 3: Place php.exe in the bin\ folder
echo.
echo  After installing, run start.bat again.
echo.
pause
exit /b 1

:found

echo  PHP: %PHP_BIN%
echo  Starting server on port %PORT%...
echo.
echo  Open in your browser:
echo  >>> http://localhost:%PORT% <<<
echo.
echo  Press Ctrl+C to stop the server.
echo.

"%PHP_BIN%" -S "127.0.0.1:%PORT%" -t public public/router.php

echo.
echo  Server stopped.
pause
