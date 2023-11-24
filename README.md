![separe](https://github.com/studoo-app/.github/blob/main/profile/studoo-banner-logo.png)
# Symfony Authentication Logs

## Description
Projet contenant un système d'authentificaiton classique où les utilisateurs peuvent avoir soit le rôle `ROLE_USER`
ou le rôle `ROLE_ADMIN`.
Les utlisateurs se connectent via le formulaire de login sur la route `/login`.
Après une authentification réussie, l'utlisateur sera redirigé en fonction de son rôle.
Liste des redirections:
- `ROLE_ADMIN`->`/admin/dashboard`
- `ROLE_USER`->`/home`

## Mission

Afin d'avoir une vision claire sur le flux des authentifications, vous devez mettre en place 
un systeme d'audit des authentifications.

### Contraintes

- Vous devrez tracer toutes les tentatives d'authentification, échouée comme réussie
- Vous sauvegarderez ces traces d'authentifications soit dans un fichier soit en base de données
- Les traces de logs devront pouvoir être visualiser sur le dashboard de l'administrateur
- Une trace de log devra comporter l'email, la date, et le statut de tentative, et un message qui en cas d'erreur reprendra le message de l'erreur levée