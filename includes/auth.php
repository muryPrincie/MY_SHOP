<?php

require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit();
}
?>
