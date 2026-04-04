<?php
session_start();

// Récupération des données du formulaire
$email_saisi = $_POST['email'];
$pass_saisi = $_POST['password'];

// Chargement des comptes depuis le JSON
$utilisateurs = json_decode(file_get_contents("data/profil.json"), true);

$joueur_trouve = false;

foreach ($utilisateurs as $user) {
    if ($user['login'] === $email_saisi && $user['password'] === $pass_saisi) {
        $joueur_trouve = $user;
        break;
    }
}

if ($joueur_trouve) {
    $_SESSION['user_nom'] = $joueur_trouve['nom'];
    $_SESSION['user_prenom'] = $joueur_trouve['prenom']; // INDISPENSABLE
    $_SESSION['user_role'] = $joueur_trouve['role'];
    // On utilise '??' pour donner une valeur par défaut si la clé 'adresse' est absente
    $_SESSION['user_adresse'] = $joueur_trouve['adresse'] ?? 'Adresse non renseignée';
    // Redirection
    header("Location: profil.php");
}
exit();
?>
