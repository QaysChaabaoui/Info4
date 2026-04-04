<?php
session_start(); // OBLIGATOIRE : on doit ouvrir la session pour pouvoir la fermer
session_unset(); // On vide les variables
session_destroy(); // On détruit le fichier de session sur le serveur
header("Location: index.php"); // On renvoie vers l'accueil
exit();
?>
