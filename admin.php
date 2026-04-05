<?php
session_start();

// 2. rredirige l'utilisateur vers l'accueil s'il n'est pas admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit(); // On arrête le script ici pour ne rien charger d'autre
}

require_once('includes/header.php');
$json_content = file_get_contents("data/profil.json");
$utilisateurs = json_decode($json_content, true);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bureau du Coach - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main>
        <section class="cart-section">
            <h2>📋 Effectif du Club (<?php echo count($utilisateurs); ?> Joueurs)</h2>

            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Joueur (Prénom & Nom)</th>
                            <th>Email (Login)</th>
                            <th>Rôle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($utilisateurs as $u): ?>
                            <tr>
                                <td><?php echo $u['prenom'] . " " . $u['nom']; ?></td>

                                <td><?php echo $u['login']; ?></td>

                                <td>
                                    <span style="color: <?php echo ($u['role'] === 'admin' ? 'red' : 'inherit'); ?>">
                                        <?php echo strtoupper($u['role']); ?>
                                    </span>
                                </td>

                                <td class="admin-management-cell">
                                    <a href="profil.php?email=<?php echo $u['login']; ?>" class="btn-admin-view">📄
                                        Fiche</a>

                                    <button type="button" class="btn-admin-action btn-block">🚫 Bloquer</button>

                                    <select class="admin-status-select">
                                        <option value="Normal">Normal</option>
                                        <option value="Premium">Premium</option>
                                        <option value="VIP">VIP</option>
                                    </select>

                                    <button type="button" class="btn-admin-action btn-promo">🏷️ Remise</button>
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
