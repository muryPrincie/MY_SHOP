<?php
require_once 'includes/auth.php'; // Remplace config+functions ici
include 'includes/header.php';

$stmt = $pdo->query("SELECT p.id, p.name, p.price, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.name");
$products = $stmt->fetchAll();
?>

<h2>Produits disponibles</h2>
<div class="products-grid">
<?php foreach ($products as $product): ?>
    <div class="product-card">
        <h2><?=htmlspecialchars($product['name'])?></h2>
        <p>Catégorie : <?=htmlspecialchars($product['category_name'] ?? 'Non catégorisé')?></p>
        <p>Prix : <?=number_format($product['price'], 0, ',', ' ')?> €</p>
        <a class="button" href="product.php?id=<?= $product['id'] ?>">Voir le produit</a>
    </div>
<?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
