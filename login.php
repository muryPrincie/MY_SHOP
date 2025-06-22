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

<style>
  body {
    background-image: url('assets/img/DC2.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  form {
    background-color: rgba(255, 255, 255, 0.85);
    padding: 20px;
    max-width: 400px;
    margin: 40px auto;
    border-radius: 8px;
  }

  .message.error {
    background-color: #f8d7da;
    color: #842029;
    border: 1px solid #f5c2c7;
    padding: 10px;
    max-width: 400px;
    margin: 20px auto;
    border-radius: 4px;
    text-align: center;
  }
</style>

<h2 style="text-align:center; color:#222;">Connexion</h2>

<?php foreach ($errors as $error): ?>
    <div class="message error"><?=htmlspecialchars($error)?></div>
<?php endforeach; ?>

<form method="post" action="login.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required />
    <input type="password" name="password" placeholder="Mot de passe" required />
    <button type="submit">Se connecter</button>
</form>

<p class="form-toggle" style="text-align:center; color:#fff;">
    Pas encore de compte ? <a href="register.php" style="color:#fff;">Inscrivez-vous ici</a>.
</p>


<?php include 'includes/footer.php'; ?>
