<?php


function findUniqueValue($data) {
    $cnt = [];
    foreach ($data AS $item) {
        if (isset($cnt[$item])) {
            $cnt[$item] += 1;
        } else {
            $cnt[$item] = 1;
        }
    }

    foreach ($cnt as $key => $value) {
        if ($value == 1) {
            return $key;
        }
    }

    return $cnt;
}


$data = [5, 5, 1, 7, 1];

var_dump(findUniqueValue($data));

