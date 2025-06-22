<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';


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

       
        var_dump('Username reçu : ', $username);
        var_dump('Utilisateur trouvé : ', $user);
        exit(); 

        if ($user && password_verify($password, $user['password'])) {
           
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['admin'] = $user['admin'] ?? 0;

            header('Location: index.php');
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

<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" require_onced />
    <input type="password" name="password" placeholder="Mot de passe" require_onced />
    <button type="submit">Se connecter</button>
</form>

<?php include 'includes/footer.php'; ?>
