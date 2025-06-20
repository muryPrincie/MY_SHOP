<?php
require 'includes/config.php';
require 'includes/functions.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (!$username || !$email || !$password || !$password_confirm) {
        $errors[] = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse email invalide.";
    } elseif ($password !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifie que username ou email n'existe pas
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $errors[] = "Nom d'utilisateur ou email déjà utilisé.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, admin) VALUES (?, ?, ?, 0)");
            $stmt->execute([$username, $email, $hash]);
            $success = true;
        }
    }
}

include 'includes/header.php';
?>

<h2>Inscription</h2>

<?php if ($success): ?>
    <div class="message success">Inscription réussie. <a href="login.php">Connectez-vous ici</a>.</div>
<?php else: ?>
    <?php foreach ($errors as $error): ?>
        <div class="message error"><?=htmlspecialchars($error)?></div>
    <?php endforeach; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required />
        <input type="email" name="email" placeholder="Adresse email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required />
        <button type="submit">S'inscrire</button>
    </form>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
