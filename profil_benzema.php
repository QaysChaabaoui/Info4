<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licence Benzema - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="profile-section">
            <h2>👤 Licence de Joueur : Benzema K.</h2>

            <div class="license-card">
                <div class="license-header">
                    <img src="https://ui-avatars.com/api/?name=Karim+Benzema&background=F1C40F&color=000"
                        alt="Avatar Joueur" class="avatar">
                    <div class="player-info">
                        <h3>Karim Benzema<span class="edit-icon">✏️</span></h3>
                        <p>Poste : Attaquant de Soutien (Technique)<span class="edit-icon">✏️</span></p>
                        <p class="club">Club : FC Burger Dreux</p>
                    </div>
                    <div class="logo-mini"></div>
                </div>

                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">5</span>
                        <span class="stat-label">Matchs Joués<br>(Commandes)</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">18</span>
                        <span class="stat-label">Buts Marqués<br>(Points Fidélité)</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number" style="color: #CD7F32;">Bronze</span>
                        <span class="stat-label">Division<br>(Rang)</span>
                    </div>
                </div>
                <div class="order-history">
                    <h3>📜 Derniers Matchs (Commandes)</h3>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Match (Commande)</th>
                                <th>Score (Montant)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/05/2025</td>
                                <td>Le Drouais Royal + Frites</td>
                                <td>14.50 €</td>
                            </tr>
                            <tr>
                                <td>30/07/2025</td>
                                <td>Smash Star</td>
                                <td>9.00 €</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="license-footer">
                        <p>Valable pour la saison 2025-2026</p>
                    </div>
                </div>

            </div>
            <div class="actions">
                <a href="admin.html" class="btn-logout"
                    style="text-decoration: none; background: var(--bleu-dreux); text-align: center;">Retour au
                    Bureau</a>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>

</html>
