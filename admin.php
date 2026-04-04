<?php
require_once('includes/header.php');

// 1. Sécurité : si l'utilisateur n'est pas "admin", retour à l'accueil
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// 2. Récupération dynamique des données
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
                        <?php
                        // 3. Boucle dynamique pour afficher chaque joueur
                        foreach ($utilisateurs as $u):
                            ?>
                            <tr>
                                <td><?php echo $u['prenom'] . " " . $u['nom']; ?></td>
                                <td><?php echo $u['login']; ?></td>
                                <td>
                                    <span style="color: <?php echo ($u['role'] === 'admin' ? 'red' : 'inherit'); ?>">
                                        <?php echo strtoupper($u['role']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="profil.php?email=<?php echo $u['login']; ?>"
                                        style="color: var(--bleu-dreux);">Voir Fiche</a>
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
