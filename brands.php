<?php
require 'includes/config.php';

$stmt = $pdo->query("SELECT * FROM brands ORDER BY name");
$brands = $stmt->fetchAll();

include 'includes/header.php';
?>

<h1>Nos Marques</h1>
<ul>
<?php foreach($brands as $brand): ?>
    <li>
        <a href="categories.php?brand_id=<?= $brand['id'] ?>">
            <?= htmlspecialchars($brand['name']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>
