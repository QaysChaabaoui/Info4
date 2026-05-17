<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🛡️ SÉCURITÉ : On ouvre l'accès au Restaurateur, à l'Admin ET au Livreur
if (
    !isset($_SESSION['user_role']) ||
    ($_SESSION['user_role'] !== 'restaurateur' && $_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'livreur')
) {
    echo "Erreur : Accès refusé.";
    exit();
}

// Récupération des données envoyées par les requêtes AJAX (Cuisine ou Livreur)
$id_commande = $_POST['id'] ?? null;
$nouveau_statut = $_POST['statut'] ?? null;
$livreur_assigne = $_POST['livreur'] ?? null; // Transmis par la cuisine pour attribuer un livreur

if (!$id_commande) {
    echo "Erreur : ID de commande manquant.";
    exit();
}

$chemin_json = "data/commandes.json";
$commandes = [];

if (file_exists($chemin_json)) {
    $commandes = json_decode(file_get_contents($chemin_json), true) ?? [];
}

$mis_a_jour = false;

// 🔄 Parcours des commandes pour appliquer les modifications
foreach ($commandes as &$cmd) {
    if ($cmd['id'] === $id_commande) {

        // 1. Si un statut est envoyé, on le force en MAJUSCULES (PRÊTE, EN LIVRAISON, LIVRÉE)
        if ($nouveau_statut !== null) {
            $cmd['statut'] = strtoupper(trim($nouveau_statut));
        }

        // 2. Si la cuisine assigne un livreur à la commande
        if ($livreur_assigne !== null) {
            $cmd['livreur'] = trim($livreur_assigne);
        }

        $mis_a_jour = true;
        break;
    }
}

// 💾 Sauvegarde et retour de la réponse pour le JavaScript
if ($mis_a_jour) {
    file_put_contents($chemin_json, json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Succès"; // Signal textuel attendu par .includes('Succ') dans ton JS
} else {
    echo "Erreur : Commande introuvable dans le système.";
}
