<?php
require_once 'config.php';
require_once 'functions.php';

$topCategories = [];
$bottomCategories = [];

if (isLogged()) {
    $stmt = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL");
    $allCategories = $stmt->fetchAll();

    $bottomCatsNames = ['Accessoires', 'Chaussettes', 'Bas', 'Ballon'];

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
        /* Pour le Header */
        header {
            background: rgba(34, 34, 34, 0.92);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
        }

        header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Force le centrage sur PC */
        }

        /* Logo et nom alignés et centrés */
        .logo-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }

        .logo-header h1 a {
            font-size: 2rem;
            color: #f15a24;
            text-decoration: none;
            font-family: 'Impact', sans-serif;
            letter-spacing: 2px;
        }

        .logo-header .logo {
            max-height: 60px;
            width: auto;
        }

        /* Partie Nav */
        nav {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            background: transparent;
            width: 100%;
        }

        nav form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        nav form input {
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 250px;
            max-width: 80%;
        }

        nav form button {
            background: #f15a24;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background 0.3s;
        }

        nav form button:hover {
            background: #c94b1f;
        }

        .nav-left {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 6px;
            transition: background 0.3s, transform 0.2s;
        }

        nav a:hover {
            background: #f15a24;
            color: #fff !important;
            transform: scale(1.05);
        }

        .nav-cart {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-cart a {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        .nav-cart img {
            height: 20px;
            margin-right: 6px;
        }

        /* Burger format mobile */
        .burger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            width: 30px;
            margin: 10px auto;
        }

        .burger span {
            background: white;
            height: 3px;
            margin: 4px 0;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .burger.open span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .burger.open span:nth-child(2) {
            opacity: 0;
        }

        .burger.open span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        @media screen and (max-width: 768px) {
            header .container {
                align-items: center;
            }

            nav {
                display: none;
                flex-direction: column;
                align-items: center;
                gap: 15px;
                background: rgba(34, 34, 34, 0.95);
                padding: 15px 0;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                width: 100%;
            }

            nav.active {
                display: flex;
            }

            .burger {
                display: flex;
            }

            nav form {
                flex-direction: column;
                width: 90%;
            }

            nav form input {
                width: 100%;
            }

            .nav-left {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .nav-cart {
                justify-content: center;
                width: 100%;
            }

            .logo-header {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>

<body>
    <?php if (isLogged()): ?>
        <header>
            <div class="container">
                <!-- Logo et Nom -->
                <div class="logo-header">
                    <img src="assets/img/jumperaG.png" alt="Logo Jumper" class="logo">
                    <h1><a href="index.php">JUMP ERA</a></h1>
                </div>

                <!-- Le menu du burger -->
                <div class="burger" id="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <nav id="navbar">
                    <form method="get" action="search.php">
                        <input type="text" name="q" placeholder="Rechercher un produit..." required />
                        <button type="submit">Recherche</button>
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
        <script>
            // Js du menu burger
            const burger = document.getElementById('burger');
            const navbar = document.getElementById('navbar');

            burger.addEventListener('click', () => {
                navbar.classList.toggle('active');
                burger.classList.toggle('open');
            });
        </script>
