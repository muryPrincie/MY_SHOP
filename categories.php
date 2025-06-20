<?php
require 'includes/config.php';

if (!isset($_GET['brand_id']) || !is_numeric($_GET['brand_id'])) {
    header('Location: brands.php');
    exit();
}

$brand_id = (int) $_GET['brand_id'];

$stmt = $pdo->prepare("
    SELECT DISTINCT c.id, c.name 
    FROM categories c
    JOIN products p ON p.category_id = c.id
    WHERE p.brand_id = ?
    ORDER BY c.name
");
$stmt->execute([$brand_id]);
$categories = $stmt->fetchAll();

include 'includes/header.php';
?>

<h1>Catégories pour la marque <?=htmlspecialchars(getBrandName($brand_id))?></h1>
<ul>
<?php foreach ($categories as $category): ?>
    <li>
        <a href="products.php?brand_id=<?= $brand_id ?>&category_id=<?= $category['id'] ?>">
            <?= htmlspecialchars($category['name']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>

<?php
function getBrandName($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT name FROM brands WHERE id = ?");
    $stmt->execute([$id]);
    $brand = $stmt->fetch();
    return $brand ? $brand['name'] : 'Inconnue';
}
?>
