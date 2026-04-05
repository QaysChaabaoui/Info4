<?php
// 1. On inclut le header (qui gère déjà le session_start)
require_once('includes/header.php');

// 2. Sécurité : Seuls le Livreur et l'Admin entrent sur le terrain
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'livreur' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: index.php");
    exit();
}

// 3. Chargement des données
$commandes = [];
if (file_exists("data/commandes.json")) {
    $commandes = json_decode(file_get_contents("data/commandes.json"), true) ?? [];
}
$utilisateurs = json_decode(file_get_contents("data/profil.json"), true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livraisons - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="cart-section">
            <h2>🚚 Tactique de Livraison</h2>
            <p>Gère les commandes et lance le GPS pour ne pas finir en hors-jeu.</p>

            <div class="cart-container">
                <h3 class="delivery-subtitle">⚽ Matchs en cours (À livrer)</h3>
                
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Adresse & Infos</th>
                            <th>Détails</th>
                            <th>État</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commandes as $cmd): ?>
                            <?php if ($cmd['statut'] === 'Prête' || $cmd['statut'] === 'En livraison'): ?>
                                <tr>
                                    <td><strong><?php echo $cmd['id']; ?></strong></td>
                                    <td><?php echo $cmd['client']; ?></td>
                                    <td style="font-size: 0.9em;">
                                        <?php
                                        $adresse = "Adresse non renseignée";
                                        foreach ($utilisateurs as $u) {
                                            if ($u['login'] === $cmd['client']) {
                                                $adresse = $u['adresse'];
                                                break;
                                            }
                                        }
                                        echo $adresse;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn-view-delivery">📄 Voir</a>
                                    </td>
                                    <td>
                                        <span class="label-statut statut-<?php echo str_replace(' ', '-', strtolower($cmd['statut'])); ?>">
                                            <?php echo $cmd['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <select class="select-delivery-status">
                                            <option value="En livraison" <?php echo ($cmd['statut'] == 'En livraison' ? 'selected' : ''); ?>>En route</option>
                                            <option value="Livrée">✅ Livrée</option>
                                            <option value="Abandonnée">❌ Abandonnée</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>

