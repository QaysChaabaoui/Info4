<?php
function charger_donnees($nom_fichier) {
    $contenu = file_get_contents("data/" . $nom_fichier);
    return json_decode($contenu, true);
}
?>
