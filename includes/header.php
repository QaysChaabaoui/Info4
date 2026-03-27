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
            
            <?php 
            if(isset($_SESSION['user_nom'])): ?>
                <li><a href="profil.php" style="color: var(--jaune-or);">Licence de <?php echo $_SESSION['user_nom']; ?></a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="connexion.php">Vestiaires (Connexion)</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
