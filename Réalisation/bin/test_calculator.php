#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Calculator;

$calc = new Calculator(5, 3);

print_r($calc->results());
