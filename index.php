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

$url = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
task4($url);
