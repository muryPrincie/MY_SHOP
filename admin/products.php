<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit();
}

$stmt = $pdo->query("SELECT id, name FROM categories WHERE active = 1 ORDER BY name");
$categories = $stmt->fetchAll();

$success = $error = '';

if (isset($_GET['reactivate'])) {
    $reactivate_id = (int) $_GET['reactivate'];
    $stmt = $pdo->prepare("UPDATE products SET active = 1 WHERE id = ?");
    $stmt->execute([$reactivate_id]);
    $success = "Produit réactivé.";
    header('Location: products.php?show=inactive');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = (int) ($_POST['price'] ?? 0);
    $category_id = (int) ($_POST['category_id'] ?? 0);
    $image = trim($_POST['image'] ?? '');
    $product_id = (int) ($_POST['product_id'] ?? 0);

    if (!$name || $price <= 0 || $category_id <= 0 || !$image) {
        $error = "Tous les champs sont requis.";
    } else {
        if ($product_id > 0) {
            $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, category_id=?, image=?, active = 1 WHERE id=?");
            $stmt->execute([$name, $price, $category_id, $image, $product_id]);
            $success = "Produit mis à jour avec succès.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO products (name, price, category_id, image, active) VALUES (?, ?, ?, ?, 1)");
            $stmt->execute([$name, $price, $category_id, $image]);
            $success = "Produit ajouté avec succès.";
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("UPDATE products SET active = 0 WHERE id = ?");
    $stmt->execute([$delete_id]);
    $success = "Produit désactivé.";
}

$show = $_GET['show'] ?? 'active';

if ($show === 'inactive') {
    $stmt = $pdo->query("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.active = 0 ORDER BY p.id DESC");
    $products = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.active = 1 ORDER BY p.id DESC");
    $products = $stmt->fetchAll();
}

include 'admin_header.php';
?>

<p>
    <a href="products.php">Voir produits actifs</a> | 
    <a href="products.php?show=inactive">Voir produits désactivés</a>
</p>

<h2>Gestion des Produits</h2>

<?php if ($success): ?><div class="message success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php if ($error): ?><div class="message error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<form method="post" action="products.php">
    <input type="hidden" name="product_id" value="<?= (int)($_GET['edit'] ?? 0) ?>">
    <input type="text" name="name" placeholder="Nom du produit" value="<?= htmlspecialchars($_GET['name'] ?? '', ENT_QUOTES) ?>" required>
    <input type="number" name="price" placeholder="Prix (€)" value="<?= htmlspecialchars($_GET['price'] ?? '', ENT_QUOTES) ?>" required>
    <select name="category_id" required>
        <option value="">-- Catégorie --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ((int)($_GET['category_id'] ?? 0) === (int)$cat['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name'] ?? '') ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="image" placeholder="Nom du fichier image (ex: jordan1.jpg)" value="<?= htmlspecialchars($_GET['image'] ?? '', ENT_QUOTES) ?>" required>
  
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix (€)</th>
            <th>Catégorie</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['name'] ?? '') ?></td>
                <td><?= number_format($p['price'] ?? 0, 0, ',', ' ') ?></td>
                <td><?= htmlspecialchars($p['category'] ?? 'Non catégorisé') ?></td>
                <td>
                    <?php if (!empty($p['image'])): ?>
                        <img src="../assets/img/products/<?= htmlspecialchars($p['image']) ?>" alt="" width="50">
                    <?php else: ?>
                        Pas d'image
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($show === 'inactive'): ?>
                        <a href="products.php?reactivate=<?= $p['id'] ?>" onclick="return confirm('Réactiver ce produit ?')">Réactiver</a>
                    <?php else: ?>|
                        <a href="products.php?delete=<?= $p['id'] ?>" onclick="return confirm('Désactiver ce produit ?')">Désactiver</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'admin_footer.php'; ?>
