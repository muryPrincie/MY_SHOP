<?php
require_once 'config.php';
require_once 'functions.php';

// Récupération des catégories UNIQUEMENT si l'utilisateur est connecté
$categories = [];
if (isLogged()) {
    $stmt = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL");
    $categories = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Shop</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
<?php if (isLogged()): ?>
<header>
    <div class="container">
        <h1><a href="index.php">My Shop</a></h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="cart.php" class="cart-icon" title="Panier">
                <img src="/assets/img/basket-cart.png" alt="Panier" />Panier
            </a>
            
            <!-- Catégories dynamiques -->
            <?php foreach ($categories as $cat): ?>
                <a href="category.php?id=<?= htmlspecialchars($cat['id']) ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
            
            <a href="logout.php">Déconnexion</a>
        </nav>
    </div>
</header>
<?php endif; ?>
<main class="container">
