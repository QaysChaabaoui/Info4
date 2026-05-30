<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Lecture du menu pour récupérer les plats disponibles (Burgers et Banc)
$chemin_menu = "data/Menu.json";
if (!file_exists($chemin_menu)) {
    header("Location: menu.php?erreur=fichier_introuvable");
    exit();
}

$donnees = json_decode(file_get_contents($chemin_menu), true);
$plats = $donnees['plats'] ?? [];

$attaquants = []; 
$banc = []; 

// Classification des plats en fonction de leur catégorie
foreach ($plats as $p) {
    if (isset($p['cat'])) {
        if ($p['cat'] === 'Attaquants') {
            $attaquants[] = $p;
        } elseif ($p['cat'] === 'Banc') {
            $banc[] = $p;
        }
    }
}

// 2. Vérification de la disponibilité des catégories nécessaires pour la compo mystère
if (!empty($attaquants) && !empty($banc)) {

    // 3. Tirage aléatoire d'un Burger (Attaquant) et d'une boisson/dessert (Banc)
    $burger_choisi = $attaquants[array_rand($attaquants)];
    $accompagnement_choisi = $banc[array_rand($banc)];

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // 4. Application de la réduction de 10% sur les prix des plats tirés
    $prix_reduit_burger = round($burger_choisi['prix'] * 0.90, 2);
    $prix_reduit_acc = round($accompagnement_choisi['prix'] * 0.90, 2);

    // Intégration du Burger du Coach dans ton panier
    $id_b = $burger_choisi['id'];
    if (isset($_SESSION['panier'][$id_b])) {
        $_SESSION['panier'][$id_b]['quantite'] += 1;
    } else {
        $_SESSION['panier'][$id_b] = [
            'nom' => $burger_choisi['nom'] . " (Mystère 🎲)",
            'prix' => $prix_reduit_burger,
            'quantite' => 1
        ];
    }

    // Intégration de l'accompagnement du Coach dans ton panier
    $id_a = $accompagnement_choisi['id'];
    if (isset($_SESSION['panier'][$id_a])) {
        $_SESSION['panier'][$id_a]['quantite'] += 1;
    } else {
        $_SESSION['panier'][$id_a] = [
            'nom' => $accompagnement_choisi['nom'] . " (Mystère 🎲)",
            'prix' => $prix_reduit_acc,
            'quantite' => 1
        ];
    }

    // Redirection vers le panier avec un message de succès
    header("Location: panier.php?compo=success");
    exit();
}

header("Location: menu.php?erreur=compo_impossible");
exit();
