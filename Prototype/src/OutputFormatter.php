<?php
declare(strict_types=1);

namespace App;

trait OutputFormatter {//kat3adm formule d ktaba bx ktkon mndma
    public static function format(string $label, string|int $value): string { //kat3ayt forma f fichier convert ki3tilk la valeur dyal label o value  
        return str_pad($label, 12, " ", STR_PAD_RIGHT) . ": " . $value . PHP_EOL;//php_eol kat3ni nrja3 nstar ,kikml 12 Caractere adk ki 3ml : ,str_pad_right kizidna dik espace 3la limn  
    }
}
