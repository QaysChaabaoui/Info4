<?php 
require_once('includes/header.php'); 

// On vérifie qui parle pour enregistrer l'avis au bon nom
$nom_joueur = isset($_SESSION['user_nom']) ? $_SESSION['user_nom'] : "Anonyme";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Après-Match (Avis) - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="login-section">
            <div class="login-card card-notation">
                <h2>⭐ Note ton Match</h2>
                <p>Donne ton analyse tactique sur ton dernier burger !</p>

                <form action="#">
                    <div class="form-group">
                        <label>Ta Note (Étoiles)</label>
                        <select class="form-input-custom">
                            <option>⭐⭐⭐⭐⭐ - Ballon d'Or</option>
                            <option>⭐⭐⭐⭐ - Qualifié d'office</option>
                            <option>⭐⭐⭐ - Match nul</option>
                            <option>⭐⭐ - Carton Jaune</option>
                            <option>⭐ - Relégation</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ton Analyse (Commentaire)</label>
                        <textarea class="form-input-custom" placeholder="Le Drouais Royal était incroyable..." rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn-login">Envoyer le Rapport</button>
                </form>
            </div>
        </section>

        <section class="cart-section section-avis">
            <h2 class="centered-title">🏟️ Les Avis du Kop (Supporters)</h2>
            
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
                            <td><span class="supporter-name">Zizou28</span></td>
                            <td><span class="stars-display">⭐⭐⭐⭐⭐</span></td>
                            <td>"Le Smash Star est plus précis qu'une de mes passes. Un régal !"</td>
                        </tr>
                        <tr>
                            <td><span class="supporter-name">KM_Sept</span></td>
                            <td><span class="stars-display">⭐⭐⭐⭐⭐</span></td>
                            <td>"Vitesse de livraison incroyable, comme une contre-attaque."</td>
                        </tr>
                        <tr>
                            <td><span class="supporter-name">KB_Nueve</span></td>
                            <td><span class="stars-display">⭐⭐⭐⭐</span></td>
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

