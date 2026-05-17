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
                                    // 🔍 On lit le statut enregistré dans ton profil.json
                                    $estBloque = (isset($u['statut_compte']) && $u['statut_compte'] === 'bloqué');
                                    ?>

                                    <button type="button"
                                        class="btn-admin-action btn-block <?php echo $estBloque ? 'urgent' : ''; ?>">
                                        <?php echo $estBloque ? '✅ Débloquer' : '🚫 Bloquer'; ?>
                                    </button>

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
    </script>
    <?php require_once('includes/footer.php'); ?>
</body>

</html>
