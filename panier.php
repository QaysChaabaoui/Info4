<?php
// 1. On inclut le header qui gère DÉJÀ le session_start()
require_once('includes/header.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="cart-section">
            <h2>🛒 Ton Panier (Ta Compo)</h2>
            
            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Le Smash Star</strong></td>
                            <td>12.00 €</td>
                            <td>1</td>
                            <td>12.00 €</td>
                        </tr>
                    </tbody>
                </table>

                <div class="cart-total">
                    <h3>Total du Match : <span>12.00 €</span></h3>
                    <button class="btn-checkout">Valider la Commande ⚽</button>
                </div>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>


