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

**Storyline** est un "Rogue-Like" sur navigateur. Chaque jour, l'utilisateur se connecte pour recevoir des points de Stamina qui permettent � ses personnages d'affronter des monstres dans un donjon infini. Autant vous pr�venir tout de suite, vos persos vont mourir, et mourir, et mourir...

Dans l'onglet de jeu (/play), l'utilisateur joue avec son personnage s�lectionn� comme principal contre des monstres tir�s au hasard (et en fonction du nombre de combats gagn�s du personnage. Rassurez-vous donc, vous ne verrez plus de poulets apr�s quelques combats). Il a le choix entre se battre contre l'ennemi attribu� ou s'enfuir (comme un l�che). Les deux actions co�tent de la Stamina.

Apr�s chaque combat, le personnage a une chance de r�cuperer un objet au hasard (loot) sur le corps de son adversaire. Ces objets sont utilisables (dans l'onglet inventaire, accessible depuis l'�cran de jeu par exemple) et augmentent vos stats (attaque, d�fense, vie). Ils sont n�cessaires si vous voulez d�passer le stade des poulets pour aller rencontrer les dragons !



# 2. Specifications

### Fonctionnalit�s Obligatoires :

## 1. Login / Logout
La premi�re page offre en effet aux utilisateurs la possibilit� de s'inscrire ou de se connecter. **Deux noms d'utilisateur ne peuvent �tre identiques**.

Les mots de passe apparaissent sur la page d'identification "en clair" pour que l'utilisateur puisse v�rifier son entr�e, mais sont "cach�s" lors du login. De plus, les mots de passe sont **'hach�s'** dans la base de donn�es, et ne sont donc pas stock�s tel quel, pour plus de s�ret�.

## 2. Personnages

Un utilisateur se voit offrir la possibilit� de cr�er **3 personnages actifs** sur son compte. Il peut �galement les **supprimer**, les s�lectionner comme **personnages principaux** (c'est � dire celui avec lequel on joue en ce moment) et les **remettre � z�ro**. (/seeCharacter)

Chaque personnage poss�de son propre **inventaire**, persistant, ainsi que son log d'actions (consultable dans l'�cran de jeu /play), qui conserve toutes ses actions de jeu et les affiche.

## 3. Ressources persistantes

Comme pr�cis� dans le paragraphe pr�c�dent, **chaque personnage a un inventaire qui lui appartient**. De plus, chaque utilisateur poss�de une ressources appel�e Stamina, que nous allons maintenant expliciter.

## 4. Points d'Action

Nomm�s **Stamina** dans notre jeu, les points d'actions sont attribu�s **chaque jour** automatiquement (lorsque l'utilisateur se connecte !) � chaque joueur. Le nombre de points d'action donn� est bien entendu **modifiable** (la fonction qui les attribue se situe dans AppBundle/DefaultController.php, giveDailyStamina()).

## 5. Avatars  -- Incomplet --

Bien que le gros du travail soit fait, pour les avatars (Ils s'enregistrent bien sur la base de donn�es et sont ensuite bien upload�s dans /web/uploads/), les avatars refusent r�solument de s'afficher (ils s'affichent sous forme de liens bris�s).


### Fonctionnalit�s Optionnelles :

## 1. Affichage des personnages

Chaque utilisateur peut afficher � tout moment ses propres personnages (/seeCharacter). **On affiche ici le nom, les informations importantes des personnages, l'inventaire individuel**...

## 2. Affichage des autres utilisateurs

Un joueur peut consulter la **liste de tous les utilisateurs (/listofusers)**. Il peut d'ici choisir d'**envoyer un message** � l'un d'eux, et consulter la date de **leur derni�re connexion**.

## 3. Messages priv�s

Chaque joueur peut donc envoyer des **messages priv�s.** Dans l'onglet appropri� (/messagesReceived), il peut ensuite **consulter ses propres messages**. Un bouton link ensuite vers une autre page (/messagesSent) qui affiche les **messages envoy�s** par le joueur.

## 4. Ev�nements globaux

**L'administrateur** peut d�finir des �venements globaux dans le jeu. Ceux-ci prennent la forme de monstres plus fr�quents et de loot sp�cifiques. Les �venements s'affichent sur la page d'accueil (/) des joueurs (�venements � venir comme courant).

## 4bis. Calendrier des �vevenements

Sur la page d'accueil de l'utilisateur, on trouve donc les �venements courants, mais �galement les �v�nements � venir et leur(s) dates de d�but et de fin.

## 5. Bestiaire et Objets "lootables"

Sur la page /bestiary, vous trouverez un r�capitulatif des monstres pr�sents dans le jeu. Vous y trouverez �galement un r�capitulatif des objets pouvant �tre r�cup�r�s sur le cadavre brulant des monstres.

## 6. Statistiques

Bien que le jeu s'y pr�te peu, on offre � l'utilisateur la possibilit� de voir combien de combats son personnage a gagn�. On donne aussi la possibilit� de voir quand les autres utilisateurs se sont connect�s pour la derni�re fois.

# 3. Trivia

## 1. Compte administrateur

Un compte administrateur est disponible de base (il ne d�pend pas de la base de donn�es) et sert (uniquement !) � acc�der � une liste des utilisateurs depuis laquelle "tout" est possible (effacer un utilisateur, lui redonner de la Stamina, modifier ses informations personnelles...) et � **mettre en place des �venements globaux**.

Attention : Toute tentative d'acc�der � une autre page (de jeu par exemple) depuis la page administrateur sera refus�e.

Pour se connecter en administrateur, veuillez entrer les informations suivantes :

username : admin 

password : admin

Oui, ce n'est pas tr�s original.

## 2. Extensions possibles

Beaucoup d'id�es nous trottent dans la t�te sur comment am�liorer ce projet (outre des am�liorations n�cessaires et �videntes sur la partie graphique, bien s�r...). Elles ne r�pondent pas � la demande du sujet, mais nous vous donnons ici quelques id�es que le code permettrait d'am�nager : 

  -  Un syst�me de points d'exp�rience li� � chaque personnage. A la fin d'un combat, on pourrait ainsi monter de niveau et r�partir des points de comp�tence pour permettre un level up plus agr�able.
  -  Un rendu graphique plus satisfaisant, principalement au niveau de l'�cran de jeu. Le log d'actions est assez aust�re.
  -  Une possibilit� d'envoyer (comme sur Candy crush par exemple) des points d'actions d'un joueur � un autre.