<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $errors[] = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['admin'] = $user['admin'] ?? 0;

            if ($_SESSION['admin'] == 1) {
                header('Location: admin/index.php');
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            $errors[] = "Identifiants invalides.";
        }
    }
}

include 'includes/header.php';
?>

<h2>Connexion</h2>

<?php foreach ($errors as $error): ?>
    <div class="message error"><?=htmlspecialchars($error)?></div>
<?php endforeach; ?>

<form method="post" action="login.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required />
    <input type="password" name="password" placeholder="Mot de passe" required />
    <button type="submit">Se connecter</button>
</form>

<p class="form-toggle">
    Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a>.
</p>

<?
