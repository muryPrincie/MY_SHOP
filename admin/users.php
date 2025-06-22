<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['admin'] ?? 0) != 1) {
    header('Location: ../login.php');
    exit();
}

$success = '';
$error = '';

if (isset($_GET['reactivate'])) {
    $reactivate_id = (int) $_GET['reactivate'];
    $stmt = $pdo->prepare("UPDATE users SET active = 1 WHERE id = ?");
    $stmt->execute([$reactivate_id]);
    $success = "Utilisateur réactivé.";
    header('Location: users.php?show=inactive');
    exit();
}

if (isset($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];
    if ($delete_id != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("UPDATE users SET active = 0 WHERE id = ?");
        $stmt->execute([$delete_id]);
        $success = "Utilisateur désactivé.";
    } else {
        $error = "Vous ne pouvez pas désactiver votre propre compte.";
    }
}

$show = $_GET['show'] ?? 'active';

if ($show === 'inactive') {
    $stmt = $pdo->query("SELECT id, username, email, admin FROM users WHERE active = 0 ORDER BY id DESC");
    $users = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT id, username, email, admin FROM users WHERE active = 1 ORDER BY id DESC");
    $users = $stmt->fetchAll();
}

include 'admin_header.php';
?>

<p>
    <a href="users.php">Voir utilisateurs actifs</a> | 
    <a href="users.php?show=inactive">Voir utilisateurs désactivés</a>
</p>

<h2>Gestion des Utilisateurs</h2>
<?php if ($success): ?><div class="message success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php if ($error): ?><div class="message error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<table>
    <thead>
        <tr><th>ID</th><th>Nom d'utilisateur</th><th>Email</th><th>Admin ?</th><th>Actions</th></tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['admin'] ? 'Oui' : 'Non' ?></td>
                <td>
                    <?php if ($show === 'inactive'): ?>
                        <a href="users.php?reactivate=<?= $u['id'] ?>" onclick="return confirm('Réactiver cet utilisateur ?')">Réactiver</a>
                    <?php else: ?>
                        <?php if ($u['id'] != $_SESSION['user_id']): ?>
                            <a href="users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Désactiver cet utilisateur ?')">Désactiver</a>
                        <?php else: ?>
                            <em>Impossible</em>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'admin_footer.php'; ?>
