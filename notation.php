<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Après-Match (Avis) - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="login-section">
            <div class="login-card" style="max-width: 500px;">
                <h2>⭐ Note ton Match</h2>
                <p>Donne ton analyse tactique sur ton dernier burger !</p>

                <form action="#">
                    <div class="form-group">
                        <label>Ta Note (Étoiles)</label>
                        <select style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                            <option>⭐⭐⭐⭐⭐ - Ballon d'Or</option>
                            <option>⭐⭐⭐⭐ - Qualifié d'office</option>
                            <option>⭐⭐⭐ - Match nul</option>
                            <option>⭐⭐ - Carton Jaune</option>
                            <option>⭐ - Relégation</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ton Analyse (Commentaire)</label>
                        <textarea placeholder="Le Drouais Royal était incroyable..." rows="4" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; font-family: inherit;"></textarea>
                    </div>

                    <button type="submit" class="btn-login">Envoyer le Rapport</button>
                </form>
            </div>
        </section>

        <section class="cart-section" style="margin-top: 50px;">
            <h2 style="text-align: center;">🏟️ Les Avis du Kop (Supporters)</h2>
            
            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Supporter</th>
                            <th>Note</th>
                            <th>Analyse Tactique</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Zizou28</strong></td>
                            <td style="color: var(--jaune-or);">⭐⭐⭐⭐⭐</td>
                            <td>"Le Smash Star est plus précis qu'une de mes passes. Un régal !"</td>
                        </tr>
                        <tr>
                            <td><strong>KM_Sept</strong></td>
                            <td style="color: var(--jaune-or);">⭐⭐⭐⭐⭐</td>
                        </tr>
                        <tr>
                            <td><strong>KB_Nueve</strong></td>
                            <td style="color: var(--jaune-or);">⭐⭐⭐⭐</td>
                            <td>"Solide défense des frites Penalty. Je reviendrai pour la revanche."</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>

