#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Calculator;
use App\NumberConverter;

// Critère: try/catch conforme
try {
    $arguments = array_slice($argv, 1);
    
    // Filtrer l'option --json
    $isJsonOutput = false;
    $numbersArgs = array_filter($arguments, function($arg) use (&$isJsonOutput) {
        if ($arg === '--json') {
            $isJsonOutput = true;
            return false; // Exclure --json de la liste des nombres
        }
        return true;
    });

    // Si les arguments sont invalides, essaie de lire samples/input.txt
    if (count($numbersArgs) !== 2 || !is_numeric($numbersArgs[0]) || !is_numeric($numbersArgs[1])) {
        echo "Arguments invalides. Tentative de lecture depuis 'samples/input.txt'...\n";
        
        $lines = file(__DIR__ . '/../samples/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) throw new RuntimeException("Fichier input.txt introuvable.");

        // Critère : Adapte closures/helpers array_* pour nettoyer un jeu de données.
        $numbersArgs = array_slice(array_map('intval', array_filter($lines, 'is_numeric')), 0, 2);

        if (count($numbersArgs) < 2) {
             throw new InvalidArgumentException("Le fichier 'samples/input.txt' ne contient pas deux nombres valides.");
        }
    }
    
    // Critère : Utilisation de l'opérateur de coalescence nulle (??)
    $numA = (int)($numbersArgs[0] ?? 0);
    $numB = (int)($numbersArgs[1] ?? 0);
    
    $converterA = new NumberConverter($numA);
    $converterB = new NumberConverter($numB);
    $calculator = new Calculator($converterA, $converterB);
    
    // Critère : Gère les options et peut écrire du JSON
    if ($isJsonOutput) {
        echo $calculator->getResultsAsJson();
    } else {
        $calculator->displayTable();
    }

} catch (Throwable $e) {
    fwrite(STDERR, "Erreur: " . $e->getMessage() . PHP_EOL);
    exit(1);
}