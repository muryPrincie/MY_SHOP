<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// +1 au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = (int) ($_POST['product_id'] ?? 0);
    $quantity = (int) ($_POST['quantity'] ?? 1);
    if ($product_id > 0 && $quantity > 0) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
    header('Location: cart.php');
    exit();
}

// -1 au panier
if (isset($_GET['remove'])) {
    $remove_id = (int) $_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header('Location: cart.php');
    exit();
}

include 'includes/header.php';

$cart_products = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $cart_products = $stmt->fetchAll();

    foreach ($cart_products as $product) {
        $total += $product['price'] * $_SESSION['cart'][$product['id']];
    }
}
?>

<h2 class="cart-title">Mon panier</h2>

<div class="cart-container">
    <?php if (empty($cart_products)): ?>
        <p class="empty-cart">Votre panier est vide.</p>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= number_format($product['price'], 0, ',', ' ') ?> €</td>
                        <td><?= $_SESSION['cart'][$product['id']] ?></td>
                        <td><?= number_format($product['price'] * $_SESSION['cart'][$product['id']], 0, ',', ' ') ?> €</td>
                        <td><a href="cart.php?remove=<?= $product['id'] ?>" class="remove-btn">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="cart-total"><strong>Total :</strong> <?= number_format($total, 0, ',', ' ') ?> €</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
<style>
body {
    background: url('assets/img/DC4.jpg') no-repeat center center fixed;
    background-size: cover;
    color: white;
}

.cart-title {
    color: white;
}
</style>