## Liste des routes exploitables : 

Racine : ```http://localhost/projet-o-fourn-o-back/public/``` , adapter l'hôte.


### Recettes

| Descriptions              | Routes                        |
| ------------------------- | ----------------------------- |
| Toutes les recettes       | ```/api/recipes/view```       |
| Recette par Id            | ```/api/recipe/{id}```        |
| 5 recettes aléatoires     | ```/api/recipes/random```     |
| Mise à jour d'un recette  | ```/api/recipe/{id}/update``` |
| Crée une nouvelle recette | ```/api/recipe/create```      |


### Ingrédients

| Descriptions         | Routes                      |
| -------------------- | --------------------------- |
| Tous les ingrédients | ```/api/ingredients/view``` |
| Ingrédient par Id    | ```/api/ingredient/{id}```  |

### Ustensiles

| Descriptions        | Routes                    |
| ------------------- | ------------------------- |
| Tous les ustensiles | ```/api/ustensils/view``` |
| Ustensiles par Id   | ```/api/ustensil/{id}```  |

### Utilisateurs

| Descriptions                 | Routes                     |
| ---------------------------- | -------------------------- |
| Tous les utilisateurs        | ```/api/users/view```      |
| Utilisateur par Id           | ```/api/user/{id}```       |
| Crée un utilisateur          | ```/api/user/create```     |
| Mise à jour d'un utilisateur | ```/api/users/{id}/edit``` |

### Commentaires

| Descriptions                           | Routes                                |
| -------------------------------------- | ------------------------------------- |
| Tous les commentaires                  | ```/api/reviews/view```               |
| Commentaire par Id                     | ```/api/review/{id}```                |
| Mise à jour d'un commentaire           | ```/api/review/{id}/update```         |
| Création d'un commentaire              | ```/api/recipes/{id}/review/create``` |
| Nombre de commentaires sur une recette | ```/api/recipes/{id}/review/count```  |
