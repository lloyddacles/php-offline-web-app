<?php
session_start();
session_destroy();
header('Location: /demo/login');
exit;
