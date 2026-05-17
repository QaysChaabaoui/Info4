<?php
require_once('includes/header.php');
require_once('includes/getapikey.php');

$vendeur = "MEF-1_F";
$api_key = getAPIKey($vendeur);

$total_a_payer = 0;
if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $item) {
        $total_a_payer += $item['prix'] * $item['quantite'];
    }
}

$est_une_modification = isset($_SESSION['modification_commande_id']);
$montant_deja_paye = $est_une_modification ? $_SESSION['montant_deja_paye'] : 0.0;

$montant_a_payer_banque = $total_a_payer;
if ($est_une_modification) {
    $montant_a_payer_banque = $total_a_payer - $montant_deja_paye;
}

if ($montant_a_payer_banque <= 0 && $est_une_modification) {
    header("Location: confirmation.php?status=accepted&transaction=MOD-INTERNE&montant=0.00&control=" . md5($api_key . "#MOD-INTERNE#0.00#" . $vendeur . "#accepted#"));
    exit();
}

$total_a_payer = $montant_a_payer_banque;
$montant_formatte = number_format($total_a_payer, 2, '.', '');
$transaction = "FCB" . substr(md5(uniqid(mt_rand(), true)), 0, 12);
// Détection automatique de ton adresse pour éviter l'erreur ERR_CONNECTION_REFUSED
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$retour = $protocol . "://" . $host . $path . "/confirmation.php";
if (isset($est_une_modification) && $est_une_modification) {
    $retour .= "?mod_id=" . $_SESSION['modification_commande_id'] . "&total_global=" . number_format($total_a_payer + $montant_deja_paye, 2, '.', '');
}

$chaine_a_hacher = $api_key . "#" . $transaction . "#" . $montant_formatte . "#" . $vendeur . "#" . $retour . "#";
$control = md5($chaine_a_hacher);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Paiement - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="login-card" style="margin-top: 50px;">
            <h2>🏦 Paiement CYBank</h2>
            <p style="margin-bottom: 20px;">Vous allez être redirigé vers l'interface de paiement sécurisée.</p>

            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: left; margin-bottom: 25px;">
                <p><strong>Vendeur :</strong> <?php echo $vendeur; ?></p>
                <p><strong>Montant à régler :</strong> <?php echo $montant_formatte; ?> €</p>
                <p><strong>Transaction :</strong> <?php echo $transaction; ?></p>
            </div>

            <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
                <input type="hidden" name="montant" value="<?php echo $montant_formatte; ?>">
                <input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
                <input type="hidden" name="retour" value="<?php echo $retour; ?>">
                <input type="hidden" name="control" value="<?php echo $control; ?>">

                <button type="submit" class="btn-checkout" style="width: 100%;">
                    Payer sur CYBank ⚽
                </button>
            </form>

            <p style="margin-top: 20px;">
                <a href="panier.php" style="color: #666; text-decoration: none; font-size: 0.9rem;">🔙 Retour au
                    panier</a>
            </p>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>

</html>
<button type="submit" class="btn-checkout" style="width: 100%;">
    Payer sur CYBank ⚽
</button>
</form>

<p style="margin-top: 20px;">
    <a href="panier.php" style="color: #666; text-decoration: none; font-size: 0.9rem;">🔙 Retour au panier</a>
</p>
</section>
</main>

<?php require_once('includes/footer.php'); ?>
</body>

</html>
