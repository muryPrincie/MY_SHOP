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

// Pagination
$products_per_page = 4; // 4 produits par page
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($current_page - 1) * $products_per_page;

// Nombre total de produits dans la catégorie
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = ?");
$stmtCount->execute([$category_id]);
$total_products = $stmtCount->fetchColumn();

$total_pages = ceil($total_products / $products_per_page);

// Récupère les produits paginés
$stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY name LIMIT ? OFFSET ?");
$stmt->bindValue(1, $category_id, PDO::PARAM_INT);
$stmt->bindValue(2, $products_per_page, PDO::PARAM_INT);
$stmt->bindValue(3, $offset, PDO::PARAM_INT);
$stmt->execute();
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

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?id=<?= $category_id ?>&page=<?= $current_page - 1 ?>">&laquo; Précédent</a>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $total_pages; $page++): ?>
            <a href="?id=<?= $category_id ?>&page=<?= $page ?>" <?= ($page == $current_page) ? 'class="active"' : '' ?>><?= $page ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?id=<?= $category_id ?>&page=<?= $current_page + 1 ?>">Suivant &raquo;</a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p>Aucun produit dans cette catégorie.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
<style>
body {
    background: url('assets/img/DC3.jpg') no-repeat center center fixed;
    background-size: cover;
    color: white;
}
</style>