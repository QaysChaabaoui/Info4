<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require_once('includes/header.php'); ?>

    <main>
        <section class="cart-section">
            <h2>🛒 Feuille de Match (Récapitulatif)</h2>
            
            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Joueur (Produit)</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>🍔 Le Drouais Royal</td>
                            <td>2</td>
                            <td>25.00 €</td>
                        </tr>
                        <tr>
                            <td>🍟 Frites "Penalty"</td>
                            <td>2</td>
                            <td>8.00 €</td>
                        </tr>
                        <tr>
                            <td>🥤 Soda "Mi-Temps"</td>
                            <td>2</td>
                            <td>5.00 €</td>
                        </tr>
                    </tbody>
                </table>

                <div class="cart-total">
                    <h3>Score Final (Total) : <span>38.00 €</span></h3>
                    <button class="btn-checkout">Siffler la fin du match (Payer)</button>
                </div>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>

</body>

</html>


