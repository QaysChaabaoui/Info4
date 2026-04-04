<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
            <?php
            if (isset($_SESSION['user_nom'])): ?>
                <li><a href="profil.php" style="color: var(--jaune-or);">Licence de <?php echo $_SESSION['user_nom']; ?></a>
                </li>
                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="admin.php" style="color: #2ecc71;">Coach (Admin)</a></li>
                <?php endif; ?>
                <li><a href="deconnexion.php" style="color: #ff4757;">Quitter le terrain</a></li>
            <?php else: ?>
                <li><a href="connexion.php">Vestiaires (Connexion)</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
