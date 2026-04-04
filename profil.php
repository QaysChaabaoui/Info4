<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// On vérifie quel profil afficher AVANT d'afficher le menu
$email_cible = $_GET['email'] ?? $_SESSION['user_login'] ?? null;

if (!$email_cible) {
    header("Location: index.php");
    exit();
}

$utilisateurs = json_decode(file_get_contents("data/profil.json"), true);
$joueur_fiche = null;

foreach ($utilisateurs as $u) {
    if ($u['login'] === $email_cible) {
        $joueur_fiche = $u;
        break;
    }
}

if (!$joueur_fiche) {
    header("Location: index.php"); // On redirige si le joueur n'existe pas
    exit();
}

require_once('includes/header.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Licence de <?php echo $joueur_fiche['nom']; ?> - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="profile-section">
            <h2>LICENCE DE JOUEUR : 
                <?php echo $joueur_fiche['prenom'] . " " . substr($joueur_fiche['nom'], 0, 1) . "."; ?>
            </h2>

            <div class="license-card">
                <div class="license-header">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($joueur_fiche['prenom'] . '+' . $joueur_fiche['nom']); ?>&background=random" alt="Avatar" class="avatar">
                    
                    <div class="player-info">
                        <h3>
                            <?php echo $joueur_fiche['prenom'] . " " . $joueur_fiche['nom']; ?>
                            <span class="edit-icon">✏️</span>
                        </h3>
                        <p>Poste : <?php echo ($joueur_fiche['role'] === 'admin' ? 'Coach' : 'Avant-Centre (Gourmand)'); ?> <span class="edit-icon">✏️</span></p>
                        <p class="club">Club : FC Burger Dreux</p>
                    </div>
                </div>

                <div class="actions">
                    <a href="admin.php" class="btn-logout" style="text-decoration: none; background: var(--bleu-dreux); text-align: center; display: block; padding: 10px; color: white;">Retour au Bureau</a>
                </div>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
