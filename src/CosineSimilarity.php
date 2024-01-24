<?php

namespace AchrafSoltani\PhpSimilarityMetrics;

class CosineSimilarity implements ComputeInterface
{
    private $matrix;
    private $vector;
    public function __construct(Array $m, Array $v){
        $this->matrix = $m;
        $this->vector = $v;
    }
    public function compute()
    {
        /*
         * Input example
         * $this->matrix = array(
                            array(
                                "element" => "identifier",
                                "tags" => array("key1", "key2", "...", "keyN")
                            ),
                            array(
                                "element" => "identifier",
                                "tags" => array("key1", "key2", "...", "keyN")
                            ),
                            array(
                                "element" => "identifier",
                                "tags" => array("key1", "key2", "...", "keyN")
                            ),
                            array(
                                "element" => "identifier",
                                "tags" => array("key1", "key2", "...", "keyN")
                            )
                        );
         */
        $dot = $this->dot(call_user_func_array("array_merge", array_column($this->matrix, "tags")));
        // $this->vector = array('key1', 'key2', 'keyN');
        foreach($this->matrix as $element) {
            $score[$element['element']] = $this->cosine($this->vector, $element['tags'], $dot);
        }
        asort($score);
        return $score;
    }

    public function dot($tags) {
        $tags = array_unique($tags);
        $tags = array_fill_keys($tags, 0);
        ksort($tags);
        return $tags;
    }
    public function dot_product($a, $b) {
        $products = array_map(function($a, $b) {
            return $a * $b;
        }, $a, $b);
        return array_reduce($products, function($a, $b) {
            return $a + $b;
        });
    }
    public function magnitude($point) {
        $squares = array_map(function($x) {
            return pow($x, 2);
        }, $point);
        return sqrt(array_reduce($squares, function($a, $b) {
            return $a + $b;
        }));
    }
    public function cosine($a, $b, $base) {
        $a = array_fill_keys($a, 1) + $base;
        $b = array_fill_keys($b, 1) + $base;
        ksort($a);
        ksort($b);
        return $this->dot_product($a, $b) / ($this->magnitude($a) * $this->magnitude($b));
    }
}