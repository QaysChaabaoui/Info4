# ⚽ FC Burger Dreux 🍔

Bienvenue sur le dépôt du projet **FC Burger Dreux**, une application web de restauration rapide dynamique pensée autour de l'univers du football. 

**Projet académique réalisé par :** Chaabaoui Qays & Madrassi Ayman

---

## 📋 Description du Projet
FC Burger Dreux est une plateforme de commande en ligne simulant le fonctionnement d'un véritable fast-food. Le site propose une expérience immersive grâce à une identité visuelle marquée (le "Stade", les "Titulaires", le "Vestiaire") tout en intégrant des fonctionnalités e-commerce complètes.

Le projet est divisé en plusieurs phases d'apprentissage. Actuellement (Phase 2 validée), le site gère l'affichage dynamique des données, les sessions utilisateurs et un tunnel d'achat complet.

## ✨ Fonctionnalités Principales
* **Menu Dynamique ("La Compo") :** Affichage des produits classés par catégories (Attaque, Défense, Banc de touche) générés via un fichier JSON.
* **Gestion de Panier :** Ajout de produits avec sélection de quantités, calcul automatique des totaux et bouton d'ajout rapide depuis l'accueil.
* **Système de Rôles (Vestiaires) :** Affichage conditionnel de la navigation selon le statut de l'utilisateur connecté :
  * 🟢 **Client (Supporter)** : Accès à la commande et à l'historique (Licence).
  * 👨‍🍳 **Restaurateur (Chef)** : Accès au tableau de bord des commandes en cuisine.
  * 🛵 **Livreur (Titulaire)** : Suivi des commandes prêtes à être expédiées.
  * 👑 **Admin (Coach)** : Supervision globale.
* **Tunnel de Paiement :** Simulation sécurisée de paiement via l'API fictive CYBank.
* **Base de Données JSON :** Aucune base SQL requise. Les produits, les commandes et les utilisateurs sont lus depuis des fichiers `.json` légers.

## 🛠️ Technologies Utilisées
* **Frontend :** HTML5, CSS3 (Variables, Flexbox, Grid), Animations CSS.
* **Backend :** PHP (Gestion des sessions, logique de panier, redirections).
* **Base de Données :** JSON (`json_decode` & `json_encode`).

## 📁 Architecture des Données
Le stockage des informations repose sur trois fichiers principaux (situés à la racine ou dans un dossier `/data`) :
1. `Menu.json` : Catalogue des burgers, snacks et boissons (ID, noms, prix, descriptions, images).
2. `commandes.json` : Suivi en temps réel de l'état des commandes (statuts : à préparer, en cours, en livraison).
3. `profil.json` : Gestion des identifiants et des rôles utilisateurs.

## 🚀 Installation & Lancement
Comme ce projet utilise PHP, il nécessite un serveur local pour fonctionner.

1. **Prérequis :** Installez un serveur local comme **XAMPP**, **WAMP** (Windows) ou **MAMP** (Mac).
2. **Clonage :** Placez le dossier `FC-Burger-Dreux` dans le répertoire web de votre serveur local (ex: `C:/xampp/htdocs/` pour XAMPP ou `/www/` pour WAMP).
3. **Démarrage :** Lancez le module Apache de votre serveur.
4. **Accès :** Ouvrez votre navigateur et allez sur : `http://localhost/FC-Burger-Dreux/index.php`

## 🗂️ Structure du Répertoire
```text
FC-Burger-Dreux/
├── includes/
│   ├── header.php          # Barre de navigation dynamique
│   └── footer.php          # Pied de page
├── img/                    # Images des produits et ressources graphiques
├── index.php               # Accueil (Le Stade)
├── menu.php                # Catalogue dynamique (La Compo)
├── panier.php              # Récapitulatif de commande
├── ajouter_panier.php      # Script métier d'ajout au panier (avec HTTP_REFERER)
├── paiement.php            # Simulation de la banque CYBank
├── restaurateur.php        # Dashboard de la cuisine
├── livreur.php             # Dashboard des expéditions
├── profil.php              # Tableau de bord utilisateur (Licence)
├── style.css               # Feuille de style unifiée
├── Menu.json               # BDD des produits
├── commandes.json          # BDD des commandes
└── README.md               # Documentation du projet
