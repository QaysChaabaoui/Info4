<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

require_once('includes/header.php');

$total_a_payer = $montant_a_payer_banque;
$montant_formatte = number_format($total_a_payer, 2, '.', '');
$transaction = "FCB" . substr(md5(uniqid(mt_rand(), true)), 0, 12);

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$retour = $protocol . "://" . $host . $path . "/confirmation.php";

$chaine_a_hacher = $api_key . "#" . $transaction . "#" . $montant_formatte . "#" . $vendeur . "#" . $retour . "#";
$control = md5($chaine_a_hacher);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Passerelle CYBank - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="login-section">
            <div class="login-card">
                <h2>💳 Guichet de Paiement (CYBank)</h2>
                <p>Votre feuille de match est prête. Procédez au règlement de votre commande.</p>

                <div class="order-timing-box">
                    <?php if ($est_une_modification): ?>
                        <p>Acompte déjà réglé : <strong><?php echo number_format($montant_deja_paye, 2, ',', ' '); ?>
                                €</strong></p>
                    <?php endif; ?>
                    <h3>Reste à charger : <span><?php echo number_format($total_a_payer, 2, ',', ' '); ?> €</span></h3>
                </div>

                <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                    <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
                    <input type="hidden" name="montant" value="<?php echo $montant_formatte; ?>">
                    <input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
                    <input type="hidden" name="retour" value="<?php echo $retour; ?>">
                    <input type="hidden" name="control" value="<?php echo $control; ?>">

                    <button type="submit" class="btn-login">
                        Payer sur CYBank ⚽
                    </button>
                </form>

                <p class="switch-account">
                    <a href="panier.php">
                        &nbsp;🔙 Retour au panier
                    </a>
                </p>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>

</html>
