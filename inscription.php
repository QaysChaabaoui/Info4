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
    <title>Signature de Contrat - Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="login-section">
            <div class="login-card" style="max-width: 600px;">
                <h2>🖊️ Signer au Club (Inscription)</h2>
                <p>Rejoins l'équipe du FC Burger Dreux !</p>

                <form action="traitement_inscription.php" method="POST">

                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" placeholder="Zinedine" required>
                    </div>

                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" placeholder="Zidane" required>
                    </div>

                    <div class="form-group">
                        <label>Email (Numéro de licence / Login)</label>
                        <input type="email" name="login" placeholder="zizou@mail.com" required>
                    </div>

                    <div class="form-group">
                        <label>Adresse (Pour la livraison)</label>
                        <input type="text" name="adresse" placeholder="10 rue du Stade, 28100 Dreux" required>
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn-login">Valider ma signature</button>

                    <p class="switch-account">
                        Déjà joueur ? <a href="connexion.php">Retour au vestiaire (Connexion)</a>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>
</html>
