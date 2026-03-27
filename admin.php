<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bureau du Coach - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">
            <h1>FC BURGER DREUX ⚽</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Le Stade (Acceuil)</a></li>
                <li><a href="menu.html">La Compo (Carte)</a></li>
                <li><a href="connexion.html">Vestiaires (Connexion)</a></li>
                <li><a href="admin.html" class="active" style="color: var(--jaune-or);">Bureau du Coach (Admin)</a></li>
                <li><a href="livreur.html">Livraisons</a></li>
                <li><a href="notation.html">Avis</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="cart-section"> 
            <h2>📋 Effectif du Club (Utilisateurs)</h2>
            
            <div class="cart-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Joueur (Nom)</th>
                            <th>Email</th>
                            <th>Matchs joués (Commandes)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#10</td>
                            <td>Zidane Z.</td>
                            <td>zizou@real.com</td>
                            <td>12</td>
                            <td><a href="profil.html" style="color: var(--bleu-dreux);">Voir Fiche</a></td>
                        </tr>
                       <tr>
    <td>#07</td>
    <td>Mbappé K.</td>
    <td>km7@psg.fr</td>
    <td>8</td>
    <td><a href="profil_mbappe.html" style="color: var(--bleu-dreux);">Voir Fiche</a></td>
                        </tr>
                        <tr>
                            <td>#09</td>
                            <td>Benzema K.</td>
                            <td>kb9@mail.com</td>
                            <td>5</td>
                            <td><a href="profil_benzema.html" style="color: var(--bleu-dreux);">Voir Fiche</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 FC Burger Dreux</p>
    </footer>

</body>
</html>
