
# 🔢 Number Converter CLI

Un petit outil en **PHP ≥ 8.2** pour convertir des nombres en **décimal, binaire et hexadécimal** depuis la ligne de commande.  
Projet réalisé par **HAD-DAD Yasmine** dans le cadre du module *Prototype – Logique binaire*.

---

## ✨ Fonctionnalités
- Conversion d’un entier en :
  - Décimal
  - Binaire
  - Hexadécimal
- Gestion des erreurs (entrée manquante ou invalide)
- Sortie claire et formatée

---

## ⚙️ Prérequis
- PHP **8.2+**
- Git (pour cloner le projet)
=======
# 🔢 Convertisseur Décimal → Binaire / Hexadécimal

Petit script CLI en **PHP ≥ 8.2** qui prend un entier en entrée et affiche sa représentation en :
- Décimal
- Binaire
- Hexadécimal


---

## 🚀 Utilisation


### Conversion simple
```bash
php bin/convert.php 42
=======

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
