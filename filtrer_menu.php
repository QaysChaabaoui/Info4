<?php
$json_contenu = file_get_contents("data/Menu.json");
$donnees = json_decode($json_contenu, true);
$plats = $donnees['plats'] ?? [];

// Récupération du texte de recherche envoyé en POST
$recherche = $_POST['recherche'] ?? '';

// 1. Filtrage des données selon les critères reçus en POST (catégorie, régimes, goûts)
if (isset($_POST['filtres'])) {
    $filtres = json_decode($_POST['filtres'], true);

    // Filtrage des plats en fonction des critères sélectionnés
    $plats = array_filter($plats, function ($p) use ($filtres, $recherche) {

        // Filtrage par le texte de recherche (si présent)
        if (!empty($recherche) && stripos($p['nom'], $recherche) === false) {
            return false;
        }

        // Filtrage par les boutons du haut (Attaquants, Défense...)
        if ($filtres['categorie'] !== 'all' && $p['cat'] !== $filtres['categorie']) {
            return false;
        }
        // Filtrage par les saveurs
        if (!empty($filtres['gouts'])) {
            foreach ($filtres['gouts'] as $g) {
                if (!isset($p['gout']) || strpos($p['gout'], $g) === false)
                    return false;
            }
        }
        return true;
    });
}

// 2. Tri des plats selon le critère sélectionné (prix croissant/décroissant)
$tri = $_POST['tri'] ?? 'default';
if ($tri === 'prix_croissant') {
    usort($plats, function ($a, $b) {
        return $a['prix'] <=> $b['prix'];
    });
} elseif ($tri === 'prix_decroissant') {
    usort($plats, function ($a, $b) {
        return $b['prix'] <=> $a['prix'];
    });
}

// 3. Retour des données filtrées et triées au format JSON pour que le JavaScript puisse mettre à jour la page sans recharger
if (empty($plats)) {
    echo "<p class='no-match'>Aucun joueur disponible pour cette configuration tactique. ⚽</p>";
} else {
    foreach ($plats as $p) {
        ?>
                <article class="card">
                    <div class="card-photo-container">
                        <img src="img/plat_<?php echo $p['id']; ?>.jpg" alt="<?php echo $p['nom']; ?>">
                    </div>
                    <h3><?php echo $p['nom']; ?></h3>
                    <p><?php echo $p['desc']; ?></p>
                    <form action="ajouter_panier.php" method="GET" class="price-container">
                        <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                        <input type="hidden" name="nom" value="<?php echo $p['nom']; ?>">
                        <input type="hidden" name="prix" value="<?php echo $p['prix']; ?>">

                        <span class="price-pill"><?php echo number_format($p['prix'], 2, ',', ' '); ?> €</span>
                        <input type="number" name="qte" value="1" min="1" class="input-qte-menu">
                        <button type="submit" class="btn-select">Ajouter</button>
                    </form>
                </article>
                <?php
    }
}
?>
