# Calculatrice Logique Binaire en CLI

Ce projet est une mini-calculatrice en ligne de commande (CLI) développée en PHP pour effectuer des conversions de nombres et des opérations logiques binaires (ET, OU, XOR, NON).

## Critères et Contraintes
Ce projet a été développé en respectant un ensemble de critères précis, notamment :
- Utilisation de PHP 8.2+ avec typage strict.
- Respect de la norme PSR-4 pour l'autoloading.
- Structuration du code en classes, interfaces et traits.
- Gestion robuste des erreurs (`try/catch`).
- Création d'un script CLI interactif avec gestion des arguments.
- Intégration de scripts Composer pour automatiser les tâches (`validate`, `test`, `save`).

---

## Installation

1.  Clonez le dépôt :
    ```sh
    git clone <votre-url-git>
    cd calculatrice-logique
    ```
2.  Installez les dépendances avec Composer :
    ```sh
    composer install
    ```

---

## Utilisation

### Calculatrice Logique

Pour utiliser la calculatrice, lancez le script `bin/calc.php` avec deux entiers positifs comme arguments.

```sh
php bin/calc.php 5 3
```

**Exemple de sortie :**
```
------------------------------------------
Entrée A    : 5 (101)
Entrée B    : 3 (11)
------------------------------------------
A ET B      : 1 (1)
A OU B      : 7 (111)
A XOR B     : 6 (110)
NON A       : -6 (...1111111111111010)
------------------------------------------
```

### Générer une sortie JSON

Ajoutez l'option `--json` pour obtenir un résultat au format JSON, idéal pour une utilisation par d'autres scripts.

```sh
php bin/calc.php 5 3 --json
```

---

## Scripts Composer

Plusieurs scripts sont disponibles pour faciliter l'utilisation :

-   **`composer start`** : Exécute la calculatrice avec les valeurs par défaut (5 et 3).
-   **`composer test`** : Lance une exécution de test avec les valeurs 10 et 12.
-   **`composer validate`** : Vérifie la syntaxe de tous les fichiers PHP du projet.
-   **`composer save`** : Exécute le script avec 5 et 3 et sauvegarde la sortie JSON dans `samples/output.json`.

---
Structure des Fichiers
│── bin/
│   ├── convert.php
│   └── calc.php
│
│── samples/
│   ├── input.txt            # Exemple d'arguments en entrée
│   └── output.json          # Exemple de sortie JSON
│
│── src/
│   ├── ConverterInterface.php   # Interface pour conversion
│   ├── NumberConverter.php      # Classe principale de conversion
│   ├── Calculator.php           # Nouvelle classe pour gérer A et B
│   └── OutputFormatter.php      # Trait pour formater les sorties
│
│── .gitignore                # Ignorer vendor/, .env, etc.
│── composer.json             # Config Composer + autoload + scripts
│── README.md                 # Documentation d’utilisation
│── LICENSE                   # MIT (ou autre) licence
