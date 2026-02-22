FC Burger Dreux – Rapport Technique (Phase #1)
Groupe : Chaabaoui Qays, Madrassi Ayman

Date : 22 février 2026

Sujet : Création d'un site et de commande pour un fast-food immersif sur le thème du football.

Concept du Projet
Le projet FC Burger Dreux propose une expérience utilisateur unique en fusionnant la restauration rapide avec les codes visuels d'un club de football professionnel.

Navigation immersive : Les sections classiques sont renommées selon le jargon sportif : "Le Stade" (Accueil), "La Compo" (Menu), "Les Vestiaires" (Connexion/Profil) et le "Bureau du Coach" (Administration).

Identité locale : Le design et les couleurs sont directement inspirés du blason de la ville de Dreux (Bleu Royal et Or).

Structure des Fichiers:
Le projet est composé de 11 pages HTML reliées par une feuille de style centralisée :

Index.html : Page d'accueil avec bannière héroïque et produits phares.

menu.html : Carte complète classée par postes tactiques (Attaquants, Défenseurs, Remplaçants).

connexion.html & inscription.html : Interfaces d'accès aux vestiaires.

profil.html (ainsi que les variantes Benzema/Mbappé) : Espace personnel présenté sous forme de "Licence de joueur".

panier.html : Récapitulatif de la commande ("Feuille de match").

admin.html & livreur.html : Interfaces de gestion pour le personnel du club.

notation.html : Système d'avis et d'analyse d'après-match.

style.css : Fichier unique gérant l'intégralité de la charte graphique.

Spécifications Techniques
Charte Graphique & CSS
Palette de couleurs : Utilisation de variables CSS (:root) pour une maintenance simplifiée.

Bleu Dreux (#0055A4) : Couleur dominante de l'identité.

Vert Terrain (#2ECC71) : Utilisé pour les boutons d'action (CTA) et les prix.

Jaune Or (#F1C40F) : Couleur d'accent pour les bordures et les hovers.

Mise en page : Utilisation intensive de Flexbox pour la navigation et de CSS Grid pour l'alignement des cartes produits.

Design UI : Effet "Panini" sur les cartes produits avec des transitions fluides et des rotations au survol.

Typographie
Titres : 'Kanit' .

Texte : 'Roboto' .

Instructions de lancement
Extraire le dossier compressé.

S'assurer que le dossier img/ contient toutes les ressources visuelles référencées dans le code (ex: drouais-royal.jpg, logo.jpg).

Ouvrir le fichier Index.html dans n'importe quel navigateur moderne.
