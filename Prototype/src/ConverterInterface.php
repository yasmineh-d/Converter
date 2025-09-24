<?php
declare(strict_types=1);//active le typage strict : si tu appelles une méthode avec une mauvaise donnée (string au lieu de int par exemple), PHP lèvera une erreur.

namespace App;
//ida bghiti tsta3ml class fxi class a5or

interface ConverterInterface {
    public function toDecimal(): int; //kathadd les fonction likat5dm bihom
    public function toBinary(): string;
    public function toHex(): string;

}
