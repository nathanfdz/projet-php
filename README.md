# projet-php

# Sécurisation de l’application *« Bibliothèque »*

## Authentification 48h
- Screenshot : [à insérer]  
  > Exemple : capture montrant qu’un utilisateur ne reste pas connecté plus de 48h.

## *Cookie* du mode affichage
- Screenshot : [à insérer]  
  > Exemple : capture illustrant le cookie stocké pour le mode clair/sombre.

## Protection CSRF
- Screenshot : [à insérer]  
  > Exemple : capture du formulaire de login montrant le champ `_csrf_token`.

## Vulnérabilités des dépendances
- Utilisation de `composer audit` pour vérifier les paquets installés.  
- Identification de 6 vulnérabilités sur les dépendances, permettant de mettre à jour ou surveiller les paquets concernés.  

## Difficultés rencontrées et solutions
- **Gestion des entités et migrations** : suppression sécurisée de l’ancienne entité `SecuredUser`.  
- **Authentification et routes** : régénération du `SecurityController` et vérification des routes et tokens CSRF.  
- **Contrôle d’accès et rôles** : configuration de la hiérarchie dans `security.yaml`, utilisation de `isGranted()` et `#[IsGranted]`.  
- **Pages d’erreur HTTP** : création des templates spécifiques dans `templates/bundles/TwigBundle/Exception`.  
- **Cookies et UX** : création d’un cookie pour le choix du mode clair/sombre et gestion via JS.

## Bilan des acquis
- Mise en place d’une authentification sécurisée et protection CSRF.  
- Gestion fine des rôles et hiérarchie pour restreindre l’accès aux pages.  
- Personnalisation des pages d’erreur HTTP pour une meilleure UX et sécurité.  
- Maîtrise de Symfony : `security.yaml`, `UserType`, `SecurityController`, Twig et commandes `make:*`.  
- Audit des dépendances Composer pour sécuriser l’application.

## Remarques complémentaires
- Le projet a permis de comprendre l’intégration de la sécurité dans Symfony et l’importance de la bonne configuration des rôles et des firewalls.
