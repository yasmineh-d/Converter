<?php
declare(strict_types=1);

namespace App;

// Critère : Classe avec propriétés typées, constructeur, visibilité.
class Calculator {
    // Critère : Utilisation d'un trait
    use OutputFormatter;

    // Propriétés typées, privées et en lecture seule
    public function __construct(
        private readonly NumberConverter $converterA,
        private readonly NumberConverter $converterB
    ) {}

    /**
     * Calcule et retourne tous les résultats sous forme de tableau associatif.
     */
    public function getResults(): array {
        $a = $this->converterA->toDecimal();
        $b = $this->converterB->toDecimal();

        return [
            'A ET B'  => $a & $b,
            'A OU B'  => $a | $b,
            'A XOR B' => $a ^ $b,
            'NON A'   => ~$a,
        ];
    }
    
    /**
     * Affiche une table de résultats formatée dans la console.
     */
    public function displayTable(): void {
        $aDec = $this->converterA->toDecimal();
        $bDec = $this->converterB->toDecimal();
        $aBin = $this->converterA->toBinary();
        $bBin = $this->converterB->toBinary();

        echo "------------------------------------------\n";
        echo $this->format('Entrée A', "$aDec ($aBin)");
        echo $this->format('Entrée B', "$bDec ($bBin)");
        echo "------------------------------------------\n";

        $results = $this->getResults();

        foreach ($results as $label => $decResult) {
            $binResult = decbin($decResult);
            // Pour NOT, l'affichage binaire est complexe, on le simplifie.
            if (str_starts_with($label, 'NON')) {
                 $binResult = '...' . substr($binResult, -16);
            }
            echo $this->format($label, "$decResult ($binResult)");
        }
        echo "------------------------------------------\n";
    }

    /**
     * Retourne les résultats au format JSON.
     */
    public function getResultsAsJson(): string {
         $results = $this->getResults();
         $output = [
            'inputA' => [
                'decimal' => $this->converterA->toDecimal(),
                'binary' => $this->converterA->toBinary(),
            ],
            'inputB' => [
                'decimal' => $this->converterB->toDecimal(),
                'binary' => $this->converterB->toBinary(),
            ],
            'results' => []
         ];

         foreach ($results as $label => $decResult) {
             $output['results'][$label] = [
                'decimal' => $decResult,
                'binary' => decbin($decResult)
             ];
         }
         return json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}