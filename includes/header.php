<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🛡️ VERROU DE SÉCURITÉ : Expulsion immédiate des utilisateurs bloqués
if (isset($_SESSION['user_login'])) {
    $liste_comptes = [];
    if (file_exists("data/profil.json")) {
        $liste_comptes = json_decode(file_get_contents("data/profil.json"), true) ?? [];
    }
    
    foreach ($liste_comptes as $compte) {
        // Si l'identifiant correspond et que le statut en base est 'bloqué'
        if ($compte['login'] === $_SESSION['user_login'] && isset($compte['statut']) && strtolower($compte['statut']) === 'bloqué') {
            
            // 🟥 Nettoyage complet et destruction de la session sur-le-champ
            $_SESSION = array();
            if (ini_get("session_use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
            
            // Redirection immédiate vers l'accueil avec un message d'alerte
            header("Location: index.php?erreur=compte_bloque");
            exit();
        }
    }
}

// Bouclier anti-blocage instantané
if (isset($_SESSION['user_login'])) {
    $utilisateurs_verif = json_decode(file_get_contents("data/profil.json"), true) ?? [];
    foreach ($utilisateurs_verif as $u_verif) {
        if ($u_verif['login'] === $_SESSION['user_login']) {
            if (isset($u_verif['statut_compte']) && $u_verif['statut_compte'] === 'bloqué') {
                // On détruit sa session sur-le-champ
                session_unset();
                session_destroy();
                header("Location: connexion.php?erreur=bloque");
                exit();
            }
            break;
        }
    }
}
?>
<header>
    <div class="logo">
        <h1>FC BURGER DREUX ⚽</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Le Stade</a></li>
            <li><a href="menu.php">La Compo</a></li>
            <li><a href="panier.php">Mon Panier</a></li>
            <li><a href="notation.php">Avis</a></li>
            <li>

                <?php if (isset($_SESSION['user_nom'])): ?>
                <li><a href="profil.php" class="nav-profile">Licence de <?php echo $_SESSION['user_nom']; ?></a></li>

                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="admin.php" class="nav-admin">Coach (Admin)</a></li>
                <?php endif; ?>

                <?php if ($_SESSION['user_role'] === 'restaurateur' || $_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="restaurateur.php" class="nav-kitchen">👨‍🍳 Ma Cuisine</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'livreur' || $_SESSION['user_role'] === 'admin')): ?>
                    <li><a href="livreur.php" class="nav-delivery">🚲 Livraisons</a></li>
                <?php endif; ?>

                <li><a href="deconnexion.php" class="nav-logout">Quitter le terrain</a></li>
            <?php else: ?>
                <li><a href="connexion.php">Vestiaires (Connexion)</a></li>
            <?php endif; ?>

            <li>
                <button id="theme-toggle" style="background:none; border:none; cursor:pointer; font-size:1.2em;">
                    🌙
                </button>
            </li>
        </ul>
    </nav>
</header>

