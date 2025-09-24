<?php
declare(strict_types=1);

namespace App;

trait OutputFormatter {
    public function format(string $label, string|int $value): string {
        return str_pad($label, 12, " ", STR_PAD_RIGHT) . ": " . $value . PHP_EOL; 
    }
}
