<?php
session_start();
session_unset();
session_destroy();
header('Location: ../login.php'); // Retour vers la page de connexion
exit();
?>
