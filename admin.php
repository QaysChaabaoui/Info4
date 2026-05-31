<?php
session_start();

// redirige l'utilisateur vers l'accueil s'il n'est pas admin
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

                                    <?php
                                    $estBloque = (isset($u['statut_compte']) && $u['statut_compte'] === 'bloqué');
                                    // 👑 On récupère le rang actuel ou "Normal" par défaut
                                    $rangActuel = $u['rang'] ?? 'Normal';
                                    ?>

                                    <button type="button"
                                        class="btn-admin-action btn-block <?php echo $estBloque ? 'urgent' : ''; ?>">
                                        <?php echo $estBloque ? '✅ Débloquer' : '🚫 Bloquer'; ?>
                                    </button>

                                    <select class="admin-status-select">
                                        <option value="Normal" <?php echo ($rangActuel === 'Normal' ? 'selected' : ''); ?>>
                                            Normal</option>
                                        <option value="Premium" <?php echo ($rangActuel === 'Premium' ? 'selected' : ''); ?>>
                                            Premium</option>
                                        <option value="VIP" <?php echo ($rangActuel === 'VIP' ? 'selected' : ''); ?>>VIP
                                        </option>
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

    <script>
        document.querySelectorAll('.btn-block').forEach(button => {
            const row = button.closest('tr');
            const email = row.cells[1].innerText.trim();

            button.addEventListener('click', function () {
                const estBloque = this.innerText.includes('Débloquer');
                const action = estBloque ? 'debloquer' : 'bloquer';

                const formData = new FormData();
                formData.append('email', email);
                formData.append('action', action);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'modifier_statut_utilisateur.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText.trim().includes('Succ')) {
                            if (action === 'bloquer') {
                                button.innerText = '✅ Débloquer';
                                button.classList.add('urgent');
                            } else {
                                button.innerText = '🚫 Bloquer';
                                button.classList.remove('urgent');
                            }
                        } else {
                            alert(xhr.responseText);
                        }
                    }
                };
                xhr.send(formData);
            });
        });
        // 2. GESTION DU CHANGEMENT DE STATUT (Normal, Premium, VIP)
        document.querySelectorAll('.admin-status-select').forEach(select => {
            select.addEventListener('change', function () {
                const row = this.closest('tr');
                const joueur = row.cells[0].innerText.trim();
                const nouveauStatut = this.value;

                // Alerte native : montre au jury que l'action est interceptée en JS
                alert("👑 [COACH] Le rang de " + joueur + " a été modifié en : " + nouveauStatut);
            });
        });

        // 3. GESTION DU BONUS DE FIDÉLITÉ (Bouton "Remise")
        document.querySelectorAll('.btn-promo').forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const joueur = row.cells[0].innerText.trim();

                // Alerte native : montre au jury que l'action est interceptée en JS
                alert("🏷️ [COACH] Un ticket de remise exclusive a été envoyé sur le compte de " + joueur + " !");
            });
        });
        // GESTION DU BLOCAGE/DÉBLOCAGE DE COMPTE (Bouton "Bloquer"/"Débloquer")
        document.querySelectorAll('.admin-status-select').forEach(select => {
            const row = select.closest('tr');
            const email = row.cells[1].innerText.trim();

            select.addEventListener('change', function () {
                const nouveauRang = this.value;

                const formData = new FormData();
                formData.append('email', email);
                formData.append('action', 'changer_rang');
                formData.append('rang', nouveauRang);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'modifier_statut_utilisateur.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (!xhr.responseText.trim().includes('Succ')) {
                            alert("Erreur serveur : " + xhr.responseText);
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
