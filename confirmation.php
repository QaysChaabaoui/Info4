<?php
require_once('includes/header.php');
require_once('includes/getapikey.php');

$vendeur = "MEF-1_F";
$api_key = getAPIKey($vendeur);

$paiement_valide = false;

if (isset($_GET['status']) && isset($_GET['control'])) {
    $transaction = $_GET['transaction'];
    $montant = $_GET['montant'];
    $status = $_GET['status'];
    $control_recu = $_GET['control'];

    $chaine_verif = $api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#";
    $control_calcul = md5($chaine_verif);

    if ($control_calcul === $control_recu && $status === 'accepted') {
        $paiement_valide = true;
        unset($_SESSION['panier']);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="login-card" style="margin-top: 50px;">
            <?php if ($paiement_valide): ?>
                <h2 style="color: var(--vert-terrain);">⚽ Commande Validée !</h2>
                <p>Ton paiement a été accepté par CYBank. Le restaurateur prépare ton match.</p>
                <a href="index.php" class="btn-checkout" style="display: block; margin-top: 20px; text-decoration: none;">Retour au Stade</a>
            <?php else: ?>
                <h2 style="color: #ff4757;">❌ Erreur de Paiement</h2>
                <p>Le paiement a été refusé ou les données sont corrompues.</p>
                <a href="panier.php" class="btn-login" style="display: block; margin-top: 20px; text-decoration: none;">Réessayer le panier</a>
            <?php endif; ?>
        </section>
    </main>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>
