#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\NumberConverter;

try { // pour controler les erreur
    $input = $argv[1] ?? null;

    if ($input === null || !is_numeric($input)) { //si utilisation n'a pas donees un numero ou a donnee quelque chose pas numerique ->va aficher message usage
        throw new \InvalidArgumentException(
            "Usage: php convert.php <number> [--and=5] [--or=3] [--xor=7] [--not] [--shift-left=2] [--shift-right=1]"
        );
    }

    $number = (int) $input;
    $converter = new NumberConverter($number);//NumberConverter conserve le nombre et fournit des méthodes pour le convertir (Décimal, Binaire, Hexadécimal) ainsi que pour effectuer des opérations bitwise.

    // Parse CLI options with getopt()
    //getopt() retourne un tableau associatif contenant les options que l’utilisateur a utilisées en ligne de commande
    $options = getopt("", ["and::", "or::", "xor::", "not", "shift-left::", "shift-right::"]);

    // Base conversions
    echo OutputFormatter::format("Decimal", $converter->toDecimal());
    echo OutputFormatter::format("Binary", $converter->toBinary());
    echo OutputFormatter::format("Hexa", $converter->toHex());

    // Bitwise operations
    if (isset($options['and'])) {
        echo OutputFormatter::format("AND", $converter->bitwiseAnd((int) $options['and']));
    }

    if (isset($options['or'])) {
        echo OutputFormatter::format("OR", $converter->bitwiseOr((int) $options['or']));
    }

    if (isset($options['xor'])) {
        echo OutputFormatter::format("XOR", $converter->bitwiseXor((int) $options['xor']));
    }

    if (isset($options['not'])) {
        echo OutputFormatter::format("NOT", $converter->bitwiseNot());
    }

    if (isset($options['shift-left'])) {
        echo OutputFormatter::format("Shift Left", $converter->shiftLeft((int) $options['shift-left']));
    }

    if (isset($options['shift-right'])) {
        echo OutputFormatter::format("Shift Right", $converter->shiftRight((int) $options['shift-right']));
    }

} catch (\Throwable $e) { //Gestion des erreurs
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
