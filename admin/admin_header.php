<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Espace Admin - Dunk District</title>
    <link rel="stylesheet" href="admin.css" />
</head>
<body>
    <h2>Zone Admin : <?= htmlspecialchars($_SESSION['username']) ?></h2>
    <div style="text-align:center; margin-bottom: 20px;">
    <img src="../assets/img/jumpera.png" alt="Logo Jumper" style="max-width: 200px; height: auto;">
</div>
    <nav class="admin-nav">
        <ul>
            <li><a href="products.php">Produits</a></li>
            <li><a href="categories.php">Catégories</a></li>
            <li><a href="users.php">Utilisateurs</a></li>
            <li><a href="../logout.php">Déconnexion</a></li>
        </ul>
    </nav>

    <?php include 'admin_footer.php'; ?>
