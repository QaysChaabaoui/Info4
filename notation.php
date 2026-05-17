<?php
require_once('includes/header.php');

// Sécurité : Il faut être connecté pour accéder à l'après-match
if (!isset($_SESSION['user_login'])) {
    header("Location: index.php");
    exit();
}

$client_actuel = $_SESSION['user_login']; // Email/Login du supporter connecté
$nom_joueur = isset($_SESSION['user_nom']) ? $_SESSION['user_nom'] : "Anonyme";
$chemin_json = "data/commandes.json";

// TRAITEMENT DE L'ENVOI DU RAPPORT 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_commande'])) {
    $id_cmd = $_POST['id_commande'];
    $note_selectionnee = $_POST['note'] ?? '';
    $analyse_texte = $_POST['commentaire'] ?? '';

    if (file_exists($chemin_json)) {
        $commandes = json_decode(file_get_contents($chemin_json), true) ?? [];
        $mis_a_jour = false;

        foreach ($commandes as &$cmd) {
            // Triple vérification : bonne commande + bon client + statut LIVRÉE + pas encore notée
            if ($cmd['id'] === $id_cmd && $cmd['client'] === $client_actuel && strtoupper($cmd['statut']) === 'LIVRÉE' && !isset($cmd['note'])) {

                // On injecte les nouvelles clés de notation dans la commande
                $cmd['note'] = $note_selectionnee;
                $cmd['commentaire'] = htmlspecialchars($analyse_texte);
                $cmd['supporter_nom'] = $nom_joueur; 

                $mis_a_jour = true;
                break;
            }
        }

        if ($mis_a_job = $mis_a_jour) {
            file_put_contents($chemin_json, json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo "<script>alert('Analyse tactique enregistrée au tableau des scores !'); window.location.href='notation.php';</script>";
            exit();
        }
    }
}

// CHARGEMENT ET FILTRAGE DES COMMANDES POUR L'AFFICHAGE
$commandes = [];
if (file_exists($chemin_json)) {
    $commandes = json_decode(file_get_contents($chemin_json), true) ?? [];
}

$matchs_a_noter = [];
foreach ($commandes as $cmd) {
    if (isset($cmd['client']) && $cmd['client'] === $client_actuel && strtoupper($cmd['statut'] ?? '') === 'LIVRÉE' && !isset($cmd['note'])) {
        $matchs_a_noter[] = $cmd;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Après-Match (Avis) - FC Burger Dreux</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="login-section">
            <div class="login-card card-notation">
                <h2>⭐ Note ton Match</h2>
                <p>Donne ton analyse tactique sur ton dernier burger !</p>

                <?php if (count($matchs_a_noter) > 0): ?>
                    <form action="notation.php" method="POST">
                        <div class="form-group">
                            <label>Sélectionne ton Match (Commande livrée)</label>
                            <select name="id_commande" class="form-input-custom" required>
                                <?php foreach ($matchs_a_noter as $m): ?>
                                    <option value="<?php echo $m['id']; ?>"><?php echo $m['id']; ?> —
                                        <?php echo $m['articles']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ta Note (Étoiles)</label>
                            <select name="note" class="form-input-custom">
                                <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐ - Ballon d'Or</option>
                                <option value="⭐⭐⭐⭐">⭐⭐⭐⭐ - Qualifié d'office</option>
                                <option value="⭐⭐⭐">⭐⭐⭐ - Match nul</option>
                                <option value="⭐⭐">⭐⭐ - Carton Jaune</option>
                                <option value="⭐">⭐ - Relégation</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ton Analyse (Commentaire)</label>
                            <textarea name="commentaire" class="form-input-custom"
                                placeholder="Le Drouais Royal était incroyable..." rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn-login">Envoyer le Rapport</button>
                    </form>
                <?php else: ?>
                    <div style="text-align: center; padding: 20px 0;">
                        <p style="font-weight: bold; color: #e67e22; margin-bottom: 10px;">⚽ Aucun match livré en attente
                            d'analyse !</p>
                        <p style="font-size: 0.9em; color: #7f8c8d;">Les commandes à emporter, sur place ou déjà analysées
                            ne requièrent aucune notation obligatoire.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="cart-section section-avis">
            <h2 class="centered-title">🏟️ Les Avis du Kop (Supporters)</h2>

            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Supporter</th>
                            <th>Note</th>
                            <th>Analyse Tactique</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $avis_trouve = false;
                        foreach ($commandes as $cmd):
                            if (isset($cmd['note']) && isset($cmd['commentaire'])):
                                $avis_trouve = true;
                                ?>
                                <tr>
                                    <td><span class="supporter-name"><?php echo $cmd['supporter_nom'] ?? 'Supporter'; ?></span>
                                    </td>
                                    <td><span class="stars-display"><?php echo $cmd['note']; ?></span></td>
                                    <td>"<?php echo $cmd['commentaire']; ?>"</td>
                                </tr>
                            <?php
                            endif;
                        endforeach;

                        // Sécurité : Si aucune commande n'a encore été notée dans le JSON, on garde les exemples d'origine
                        if (!$avis_trouve):
                            ?>
                            <tr>
                                <td><span class="supporter-name">Zizou28</span></td>
                                <td><span class="stars-display">⭐⭐⭐⭐⭐</span></td>
                                <td>"Le Smash Star est plus précis qu'une de mes passes. Un régal !"</td>
                            </tr>
                            <tr>
                                <td><span class="supporter-name">KM_Sept</span></td>
                                <td><span class="stars-display">⭐⭐⭐⭐⭐</span></td>
                                <td>"Vitesse de livraison incroyable, comme une contre-attaque."</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php require_once('includes/footer.php'); ?>
</body>

</html>
