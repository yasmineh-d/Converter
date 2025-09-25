#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\NumberConverter;

try {
    $number = null;
    $options = [];

    for ($i = 1; $i < count($argv); $i++) {
        $arg = $argv[$i];

        if (str_starts_with($arg, '--')) {
            if (str_contains($arg, '=')) {
                [$option, $value] = explode('=', substr($arg, 2), 2);
                $options[$option] = $value;
            } else {
                $option = substr($arg, 2);
                $options[$option] = true;
            }
        } elseif ($number === null && is_numeric($arg)) {
            $number = $arg;
        }
    }

    if ($number === null || !is_numeric($number)) {
        throw new \InvalidArgumentException(
            "Usage: php bin/convert.php <number> [--and=5] [--or=3] [--xor=7] [--not] [--shift-left=2] [--shift-right=1]"
        );
    }

    $converter = new NumberConverter((int)$number);

    echo $converter->format("Decimal", $converter->toDecimal());
    echo $converter->format("Binary", $converter->toBinary());
    echo $converter->format("Hexa", $converter->toHex());

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

} catch (Throwable $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
