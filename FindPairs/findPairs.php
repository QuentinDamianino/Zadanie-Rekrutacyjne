<?php

function findPairs($arr, $n) {
    $pairs = [];

    for ($i = 0; $i < $n; $i++) {
        if ($arr[$i] > 0) {
            array_push($pairs, $arr[$i]);
        }
    }

    for ($i = 0; $i < $n; $i++) {
        if ($arr[$i] < 0) {
            if (in_array(-$arr[$i], $pairs)){
                if (($key = array_search(-$arr[$i], $pairs)) !== false) {
                    unset($pairs[$key]);
                }
                echo $arr[$i] . ', ' . -$arr[$i] . "\n";
            }
        }
    }
}

$arr = [3, 6, -3, 5, -10, 3, 10, 1, 7, -1, -9, -8, 7, 7, -7, -2, -7];

findPairs($arr, count($arr));
