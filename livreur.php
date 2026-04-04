<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraisons - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="cart-section">
            <h2>🚚 Tactique de Livraison</h2>
            <p>Gère les commandes et lance le GPS pour ne pas finir en hors-jeu.</p>

            <div class="cart-container">
                <h3 style="margin-bottom: 15px; color: var(--bleu-dreux); text-align: left;">⚽ Matchs en cours (À
                    livrer)</h3>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client & Téléphone</th>
                            <th>Adresse & Infos (Étage, Code...)</th>
                            <th>GPS</th>
                            <th>État</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#442</td>
                            <td>Zidane Z. <br> <small>06 00 00 00 00</small></td>
                            <td>1 Place du Vieux Pré, 28100 Dreux <br>
                                <small>Etage 2, Code 1234. (Sonner fort)</small>
                            </td>
                            <td>
                                <a href="https://www.google.com/maps" target="_blank" class="btn-select"
                                    style="background: #4285F4;">📍 Maps</a>
                            </td>
                            <td><span style="color: orange;">En préparation...</span></td>
                            <td><button class="btn-select">Prête</button></td>
                        </tr>

                        <tr>
                            <td>#443</td>
                            <td>Benzema K.</td>
                            <td>4 Grande Rue Maurice Viollette, 28100 Dreux</td>
                            <td>
                                <a href="https://www.google.com/maps/search/?api=1&query=4+Grande+Rue+Maurice+Viollette+28100+Dreux"
                                    target="_blank" class="btn-select"
                                    style="text-decoration: none; padding: 5px 10px; background: #4285F4;">📍 Maps</a>
                            </td>
                            <td><span style="color: var(--bleu-dreux); font-weight: bold;">Prêt pour l'envoi</span></td>
                            <td>
                                <button class="btn-select" style="border-radius: 5px; padding: 5px 10px;">Valider
                                    Livraison</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h3 style="margin-top: 40px; margin-bottom: 15px; color: var(--vert-terrain); text-align: left;">✅
                    Matchs Terminés (Livrés)</h3>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Heure de fin</th>
                            <th>Score (Total)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#440</td>
                            <td>Mbappé K.</td>
                            <td>12:30</td>
                            <td>13.00 €</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>

</html>

