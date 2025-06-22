<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';



// Vérifier que l'utilisateur est connecté ET l'admin
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
           <ul>
            <li><a href="products.php">Produits</a></li>
            <li><a href="categories.php">Catégories</a></li>
            <li><a href="users.php">Utilisateurs</a></li>
            <li><a href="../logout.php">Déconnexion</a></li>
        </ul>
          
        </ul>
    </nav>

</body>
</html>
