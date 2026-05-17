<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sécurité : réservé uniquement au profil admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "Erreur : Accès refusé.";
    exit();
}

$email_cible = $_POST['email'] ?? null;
$action = $_POST['action'] ?? null; // Prendra la valeur 'bloquer' ou 'debloquer'

if (!$email_cible || !$action) {
    echo "Erreur : Paramètres manquants.";
    exit();
}

$chemin_json = "data/profil.json";
$utilisateurs = json_decode(file_get_contents($chemin_json), true) ?? [];
$mis_a_jour = false;

foreach ($utilisateurs as &$u) {
    if ($u['login'] === $email_cible) {
        if ($action === 'bloquer') {
            $u['statut_compte'] = 'bloqué';
        } else {
            $u['statut_compte'] = 'actif';
        }
        $mis_a_jour = true;
        break;
    }
}

if ($mis_a_jour) {
    file_put_contents($chemin_json, json_encode($utilisateurs, JSON_PRETTY_PRINT));
    echo "Succès";
} else {
    echo "Erreur : Utilisateur introuvable.";
}
