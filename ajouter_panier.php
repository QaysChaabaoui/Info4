<?php
// On vérifie si la session n'est pas déjà lancée avant de la démarrer
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['prix'])) {
    $id = $_GET['id'];
    
    if (!isset($_SESSION['panier'])) { 
        $_SESSION['panier'] = []; 
    }

    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite']++;
    } else {
        $_SESSION['panier'][$id] = [
            'nom' => $_GET['nom'],
            'prix' => (float)$_GET['prix'],
            'quantite' => 1
        ];
    }
}

// On force la redirection vers le menu
header("Location: menu.php");
exit();