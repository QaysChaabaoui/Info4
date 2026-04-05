<?php
require_once('includes/header.php');

$json_contenu = file_get_contents("data/Menu.json");
$donnees = json_decode($json_contenu, true);
$plats = $donnees['plats'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Compo - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main>
        <section class="filters-section">
            <h2>📢 La Tactique (Filtres)</h2>
            <div class="filter-buttons">
                <button class="filter-btn active">Tout l'effectif</button>
                <button class="filter-btn">⚽ Attaquants (Burgers)</button>
                <button class="filter-btn">🛡️ Défenseurs (Snacks)</button>
                <button class="filter-btn">🍦 Remplaçants (Desserts)</button>
                <button class="filter-btn">⭐ Spécialités</button>
            </div>
        </section>
        
        <section class="search-section">
            <h2>Trouve ton match 🍔</h2>
            <div class="search-box">
                <input type="text" placeholder="Rechercher un burger...">
                <button>Go !</button>
            </div>
        </section>

        <section class="menu-grid">

            <h3 class="category-title">⚽ Les Attaquants (Nos Burgers)</h3>
            <div class="product-grid">
                <?php foreach ($plats as $p): ?>
                    <?php if ($p['cat'] === "Attaquants"): ?>
                        <article class="card">
                            <div class="card-photo-container">
                                <img src="img/plat_<?php echo $p['id']; ?>.jpg" alt="<?php echo $p['nom']; ?>">
                            </div>
                            <h3><?php echo $p['nom']; ?></h3>
                            <p><?php echo $p['desc']; ?></p>
                            <div class="price-container">
                                <span class="price-pill"><?php echo number_format($p['prix'], 2, ',', ' '); ?> €</span>
                                <a href="ajouter_panier.php?id=<?php echo $p['id']; ?>&nom=<?php echo urlencode($p['nom']); ?>&prix=<?php echo $p['prix']; ?>" 
                                   class="btn-select" style="text-decoration: none; display: inline-block;">
                                   Sélectionner
                                </a>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <h3 class="category-title" style="margin-top: 3rem;">🛡️ La Défense (Snacks & Partage)</h3>
            <div class="product-grid">
                <?php foreach ($plats as $p): ?>
                    <?php if ($p['cat'] == "Défense"): ?>
                        <article class="card">
                            <div class="card-photo-container">
                                <img src="img/plat_<?php echo $p['id']; ?>.jpg" alt="<?php echo $p['nom']; ?>">
                            </div>
                            <h3><?php echo $p['nom']; ?></h3>
                            <p><?php echo $p['desc']; ?></p>
                            <div class="price-container">
                                <span class="price-pill"><?php echo number_format($p['prix'], 2, ',', ' '); ?> €</span>
                                <a href="ajouter_panier.php?id=<?php echo $p['id']; ?>&nom=<?php echo urlencode($p['nom']); ?>&prix=<?php echo $p['prix']; ?>" 
                                   class="btn-select" style="text-decoration: none; display: inline-block;">
                                   Sélectionner
                                </a>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <h3 class="category-title" style="margin-top: 3rem;">🍦 Le Banc de Touche (Douceurs)</h3>
            <div class="product-grid">
                <?php foreach ($plats as $p): ?>
                    <?php if ($p['cat'] == "Banc"): ?>
                        <article class="card">
                            <div class="card-photo-container">
                                <img src="img/plat_<?php echo $p['id']; ?>.jpg" alt="<?php echo $p['nom']; ?>">
                            </div>
                            <h3><?php echo $p['nom']; ?></h3>
                            <p><?php echo $p['desc']; ?></p>
                            <div class="price-container">
                                <span class="price-pill"><?php echo number_format($p['prix'], 2, ',', ' '); ?> €</span>
                                <a href="ajouter_panier.php?id=<?php echo $p['id']; ?>&nom=<?php echo urlencode($p['nom']); ?>&prix=<?php echo $p['prix']; ?>" 
                                   class="btn-select" style="text-decoration: none; display: inline-block;">
                                   Sélectionner
                                </a>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <h3 class="category-title" style="margin-top: 3rem;">⚽ Spianouch Corner (Nos spécialités)</h3>
            <div class="product-grid">
                <?php foreach ($plats as $p): ?>
                    <?php if ($p['cat'] == "Spianouch"): ?>
                        <article class="card">
                            <div class="card-photo-container">
                                <img src="img/plat_<?php echo $p['id']; ?>.jpg" alt="<?php echo $p['nom']; ?>">
                            </div>
                            <h3><?php echo $p['nom']; ?></h3>
                            <p><?php echo $p['desc']; ?></p>
                            <div class="price-container">
                                <span class="price-pill"><?php echo number_format($p['prix'], 2, ',', ' '); ?> €</span>
                                <a href="ajouter_panier.php?id=<?php echo $p['id']; ?>&nom=<?php echo urlencode($p['nom']); ?>&prix=<?php echo $p['prix']; ?>" 
                                   class="btn-select" style="text-decoration: none; display: inline-block;">
                                   Sélectionner
                                </a>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
