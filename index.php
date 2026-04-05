<?php
// 1. On lance la session AVANT tout code HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FC Burger Dreux - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="hero-banner">
            <h2>Prêt pour le coup d'envoi ? </h2>
            <p>Les meilleurs burgers de Dreux, livrés plus vite qu'une contre-attaque.</p>
            <a href="menu.php" class="btn-action">Voir la compo d'équipe</a>
        </section>

        <section class="featured-products">
            <h2>🏆 Les Titulaires du Jour</h2>

            <div class="product-grid">

                <article class="card">
                    <div class="card-photo-container">
                        <img src="img/drouais-royal.jpg" alt="Le Drouais Royal">
                    </div>
                    <h3>LE DROUAIS ROYAL</h3>
                    <p>Le capitaine de l'attaque : un double steak généreux et son fromage local.</p>
                    <form action="ajouter_panier.php" method="GET" class="price-container">
                        <input type="hidden" name="id" value="1">
                        <input type="hidden" name="nom" value="Le Drouais Royal">
                        <input type="hidden" name="prix" value="10.50">
                        <span class="price-pill">10,50 €</span>
                        <input type="number" name="qte" value="1" min="1" class="input-qte-menu">
                        <button type="submit" class="btn-select">Ajouter </button>
                    </form>
                </article>

                <article class="card">
                    <div class="card-photo-container">
                        <img src="img/menu-victoire.jpg" alt="Menu Victoire">
                    </div>
                    <h3>Menu "Victoire"</h3>
                    <p>Le triplé gagnant : un Smash Star, des frites Penalty et un soda Mi-Temps.</p>
                    <form action="ajouter_panier.php" method="GET" class="price-container">
                        <input type="hidden" name="id" value="16">
                        <input type="hidden" name="nom" value="Menu Victoire">
                        <input type="hidden" name="prix" value="13.00">
                        <span class="price-pill">13,00 €</span>
                        <input type="number" name="qte" value="1" min="1" class="input-qte-menu">
                        <button type="submit" class="btn-select">Ajouter </button>
                    </form>
                </article>

                <article class="card">
                    <div class="card-photo-container">
                        <img src="img/box-3eme-mi-temps.jpg" alt="Box 3ème Mi-temps">
                    </div>
                    <h3>Box "3ème Mi-temps" 🍗</h3>
                    <p>Pour l'esprit d'équipe : 20 nuggets croustillants à partager.</p>
                    <form action="ajouter_panier.php" method="GET" class="price-container">
                        <input type="hidden" name="id" value="9">
                        <input type="hidden" name="nom" value="Box 3ème Mi-temps">
                        <input type="hidden" name="prix" value="16.00">
                        <span class="price-pill">16,00 €</span>
                        <input type="number" name="qte" value="1" min="1" class="input-qte-menu">
                        <button type="submit" class="btn-select">Ajouter </button>
                    </form>
                </article>

                <article class="card">
                    <div class="card-photo-container">
                        <img src="img/hugoat-box.jpg" alt="Hugoat Box">
                    </div>
                    <h3>Hugoat box</h3>
                    <p>Kebab du Kop, Wings et Tiramisu pour finir en beauté.</p>
                    <form action="ajouter_panier.php" method="GET" class="price-container">
                        <input type="hidden" name="id" value="17">
                        <input type="hidden" name="nom" value="Hugoat Box">
                        <input type="hidden" name="prix" value="10.00">
                        <span class="price-pill">10,00 €</span>
                        <input type="number" name="qte" value="1" min="1" class="input-qte-menu">
                        <button type="submit" class="btn-select">Ajouter </button>
                    </form>
                </article>

                <article class="card">
                    <div class="card-photo-container">
                        <img src="img/abaddi-box.jpg" alt="Abaddi Box">
                    </div>
                    <h3>La Abaddi box</h3>
                    <p>Hot-Dog des Tribunes, Onion Rings et Tiramisu du Champion.</p>
                    <form action="ajouter_panier.php" method="GET" class="price-container">
                        <input type="hidden" name="id" value="18">
                        <input type="hidden" name="nom" value="Abaddi Box">
                        <input type="hidden" name="prix" value="12.00">
                        <span class="price-pill">12,00 €</span>
                        <input type="number" name="qte" value="1" min="1" class="input-qte-menu">
                        <button type="submit" class="btn-select">Ajouter </button>
                    </form>
                </article>

            </div>
        </section>

        <section class="search-section">
            <h2>Trouve ton match 🍔</h2>
            <div class="search-box">
                <input type="text" placeholder="Rechercher un burger...">
                <button>Go !</button>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>

</html>
