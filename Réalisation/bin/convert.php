#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\NumberConverter;
use App\Calculator;

try {
    $options = getopt('', ['input:', 'output:']);
    $args = array_filter($argv, fn($arg) => !str_starts_with($arg, '--'));
    array_shift($args); // enlever le nom du script

    // Lecture depuis un fichier input.txt si --input est spécifié
    if (isset($options['input'])) {
        $input = file_get_contents($options['input']);
        if ($input === false) {
            throw new InvalidArgumentException("Impossible de lire le fichier d'entrée : {$options['input']}");
        }
        $args = array_map('trim', explode(' ', $input));
    }

    if (count($args) < 1 || count($args) > 2) {
        throw new InvalidArgumentException("Usage: php bin/convert.php <A> [B] [--input=<file>] [--output=<file>]");
    }

    $a = $args[0];
    $b = $args[1] ?? null;

    if (!ctype_digit($a) || ($b !== null && !ctype_digit($b))) {
        throw new InvalidArgumentException("Les entrées doivent être des entiers positifs.");
    }

    $a = (int) $a;
    $b = $b !== null ? (int) $b : null;

    $converter = new NumberConverter($a);
    $calc = new Calculator($a, $b);

    // Calcul du padding binaire
    $maxVal = $b !== null ? max($a, $b, $calc->and(), $calc->or(), $calc->xor()) : $a;
    $bits = $maxVal === 0 ? 1 : (int) floor(log($maxVal, 2)) + 1;

    // Méthode helper pour afficher un entier en binaire avec padding
    $bin = fn(int $val) => str_pad(decbin($val), $bits, '0', STR_PAD_LEFT);

    $output = [];
    $output[] = str_repeat("=", 30);
    $output[] = $converter->format("Entrée A", "$a ({$bin($a)})");
    if ($b !== null) $output[] = $converter->format("Entrée B", "$b ({$bin($b)})");
    $output[] = str_repeat("=", 30);

    // Conversions A
    $output[] = $converter->format("Décimal A", $converter->toDecimal());
    $output[] = $converter->format("Binaire A", $converter->toBinary());
    $output[] = $converter->format("Hexa A", $converter->toHex());

    // Opérations logiques
    if ($b !== null) {
        $output[] = $converter->format("A ET B", $calc->and() . " ({$bin($calc->and())})");
        $output[] = $converter->format("A OU B", $calc->or() . " ({$bin($calc->or())})");
        $output[] = $converter->format("A XOR B", $calc->xor() . " ({$bin($calc->xor())})");
    }

    // NOT
    $notA = $calc->notA();
    $notABin = $notA < 0 ? '…' . substr(decbin(256 + $notA), -8) : $bin($notA);
    $output[] = $converter->format("NON A", $notA . " ($notABin)");

    if ($b !== null) {
        $notB = $calc->notB();
        $notBBin = $notB < 0 ? '…' . substr(decbin(256 + $notB), -8) : $bin($notB);
        $output[] = $converter->format("NON B", $notB . " ($notBBin)");
    }

    $output[] = str_repeat("=", 30);

    // Résultats pour JSON
    $results = [
        'A' => $a,
        'B' => $b,
        'decimal_A' => $converter->toDecimal(),
        'binary_A' => $converter->toBinary(),
        'hex_A' => $converter->toHex(),
        'NOT_A' => $notA,
    ];
    if ($b !== null) {
        $results['AND'] = $calc->and();
        $results['OR'] = $calc->or();
        $results['XOR'] = $calc->xor();
        $results['NOT_B'] = $notB;
    }

    if (isset($options['output'])) {
        file_put_contents($options['output'], json_encode($results, JSON_PRETTY_PRINT));
    } else {
        echo implode(PHP_EOL, $output) . PHP_EOL;
    }

} catch (Throwable $e) {
    fwrite(STDERR, "Erreur: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
