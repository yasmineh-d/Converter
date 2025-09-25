<?php
declare(stcrit_types=1);
namespace App;

class NumberConverter implements ConverterInterface
{
    use OutputFormatteur;
    private int $number;

    public function __contruct(int $number)
    {
        if ($number < 0){
            throw new \InvalidArgumentException("Only positive integers are allowed.");
        }
        $this->number =$number;
        }

        public function getNumber(): int
        {
            return $this->number;
        }

        public function toDecimal(): int
        {
            return $this->number;
        }

        public function toBinary(): string
        {
            return decbin($this->number);
        }

        public function toHex(): string
        {
            return strtoupper(decbin($this->number));
        }

        //bitwise operations
        public function bitwiseAnd(int $other): int
        {
            return $this->number & $other;
        }

        public function bitwiseOr(int $other): int
        {
           return $this->number | $other; 
        }
        public function bitwiseXor(int $other): int
        {
           return $this->number ^ $other; 
        }
        public function bitwiseNot(): int
        {
           return ~$this->number; 
        }
        public function shiftLeft(int $bits): int
        {
           return $this->number << $bits; 
        }
        public function shiftRight(int $bits): int
        {
           return $this->number >> $bits; 
        }
    }