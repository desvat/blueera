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
    'wysokosc' => [
        'editable' => true,
        'tytul' => 'Výška',
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
    'dodatkoweOzdobneKrawedzie' => [
        'editable' => false,
        'tytul' => 'Ďalšie ozdobné hrany',
        'typ' => 'checkbox',
        'checked' => 'false',
    ],
     
];

?>