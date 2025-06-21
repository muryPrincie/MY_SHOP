<?php
require_once 'includes/auth.php';
include 'includes/header.php';
?>

<!-- Section Nouveauté -->
<section class="highlight-card">
    <h2>Nouveauté : Air Jordan XXXVIII</h2>
    <p>Découvrez la toute dernière sneaker de la collection Jordan, conçue pour la performance et le style sur le terrain.</p>
    <a href="product.php?id=1" class="button">Voir le produit</a>
</section>

<!-- Vidéo promo affichée sur la page d'accueil -->
<video autoplay muted loop playsinline class="background-video">
    <source src="assets/videos/Mens_Basketball _Hype_Video.mp4" type="video/mp4">
    Votre navigateur ne supporte pas la vidéo.
</video>

<!-- Section 3 cartes promo -->
<section class="promo-cards">
    <div class="promo-card">
        <img src="assets/img/products/jordan1.jpg" alt="Jordan 1">
        <h3>Jordan 1 Retro</h3>
        <p>L'icône qui a changé la donne. Toujours aussi stylée et intemporelle.</p>
        <a href="product.php?id=1" class="button">Découvrir</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
