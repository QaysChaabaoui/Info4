<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'restaurateur' && $_SESSION['user_role'] !== 'admin')) {
    echo "Erreur : Accès refusé.";
    exit();
}

$id_commande = $_POST['id'] ?? null;
$nouveau_statut = $_POST['statut'] ?? null;
$livreur_assigne = $_POST['livreur'] ?? null;

if (!$id_commande) {
    echo "Erreur : Commande manquante.";
    exit();
}

$chemin_json = "data/commandes.json";
$commandes = [];

if (file_exists($chemin_json)) {
    $commandes = json_decode(file_get_contents($chemin_json), true) ?? [];
}

$mise_a_jour_reussie = false;

foreach ($commandes as &$cmd) {
    if ($cmd['id'] == $id_commande) {
        if ($nouveau_statut !== null) {
            $cmd['statut'] = $nouveau_statut;
        }
        if ($livreur_assigne !== null) {
            $cmd['livreur'] = $livreur_assigne;
        }
        $mise_a_jour_reussie = true;
        break;
    }
}

if ($mise_a_jour_reussie) {
    file_put_contents($chemin_json, json_encode($commandes, JSON_PRETTY_PRINT));
    echo "Match mis à jour avec succès !";
} else {
    echo "Erreur : Match introuvable.";
}
