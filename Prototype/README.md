# 🔢 Convertisseur Décimal → Binaire / Hexadécimal

Petit script CLI en **PHP ≥ 8.2** qui prend un entier en entrée et affiche sa représentation en :
- Décimal
- Binaire
- Hexadécimal

---

## 🚀 Utilisation

Exécuter la commande suivante :

```bash
php bin/convert.php 42

Project Structure

/convertisseur-numerique/
|
|-- bin/
|   `-- convert.php           # Point d'entrée du script CLI
|
|-- src/
|   |-- Converter.php         # Classe principale pour la logique de conversion
|   |-- ConverterInterface.php  # Contrat (interface) pour le convertisseur
|   `-- OutputFormatter.php   # Trait pour formater les sorties
|
|-- .gitignore                  # Fichier pour ignorer les dossiers/fichiers inutiles (ex: vendor)
|-- composer.json             # Fichier de configuration du projet et des dépendances
|-- LICENSE                     # Fichier de licence (ex: MIT)
`-- README.md                   # Documentation du projet
