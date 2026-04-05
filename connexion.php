<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_login'])) {
    header("Location: profil.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vestiaires - Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="login-section">
            <div class="login-card">
                <h2>🚪 Accès Vestiaires</h2>
                <p>Identifie-toi pour entrer sur la feuille de match.</p>

                <form action="traitement_connexion.php" method="POST">
                    <div class="form-group">
                        <label for="email">Numéro de Licence (Email)</label>
                        <input type="email" name="email" id="email" placeholder="joueur@fcburger.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Code Tactique (Mot de passe)</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn-login">Entrer sur le terrain</button>
                    <p class="switch-account" style="margin-top: 20px; text-align: center; font-size: 0.9em;">
                        Pas encore dans l'effectif ?
                        <a href="inscription.php"
                            style="color: var(--bleu-dreux); font-weight: bold; text-decoration: none;">
                            Signer un contrat ici 🖊️
                        </a>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>
</html>
