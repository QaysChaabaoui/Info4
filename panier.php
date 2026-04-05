<?php
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
                        <?php 
                        $total_general = 0;
                        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])): 
                            foreach ($_SESSION['panier'] as $id => $details): 
                                $sous_total = $details['prix'] * $details['quantite'];
                                $total_general += $sous_total;
                        ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($details['nom']); ?></strong></td>
                                <td><?php echo number_format($details['prix'], 2, ',', ' '); ?> €</td>
                                <td><?php echo $details['quantite']; ?></td>
                                <td><?php echo number_format($sous_total, 2, ',', ' '); ?> €</td>
                            </tr>
                        <?php 
                            endforeach; 
                        else: 
                        ?>
                            <tr>
                                <td colspan="4" style="text-align:center; padding: 30px;">
                                    Ton banc de touche est vide ! <br>
                                    <a href="menu.php" style="color: var(--bleu-dreux); font-weight: bold;">Retourner à la Compo</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="order-timing" style="margin-top: 30px; padding: 20px; border: 2px dashed var(--bleu-dreux); border-radius: 10px; text-align: left;">
                    <h3 style="margin-bottom: 15px;">⏰ Envoi du Ballon (Timing)</h3>
                    <form action="paiement.php" method="POST">
                        <div class="form-group">
                            <input type="radio" id="immediat" name="timing" value="maintenant" checked>
                            <label for="immediat">⚡ Préparation Immédiate (Coup d'envoi direct)</label>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <input type="radio" id="plus-tard" name="timing" value="programmee">
                            <label for="plus-tard">📅 Programmer le match (Livraison plus tard) :</label>
                            <input type="datetime-local" name="date_livraison" class="form-input-custom" style="margin-top: 10px;">
                        </div>

                        <div class="cart-total" style="margin-top: 30px;">
                            <h3>Total du Match : <span><?php echo number_format($total_general, 2, ',', ' '); ?> €</span></h3>
                            <button type="submit" class="btn-checkout">Valider & Payer (CYBank) ⚽</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>
