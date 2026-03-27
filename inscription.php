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

                <form action="connexion.html">
                    <div class="form-group">
                        <label>Nom & Prénom</label>
                        <input type="text" placeholder="Zidane Zinedine" required>
                    </div>

                    <div class="form-group">
                        <label>Email (Numéro de licence)</label>
                        <input type="email" placeholder="zizou@mail.com" required>
                    </div>

                    <div class="form-group">
                        <label>Adresse (Pour la livraison)</label>
                        <input type="text" placeholder="10 rue du Stade, 28100 Dreux" required>
                    </div>

                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" placeholder="06 00 00 00 00" required>
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" placeholder="••••••••" required>
                    </div>

                    <div class="form-group">
                        <label>Informations complémentaires (Étage, Digicode...)</label>
                        <input type="text" placeholder="Ex: Digicode 1234, 2ème étage à gauche" required>
                    </div>

                    <button type="submit" class="btn-login">Valider ma signature</button>

                    <p class="switch-account">
                        Déjà joueur ? <a href="connexion.html">Retour au vestiaire (Connexion)</a>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>

</html>

    </footer>

</body>

</html>
