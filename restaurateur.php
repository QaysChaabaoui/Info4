<?php
// 1. On inclut le header (qui gère déjà le session_start)
require_once('includes/header.php');

// 2. Bouclier de sécurité (Coach ou Chef uniquement)
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'restaurateur' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: index.php");
    exit();
}

// 3. Chargement des données
$commandes = [];
if (file_exists("data/commandes.json")) {
    $commandes = json_decode(file_get_contents("data/commandes.json"), true) ?? [];
}

$utilisateurs = json_decode(file_get_contents("data/profil.json"), true);
$livreurs = array_filter($utilisateurs, function ($u) {
    return $u['role'] === 'livreur';
});
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cuisine - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container-admin">
        <section class="cuisine-section">
            <h2 class="titre-page">👨‍🍳 Tableau de Bord Restaurateur</h2>

            <div class="table-responsive">
                <table class="table-commandes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Articles</th>
                            <th>Timing</th>
                            <th>Statut</th>
                            <th>Détails</th>
                            <th>Action</th>
                            <th>Livreur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commandes as $cmd): ?>
                            <tr class="ligne-commande">
                                <td><strong><?php echo $cmd['id']; ?></strong></td>
                                <td class="cellule-articles"><?php echo $cmd['articles']; ?></td>
                                <td>
                                    <span class="badge-timing <?php echo ($cmd['timing'] === 'Immédiat' ? 'urgent' : 'attente'); ?>">
                                        <?php echo $cmd['timing']; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="label-statut statut-<?php echo str_replace(' ', '-', strtolower($cmd['statut'])); ?>">
                                        <?php echo $cmd['statut']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn-detail">📄 Voir</a>
                                </td>
                                <td>
                                    <select class="select-statut-cuisine">
                                        <option value="A préparer" <?php echo ($cmd['statut'] == 'A préparer' ? 'selected' : ''); ?>>A préparer</option>
                                        <option value="En cours" <?php echo ($cmd['statut'] == 'En cours' ? 'selected' : ''); ?>>En préparation</option>
                                        <option value="Prête" <?php echo ($cmd['statut'] == 'Prête' ? 'selected' : ''); ?>>Prête</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="select-livreur">
                                        <option value="">-- Choisir --</option>
                                        <?php foreach ($livreurs as $l): ?>
                                            <option value="<?php echo $l['login']; ?>">
                                                <?php echo $l['prenom'] . " " . substr($l['nom'], 0, 1) . "."; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>
</html>

