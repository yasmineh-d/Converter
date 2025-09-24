<?php
declare(strict_types=1);

namespace App;

class NumberConverter implements ConverterInterface {
    
    use OutputFormatter;
    private int $number;

    public function __construct(int $number){
        $this->number = $number;
    }
    public function toDecimal(): int{
        return $this->number;
    }
    public function toBinary(): string{
        return decbin($this->number);
    }
    public function toHex(): string{
        return strtoupper(dechex ($this->number));
    }

    
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
