# ⚽ FC Burger Dreux 🍔 — Phase 4 

Bienvenue sur le dépôt officiel du projet **FC Burger Dreux**, une application web complète, dynamique et asynchrone dédiée à la restauration rapide. Conçu autour d'une charte sémantique immersive issue du monde du football, le site associe l'identité sportive locale de la ville de Dreux à une architecture de développement moderne et sécurisée.

**Projet académique réalisé par :** Chaabaoui Qays & Madrassi Ayman (CY Tech — Pré-Ing2)

---

## 📋 Description du Projet
FC Burger Dreux gère l'intégralité du cycle de vie d'une commande de restauration : depuis la sélection des produits par le client jusqu'au suivi de la livraison, en passant par l'authentification sécurisée, la validation du panier et le paiement bancaire en ligne.

L'application intègre toutes les exigences de la **Phase 4**, validant la transition d'un site web classique vers une application asynchrone hautement interactive, conforme aux exigences de sécurité, d'accessibilité et de séparation stricte des préoccupations (HTML/PHP/CSS/JS).

---

## ✨ Fonctionnalités Majeures

### 🎲 1. L'Innovation : La "Compo Mystère du Coach"
Développée spécifiquement pour la Phase 4 pour répondre au critère d'originalité du cahier des charges, cette option permet aux supporters indécis de laisser le "Coach" composer leur menu de manière aléatoire.
* **Sélection Tactique :** Pioche automatiquement un produit dans la catégorie `Attaquants` (Burgers) et un produit sur le `Banc` (Boissons/Snacks).
* **Avantage Financier :** Applique une réduction immédiate de **10 %** calculée dynamiquement côté serveur.
* **Intégration Panier :** Gère de manière fluide l'incrémentation des quantités en cas de doublon dans la session active.

### 🔍 2. Moteur de Recherche Asynchrone Cumulatif (AJAX)
* **Recherche de l'Accueil (`index.php`) :** Un formulaire redirige l'utilisateur vers le catalogue produit en transmettant le mot-clé par méthode `GET`. Le JavaScript intercepte cette valeur au chargement pour afficher instantanément les résultats triés.
* **Recherche au Clavier (`menu.php`) :** Filtrage en temps réel à chaque saisie de caractère (événement `input`) combiné dynamiquement avec les filtres de régimes (Végétarien, Sans Gluten, Sans Lactose) et de saveurs (Épicé, Sucré).

### 🛡️ 3. Sécurité et Bouclier d'Expulsion Instantanée
* **Application des Prix :** Aucun calcul monétaire n'est confié au client. Les réductions de la "Compo Mystère" sont recalculées de manière hermétique en PHP côté serveur lors de l'injection en session pour bloquer toute tentative de falsification HTML.
* **Bouclier Anti-Faute :** Le fichier `header.php` inspecte de manière asynchrone l'état du compte de l'utilisateur connecté. Si l'administrateur passe son statut à `bloqué`, l'utilisateur est immédiatement déconnecté, sa session est entièrement détruite, et il est expulsé vers l'accueil.

---

## 👥 Profils d'Utilisateurs & Droits d'Accès

| Rôle | Espace Dédié | Actions Autorisées | Technologies Clés |
| :--- | :--- | :--- | :--- |
| 🟢 **Supporter** *(Client)* | `profil.php` \| `panier.php` | Consulter la carte, commander, modifier une commande payée (paiement du reliquat via l'API CYBank), noter un match livré. | Sessions PHP, AJAX POST, MD5 Verification |
| 👨‍🍳 **Chef** *(Restaurateur)* | `restaurateur.php` | Suivi des commandes, modification des statuts de préparation en cuisine, assignation des livreurs disponibles. | AJAX XMLHttpRequests, FormData |
| 🛵 **Titulaire** *(Livreur)* | `livreur.php` | Prise en charge des commandes prêtes, mise à jour de l'état de livraison ("En route", "Livrée", "Abandonnée"). | Interface Mobile responsive, Suppression DOM dynamique |
| 👑 **Coach** *(Admin)* | `admin.php` | Consultation de l'ensemble de l'effectif, accès aux fiches de licences, modération des accès (blocage/déblocage instantané). | Requêtes Asynchrones Ciblées |

---

## 🛠️ Technologies & Bonnes Pratiques
* **Architecture Clean-Code (Séparation Front/Back) :** Aucun attribut `style="..."` n'est toléré dans les fichiers PHP/HTML de la Phase 4. Les structures de positionnement (comme le conteneur `.compo-mystere-container`) sont isolées de manière externe dans `style.css`.
* **Langages :** HTML5 validé, CSS3 natif (variables `:root`, Flexbox, Grid), JavaScript Vanilla, PHP 8.
* **Stockage de Données :** Système de fichiers plats NoSQL standardisés au format JSON (`Menu.json`, `commandes.json`, `profil.json`).

---

## 📂 Structure du Répertoire Remaniée

```text
projet/
├── data/
│   ├── Menu.json                 # Catalogue des plats (Attaquants, Défense, Banc, Spianouch)
│   ├── commandes.json            # Registre centralisé des commandes, status et notations
│   └── profil.json               # Comptes de l'effectif, mots de passe et rôles
├── includes/
│   ├── header.php                # Barre de navigation adaptative + Bouclier anti-compte bloqué
│   ├── footer.php                # Pied de page + scripts globaux (Mode sombre, force MDP, oeil)
│   ├── fonctions.php             # Librairie d'outils PHP d'accès aux fichiers
│   └── getapikey.php             # Générateur de clés sécurisées pour l'API CYBank
├── img/                          # Visuels et photographies des burgers et snacks
├── index.php                     # Accueil du site (Le Stade) avec formulaire de recherche connecté
├── menu.php                      # Page principale de la carte intégrant la Compo Mystère et la recherche AJAX
├── compo_mystere.php             # ROUTEUR INNOVATION : Traitement serveur de la roulette aléatoire (-10%)
├── filtrer_menu.php              # MOTEUR AJAX : Filtrage textuel, catégoriel, allergènes et tri des prix
├── panier.php                    # Gestion de la compo actuelle et planification du timing du match
├── paiement.php                  # Liaison transactionnelle sécurisée vers la plateforme CYBank
├── confirmation.php              # Traitement du code de contrôle MD5 et écriture finale dans le JSON
├── restaurateur.php              # Terminal de contrôle de la cuisine ( AJAX Statuts & Livreurs )
├── livreur.php                   # Terminal simplifié mobile pour la validation des livraisons sur le terrain
├── admin.php                     # Bureau du Coach : Modération asynchrone des profils de l'effectif
├── profil.php                    # Espace Licence joueur : Modification d'informations et enregistrement des notes
├── modifier_statut_utilisateur.php # Script de traitement AJAX : Blocage de compte administrateur
├── modifier_statut_commande.php    # Script de traitement AJAX : Avancement cuisine et livreurs
├── enregistrer_note.php            # Script de traitement AJAX : Sécurisation des avis et étoiles
├── style.css                     # Feuille de style unifiée (contenant les thèmes clair et sombre)
└── README.md                     # Documentation complète du projet
