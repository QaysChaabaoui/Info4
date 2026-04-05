<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// On vérifie quel profil afficher AVANT d'afficher le menu
$email_cible = $_GET['email'] ?? $_SESSION['user_login'] ?? null;

if (!$email_cible) {
    header("Location: index.php");
    exit();
}

$utilisateurs = json_decode(file_get_contents("data/profil.json"), true);
$joueur_fiche = null;

foreach ($utilisateurs as $u) {
    if ($u['login'] === $email_cible) {
        $joueur_fiche = $u;
        break;
    }
}

$toutes_commandes = json_decode(file_get_contents("data/commandes.json"), true) ?? [];
$mes_commandes = [];

foreach ($toutes_commandes as $cmd) {
    if ($cmd['client'] === $joueur_fiche['login']) {
        $mes_commandes[] = $cmd;
    }
}

if (!$joueur_fiche) {
    header("Location: index.php");
    exit();
}
$destination_bureau = "index.php";
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') {
        $destination_bureau = "admin.php";
    } elseif ($_SESSION['user_role'] === 'restaurateur') {
        $destination_bureau = "restaurateur.php";
    }
}

require_once('includes/header.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Licence de <?php echo $joueur_fiche['nom']; ?> - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="profile-section">
            <h2>LICENCE DE JOUEUR :
                <?php echo $joueur_fiche['prenom'] . " " . substr($joueur_fiche['nom'], 0, 1) . "."; ?>
            </h2>

            <div class="license-card">
                <div class="license-header">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($joueur_fiche['prenom'] . '+' . $joueur_fiche['nom']); ?>&background=random"
                        alt="Avatar" class="avatar">

                    <div class="player-info">
                        <h3>
                            <?php echo $joueur_fiche['prenom'] . " " . $joueur_fiche['nom']; ?>
                            <span class="edit-icon">✏️</span>
                        </h3>
                        <p>Poste :
                            <span class="role-display">
                                <?php
                                if ($joueur_fiche['role'] === 'admin')
                                    echo "Coach (Administrateur)";
                                elseif ($joueur_fiche['role'] === 'restaurateur')
                                    echo "Chef de Cuisine (Restaurateur)";
                                elseif ($joueur_fiche['role'] === 'livreur')
                                    echo "Titulaire (Livreur)";
                                else
                                    echo "Avant-Centre (Gourmand)";
                                ?>
                            </span>
                        </p>
                        <p class="club">Club : FC Burger Dreux</p>

                        <p class="info-detail">📧 Email : <strong><?php echo $joueur_fiche['login']; ?></strong></p>
                        <?php if (isset($joueur_fiche['adresse'])): ?>
                            <p class="info-detail">
                                📍 Adresse : <strong><?php echo $joueur_fiche['adresse']; ?></strong>
                                <span class="edit-icon">✏️</span>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="actions">
                    <a href="<?php echo $destination_bureau; ?>" class="btn-logout">Retour au Bureau</a>
                </div>

                <div class="historique-container">
                    <h3>📜 Historique de mes Matchs</h3>

                    <?php if (empty($mes_commandes)): ?>
                        <p class="info-detail">Aucune commande enregistrée. ⚽</p>
                    <?php else: ?>
                        <table class="table-historique">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Articles</th>
                                    <th>Statut</th>
                                    <th style="text-align: right;">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mes_commandes as $cmd): ?>
                                    <tr>
                                        <td><strong><?php echo $cmd['id']; ?></strong></td>
                                        <td><?php echo $cmd['articles']; ?></td>
                                        <td>
                                            <span
                                                class="label-statut statut-<?php echo str_replace(' ', '-', strtolower($cmd['statut'])); ?>">
                                                <?php echo $cmd['statut']; ?>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php if (strtolower($cmd['statut']) === 'livrée'): ?>
                                                <select class="select-note">
                                                    <option value="">Noter...</option>
                                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                                    <option value="4">⭐⭐⭐⭐</option>
                                                    <option value="3">⭐⭐⭐</option>
                                                    <option value="2">⭐⭐</option>
                                                    <option value="1">⭐</option>
                                                </select>
                                            <?php else: ?>
                                                <span class="match-en-cours">En cours</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>

</html>
