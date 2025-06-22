<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

$query = trim($_GET['q'] ?? '');

if ($query === '') {
    header('Location: index.php');
    exit();
}

// Sécurité : on peut limiter la longueur et nettoyer le terme
if (strlen($query) > 100) {
    $query = substr($query, 0, 100);
}

// Requête avec LIKE sur le nom produit (sécurisée avec prepare)
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, b.name AS brand_name 
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN brands b ON p.brand_id = b.id
    WHERE p.name LIKE ? AND p.active = 1
    ORDER BY p.name ASC
");
$searchTerm = "%$query%";
$stmt->execute([$searchTerm]);
$products = $stmt->fetchAll();

include 'includes/header.php';
?>

<h2>Résultats pour : <?=htmlspecialchars($query)?></h2>

<?php if (count($products) === 0): ?>
    <p>Aucun produit trouvé.</p>
<?php else: ?>
    <ul style="list-style:none; padding:0;">
        <?php foreach ($products as $product): ?>
            <li style="margin-bottom:15px;">
                <a href="products.php?id=<?= $product['id'] ?>">
                    <img src="/assets/img/products/<?=htmlspecialchars($product['image'])?>" alt="<?=htmlspecialchars($product['name'])?>" style="width:50px; height:auto; vertical-align:middle;">
                    <?=htmlspecialchars($product['name'])?>
                </a>
                - <?=htmlspecialchars($product['category_name'] ?? 'Catégorie inconnue')?>
                - <?=number_format($product['price'], 0, ',', ' ')?> €
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
