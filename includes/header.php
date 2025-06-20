<?php

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
<header>
    <div class="container">
        <h1><a href="index.php">My Shop</a></h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="cart.php">Panier</a>
            <?php if (isLogged()): ?>
                <a href="logout.php">Déconnexion</a>
            <?php else: ?>
                <a href="login.php">Connexion</a>
                <a href="register.php">Inscription</a>
            <?php endif; ?>
        </nav>
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="q" placeholder="Recherche..." required />
            <button type="submit">🔍</button>
        </form>
    </div>
</header>
<main class="container">
