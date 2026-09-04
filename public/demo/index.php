<?php
session_start();
if (isset($_SESSION['student_id'])) {
    header('Location: /demo/dashboard');
} else {
    header('Location: /demo/login');
}
exit;
