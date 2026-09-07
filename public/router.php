<?php
/**
 * Router Script for PHP Built-in Server
 * Handles clean URLs and routes requests to appropriate files.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Block path traversal attempts
if (strpos($uri, '..') !== false) {
    http_response_code(400);
    echo '<!DOCTYPE html><html><head><title>400</title></head><body><h1>Bad Request</h1></body></html>';
    return true;
}

// Serve static files directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Route PHP lessons
if (preg_match('#^/lesson/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../lessons/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route MySQL lessons
if (preg_match('#^/mysql/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../mysql-lessons/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route DBMS lessons
if (preg_match('#^/dbms/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../dbms-lessons/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route DSA lessons
if (preg_match('#^/dsa/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../dsa-lessons/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route Programming Logic lessons
if (preg_match('#^/logic/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../programming-logic/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route Python lessons
if (preg_match('#^/python/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../python-lessons/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route Java lessons
if (preg_match('#^/java/(\d+)-(.*?)$#', $uri, $matches)) {
    $num = $matches[1];
    $slug = $matches[2];
    $file = __DIR__ . '/../java-lessons/' . str_pad($num, 2, '0', STR_PAD_LEFT) . '-' . $slug . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
}

// Route sandbox execution
if ($uri === '/sandbox/execute.php') {
    require __DIR__ . '/../sandbox/execute.php';
    return true;
}
if ($uri === '/sandbox/execute-python.php') {
    require __DIR__ . '/../sandbox/execute-python.php';
    return true;
}
if ($uri === '/sandbox/execute-java.php') {
    require __DIR__ . '/../sandbox/execute-java.php';
    return true;
}

// Route Student Portal Demo
if (preg_match('#^/demo(/.*)?$#', $uri, $m)) {
    $demoPath = $m[1] ?? '/index.php';
    $demoFile = __DIR__ . '/demo' . $demoPath;
    if ($demoPath === '' || $demoPath === '/') {
        $demoFile = __DIR__ . '/demo/index.php';
    } elseif (file_exists($demoFile . '.php')) {
        $demoFile = $demoFile . '.php';
    } elseif (is_dir($demoFile) && file_exists($demoFile . '/index.php')) {
        $demoFile = $demoFile . '/index.php';
    }
    if (file_exists($demoFile)) {
        require $demoFile;
        return true;
    }
}

// Home page
if ($uri === '/' || $uri === '/index.php') {
    require __DIR__ . '/index.php';
    return true;
}

// Status page
if ($uri === '/status' || $uri === '/status.php') {
    require __DIR__ . '/status.php';
    return true;
}

// Deployment guide
if ($uri === '/deploy' || $uri === '/deploy.php') {
    require __DIR__ . '/deploy.php';
    return true;
}

// PHP Lesson listing
if ($uri === '/lessons' || $uri === '/lessons/' || $uri === '/php' || $uri === '/php/') {
    require __DIR__ . '/../lessons/index.php';
    return true;
}

// MySQL Lesson listing
if ($uri === '/mysql' || $uri === '/mysql/' || $uri === '/mysql-lessons' || $uri === '/mysql-lessons/') {
    require __DIR__ . '/../mysql-lessons/index.php';
    return true;
}

// DBMS Lesson listing
if ($uri === '/dbms' || $uri === '/dbms/' || $uri === '/dbms-lessons' || $uri === '/dbms-lessons/') {
    require __DIR__ . '/../dbms-lessons/index.php';
    return true;
}

// DSA Lesson listing
if ($uri === '/dsa' || $uri === '/dsa/' || $uri === '/dsa-lessons' || $uri === '/dsa-lessons/') {
    require __DIR__ . '/../dsa-lessons/index.php';
    return true;
}

// Programming Logic Lesson listing
if ($uri === '/logic' || $uri === '/logic/' || $uri === '/programming-logic' || $uri === '/programming-logic/') {
    require __DIR__ . '/../programming-logic/index.php';
    return true;
}

// Python Lesson listing
if ($uri === '/python' || $uri === '/python/' || $uri === '/python-lessons' || $uri === '/python-lessons/') {
    require __DIR__ . '/../python-lessons/index.php';
    return true;
}

// Java Lesson listing
if ($uri === '/java' || $uri === '/java/' || $uri === '/java-lessons' || $uri === '/java-lessons/') {
    require __DIR__ . '/../java-lessons/index.php';
    return true;
}

// 404
http_response_code(404);
echo '<!DOCTYPE html><html><head><title>404</title></head><body><h1>Page Not Found</h1><p><a href="/">Go Home</a></p></body></html>';
return true;
