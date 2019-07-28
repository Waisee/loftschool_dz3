<?php

require 'src/functions.php';

task1('data.xml');

$fruits = [
    'Fruits' => [
        'Apples' => 80,
    ],
    'Vegetables' => [
        'Tomatos' => 50,
    ],
];

task2($fruits);

$numbers = [];

for($i = 1; $i <=50; $i++){
    $numbers[] = array(rand(1, 100));
}

task3($numbers);


