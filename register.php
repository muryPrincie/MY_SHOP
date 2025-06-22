<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

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

<style>
body {
    background: url('assets/img/DC1.jpg') no-repeat center center fixed;
    background-size: cover;
    color: white;
}
h2{
    color: white;
}
.form-toggle {
    text-align: center;
    color: white;
}
.form-toggle a {
    color: white;
    text-decoration: underline;
}
.message.error {
    background-color: rgba(255, 0, 0, 0.7);
    color: white;
    padding: 10px;
    margin-bottom: 10px;
}
.message.success {
    background-color: rgba(0, 128, 0, 0.7);
    color: white;
    padding: 10px;
    margin-bottom: 10px;
}
input, button {
    display: block;
    margin: 10px auto;
    padding: 10px;
    width: 90%;
    max-width: 300px;
    border-radius: 5px;
    border: none;
}
button {
    background-color: #222;
    color: white;
    cursor: pointer;
}
button:hover {
    background-color: #555;
}


</style>

<h2>Inscription</h2>
<div style="text-align:center; margin-bottom: 20px;">
    <img src="assets/img/jumperab&w.png" alt="Logo Jumper" style="max-width: 200px; height: auto;">
</div>

<?php if ($success): ?>
    <div class="message success">Inscription réussie. <a href="login.php">Connectez-vous ici</a>.</div>
<?php else: ?>
    <?php foreach ($errors as $error): ?>
        <div class="message error"><?=htmlspecialchars($error)?></div>
    <?php endforeach; ?>

    <form method="post" action="register.php">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required />
        <input type="email" name="email" placeholder="Adresse email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required />
        <button type="submit">S'inscrire</button>
    </form>

    <p class="form-toggle">
        Déjà un compte ? <a href="login.php">Connectez-vous ici</a>.
    </p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
