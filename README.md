StoryLine
=========

A Symfony project.

# Starting the project :

 - On Windows : Navigate to the root folder (Storyline/) and do :
 > php bin/console server:run


### In case of : Fatal Error require() ...
Do :
 - On Windows :
> php composer.phar install
 - On Linux :
> composer install


# 1. Le Jeu

**Storyline** est un "Rogue-Like" sur navigateur. Chaque jour, l'utilisateur se connecte pour recevoir des points de Stamina qui permettent à ses personnages d'affronter des monstres dans un donjon infini. Autant vous prévenir tout de suite, vos persos vont mourir, et mourir, et mourir...

Dans l'onglet de jeu (/play), l'utilisateur joue avec son personnage sélectionné comme principal contre des monstres tirés au hasard (et en fonction du nombre de combats gagnés du personnage. Rassurez-vous donc, vous ne verrez plus de poulets après quelques combats). Il a le choix entre se battre contre l'ennemi attribué ou s'enfuir (comme un lâche). Les deux actions coûtent de la Stamina.

Après chaque combat, le personnage a une chance de récuperer un objet au hasard (loot) sur le corps de son adversaire. Ces objets sont utilisables (dans l'onglet inventaire, accessible depuis l'écran de jeu par exemple) et augmentent vos stats (attaque, défense, vie). Ils sont nécessaires si vous voulez dépasser le stade des poulets pour aller rencontrer les dragons !



# 2. Specifications

### Fonctionnalités Obligatoires :

## 1. Login / Logout
La première page offre en effet aux utilisateurs la possibilité de s'inscrire ou de se connecter. **Deux noms d'utilisateur ne peuvent être identiques**.

Les mots de passe apparaissent sur la page d'identification "en clair" pour que l'utilisateur puisse vérifier son entrée, mais sont "cachés" lors du login. De plus, les mots de passe sont **'hachés'** dans la base de données, et ne sont donc pas stockés tel quel, pour plus de sûreté.

## 2. Personnages

Un utilisateur se voit offrir la possibilité de créer **3 personnages actifs** sur son compte. Il peut également les **supprimer**, les sélectionner comme **personnages principaux** (c'est à dire celui avec lequel on joue en ce moment) et les **remettre à zéro**. (/seeCharacter)

Chaque personnage possède son propre **inventaire**, persistant, ainsi que son log d'actions (consultable dans l'écran de jeu /play), qui conserve toutes ses actions de jeu et les affiche.

## 3. Ressources persistantes

Comme précisé dans le paragraphe précédent, **chaque personnage a un inventaire qui lui appartient**. De plus, chaque utilisateur possède une ressources appelée Stamina, que nous allons maintenant expliciter.

## 4. Points d'Action

Nommés **Stamina** dans notre jeu, les points d'actions sont attribués **chaque jour** automatiquement (lorsque l'utilisateur se connecte !) à chaque joueur. Le nombre de points d'action donné est bien entendu **modifiable** (la fonction qui les attribue se situe dans AppBundle/DefaultController.php, giveDailyStamina()).

## 5. Avatars  -- Incomplet --

Bien que le gros du travail soit fait, pour les avatars (Ils s'enregistrent bien sur la base de données et sont ensuite bien uploadés dans /web/uploads/), les avatars refusent résolument de s'afficher (ils s'affichent sous forme de liens brisés).


### Fonctionnalités Optionnelles :

## 1. Affichage des personnages

Chaque utilisateur peut afficher à tout moment ses propres personnages (/seeCharacter). **On affiche ici le nom, les informations importantes des personnages, l'inventaire individuel**...

## 2. Affichage des autres utilisateurs

Un joueur peut consulter la **liste de tous les utilisateurs (/listofusers)**. Il peut d'ici choisir d'**envoyer un message** à l'un d'eux, et consulter la date de **leur dernière connexion**.

## 3. Messages privés

Chaque joueur peut donc envoyer des **messages privés.** Dans l'onglet approprié (/messagesReceived), il peut ensuite **consulter ses propres messages**. Un bouton link ensuite vers une autre page (/messagesSent) qui affiche les **messages envoyés** par le joueur.

## 4. Evénements globaux

**L'administrateur** peut définir des évenements globaux dans le jeu. Ceux-ci prennent la forme de monstres plus fréquents et de loot spécifiques. Les évenements s'affichent sur la page d'accueil (/) des joueurs (évenements à venir comme courant).

## 4bis. Calendrier des évevenements

Sur la page d'accueil de l'utilisateur, on trouve donc les évenements courants, mais également les évènements à venir et leur(s) dates de début et de fin.

## 5. Bestiaire et Objets "lootables"

Sur la page /bestiary, vous trouverez un récapitulatif des monstres présents dans le jeu. Vous y trouverez également un récapitulatif des objets pouvant être récupérés sur le cadavre brulant des monstres.

## 6. Statistiques

Bien que le jeu s'y prête peu, on offre à l'utilisateur la possibilité de voir combien de combats son personnage a gagné. On donne aussi la possibilité de voir quand les autres utilisateurs se sont connectés pour la dernière fois.

# 3. Trivia

## 1. Compte administrateur

Un compte administrateur est disponible de base (il ne dépend pas de la base de données) et sert (uniquement !) à accéder à une liste des utilisateurs depuis laquelle "tout" est possible (effacer un utilisateur, lui redonner de la Stamina, modifier ses informations personnelles...) et à **mettre en place des évenements globaux**.

Attention : Toute tentative d'accéder à une autre page (de jeu par exemple) depuis la page administrateur sera refusée.

Pour se connecter en administrateur, veuillez entrer les informations suivantes :

username : admin 

password : admin

Oui, ce n'est pas très original.

## 2. Extensions possibles

Beaucoup d'idées nous trottent dans la tête sur comment améliorer ce projet (outre des améliorations nécessaires et évidentes sur la partie graphique, bien sûr...). Elles ne répondent pas à la demande du sujet, mais nous vous donnons ici quelques idées que le code permettrait d'aménager : 

  -  Un système de points d'expérience lié à chaque personnage. A la fin d'un combat, on pourrait ainsi monter de niveau et répartir des points de compétence pour permettre un level up plus agréable.
  -  Un rendu graphique plus satisfaisant, principalement au niveau de l'écran de jeu. Le log d'actions est assez austère.
  -  Une possibilité d'envoyer (comme sur Candy crush par exemple) des points d'actions d'un joueur à un autre.