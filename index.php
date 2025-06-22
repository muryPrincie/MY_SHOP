<?php
require_once 'includes/auth.php';
include 'includes/header.php';
?>

<!-- Section Nouveauté en haut -->
<section class="highlight-card container">
    <h2>Nouveauté : Air Jordan 4 Retro "Fire Red"</h2>
    <p>La mythique Jordan 4 revient dans sa version Fire Red, alliance parfaite entre performance et style.</p>
    <a href="product.php?id=20" class="button">Voir le produit</a>
</section>

<!-- Vidéo promo au centre -->
<div class="video-container container">
    <video autoplay muted loop playsinline class="background-video">
        <source src="assets/videos/Mens_Basketball _Hype_Video.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
</div>

<!-- Cartes promo à gauche et droite de la vidéo -->
<section class="side-cards">
    <div class="side-card left">
        <img src="assets/img/products/tshirt_jordan_flight.jpg" alt="T-shirt Jordan">
        <h3>Haut : T-shirt Jordan Flight</h3>
        <p>Style et confort ultime pour l’entraînement ou le quotidien.</p>
        <a href="product.php?id=5" class="button">Voir</a>
    </div>

    <div class="side-card right">
        <img src="assets/img/products/pantalon_jordan_fleece.jpg" alt="Pantalon Jordan">
        <h3>Bas : Pantalon Jordan Essentials Fleece</h3>
        <p>Chaleur et souplesse pour affronter l’hiver ou les vestiaires.</p>
        <a href="product.php?id=13" class="button">Voir</a>
    </div>
</section>

<!-- Cartes supplémentaires sous la vidéo -->
<section class="promo-cards">
    <div class="promo-card">
        <img src="assets/img/products/ballon_spalding_tf1000.jpg" alt="Ballon Spalding">
        <h3>Ballon Spalding TF-1000</h3>
        <p>Le ballon officiel pour les matchs pros et amateurs.</p>
        <a href="product.php?id=9" class="button">Voir</a>
    </div>

    <div class="promo-card">
        <img src="assets/img/products/sac_nba_spalding.jpg" alt="Sac NBA Spalding">
        <h3>Accessoire : Sac à dos NBA Spalding</h3>
        <p>Parfait pour transporter vos équipements de match.</p>
        <a href="product.php?id=7" class="button">Voir</a>
    </div>

    <div class="promo-card">
        <img src="assets/img/products/chaussettes_nike_elite.jpg" alt="Chaussettes Nike Elite">
        <h3>Chaussettes Nike Elite</h3>
        <p>Confort et maintien optimal sur le terrain.</p>
        <a href="product.php?id=8" class="button">Voir</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<style>
body {
    background: url('assets/img/valo.jpeg') no-repeat center center fixed;
    background-size: cover;
    color: white;
}