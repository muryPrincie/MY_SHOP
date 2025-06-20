<?php
require 'includes/config.php';
require 'includes/functions.php';



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ajouter produit au panier
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

// Supprimer un produit du panier
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

<h2>Mon panier</h2>

<?php if (empty($cart_products)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <table>
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
                    <td><a href="cart.php?remove=<?= $product['id'] ?>">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><strong>Total :</strong> <?= number_format($total, 0, ',', ' ') ?> €</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>