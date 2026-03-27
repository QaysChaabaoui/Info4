<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licence Mbappé - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="profile-section">
            <h2>👤 Licence de Joueur : Mbappé K.</h2>

            <div class="license-card">
                <div class="license-header">
                    <img src="https://ui-avatars.com/api/?name=Kylian+Mbappe&background=0055A4&color=fff"
                        alt="Avatar Joueur" class="avatar">
                    <div class="player-info">
                        <h3>Kylian Mbappé<span class="edit-icon">✏️</span></h3>
                        <p>Poste : Ailier Gauche <span class="edit-icon">✏️</span></p>
                        <p class="club">Club : FC Burger Dreux</p>
                    </div>
                    <div class="logo-mini"></div>
                </div>

                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">8</span>
                        <span class="stat-label">Matchs Joués<br>(Commandes)</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">29</span>
                        <span class="stat-label">Buts Marqués<br>(Points Fidélité)</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number" style="color: #C0C0C0;">Argent</span>
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
                                <td>10/06/2025</td>
                                <td>Box 3eme Mi-temps</td>
                                <td>16.00 €</td>
                            </tr>
                            <tr>
                                <td>23/09/2025</td>
                                <td>Smash Star</td>
                                <td>9,00 €</td>
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

