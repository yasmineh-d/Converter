<?php
declare(strict_types=1);

namespace App;

class NumberConverter implements ConverterInterface {
    
    use OutputFormatter;
    private int $number;

    public function __construct(int $number){
        // Critère : Valider les entrées positives
        if ($number < 0) {
            throw new \InvalidArgumentException("Le nombre doit être un entier positif.");
        }
        $this->number = $number;
    }

    public function toDecimal(): int{
        return $this->number;
    }
    public function toBinary(): string{
        return decbin($this->number);
    }
    public function toHex(): string{
        return strtoupper(dechex($this->number));
    }

    // Méthodes pour opérations logiques
    public function bitwiseAnd(int $other): int {
        return $this->number & $other;
    }
    public function bitwiseOr(int $other): int {
        return $this->number | $other;
    }
    
    // (Ajouté)
    public function bitwiseXor(int $other): int {
        return $this->number ^ $other;
    }
    
    // (Ajouté)
    public function bitwiseNot(): int {
        return ~$this->number;
    }

    public function shiftLeft(int $bits): int {
        return $this->number << $bits;
    }
    public function shiftRight(int $bits): int {
        return $this->number >> $bits;
    }
}