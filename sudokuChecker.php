<?php

$grid = [
    [5, 3, 4,   6, 7, 8,   9, 1, 2],
    [6, 7, 2,   1, 9, 5,   3, 4, 8],
    [1, 9, 8,   3, 4, 2,   5, 6, 7],
    
    [8, 5, 9,   7, 6, 1,   4, 2, 3],
    [4, 2, 6,   8, 5, 3,   7, 9, 1],
    [7, 1, 3,   9, 2, 4,   8, 5, 6],
    
    [9, 6, 1,   5, 3, 7,   2, 8, 4],
    [2, 8, 7,   4, 1, 9,   6, 3, 5],
    [3, 4, 5,   2, 8, 6,   1, 7, 9],
];

isValidGrid($grid);

function isValidGrid($grid = []) {
    if (count($grid) != 9) {
        die('The given grid is not a 9x9');
    }
    foreach ($grid as $key => $row) {
        isValidRow($row);
        isValidColumn(array_column($grid, $key));
    }
    hasValid3x3Grids($grid);
    die('The grid is valid :D');
}

//checks whether a row is valid or not
function isValidRow($row) {
    return isValidSet($row);
}

//checks whether a column is valid or not
function isValidColumn($column) {
    return isValidSet($column);
}

//divids the 9x9 grid into smaller 3x3 grids and checks whether they are valid or not
function hasValid3x3Grids($grid) {
    $_3x3grid = [];
    $gridSize = 3;
    for ($i = 0; $i < count($grid); $i+=$gridSize) {
        for ($j = 0; $j < count($grid[$i]); $j+=$gridSize) {
            $_3x3grid = array_merge(array_slice($grid[$i], $j, $gridSize), array_slice($grid[$i + 1], $j, $gridSize), array_slice($grid[$i + 2], $j, $gridSize));
            if (count(array_unique($_3x3grid)) < count($_3x3grid)) {
                echo '<pre>';
                echo 'the following 3x3 grid has duplicate elements:' . PHP_EOL;
                echo implode(',', $_3x3grid);
                echo '</pre>';
                die;
            }
        }
    }
    return TRUE;
}

//checks whether a set of elements is valid or not
function isValidSet($set) {
    //check if there are any duplicates
    if (count(array_unique($set)) < count($set)) {
        echo '<pre>';
        print_r($set);
        die('the above set has duplicate elements');
    }
    //check if there are only 9 elements 
    if (count($set) != 9) {
        echo '<pre>';
        print_r($set);
        die('the number of elements in the above set is not 9');
    }
    //check if the summation of the set is 45 
    $sum = array_sum($set);
    if ($sum != 45) {
        echo '<pre>';
        print_r($set);
        die('the summation of the above set is ' . $sum . ' and not 45.');
    }
    //check if any element is greater than 9 | not a single digit 
    foreach ($set as $element) {
        if ($element > 9) {
            echo '<pre>';
            print_r($set);
            die('the element ' . $element . 'is greater than 9.');
        }
    }
    return TRUE;
}
