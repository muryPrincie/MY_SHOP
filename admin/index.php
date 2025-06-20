<?php
session_start();
require '../includes/config.php';
require '../includes/functions.php';

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
    <link rel="stylesheet" href="../admin/css/admin.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #222;
            color: #eee;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        h2 {
            background: rgba(0,0,0,0.5);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 40px;
            font-size: 2em;
        }
        nav.admin-nav {
            margin-top: auto;
            background: #111;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.7);
        }
        nav.admin-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 40px;
        }
        nav.admin-nav ul li {
            display: inline;
        }
        nav.admin-nav ul li a {
            color: #eee;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            transition: color 0.3s;
        }
        nav.admin-nav ul li a:hover {
            color: #4caf50;
        }
    </style>
</head>
<body>

    <h2>Bienvenue dans l'espace Admin, <?=htmlspecialchars($_SESSION['username'])?></h2>

    <nav class="admin-nav">
        <ul>
            <li><a href="products.php">Gestion des produits</a></li>
            <li><a href="categories.php">Gestion des catégories</a></li>
            <li><a href="users.php">Gestion des utilisateurs</a></li>
            <li><a href="../index.php">Déconnexion</a></li>
        </ul>
    </nav>

</body>
</html>
