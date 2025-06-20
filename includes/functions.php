<?php
// includes/functions.php
session_start();

function isLogged() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
}

function redirectIfNotLogged() {
    if (!isLogged()) {
        header('Location: login.php');
        exit();
    }
}

function redirectIfNotAdmin() {
    if (!isAdmin()) {
        header('Location: ../login.php');
        exit();
    }
}
