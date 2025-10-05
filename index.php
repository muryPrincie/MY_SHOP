<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop - Accueil</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('assets/img/valo.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        header, footer {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .highlight-card, .side-card, .promo-card {
            background: rgba(0,0,0,0.6);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .highlight-card h2 {
            color: white;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background: #ff0000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .video-container {
            position: relative;
            overflow: hidden;
            height: 400px;
            margin-bottom: 30px;
        }
        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .side-cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        .side-card {
            flex: 1;
            min-width: 300px;
        }
        .promo-cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        .promo-card {
            flex: 1;
            min-width: 250px;
        }
        img {
            max-width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenue sur My Shop</h1>
</header>

<section class="highlight-card container">
    <h2>Nouveauté : Air Jordan 4 Retro "Fire Red"</h2>
    <p>La mythique Jordan 4 revient dans sa version Fire Red, alliance parfaite entre performance et style.</p>
    <a href="#" class="button">Voir le produit</a>
</section>

<div class="video-container container">
    <video autoplay muted loop playsinline class="background-video">
        <source src="assets/videos/Mens_Basketball_Hype_Video.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la vidéo.
    </video>
</div>

<section class="side-cards container">
    <div class="side-card left">
        <img src="assets/img/products/tshirt_jordan_flight.jpg" alt="T-shirt Jordan">
        <h3>Haut : T-shirt Jordan Flight</h3>
        <p>Style et confort ultime pour l’entraînement ou le quotidien.</p>
        <a href="#" class="button">Voir</a>
    </div>

    <div class="side-card right">
        <img src="assets/img/products/pantalon_jordan_fleece.jpg" alt="Pantalon Jordan">
        <h3>Bas : Pantalon Jordan Essentials Fleece</h3>
        <p>Chaleur et souplesse pour affronter l’hiver ou les vestiaires.</p>
        <a href="#" class="button">Voir</a>
    </div>
</section>

<section class="promo-cards container">
    <div class="promo-card">
        <img src="assets/img/products/ballon_spalding_tf1000.jpg" alt="Ballon Spalding">
        <h3>Ballon Spalding TF-1000</h3>
        <p>Le ballon officiel pour les matchs pros et amateurs.</p>
        <a href="#" class="button">Voir</a>
    </div>

    <div class="promo-card">
        <img src="assets/img/products/sac_nba_spalding.jpg" alt="Sac NBA Spalding">
        <h3>Accessoire : Sac à dos NBA Spalding</h3>
        <p>Parfait pour transporter vos équipements de match.</p>
        <a href="#" class="button">Voir</a>
    </div>

    <div class="promo-card">
        <img src="assets/img/products/chaussettes_nike_elite.jpg" alt="Chaussettes Nike Elite">
        <h3>Chaussettes Nike Elite</h3>
        <p>Confort et maintien optimal sur le terrain.</p>
        <a href="#" class="button">Voir</a>
    </div>
</section>

<footer>
    <p>&copy; 2025 My Shop. Tous droits réservés.</p>
</footer>

</body>
</html>
