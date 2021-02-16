# Symfony_test

### 1. Qu'est-ce qu'un container de services ? Quel est son rôle ?

C'est un contener de tout un tas d'objets qui facilitent notre utilisation de symfony

### 2. Quelle est la différence entre les commandes make:entity et make:user lorsqu'on utilise la console Symfony ?

make:user crée une entité spéciale avec des propriété qui lui sont propre comme une propriété (email, lastname, ...) qui permet d'iddentifier chaque utilisateur. 

### 3. Quelle commande utiliser pour charger les fixtures dans la base de données ?

php bin/console doctrine:fixtures:load

### 4. Résumez de manière simple le fonctionnement du système de versions "Semver"

dans le système Semver les versions sont notés comme suit : 3.5.2
Pour les monté de versions on increment de 1 : 

* le chiffre a droite (ici le 2) lors de patch de bugs
* le chiffre du milieu (ici le 5) lors de changement plus conséquents mais qui n'empeche pas les anciennes version de fonctionner
* le chiffre de gauche (ici le 3) lors de changement conséquents qui rende obsolètes les anciennes versions

### 5. Qu'est-ce qu'un Repository ? A quoi sert-il ?

C'est une classe qui nous met en relations avec la base de données notemment grace a des méthodes (findAll())

### 6. Quelle commande utiliser pour voir la liste des routes ?

debug:router

### 7. Dans un template Twig, quelle variable globale permet d'accéder à la requête courante, l'utilisateur courant, etc...?

app.

### 8. Pour mettre à jour la structure de la base de données, quelles sont les 2 possibilités que nous avons abordées en cours ?

avec migration avec ces commandes : 

* php bin/console make:migration
* php bin/console doctrine:migrations:migrate
* php bin/console doctrine:fixtures:load

sans migration avec ses commandes :

* php bin/console doctrine:schema:update --force

### 9. Quelle commande permet de créer une classe de contrôleur ?

php bin/console make:controller

### 10. Décrivez succintement l'outil Flex de Symfony

c'est un outil d'installations de dépendances 