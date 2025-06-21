<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, b.name AS brand_name 
    FROM products p 
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN brands b ON p.brand_id = b.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php');
    exit();
}

include 'includes/header.php';
?>

<h2><?=htmlspecialchars($product['name'])?></h2>
<img src="/assets/img/products/<?=htmlspecialchars($product['image'])?>" alt="<?=htmlspecialchars($product['name'])?>" style="max-width:300px; height:auto;">
<p><strong>Marque :</strong> <?=htmlspecialchars($product['brand_name'] ?? 'Non défini')?></p>
<p><strong>Catégorie :</strong> <?=htmlspecialchars($product['category_name'] ?? 'Non catégorisé')?></p>
<p><strong>Prix :</strong> <?=number_format($product['price'], 0, ',', ' ')?> €</p>

<form method="post" action="cart.php">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <label for="quantity">Quantité :</label>
    <input type="number" name="quantity" id="quantity" value="1" min="1" max="100" require_onced />
    <button type="submit" name="add_to_cart">Ajouter au panier</button>
</form>

<?php include 'includes/footer.php'; ?>
