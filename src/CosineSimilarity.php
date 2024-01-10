<?php

namespace AchrafSoltani\PhpSimilarityMetrics;

class CosineSimilarity implements ComputeInterface
{
    private $vector1;
    private $vector2;
    public function __construct(Array $v1, Array $v2){
        $this->vector1 = $v1;
        $this->vector2 = $v2;
    }
    public function compute()
    {
        return $this->dotProduct($this->vector1,$this->vector2)/sqrt($this->dotProduct($this->vector1,$this->vector2)*$this->dotProduct($this->vector1,$this->vector2));
    }

    function dotProduct($arr1, $arr2){
        return array_sum(array_map(function($a, $b) { return $a * $b; }, $arr1, $arr2));
    }
}