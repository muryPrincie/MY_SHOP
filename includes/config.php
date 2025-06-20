<?php
// includes/config.php
$host = '127.0.0.1';
$db   = 'my_shop';
$user = 'Princie';      
$pass = 'mimi1306';          
$charset = 'utf8';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}
