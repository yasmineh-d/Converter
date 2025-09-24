<?php
declare(strict_types=1);

namespace App;

class NumberConverter implements ConverterInterface { //définition d’une classe
    
    use OutputFormatter; //pour lire/écrire du JSON
    private int $number; //qui stocke le nombre à convertir.

    public function __construct(int $number){
        $this->number = $number;
    }
    public function toDecimal(): int{
        return $this->number;
    }
    public function toBinary(): string{
        return decbin($this->number);//convertir en binaire
    }
    public function toHex(): string{
        return strtoupper(dechex ($this->number));//pour mettre en majuscules
    }

    // Méthodes supplémentaires pour ET/OU/XOR/NOT et décalages
    public function bitwiseAnd(int $other): int {
        return $this->number & $other;
    }
    public function bitwiseOr(int $other): int {
        return $this->number | $other;
    }
    public function ShiftLeft(int $bits): int {
        return $this->number << $bits;
    }
    public function ShiftRight(int $bits): int {
        return $this->number >> $bits;
    }
}
