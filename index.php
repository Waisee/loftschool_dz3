<?php

require 'src/functions.php';

task1('data.xml');

$fruits = [
    'Fruits' => [
        'Apples' => 80,
        'Bananas' => 100,
    ],
    'Vegetables' => [
        'Tomato' => 50,
    ],
];

task2($fruits);
