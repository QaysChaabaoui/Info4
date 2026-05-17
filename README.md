# ⚽ FC Burger Dreux 🍔

Bienvenue sur le dépôt du projet **FC Burger Dreux**, une application web de restauration rapide dynamique et asynchrone pensée autour de l'univers du football et de l'identité de la ville de Dreux. 

**Projet académique réalisé par :** Chaabaoui Qays & Madrassi Ayman (CY Tech)

---

## 📋 Description du Projet
FC Burger Dreux est une plateforme de commande en ligne simulant le fonctionnement tactique d'un véritable fast-food. Le site propose une expérience immersive grâce à une identité visuelle marquée inspirée d'un club de sport (le "Stade", les "Titulaires", la "Licence Joueur") tout en intégrant des fonctionnalités e-commerce avancées.

Le projet intègre désormais l'ensemble des exigences de la **Phase 3**, basculant l'application d'un fonctionnement classique vers une architecture asynchrone fluide, sécurisée et sans rechargement de page.

## ✨ Fonctionnalités Principales (Mise à jour Phase 3)
* **Menu Dynamique ("La Compo") :** Affichage des produits classés par postes tactiques (Attaque, Défense, Staff Technique) générés via un fichier JSON.
* **Architecture Asynchrone (AJAX) :** Les interactions clés (gestion des statuts de cuisine, assignation des livreurs, blocage utilisateur et notation) s'exécutent en arrière-plan sans recharger la page.
* **Système de Rôles & Espaces Dédiés :** Affichage conditionnel de la navigation selon la licence de l'utilisateur :
  * 🟢 **Client (Supporter)** : Accès au panier, à l'historique et au système de **modification de commande payée** avec ajustement financier.
  * 👨‍🍳 **Restaurateur (Chef)** : Gestion de la cuisine et assignation des livreurs en temps réel via AJAX.
  * 🛵 **Livreurs** : Validation des étapes de livraison ("En route", "Livrée") en direct depuis le terrain.
  * 👑 **Admin (Coach)** : Tableau de bord de modération pour activer/bloquer les comptes de l'effectif.
* **Bouclier de Sécurité (Expulsion Instantanée) :** Déconnexion immédiate et destruction absolue de la session d'un utilisateur dès qu'il est marqué comme "bloqué" par l'administrateur.
* **Évaluation Tactique :** Système de notation unique par commande livrée, verrouillé après soumission pour éviter le spam.
* **Tunnel de Paiement :** Interfaçage avec l'API fictive CYBank gérant le paiement du reliquat en cas de modification du panier.

## 🛠️ Technologies Utilisées
* **Frontend :** HTML5, CSS3 unifié (Conforme à la Charte Graphique : Polices *Kanit* & *Roboto*, Bleu Dreux `#0055A4`), Vanila JavaScript (Fetch / XMLHttpRequest AJAX).
* **Backend :** PHP (Gestion des sessions, structures de contrôle, double verrou de sécurité).
* **Base de Données :** NoSQL natif via fichiers plats JSON (`json_encode` & `json_decode`).

## 📁 Architecture des Données
Le stockage repose sur trois fichiers principaux situés dans le répertoire `/data` :
1. `data/Menu.json` : Catalogue complet des produits (Burgers, Snacks, Boissons, Sauces).
2. `data/commandes.json` : Suivi centralisé des feuilles de match (ID, client, composition, statuts en majuscules, livreur assigné et note).
3. `data/profil.json` : Registre des utilisateurs incluant le champ `statut_compte` (`actif`/`bloqué`).

## 🚀 Installation & Lancement
Comme ce projet utilise PHP, il nécessite un serveur local pour fonctionner.

1. **Prérequis :** Installez un serveur local comme **XAMPP** ou **WampServer**.
2. **Déploiement :** Placez le dossier `projet` à l'intérieur du répertoire web de votre serveur local :
   * Sur XAMPP : `C:/xampp/htdocs/projet/`
   * Sur WampServer : `C:/wamp64/www/projet/`
3. **Démarrage :** Lancez le panneau de contrôle de votre serveur et démarrez le module **Apache**.
4. **Accès :** Ouvrez votre navigateur internet et accédez à l'adresse : `http://localhost/projet/`

## 🗂️ Structure du Répertoire (Phase 3)
```text
projet/
├── data/
│   ├── Menu.json                     # Catalogue des produits
│   ├── commandes.json                # Base de données des commandes et notes
│   └── profil.json                   # Base de données des utilisateurs et statuts
├── includes/
│   ├── header.php                    # Navigation dynamique + Bouclier d'expulsion
│   └── footer.php                    # Pied de page officiel du club
├── img/                              # Iconographies et visuels des burgers
├── index.php                         # Accueil (Le Stade)
├── menu.php                          # Catalogue dynamique (La Compo)
├── panier.php                        # Récapitulatif du panier actuel
├── paiement.php                      # Passerelle bancaire CYBank ajustée
├── confirmation.php                  # Validation finale des écritures
├── restaurateur.php                  # Interface Cuisine + scripts AJAX
├── livreur.php                       # Interface Livreur + scripts AJAX
├── admin.php                         # Espace Coach (Modération des comptes)
├── profil.php                        # Profil client (Licence) + AJAX Étoiles
├── modifier_statut_utilisateur.php   # Traitement AJAX : Blocage de compte
├── modifier_statut_commande.php      # Traitement AJAX : Cuisine & Livraisons
├── enregistrer_note.php              # Traitement AJAX : Enregistrement de l'évaluation
├── style.css                         # Feuille de style complète unifiée
└── README.md                         # Documentation du projet
