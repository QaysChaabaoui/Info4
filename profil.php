<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licence Zidane - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="profile-section">
            <h2>👤 Licence de joueur : Zinedine Z.</h2>

            <div class="license-card">
                <div class="license-header">
                    <img src="https://ui-avatars.com/api/?name=Zidane+B&background=random" alt="Avatar Joueur"
                        class="avatar">
                    <div class="player-info">
                        <h3>Zinedine Zidane<span class="edit-icon">✏️</span></h3>
                        <p>Poste : Avant-Centre (Gourmand)<span class="edit-icon">✏️</span></p>
                        <p class="club">Club : FC Burger Dreux</p>
                    </div>
                    <div class="logo-mini"></div>
                </div>

                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">12</span>
                        <span class="stat-label">Matchs Joués<br>(Commandes)</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">45</span>
                        <span class="stat-label">Buts Marqués<br>(Points Fidélité)</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">Or</span>
                        <span class="stat-label">Division<br>(Rang)</span>
                    </div>
                </div>
                <div class="order-history">
                    <h3>📜 Derniers Matchs (Commandes)</h3>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Compo</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>20/02/2025</td>
                                <td>Hugoat Box</td>
                                <td>10.00 €</td>
                            </tr>
                            <tr>
                                <td>15/02/2025</td>
                                <td>Drouais Royal + Frites</td>
                                <td>14.50 €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="license-footer">
                    <p>Valable pour la saison 2025-2026</p>
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

