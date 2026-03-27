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

                <form action="profil.html">
                    <div class="form-group">
                        <label for="email">Numéro de Licence (Email)</label>
                        <input type="email" id="email" placeholder="joueur@fcburger.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Code Tactique (Mot de passe)</label>
                        <input type="password" id="password" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn-login">Entrer sur le terrain</button>
                    
                    <p class="switch-account">
                        Pas encore de licence ? <a href="inscription.html">Signer mon contrat (Inscription)</a>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>
</html>
