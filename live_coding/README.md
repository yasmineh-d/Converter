# 🔢 Convertisseur Décimal → Binaire / Hexadécimal

Petit script CLI en **PHP ≥ 8.2** qui prend un entier en entrée et affiche sa représentation en :
- Décimal
- Binaire
- Hexadécimal

---

## Prérequis

*   PHP >= 8.2
*   Composer

## Installation

1.  Clonez le dépôt :
    ```bash
    git clone https://github.com/votre-utilisateur/votre-projet.git
    cd votre-projet
    ```

2.  Installez les dépendances :
    ```bash
    composer install
    ```

3. Utiliser les scripts Composer :
code
Bash
composer start  # Exécute la conversion pour le nombre 42
composer lint   # Vérifie la syntaxe des fichiers PHP
## 🚀 Utilisation

Exécuter la commande suivante :

```bash
php bin/convert.php 42

Project Structure

/convertisseur-numerique/
|
|-- bin/
|   `-- convert.php            # Point d'entrée du script CLI
|
|-- src/
|   |-- NumberConverter.php    # Classe principale pour la logique de conversion
|   |-- ConverterInterface.php # Contrat (interface) pour le convertisseur
|   `-- OutputFormatter.php    # Trait pour formater les sorties
|
|-- .gitignore                 # Ignorer les fichiers/dossiers inutiles (ex: vendor)
|-- composer.json              # Configuration du projet et dépendances
|-- LICENSE                    # Licence MIT
`-- README.md                  # Documentation du projet
