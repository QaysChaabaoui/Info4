<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['prix'])) {
    $id = $_GET['id'];
    $qte = isset($_GET['qte']) ? (int) $_GET['qte'] : 1; // Récupère la quantité

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Si le produit existe déjà, on ajoute la nouvelle quantité
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite'] += $qte;
    } else {
        $_SESSION['panier'][$id] = [
            'nom' => $_GET['nom'],
            'prix' => (float) $_GET['prix'],
            'quantite' => $qte
        ];
    }
}

// On renvoie l'utilisateur sur la page d'où il vient
$page_precedente = $_SERVER['HTTP_REFERER'] ?? 'menu.php';
header("Location: " . $page_precedente);
exit();
?>
