<?php
$data = [
    'dlugosc' => [
        'editable' => true,
        'tytul' => 'Dĺžka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'szerokosc' => [
        'editable' => true,
        'tytul' => 'Šírka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'liczbaSztuk' => [
        'editable' => true,
        'tytul' => 'Počet kusov',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,

    ],   
     'gruboscRdzenia'=>[
                    'editable' => true,
                    'tytul' => 'Hrúbka jadra',
                    'typ'=>'radio',
                    'wartosci'=>[
                           0 => 2.5,
                           1 => 5,
                    ],
        ],

];


?>