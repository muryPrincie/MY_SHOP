<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';



// Vérifier que l'utilisateur est connecté ET admin
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
    <title>Espace Admin - My Shop</title>
<link rel="stylesheet" href="admin.css" />
    
    
</head>
<body>

    <h2>Bienvenue dans l'espace Admin, <?=htmlspecialchars($_SESSION['username'])?></h2>

    <nav class="admin-nav">
        <ul>
            <li><a href="products.php">Gestion des produits</a></li>
            <li><a href="categories.php">Gestion des catégories</a></li>
            <li><a href="users.php">Gestion des utilisateurs</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
          
        </ul>
    </nav>

</body>
</html>
