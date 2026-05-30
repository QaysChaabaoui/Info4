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
                <button class="filter-btn active" data-cat="all">Tout l'effectif</button>
                <button class="filter-btn" data-cat="Attaquants">⚽ Attaquants (Burgers)</button>
                <button class="filter-btn" data-cat="Défense">🛡️ Défenseurs (Snacks)</button>
                <button class="filter-btn" data-cat="Banc">🍦 Remplaçants (Desserts)</button>
                <button class="filter-btn" data-cat="Spianouch">⭐ Spécialités</button>
            </div>

            <div class="extra-filters-bar">
                <div class="extra-filter-group">
                    <span>Régimes :</span>
                    <label><input type="checkbox" class="menu-checkbox" name="regime" value="Végétarien">
                        Végétarien</label>
                    <label><input type="checkbox" class="menu-checkbox" name="regime" value="Gluten"> Sans
                        Gluten</label>
                    <label><input type="checkbox" class="menu-checkbox" name="regime" value="Lactose"> Sans
                        Lactose</label>
                </div>

                <div class="extra-filter-group">
                    <span>Saveurs :</span>
                    <label><input type="checkbox" class="menu-checkbox" name="gout" value="Épicé"> Épicé 🌶️</label>
                    <label><input type="checkbox" class="menu-checkbox" name="gout" value="Sucré"> Sucré</label>
                </div>

                <div class="extra-filter-group">
                    <span>📊 Tri :</span>
                    <select id="menu-sort" class="sort-dropdown">
                        <option value="default">Par défaut</option>
                        <option value="prix_croissant">Prix : Croissant 📈</option>
                        <option value="prix_decroissant">Prix : Décroissant 📉</option>
                    </select>
                </div>
            </div>
            <div class="compo-mystere-container">
                <a href="compo_mystere.php" class="btn-action">
                    🎲 Tenter la Compo Mystère du Coach (-10% Tactique)
                </a>
            </div>
        </section>

        <section class="search-section">
            <h2>Trouve ton match 🍔</h2>
            <div class="search-box">
                <input type="text" id="search-burger" placeholder="Rechercher un burger...">
                <button type="button" id="btn-search-go">Go !</button>
            </div>
        </section>

        <section class="menu-grid">
            <div id="product-grid" class="product-grid">
                <?php include('filtrer_menu.php'); // Charge tout l'effectif au début ?>
            </div>
        </section>
    </main>

    <script>
        let categorieChoisie = "all";

        // Écouteurs sur les boutons de catégorie (Attaquants, Défense, etc.)
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function () {
                // Gestion de la classe active d'origine
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // On retient la catégorie du bouton
                categorieChoisie = this.getAttribute('data-cat');
                lancerTactiqueAjax();
            });
        });

        // Écouteurs sur les cases à cocher et le tri (Prix croissant/décroissant)
        document.querySelectorAll('.menu-checkbox').forEach(box => {
            box.addEventListener('change', lancerTactiqueAjax);
        });
        document.getElementById('menu-sort').addEventListener('change', lancerTactiqueAjax);
        document.getElementById('search-burger').addEventListener('input', lancerTactiqueAjax);
        document.getElementById('btn-search-go').addEventListener('click', lancerTactiqueAjax);

        // 3. Fonction pour lancer l'Ajax et mettre à jour la grille sans recharger la page
        function lancerTactiqueAjax() {
            let structureFiltres = {
                categorie: categorieChoisie,
                regimes: [],
                gouts: []
            };

            document.querySelectorAll('.menu-checkbox:checked').forEach(box => {
                if (box.name === 'regime') structureFiltres.regimes.push(box.value);
                if (box.name === 'gout') structureFiltres.gouts.push(box.value);
            });

            let triActif = document.getElementById('menu-sort').value;

            // Récupération du texte de recherche
            let rechercheTexte = document.getElementById('search-burger').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'filtrer_menu.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('product-grid').innerHTML = this.responseText;
                }
            };

            // Envoi des paramètres de filtre, tri et recherche au serveur
            let parametres = "filtres=" + JSON.stringify(structureFiltres) + "&tri=" + triActif + "&recherche=" + encodeURIComponent(rechercheTexte);
            xhr.send(parametres);
        }
    </script>

    <?php require_once('includes/footer.php'); ?>
</body>

</html>
