# EPFL-Form

## BUT 

Réaliser un formulaire pour la postulation des nouveaux apprentis EPFL, pour tous les métiers.
Les languages WEB choisis sont PHP, Javascript (et frameworks).

## Attentes

Le formulaire permet d'uploader des fichiers (tels que des CV, lettre de motivations etc) sur notre serveur 
et donner des droit de lecture aux personnes responsables.
Le formualire crée un dossier au nom de l'apprenti, classé par métier, avec ses informations et ses fichiers uploadés,
idéalement tout devrait être en format PDF.
Au chargement, le site ne propose que le choix du métier, puis affiche ou non le reste du formulaire selon le métier choisi (voir particularités)
Le site doit être équipé de vérification multiple, côté client et serveur:
* Contrôles d'entrées sur les champs (saisie, required, ...)

* Contrôles sur fichiers (nom, taille, format, ...)

**Le projet devra être terminé début octobre 2016**

## Particularités

Les demandes d'apprentissages pour les métiers de laboratoires se font auprès d'une autre association, 
lorsque l'une des 3 filières est sélectionnée, une redirection vers le site de cette association se fait.

Lorsque la profession d'informaticien est choisie, un choix entre les filières disponibles doit apparaitre.

Lorsque la profession de polymécanicien est choisie, un champ upload supplémentaire doit apparaitre pour le certificat de capacité GIM-CH.

### Dans un autre temps...

Un base de données pourrait être liée afin de permettre le tri des apprentis selon certains critères (notes, maturité intégrée, ...)
