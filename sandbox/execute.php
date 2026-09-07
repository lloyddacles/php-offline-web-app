<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'POST method required.']);
    exit;
}
$code = $_POST['code'] ?? '';
if (empty(trim($code))) {
    echo json_encode(['error' => 'No code provided.']);
    exit;
}

// Decode HTML entities from extracted code
$code = html_entity_decode($code, ENT_QUOTES | ENT_HTML5);

// Debug: log what we received
file_put_contents('/tmp/sandbox_debug.log', "=== RAW CODE ===\n" . $code . "\n=== END ===\n");

$tmpDir = sys_get_temp_dir() . '/php-tutorial-sandbox';
if (!is_dir($tmpDir)) { mkdir($tmpDir, 0700, true); }

$code = preg_replace('/^\s*<\?php\s*/i', '', $code);
$code = preg_replace('/^\s*<\?=\s*/i', '', $code);
$code = preg_replace('/^\s*<\?\s*/i', '', $code);
$code = preg_replace('/\s*\?>\s*$/', '', $code);

file_put_contents('/tmp/sandbox_debug.log', "=== AFTER STRIP ===\n" . $code . "\n=== END ===\n", FILE_APPEND);

$tmpFile = $tmpDir . '/code_' . uniqid() . '.php';
file_put_contents($tmpFile, '<?php ' . $code);

file_put_contents('/tmp/sandbox_debug.log', "=== TEMP FILE CONTENTS ===\n" . file_get_contents($tmpFile) . "\n=== END ===\n", FILE_APPEND);

$iniFile = __DIR__ . '/restricted.ini';
$cmd = sprintf('php -c %s -d display_errors=1 -d error_reporting=E_ALL -d log_errors=0 %s 2>&1', escapeshellarg($iniFile), escapeshellarg($tmpFile));

$descriptors = [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
$process = proc_open($cmd, $descriptors, $pipes);
$output = '';

if (is_resource($process)) {
    fclose($pipes[0]);
    $startTime = microtime(true);
    $timeout = 5;
    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);
    $stdout = '';
    $stderr = '';
    while (true) {
        $read = [$pipes[1], $pipes[2]];
        $write = null;
        $except = null;
        $numChanged = stream_select($read, $write, $except, 0, 200000);
        if ($numChanged === false) break;
        if (in_array($pipes[1], $read)) {
            $chunk = fread($pipes[1], 8192);
            if ($chunk === false || $chunk === '') { if (feof($pipes[1])) break; } else { $stdout .= $chunk; }
        }
        if (in_array($pipes[2], $read)) {
            $chunk = fread($pipes[2], 8192);
            if ($chunk !== false && $chunk !== '') { $stderr .= $chunk; }
        }
        if (microtime(true) - $startTime > $timeout) {
            proc_terminate($process, 9);
            $stdout .= "\n\n[Execution timed out after {$timeout} seconds]";
            break;
        }
    }
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($process);
    $output = $stdout;
    if (!empty($stderr)) { $output .= ($output ? "\n" : '') . $stderr; }
}
@unlink($tmpFile);
$output = trim($output);
if (empty($output)) { $output = '(No output - use echo or print to display results)'; }
echo json_encode(['output' => $output]);
