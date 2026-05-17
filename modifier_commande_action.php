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
    $_SESSION['montant_deja_paye'] = (float)$commande_cible['montant'];

    if (isset($commande_cible['details_plats']) && is_array($commande_cible['details_plats'])) {
        $_SESSION['panier'] = $commande_cible['details_plats'];
    } else {
        $_SESSION['panier'][1] = [
            'nom' => $commande_cible['articles'],
            'prix' => (float)$commande_cible['montant'],
            'quantite' => 1
        ];
    }
    header("Location: menu.php");
    exit();
} else {
    header("Location: profil.php?erreur=impossible");
    exit();
}
