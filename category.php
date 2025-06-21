<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$category_id = (int) $_GET['id'];

// Récupère le nom de la catégorie
$stmtCat = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
$stmtCat->execute([$category_id]);
$category = $stmtCat->fetch();

if (!$category) {
    header('Location: index.php');
    exit();
}

// Récupère les produits de la catégorie
$stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY name");
$stmt->execute([$category_id]);
$products = $stmt->fetchAll();

include 'includes/header.php';
?>

<h2>Produits dans la catégorie : <?= htmlspecialchars($category['name']) ?></h2>

<?php if (!empty($products)): ?>
    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="assets/img/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p>Prix : <?= number_format($product['price'], 0, ',', ' ') ?> €</p>
                <a class="button" href="product.php?id=<?= $product['id'] ?>">Voir le produit</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun produit dans cette catégorie.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
