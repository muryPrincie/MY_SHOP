<?php

// Détection si on est sur InfinityFree ou en local
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    // Configuration locale
    $host = '127.0.0.1';
    $db   = 'my_shop';
    $user = 'Princie';
    $pass = 'mimi1306';
} else {
    // Configuration InfinityFree
    $host = 'sql303.infinityfree.com';
    $db   = 'if0_40096178_XXX';   // remplace XXX par le vrai nom de ta base
    $user = 'if0_40096178';
    $pass = 'Hins89zJLmrx7hV';
}

$charset = 'utf8';
$port = 3306;

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=$charset", $user, $pass, $options);
    // echo "Connexion réussie !"; // décommenter pour tester
} catch (\PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}
