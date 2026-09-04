<?php
require_once __DIR__ . '/init.php';

if (isset($_SESSION['student_id'])) {
    header('Location: /demo/dashboard');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = trim($_POST['student_id'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM students WHERE student_id = :id AND password = :pass');
    $stmt->bindValue(':id', $studentId, SQLITE3_TEXT);
    $stmt->bindValue(':pass', $password, SQLITE3_TEXT);
    $result = $stmt->execute();
    $student = $result->fetchArray(SQLITE3_ASSOC);

    if ($student) {
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];
        $_SESSION['student_no'] = $student['student_id'];
        header('Location: /demo/dashboard');
        exit;
    } else {
        $error = 'Invalid Student ID or Password';
    }
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal Login - Demo</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--bg-primary);
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-header .portal-icon {
            width: 64px;
            height: 64px;
            background: var(--accent-dim);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 16px;
        }
        .login-header h1 {
            font-size: 1.5em;
            margin-bottom: 4px;
        }
        .login-header p {
            color: var(--text-secondary);
            font-size: 0.9em;
        }
        .login-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 0.85em;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text-primary);
            font-size: 0.95em;
            font-family: inherit;
            transition: border-color var(--transition);
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
        }
        .form-group input::placeholder {
            color: var(--text-muted);
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: var(--bg-primary);
            border: none;
            border-radius: var(--radius);
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--transition);
        }
        .login-btn:hover {
            background: var(--accent-hover);
        }
        .error-msg {
            background: rgba(243, 139, 168, 0.1);
            border: 1px solid var(--accent-red);
            color: var(--accent-red);
            padding: 10px 14px;
            border-radius: var(--radius);
            font-size: 0.9em;
            margin-bottom: 16px;
        }
        .demo-hint {
            margin-top: 20px;
            padding: 14px;
            background: var(--accent-dim);
            border: 1px solid rgba(137, 180, 250, 0.3);
            border-radius: var(--radius);
            font-size: 0.85em;
            color: var(--text-secondary);
        }
        .demo-hint strong {
            color: var(--accent);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-muted);
            font-size: 0.85em;
        }
        .back-link a {
            color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="portal-icon">&#127891;</div>
            <h1>Student Portal</h1>
            <p>LD TechLab Demo Application</p>
        </div>

        <div class="login-card">
            <?php if ($error): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" id="student_id" name="student_id" placeholder="e.g. 2024-0001" required autofocus value="<?= htmlspecialchars($_POST['student_id'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>
                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="demo-hint">
                <strong>Demo Accounts:</strong><br>
                ID: <code>2024-0001</code> &mdash; Juan Dela Cruz (3rd Year IT)<br>
                ID: <code>2024-0002</code> &mdash; Maria Santos (2nd Year CS)<br>
                Password: <code>demo123</code> (all accounts)
            </div>
        </div>

        <div class="back-link">
            <a href="/">&larr; Back to Tutorial Site</a>
        </div>
    </div>
</body>
</html>
