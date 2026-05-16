<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sécurité : on vérifie que la requête est bien un POST et que l'utilisateur est connecté avant de faire quoi que ce soit
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_login'])) {
    echo "Action non autorisée.";
    exit;
}

// Récupération et sécurisation des données envoyées par le formulaire 
$nouveau_prenom = htmlspecialchars($_POST['prenom']);
$nouveau_nom = htmlspecialchars($_POST['nom']);
$nouvelle_adresse = htmlspecialchars($_POST['adresse']);

// Chemin vers le fichier de données
$chemin_json = 'data/profil.json';

if (file_exists($chemin_json)) {
    // On lit le fichier JSON actuel
    $contenu_json = file_get_contents($chemin_json);
    $utilisateurs = json_decode($contenu_json, true);

    $joueur_trouve = false;

    // On parcourt la liste pour trouver le joueur connecté grâce à son email 
    foreach ($utilisateurs as &$user) {
        if (isset($user['login']) && $user['login'] === $_SESSION['user_login']) {
            // On remplace les anciennes valeurs par les nouvelles
            $user['prenom'] = $nouveau_prenom;
            $user['nom'] = $nouveau_nom;
            $user['adresse'] = $nouvelle_adresse;
            $joueur_trouve = true;
            break;
        }
    }

    // Si le joueur a bien été mis à jour, on sauvegarde dans le JSON
    if ($joueur_trouve) {
        file_put_contents($chemin_json, json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // On met aussi à jour la session pour que le header ou le reste du site affiche le bon nom direct
        $_SESSION['user_nom'] = $nouveau_nom;

        // C'est ce texte qui sera renvoyé à l'écran sans recharger la page !
        echo "⚽ Licence mise à jour avec succès (sans rechargement) !";
    } else {
        echo "⚠️ Impossible de trouver votre profil dans la base de données.";
    }
} else {
    echo "⚠️ Fichier de base de données introuvable.";
}
?>
