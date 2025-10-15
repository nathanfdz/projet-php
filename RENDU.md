# projet-php

# Sécurisation de l’application *« Bibliothèque »*

## Authentification 48h

<img width="1218" height="633" alt="image" src="https://github.com/user-attachments/assets/a5e0c013-10b2-4f7c-9ca0-7dbd5615401b" />
Cette configuration utilise le "remember_me" cookie :
•	lifetime: 172800 limite la validité à 48 heures.
•	L’utilisateur devra se reconnecter après cette durée.


<img width="1525" height="631" alt="image" src="https://github.com/user-attachments/assets/a710d63e-b506-40de-a8e8-34fe8c7b8ab4" />
Ajout remember_me dans login.html.twig



## *Cookie* du mode affichage
capture illustrant le cookie stocké pour le mode clair/sombre.
<img width="1905" height="909" alt="image" src="https://github.com/user-attachments/assets/490deca8-c9d7-4952-a626-d69975685e1a" />
<img width="1894" height="907" alt="image" src="https://github.com/user-attachments/assets/ed58caa2-7389-416c-95bb-d2614a1db771" />
<img width="1915" height="903" alt="image" src="https://github.com/user-attachments/assets/445aac4e-93f3-4df8-9829-f4249a59aed2" />



## Protection CSRF
capture du formulaire de login montrant le champ `_csrf_token`.
<img width="1920" height="577" alt="image" src="https://github.com/user-attachments/assets/553fe859-588f-499a-a165-1ec9bcf85679" />

## Vulnérabilités des dépendances
- Utilisation de `composer audit` pour vérifier les paquets installés.  
- Identification de 6 vulnérabilités sur les dépendances, permettant de mettre à jour ou surveiller les paquets concernés.  

## Difficultés rencontrées et solutions
Au cours du projet, plusieurs difficultés ont été rencontrées et résolues. La gestion des entités et des migrations a nécessité la suppression sécurisée de l’ancienne entité SecuredUser pour éviter les conflits dans la base de données. L’authentification et la configuration des routes ont ensuite été ajustées en régénérant le SecurityController et en vérifiant le bon fonctionnement des routes et des tokens CSRF. Le contrôle d’accès et la gestion des rôles ont été mis en place grâce à la configuration de la hiérarchie dans le fichier security.yaml, ainsi qu’à l’utilisation des fonctions isGranted() et des attributs #[IsGranted] pour restreindre l’accès selon les rôles. Les pages d’erreur HTTP ont été personnalisées en créant des templates dédiés dans templates/bundles/TwigBundle/Exception, afin d’améliorer la clarté et la sécurité des messages d’erreur. Enfin, un cookie a été implémenté pour permettre à l’utilisateur de conserver son choix de mode d’affichage (clair ou sombre), géré dynamiquement via JavaScript pour une meilleure expérience utilisateur.

## Bilan des acquis
Ce projet m’a permis de mieux comprendre la mise en place d’une authentification sécurisée et la protection contre les attaques CSRF. J’ai appris à gérer les rôles et leur hiérarchie pour limiter l’accès aux pages sensibles. La personnalisation des pages d’erreur HTTP m’a aussi aidé à améliorer l’expérience utilisateur tout en renforçant la sécurité. J’ai gagné en maîtrise du framework Symfony, notamment sur les fichiers security.yaml, les formulaires UserType, le SecurityController, Twig et les commandes make:*. Enfin, j’ai découvert comment auditer les dépendances avec Composer afin de vérifier les vulnérabilités et sécuriser davantage l’application.

## Remarques complémentaires
- Le projet a permis de comprendre l’intégration de la sécurité dans Symfony et l’importance de la bonne configuration des rôles et des firewalls.
