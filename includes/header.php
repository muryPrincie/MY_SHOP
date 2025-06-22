<?php
require_once 'config.php';
require_once 'functions.php';

$categories = [];
if (isLogged()) {
    $stmt = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL");
    $allCategories = $stmt->fetchAll();

    $bottomCatsNames = ['Accessoires', 'Chaussettes', 'Bas', 'Ballon'];

    $topCategories = [];
    $bottomCategories = [];

    foreach ($allCategories as $cat) {
        if (in_array($cat['name'], $bottomCatsNames)) {
            $bottomCategories[] = $cat;
        } else {
            $topCategories[] = $cat;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Shop</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <style>
        nav {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
            padding-left: 0; 
            margin-left: 0;
        }
        nav form {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }
        .nav-left {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 0; 
            padding-left: 0;
        }
        .nav-cart {
            margin-left: auto; 
            display: flex;
            align-items: center;
        }
        nav a {
            text-decoration: none;
            color: inherit;
            padding: 5px 10px;
            display: flex;
            align-items: center;
            line-height: 1;
        }
        nav a:hover {
            background-color: #eee;
            color: #222;
            border-radius: 4px;
        }
        nav a img {
            height: 20px;
            width: auto;
            margin-right: 6px;
            vertical-align: middle;
            display: inline-block;
        }
    </style>
</head>
<body>
<?php if (isLogged()): ?>
<header>
    <div class="container" style="padding-left:0; margin-left:0;">
        <h1><a href="index.php">JUMP ERA</a></h1>
        <div style="text-align:center; margin-bottom: 20px;">
            <img src="assets/img/jumperaG.png" alt="Logo Jumper" style="max-width: 200px; height: auto;">
        </div>

        <nav>
            <form method="get" action="search.php">
                <input type="text" name="q" placeholder="Rechercher un produit..." required style="padding:5px;" />
                <button type="submit" style="padding:5px;">Recherche</button>
            </form>

            <div class="nav-left">
                <a href="index.php">Accueil</a>
                <?php foreach ($topCategories as $cat): ?>
                    <a href="category.php?id=<?= htmlspecialchars($cat['id']) ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                <?php endforeach; ?>
                <?php foreach ($bottomCategories as $cat): ?>
                    <a href="category.php?id=<?= htmlspecialchars($cat['id']) ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                <?php endforeach; ?>
                <a href="logout.php">Déconnexion</a>
            </div>

            <div class="nav-cart">
                <a href="cart.php" class="cart-icon" title="Panier">
                    <img src="/assets/img/basket-cart.png" alt="Panier" />Panier
                </a>
            </div>
        </nav>
    </div>
</header>
<?php endif; ?>
<main class="container">
