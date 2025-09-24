#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\NumberConverter;

try { // pour controler les erreur
    $number = null;
    $options = [];

    for($i = 1; $i < count($argv); $i++) {
        $arg = $argv[$i];

        if(str_starts_with($arg, '--')) {
            if(str_contains($arg, '=')) {
                [$option, $value] = explode('=', substr($arg, 2), 2);
                $options[$option] = $value;
            } else {
                $option = substr($arg, 2);
                $options[$option] = true;
            }
        } else if($number === null && is_numeric($arg)) {
            $number = $arg;
        }
    }

    if ($number === null || !is_numeric($number)) { //si utilisation n'a pas donees un numero ou a donnee quelque chose pas numerique ->va aficher message usage
        throw new \InvalidArgumentException(
            "Usage: php convert.php <number> [--and=5] [--or=3] [--xor=7] [--not] [--shift-left=2] [--shift-right=1]"
        );
    }

    $converter = new NumberConverter((int)$number);//NumberConverter conserve le nombre et fournit des méthodes pour le convertir (Décimal, Binaire, Hexadécimal) ainsi que pour effectuer des opérations bitwise.

    // Parse CLI options with getopt()
    //getopt() retourne un tableau associatif contenant les options que l’utilisateur a utilisées en ligne de commande
    // $options already parsed above, do not override with getopt()

    // Base conversions
    echo $converter->format("Decimal", $converter->toDecimal());
    echo $converter->format("Binary", $converter->toBinary());
    echo $converter->format("Hexa", $converter->toHex());

    // Bitwise operations
    if (isset($options['and'])) {
        echo $converter->format("AND", $converter->bitwiseAnd((int) $options['and']));
    }

    if (isset($options['or'])) {
        echo $converter->format("OR", $converter->bitwiseOr((int) $options['or']));
    }

    if (isset($options['xor'])) {
        echo $converter->format("XOR", $converter->bitwiseXor((int) $options['xor']));
    }

    if (isset($options['not'])) {
        echo $converter->format("NOT", $converter->bitwiseNot());
    }

    if (isset($options['shift-left'])) {
        echo $converter->format("Shift Left", $converter->shiftLeft((int) $options['shift-left']));
    }

    if (isset($options['shift-right'])) {
        echo $converter->format("Shift Right", $converter->shiftRight((int) $options['shift-right']));
    }

} catch (Throwable $e) { //Gestion des erreurs
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
