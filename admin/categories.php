<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit();
}

$success = $error = '';

if (isset($_GET['reactivate'])) {
    $reactivate_id = (int) $_GET['reactivate'];
    $stmt = $pdo->prepare("UPDATE categories SET active = 1 WHERE id = ?");
    $stmt->execute([$reactivate_id]);
    $success = "Catégorie réactivée.";
    header('Location: categories.php?show=inactive');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category_id = (int) ($_POST['category_id'] ?? 0);

    if (!$name) {
        $error = "Le nom de la catégorie est requis.";
    } else {
        if ($category_id > 0) {
            $stmt = $pdo->prepare("UPDATE categories SET name = ?, active = 1 WHERE id = ?");
            $stmt->execute([$name, $category_id]);
            $success = "Catégorie mise à jour.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO categories (name, active) VALUES (?, 1)");
            $stmt->execute([$name]);
            $success = "Catégorie ajoutée.";
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("UPDATE categories SET active = 0 WHERE id = ?");
    $stmt->execute([$delete_id]);
    $success = "Catégorie désactivée.";
}

$show = $_GET['show'] ?? 'active';

if ($show === 'inactive') {
    $stmt = $pdo->query("SELECT * FROM categories WHERE active = 0 ORDER BY id DESC");
    $categories = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM categories WHERE active = 1 ORDER BY id DESC");
    $categories = $stmt->fetchAll();
}

include 'admin_header.php';
?>

<p>
    <a href="categories.php">Voir catégories actives</a> | 
    <a href="categories.php?show=inactive">Voir catégories désactivées</a>
</p>

<h2>Gestion des Catégories</h2>

<?php if ($success): ?><div class="message success"><?=htmlspecialchars($success)?></div><?php endif; ?>
<?php if ($error): ?><div class="message error"><?=htmlspecialchars($error)?></div><?php endif; ?>

<form method="post">
    <input type="hidden" name="category_id" value="<?= (int) ($_GET['edit'] ?? 0) ?>">
    <input type="text" name="name" placeholder="Nom de la catégorie" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" required>
    <button type="submit"><?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?> la catégorie</button>
</form>

<table>
    <thead>
        <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td>
                    <?php if ($show === 'inactive'): ?>
                        <a href="categories.php?reactivate=<?= $c['id'] ?>" onclick="return confirm('Réactiver cette catégorie ?')">Réactiver</a>
                    <?php else: ?>
                        <a href="categories.php?delete=<?= $c['id'] ?>" onclick="return confirm('Désactiver cette catégorie ?')">Désactiver</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'admin_footer.php'; ?>
