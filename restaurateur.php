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
                                    <span
                                        class="badge-timing <?php echo ($cmd['timing'] === 'Immédiat' ? 'urgent' : 'attente'); ?>">
                                        <?php echo $cmd['timing']; ?>
                                    </span>
                                </td>
                                <td>
                                    <span id="statut-text-<?php echo $cmd['id']; ?>"
                                        class="label-statut statut-<?php echo str_replace(' ', '-', strtolower($cmd['statut'])); ?>">
                                        <?php echo $cmd['statut']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn-detail">📄 Voir</a>
                                </td>
                                <td>
                                    <select class="select-statut-cuisine">
                                        <option value="PAYÉE" <?php echo (strtolower($cmd['statut']) === 'payée' ? 'selected' : ''); ?>>A préparer</option>
                                        <option value="EN COURS" <?php echo (strtolower($cmd['statut']) === 'en cours' || strtolower($cmd['statut']) === 'en préparation' ? 'selected' : ''); ?>>En
                                            préparation</option>
                                        <option value="PRÊTE" <?php echo (strtolower($cmd['statut']) === 'prête' ? 'selected' : ''); ?>>Prête</option>
                                        <option value="EN LIVRAISON" <?php echo (strtolower($cmd['statut']) === 'en livraison' ? 'selected' : ''); ?>>En livraison</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="select-livreur">
                                        <option value="">-- Choisir --</option>
                                        <?php foreach ($livreurs as $l): ?>
                                            <option value="<?php echo $l['login']; ?>" <?php echo (isset($cmd['livreur']) && $cmd['livreur'] === $l['login'] ? 'selected' : ''); ?>>
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

    <script>
        //  Écouter les changements sur le sélecteur de statut de cuisine
        document.querySelectorAll('.select-statut-cuisine').forEach(select => {
            select.addEventListener('change', function () {
                const tr = this.closest('tr');
                const idCommande = tr.cells[0].innerText.trim();
                const nouveauStatut = this.value;

                envoyerMiseAJour(idCommande, nouveauStatut, null);
            });
        });

        //  Écouter les changements sur le sélecteur de Livreur
        document.querySelectorAll('.select-livreur').forEach(select => {
            select.addEventListener('change', function () {
                const tr = this.closest('tr');
                const idCommande = tr.cells[0].innerText.trim();
                const livreurLogin = this.value;

                envoyerMiseAJour(idCommande, null, livreurLogin);
            });
        });

        //  Fonction d'envoi de la mise à jour au serveur via AJAX
        function envoyerMiseAJour(id, statut, livreur) {
            const formData = new FormData();
            formData.append('id', id);
            if (statut !== null) formData.append('statut', statut);
            if (livreur !== null) formData.append('livreur', livreur);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'modifier_statut_commande.php', true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log("Serveur : " + xhr.responseText);

                    // Mise à jour dynamique du statut dans la table sans recharger la page
                    if (statut !== null) {
                        const badgeSpan = document.getElementById("statut-text-" + id);
                        if (badgeSpan) {
                            badgeSpan.innerText = statut.toUpperCase();

                            // On recalcule dynamiquement les classes CSS pour la couleur du badge
                            const classeCouleur = statut.toLowerCase().replace(' ', '-');
                            badgeSpan.className = "label-statut statut-" + classeCouleur;
                        }
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
    <?php require_once('includes/footer.php'); ?>
</body>

</html>
