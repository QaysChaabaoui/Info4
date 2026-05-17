<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_commande = $_GET['id'] ?? null;

if (!$id_commande) {
    header("Location: profil.php");
    exit();
}

$toutes_commandes = json_decode(file_get_contents("data/commandes.json"), true) ?? [];
$commande_cible = null;

foreach ($toutes_commandes as $cmd) {
    if ($cmd['id'] == $id_commande && strtolower($cmd['statut']) === 'payée') {
        $commande_cible = $cmd;
        break;
    }
}

if ($commande_cible) {
    $_SESSION['panier'] = [];
    $_SESSION['modification_commande_id'] = $commande_cible['id'];

    // On utilise la clé 'total'
    $_SESSION['montant_deja_paye'] = (float) $commande_cible['total'];

    // Recréer un vrai panier d'articles modifiables
    $chaine_articles = $commande_cible['articles'];
    $tableau_decoupe = explode(', ', $chaine_articles);

    $json_menu = json_decode(file_get_contents("data/Menu.json"), true);
    $catalogue_plats = $json_menu['plats'] ?? [];

    foreach ($tableau_decoupe as $morceau) {
        if (preg_match('/(\d+)\s*x\s*(.+)/', $morceau, $matches)) {
            $quantite = (int) $matches[1];
            $nom_plat = trim($matches[2]);

            // On cherche le produit dans le catalogue pour récupérer son ID et son PRIX réels
            foreach ($catalogue_plats as $plat) {
                if (strcasecmp($plat['nom'], $nom_plat) === 0) {
                    $_SESSION['panier'][$plat['id']] = [
                        'nom' => $plat['nom'],
                        'prix' => (float) $plat['prix'],
                        'quantite' => $quantite
                    ];
                    break;
                }
            }
        }
    }

    header("Location: menu.php");
    exit();
} else {
    header("Location: profil.php?erreur=impossible");
    exit();
}
?>
