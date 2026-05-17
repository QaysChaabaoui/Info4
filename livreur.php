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
                            <?php
                            // 1. On passe le statut en minuscules pour bloquer le piège de la casse
                            $statut_minuscule = strtolower($cmd['statut'] ?? '');

                            // 2. On gère les autorisations d'affichage
                            $estPourMoi = (isset($cmd['livreur']) && $cmd['livreur'] === $_SESSION['user_login']);
                            $estAdmin = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');

                            // 3. Le filtre accepte désormais toutes les écritures (PRÊTE, Prête, prête, etc.)
                            if (($statut_minuscule === 'prête' || $statut_minuscule === 'en livraison') && ($estPourMoi || $estAdmin)):
                                ?>
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
                                        <span
                                            class="label-statut statut-<?php echo str_replace(' ', '-', $statut_minuscule); ?>">
                                            <?php echo $cmd['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <select class="select-delivery-status">
                                            <option value="EN LIVRAISON" <?php echo ($statut_minuscule === 'en livraison' ? 'selected' : ''); ?>>En route</option>
                                            <option value="LIVRÉE">✅ Livrée</option>
                                            <option value="ABANDONNÉE">❌ Abandonnée</option>
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

    <script>
        // Écouter les changements sur le menu déroulant de statut de livraison
        document.querySelectorAll('.select-delivery-status').forEach(select => {
            select.addEventListener('change', function () {
                const tr = this.closest('tr');
                const idCommande = tr.cells[0].innerText.trim();
                const nouveauStatut = this.value;

                const formData = new FormData();
                formData.append('id', idCommande);
                formData.append('statut', nouveauStatut);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'modifier_statut_commande.php', true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log("Livreur AJAX : " + xhr.responseText);

                        // 1. On vérifie d'abord que le PHP a bien écrit "Succès" dans le JSON
                        if (xhr.responseText.trim().includes("Succ")) {

                            // 2. 🛡️ ASTUCE ANTI-ACCENT : On passe en minuscules et on cherche juste "livr" ou "abandon"
                            const statutNormalise = nouveauStatut.toLowerCase();

                            if (statutNormalise.includes('livr') || statutNormalise.includes('abandon')) {
                                tr.remove(); // La ligne s'efface proprement de l'écran !
                            } else {
                                // Si c'est juste un passage à "En route"
                                const labelStatut = tr.querySelector('.label-statut');
                                if (labelStatut) {
                                    labelStatut.innerText = nouveauStatut;
                                    labelStatut.className = 'label-statut statut-' + statutNormalise.replace(' ', '-');
                                }
                            }

                        } else {
                            // 🚨 Si le PHP renvoie une erreur (Ex: Accès refusé), on l'affiche pour comprendre
                            alert("Le JSON n'a pas changé ! Réponse du serveur : " + xhr.responseText);
                        }
                    }
                };
                xhr.send(formData);
            });
        });
    </script>
    <?php require_once('includes/footer.php'); ?>
</body>

</html>
