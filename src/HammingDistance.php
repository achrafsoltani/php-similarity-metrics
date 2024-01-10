<?php

namespace AchrafSoltani\PhpSimilarityMetrics;

class HammingDistance implements ComputeInterface
{
    private $operand1;
    private $operand2;
    public function __construct(String $op1, String $op2){
        if (strlen($op1) != strlen($op2)){
            throw new \Exception("Operands must be of equal length.");
        }
        $this->operand1 = $op1;
        $this->operand2 = $op2;
    }

    public function compute(): int
    {
        $counter = 0;
        for ($i = 0; $i < strlen($this->operand1); $i++){
            if ($this->operand1[$i] != $this->operand2[$i]){
                $counter++;
            }
        }
        return $counter;
    }
}