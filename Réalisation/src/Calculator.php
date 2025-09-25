<?php
declare(strict_types=1);

namespace App;

class Calculator
{
    private NumberConverter $a;
    private ?NumberConverter $b; // B peut être null si une seule entrée

    public function __construct(int $a, ?int $b = null)
    {
        $this->a = new NumberConverter($a);
        $this->b = $b !== null ? new NumberConverter($b) : null;
    }

    public function getA(): NumberConverter
    {
        return $this->a;
    }

    public function getB(): ?NumberConverter
    {
        return $this->b;
    }

    public function results(): array
    {
        $results = [
            "A" => [
                "decimal" => $this->a->toDecimal(),
                "binary"  => $this->a->toBinary(),
                "hex"     => $this->a->toHex(),
            ],
        ];

        if ($this->b !== null) {
            $results["B"] = [
                "decimal" => $this->b->toDecimal(),
                "binary"  => $this->b->toBinary(),
                "hex"     => $this->b->toHex(),
            ];

            // opérations logiques entre A et B
            $results["AND"] = $this->a->bitwiseAnd($this->b->toDecimal());
            $results["OR"]  = $this->a->bitwiseOr($this->b->toDecimal());
            $results["XOR"] = $this->a->bitwiseXor($this->b->toDecimal());
        }

        // opérations sur A seul
        $results["NOT A"]      = $this->a->bitwiseNot();
        $results["Shift A <<"] = $this->a->shiftLeft(1);
        $results["Shift A >>"] = $this->a->shiftRight(1);

        return $results;
    }
}
