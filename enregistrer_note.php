<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_login'])) {
    echo "Erreur : Non connecté.";
    exit();
}

$id_commande = $_POST['id'] ?? null;
$note = $_POST['note'] ?? null;

if (!$id_commande || !$note) {
    echo "Erreur : Données manquantes.";
    exit();
}

$chemin_json = "data/commandes.json";
$commandes = json_decode(file_get_contents($chemin_json), true) ?? [];
$mis_a_jour = false;

foreach ($commandes as &$cmd) {
    // Sécurité : On vérifie que la commande appartient bien au client connecté et qu'elle est livrée
    if ($cmd['id'] == $id_commande && $cmd['client'] === $_SESSION['user_login'] && strtolower($cmd['statut']) === 'livrée') {
        
        // On enregistre la note (et on empêche de noter plusieurs fois en écrasant ou bloquant)
        $cmd['note'] = (int)$note;
        $mis_a_jour = true;
        break;
    }
}

if ($mis_a_jour) {
    file_put_contents($chemin_json, json_encode($commandes, JSON_PRETTY_PRINT));
    echo "Note enregistrée !";
} else {
    echo "Erreur : Action impossible.";
}
