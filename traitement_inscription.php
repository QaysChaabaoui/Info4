<?php
$prenom = $_POST['prenom'] ?? '';
$nom = $_POST['nom'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$adresse = $_POST['adresse'] ?? '';

$file_path = "data/profil.json";
$utilisateurs = json_decode(file_get_contents($file_path), true);

// Vérification si le joueur existe déjà
foreach ($utilisateurs as $u) {
    if ($u['login'] === $login) {
        header("Location: inscription.php?error=deja_inscrit");
        exit();
    }
}

// Création du nouveau profil
$nouveau_joueur = [
    "login" => $login,
    "password" => $password,
    "role" => "client", // Rôle automatique à l'inscription
    "nom" => $nom,
    "prenom" => $prenom,
    "adresse" => $adresse,
    "date_inscription" => date("d/m/Y") // Ajout de la date demandée
];

// Ajout et sauvegarde
$utilisateurs[] = $nouveau_joueur;
file_put_contents($file_path, json_encode($utilisateurs, JSON_PRETTY_PRINT));

header("Location: connexion.php?success=inscrit");
exit();
?>
