<?php
declare(strict_types=1);
namespace App;

interface ConverterInterface {
    public function toDecimal(): int;
    public function toBinary(): string;
    public function toHex(): string;
}